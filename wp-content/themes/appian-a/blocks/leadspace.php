<?php

$leadspace_group = get_field('leadspace_group');
$leadspace_group = is_array($leadspace_group) ? $leadspace_group : get_field('leadspace');
$leadspace_group = is_array($leadspace_group) ? $leadspace_group : [];

$leadspace_video = $leadspace_group['background_video'] ?? [];
$leadspace_video = is_array($leadspace_video) ? $leadspace_video : [];

$leadspace_image = $leadspace_group['background_image'] ?? [];
$leadspace_image = is_array($leadspace_image) ? $leadspace_image : [];

$eyebrow_text = $leadspace_group['eyebrow_text'] ?? '';
$heading_mobile = $leadspace_group['heading_mobile'] ?? '';
$heading_desktop = $leadspace_group['heading_desktop'] ?? '';

$video_url = $leadspace_video['url'] ?? '';
$image_url = $leadspace_image['url'] ?? '';
$image_alt = $leadspace_image['alt'] ?? '';

$has_media = ! empty($video_url) || ! empty($image_url);
$has_text = ! empty($eyebrow_text) || ! empty($heading_mobile) || ! empty($heading_desktop);

if (! $has_media && ! $has_text) {
	return;
}

$section_label = $heading_desktop ?: $heading_mobile ?: $eyebrow_text ?: 'Leadspace';
?>

<section class="leadspace" aria-label="<?php echo esc_attr($section_label); ?>">
	<?php if ($has_media) : ?>
		<div class="leadspace__eclipse leadspace__eclipse--76" aria-hidden="true">
			<?php if (! empty($video_url)) : ?>
				<?php if (! empty($image_url)) : ?>
					<link rel="preload" as="image" href="<?php echo esc_url($image_url); ?>" fetchpriority="high">
				<?php endif; ?>
				<video
					class="leadspace__video"
					src="<?php echo esc_url($video_url); ?>"
					<?php if (! empty($image_url)) : ?>poster="<?php echo esc_url($image_url); ?>"<?php endif; ?>
					autoplay
					muted
					loop
					playsinline
					preload="metadata"
					fetchpriority="high"></video>
			<?php elseif (! empty($image_url)) : ?>
				<img
					class="leadspace__image"
					src="<?php echo esc_url($image_url); ?>"
					alt="<?php echo esc_attr($image_alt); ?>"
					loading="eager"
					fetchpriority="high" />
			<?php endif; ?>
			<div class="leadspace__overlay" aria-hidden="true"></div>
		</div>

		<div class="leadspace__arc" aria-hidden="true">
			<svg
				class="leadspace__arc-svg"
				xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 2000 2000"
				fill="none"
				focusable="false"
				preserveAspectRatio="xMidYMid meet"
			>
				<path
					class="leadspace__arc-ring"
					d="M 220 1654 A 1018 1018 0 0 0 1780 1654"
					stroke="#101922"
					stroke-width="8"
					stroke-linecap="round"
				/>
				<path
					class="leadspace__arc-path"
					d="M 220 1654 A 1018 1018 0 0 0 1780 1654"
					stroke="#D72027"
					stroke-width="8"
					stroke-linecap="round"
				/>
			</svg>
		</div>
	<?php endif; ?>

	<?php if ($has_text) : ?>
		<div class="leadspace__inner">
			<div class="leadspace__content">
				<?php if (! empty($eyebrow_text)) : ?>
					<p class="leadspace__eyebrow body-sm-all"><?php echo esc_html($eyebrow_text); ?></p>
				<?php endif; ?>
				<?php if (! empty($heading_mobile) || ! empty($heading_desktop)) : ?>
					<h1 class="leadspace__heading d1">
						<?php if (! empty($heading_mobile)) : ?>
							<span class="leadspace__heading-mobile"><?php echo esc_html($heading_mobile); ?></span>
						<?php endif; ?>
						<?php if (! empty($heading_desktop)) : ?>
							<span class="leadspace__heading-desktop"><?php echo esc_html($heading_desktop); ?></span>
						<?php endif; ?>
					</h1>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</section>
