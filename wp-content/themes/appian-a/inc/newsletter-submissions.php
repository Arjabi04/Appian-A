<?php

// Create an admin-only CPT to store footer newsletter subscriptions.
add_action('init', function () {
	register_post_type('newsletter_sub', [
		'label' => 'Newsletter Subscriptions',
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'supports' => ['title'],
		'menu_icon' => 'dashicons-email',
	]);
});

// Let users submit the footer newsletter form through AJAX.
add_action('wp_ajax_submit_newsletter_subscription', 'appian_submit_newsletter_subscription');
add_action('wp_ajax_nopriv_submit_newsletter_subscription', 'appian_submit_newsletter_subscription');

function appian_submit_newsletter_subscription()
{
	$email = sanitize_email($_POST['email'] ?? '');

	if (!is_email($email)) {
		wp_send_json_error(['message' => 'Please enter a valid email address.'], 400);
	}

	$post_id = wp_insert_post([
		'post_type' => 'newsletter_sub',
		'post_status' => 'publish',
		'post_title' => $email,
	]);

	update_post_meta($post_id, 'email', $email);

	wp_send_json_success();
}

// Add a simple read-only details box.
add_action('add_meta_boxes', function () {
	add_meta_box(
		'newsletter_subscription_details',
		'Newsletter Subscription Details',
		'appian_newsletter_subscription_details_meta_box',
		'newsletter_sub'
	);
});

function appian_newsletter_subscription_details_meta_box($post)
{
	printf(
		'<p><strong>Email:</strong> %s</p>',
		esc_html(get_post_meta($post->ID, 'email', true))
	);
}
