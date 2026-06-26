const lazyImages = document.querySelectorAll('[loading="lazy"]');
const animatedImages = document.querySelectorAll('.js-animate-image');

export function initLazyLoadImages() {
    lazyImages.forEach((image) => {
        if (image.complete) {
            image.classList.add('is-loaded');
            return;
        }

        image.addEventListener('load', () => image.classList.add('is-loaded'), { once: true });
    });
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
