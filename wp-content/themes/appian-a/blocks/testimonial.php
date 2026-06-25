<?php

/**
 * Testimonial block.
 */

$testimonial_group = get_field('testimonial_group');
// print_r($testimonial_group);
$testimonial_group = is_array($testimonial_group) ? $testimonial_group : get_field('testimonial');
$testimonial_group = is_array($testimonial_group) ? $testimonial_group : [];

$person_image = $testimonial_group['person_image'] ?? [];
$person_image = is_array($person_image) ? $person_image : [];
$person_name  = $testimonial_group['person_name'] ?? '';
$quote_text   = $testimonial_group['quote_text'] ?? '';
$default_theme = $testimonial_group['theme'] ?? 'primary-red';
$background_theme = $testimonial_group['background_theme'] ?? $default_theme;
$arrow_theme      = $testimonial_group['arrow_theme'] ?? $default_theme;

$allowed_themes = array(
    'primary-red',
    'light-red',
    'ultra-light-red',
);

if (! in_array($background_theme, $allowed_themes, true)) {
    $background_theme = 'primary-red';
}

if (! in_array($arrow_theme, $allowed_themes, true)) {
    $arrow_theme = 'primary-red';
}

$person_image_url = $person_image['url'] ?? '';
$person_image_alt = $person_image['alt'] ?? '';
$arrow_image_url  = get_template_directory_uri() . '/resources/images/svgs/arrow.svg';
$has_person_image = !empty($person_image_url);
$has_quote_text   = !empty($quote_text);
$has_person_name  = $has_person_image && ! empty($person_name);
$show_color_block   = $has_person_image || $has_quote_text;

if (! $show_color_block && ! $has_person_name) {
    return;
}
?>

<section
    class="m-testimonial m-testimonial--bg-<?php echo esc_attr($background_theme); ?> m-testimonial--arrow-<?php echo esc_attr($arrow_theme); ?>"
    style="--testimonial-arrow-image: url('<?php echo esc_url($arrow_image_url); ?>');"
    aria-label="Testimonial">
    <?php if ($show_color_block) : ?>
        <div class="m-testimonial__red-block"></div>
    <?php endif; ?>

    <?php if ($has_person_image) : ?>
        <img
            class="m-testimonial__person js-animate-image"
            src="<?php echo esc_url($person_image_url); ?>"
            alt="<?php echo esc_attr(! empty($person_image_alt) ? $person_image_alt : $person_name); ?>"
            loading="lazy"
            />
    <?php endif; ?>

    <?php if ($has_person_name) : ?>
        <div class="m-testimonial__annotation">
            <span class="m-testimonial__arrow" aria-hidden="true"></span>
            <p class="m-testimonial__name body-large text-center m-0">
                <?php echo esc_html($person_name); ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if ($has_quote_text) : ?>
        <div class="m-testimonial__quote-box">
            <div class="m-testimonial__quote-bg-container">
                <picture>
                    <source
                        media="(min-width: 1025px)"
                        srcset="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/quote-box.svg'); ?>" />
                    <img
                        class="m-testimonial__quote-bg"
                        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/quote-box-mobile.svg'); ?>"
                        alt=""
                        />
                </picture>
            </div>
            <div class="m-testimonial__quote-content">
                <p class="m-testimonial__quote-text body-large m-0">
                    <?php echo esc_html($quote_text); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</section>
