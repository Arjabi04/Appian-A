<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $project_id = get_the_ID();
        set_query_var('detail_project_id', $project_id);
        get_template_part('template-parts/components/project-hero');
        get_template_part('template-parts/components/project-body');
    endwhile;
endif;

get_footer();
