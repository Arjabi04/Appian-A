import Swiper from 'swiper';
import { Navigation, FreeMode, Mousewheel } from 'swiper/modules';
import 'bootstrap/js/dist/modal';

function initOurHistoryDividerAnimation(context = document) {
    const dividers = context.querySelectorAll('.m-our-history__divider-wrap');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            // Reveal divider once 50% of it is visible
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    dividers.forEach((divider) => {
        divider.classList.add('is-ready');
        observer.observe(divider);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initOurHistoryDividerAnimation(document);

    let isPointer = false;
    document.addEventListener('pointerdown', () => {
        isPointer = true;
    }, { passive: true });
    document.addEventListener('keydown', () => {
        isPointer = false;
    }, { passive: true });

    document.addEventListener('focus', (event) => {
        const target = event.target;
        if (target && target.matches('[data-history-link]')) {
            if (isPointer) {
                target.classList.add('is-pointer-focus');
            } else {
                target.classList.remove('is-pointer-focus');
            }
        }
    }, true);

    document.addEventListener('blur', (event) => {
        const target = event.target;
        if (target && target.matches('[data-history-link]')) {
            target.classList.remove('is-pointer-focus');
        }
    }, true);

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
        const mediaQuery = window.matchMedia('(min-width: 768px)');

        const handleFocusIn = (e) => {
            const slide = e.target.closest('[data-history-slide]');
            if (slide && swiperInstance) {
                const slideIndex = Array.from(slides).indexOf(slide);
                if (slideIndex !== -1) {
                    swiperInstance.slideTo(slideIndex);
                }
            }
        };

        const handleScroll = (e) => {
            if (e.target && e.target.scrollLeft !== 0) {
                e.target.scrollLeft = 0;
            }
        };

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
            track.style.paddingLeft = '0';
            track.style.paddingRight = '0';

            swiperInstance = new Swiper(carousel, {
                modules: [Navigation, FreeMode, Mousewheel],
                slidesPerView: 'auto',
                spaceBetween: 150,
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

            carousel.addEventListener('focusin', handleFocusIn);
            carousel.addEventListener('scroll', handleScroll);
            parent.addEventListener('scroll', handleScroll);
            track.addEventListener('scroll', handleScroll);
        };

        const destroySwiper = () => {
            if (swiperInstance) {
                swiperInstance.destroy(true, true);
                swiperInstance = null;
            }
            track.style.paddingLeft = '';
            track.style.paddingRight = '';

            carousel.removeEventListener('focusin', handleFocusIn);
            carousel.removeEventListener('scroll', handleScroll);
            parent.removeEventListener('scroll', handleScroll);
            track.removeEventListener('scroll', handleScroll);

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

if (window.acf) {
    window.acf.addAction('render_block_preview/type=our-history', () => {
        initOurHistoryDividerAnimation(document);
    });
}
