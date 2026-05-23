const toggleBtn = document.querySelector(".site-header__mobile-toggle");
const nav = document.querySelector(".site-header__nav");
const header = document.querySelector(".site-header");
const dropdownButtons = document.querySelectorAll(".site-header__menu-button");

// throttle helper func
function throttle(func, limit = 300) {
    let inThrottle = false;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Throttled Mobile Menu Toggle
toggleBtn.addEventListener("click", throttle(() => {
    const isOpen = nav.classList.toggle("site-header__nav--mobile-active");
    header.classList.toggle("site-header--menu-open", isOpen);

    toggleBtn.setAttribute("aria-expanded", String(isOpen));
    toggleBtn.setAttribute("aria-label", isOpen ? "Close navigation menu" : "Open navigation menu");
}));

//  Throttled Accordion Dropdowns
dropdownButtons.forEach((button) => {
    button.addEventListener("click", throttle(() => {
        const parentItem = button.closest(".site-header__menu-item");
        const isOpen = parentItem.classList.toggle("site-header__menu-item--open");
        button.setAttribute("aria-expanded", String(isOpen));
    }));
});