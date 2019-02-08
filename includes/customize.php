<?php
/**
 * Rose
 *
 * This file adds Customizer settings to the Rose theme.
 *
 * @package Rose
 * @author  Purple Prodigy
 * @license GPL-2.0+
 * @link    https://purpleprodigy.com
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_action( 'customize_register', 'rose_customize_register', 20 );
/**
 * Sets up the theme Customizer sections, controls, and settings.
 *
 * @access public
 *
 * @param  object $wp_customize Global Customizer object.
 *
 * @return void
 */
function rose_customize_register( $wp_customize ) {

	// Globals.
	global $wp_customize;

	// Load RGBA Customizer control.
	include_once CHILD_THEME_DIR . '/includes/rgba.php';

	// Remove default colors, using custom instead.
	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_control( 'header_textcolor' );

	// Add logo size setting.
	$wp_customize->add_setting(
		'rose_logo_size',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => rose_logo_size(),
			'sanitize_callback' => 'rose_sanitize_number',
		)
	);

	// Add logo size control.
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'rose_logo_size',
			array(
				'label'       => __( 'Logo Size', 'rose' ),
				'description' => __( 'Set the logo size in pixels. Default is ', 'rose' ) . rose_logo_size(),
				'settings'    => 'rose_logo_size',
				'section'     => 'title_tagline',
				'type'        => 'number',
				'priority'    => 8,
			)
		)
	);

	// Add header settings.
	$wp_customize->add_setting( 'rose_sticky_header' );

	// Add header controls.
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'rose_sticky_header',
			array(
				'label'    => __( 'Enable sticky header', 'rose' ),
				'settings' => 'rose_sticky_header',
				'section'  => 'genesis_layout',
				'type'     => 'checkbox',
			)
		)
	);

	// Add gradient one settings.
	$wp_customize->add_setting(
		'rose_gradient_one_color',
		array(
			'default'           => rose_gradient_one_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Add gradient one controls.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rose_gradient_one_color',
			array(
				'label'    => __( 'Gradient One Color', 'rose' ),
				'settings' => 'rose_gradient_one_color',
				'section'  => 'colors',
			)
		)
	);

	// Add gradient two settings.
	$wp_customize->add_setting(
		'rose_gradient_two_color',
		array(
			'default'           => rose_gradient_two_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	// Add gradient two controls.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'rose_gradient_two_color',
			array(
				'label'    => __( 'Gradient Two Color', 'rose' ),
				'settings' => 'rose_gradient_two_color',
				'section'  => 'colors',
			)
		)
	);

	// Add color setting.
	$wp_customize->add_setting(
		'rose_overlay_color',
		array(
			'default'           => rose_overlay_color(),
			'sanitize_callback' => 'rose_sanitize_rgba',
		)
	);

	// Add color control.
	$wp_customize->add_control(
		new RGBA_Customize_Control(
			$wp_customize,
			'rose_overlay_color',
			array(
				'section'      => 'colors',
				'label'        => __( 'Overlay Color', 'rose' ),
				'settings'     => 'rose_overlay_color',
				'show_opacity' => true,
				'palette'      => true,
			)
		)
	);

}

add_action( 'wp_enqueue_scripts', 'rose_customizer_output', 100 );
/**
 * Output Customizer styles.
 *
 * Checks the settings for the colors defined in the Customizer.
 * If any of these value are set the appropriate CSS is output.
 *
 * @var   array $rose_colors Global theme colors.
 */
