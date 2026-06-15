<?php

if (empty($project) || ! ($project instanceof WP_Post)) {
    return;
}
$title = get_the_title($project);
if (empty($title)) {
    return;
}

$caption  = get_field('project_description', $project->ID);
$link_url = get_permalink($project->ID);

$image_url = '';
$image_alt = '';
$thumbnail_id = get_post_thumbnail_id($project->ID);

if (! empty($thumbnail_id)) {
    $image_url = get_the_post_thumbnail_url($project->ID, 'large');
    if (! empty($image_url)) {
        $image_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        if (empty($image_alt)) {
            $image_alt = $title;
        }
    }
}

$category_label = '';
$terms          = get_the_terms($project->ID, 'project_category');
if (! empty($terms) && ! is_wp_error($terms)) {
    $term_names     = wp_list_pluck($terms, 'name');
    $category_label = implode(' | ', $term_names);
}
$show_read_more = ! empty($read_more_text) && is_string($read_more_text);
$is_clickable = ! empty($link_url);
?>

<article class="project-card<?php echo $is_clickable ? ' project-card--clickable' : ''; ?>">
    <?php if (! empty($image_url)) : ?>
        <img
            class="project-card__image"
            src="<?php echo esc_url($image_url); ?>"
            alt="<?php echo esc_attr($image_alt); ?>">
    <?php endif; ?>

    <?php if (! empty($category_label)) : ?>
        <div class="project-card__meta d-flex align-items-start">
            <img
                class="project-card__icon"
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/i-icon.svg'); ?>"
                alt=""
                aria-hidden="true">
            <span class="project-card__category body-xsmall">
                <?php echo esc_html($category_label); ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if (! empty($title) || ! empty($caption)) : ?>
        <div class="project-card__content">
            <?php if (! empty($title)) : ?>
                <h3 class="project-card__title h6">
                    <?php echo esc_html($title); ?>
                </h3>
            <?php endif; ?>
            <?php if (! empty($caption)) : ?>
                <p class="project-card__description body-xsmall">
                    <?php echo esc_html($caption); ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($show_read_more) : ?>
        <div class="project-card__read-more">
            <span class="project-card__arrow" aria-hidden="true">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/arrow-right.svg'); ?>"
                    alt="">
            </span>
            <?php
            echo '<span class="project-card__read-more-text">' . esc_html($read_more_text) . '</span>';
            ?>
        </div>
    <?php endif; ?>

    <?php if ($is_clickable) : ?>
        <a class="project-card__overlay-link" href="<?php echo esc_url($link_url); ?>" aria-label="<?php echo esc_attr($title); ?>"></a>
    <?php endif; ?>
</article>
