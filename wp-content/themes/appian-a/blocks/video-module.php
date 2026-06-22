<?php
$video_module_group = get_field('video_module_group');
$video_module_group = is_array($video_module_group) ? $video_module_group : get_field('video_module');
$video_module_group = is_array($video_module_group) ? $video_module_group : [];

$video_file = $video_module_group['video_file'] ?? [];
$video_file = is_array($video_file) ? $video_file : [];

$video_url = $video_file['url'] ?? '';

if (empty($video_url)) {
    return;
}

$id = 'video-module-' . uniqid();
$classes = 'm-video-module';
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>" aria-label="Video Showcase">
    <div class="grid-container">
        <div class="grid-row">
            <div class="m-video-module__col d-flex flex-column w-100">
                <div class="m-video-module__wrapper w-100">
                    <video
                        class="m-video-module__video w-100"
                        src="<?php echo esc_url($video_url); ?>"
                        preload="metadata"
                        playsinline>
                    </video>

                    <div class="m-video-module__overlay d-flex justify-content-center align-items-center">
                        <div class="m-video-module__overlay-gradient" aria-hidden="true"></div>

                        <button
                            class="m-video-module__play-btn d-flex justify-content-center align-items-center rounded-circle border-0"
                            type="button"
                            aria-label="Play video"
                            data-video-control>
                            <span class="m-video-module__icon m-video-module__icon--play" aria-hidden="true">
                                <?php echo appian_get_svg_icon('play'); ?>
                            </span>
                            <span class="m-video-module__icon m-video-module__icon--pause" aria-hidden="true">
                                <?php echo appian_get_svg_icon('pause'); ?>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
