function initSecondaryHero() {
    const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

    function handleMotionPreference(e) {
        document.querySelectorAll('video.m-secondary-hero__video').forEach(video => {
            if (e.matches) {
                video.pause();
            } else {
                video.play().catch(() => { });
            }
        });
    }

    handleMotionPreference(mediaQuery);
    mediaQuery.addEventListener('change', handleMotionPreference);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSecondaryHero);
} else {
    initSecondaryHero();
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=secondary-hero', initSecondaryHero);
}
