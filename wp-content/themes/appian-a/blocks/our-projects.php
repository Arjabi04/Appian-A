<?php
$heading = get_field('our_projects_heading');
$read_more_text = get_field('our_projects_read_more_text');
$project_categories = get_terms([
    'taxonomy'   => 'project_category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);


$paged = max(1, (int) (get_query_var('paged') ?: (get_query_var('page') ?: 1)));

$our_projects_query = new WP_Query([
    'post_type'      => 'project',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'meta_key'       => 'project_featured',
    'orderby'        => [
        'meta_value_num' => 'DESC',
        'date'           => 'DESC',
    ],
]);
$has_projects = $our_projects_query->have_posts();


if (empty($heading) && !$has_projects) {
    return;
}
?>
<section class="our-projects grid-container">
    <?php if (!empty($heading)): ?>
        <h2 class="our-projects__header h2 text-center">
            <?php echo esc_html($heading); ?>
        </h2>


        <div class="our-projects__divider-wrap section-divider section-divider--responsive d-flex justify-content-center"
            data-section-divider>
            <img class="our-projects__section-divider section-divider__image"
                src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/svgs/divider.svg'); ?>" alt=""
                aria-hidden="true" />
        </div>
    <?php endif; ?>


    <div class="our-projects__filters-wrapper ">
        <div class="grid-row">
            <div class="our-projects__filters-shell">
                <div class="our-projects__filters-mobile d-flex d-xl-none align-items-center justify-content-between"
                    data-project-filter-dropdown>
                    <span class="our-projects__filters-label h5 m-0 body-medium ">Filter by:</span>


                    <div class="dropdown">
                        <button
                            class="our-projects__filters-toggle dropdown-toggle h5 m-0 d-flex align-items-center gap-2 bg-transparent border-0 p-0"
                            type="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <span class="body-large" data-project-filter-label>All Projects</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end our-projects__dropdown-menu"
                            aria-label="Project filter options">
                            <li><button class="dropdown-item our-projects__dropdown-item" type="button">All
                                    Projects</button></li>
                            <?php if (! empty($project_categories) && ! is_wp_error($project_categories)) : ?>
                                <?php foreach ($project_categories as $project_category) : ?>
                                    <li>
                                        <button class="dropdown-item our-projects__dropdown-item" type="button">
                                            <?php echo esc_html($project_category->name); ?>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>


                <ul class="our-projects__filters nav justify-content-center align-items-center list-unstyled d-none d-xl-flex"
                    role="tablist" aria-label="Project filters">
                    <li class="nav-item" role="presentation">
                        <button class="our-projects__filter nav-link body-sm-all m-0 p-0 bg-transparent" type="button"
                            role="tab" aria-selected="true">All Projects</button>
                    </li>
                    <?php if (! empty($project_categories) && ! is_wp_error($project_categories)) : ?>
                        <?php foreach ($project_categories as $project_category) : ?>
                            <li class="nav-item" role="presentation">
                                <button class="our-projects__filter nav-link body-small m-0 p-0 bg-transparent" type="button"
                                    role="tab" aria-selected="false">
                                    <?php echo esc_html($project_category->name); ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>


    <?php if ($has_projects): ?>
        <div class="our-projects__cards-wrapper" id="our-projects-cards">
            <div class="grid-row">
                <div class="our-projects__cards-grid">
                    <?php while ($our_projects_query->have_posts()):
                        $our_projects_query->the_post();
                        $project = get_post();
                        ?>
                        <div class="our-projects__card-item">
                            <?php include get_template_directory() . '/template-parts/components/project-card.php'; ?>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <div class="our-projects__pagination-wrapper " id="our-projects-pagination">
        <div class="grid-row">
            <nav class="our-projects__pagination-nav" aria-label="Projects pagination">
                <?php echo render_projects_pagination($our_projects_query, $paged); ?>
            </nav>
        </div>
    </div>
</section>
