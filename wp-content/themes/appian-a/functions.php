<?php

/**
 * 
 * Outside Traineeship Biolerplate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Outside_Traineeship_Biolerplate
 */
if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}
function vite_assets($entry)
{
	static $manifest;
	if (!$manifest) {
		$manifestPath = __DIR__ . '/public/.vite/manifest.json';

		$manifest = json_decode(
			file_get_contents($manifestPath),
			true
		);
	}
	if (!isset($manifest[$entry])) {
		return null;
	}
	return get_template_directory_uri() . '/public/' . $manifest[$entry]['file'];
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function outside_traineeship_biolerplate_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Outside Traineeship Biolerplate, use a find and replace
		* to change 'outside-traineeship-biolerplate' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('outside-traineeship-biolerplate', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1'  => esc_html__('Primary', 'outside-traineeship-biolerplate'),
			'primary' => esc_html__('Primary Navigation', 'outside-traineeship-biolerplate'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'outside_traineeship_biolerplate_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'outside_traineeship_biolerplate_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function outside_traineeship_biolerplate_content_width()
{
	$GLOBALS['content_width'] = apply_filters('outside_traineeship_biolerplate_content_width', 640);
}
add_action('after_setup_theme', 'outside_traineeship_biolerplate_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function outside_traineeship_biolerplate_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'outside-traineeship-biolerplate'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'outside-traineeship-biolerplate'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'outside_traineeship_biolerplate_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function outside_traineeship_biolerplate_scripts()
{
	wp_enqueue_style('app-css', vite_assets('resources/styles/app.scss'), true, null,);
	wp_enqueue_script('app-js', vite_assets('resources/scripts/app.js'), [''], null, true);
}
add_action('wp_enqueue_scripts', 'outside_traineeship_biolerplate_scripts', 2);


function is_block_preview()
{
	return is_admin() ? true : false;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/acf-block.php';
require get_template_directory() . '/inc/svg-icons.php';
require get_template_directory() . '/inc/acf-options.php';
require get_template_directory() . '/inc/class-header-walker.php';
require_once get_template_directory() . '/inc/newsletter-submissions.php';
/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

require_once get_template_directory() . '/inc/vite.php';

function appian_footer_email_empty_ajax()
{
	if (! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'appian_footer_email')) {
		wp_send_json_error(['message' => 'invalid_nonce'], 403);
	}

	error_log('Footer subscribe: empty email submitted.');
	wp_send_json_success();
}

add_action('wp_ajax_appian_footer_email_empty', 'appian_footer_email_empty_ajax');
add_action('wp_ajax_nopriv_appian_footer_email_empty', 'appian_footer_email_empty_ajax');

function theme_assets()
{

	$is_dev = defined('WP_ENV')
		&& WP_ENV === 'development';

	// Vite HMR
	if ($is_dev) {

		wp_enqueue_script(
			'vite-client',
			'http://localhost:5173/@vite/client',
			[],
			null,
			true
		);

		wp_enqueue_script(
			'theme-app',
			'http://localhost:5173/resources/scripts/app.js',
			[],
			null,
			true
		);

		return;
	}

	$manifest = theme_vite_manifest();

	$entry = $manifest['resources/scripts/app.js'] ?? false;

	if (! $entry) {
		return;
	}

	// CSS
	if (! empty($entry['css'])) {

		foreach ($entry['css'] as $css) {

			wp_enqueue_style(
				'theme-app',
				get_template_directory_uri() . '/public/' . $css,
				[],
				null
			);
		}
	}

	// JS
	wp_enqueue_script(
		'theme-app',
		get_template_directory_uri() . '/public/' . $entry['file'],
		[],
		null,
		true
	);
}

add_action('wp_enqueue_scripts', 'theme_assets');

/**
 * Enqueue block editor assets (Gutenberg) built by Vite.
 */
function theme_block_editor_assets()
{

	$is_dev = defined('WP_ENV')
		&& WP_ENV === 'development';

	/**
	 * Development (Vite HMR)
	 */
	if ($is_dev) {

		// Vite client
		wp_enqueue_script(
			'vite-client',
			'http://localhost:5173/@vite/client',
			[],
			null,
			true
		);

		// Editor entry
		// IMPORTANT:
		// editor.js should import ../styles/editor.scss
		wp_enqueue_script(
			'theme-editor',
			'http://localhost:5173/resources/scripts/editor.js',
			[],
			null,
			true
		);

		return;
	}

	/**
	 * Production
	 */
	$manifest = theme_vite_manifest();

	$entry = $manifest['resources/scripts/editor.js'] ?? false;

	if (! $entry) {
		return;
	}

	// Enqueue extracted CSS from manifest
	if (! empty($entry['css'])) {

		foreach ($entry['css'] as $css) {
			wp_enqueue_style(
				'theme-editor-css',
				get_template_directory_uri() . '/public/' . $css,
				[],
				null
			);
		}
	}

	// Enqueue JS
	wp_enqueue_script(
		'theme-editor-js',
		get_template_directory_uri() . '/public/' . $entry['file'],
		[],
		null,
		true
	);
}

add_action(
	'enqueue_block_editor_assets',
	'theme_block_editor_assets'
);

add_action('enqueue_block_editor_assets', 'theme_block_editor_assets');

/**
 * Validate ACF phone number fields to ensure they match US phone number formats.
 *
 * Accepts formats like (301) 816-2088, 301-816-2088, 301.816.2088, 3018162088, +13018162088.
 *
 * @param bool   $valid The validation status.
 * @param mixed  $value The value of the field.
 * @param array  $field The field array.
 * @param string $input The input name.
 * @return bool|string True if valid, error message string if invalid.
 */
function appian_validate_header_phone($valid, $value, $field, $input)
{
	if (! $valid || empty($value)) {
		return $valid;
	}

	// Regex matching US phone formats like:
	// - (301) 816-2088
	// - 301-816-2088
	// - 301.816.2088
	// - 3018162088
	// - +13018162088
	$pattern = '/^\+?1?[\s.-]?(?:\(\d{3}\)|\d{3})[\s.-]?\d{3}[\s.-]?\d{4}$/';

	if (! preg_match($pattern, $value)) {
		return 'Please enter a valid US phone number e.g. (301) 816-2088';
	}

	return $valid;
}
add_filter('acf/validate_value/name=phone_number', 'appian_validate_header_phone', 10, 4);
add_filter('acf/validate_value/name=header_phone', 'appian_validate_header_phone', 10, 4);
add_filter('acf/validate_value/name=fax_number', 'appian_validate_header_phone', 10, 4);

/**
 * Preload background assets for leadspace and secondary-hero blocks in the head.
 */
function appian_get_first_block_data( $block_name, $blocks = null ) {
	if ( null === $blocks ) {
		$post = get_post();
		if ( ! $post ) {
			return [];
		}

		$blocks = parse_blocks( $post->post_content );
	}

	foreach ( $blocks as $block ) {
		if ( ! empty( $block['blockName'] ) && $block_name === $block['blockName'] ) {
			$data = $block['attrs']['data'] ?? [];
			return is_array( $data ) ? $data : [];
		}

		if ( ! empty( $block['innerBlocks'] ) && is_array( $block['innerBlocks'] ) ) {
			$nested_data = appian_get_first_block_data( $block_name, $block['innerBlocks'] );
			if ( ! empty( $nested_data ) ) {
				return $nested_data;
			}
		}
	}

	return [];
}

function appian_get_block_media_url( $value ) {
	if ( is_array( $value ) ) {
		return $value['url'] ?? '';
	}

	if ( is_numeric( $value ) ) {
		return wp_get_attachment_url( (int) $value ) ?: '';
	}

	return is_string( $value ) ? $value : '';
}

function appian_preload_hero_assets() {
	if ( ! is_singular() ) {
		return;
	}

	if ( has_block( 'acf/leadspace' ) ) {
		$leadspace_data = appian_get_first_block_data( 'acf/leadspace' );
		$video_url      = appian_get_block_media_url( $leadspace_data['leadspace_group_background_video'] ?? '' );
		$poster_url     = appian_get_block_media_url( $leadspace_data['leadspace_group_background_image'] ?? '' );

		if ( ! empty( $poster_url ) ) {
			echo '	<link rel="preload" as="image" href="' . esc_url( $poster_url ) . '" fetchpriority="high">' . "\n";
		}

		if ( ! empty( $video_url ) ) {
			echo '	<link rel="preload" as="video" href="' . esc_url( $video_url ) . '" fetchpriority="high">' . "\n";
		}
	}

	if ( has_block( 'acf/secondary-hero' ) ) {
		$secondary_hero_group = get_field( 'secondary_hero' );
		$hero_video           = $secondary_hero_group['secondaryhero__video'] ?? [];
		$hero_image           = $secondary_hero_group['secondaryhero__image'] ?? [];
		$hero_video_url       = is_array( $hero_video ) ? ( $hero_video['url'] ?? '' ) : '';
		$hero_image_url       = $hero_image['url'] ?? '';

		if ( ! empty( $hero_video_url ) ) {
			echo '	<link rel="preload" as="video" href="' . esc_url( $hero_video_url ) . '" fetchpriority="high">' . "\n";
		}

		if ( ! empty( $hero_image_url ) ) {
			echo '	<link rel="preload" as="image" href="' . esc_url( $hero_image_url ) . '" fetchpriority="high">' . "\n";
		}
	}
}
add_action( 'wp_head', 'appian_preload_hero_assets', 1 );

require get_template_directory() . '/inc/cpt-projects.php';

