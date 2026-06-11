<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Outside_Traineeship_Biolerplate
 */

get_header();
?>
<section class="error-404 not-found ">
	<img
		class="error-404__background"
		src="<?php echo esc_url(get_template_directory_uri() . '/resources/images/404-background.jpg'); ?>"
		alt=""
		aria-hidden="true">

	<div class="error-404__content d-flex flex-column align-items-center grid-container ">
		<div class="error-404__page-header d-flex flex-column align-items-center">
			<p class="error-404__eyebrow text-center c1 ">404 error</p>
			<h1 class="error-404__heading d2 m-0">Page Not Found</h1>
		</div>
		<p class="sh3 ">Sorry, we couldn't locate that page. It might have been relocated, removed, or perhaps it was never here.</p>
		<a href="#" class="btn btn-primary">Go to Homepage<?php echo appian_get_svg_icon('arrow-right'); ?></a>
	</div>


</section><!-- .error-404 -->


<?php
get_footer();
