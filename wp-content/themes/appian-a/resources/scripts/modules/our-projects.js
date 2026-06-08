import { initSectionDividerAnimation } from '../utils/section-divider.js';

function initOurProjects(container = document) {
    initSectionDividerAnimation(container);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initOurProjects(document));
} else {
    initOurProjects(document);
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=our-projects', () => initOurProjects(document));
}
