<?php
/**
 * Centralized SVG Icon Registry.
 *
 * Returns inline SVG markup keyed by icon name.
 * All general-purpose icons use currentColor for theming.
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
	 * Return the full icon registry.
	 *
	 * @return array<string, string> Associative array of icon-name => SVG markup.
	 */
	function appian_get_svg_icons() {
		return [
			'arrow-left'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 12H5M12 5L5 12L12 19" stroke="currentColor" stroke-width="2" stroke-miterlimit="5.75877" stroke-linecap="square"/></svg>',
			'arrow-right' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 12H19M12 19L19 12L12 5" stroke="currentColor" stroke-width="2" stroke-miterlimit="5.75877" stroke-linecap="square"/></svg>',
			'arrow-down'  => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>',
			'close'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="square"/></svg>',
			'menu'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-miterlimit="5.75877" stroke-linecap="square"/></svg>',
			'play'        => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 3L19 12L5 21V3Z" fill="currentColor" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>',
			'pause'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 4H6V20H10V4Z" fill="currentColor"/><path d="M18 4H14V20H18V4Z" fill="currentColor"/></svg>',
			'quote'       => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.3897 5.92019C7.36622 6.57746 4.67139 8.94366 4.67139 12.8216C5.26294 12.23 6.05167 11.8357 7.03758 11.8357C9.07514 11.8357 10.4554 13.216 10.4554 15.385C10.4554 17.3568 8.74651 19 6.57749 19C4.07984 19 2.43665 17.1596 2.43665 14.2676C2.43665 9.2723 5.39439 5.52582 10.3897 5V5.92019ZM13.5446 14.2676C13.5446 9.2723 16.5024 5.52582 21.4977 5V5.92019C18.4742 6.57746 15.7794 8.94366 15.7794 12.8216C16.3709 12.23 17.1597 11.8357 18.1456 11.8357C20.1831 11.8357 21.5634 13.216 21.5634 15.385C21.5634 17.3568 19.8545 19 17.6855 19C15.1878 19 13.5446 17.1596 13.5446 14.2676Z" fill="currentColor"/></svg>',
			'linkedin'    => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2 0C0.895427 0 0 0.895427 0 2V22C0 23.1045 0.895427 24 2 24H22C23.1045 24 24 23.1045 24 22V2C24 0.895427 23.1045 0 22 0H2ZM7.36101 5.33696C7.36852 6.61196 6.41415 7.39759 5.28164 7.39196C4.21476 7.38633 3.28476 6.53696 3.29039 5.33884C3.29601 4.21196 4.18664 3.30633 5.34352 3.33259C6.51727 3.35884 7.36852 4.21947 7.36101 5.33696ZM12.3729 9.01568H9.01295H9.01107V20.4288H12.5623V20.1625C12.5623 19.656 12.5619 19.1493 12.5615 18.6425C12.5604 17.2908 12.5592 15.9376 12.5661 14.5863C12.568 14.2581 12.5829 13.9169 12.6673 13.6037C12.9841 12.4337 14.0361 11.6781 15.2099 11.8639C15.9636 11.9819 16.4623 12.4188 16.6723 13.1295C16.8017 13.5737 16.8599 14.0519 16.8655 14.5151C16.8807 15.9119 16.8785 17.3087 16.8764 18.7056C16.8756 19.1987 16.8748 19.692 16.8748 20.1851V20.4269H20.4373V20.1532C20.4373 19.5505 20.4371 18.948 20.4367 18.3455C20.436 16.8395 20.4352 15.3335 20.4392 13.8269C20.4411 13.1463 20.368 12.4751 20.2011 11.8169C19.9517 10.8381 19.4361 10.0281 18.598 9.4432C18.0036 9.02692 17.3511 8.7588 16.6217 8.7288C16.5387 8.72535 16.4549 8.72083 16.3708 8.71628C15.9979 8.69612 15.6188 8.67564 15.2623 8.74755C14.2423 8.95192 13.3461 9.4188 12.6692 10.2419C12.5905 10.3363 12.5136 10.4321 12.3988 10.5752L12.3729 10.6076V9.01568ZM3.57552 20.4325H7.10989V9.02311H3.57552V20.4325Z" fill="currentColor"/></svg>',
			'call'        => '<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.9381 5C14.9149 5.19057 15.8125 5.66826 16.5162 6.37194C17.2199 7.07561 17.6976 7.97326 17.8881 8.95M13.9381 1C15.9674 1.22544 17.8597 2.13417 19.3044 3.57701C20.749 5.01984 21.6601 6.91101 21.8881 8.94M20.8881 16.92V19.92C20.8892 20.1985 20.8322 20.4742 20.7206 20.7293C20.6091 20.9845 20.4454 21.2136 20.2402 21.4019C20.035 21.5901 19.7927 21.7335 19.5289 21.8227C19.265 21.9119 18.9855 21.9451 18.7081 21.92C15.631 21.5856 12.6751 20.5341 10.0781 18.85C7.66194 17.3147 5.61345 15.2662 4.07812 12.85C2.38809 10.2412 1.33636 7.27099 1.00812 4.18C0.983127 3.90347 1.01599 3.62476 1.10462 3.36162C1.19324 3.09849 1.33569 2.85669 1.52288 2.65162C1.71008 2.44655 1.93792 2.28271 2.19191 2.17052C2.44589 2.05833 2.72046 2.00026 2.99812 2H5.99812C6.48342 1.99522 6.95391 2.16708 7.32188 2.48353C7.68985 2.79999 7.93019 3.23945 7.99812 3.72C8.12474 4.68007 8.35957 5.62273 8.69812 6.53C8.83266 6.88792 8.86178 7.27691 8.78202 7.65088C8.70227 8.02485 8.51698 8.36811 8.24812 8.64L6.97812 9.91C8.40167 12.4135 10.4746 14.4864 12.9781 15.91L14.2481 14.64C14.52 14.3711 14.8633 14.1858 15.2372 14.1061C15.6112 14.0263 16.0002 14.0555 16.3581 14.19C17.2654 14.5286 18.2081 14.7634 19.1681 14.89C19.6539 14.9585 20.0975 15.2032 20.4146 15.5775C20.7318 15.9518 20.9003 16.4296 20.8881 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
		];
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
	 * Single plus-sign SVG inside a dark circle with drop shadow.
	 * CSS rotates the plus 45deg on expand to form an X.
	 * Uses currentColor for the circle fill so color is set via CSS.
	 *
	 * @return string SVG markup for the accordion toggle.
	 */
	function appian_accordion_toggle_icon() {
		return '<span class="accordion-icon"><svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg"><g filter="url(#filter_acc_toggle)"><circle cx="23" cy="19" r="16" fill="currentColor"/></g><path d="M23.5518 12.9316L23.5518 26.173" stroke="white" stroke-linecap="round"/><path d="M30.1724 19.5508L16.931 19.5508" stroke="white" stroke-linecap="round"/><defs><filter id="filter_acc_toggle" x="0" y="0" width="46" height="46" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/><feOffset dy="4"/><feGaussianBlur stdDeviation="3.5"/><feComposite in2="hardAlpha" operator="out"/><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/><feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/></filter></defs></svg></span>';
	}

endif;
