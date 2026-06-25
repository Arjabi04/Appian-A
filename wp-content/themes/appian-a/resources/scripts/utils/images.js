const lazyImages = document.querySelectorAll('.js-lazy-image');
const animatedImages = document.querySelectorAll('.js-animate-image');

export function initLazyLoadImages() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(({ isIntersecting, target }) => {
            if (!isIntersecting) return;

            if (target.complete) {
                target.classList.add('is-loaded');
            } else {
                target.addEventListener('load', () => target.classList.add('is-loaded'), { once: true });
            }

            observer.unobserve(target);
        });
    });

    lazyImages.forEach((image) => observer.observe(image));
}

export function initImageAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(({ isIntersecting, target }) => {
            if (!isIntersecting) return;

            const show = () => target.classList.add('is-visible');

            if (target.complete) {
                show();
            } else {
                target.addEventListener('load', show, { once: true });
            }

            observer.unobserve(target);
        });
    });

    animatedImages.forEach((image) => observer.observe(image));
}