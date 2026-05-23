// Side-effect import — registers Bootstrap's collapse data-api listeners.
import 'bootstrap/js/dist/collapse';

class Styleguide {
    constructor() {
        this.container = document.querySelector('.m-styleguide');
        if (!this.container) return;

        this.toast = this.container.querySelector('.m-styleguide__toast');
        this.swatches = this.container.querySelectorAll('.m-styleguide__swatch');
        this.iconCards = this.container.querySelectorAll('.m-styleguide__icon-card');
        this.typoToggles = this.container.querySelectorAll('.m-styleguide__typo-toggle');
        this.form = this.container.querySelector('.m-styleguide__form-el');

        this.toastTimeout = null;

        this.copyCodeBtns = this.container.querySelectorAll('[data-copy-code]');

        this.init();
    }

    init() {
        this.bindSwatchCopy();
        this.bindIconCopy();
        this.bindTypoToggle();
        this.bindCodeCopy();
        this.bindFormValidation();
    }

    // =========================================================================
    // Color swatch click-to-copy
    // =========================================================================
    bindSwatchCopy() {
        this.swatches.forEach(swatch => {
            swatch.addEventListener('click', () => {
                const hex = swatch.getAttribute('data-color');
                if (hex) {
                    this.copyToClipboard(hex, `Copied: ${hex}`);
                }
            });
        });
    }

    // =========================================================================
    // Icon card click-to-copy
    // =========================================================================
    bindIconCopy() {
        this.iconCards.forEach(card => {
            card.addEventListener('click', () => {
                const iconClass = card.getAttribute('data-icon-class') || '';
                const phpReference = `<?php echo appian_get_svg_icon( '${iconClass}' ); ?>`;
                this.copyToClipboard(phpReference, `Copied PHP tag for ${iconClass}`);
            });
        });
    }

    // =========================================================================
    // Typography desktop/mobile toggle
    // =========================================================================
    bindTypoToggle() {
        this.typoToggles.forEach(btn => {
            btn.addEventListener('click', () => {
                const view = btn.getAttribute('data-view');

                this.typoToggles.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                if (view === 'mobile') {
                    this.container.classList.add('mobile-view');
                } else {
                    this.container.classList.remove('mobile-view');
                }
            });
        });
    }

    // =========================================================================
    // Code block click-to-copy
    // =========================================================================
    bindCodeCopy() {
        this.copyCodeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const codeBlock = btn.closest('.m-styleguide__demo-code');
                const codeEl = codeBlock ? codeBlock.querySelector('code') : null;
                if (codeEl) {
                    this.copyToClipboard(codeEl.textContent, 'Copied code!');
                }
            });
        });
    }

    // =========================================================================
    // Clipboard utility
    // =========================================================================
    copyToClipboard(text, message) {
        const done = () => this.showToast(message || `Copied: ${text}`);
        if (navigator.clipboard?.writeText) {
            navigator.clipboard.writeText(text).then(done).catch(() => this.fallbackCopy(text, done));
        } else {
            this.fallbackCopy(text, done);
        }
    }

    fallbackCopy(text, done) {
        const el = document.createElement('textarea');
        el.value = text;
        el.style.position = 'fixed';
        el.style.opacity = '0';
        document.body.appendChild(el);
        el.select();
        try { document.execCommand('copy'); } catch (e) { console.error('Copy failed:', e); }
        document.body.removeChild(el);
        done();
    }

    // =========================================================================
    // Toast notification
    // =========================================================================
    showToast(message) {
        if (!this.toast) return;
        this.toast.textContent = message;
        this.toast.classList.add('is-visible');

        if (this.toastTimeout) {
            clearTimeout(this.toastTimeout);
        }

        this.toastTimeout = setTimeout(() => {
            this.toast.classList.remove('is-visible');
        }, 2000);
    }

    bindFormValidation() {
        if (!this.form) return;

        const inputs = this.form.querySelectorAll('.m-styleguide__input, .m-styleguide__select');
        this.formSubmitted = false;

        const validateField = (input) => {
            const group = input.closest('.m-styleguide__input-group');
            const hasError = input.hasAttribute('required') && !input.value.trim();
            group?.classList.toggle('m-styleguide__input-group--error', hasError);
            return hasError;
        };

        inputs.forEach(input => {
            ['input', 'change', 'blur'].forEach(evt => {
                input.addEventListener(evt, () => this.formSubmitted && validateField(input));
            });
        });

        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.formSubmitted = true;
            const hasErrors = [...inputs].reduce((err, input) => validateField(input) || err, false);

            if (!hasErrors) {
                this.showToast('Form submitted successfully!');
                this.form.reset();
                this.formSubmitted = false;
                inputs.forEach(input => input.closest('.m-styleguide__input-group')?.classList.remove('m-styleguide__input-group--error'));
            } else {
                this.showToast('Please fill out all required fields.');
            }
        });
    }
}

// Initialize on DOM ready or immediately if already loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new Styleguide();
    });
} else {
    new Styleguide();
}

// Support ACF block preview re-renders
if (window.acf) {
    window.acf.addAction('render_block_preview/type=styleguide', () => {
        new Styleguide();
    });
}
