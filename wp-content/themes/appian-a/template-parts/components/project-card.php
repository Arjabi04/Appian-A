<?php

if ( empty( $project ) || ! ( $project instanceof WP_Post ) ) {
    return;
}
$title = get_the_title( $project );
if ( empty( $title ) ) {
    return;
}

$description = get_field( 'project_description', $project->ID );
$link_url    = '';
$link_target = '_self';
$link_rel    = '';
$link        = get_field( 'project_link', $project->ID );

if ( ! empty( $link ) && is_array( $link ) ) {
    $link_url    = $link['url']    ?? '';
    $link_target = $link['target'] ?? '_self';
    if ( empty( $link_target ) ) {
        $link_target = '_self';
    }
    $link_rel = ( $link_target === '_blank' ) ? 'noopener noreferrer' : '';
}

$image_url = '';
$image_alt = '';
$thumbnail_id = get_post_thumbnail_id( $project->ID );

if ( ! empty( $thumbnail_id ) ) {
    $image_url = get_the_post_thumbnail_url( $project->ID, 'large' );
    if ( ! empty( $image_url ) ) {
        $image_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
        if ( empty( $image_alt ) ) {
            $image_alt = $title;
        }
    }
}

$category_label = '';
$terms          = get_the_terms( $project->ID, 'project_category' );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    $term_names     = wp_list_pluck( $terms, 'name' );
    $category_label = implode( ' | ', $term_names );
}
$show_read_more = ! empty( $read_more_text ) && is_string( $read_more_text );
?>

<article class="project-card">
    <?php if ( ! empty( $image_url ) ) : ?>
        <img
            class="project-card__image"
            src="<?php echo esc_url( $image_url ); ?>"
            alt="<?php echo esc_attr( $image_alt ); ?>">
    <?php endif; ?>

    <?php if ( ! empty( $category_label ) ) : ?>
        <div class="project-card__meta d-flex align-items-start">
            <img
                class="project-card__icon"
                src="<?php echo esc_url( get_template_directory_uri() . '/resources/images/svgs/i-icon.svg' ); ?>"
                alt=""
                aria-hidden="true">
            <span class="project-card__category body-xsmall">
                <?php echo esc_html( $category_label ); ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( ! empty( $title ) || ! empty( $description ) ) : ?>
        <div class="project-card__content">
            <?php if ( ! empty( $title ) ) : ?>
                <h3 class="project-card__title h6">
                    <?php echo esc_html( $title ); ?>
                </h3>
            <?php endif; ?>
            <?php if ( ! empty( $description ) ) : ?>
                <p class="project-card__description body-xsmall">
                    <?php echo esc_html( $description ); ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ( $show_read_more ) : ?>
        <div class="project-card__read-more">
            <span class="project-card__arrow" aria-hidden="true">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/resources/images/svgs/arrow-right.svg' ); ?>"
                    alt="">
            </span>
            <?php
            if ( ! empty( $link_url ) ) {
                $target_attr = ! empty( $link_target ) ? ' target="' . esc_attr( $link_target ) . '"' : '';
                $rel_attr    = ! empty( $link_rel )    ? ' rel="' . esc_attr( $link_rel ) . '"'       : '';
                echo '<a href="' . esc_url( $link_url ) . '"' . $target_attr . $rel_attr . '>'
                    . '<span class="project-card__read-more-text">' . esc_html( $read_more_text ) . '</span>'
                    . '</a>';
            } else {
                echo '<span class="project-card__read-more-text">' . esc_html( $read_more_text ) . '</span>';
            }
            ?>
        </div>
    <?php endif; ?>
</article>