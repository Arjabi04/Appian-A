<?php
$projects       = get_field( 'hero_project_posts' );
$featured_image = get_field( 'hero_projects_featured_image' );
$heading        = get_field( 'hero_projects_heading' );
$read_more_text = get_field( 'hero_projects_read_more_text' );

if ( empty( $projects ) || ! is_array( $projects ) ) {
    return;
}
$featured_image_url = '';
$featured_image_alt = '';
if ( ! empty( $featured_image ) && is_array( $featured_image ) ) {
    $featured_image_url = $featured_image['url'] ?? '';
    $featured_image_alt = $featured_image['alt'] ?? '';
}

$projects_above = array_slice( $projects, 0, 4 );
$projects_below = array_slice( $projects, 4 );
?>

<section class="hero-projects">
    <?php
    if ( ! empty( $heading ) ) : ?>
        <header class="hero-projects__header h2 text-center">
            <?php echo esc_html( $heading ); ?>
        </header>
    <?php endif; ?>
    <div class="hero-projects__divider-wrap section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
        <img
            class="hero-projects__section-divider section-divider__image"
            src="<?php echo esc_url( get_template_directory_uri() . '/resources/images/svgs/divider.svg' ); ?>"
            alt=""
            aria-hidden="true" />
    </div>
    <div class="hero-projects__projects">
        <?php
        foreach ( $projects_above as $project ) :
            if ( empty( $project ) || ! ( $project instanceof WP_Post ) ) {
                continue;
            }
            include get_template_directory() . '/template-parts/components/project-card.php';
        endforeach;
        ?>
        
        <?php
        if ( ! empty( $featured_image_url ) ) : ?>
            <div class="hero-projects__feature-image">
                <img
                    src="<?php echo esc_url( $featured_image_url ); ?>"
                    alt="<?php echo esc_attr( $featured_image_alt ); ?>">
            </div>
        <?php endif; ?>

        <?php
        foreach ( $projects_below as $project ) :
            if ( empty( $project ) || ! ( $project instanceof WP_Post ) ) {
                continue;
            }
            include get_template_directory() . '/template-parts/components/project-card.php';
        endforeach;
        ?>
    </div>
</section>