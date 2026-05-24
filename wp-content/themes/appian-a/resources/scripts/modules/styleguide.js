function initStyleguide() {
    const container = document.querySelector('.m-styleguide');
    if (!container) return;

    const colorItems = container.querySelectorAll('.m-styleguide__color-item');
    const iconItems = container.querySelectorAll('.m-styleguide__icon-item');
    const typoButtons = container.querySelectorAll('.m-styleguide__typo-button');
    const form = container.querySelector('.m-styleguide__form');
    const copyCodeBtns = container.querySelectorAll('[data-copy-code]');

    // Clipboard copy helper
    function copyText(text) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text)
                .catch(err => console.error('Clipboard copy failed:', err));
        }
    }

    // Colors: read custom properties and write hex values
    const style = getComputedStyle(document.documentElement);
    colorItems.forEach(item => {
        const cssVar = item.getAttribute('data-css-var');
        const hexEl = item.querySelector('[data-hex]');
        if (cssVar) {
            const value = style.getPropertyValue(cssVar).trim();
            if (hexEl) {
                hexEl.textContent = value || cssVar;
            }
            if (value) {
                item.setAttribute('data-color', value);
            }
        }

        // Color click to copy
        item.addEventListener('click', () => {
            const colorVal = item.getAttribute('data-color');
            if (colorVal) {
                copyText(colorVal);
            }
        });
    });

    // Typography specs populator
    const typoItems = container.querySelectorAll('[data-typo-class]');
    typoItems.forEach(item => {
        const cls = item.getAttribute('data-typo-class');
        const prefix = `--typo-${cls}`;

        const fontEl = item.querySelector('[data-typo-font]');
        const weightEl = item.querySelector('[data-typo-weight]');
        const desktopEl = item.querySelector('[data-typo-desktop]');
        const mobileEl = item.querySelector('[data-typo-mobile]');

        if (fontEl) {
            fontEl.textContent = style.getPropertyValue(`${prefix}-font`).trim();
        }
        if (weightEl) {
            weightEl.textContent = style.getPropertyValue(`${prefix}-weight-label`).trim();
        }
        if (desktopEl) {
            const size = style.getPropertyValue(`${prefix}-desktop-size`).trim();
            const lh = style.getPropertyValue(`${prefix}-desktop-lh`).trim();
            desktopEl.textContent = `${size} / ${lh}`;
        }
        if (mobileEl) {
            const size = style.getPropertyValue(`${prefix}-mobile-size`).trim();
            const lh = style.getPropertyValue(`${prefix}-mobile-lh`).trim();
            mobileEl.textContent = `${size} / ${lh}`;
        }
    });

    // Typography Desktop/Mobile Preview Toggle
    typoButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const view = btn.getAttribute('data-view');

            typoButtons.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');

            if (view === 'mobile') {
                container.classList.add('is-mobile-view');
            } else {
                container.classList.remove('is-mobile-view');
            }
        });
    });

    // Icon click to copy PHP reference
    iconItems.forEach(item => {
        item.addEventListener('click', () => {
            const name = item.getAttribute('data-icon-class') || '';
            const phpSnippet = `<?php echo appian_get_svg_icon( '${name}' ); ?>`;
            copyText(phpSnippet);
        });
    });

    // Code block click to copy
    copyCodeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const codeBlock = btn.closest('.m-styleguide__example-block');
            const codeEl = codeBlock ? codeBlock.querySelector('code') : null;
            if (codeEl) {
                copyText(codeEl.textContent);
            }
        });
    });

    // Form validation
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let hasErrors = false;
            const inputs = form.querySelectorAll('.m-styleguide__form-input, .m-styleguide__form-select');

            inputs.forEach(input => {
                const group = input.closest('.m-styleguide__form-group');
                const hasError = input.hasAttribute('required') && !input.value.trim();
                if (group) {
                    group.classList.toggle('is-error', hasError);
                }
                if (hasError) {
                    hasErrors = true;
                }
            });

            if (!hasErrors) {
                alert('Form submitted successfully!');
                form.reset();
                inputs.forEach(input => {
                    const group = input.closest('.m-styleguide__form-group');
                    if (group) {
                        group.classList.remove('is-error');
                    }
                });
            } else {
                alert('Please fill out all required fields.');
            }
        });
    }
}

// Initialize styleguide
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initStyleguide);
} else {
    initStyleguide();
}

// ACF block preview support
if (window.acf) {
    window.acf.addAction('render_block_preview/type=styleguide', initStyleguide);
}
