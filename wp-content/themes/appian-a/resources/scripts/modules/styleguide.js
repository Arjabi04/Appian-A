// Side-effect import — registers Bootstrap's collapse data-api listeners.
import 'bootstrap/js/dist/collapse';

class Styleguide {
    constructor() {
        this.container = document.querySelector('.m-styleguide');
        if (!this.container) return;

        this.sidebar = this.container.querySelector('.m-styleguide__sidebar');
        this.main = this.container.querySelector('.m-styleguide__main');
        this.toast = this.container.querySelector('.m-styleguide__toast');
        this.navLinks = this.container.querySelectorAll('.m-styleguide__nav-link');
        this.sections = this.container.querySelectorAll('.m-styleguide__section');
        this.swatches = this.container.querySelectorAll('.m-styleguide__swatch');
        this.iconCards = this.container.querySelectorAll('.m-styleguide__icon-card');
        this.typoToggles = this.container.querySelectorAll('.m-styleguide__typo-toggle');
        this.mobileToggle = this.container.querySelector('.m-styleguide__mobile-toggle');
        this.form = this.container.querySelector('.m-styleguide__form-el');

        this.toastTimeout = null;
        this.activeLink = null;

        this.copyCodeBtns = this.container.querySelectorAll('[data-copy-code]');

        this.init();
    }

    init() {
        this.bindSmoothScroll();
        this.bindSwatchCopy();
        this.bindIconCopy();
        this.bindTypoToggle();
        this.bindMobileToggle();
        this.bindCodeCopy();
        this.initScrollSpy();
        this.bindFormValidation();
    }

    // =========================================================================
    // Smooth scroll for sidebar nav links
    // =========================================================================
    bindSmoothScroll() {
        this.navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                if (!target) return;

                target.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Close mobile sidebar if open
                if (this.sidebar && this.sidebar.classList.contains('is-open')) {
                    this.sidebar.classList.remove('is-open');
                }
            });
        });
    }

    // =========================================================================
    // Scroll spy using IntersectionObserver
    // =========================================================================
    initScrollSpy() {
        if (!this.sections.length || !this.navLinks.length) return;

        const options = {
            root: null,
            rootMargin: '-20% 0px -60% 0px',
            threshold: 0,
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    this.setActiveNavLink(id);
                }
            });
        }, options);

        this.sections.forEach(section => observer.observe(section));
    }

    setActiveNavLink(sectionId) {
        this.navLinks.forEach(link => {
            const href = link.getAttribute('href').substring(1);
            if (href === sectionId) {
                link.classList.add('is-active');
            } else {
                link.classList.remove('is-active');
            }
        });
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
                const iEl = card.querySelector('.m-styleguide__icon-svg i');
                if (iEl) {
                    const markup = `<i class="${iconClass}"></i>`;
                    this.copyToClipboard(markup, `Copied: ${iconClass}`);
                } else {
                    const svgEl = card.querySelector('.m-styleguide__icon-svg svg');
                    if (svgEl) {
                        this.copyToClipboard(svgEl.outerHTML, `Copied: ${iconClass}`);
                    }
                }
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
    // Mobile sidebar toggle
    // =========================================================================
    bindMobileToggle() {
        if (!this.mobileToggle || !this.sidebar) return;

        this.mobileToggle.addEventListener('click', () => {
            this.sidebar.classList.toggle('is-open');
        });

        // Close sidebar on click outside
        document.addEventListener('click', (e) => {
            if (
                this.sidebar.classList.contains('is-open') &&
                !this.sidebar.contains(e.target) &&
                !this.mobileToggle.contains(e.target)
            ) {
                this.sidebar.classList.remove('is-open');
            }
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

    // Accordion toggling is handled natively by Bootstrap 5 collapse component.

    // =========================================================================
    // Clipboard utility
    // =========================================================================
    copyToClipboard(text, message) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => {
                this.showToast(message || `Copied: ${text}`);
            }).catch(() => {
                this.fallbackCopy(text, message);
            });
        } else {
            this.fallbackCopy(text, message);
        }
    }

    fallbackCopy(text, message) {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        try {
            document.execCommand('copy');
            this.showToast(message || `Copied: ${text}`);
        } catch (err) {
            console.error('Copy failed:', err);
        }
        document.body.removeChild(textarea);
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
            if (!group) return false;

            const isRequired = input.hasAttribute('required');
            const isEmpty = !input.value.trim();

            if (isRequired && isEmpty) {
                group.classList.add('m-styleguide__input-group--error');
                return true;
            } else {
                group.classList.remove('m-styleguide__input-group--error');
                return false;
            }
        };

        // Handle typing/changing input to update error status in real time
        inputs.forEach(input => {
            const handleUpdate = () => {
                if (this.formSubmitted) {
                    validateField(input);
                }
            };
            input.addEventListener('input', handleUpdate);
            input.addEventListener('change', handleUpdate);
            input.addEventListener('blur', handleUpdate);
        });

        // Handle form submission
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.formSubmitted = true;
            let hasErrors = false;

            inputs.forEach(input => {
                if (validateField(input)) {
                    hasErrors = true;
                }
            });

            if (!hasErrors) {
                this.showToast('Form submitted successfully!');
                this.form.reset();
                this.formSubmitted = false;
                // Remove all error classes after reset
                inputs.forEach(input => {
                    const group = input.closest('.m-styleguide__input-group');
                    if (group) {
                        group.classList.remove('m-styleguide__input-group--error');
                    }
                });
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
