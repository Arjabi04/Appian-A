<?php
/**
 * Centralized SVG Icon Registry.
 *
 * Dynamically loads SVG assets from the theme's resources/images/svgs/ folder.
 * Sanitizes Figma-exported hardcoded colors to use currentColor for general-purpose icons.
 *
 * Usage:
 *   $icons = appian_get_svg_icons();
 *   echo $icons['arrow-left'];
 *
 *   // Single icon:
 *   echo appian_get_svg_icon( 'arrow-left' );
 *
 * @package Appian_A
 */

if ( ! function_exists( 'appian_get_svg_icons' ) ) :

	/**
	 * Return the full icon registry by scanning resources/images/svgs/.
	 *
	 * @return array<string, string> Associative array of icon-name => SVG markup.
	 */
	function appian_get_svg_icons() {
		static $icons = null;

		if ( $icons !== null ) {
			return $icons;
		}

		$icons = [];
		$dir   = get_theme_file_path( 'resources/images/svgs' );

		if ( is_dir( $dir ) ) {
			$files = glob( $dir . '/*.svg' );
			if ( $files ) {
				foreach ( $files as $file ) {
					$filename = basename( $file );
					$name     = pathinfo( $filename, PATHINFO_FILENAME );

					// Read SVG content
					$content = file_get_contents( $file );
					if ( $content ) {
						// Dynamically sanitize color coding from Figma to use currentColor for icons.
						// Exclude logo and favicon from being converted to currentColor since they have brand coloring.
						if ( ! in_array( $name, [ 'logo', 'apian_logo', 'favicon', 'appian_favicon' ], true ) ) {
							$content = str_replace(
								[
									'stroke="#111111"',
									'fill="#111111"',
									'stroke="#000000"',
									'fill="#000000"',
									'stroke="#000"',
									'fill="#000"',
								],
								[
									'stroke="currentColor"',
									'fill="currentColor"',
									'stroke="currentColor"',
									'fill="currentColor"',
									'stroke="currentColor"',
									'fill="currentColor"',
								],
								$content
							);
						}

						$icons[ $name ] = trim( $content );
					}
				}
			}
		}

		// Backward compatibility and common alias mappings
		$aliases = [
			'close' => 'close',
			'call'  => 'call',
		];

		foreach ( $aliases as $alias => $real_name ) {
			if ( isset( $icons[ $real_name ] ) && ! isset( $icons[ $alias ] ) ) {
				$icons[ $alias ] = $icons[ $real_name ];
			}
		}

		return $icons;
	}

endif;

if ( ! function_exists( 'appian_get_svg_icon' ) ) :

	/**
	 * Return a single icon's SVG markup.
	 *
	 * @param  string $name Icon key (e.g. 'arrow-left').
	 * @return string       SVG markup or empty string if not found.
	 */
	function appian_get_svg_icon( $name ) {
		$icons = appian_get_svg_icons();
		return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
	}

endif;

if ( ! function_exists( 'appian_accordion_toggle_icon' ) ) :

	/**
	 * Return the accordion toggle icon markup.
	 *
	 * Loads accordion-toggle.svg dynamically from the assets.
	 *
	 * @return string SVG markup for the accordion toggle.
	 */
	function appian_accordion_toggle_icon() {
		$icon = appian_get_svg_icon( 'accordion-toggle' );
		if ( $icon ) {
			return '<span class="accordion-icon">' . $icon . '</span>';
		}
		return '<span class="accordion-icon"></span>';
	}

endif;
