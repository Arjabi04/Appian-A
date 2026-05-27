<?php
function create_newsletter_post_type()
{
	$labels = array(
		'name'          => 'Newsletter',
		'singular_name' => 'Newsletter',
		'menu_name'     => 'Newsletter',
	);

	$args = array(
		'labels'   => $labels,
		'public'   => true,
		'rewrite'  => array(
			'slug' => 'newsletter',
		),
		'supports' => array('title'),
		'menu_icon' => 'dashicons-email',
	);

	register_post_type('newsletter', $args);
}

add_action('init', 'create_newsletter_post_type');
