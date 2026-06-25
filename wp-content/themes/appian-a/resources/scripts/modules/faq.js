import { initSectionDividerAnimation } from '../utils/section-divider.js';

function initFaqProcess(context = document) {
    initSectionDividerAnimation(context);

    const accordionPanels = context.querySelectorAll('.faq__faq .collapse');

    accordionPanels.forEach((panel) => {
        if (panel.dataset.scrollBound === 'true') {
            return;
        }

        panel.dataset.scrollBound = 'true';

        panel.addEventListener('shown.bs.collapse', function (e) {
            const accordionItem = e.target.closest('.accordion-item');

            if (accordionItem) {
                const top = accordionItem.getBoundingClientRect().top;

                // when scrolling up to the opened tab the header also opens. adding a 90px offset to account for the header height.
                if (top < 0) {
                    window.scrollTo({
                        top: window.scrollY + top - 120,
                        behavior: 'smooth',
                    });
                    return;
                }

                accordionItem.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            }
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
