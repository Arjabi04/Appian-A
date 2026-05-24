<?php
/**
 * ACF Options Pages Configuration
 *
 * @package Outside_Traineeship_Biolerplate
 */

add_action( 'acf/init', function() {
	if ( function_exists( 'acf_add_options_page' ) ) {

		acf_add_options_page( array(
			'page_title' => 'Global Settings',
			'menu_title' => 'Global Settings',
			'menu_slug'  => 'global-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'Header',
			'menu_title'  => 'Header',
			'parent_slug' => 'global-settings',
		) );

	}
} );
