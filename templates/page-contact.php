<?php
/**
 * Rose
 *
 * This file adds the contact page template to the Rose Theme.
 *
 * Template Name: Contact Page
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

add_filter( 'body_class', 'rose_add_contact_body_class' );
/**
 * Add contact page body class to the head.
 *
 * @since  1.0.0
 *
 * @param  array $classes Array of body classes.
 *
 * @return array
 */
function rose_add_contact_body_class( $classes ) {

	$classes[] = 'contact-page';

	return $classes;

}

add_action( 'genesis_before_content_sidebar_wrap', 'rose_contact_page_map' );
/**
 * Display Google map shortcode.
 *
 * Simply echoes the default map shortcode created by the Google Map plugin.
 *
 * @since  1.0.0
 *
 * @return void
 */
function rose_contact_page_map() {

	echo do_shortcode( '[ank_google_map]' );

}

// Remove default hero section (show map instead).
remove_action( 'genesis_before_content_sidebar_wrap', 'rose_hero_section' );

// Add entry title back inside content.
add_action( 'genesis_entry_header', 'genesis_do_post_title', 2 );

// Add page excerpt just below the title.
add_action( 'genesis_entry_header', 'rose_page_excerpt', 3 );

// Run the Genesis loop.
genesis();
