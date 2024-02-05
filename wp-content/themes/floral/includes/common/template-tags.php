<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: template-tags.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package 9WPThemes
 */

/**
 * get page title
 * @return string
 */
function floral_get_page_title() {
	global $wp_query;
	$title = floral_get_meta_or_option( 'page-title-custom', '', '', floral_get_template_prefix() );
	
	if ( !empty( $title )) {
		return $title;
	}
	
	//woocoomerce page
	if ( function_exists( 'is_woocoomerce' ) && is_woocommerce() || function_exists( 'is_shop' ) && is_shop() ):
		if ( apply_filters( 'woocommerce_show_page_title', true ) ):
			$title = woocommerce_page_title( false );
		endif;
	// Default Latest Posts page
	elseif ( is_home() ) :
		if ( $wp_query->is_posts_page ) {
			$title = get_the_title( get_queried_object_id() );
		} else {
			$title = esc_html__( 'Home', 'floral' );
		}
	// Singular
	elseif( is_singular() ) :
		$title = get_the_title();
	// Search
	elseif ( is_search() ) :
		$title = sprintf( esc_html__( 'Search results for &ldquo; %s &rdquo;', 'floral' ), get_search_query() );
	// Category and other Taxonomies
	elseif ( is_category() ) :
		$title = single_cat_title( '', false );
	
	elseif ( is_tag() ) :
		$title = single_tag_title( '', false );
	
	elseif ( is_author() ) :
		$title = sprintf( esc_html__( 'Author: %s', 'floral' ), '<span class="vcard">' . get_the_author() . '</span>' );
	
	elseif ( is_day() ) :
		$title = sprintf( esc_html__( 'Day: %s', 'floral' ), '<span>' . get_the_date() . '</span>' );
	
	elseif ( is_month() ) :
		$title = sprintf( esc_html__( 'Month: %s', 'floral' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'floral' ) ) . '</span>' );
	
	elseif ( is_year() ) :
		$title = sprintf( esc_html__( 'Year: %s', 'floral' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'floral' ) ) . '</span>' );
	
	elseif ( is_tax() ) :
		$term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = $term->name;
	
	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		$title = esc_html__( 'Asides', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		$title = esc_html__( 'Galleries', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		$title = esc_html__( 'Images', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		$title = esc_html__( 'Videos', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		$title = esc_html__( 'Quotes', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		$title = esc_html__( 'Links', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		$title = esc_html__( 'Statuses', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		$title = esc_html__( 'Audios', 'floral' );
	
	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		$title = esc_html__( 'Chats', 'floral' );
	
	elseif ( is_404() ) :
		$title = esc_html__( '404 Error', 'floral' );
	elseif ( is_post_type_archive() ) :
		$title = post_type_archive_title( '', false );
	else :
		$title = esc_html__( 'Archives', 'floral' );
	endif;
	
	return $title;
}


/**
 * get page subtitle
 *
 * @return string
 */
function floral_get_page_subtitle() {
	$subtitle = floral_get_meta_option( 'page-title-subtitle' );
	if ( floral_is_meta_default_value( $subtitle ) || $subtitle == null ) {
		$subtitle = floral_get_option( 'page-title-subtitle', '', '', floral_get_template_prefix() );
	}
	
	return $subtitle;
}

/**
 * Filter the custom wp title
 *
 * @param $title
 *
 * @return null
 */
function floral_filter_the_title( $title ) {
	if ( is_home() && !is_front_page() ) {
		$_title = floral_get_option( 'page-title-custom', '', '', floral_get_template_prefix() );
		if ( $_title ) {
			$title = $_title;
		}
	}

//    if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) {
//        return sprintf( '<title>%s</title>', $title );
//    } else {
	return $title;
//    }
}

add_filter( 'wp_title', 'floral_filter_the_title', 10, 2 );

