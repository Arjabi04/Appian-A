export function initSectionDividerAnimation(context = document) {
    const elements = context.querySelectorAll('[data-section-divider]:not(.is-ready)');
    if (!elements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.5 });

    elements.forEach((element) => {
        element.classList.add('is-ready');
        observer.observe(element);
    });
}
