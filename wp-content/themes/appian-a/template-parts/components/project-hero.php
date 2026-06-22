<?php
$project_id = get_query_var('detail_project_id');

if (empty($project_id)) {
    return;
}

$heading = get_the_title($project_id);

$eyebrow = '';
$terms = get_the_terms($project_id, 'project_category');
if (! empty($terms) && ! is_wp_error($terms) && is_array($terms)) {
    $term_names = wp_list_pluck($terms, 'name');
    $eyebrow = implode(' | ', $term_names);
}

$caption = get_field('project_description', $project_id);

$description = get_the_excerpt($project_id);

$image_url = '';
$image_alt = '';

$hero_image = get_field('project_hero_image', $project_id);
if (! empty($hero_image) && is_array($hero_image) && ! empty($hero_image['url'])) {
    $image_url = $hero_image['url'];
    $image_alt = ! empty($hero_image['alt']) ? $hero_image['alt'] : $heading;
} else {
    // Fallback 
    $thumbnail_id = get_post_thumbnail_id($project_id);
    if (! empty($thumbnail_id)) {
        $image_url = get_the_post_thumbnail_url($project_id, 'full');
        $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        if (empty($image_alt)) {
            $image_alt = $heading;
        }
    }
}

if (
    empty($heading) &&
    empty($eyebrow) &&
    empty($caption) &&
    empty($description) &&
    empty($image_url)
) {
    return;
}
?>
<section class="m-tertiary-hero" aria-label="Tertiary Hero">
    <div class="m-tertiary-hero__content-wrapper">
        <div class="m-tertiary-hero__text-box">
            <?php if (! empty($eyebrow)) : ?>
                <p class="m-tertiary-hero__eyebrow sh3 text-white mb-0">
                    <?php echo esc_html($eyebrow); ?>
                </p>
            <?php endif; ?>
            <?php if (! empty($heading)) : ?>
                <h2 class="m-tertiary-hero__heading h2 text-white mb-0">
                    <?php echo esc_html($heading); ?>
                </h2>
            <?php endif; ?>
            <?php if (! empty($description)) : ?>
                <p class="m-tertiary-hero__description body-large text-white mb-0">
                    <?php echo wp_kses_post($description); ?>
                </p>
            <?php endif; ?>
            <?php if (! empty($caption)) : ?>
                <p class="m-tertiary-hero__caption mb-0">
                    <?php echo esc_html($caption); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php if (! empty($image_url)) : ?>
        <div class="m-tertiary-hero__image-wrapper">
            <img
                class="m-tertiary-hero__image"
                src="<?php echo esc_url($image_url); ?>"
                alt="<?php echo esc_attr($image_alt); ?>"
                loading="eager"
                fetchpriority="high" />
        </div>
    <?php endif; ?>
</section>