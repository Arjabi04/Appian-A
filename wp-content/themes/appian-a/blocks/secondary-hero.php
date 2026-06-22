<?php

/**
 * Secondary Hero block.
 */

$secondary_hero_group = get_field('secondary_hero');

$hero_video   = $secondary_hero_group['secondaryhero__video'] ?? [];
$hero_video   = is_array($hero_video) ? $hero_video : [];
$hero_image   = $secondary_hero_group['secondaryhero__image'] ?? [];
$hero_image   = is_array($hero_image) ? $hero_image : [];
$hero_heading = $secondary_hero_group['secondaryhero_heading'] ?? '';

$hero_video_url = $hero_video['url'] ?? '';
$hero_image_url = $hero_image['url'] ?? '';
$hero_image_alt = $hero_image['alt'] ?? '';
$hero_poster_url = ! empty($hero_image_url) ? $hero_image_url : '';

if (empty($hero_video_url) && empty($hero_image_url) && empty($hero_heading)) {
    return;
}
?>

<section class="m-secondary-hero" aria-label="<?php echo esc_attr(! empty($hero_heading) ? $hero_heading : 'Secondary Hero'); ?>">
    <?php if (! empty($hero_video_url)) : ?>
        <video
            class="m-secondary-hero__video"
            src="<?php echo esc_url($hero_video_url); ?>"
            <?php if (! empty($hero_poster_url)) : ?>poster="<?php echo esc_url($hero_poster_url); ?>"<?php endif; ?>
            autoplay
            muted
            loop
            playsinline
            preload="auto"
            fetchpriority="high"></video>
        <script>
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                const video = document.currentScript.previousElementSibling;
                if (video) {
                    video.removeAttribute('autoplay');
                    video.pause();
                }
            }
        </script>
        <div class="m-secondary-hero__overlay"></div>
    <?php elseif (! empty($hero_image_url)) : ?>
        <img
            class="m-secondary-hero__image"
            src="<?php echo esc_url($hero_image_url); ?>"
            alt="<?php echo esc_attr($hero_image_alt); ?>"
            loading="eager"
            fetchpriority="high" />
        <div class="m-secondary-hero__overlay"></div>
    <?php endif; ?>

    <?php if (! empty($hero_heading)) : ?>
        <div class="m-secondary-hero__content">
            <h1 class="m-secondary-hero__heading d1"><?php echo esc_html($hero_heading); ?></h1>
        </div>
    <?php endif; ?>
</section>
