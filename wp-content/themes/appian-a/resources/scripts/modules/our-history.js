import Swiper from 'swiper';
import { Navigation, FreeMode, Mousewheel } from 'swiper/modules';
import 'bootstrap/js/dist/modal';

document.addEventListener('DOMContentLoaded', () => {
    const carousels = document.querySelectorAll('[data-history-carousel]');

    carousels.forEach((carousel) => {
        const parent = carousel.closest('.m-our-history');
        if (!parent) return;

        const btnLeft = parent.querySelector('[data-history-btn-left]');
        const btnRight = parent.querySelector('[data-history-btn-right]');
        const track = carousel.querySelector('[data-history-track]');
        const slides = carousel.querySelectorAll('[data-history-slide]');

        if (!track || slides.length === 0) return;

        let swiperInstance = null;
        const mediaQuery = window.matchMedia('(min-width: 992px)');

        const updateButtons = (swiper) => {
            if (!btnLeft || !btnRight) return;
            if (swiper.isBeginning) {
                btnLeft.setAttribute('disabled', 'true');
            } else {
                btnLeft.removeAttribute('disabled');
            }

            if (swiper.isEnd) {
                btnRight.setAttribute('disabled', 'true');
            } else {
                btnRight.removeAttribute('disabled');
            }
        };

        const initSwiper = () => {
            const paddingLeft = parseFloat(window.getComputedStyle(track).paddingLeft) || 0;

            // Remove padding from track so Swiper's slidesOffset coordinates are correct
            track.style.paddingLeft = '0';
            track.style.paddingRight = '0';

            swiperInstance = new Swiper(carousel, {
                modules: [Navigation, FreeMode, Mousewheel],
                slidesPerView: 'auto',
                grabCursor: true,
                freeMode: {
                    enabled: true,
                    momentum: true,
                    momentumBounce: false,
                },
                mousewheel: {
                    forceToAxis: true,
                },
                slidesOffsetBefore: paddingLeft,
                slidesOffsetAfter: paddingLeft,
                wrapperClass: 'm-our-history__track',
                slideClass: 'm-our-history__slide',
                navigation: {
                    nextEl: btnRight,
                    prevEl: btnLeft,
                },
                on: {
                    init: function () {
                        updateButtons(this);
                    },
                    slideChange: function () {
                        updateButtons(this);
                    },
                    reachBeginning: function () {
                        updateButtons(this);
                    },
                    reachEnd: function () {
                        updateButtons(this);
                    }
                }
            });
        };

        const destroySwiper = () => {
            if (swiperInstance) {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
            }
            // Restore track CSS paddings
            track.style.paddingLeft = '';
            track.style.paddingRight = '';

            if (btnLeft) btnLeft.removeAttribute('disabled');
            if (btnRight) btnRight.removeAttribute('disabled');
        };

        const handleDeviceChange = (e) => {
            if (e.matches) {
                initSwiper();
            } else {
                destroySwiper();
            }
        };

        handleDeviceChange(mediaQuery);
        mediaQuery.addEventListener('change', handleDeviceChange);
    });

    // Popup Modal
    const popup = document.getElementById('our-history-popup');
    if (popup) {
        popup.addEventListener('show.bs.modal', (event) => {
            const trigger = event.relatedTarget;
            if (!trigger) return;

            const year = trigger.getAttribute('data-popup-year');
            const imageSrc = trigger.getAttribute('data-popup-image');
            const imageAlt = trigger.getAttribute('data-popup-image-alt') || '';
            const desc = trigger.getAttribute('data-popup-desc') || '';

            const popupYear = popup.querySelector('.m-our-history-popup__year');
            const popupImage = popup.querySelector('.m-our-history-popup__image');
            const popupDescWrapper = popup.querySelector('.m-our-history-popup__description-wrapper');

            if (popupYear) popupYear.textContent = year;
            if (popupImage) {
                popupImage.src = imageSrc;
                popupImage.alt = imageAlt;
            }

            if (popupDescWrapper) {
                popupDescWrapper.innerHTML = '';
                // Spliting paragraphs by double newlines to display as separate paragraph tags
                const paragraphs = desc.split(/\n\s*\n/);
                paragraphs.forEach((pText) => {
                    const cleanText = pText.trim();
                    if (cleanText) {
                        const p = document.createElement('p');
                        p.classList.add('m-0', 'body');
                        p.textContent = cleanText;
                        popupDescWrapper.appendChild(p);
                    }
                });
            }
        });
    }
});
