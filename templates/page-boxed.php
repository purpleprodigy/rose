<?php
/**
 * Rose
 *
 * This file adds the boxed page template to the Rose Theme.
 *
 * Template Name: Boxed Template
 *
 * @package   SEOThemes\CorporatePro
 * @link      https://seothemes.com/themes/rose
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {

	die;

}

add_filter( 'body_class', 'rose_add_boxed_body_class' );
/**
 * Add contact page body class to the head.
 *
 * @since  1.0.0
 *
 * @param  array $classes Array of body classes.
 *
 * @return array
 */
function rose_add_boxed_body_class( $classes ) {

	$classes[] = 'boxed-page';

	return $classes;

}

// Run the Genesis loop.
genesis();
