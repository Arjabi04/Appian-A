<?php

function appian_register_project_cpt() {

    $labels = array(
        'name'                  => _x( 'Projects', 'Post type general name', 'outside-traineeship-biolerplate' ),
        'singular_name'         => _x( 'Project', 'Post type singular name', 'outside-traineeship-biolerplate' ),
        'menu_name'             => _x( 'Projects', 'Admin Menu text', 'outside-traineeship-biolerplate' ),
        'add_new'               => __( 'Add New', 'outside-traineeship-biolerplate' ),
        'add_new_item'          => __( 'Add New Project', 'outside-traineeship-biolerplate' ),
        'new_item'              => __( 'New Project', 'outside-traineeship-biolerplate' ),
        'edit_item'             => __( 'Edit Project', 'outside-traineeship-biolerplate' ),
        'view_item'             => __( 'View Project', 'outside-traineeship-biolerplate' ),
        'all_items'             => __( 'All Projects', 'outside-traineeship-biolerplate' ),
        'search_items'          => __( 'Search Projects', 'outside-traineeship-biolerplate' ),
        'not_found'             => __( 'No projects found.', 'outside-traineeship-biolerplate' ),
        'not_found_in_trash'    => __( 'No projects found in Trash.', 'outside-traineeship-biolerplate' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'projects' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'project', $args );
}
add_action( 'init', 'appian_register_project_cpt' );

function appian_register_project_category_taxonomy() {

    $labels = array(
        'name'              => _x( 'Project Categories', 'taxonomy general name', 'outside-traineeship-biolerplate' ),
        'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'outside-traineeship-biolerplate' ),
        'search_items'      => __( 'Search Project Categories', 'outside-traineeship-biolerplate' ),
        'all_items'         => __( 'All Project Categories', 'outside-traineeship-biolerplate' ),
        'parent_item'       => __( 'Parent Project Category', 'outside-traineeship-biolerplate' ),
        'parent_item_colon' => __( 'Parent Project Category:', 'outside-traineeship-biolerplate' ),
        'edit_item'         => __( 'Edit Project Category', 'outside-traineeship-biolerplate' ),
        'update_item'       => __( 'Update Project Category', 'outside-traineeship-biolerplate' ),
        'add_new_item'      => __( 'Add New Project Category', 'outside-traineeship-biolerplate' ),
        'new_item_name'     => __( 'New Project Category Name', 'outside-traineeship-biolerplate' ),
        'menu_name'         => __( 'Categories', 'outside-traineeship-biolerplate' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'project-category' ),
        'show_in_rest'      => true,
    );

    register_taxonomy( 'project_category', array( 'project' ), $args );
}
add_action( 'init', 'appian_register_project_category_taxonomy' );