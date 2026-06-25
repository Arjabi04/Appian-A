function initVideoModule() {
    const blocks = document.querySelectorAll('.m-video-module');
    if (!blocks.length) return;

    let currentlyPlaying = null;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                const video = entry.target.querySelector('.m-video-module__video');
                if (video && !video.paused) {
                    video.pause();
                }
            }
        });
    }, { threshold: 0 });

    blocks.forEach(block => {
        if (block.dataset.initialized) return;
        block.dataset.initialized = 'true';

        const video = block.querySelector('.m-video-module__video');
        const controlBtn = block.querySelector('[data-video-control]');
        const videoWrapper = block.querySelector('.m-video-module__wrapper');
        if (!video || !controlBtn || !videoWrapper) return;

        observer.observe(block);

        function togglePlayback() {
            if (video.paused) {
                video.play().catch(err => {
                    console.error('Video playback failed:', err);
                });
            } else {
                video.pause();
            }
        }

        let hoverTimeout;
        controlBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            togglePlayback();
        });

        video.addEventListener('click', togglePlayback);
        video.addEventListener('play', () => {
            if (currentlyPlaying && currentlyPlaying !== video) {
                currentlyPlaying.pause();
            }
            currentlyPlaying = video;

            block.classList.add('is-playing');
            block.classList.remove('show-controls');
            controlBtn.setAttribute('aria-label', 'Pause video');
            clearTimeout(hoverTimeout);
        });

        video.addEventListener('pause', () => {
            if (currentlyPlaying === video) {
                currentlyPlaying = null;
            }

            block.classList.remove('is-playing');
            block.classList.remove('show-controls');
            controlBtn.setAttribute('aria-label', 'Play video');
            clearTimeout(hoverTimeout);
        });

        function triggerShowControls() {
            if (!video.paused) {
                block.classList.add('show-controls');
                clearTimeout(hoverTimeout);
                hoverTimeout = setTimeout(() => {
                    if (!video.paused) {
                        block.classList.remove('show-controls');
                    }
                }, 2000);
            }
        }

        videoWrapper.addEventListener('mouseenter', triggerShowControls);
        videoWrapper.addEventListener('mousemove', triggerShowControls);

        videoWrapper.addEventListener('mouseleave', () => {
            block.classList.remove('show-controls');
            clearTimeout(hoverTimeout);
        });

        controlBtn.addEventListener('focus', () => {
            if (!video.paused) {
                block.classList.add('show-controls');
            }
        });

        controlBtn.addEventListener('blur', () => {
            block.classList.remove('show-controls');
            clearTimeout(hoverTimeout);
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVideoModule);
} else {
    initVideoModule();
}