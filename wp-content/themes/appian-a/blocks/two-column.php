<?php

/**
 * Two Column block.
 */

$two_column_group = get_field('two_column_group');
$two_column_group = is_array($two_column_group) ? $two_column_group : get_field('two_column');
$two_column_group = is_array($two_column_group) ? $two_column_group : [];

$resolve_image = static function ($value): array {
	if (is_array($value)) {
		return [
			'url' => $value['url'] ?? '',
			'alt' => $value['alt'] ?? '',
		];
	}

	if (is_numeric($value)) {
		$attachment_id = (int) $value;
		return [
			'url' => wp_get_attachment_image_url($attachment_id, 'full') ?: '',
			'alt' => get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: '',
		];
	}

	if (is_string($value)) {
		return [
			'url' => $value,
			'alt' => '',
		];
	}

	return ['url' => '', 'alt' => ''];
};

$resolve_link = static function ($value): array {
	if (! is_array($value)) {
		return ['url' => '', 'title' => '', 'target' => '_self'];
	}

	$url = $value['url'] ?? '';
	if (! $url && isset($value['link']) && is_array($value['link'])) {
		$url = $value['link']['url'] ?? '';
	}

	return [
		'url'    => $url,
		'title'  => $value['title'] ?? '',
		'target' => $value['target'] ?? '_self',
	];
};

$get_card = static function (array $group, string $slug) use ($resolve_image, $resolve_link): array {
	$card = [];
	$possible_card_keys = [
		$slug,
		$slug . '_card',
	];

	foreach ($possible_card_keys as $key) {
		if (isset($group[$key]) && is_array($group[$key])) {
			$card = $group[$key];
			break;
		}
	}

	$raw_image = $card['image'] ?? $card[$slug . '_image'] ?? $group[$slug . '_image'] ?? null;
	$raw_mobile_image = $card['mobile_image'] ?? $card[$slug . '_mobile_image'] ?? $group[$slug . '_mobile_image'] ?? null;
	$raw_link = $card['link'] ?? $card[$slug . '_link'] ?? $group[$slug . '_link'] ?? null;

	$image = $resolve_image($raw_image);
	$mobile_image = $resolve_image($raw_mobile_image);
	$link = $resolve_link($raw_link);

	return [
		'image_url' => $image['url'],
		'image_alt' => $image['alt'],
		'mobile_image_url' => $mobile_image['url'],
		'eyebrow' => $card['eyebrow'] ?? $card[$slug . '_eyebrow'] ?? $group[$slug . '_eyebrow'] ?? '',
		'heading' => $card['heading'] ?? $card[$slug . '_heading'] ?? $group[$slug . '_heading'] ?? '',
		'link_url' => $link['url'],
		'link_target' => $link['target'],
		'link_title' => $link['title'],
	];
};

$construction = $get_card($two_column_group, 'construction');
$service = $get_card($two_column_group, 'service');

$has_construction = ! empty($construction['image_url']) || ! empty($construction['mobile_image_url']) || ! empty($construction['eyebrow']) || ! empty($construction['heading']) || ! empty($construction['link_url']);
$has_service = ! empty($service['image_url']) || ! empty($service['mobile_image_url']) || ! empty($service['eyebrow']) || ! empty($service['heading']) || ! empty($service['link_url']);

if (! $has_construction && ! $has_service) {
	return;
}

$render_card = static function (string $card_type, array $data) {
	$has_link = ! empty($data['link_url']);
	$link_target = $data['link_target'] === '_blank' ? '_blank' : '_self';
	$link_rel = $link_target === '_blank' ? 'noopener noreferrer' : '';
	$aria_label = ! empty($data['link_title']) ? $data['link_title'] : $data['heading'];

	$tag_name = $has_link ? 'a' : 'div';
	$href_attr = $has_link ? ' href="' . esc_url($data['link_url']) . '"' : '';
	$target_attr = $has_link ? ' target="' . esc_attr($link_target) . '"' : '';
	$rel_attr = ($has_link && ! empty($link_rel)) ? ' rel="' . esc_attr($link_rel) . '"' : '';
	$aria_attr = $has_link ? ' aria-label="' . esc_attr($aria_label) . '"' : '';
	$drag_attr = $has_link ? ' draggable="false"' : '';
?>
	<<?php echo $tag_name; ?> class="m-two-column__card m-two-column__card--<?php echo esc_attr($card_type); ?>"<?php echo $href_attr . $target_attr . $rel_attr . $aria_attr . $drag_attr; ?>>
		<?php if (! empty($data['image_url']) || ! empty($data['mobile_image_url'])) : ?>
			<?php
			$display_image_url = ! empty($data['image_url']) ? $data['image_url'] : $data['mobile_image_url'];
			?>
			<div class="m-two-column__image-wrapper">
				<picture class="m-two-column__picture">
					<img
						class="m-two-column__image js-animate-image"
						src="<?php echo esc_url($display_image_url); ?>"
						alt="<?php echo esc_attr($data['image_alt']); ?>"
						loading="lazy" />
				</picture>
			</div>

		<?php endif; ?>

		<div class="m-two-column__overlay"></div>
		<div class="m-two-column__content">
			<?php if (! empty($data['eyebrow'])) : ?>
				<span class="m-two-column__eyebrow"><?php echo esc_html($data['eyebrow']); ?></span>
			<?php endif; ?>
			<?php if (! empty($data['heading'])) : ?>
				<?php
				$heading_clean = wp_kses_post($data['heading']);
				$heading_clean = preg_replace('/<\/?p[^>]*>/i', '', $heading_clean);
				?>
				<h2 class="m-two-column__heading"><?php echo $heading_clean; ?></h2>
			<?php endif; ?>
		</div>

		<?php if ($has_link) : ?>
			<span class="m-two-column__button">
				<span class="m-two-column__button-inner">
					<?php echo appian_get_svg_icon('arrow-right'); ?>
				</span>
			</span>
		<?php endif; ?>
	</<?php echo $tag_name; ?>>
<?php
};
?>

<section class="m-two-column">
	<div class="m-two-column__container">
		<?php if ($has_construction) : ?>
			<?php $render_card('construction', $construction); ?>
		<?php endif; ?>

		<?php if ($has_service) : ?>
			<?php $render_card('service', $service); ?>
		<?php endif; ?>
	</div>
</section>