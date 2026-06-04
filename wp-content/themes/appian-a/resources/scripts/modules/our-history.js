document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('[data-history-carousel]');

    carousels.forEach((carousel) => {
        const track = carousel.querySelector('[data-history-track]');
        const parent = carousel.closest('.m-our-history');
        if (!parent) return;

        const btnLeft = parent.querySelector('[data-history-btn-left]');
        const btnRight = parent.querySelector('[data-history-btn-right]');
        const slides = carousel.querySelectorAll('[data-history-slide]');

        if (!track || slides.length === 0) return;

        // Helper to get scroll step based on the slide size
        const getScrollStep = () => {
            if (slides.length > 0) {
                // Return the bounding client rect width of a slide, which naturally includes the card and gap/divider margins
                return slides[0].getBoundingClientRect().width;
            }
            return 551; // Fallback desktop width
        };

        const updateButtons = () => {
            if (!btnLeft || !btnRight) return;
            const scrollLeft = carousel.scrollLeft;
            const maxScroll = carousel.scrollWidth - carousel.clientWidth;

            if (scrollLeft <= 5) {
                btnLeft.setAttribute('disabled', 'true');
            } else {
                btnLeft.removeAttribute('disabled');
            }

            if (scrollLeft >= maxScroll - 5) {
                btnRight.setAttribute('disabled', 'true');
            } else {
                btnRight.removeAttribute('disabled');
            }
        };

        if (btnLeft) {
            btnLeft.addEventListener('click', () => {
                const step = getScrollStep();
                carousel.scrollBy({ left: -step, behavior: 'smooth' });
            });
        }

        if (btnRight) {
            btnRight.addEventListener('click', () => {
                const step = getScrollStep();
                carousel.scrollBy({ left: step, behavior: 'smooth' });
            });
        }

        carousel.addEventListener('scroll', updateButtons);
        updateButtons();

        window.addEventListener('resize', updateButtons);
    });

    // Popup Modal
    const popup = document.getElementById('our-history-popup');
    if (popup) {
        const closeButtons = popup.querySelectorAll('[data-popup-close]');
        const popupYear = popup.querySelector('.m-our-history-popup__year');
        const popupImage = popup.querySelector('.m-our-history-popup__image');
        const popupDescWrapper = popup.querySelector('.m-our-history-popup__description-wrapper');
        let activeTrigger = null;

        const openPopup = (trigger) => {
            activeTrigger = trigger;
            const year = trigger.getAttribute('data-popup-year');
            const imageSrc = trigger.getAttribute('data-popup-image');
            const imageAlt = trigger.getAttribute('data-popup-image-alt') || '';
            const desc = trigger.getAttribute('data-popup-desc') || '';

            if (popupYear) popupYear.textContent = year;
            if (popupImage) {
                popupImage.src = imageSrc;
                popupImage.alt = imageAlt;
            }

            if (popupDescWrapper) {
                popupDescWrapper.innerHTML = '';
                // Split paragraphs by double newlines to display as separate paragraph tags
                const paragraphs = desc.split(/\n\s*\n/);
                paragraphs.forEach((pText) => {
                    const cleanText = pText.trim();
                    if (cleanText) {
                        const p = document.createElement('p');
                        p.textContent = cleanText;
                        popupDescWrapper.appendChild(p);
                    }
                });
            }

            document.body.classList.add('m-our-history-popup-open');
            popup.setAttribute('aria-hidden', 'false');

            const closeBtn = popup.querySelector('.m-our-history-popup__close');
            if (closeBtn) {
                closeBtn.focus();
            }
        };

        const closePopup = () => {
            document.body.classList.remove('m-our-history-popup-open');
            popup.setAttribute('aria-hidden', 'true');
            if (activeTrigger) {
                activeTrigger.focus();
                activeTrigger = null;
            }
        };

        document.querySelectorAll('[data-history-link]').forEach((link) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                openPopup(link);
            });
        });

        closeButtons.forEach((btn) => {
            btn.addEventListener('click', (e) => {

                if (btn.classList.contains('m-our-history-popup__overlay') && e.target !== btn) {
                    return;
                }
                e.preventDefault();
                closePopup();
            });
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && document.body.classList.contains('m-our-history-popup-open')) {
                closePopup();
            }
        });

        popup.addEventListener('keydown', (e) => {
            if (e.key !== 'Tab') return;

            const focusables = popup.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            if (focusables.length === 0) return;

            const firstFocusable = focusables[0];
            const lastFocusable = focusables[focusables.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusable) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        });
    }
});
