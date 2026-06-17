<?php

$leadspace_group = get_field('leadspace_group');
$leadspace_group = is_array($leadspace_group) ? $leadspace_group : get_field('leadspace');
$leadspace_group = is_array($leadspace_group) ? $leadspace_group : [];

$leadspace_video = $leadspace_group['background_video'] ?? [];
$leadspace_video = is_array($leadspace_video) ? $leadspace_video : [];

$eyebrow_text = $leadspace_group['eyebrow_text'] ?? '';
$heading_mobile = $leadspace_group['heading_mobile'] ?? '';
$heading_desktop = $leadspace_group['heading_desktop'] ?? '';

$video_url = $leadspace_video['url'] ?? '';

$has_media = ! empty($video_url);
$has_text = ! empty($eyebrow_text) || ! empty($heading_mobile) || ! empty($heading_desktop);

if (! $has_media && ! $has_text) {
	return;
}

$section_label = $heading_desktop ?: $heading_mobile ?: $eyebrow_text ?: 'Leadspace';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<section class="leadspace" aria-label="<?php echo esc_attr($section_label); ?>">
	<?php if ($has_media) : ?>
		<div class="leadspace__eclipse leadspace__eclipse--76" aria-hidden="true">
			<?php if (! empty($video_url)) : ?>
				<video
					class="leadspace__video"
					src="<?php echo esc_url($video_url); ?>"
					autoplay
					muted
					loop
					playsinline
					preload="metadata"
					fetchpriority="high"></video>
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
