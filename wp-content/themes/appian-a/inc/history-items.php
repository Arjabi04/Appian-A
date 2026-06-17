<?php

add_action('init', function () {
	register_post_type('history_item', [
		'label' => 'History Items',
		'public' => false,
		'show_ui' => true,
		'menu_icon' => 'dashicons-backup',
		'supports' => ['title', 'thumbnail', 'page-attributes'],
	]);
});

add_action('add_meta_boxes', function () {
	add_meta_box(
		'history_item_details',
		'History Item Details',
		function ($post) {
			wp_nonce_field('appian_save_history_item', 'appian_history_item_nonce');
?>
		<p>
			<label><strong>Popup Description</strong></label>
			<textarea name="history_popup_description" rows="6" class="widefat"><?php echo esc_textarea(get_post_meta($post->ID, 'history_popup_description', true)); ?></textarea>
		</p>

		<p>
			<label><strong>Link Text</strong></label>
			<input type="text" name="history_link_text" value="<?php echo esc_attr(get_post_meta($post->ID, 'history_link_text', true)); ?>" class="widefat">
		</p>
<?php
		},
		'history_item',
		'normal'
	);
});

add_action('save_post_history_item', function ($post_id) {
	if (
		! isset($_POST['appian_history_item_nonce']) ||
		! wp_verify_nonce($_POST['appian_history_item_nonce'], 'appian_save_history_item')
	) {
		return;
	}

	update_post_meta($post_id, 'history_popup_description', sanitize_textarea_field($_POST['history_popup_description'] ?? ''));
	update_post_meta($post_id, 'history_link_text', sanitize_text_field($_POST['history_link_text'] ?? ''));
});