function rose_customizer_output() {

	// Theme colors.
	$gradient_one = get_theme_mod( 'rose_gradient_one_color', rose_gradient_one_color() );
	$gradient_two = get_theme_mod( 'rose_gradient_two_color', rose_gradient_two_color() );
	$overlay      = get_theme_mod( 'rose_overlay_color', rose_overlay_color() );

	// Other customizer settings.
	$logo_size = get_theme_mod( 'rose_logo_size', rose_logo_size() );

	// Load color class.
	include_once CHILD_THEME_DIR . '/includes/colors.php';

	// Initialize accent color.
	$accent = new Corporate_Color( $gradient_one );
	$mix    = '#' . $accent->mix( $gradient_two );
	$shadow = rose_hex_to_rgba( $mix, 0.3 );

	// Ensure $css var is empty.
	$css = '';

	// Logo size CSS.
	$css .= ( rose_logo_size() !== $logo_size ) ? sprintf( '

		.wp-custom-logo .title-area {
			width: %1$spx;
		}

	', $logo_size ) : '';

	// Overlay color CSS.
	$css .= ( rose_overlay_color() !== $overlay ) ? "

		.hero-section:before,
		.front-page-5 .image:before,
		.front-page-9:before,
		.entry:before {
			background: {$overlay};
		}

	" : '';
//
//	// Gradient color CSS.
//	$css .= ( rose_gradient_one_color() !== $gradient_one || rose_gradient_two_color() !== $gradient_two ) ? "
//
//		.button,
//		button,
//		input[type='button'],
//		input[type='reset'],
//		input[type='submit'],
//		.front-page-6,
//		.before-footer,
//		.archive-pagination .active a,
//		.wp-block-button a {
//			background: {$gradient_one};
//			background: -moz-linear-gradient(-45deg,  {$gradient_one} 0%, {$gradient_two} 100%);
//			background: -webkit-linear-gradient(-45deg,  {$gradient_one} 0%,{$gradient_two} 100%);
//			background: linear-gradient(135deg,  {$gradient_one} 0%,{$gradient_two} 100%);
//			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$gradient_one}', endColorstr='{$gradient_two}',GradientType=1 );
//		}
//
//		.button:hover,
//		.button:focus,
//		button:hover,
//		button:focus,
//		input[type='button']:hover,
//		input[type='button']:focus,
//		input[type='reset']:hover,
//		input[type='reset']:focus,
//		input[type='submit']:hover,
//		input[type='submit']:focus,
//		.wp-block-button a:hover,
//		.wp-block-button a:focus {
//			box-shadow: 0 0.5rem 2rem -0.5rem rgba({$shadow});
//		}
//
//		.button.outline,
//		button.outline,
//		input[type='button'].outline,
//		input[type='reset'].outline,
//		input[type='submit'].outline {
//			color: {$mix};
//			background: transparent;
//			box-shadow: inset 0 0 0 2px {$mix};
//		}
//
//		.button.outline:hover,
//		.button.outline:focus,
//		button.outline:hover,
//		button.outline:focus,
//		input[type='button'].outline:hover,
//		input[type='button'].outline:focus,
//		input[type='reset'].outline:hover,
//		input[type='reset'].outline:focus,
//		input[type='submit'].outline:hover,
//		input[type='submit'].outline:focus {
//			background-color: {$mix};
//			background: {$gradient_one};
//			background: -moz-linear-gradient(-45deg,  {$gradient_one} 0%, {$gradient_two} 100%);
//			background: -webkit-linear-gradient(-45deg,  {$gradient_one} 0%,{$gradient_two} 100%);
//			background: linear-gradient(135deg,  {$gradient_one} 0%,{$gradient_two} 100%);
//			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='{$gradient_one}', endColorstr='{$gradient_two}',GradientType=1 );
//		}
//
//		a,
//		.sidebar a:hover,
//		.sidebar a:focus,
//		.site-footer a:hover,
//		.site-footer a:focus,
//		.entry-title a:hover,
//		.entry-title a:focus,
//		.menu-item a:hover,
//		.menu-item a:focus,
//		.menu-item.current-menu-item > a,
//		.site-footer .menu-item a:hover,
//		.site-footer .menu-item a:focus,
//		.site-footer .menu-item.current-menu-item > a,
//		.entry-content p a:not(.button):hover,
//		.entry-content p a:not(.button):focus,
//		.pricing-table strong,
//		div.gs-faq .gs-faq__question:hover,
//		div.gs-faq .gs-faq__question:focus {
//			color: {$mix};
//		}
//
//		input:focus,
//		select:focus,
//		textarea:focus {
//			border-color: {$mix};
//		}
//
//		.entry-content p a:not(.button) {
//			box-shadow: inset 0 -1.5px 0 {$mix};
//		}
//
//		" : '';

	// Style handle is the name of the theme.
	$handle = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	// Output CSS if not empty.
	if ( ! empty( $css ) ) {

		// Add the inline styles, also minify CSS first.
		wp_add_inline_style( $handle, rose_minify_css( $css ) );

	}

}
