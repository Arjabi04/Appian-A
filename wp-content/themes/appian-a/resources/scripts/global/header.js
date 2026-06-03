const toggleBtn = document.querySelector(".site-header__mobile-toggle");
const nav = document.querySelector(".site-header__nav");
const header = document.querySelector(".site-header");

if (toggleBtn && nav && header) {
    const navScroll = nav.querySelector(".site-header__nav-scroll");
    const menu = nav.querySelector(".site-header__menu");
    const dropdownButtons = nav.querySelectorAll(".site-header__menu-button");
    const dropdownHoverItems = nav.querySelectorAll(".site-header__menu-item--dropdown");
    const DESKTOP_BREAKPOINT_PX = 1200;
    const HEADER_SCROLL_DELTA_PX = 8;
    const HEADER_TOP_OFFSET_PX = 20;
    const MIN_DESKTOP_MENU_GAP_PX = 6;
    const MIN_DESKTOP_MENU_FONT_SIZE_PX = 10;

    const closeOtherDropdowns = (currentItem) => {
        nav.querySelectorAll(".site-header__menu-item--open").forEach((item) => {
            if (item === currentItem) return;
            item.classList.remove("site-header__menu-item--open");
            const btn = item.querySelector(".site-header__menu-button");
            if (btn) btn.setAttribute("aria-expanded", "false");
        });
    };

    let lockedScrollY = 0;
    let lastScrollY = window.scrollY;
    let isScrollTicking = false;
    let isNavFitTicking = false;

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
        header.classList.remove("site-header--hidden");
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

    function resetDesktopNavFit() {
        header.style.removeProperty("--site-header-menu-gap");
        header.style.removeProperty("--site-header-menu-font-size");

        if (navScroll) {
            navScroll.style.maxWidth = "";
        }
    }

    function getDesktopMenuWidth(gap) {
        const menuItems = Array.from(menu.children);
        const menuItemsWidth = menuItems.reduce((totalWidth, item) => {
            return totalWidth + item.getBoundingClientRect().width;
        }, 0);

        return menuItemsWidth + (Math.max(menuItems.length - 1, 0) * gap);
    }

    function fitDesktopNav() {
        if (!navScroll || !menu || window.innerWidth < DESKTOP_BREAKPOINT_PX) {
            resetDesktopNavFit();
            isNavFitTicking = false;
            return;
        }

        resetDesktopNavFit();

        // Keep the nav-scroll area inside the real grid column so it never covers the emergency contact.
        const availableWidth = Math.floor(nav.getBoundingClientRect().width);
        if (availableWidth <= 0) {
            resetDesktopNavFit();
            isNavFitTicking = false;
            return;
        }

        navScroll.style.maxWidth = `${availableWidth}px`;

        const menuStyles = window.getComputedStyle(menu);
        const firstMenuControl = menu.querySelector(".site-header__menu-link, .site-header__menu-button");
        const controlStyles = firstMenuControl ? window.getComputedStyle(firstMenuControl) : null;
        const startingGap = parseFloat(menuStyles.columnGap || menuStyles.gap) || 40;
        const startingFontSize = controlStyles ? parseFloat(controlStyles.fontSize) || 16 : 16;
        let gap = startingGap;
        let fontSize = startingFontSize;

        header.style.setProperty("--site-header-menu-gap", `${gap}px`);
        header.style.setProperty("--site-header-menu-font-size", `${fontSize}px`);

        // First tighten only the gap, then the font. This keeps the menu inside its grid column and away from contact.
        while (gap > MIN_DESKTOP_MENU_GAP_PX && getDesktopMenuWidth(gap) > availableWidth) {
            gap = Math.max(MIN_DESKTOP_MENU_GAP_PX, gap - 2);
            header.style.setProperty("--site-header-menu-gap", `${gap}px`);
        }

        while (fontSize > MIN_DESKTOP_MENU_FONT_SIZE_PX && getDesktopMenuWidth(gap) > availableWidth) {
            fontSize = Math.max(MIN_DESKTOP_MENU_FONT_SIZE_PX, fontSize - 0.5);
            header.style.setProperty("--site-header-menu-font-size", `${fontSize}px`);
        }

        isNavFitTicking = false;
    }

    function queueDesktopNavFit() {
        if (isNavFitTicking) return;
        isNavFitTicking = true;
        window.requestAnimationFrame(fitDesktopNav);
    }

    function syncHeaderVisibility() {
        const currentScrollY = Math.max(window.scrollY, 0);
        const scrollDifference = currentScrollY - lastScrollY;
        const isMenuOpen = nav.classList.contains("site-header__nav--mobile-active");

        // Always keep the navbar visible at the top of the page and while the hamburger is open.
        if (isMenuOpen || currentScrollY <= HEADER_TOP_OFFSET_PX) {
            header.classList.remove("site-header--hidden");
        } else if (scrollDifference > HEADER_SCROLL_DELTA_PX) {
            // Hide the navbar while scrolling down so it moves with the page content.
            header.classList.add("site-header--hidden");
        } else if (scrollDifference < -HEADER_SCROLL_DELTA_PX) {
            // Bring the navbar back as soon as the user starts scrolling up.
            header.classList.remove("site-header--hidden");
        }

        lastScrollY = currentScrollY;
        isScrollTicking = false;
    }

    // Throttled Mobile Menu Toggle
    toggleBtn.addEventListener("click", throttle(toggleMenu));
    queueDesktopNavFit();

    // Use requestAnimationFrame so scroll changes do not fight the hamburger layout.
    window.addEventListener("scroll", () => {
        if (isScrollTicking) return;
        isScrollTicking = true;
        window.requestAnimationFrame(syncHeaderVisibility);
    }, { passive: true });

    // Ensure mobile menu state never leaks into desktop layout.
    window.addEventListener("resize", throttle(() => {
        queueDesktopNavFit();

        if (window.innerWidth >= DESKTOP_BREAKPOINT_PX && nav.classList.contains("site-header__nav--mobile-active")) {
            setMenuOpen(false);
        }
    }, 200));

    if ("ResizeObserver" in window) {
        const headerResizeObserver = new ResizeObserver(queueDesktopNavFit);
        headerResizeObserver.observe(header);
    }

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

    // Desktop-only: show overlay while hovering a dropdown parent item.
    let overlay = document.getElementById("site-header-overlay");
    if (!overlay) {
        overlay = document.createElement("div");
        overlay.id = "site-header-overlay";
        overlay.setAttribute("aria-hidden", "true");
        // Insert after the header so the overlay starts below it and inherits header CSS vars if needed.
        header.insertAdjacentElement("afterend", overlay);
    }

    const setOverlayOpen = (isOpen) => {
        if (window.innerWidth < DESKTOP_BREAKPOINT_PX) {
            overlay.classList.remove("is-active");
            return;
        }
        overlay.classList.toggle("is-active", Boolean(isOpen));
    };

    const syncOverlayState = () => {
        if (window.innerWidth < DESKTOP_BREAKPOINT_PX) {
            setOverlayOpen(false);
            return;
        }

        const hasActiveDropdown =
            Boolean(nav.querySelector(".site-header__menu-item--dropdown:hover")) ||
            Boolean(nav.querySelector(".site-header__menu-item--dropdown:focus-within"));

        setOverlayOpen(hasActiveDropdown);
    };

    dropdownHoverItems.forEach((item) => {
        item.addEventListener("mouseenter", syncOverlayState);
        item.addEventListener("mouseleave", syncOverlayState);
        item.addEventListener("focusin", syncOverlayState);
        item.addEventListener("focusout", () => {
            // Delay so `document.activeElement` is updated before we re-check `:focus-within`.
            setTimeout(syncOverlayState, 0);
        });
    });

    window.addEventListener("resize", throttle(() => setOverlayOpen(false), 200));
}
