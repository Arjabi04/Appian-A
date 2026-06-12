function initSecondaryHero() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('video.m-secondary-hero__video').forEach(video => video.pause());
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSecondaryHero);
} else {
    initSecondaryHero();
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=secondary-hero', initSecondaryHero);
}
