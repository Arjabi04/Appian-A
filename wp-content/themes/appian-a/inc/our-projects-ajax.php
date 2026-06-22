<?php

function appian_get_our_projects_query_args($paged = 1, $category_slug = 'all') {
    // Base query: featured projects first, then newest.
    $query_args = [
        'post_type'      => 'project',
        'posts_per_page' => 12,
        'paged'          => max(1, (int) $paged),
        'meta_key'       => 'project_featured',
        'orderby'        => [
            'meta_value_num' => 'DESC',
            'date'           => 'DESC',
        ],
    ];

    if (! empty($category_slug) && $category_slug !== 'all') {
        // When a category is selected, only return projects from that category.
        $query_args['tax_query'] = [
            [
                'taxonomy' => 'project_category',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ],
        ];
    }

    return $query_args;
}

function appian_render_our_projects_cards($query, $read_more_text = '') {
    ob_start();
    ?>
    <div class="grid-row">
        <div class="our-projects__cards-grid">
            <?php while ($query->have_posts()) : ?>
                <?php
                $query->the_post();
                $project = get_post();
                ?>
                <div class="our-projects__card-item">
                    <?php include get_template_directory() . '/template-parts/components/project-card.php'; ?>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <?php

    return ob_get_clean();
}

function appian_filter_our_projects_ajax() {
    $category_slug  = isset($_POST['category']) ? sanitize_key(wp_unslash($_POST['category'])) : 'all';
    $read_more_text = isset($_POST['read_more_text']) ? sanitize_text_field(wp_unslash($_POST['read_more_text'])) : '';
    $paged          = isset($_POST['paged']) ? max(1, (int) $_POST['paged']) : 1;

    $query = new WP_Query(appian_get_our_projects_query_args($paged, $category_slug));

    wp_send_json_success([
        'cards'      => appian_render_our_projects_cards($query, $read_more_text),
        'pagination' => render_projects_pagination($query, $paged),
    ]);
}
add_action('wp_ajax_appian_filter_our_projects', 'appian_filter_our_projects_ajax');
add_action('wp_ajax_nopriv_appian_filter_our_projects', 'appian_filter_our_projects_ajax');