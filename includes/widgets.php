<?php
/**
 * Rose
 *
 * This file adds theme specific functions to the Rose Theme.
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

// Register Before Header widget area.
genesis_register_sidebar( array(
	'id'          => 'before-header',
	'name'        => __( 'Before Header', 'rose' ),
	'description' => __( 'Before Header widget area.', 'rose' ),
) );

// Register Before Footer widget area.
genesis_register_sidebar( array(
	'id'          => 'before-footer',
	'name'        => __( 'Before Footer', 'rose' ),
	'description' => __( 'Before Footer widget area.', 'rose' ),
) );

// Register Footer Credits widget area.
genesis_register_sidebar( array(
	'id'          => 'footer-credits',
	'name'        => __( 'Footer Credits', 'rose' ),
	'description' => __( 'Footer Credits widget area.', 'rose' ),
) );

// Register Front Page widget areas.
genesis_register_sidebar( array(
	'id'           => 'front-page-1',
	'name'         => __( 'Front Page 1', 'rose' ),
	'description'  => __( 'This widget area can be used to display a large hero image, video or slider on the home page.', 'rose' ),
	'before_title' => '<h1 itemprop="headline">',
	'after_title'  => '</h1>',
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'rose' ),
	'description' => __( 'This widget area can be used to display brand logos on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'rose' ),
	'description' => __( 'This widget area can be used to display a video section and grid of icons on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'rose' ),
	'description' => __( 'This widget area can be used to display a large image on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-5',
	'name'        => __( 'Front Page 5', 'rose' ),
	'description' => __( 'This widget area can be used to display an image gallery on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-6',
	'name'        => __( 'Front Page 6', 'rose' ),
	'description' => __( 'This widget area can be used to display a call to action banner on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-7',
	'name'        => __( 'Front Page 7', 'rose' ),
	'description' => __( 'This widget area can be used to display a pricing table and testimonials on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-8',
	'name'        => __( 'Front Page 8', 'rose' ),
	'description' => __( 'This widget area can be used to display recent blog posts on the home page.', 'rose' ),
) );
genesis_register_sidebar( array(
	'id'          => 'front-page-9',
	'name'        => __( 'Front Page 9', 'rose' ),
	'description' => __( 'This widget area can be used to display a newsletter sign up form on the home page.', 'rose' ),
) );

add_action( 'genesis_before_header_wrap', 'rose_before_header' );
/**
 * Display Before Header widget area.
 *
 * This widget area is hooked to the before header wrap, inside of the
 * site-header element and outside of the site-header wrap creating
 * a full width section across the top of the screen while still
 * keeping semantically valid inside of the site-header scope.
 *
 * @since  1.0.0
 *
 * @return void
 */
function rose_before_header() {

	genesis_widget_area( 'before-header', array(
		'before' => '<div class="before-header widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

add_action( 'genesis_footer', 'rose_before_footer' );
/**
 * Display Before Footer widget area.
 *
 * This widget area is hooked to the before footer wrap, inside of the
 * site-footer element and outside of the site-footer wrap creating
 * a full-width section above the footer widgets, keeping it all
 * semantically valid inside of the site-footer element scope.
 *
 * @since  1.0.0
 *
 * @return void
 */
function rose_before_footer() {

	genesis_widget_area( 'before-footer', array(
		'before' => '<div class="before-footer widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

add_action( 'genesis_footer', 'rose_footer_credits', 14 );
/**
 * Display Footer Credits widget area.
 *
 * This widget area is hooked to the before footer wrap, inside of the
 * site-footer element and outside of the site-footer wrap creating
 * a full-width section above the footer widgets, keeping it all
 * semantically valid inside of the site-footer element scope.
 *
 * @since  1.0.0
 *
 * @return void
 */
function rose_footer_credits() {

	genesis_widget_area( 'footer-credits', array(
		'before' => '<div class="footer-credits widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}
