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

$person_image_url = $person_image['url'] ?? '';
$person_image_alt = $person_image['alt'] ?? '';

if (empty($person_image_url) && empty($person_name) && empty($quote_text)) {
    return;
}
?>

<section class="m-testimonial" aria-label="Testimonial">
    <div class="m-testimonial__red-block"></div>

    <?php if (! empty($person_image_url)) : ?>
        <img
            class="m-testimonial__person"
            src="<?php echo esc_url($person_image_url); ?>"
            alt="<?php echo esc_attr(! empty($person_image_alt) ? $person_image_alt : $person_name); ?>" />
    <?php endif; ?>

    <?php if (! empty($person_name)) : ?>
        <div class="m-testimonial__annotation">
            <img
                class="m-testimonial__arrow"
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow.svg'); ?>"
                alt="" />
            <p class="m-testimonial__name">
                <?php echo esc_html($person_name); ?>
            </p>
        </div>
    <?php endif; ?>

    <?php if (! empty($quote_text)) : ?>
        <div class="m-testimonial__quote-box">
            <div class="m-testimonial__quote-bg-container">
                <picture>
                    <source
                        media="(min-width: 1025px)"
                        srcset="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/quote-box.svg'); ?>" />
                    <img
                        class="m-testimonial__quote-bg"
                        src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/quote-box-mobile.svg'); ?>"
                        alt="" />
                </picture>
            </div>
            <div class="m-testimonial__quote-content">
                <p class="m-testimonial__quote-text">
                    <?php echo esc_html($quote_text); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>
</section>