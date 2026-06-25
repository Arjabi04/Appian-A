<?php

$leadspace_group = get_field('leadspace_group');
$leadspace_group = is_array($leadspace_group) ? $leadspace_group : get_field('leadspace');
$leadspace_group = is_array($leadspace_group) ? $leadspace_group : [];

$leadspace_video = $leadspace_group['background_video'] ?? [];
$leadspace_video = is_array($leadspace_video) ? $leadspace_video : [];

$leadspace_image = $leadspace_group['background_image'] ?? [];
$leadspace_image = is_array($leadspace_image) ? $leadspace_image : [];

$eyebrow_text = $leadspace_group['eyebrow_text'] ?? '';
$heading = $leadspace_group['heading'] ?? '';

$video_url  = $leadspace_video['url'] ?? '';
$poster_url = $leadspace_image['url'] ?? '';

$has_media = ! empty($video_url);
$has_text = ! empty($eyebrow_text) || ! empty($heading);

if (! $has_media && ! $has_text) {
	return;
}

$section_label = $heading ?: $eyebrow_text ?: 'Leadspace';
?>

<section class="leadspace" aria-label="<?php echo esc_attr($section_label); ?>">
	<?php if ($has_media) : ?>
		<div class="leadspace__eclipse leadspace__eclipse--76" aria-hidden="true">
			<?php if (! empty($video_url)) : ?>
				<video
					class="leadspace__video"
					src="<?php echo esc_url($video_url); ?>"
					<?php if (! empty($poster_url)) : ?>poster="<?php echo esc_url($poster_url); ?>"<?php endif; ?>
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
				<?php if (! empty($heading)) : ?>
					<h1 class="leadspace__heading d1"><?php echo esc_html($heading); ?></h1>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</section>