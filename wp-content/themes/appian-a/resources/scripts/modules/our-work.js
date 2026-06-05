import { initSectionDividerAnimation } from '../utils/section-divider.js';

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initSectionDividerAnimation(document));
} else {
    initSectionDividerAnimation(document);
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=our-work', () => initSectionDividerAnimation(document));
}
