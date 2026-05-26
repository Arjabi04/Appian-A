const toggleBtn = document.querySelector(".site-header__mobile-toggle");
const nav = document.querySelector(".site-header__nav");
const header = document.querySelector(".site-header");

if (toggleBtn && nav && header) {
    const dropdownButtons = nav.querySelectorAll(".site-header__menu-button");
    const DESKTOP_BREAKPOINT_PX = 1200;
    const closeOtherDropdowns = (currentItem) => {
        nav.querySelectorAll(".site-header__menu-item--open").forEach((item) => {
            if (item === currentItem) return;
            item.classList.remove("site-header__menu-item--open");
            const btn = item.querySelector(".site-header__menu-button");
            if (btn) btn.setAttribute("aria-expanded", "false");
        });
    };

    let lockedScrollY = 0;

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

    function lockBodyScroll() {
        lockedScrollY = window.scrollY;
        document.body.classList.add("site-header-menu-open");
        document.body.style.position = "fixed";
        document.body.style.top = `-${lockedScrollY}px`;
        document.body.style.left = "0";
        document.body.style.right = "0";
        document.body.style.width = "100%";
    }

    function unlockBodyScroll() {
        document.body.classList.remove("site-header-menu-open");
        document.body.style.position = "";
        document.body.style.top = "";
        document.body.style.left = "";
        document.body.style.right = "";
        document.body.style.width = "";
        window.scrollTo(0, lockedScrollY);
    }

    function setMenuOpen(isOpen) {
        nav.classList.toggle("site-header__nav--mobile-active", isOpen);
        header.classList.toggle("site-header--menu-open", isOpen);
        toggleBtn.setAttribute("aria-expanded", String(isOpen));
        toggleBtn.setAttribute("aria-label", isOpen ? "Close navigation menu" : "Open navigation menu");

        if (isOpen) {
            lockBodyScroll();
        } else {
            unlockBodyScroll();

            // Close any open dropdown accordions (mobile).
            nav.querySelectorAll(".site-header__menu-item--open").forEach((item) => {
                item.classList.remove("site-header__menu-item--open");
            });
            dropdownButtons.forEach((button) => button.setAttribute("aria-expanded", "false"));
        }
    }

    function toggleMenu() {
        const isOpen = nav.classList.contains("site-header__nav--mobile-active");
        setMenuOpen(!isOpen);
    }

    // Throttled Mobile Menu Toggle
    toggleBtn.addEventListener("click", throttle(toggleMenu));

    // Ensure mobile menu state never leaks into desktop layout.
    window.addEventListener("resize", throttle(() => {
        if (window.innerWidth >= DESKTOP_BREAKPOINT_PX) {
            setMenuOpen(false);
        }
    }, 200));

    // Close on Escape.
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && nav.classList.contains("site-header__nav--mobile-active")) {
            setMenuOpen(false);
        }
    });

    //  Throttled Accordion Dropdowns
    dropdownButtons.forEach((button) => {
        button.addEventListener("click", throttle(() => {
            // Desktop dropdowns are hover/focus driven only.
            if (window.innerWidth >= DESKTOP_BREAKPOINT_PX) {
                return;
            }
            const parentItem = button.closest(".site-header__menu-item");
            closeOtherDropdowns(parentItem);
            const isOpen = parentItem.classList.toggle("site-header__menu-item--open");
            button.setAttribute("aria-expanded", String(isOpen));
        }));
    });
}
