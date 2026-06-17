<?php

// Create an admin-only CPT to store contact form submissions.
add_action('init', function () {
    register_post_type('contact_submission', [
        'label' => 'Contact Submissions',
        'public' => false,
        'show_ui' => true,
        'supports' => ['title'],
    ]);
});

// Let users submit the contact form through AJAX.
add_action('wp_ajax_submit_contact_form', 'appian_submit_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'appian_submit_contact_form'); //non users

function appian_submit_contact_form()
{
    // Clean the submitted form values before saving.
    $fields = [
        'first_name' => sanitize_text_field($_POST['first-name'] ?? ''),
        'last_name' => sanitize_text_field($_POST['last-name'] ?? ''),
        'email' => sanitize_email($_POST['email'] ?? ''),
        'phone' => sanitize_text_field($_POST['phone'] ?? ''),
        'move_in_date' => sanitize_text_field($_POST['move-in-date'] ?? ''),
        'unit_type' => sanitize_text_field($_POST['unit-type'] ?? ''),
    ];

    if (!preg_match('/^[0-9]{10}$/', $fields['phone'])) {
        wp_send_json_error(['message' => 'Please enter a 10 digit phone number.'], 400);
    }

    if (
        !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fields['move_in_date'])
        || $fields['move_in_date'] < wp_date('Y-m-d')
    ) {
        wp_send_json_error(['message' => 'Please choose today or a future date.'], 400);
    }

    // Create one Contact Submission post per form submit.
    $post_id = wp_insert_post([
        'post_type' => 'contact_submission',
        'post_status' => 'publish',
        'post_title' => $fields['first_name'],
    ]);

    // Store each submitted value as post meta on the submission.
    foreach ($fields as $key => $value) {
        update_post_meta($post_id, $key, $value);
    }

    // Send a simple email to Mailpit/local mail with the submitted values.
    $message = sprintf(
        "New Form Submission: \nFirst Name: %s\nLast Name: %s\nEmail: %s\nPhone: %s\nMove In Date: %s\nUnit Type: %s",
        $fields['first_name'],
        $fields['last_name'],
        $fields['email'],
        $fields['phone'],
        $fields['move_in_date'],
        $fields['unit_type']
    );

    wp_mail(get_option('admin_email'), 'New Contact Form Submission', $message);

    wp_send_json_success();
}

// Add a simple read-only details box
add_action('add_meta_boxes', function () {
    add_meta_box(
        'contact_submission_details',
        'Contact Submission Details',
        'appian_contact_submission_details_meta_box',
        'contact_submission'
    );
});

function appian_contact_submission_details_meta_box($post)
{
    $fields = [
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'move_in_date' => 'Move In Date',
        'unit_type' => 'Unit Type',
    ];

    foreach ($fields as $key => $label) {
        printf(
            '<p><strong>%s:</strong> %s</p>',
            esc_html($label),
            esc_html(get_post_meta($post->ID, $key, true))
        );
    }
}
