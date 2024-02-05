<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: theme-sidebars.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


add_action( 'widgets_init', 'floral_widgets_init' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function floral_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 1', 'floral' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Default sidebar 1.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 2', 'floral' ),
        'id'            => 'sidebar-2',
        'description'   => esc_html__( 'Default sidebar 2.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Popup', 'floral' ),
        'id'            => 'sidebar-popup',
        'description'   => esc_html__( 'Sidebar on popup area. Can be use as mobile menu.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Sub Zone Left', 'floral' ),
        'id'            => 'sidebar-subzone-left',
        'description'   => esc_html__( 'Sidebar on subzone left area. Can be use as mobile menu.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Sub Zone Left Bottom', 'floral' ),
        'id'            => 'sidebar-subzone-left-bottom',
        'description'   => esc_html__( 'Sidebar on subzone left bottom area.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Sub Zone Right', 'floral' ),
        'id'            => 'sidebar-subzone-right',
        'description'   => esc_html__( 'Sidebar on subzone right area. Can be use as mobile menu.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Sub Zone Right Bottom', 'floral' ),
        'id'            => 'sidebar-subzone-right-bottom',
        'description'   => esc_html__( 'Sidebar on subzone right bottom area.', 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title">',
        'after_title'   => '</h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( "Footer 1", 'floral' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( "Footer 1", 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( "Footer 2", 'floral' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( "Footer 2", 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( "Footer 3", 'floral' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( "Footer 3", 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( "Footer 4", 'floral' ),
        'id'            => 'footer-4',
        'description'   => esc_html__( "Footer 4", 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( "Footer Copyright Left", 'floral' ),
        'id'            => 'footer-copyright-left',
        'description'   => esc_html__( "Footer Copyright Right", 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
    
    register_sidebar( array(
        'name'          => esc_html__( "Footer Copyright Right", 'floral' ),
        'id'            => 'footer-copyright-right',
        'description'   => esc_html__( "Footer Copyright Right", 'floral' ),
        'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="floral-widget-title"><span>',
        'after_title'   => '</span></h3>',
    ) );
	
	register_sidebar( array(
		'name'          => esc_html__( "Service", 'floral' ),
		'id'            => 'service',
		'description'   => esc_html__( "Service Widgets Area", 'floral' ),
		'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="floral-widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	
    if ( floral_is_woocommerce_active() ) {
        register_sidebar( array(
            'name'          => esc_html__( "Shop", 'floral' ),
            'id'            => 'shop',
            'description'   => esc_html__( "Shop Widgets Area", 'floral' ),
            'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="floral-widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );
    }
    
    // Custom sidebar managed by DEFAULT THEME OPTIONS
    $default_theme_options = floral_get_options_by_theme_options_name( FLORAL_THEME_OPTIONS_DEFAULT_NAME );
    $custom_sidebars       = isset( $default_theme_options['general-custom-sidebars'] ) ? $default_theme_options['general-custom-sidebars'] : array();
    
    if ( is_array( $custom_sidebars ) && count( $custom_sidebars ) > 0 ) {
        $custom_sidebars = array_unique( $custom_sidebars );
        foreach ( $custom_sidebars as $sidebar ) {
            if ( !empty( $sidebar ) ) {
                register_sidebar( array(
                    'name'          => esc_html( $sidebar ),
                    'id'            => sanitize_title( $sidebar ),
                    'description'   => esc_html( $sidebar ),
                    'before_widget' => '<div id="%1$s" class="floral-widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h3 class="floral-widget-title"><span>',
                    'after_title'   => '</span></h3>',
                ) );
            }
        }
    }
}

////Add default widget
//add_action( 'widgets_init', 'floral_predefined_sidebar_content' );
//
//function floral_predefined_sidebar_content() {
//
//    if ( !get_option( 'floral-theme-installed-widgets', false ) && class_exists( 'Floral_Addon' )) {
//        $sidebar_target  = 'sidebar-subzone-left';
//        $sidebar_options = get_option( 'sidebars_widgets' );
//
//
//        if ( isset( $sidebar_options[$sidebar_target] ) ) {
//            //Add logo to sidebar
//            $logo_value = array(
//                2              => array(
//                    'logo'                        => 'logo',
//                    'floral_extra_widget_classes' => '',
//                    'floral_remove_default_mb'    => '0',
//                    'logo_width'                  => '100',
//                    'logo_align'                  => 'text-center',
//                ),
//                '_multiwidget' => 1,
//            );
//            update_option( 'widget_floral-widget-logo', $logo_value );
//
//            //Add menu to sidebar
//            $menu_value = array(
//                2              => array(
//                    'title'                         => '',
//                    'menu_id'                       => '',
//                    'menu_type'                     => 'floral-widget-vertical-multi-level',
//                    'menu_fontsize'                 => '12px',
//                    'menu_fontweight'               => '400',
//                    'menu_text_transform'           => 'initial',
//                    'menu_item_spacing'             => '10',
//                    'menu_list_icon'                => 'w9 w9-ico-right-open-mini',
//                    'menu_number_column'            => '1',
//                    'floral_extra_widget_classes'   => '',
//                    'floral_remove_title_bb'        => '0',
//                    'floral_remove_default_mb'      => '0',
//                    'menu_tree_arrow'               => '1',
//                    'menu_text_align'               => 'text-left',
//                    'menu_horizontal_submenu'       => '0',
//                    'menu_horizontal_submenu_color' => 'floral-widget-submenu-dark',
//                ),
//                3              => array(
//                    'title'                         => '',
//                    'menu_id'                       => '14',
//                    'menu_type'                     => 'floral-widget-vertical-multi-level',
//                    'menu_horizontal_submenu'       => '0',
//                    'menu_horizontal_submenu_color' => 'floral-widget-submenu-dark',
//                    'menu_fontsize'                 => '24px',
//                    'menu_fontweight'               => '500',
//                    'menu_text_align'               => 'text-center',
//                    'menu_text_transform'           => 'text-uppercase',
//                    'menu_tree_arrow'               => '0',
//                    'menu_item_spacing'             => '25',
//                    'menu_list_icon'                => '',
//                    'menu_number_column'            => '1',
//                    'floral_extra_widget_classes'   => '',
//                    'floral_remove_title_bb'        => '0',
//                    'floral_remove_default_mb'      => '0',
//                    'menu_tree_icon'                => '0',
//                ),
//                '_multiwidget' => 1,
//            );
//            update_option( 'widget_floral-widget-menu', $menu_value );
//        }
//
//        //
//        // Add widget to sidebar sub zone left
//        //
//        if ( isset( $sidebar_options['sidebar-subzone-left'] ) ) {
//            $sidebar_options['sidebar-subzone-left'] = array(
//                0 => 'floral-widget-logo-2',
//                1 => 'floral-widget-menu-2',
//            );
//        }
//        if ( isset( $sidebar_options['sidebar-poup'] ) ) {
//            $sidebar_options['sidebar-poup'] = array(
//                0 => 'floral-widget-menu-3',
//            );
//        }
//
//        update_option( 'sidebars_widgets', $sidebar_options );
//        update_option( 'floral-theme-installed-widgets', true );
//    }
//}