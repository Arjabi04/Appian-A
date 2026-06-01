var _prevMotionQuery = null;
var _prevMotionChangeHandler = null;

function initLeadspace() {
    const section = document.querySelector('.leadspace');
    if (!section) return;

    const paths = section.querySelectorAll('.leadspace__arc-path');
    if (!paths.length) return;

    const video = section.querySelector('.leadspace__video');
    const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');


    const ARC_VIEWBOX = 2000;
    const ARC_CX = 1000;
    const ARC_R = 1018;
    const ARC_START_ANGLE = 140; // degrees, the left end of the drawn arc

    // Cached section position so getProgress() doesn't thrash layout on scroll.
    let sectionTop = 0;
    let sectionHeight = 0;
    function updateSectionMetrics() {
        const rect = section.getBoundingClientRect();
        sectionTop = rect.top + window.scrollY;
        sectionHeight = rect.height;
    }

    function visibilityFloor(arcWidth) {
        if (!(arcWidth > 0)) return 0.16;
        const visibleLeftEdge = (ARC_VIEWBOX / 2) * (1 - window.innerWidth / arcWidth); // viewBox x at screen x=0
        const tipX = visibleLeftEdge + 150;
        const cosT = Math.max(-1, Math.min(1, (tipX - ARC_CX) / ARC_R));
        const tipAngle = Math.acos(cosT) * 180 / Math.PI;
        const sweepRad = Math.max(0, ARC_START_ANGLE - tipAngle) * Math.PI / 180;
        const sweepLen = sweepRad * ARC_R; // user units
        return sweepLen / (Math.PI * ARC_R * (100 / 180)); // ÷ full ~100deg arc length
    }

    function updateArcMetrics() {
        updateSectionMetrics();
        const arc = section.querySelector('.leadspace__arc');
        // SVG user-units -> rendered screen px. The arc element is max(2000px,
        // 138.888vw), so above 1440px the SVG is scaled up (scale > 1).
        const arcWidth = arc ? arc.getBoundingClientRect().width : ARC_VIEWBOX;
        const scale = (arcWidth > 0 ? arcWidth : ARC_VIEWBOX) / ARC_VIEWBOX;
        const floor = visibilityFloor(arcWidth);

        paths.forEach(path => {
            let totalLength;
            try {
                totalLength = path.getTotalLength();
            } catch (e) {
                totalLength = 0;
            }
            if (!(totalLength > 0)) totalLength = 1800;

            const cssStart = parseFloat(getComputedStyle(path).getPropertyValue('--arc-start')) || 0.162;
            const arcStart = Math.min(0.7, Math.max(cssStart, floor));

            path._dash = totalLength * scale;
            path._arcStart = arcStart;
            path.style.strokeDasharray = path._dash;
        });
    }

    function getProgress() {
        if (sectionHeight <= 0) return 0;
        const scrolled = window.scrollY - sectionTop;
        return Math.min(1, Math.max(0, scrolled / sectionHeight));
    }

    let ticking = false;
    function onScroll() {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(function () {
            const progress = getProgress();
            paths.forEach(path => {
                const dash = path._dash || 1800;
                const arcStart = path._arcStart !== undefined ? path._arcStart : 0.162;
                path.style.strokeDashoffset = dash * (1 - arcStart) * (1 - progress);
            });
            ticking = false;
        });
    }

    function onResize() {
        updateArcMetrics();
        onScroll();
    }

    function applyMotionPreference(matches) {
        if (matches) {
            if (video) video.pause();
            window.removeEventListener('scroll', onScroll);
            window.removeEventListener('resize', onResize);
            // Reduced motion: draw the rim fully (no scroll-driven growth).
            updateArcMetrics();
            paths.forEach(path => { path.style.strokeDashoffset = 0; });
        } else {
            if (video) video.play().catch(function () { });
            updateArcMetrics();
            onScroll();
            window.removeEventListener('scroll', onScroll);
            window.removeEventListener('resize', onResize);
            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', onResize, { passive: true });
        }
    }

    function onMotionChange(e) {
        applyMotionPreference(e.matches);
    }

    applyMotionPreference(motionQuery.matches);

    if (_prevMotionQuery && _prevMotionChangeHandler) {
        _prevMotionQuery.removeEventListener('change', _prevMotionChangeHandler);
    }
    _prevMotionQuery = motionQuery;
    _prevMotionChangeHandler = onMotionChange;
    motionQuery.addEventListener('change', onMotionChange);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLeadspace);
} else {
    initLeadspace();
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=leadspace', initLeadspace);
}
