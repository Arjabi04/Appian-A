function initLeadspace() {
    const section = document.querySelector('.leadspace');
    if (!section) return;

    const paths = section.querySelectorAll('.leadspace__arc-path');
    if (!paths.length) return;

    function updatePathLengths() {
        paths.forEach(path => {
            try {
                const totalLength = path.getTotalLength();
                if (totalLength > 0) {
                    path.style.setProperty('--arc-length', totalLength);
                } else {
                    path.style.setProperty('--arc-length', '1800');
                }
            } catch (e) {
                // Handle case where path is hidden or not rendered yet
                path.style.setProperty('--arc-length', '300');
            }
        });
    }

    function getProgress() {
        const rect = section.getBoundingClientRect();
        const sectionHeight = rect.height;
        // scrolled is how far the top of the section has scrolled past the top of the viewport
        const scrolled = -rect.top;
        return Math.min(1, Math.max(0, scrolled / sectionHeight));
    }

    let ticking = false;
    function onScroll() {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(function () {
            const progress = getProgress();
            paths.forEach(path => {
                path.style.setProperty('--arc-progress', progress);
            });
            ticking = false;
        });
    }

    function onResize() {
        updatePathLengths();
        onScroll();
    }

    // Initial setup
    updatePathLengths();
    onScroll();

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onResize, { passive: true });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLeadspace);
} else {
    initLeadspace();
}

// ACF block preview support
if (window.acf) {
    window.acf.addAction('render_block_preview/type=leadspace', initLeadspace);
}
