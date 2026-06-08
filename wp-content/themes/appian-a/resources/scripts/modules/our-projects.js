import { initSectionDividerAnimation } from '../utils/section-divider.js';
import { Dropdown } from 'bootstrap';

function initOurProjects(container = document) {
    initSectionDividerAnimation(container);

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
