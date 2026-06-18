import { initSectionDividerAnimation } from '../utils/section-divider.js';

function initFaqProcess(context = document) {
    initSectionDividerAnimation(context);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initFaqProcess(document));
} else {
    initFaqProcess(document);
}

// ACF block preview support
if (window.acf) {
    window.acf.addAction('render_block_preview/type=faq', () => initFaqProcess(document));
}
