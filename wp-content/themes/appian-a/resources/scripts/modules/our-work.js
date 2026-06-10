import { initSectionDividerAnimation } from '../utils/section-divider.js';

function initOurWorkTabs(container = document) {
    const tabLinks = container.querySelectorAll('.our-work__nav .nav-link');
    const contentPanels = container.querySelectorAll('.our-work__desktop .our-work__content');

    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            tabLinks.forEach(l => {
                l.classList.remove('active');
                l.removeAttribute('aria-current');
                const navItem = l.querySelector('.our-work__nav-item');
                if (navItem) {
                    navItem.classList.remove('our-work__nav-item--active');
                }
            });

            this.classList.add('active');
            this.setAttribute('aria-current', 'page');
            const navItem = this.querySelector('.our-work__nav-item');
            if (navItem) {
                navItem.classList.add('our-work__nav-item--active');
            }

            const targetSelector = this.getAttribute('data-bs-target');
            contentPanels.forEach(panel => {
                if ('#' + panel.id === targetSelector) {
                    panel.classList.remove('d-none');
                    panel.classList.add('d-flex');
                } else {
                    panel.classList.remove('d-flex');
                    panel.classList.add('d-none');
                }
            });
        });
    });

    const accordion = container.querySelector('#ourWorkAccordion');
    if (accordion) {
        accordion.addEventListener('show.bs.collapse', function(e) {
            const card = e.target.closest('.our-work__card');
            if (card) {
                card.classList.add('our-work__card--active');
            }
        });
        accordion.addEventListener('hide.bs.collapse', function(e) {
            const card = e.target.closest('.our-work__card');
            if (card) {
                card.classList.remove('our-work__card--active');
            }
        });
    }
}

function initAll(container = document) {
    initSectionDividerAnimation(container);
    initOurWorkTabs(container);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initAll(document));
} else {
    initAll(document);
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=our-work', () => initAll(document));
}
