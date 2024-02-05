<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: main-nav.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$template_prefix = floral_get_template_prefix();

$nav_width       = floral_get_meta_or_option( 'nav-width', '', null, $template_prefix );
$nav_boxed       = floral_get_meta_or_option( 'nav-boxed-enabled', '', null, $template_prefix );
$nav_content     = floral_get_meta_or_option( 'nav-content', '', null, $template_prefix );
$nav_logo_select = floral_get_meta_or_option( 'nav-logo-select', '', null, $template_prefix );
if ( empty( $nav_logo_select ) ) {
	$nav_logo_select = 'logo';
}
$nav_sticky_logo_select = floral_get_meta_or_option( 'nav-sticky-logo-select', '', null, $template_prefix );
if ( empty( $nav_sticky_logo_select ) ) {
	$nav_sticky_logo_select = 'logo';
}

$nav_logo_height                  = floral_get_option( 'nav-logo-height', '', null, $template_prefix ); //Style
$nav_item_height                  = floral_get_option( 'nav-item-height', '', null, $template_prefix ); //Style
$nav_item_padding                 = floral_get_option( 'nav-item-padding', '', null, $template_prefix ); //Style
$nav_item_color                   = floral_get_option( 'nav-item-color', '', null, $template_prefix ); //Style
$nav_link_hover_background        = floral_get_option( 'nav-link-hover-background', '', null, $template_prefix ); //Style
$nav_background                   = floral_get_option( 'nav-background', '', null, $template_prefix ); //Style
$nav_background_overlay           = floral_get_option( 'nav-background-overlay', '', null, $template_prefix ); //Style
$nav_menu_item_hover_effect       = floral_get_option( 'nav-menu-item-hover-effect', '', null, $template_prefix );
$nav_item_separator               = floral_get_option( 'nav-item-separator', '', null, $template_prefix );
$nav_border                       = floral_get_option( 'nav-border', '', null, $template_prefix ); //Style
$nav_occupy_spacing               = floral_get_meta_or_option( 'nav-occupy-spacing', '', null, $template_prefix );
$nav_sticky                       = floral_get_meta_or_option( 'nav-sticky', '', null, $template_prefix );
$nav_headroom                     = floral_get_meta_or_option( 'nav-headroom', '', null, $template_prefix );
$nav_sticky_logo_height           = floral_get_option( 'nav-sticky-logo-height', '', null, $template_prefix ); //Style
$nav_sticky_item_height           = floral_get_option( 'nav-sticky-item-height', '', null, $template_prefix ); //Style
$nav_sticky_item_color            = floral_get_option( 'nav-sticky-item-color', '', null, $template_prefix ); //Style
$nav_sticky_link_hover_background = floral_get_option( 'nav-sticky-link-hover-background', '', null, $template_prefix ); //Style
$nav_sticky_background            = floral_get_option( 'nav-sticky-background', '', null, $template_prefix ); //Style
$nav_sticky_background_overlay    = floral_get_option( 'nav-sticky-background-overlay', '', null, $template_prefix ); //Style
$nav_sticky_border                = floral_get_option( 'nav-sticky-border', '', null, $template_prefix ); //Style

$header_container    = floral_get_option( 'nav-width', '', null, $template_prefix );
$wrapper_nav_classes = array();
$main_nav_classes    = array();

// Add prefix class
$template_prefix       = floral_get_template_prefix();
$wrapper_nav_classes[] = $template_prefix;
//Main nav
if ( $nav_occupy_spacing != 'on' ) {
	$main_nav_classes[]    = 'floral-menu-overlay';
	$wrapper_nav_classes[] = 'floral-menu-overlay-wrapper';
}

if ( $nav_boxed === 'on' ) {
	$main_nav_classes[] = 'floral-menu-boxed-' . $nav_width;
}
//Sticky config
if ( $nav_sticky === 'on' ) {
	$main_nav_classes[] = 'floral-sticky';
	$mobile_nav_class[] = 'floral-sticky';
	
	if ( $nav_headroom === 'on' ) {
		$main_nav_classes[] = 'floral-headroom';
		$mobile_nav_class[] = 'floral-headroom';
	}
}

//Nav item separator
if ( $nav_item_separator === 'on' ) {
	$main_nav_classes[] = 'floral-nav-enable-separator';
}

