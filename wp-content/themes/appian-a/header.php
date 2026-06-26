<?php

/**
 * Header
 */
?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		html {
			scrollbar-gutter: stable;
		}
	</style>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

	<a class="skip-link" href="#primary">Skip to content</a>

	<div id="page" class="site">

		<?php get_template_part('template-parts/site-header/site-header'); ?>