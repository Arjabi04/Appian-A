function initFaqProcess(context = document) {
    const containers = context.querySelectorAll('[data-faq]');
    if (!containers.length) return;

    containers.forEach((container) => {
        const items = Array.from(container.querySelectorAll('[data-faq-item]'));
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function waitForCloseAnimation(panel, done) {
            let called = false;

            const cleanup = () => {
                panel.removeEventListener('transitionend', onEnd);
            };

            const onEnd = (e) => {
                if (called) return;
                if (e.target !== panel) return;
                if (e.propertyName !== 'max-height') return;
                called = true;
                cleanup();
                done();
            };

            panel.addEventListener('transitionend', onEnd);

            // Fallback in case transitionend doesn't fire (e.g. display changes, reduced motion).
            window.setTimeout(() => {
                if (called) return;
                called = true;
                cleanup();
                done();
            }, 400);
        }

        function setItemOpen(item, open) {
            const button = item.querySelector('.faq__toggle');
            if (!button) return Promise.resolve();

            const panelId = button.getAttribute('aria-controls');
            const panel = panelId ? container.querySelector(`#${panelId}`) : item.querySelector('.faq__panel');
            if (!panel) return Promise.resolve();

            button.setAttribute('aria-expanded', open ? 'true' : 'false');

            if (open) {
                // Make visible first, then animate open in the next frame.
                panel.removeAttribute('hidden');
                window.requestAnimationFrame(() => {
                    item.classList.add('is-open');
                    panel.classList.add('is-open');

                });
                return Promise.resolve();
            }

            // Animate closed, then hide after the transition completes.
            item.classList.remove('is-open');
            panel.classList.remove('is-open');

            return new Promise((resolve) => {
                waitForCloseAnimation(panel, () => {
                    // If it was reopened while we were waiting, don't hide it.
                    const stillClosed = button.getAttribute('aria-expanded') === 'false';
                    if (stillClosed) {
                        panel.setAttribute('hidden', '');
                    }
                    resolve();
                });
            });
        }

        function scrollToQuestion(item) {
            const behavior = prefersReducedMotion ? 'auto' : 'smooth';

            window.requestAnimationFrame(() => {
                item.scrollIntoView({
                    behavior,
                    block: 'start',
                    inline: 'nearest',
                });
            });
        }

        // Normalize initial state from aria-expanded + classes.
        items.forEach((item) => {
            const button = item.querySelector('.faq__toggle');
            const isOpen = button && button.getAttribute('aria-expanded') === 'true';
            setItemOpen(item, !!isOpen);
        });

        items.forEach((item) => {
            const button = item.querySelector('.faq__toggle');
            if (!button) return;

            const handleClick = () => {
                const isOpen = button.getAttribute('aria-expanded') === 'true';
                const closingPromises = [];

                items.forEach((other) => {
                    if (other === item) return;
                    const otherButton = other.querySelector('.faq__toggle');
                    const otherIsOpen = otherButton && otherButton.getAttribute('aria-expanded') === 'true';
                    if (otherIsOpen) {
                        closingPromises.push(setItemOpen(other, false));
                    }
                });

                if (isOpen) {
                    setItemOpen(item, false);
                    return;
                }

                Promise.all(closingPromises).then(() => {
                    scrollToQuestion(item);
                    setItemOpen(item, true);
                });
            };

            if (button.faqClickHandler) {
                button.removeEventListener('click', button.faqClickHandler);
            }
            button.addEventListener('click', handleClick);
            button.faqClickHandler = handleClick;
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initFaqProcess(document));
} else {
    initFaqProcess(document);
}

// ACF block preview support
if (window.acf) {
    window.acf.addAction('render_block_preview/type=faq', () => initFaqProcess(document));
}