//Header module
$nav_modules                        = $nav_module_desktop = $nav_module_desktop_sticky = $nav_module_mobile = array();
//$set_content_customize_for_singular = floral_get_meta_option( 'header-content-customize', '', '', 0 );
if ( floral_get_meta_option( 'nav-module-desktop-custom', '', '', 0 ) ) {
	$nav_module_desktop        = floral_get_meta_option( 'nav-module-desktop' );
} else {
	$nav_module_desktop        = floral_get_option( 'nav-module-desktop', '', null, $template_prefix );
}

if ( floral_get_meta_option( 'nav-module-desktop-sticky-custom', '', '', 0 ) ) {
	$nav_module_desktop_sticky = floral_get_meta_option( 'nav-module-desktop-sticky' );
} else {
	$nav_module_desktop_sticky = floral_get_option( 'nav-module-desktop-sticky', '', null, $template_prefix );
}

if ( floral_get_meta_option( 'nav-module-mobile-custom', '', '', 0 ) ) {
	$nav_module_mobile         = floral_get_meta_option( 'nav-module-mobile' );
} else {
	$nav_module_mobile         = floral_get_option( 'nav-module-mobile', '', null, $template_prefix );
}

//Merge Module and get module order
if ( isset( $nav_module_desktop['enabled'] ) && is_array( $nav_module_desktop['enabled'] ) ) {
	unset( $nav_module_desktop['enabled']['placebo'] );
	foreach ( array_keys( $nav_module_desktop['enabled'] ) as $order => $module ) {
		$nav_modules[ $module ]['desktop_order'] = $order;
	}
}
if ( isset( $nav_module_desktop_sticky['enabled'] ) && is_array( $nav_module_desktop_sticky['enabled'] ) ) {
	unset( $nav_module_desktop_sticky['enabled']['placebo'] );
	foreach ( array_keys( $nav_module_desktop_sticky['enabled'] ) as $order => $module ) {
		$nav_modules[ $module ]['desktop_sticky_order'] = $order;
	}
}
if ( isset( $nav_module_mobile['enabled'] ) && is_array( $nav_module_mobile['enabled'] ) ) {
	unset( $nav_module_mobile['enabled']['placebo'] );
	foreach ( array_keys( $nav_module_mobile['enabled'] ) as $order => $module ) {
		$nav_modules[ $module ]['mobile_order'] = $order;
	}
}

//Main menu
$menu_content_class               = array( 'floral-main-menu-content nav' );
$menu_content_class[]             = $nav_menu_item_hover_effect;
$menu_content_class[]             = floral_get_meta_or_option( 'menu-sub-appear-effect', null, 'floral-effect-fade' );
$menu_content_class[]             = floral_get_meta_or_option( 'menu-sub-item-hover-effect', null, 'floral-menu-sub-item-hover-none' );
$menu_content_class[]             = floral_get_meta_or_option( 'menu-mega-separator-enable', null, 1 ) ? 'floral-enable-mega-menu-separator' : '';
$nav_module_desktop_biggest       = floral_get_meta_or_option( 'nav-module-desktop-biggest', '', null, $template_prefix );
$nav_module_desktop_biggest_align = floral_get_meta_or_option( 'nav-module-desktop-biggest-align', '', null, $template_prefix );
$nav_module_mobile_biggest        = floral_get_meta_or_option( 'nav-module-mobile-biggest', '', null, $template_prefix );
$nav_module_mobile_biggest_align  = floral_get_meta_or_option( 'nav-module-mobile-biggest-align', '', null, $template_prefix );

// cache main menu
ob_start();
if ( has_nav_menu( 'primary' ) ):
	$menu_param = array(
		'menu'            => $nav_content,
		'theme_location'  => 'primary',
		'menu_id'         => 'primary-nav',
		'menu_class'      => floral_clean_html_classes( $menu_content_class ),
		'container_id'    => 'floral-main-menu',
		'container_class' => 'floral-main-menu',
		'walker'          => new Floral_Walker_Nav_Menu,
	);
	wp_nav_menu( $menu_param );
endif;
$main_menu = ob_get_clean();

?>
<header class="main-header floral-main-header <?php floral_the_clean_html_classes( $wrapper_nav_classes ); ?>">
	<nav id="floral-main-nav" class="floral-main-nav <?php floral_the_clean_html_classes( $main_nav_classes ); ?>">
		<div class="floral-nav-body">
			<?php
	  		include (floral_theme_dir() . 'templates/header/parts/main-nav-content.php' );
			?>
		</div>
		<div class="floral-nav-body sticky-content">
			<?php
				$is_sticky_content = true;
	  		include (floral_theme_dir() . 'templates/header/parts/main-nav-content.php' );
			?>
		</div>
	</nav>
</header>
