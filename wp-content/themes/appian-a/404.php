<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Outside_Traineeship_Biolerplate
 */

get_header();

$error_404   = get_field('error_404', 'option');
$bg_image    = $error_404['background_image'] ?? null;
$eyebrow     = $error_404['eyebrow']          ?? '';
$heading     = $error_404['heading']          ?? '';
$description = $error_404['description']      ?? '';
$cta_button  = $error_404['cta_button']       ?? null;
$cta_url     = $cta_button['url']             ?? '';
$cta_text    = $cta_button['title']           ?? '';
$cta_target  = $cta_button['target']          ?? '_self';
?>
<section class="error-404 not-found ">
	<?php if (!empty($bg_image) && !empty($bg_image['url'])) : ?>
		<img
			class="error-404__background"
			src="<?php echo esc_url($bg_image['url']); ?>"
			alt="<?php echo esc_attr($bg_image['alt'] ?? ''); ?>"
			aria-hidden="true">
	<?php endif; ?>

	<div class="error-404__content d-flex flex-column align-items-center grid-container ">
		<div class="error-404__page-header d-flex flex-column align-items-center">
			<?php if (!empty($eyebrow)) : ?>
				<p class="error-404__eyebrow text-center c1 "><?php echo esc_html($eyebrow); ?></p>
			<?php endif; ?>
			<?php if (!empty($heading)) : ?>
				<h1 class="error-404__heading d2 m-0"><?php echo esc_html($heading); ?></h1>
			<?php endif; ?>
		</div>
		<?php if (!empty($description)) : ?>
			<p class="sh3 "><?php echo esc_html($description); ?></p>
		<?php endif; ?>
		<?php if (!empty($cta_button) && !empty($cta_url)) : ?>
			<?php $cta_is_blank = ($cta_target === '_blank'); ?>
			<a href="<?php echo esc_url($cta_url); ?>" class="btn btn-primary" target="<?php echo esc_attr($cta_target); ?>" <?php if ($cta_is_blank) : ?>rel="noopener noreferrer" <?php endif; ?>><?php echo esc_html($cta_text); ?><?php echo appian_get_svg_icon('arrow-right'); ?></a>
		<?php endif; ?>
	</div>


</section><!-- .error-404 -->


<?php
get_footer();
