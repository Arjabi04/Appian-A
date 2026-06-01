<?php

/**
 * Secondary Hero block.
 */

$secondary_hero_group = get_field('secondary_hero');
// $secondary_hero_group = is_array($secondary_hero_group) ? $secondary_hero_group : [];

$hero_image   = $secondary_hero_group['secondaryhero__image'] ?? [];
$hero_image   = is_array($hero_image) ? $hero_image : [];
$hero_heading = $secondary_hero_group['secondaryhero_heading'] ?? '';

$hero_image_url = $hero_image['url'] ?? '';
$hero_image_alt = $hero_image['alt'] ?? '';
// print_r($secondary_hero_group);

if (empty($hero_image_url) && empty($hero_heading)) {
    return;
}
?>

<section class="m-secondary-hero" aria-label="<?php echo esc_attr(! empty($hero_heading) ? $hero_heading : 'Secondary Hero'); ?>">
    <?php if (! empty($hero_image_url)) : ?>
        <img
            class="m-secondary-hero__image"
            src="<?php echo esc_url($hero_image_url); ?>"
            alt="<?php echo esc_attr($hero_image_alt); ?>" />
        <div class="m-secondary-hero__overlay"></div>
    <?php endif; ?>

    <?php if (! empty($hero_heading)) : ?>
        <div class="m-secondary-hero__content">
            <h1 class="m-secondary-hero__heading"><?php echo esc_html($hero_heading); ?></h1>
        </div>
    <?php endif; ?>
</section>