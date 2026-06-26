var _prevMotionQuery = null;
var _prevMotionChangeHandler = null;

function initLeadspace() {
    const section = document.querySelector('.leadspace');
    if (!section) return;

    const paths = section.querySelectorAll('.leadspace__arc-path');
    if (!paths.length) return;

    const video = section.querySelector('video.leadspace__video');
    if (video) {
        if (!video.paused || video.readyState >= 2) {
            video.classList.add('is-playing');
        }
        video.addEventListener('loadeddata', () => {
            video.classList.add('is-playing');
        });
        video.addEventListener('playing', () => {
            video.classList.add('is-playing');
        });
    }
    const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');


    const ARC_VIEWBOX = 2000;
    const ARC_CX = 1000;
    const ARC_R = 1018;
    const ARC_START_ANGLE = 140; // degrees, the left end of the drawn arc

    let sectionTop = 0;
    let sectionHeight = 0;
    function updateSectionMetrics() {
        section.style.removeProperty('--leadspace-height');
        const rect = section.getBoundingClientRect();
        sectionTop = rect.top + window.scrollY;
        sectionHeight = rect.height;
        section.style.setProperty('--leadspace-height', `${sectionHeight}px`);
    }

    function visibilityFloor(arcWidth) {
        if (!(arcWidth > 0)) return 0.16;
        const visibleLeftEdge = (ARC_VIEWBOX / 2) * (1 - window.innerWidth / arcWidth); // viewBox x at screen x=0
        const tipX = visibleLeftEdge + 150;
        const cosT = Math.max(-1, Math.min(1, (tipX - ARC_CX) / ARC_R));
        const tipAngle = Math.acos(cosT) * 180 / Math.PI;
        const sweepRad = Math.max(0, ARC_START_ANGLE - tipAngle) * Math.PI / 180;
        const sweepLen = sweepRad * ARC_R;
        return sweepLen / (Math.PI * ARC_R * (100 / 180));
    }

    function updateArcMetrics() {
        updateSectionMetrics();
        const arc = section.querySelector('.leadspace__arc');
        const arcWidth = arc ? arc.getBoundingClientRect().width : ARC_VIEWBOX;
        const scale = (arcWidth > 0 ? arcWidth : ARC_VIEWBOX) / ARC_VIEWBOX;
        const floor = visibilityFloor(arcWidth);

        const ring = section.querySelector('.leadspace__arc-ring');
        if (ring && scale > 0) {
            ring.style.strokeWidth = 12 / scale;
        }

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

            path._dash = totalLength;
            path._arcStart = arcStart;
            path.style.strokeDasharray = path._dash;

            if (scale > 0) {
                path.style.strokeWidth = 8 / scale;
            }
        });
    }

    function getProgress() {
        if (sectionHeight <= 0) return 0;
        const scrolled = window.scrollY;
        const isMobile = window.innerWidth < 768;
        const limit = isMobile ? (window.innerHeight * 0.7) : (sectionHeight * 0.7);
        return Math.min(1, Math.max(0, scrolled / limit));
    }

    let ticking = false;
    function onScroll() {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(function () {
            const progress = getProgress();
            paths.forEach(path => {
                const dash = path._dash || 1800;
                const arcStart = path._arcStart || 0;
                if (progress <= 0) {
                    path.style.strokeDashoffset = dash;
                } else if (progress <= 0.05) {
                    const phaseProgress = progress / 0.05;
                    path.style.strokeDashoffset = dash * (1 - phaseProgress * arcStart);
                } else {
                    const phaseProgress = (progress - 0.05) / 0.95;
                    path.style.strokeDashoffset = dash * (1 - arcStart) * (1 - phaseProgress);
                }
            });
            ticking = false;
        });
    }

    let lastWidth = window.innerWidth;
    function onResize() {
        if (window.innerWidth === lastWidth) return;
        lastWidth = window.innerWidth;
        updateArcMetrics();
        onScroll();
    }

    function applyMotionPreference(matches) {
        if (matches) {
            if (video) video.pause();
            window.removeEventListener('scroll', onScroll);
            window.removeEventListener('resize', onResize);
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

    // Update metrics and scroll state again after all resources are fully loaded
    window.addEventListener('load', () => {
        updateArcMetrics();
        onScroll();
    }, { once: true });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLeadspace);
} else {
    initLeadspace();
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=leadspace', initLeadspace);
}
