<?php
$projects       = get_field('hero_project_posts');
$featured_image = get_field('hero_projects_featured_image');
$heading        = get_field('hero_projects_heading');
$read_more_text = get_field('hero_projects_read_more_text');
$featured_image_url = '';
$featured_image_alt = '';

if (! empty($featured_image) && is_array($featured_image)) {
    $featured_image_url = $featured_image['url'] ?? '';
    $featured_image_alt = $featured_image['alt'] ?? '';
}
$has_projects = ! empty($projects) && is_array($projects);

if (
    empty($heading) &&
    empty($featured_image_url) &&
    ! $has_projects
) {
    return;
}

$image_position = get_field('hero_projects_image_position');
if (empty($image_position) || ! is_numeric($image_position) || $image_position < 1) {
    $image_position = 5;
}
$image_position = (int) $image_position;

$is_conflict_position = ($image_position % 4 === 0);

$projects_above = array();
$projects_below = array();

if ($has_projects) {
    if ($is_conflict_position) {
        $cards_before_image = max(0, $image_position - 2);

        $displaced_card = null;
        if (isset($projects[$cards_before_image])) {
            $displaced_card = $projects[$cards_before_image];
        }

        $projects_above = array_slice($projects, 0, $cards_before_image);

        $remaining = array_slice($projects, $cards_before_image + 1);

        if (! empty($displaced_card)) {
            array_unshift($remaining, $displaced_card);
        }

        $projects_below = $remaining;
    } else {
        $cards_before_image = max(0, $image_position - 1);
        $projects_above = array_slice($projects, 0, $cards_before_image);
        $projects_below = array_slice($projects, $cards_before_image);
    }
}
$args = ['featured' => false];
?>

<section class="hero-projects grid-container">
    <?php
    if (! empty($heading)) : ?>
        <h2 class="hero-projects__header h2 text-center">
            <?php echo esc_html($heading); ?>
        </h2>
        <div class="hero-projects__divider-wrap section-divider section-divider--responsive d-flex justify-content-center" data-section-divider>
            <img
                class="hero-projects__section-divider section-divider__image"
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>"
                alt=""
                aria-hidden="true" />
        </div>
    <?php endif; ?>
    <div class="hero-projects__projects">
        <?php
        if ($has_projects) :
            foreach ($projects_above as $project) :
                if (empty($project) || ! ($project instanceof WP_Post)) {
                    continue;
                }
                include get_template_directory() . '/template-parts/components/project-card.php';
            endforeach;
        endif;
        ?>

        <?php
        if (! empty($featured_image_url)) : ?>
            <div class="hero-projects__feature-image">
                <img
                    src="<?php echo esc_url($featured_image_url); ?>"
                    alt="<?php echo esc_attr($featured_image_alt); ?>"
                    />
            </div>
        <?php endif; ?>

        <?php
        if ($has_projects) :
            foreach ($projects_below as $project) :
                if (empty($project) || ! ($project instanceof WP_Post)) {
                    continue;
                }
                include get_template_directory() . '/template-parts/components/project-card.php';
            endforeach;
        endif;
        ?>
    </div>
</section>