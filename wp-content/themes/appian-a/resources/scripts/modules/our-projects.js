import { initSectionDividerAnimation } from '../utils/section-divider.js';
import { Dropdown } from 'bootstrap';

function initOurProjects(container = document) {
    initSectionDividerAnimation(container);

    const sections = container.querySelectorAll('.our-projects');

    sections.forEach((section) => {
        const filterButtons = section.querySelectorAll('[data-project-filter]');
        const label = section.querySelector('[data-project-filter-label]');
        const cardsWrapper = section.querySelector('#our-projects-cards');
        const ajaxUrl = section.dataset.projectsAjaxUrl;
        const readMoreText = section.dataset.readMoreText || '';

        if (!cardsWrapper || !ajaxUrl) return;

        // Keep the desktop active state matched with the current filter.
        const updateDesktopState = (currentFilter) => {
            section.querySelectorAll('.our-projects__filter').forEach((filterButton) => {
                filterButton.setAttribute(
                    'aria-selected',
                    filterButton.dataset.projectFilter === currentFilter ? 'true' : 'false'
                );
            });
        };

        const loadProjects = async (category) => {
            // Send the selected category to WordPress.
            const formData = new FormData();
            formData.append('action', 'appian_filter_our_projects');
            formData.append('category', category);
            formData.append('read_more_text', readMoreText);

            const response = await fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
            });

            const result = await response.json();

            if (!result?.success) return;

            // Replace the cards with the filtered HTML.
            cardsWrapper.innerHTML = result.data.cards;
            updateDesktopState(category);
        };

        filterButtons.forEach((button) => {
            button.onclick = async () => {
                const selectedFilter = button.dataset.projectFilter || 'all';

                if (label) {
                    label.textContent = button.textContent.trim();
                }

                await loadProjects(selectedFilter);
            };
        });
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
