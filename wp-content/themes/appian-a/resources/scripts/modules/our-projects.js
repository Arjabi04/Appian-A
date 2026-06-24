import { initSectionDividerAnimation } from '../utils/section-divider.js';
import { Dropdown } from 'bootstrap';

function initOurProjects(container = document) {
    initSectionDividerAnimation(container);

    const sections = container.querySelectorAll('.our-projects');

    sections.forEach((section) => {
        const filterButtons = section.querySelectorAll('[data-project-filter]');
        const label = section.querySelector('[data-project-filter-label]');
        const cardsWrapper = section.querySelector('#our-projects-cards');
        const paginationWrapper = section.querySelector('#our-projects-pagination');
        const ajaxUrl = section.dataset.projectsAjaxUrl;
        const readMoreText = section.dataset.readMoreText || '';

        if (!cardsWrapper || !ajaxUrl) return;

        let currentFilter = 'all';

        // If the page was loaded with ?paged= in the URL (plain navigation),
        // scroll the module into view so the user lands at the top of the
        // cards grid rather than wherever the browser restored scroll to.
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('paged')) {
            section.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        // Keep the desktop active state matched with the current filter.
        const updateDesktopState = (currentFilter) => {
            section.querySelectorAll('.our-projects__filter').forEach((filterButton) => {
                filterButton.setAttribute(
                    'aria-selected',
                    filterButton.dataset.projectFilter === currentFilter ? 'true' : 'false'
                );
            });
        };

        const loadProjects = async (category, paged = 1) => {
            const formData = new FormData();
            formData.append('action', 'appian_filter_our_projects');
            formData.append('category', category);
            formData.append('paged', paged);
            formData.append('read_more_text', readMoreText);

            const response = await fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (!result?.success) return;

            cardsWrapper.innerHTML = result.data.cards;
            if (paginationWrapper) {
                paginationWrapper.innerHTML = result.data.pagination;
            }
            updateDesktopState(category);
            currentFilter = category;
        };

        filterButtons.forEach((button) => {
            button.onclick = async () => {
                const selectedFilter = button.dataset.projectFilter || 'all';

                if (label) {
                    label.textContent = button.textContent.trim();
                }

                await loadProjects(selectedFilter, 1);
            };
        });

        if (paginationWrapper) {
            paginationWrapper.addEventListener('click', async (event) => {
                const link = event.target.closest('.our-projects__page-link, .our-projects__page-arrow');
                if (!link || link.closest('.disabled')) return;

                event.preventDefault();

                const url = new URL(link.href, window.location.origin);
                const requestedPage = parseInt(url.searchParams.get('paged'), 10);
                if (!requestedPage) return;

                await loadProjects(currentFilter, requestedPage);

                section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }
    });

    const dropdownContainers = container.querySelectorAll('[data-project-filter-dropdown]');

    dropdownContainers.forEach((dropdownContainer) => {
        const toggle = dropdownContainer.querySelector('[data-bs-toggle="dropdown"]');
        const label = dropdownContainer.querySelector('[data-project-filter-label]');
        const items = dropdownContainer.querySelectorAll('.our-projects__dropdown-item');

        if (!toggle || !label || !items.length) return;

        const dropdownInstance = Dropdown.getOrCreateInstance(toggle);

        items.forEach((item) => {
            if (item._ourProjectsDropdownHandler) {
                item.removeEventListener('click', item._ourProjectsDropdownHandler);
            }

            const handleClick = () => {
                label.textContent = item.textContent.trim();
                dropdownInstance.hide();
            };

            item.addEventListener('click', handleClick);
            item._ourProjectsDropdownHandler = handleClick;
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initOurProjects(document));
} else {
    initOurProjects(document);
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=our-projects', () => initOurProjects(document));
}