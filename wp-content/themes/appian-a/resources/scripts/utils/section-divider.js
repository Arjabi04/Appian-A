// reusable section divider animation 
export function initRevealOnIntersect(selector, context = document, options = {}) {
    const elements = context.querySelectorAll(selector);

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: options.threshold || 0.5 });

    elements.forEach((element) => {
        element.classList.add('is-ready');
        observer.observe(element);
    });
}