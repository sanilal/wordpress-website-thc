<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-widget-menu-map.php
 * @time    : 9/26/2016 8:29 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
    $menus = get_terms( array( 'taxonomy' => 'nav_menu', 'hide_empty' => false ) );
    if ( is_array( $menus ) && !empty( $menus ) ) {
        foreach ( $menus as $single_menu ) {
            if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
                $custom_menus[$single_menu->name] = $single_menu->slug;
            }
        }
    }
}

vc_map(
    array(
        'name'           => esc_html__( 'Floral Widget Menu', 'w9-floral-addon' ),
        'base'           => Floral_SC_Widget_Menu::SC_BASE,
        'icon'           => 'w9 w9-ico-clipboard',
        'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
        'php_class_name' => 'Floral_SC_Widget_Menu',
        'description'    => __( 'Floral custom menu', 'w9-floral-addon' ),
        'params'         => array_merge( array(
            array(
                'type'        => 'textfield',
                'param_name'  => 'title',
                'heading'     => __( 'Widget title', 'w9-floral-addon' ),
                'description' => __( 'What text use as a widget title. Leave blank if you don\' want to show the widget title.', 'w9-floral-addon' ),
            ),
            // Menu
            array(
                'type'        => 'dropdown',
                'param_name'  => 'menu_slug',
                'heading'     => __( 'Menu', 'w9-floral-addon' ),
                'value'       => $custom_menus,
                'description' => empty( $custom_menus ) ? __( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'js_composer' ) : '',
                'admin_label' => true,
                'save_always' => true,
            ),
            
            // Menu Type
            array(
                'type'        => 'dropdown',
                'param_name'  => 'menu_type',
                'heading'     => __( 'Menu type', 'w9-floral-addon' ),
                'admin_label' => true,
                'value'       => array(
                    __( 'Simple Vertical Menu', 'w9-floral-addon' )   => 'floral-widget-vertical-menu',
                    __( 'Simple Horizontal Menu', 'w9-floral-addon' ) => 'floral-widget-horizontal-menu',
                    __( 'Vertical Tree Menu', 'w9-floral-addon' )     => 'floral-widget-vertical-multi-level',
	                __( 'Vertical Section Menu', 'w9-floral-addon' )  => 'floral-widget-vertical-section-menu',
                ),
            ),
            
            //Menu Horizontal With Sub Menu
            array(
                'type'       => 'switcher',
                'param_name' => 'menu_horizontal_submenu',
                'heading'    => __( 'Enable sub menu', 'w9-floral-addon' ),
                'dependency' => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-horizontal-menu',
                ),
                'std'        => '0',
            ),
            
            //Menu Horizontal Sub Menu Color Scheme
            array(
                'type'       => 'dropdown',
                'param_name' => 'menu_horizontal_submenu_color',
                'heading'    => __( 'Sub menu color', 'w9-floral-addon' ),
                'value'      => array(
                    __( 'Dark - Background Light', 'w9-floral-addon' ) => 'floral-widget-submenu-dark',
                    __( 'Light - Background Dark', 'w9-floral-addon' ) => 'floral-widget-submenu-light',
                ),
                'dependency' => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-horizontal-menu',
                )
            ),
            
            //Font size
            array(
                'type'       => 'slider',
                'param_name' => 'menu_fontsize',
                'heading'    => __( 'Menu font size', 'w9-floral-addon' ),
                'unit'       => 'px',
                'min'        => 10,
                'max'        => 36,
                'step'       => 1,
                'std'        => '12px'
            ),
            
            array(
                'type'       => 'switcher',
                'param_name' => 'menu_sub_reduce_fontsize',
                'heading'    => __( 'Reduce sub menu font size', 'w9-floral-addon' ),
                'value'      => array(
                    __( 'Yes, Please!', 'w9-floral-addon' ) => '1'
                ),
                'dependency' => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-vertical-multi-level',
                ),
                'std'        => false,
            ),
            
            
            //Font weight
            array(
                'type'       => 'slider',
                'param_name' => 'menu_fontweight',
                'heading'    => __( 'Menu font weight', 'w9-floral-addon' ),
                'min'        => 300,
                'max'        => 700,
                'step'       => 100,
                'std'        => 400
            ),
            
            //Text align
            array(
                'type'        => 'dropdown',
                'param_name'  => 'menu_text_align',
                'heading'     => __( 'Menu text align', 'w9-floral-addon' ),
                'admin_label' => true,
                'value'       => array(
                    __( 'Inherit', 'w9-floral-addon' ) => '',
                    __( 'Left', 'w9-floral-addon' )    => 'text-left',
                    __( 'Right', 'w9-floral-addon' )   => 'text-right',
                    __( 'Center', 'w9-floral-addon' )  => 'text-center',
                ),
                'std'         => '',
            ),
            
            //Text transform
            array(
                'type'       => 'dropdown',
                'param_name' => 'menu_text_transform',
                'heading'    => __( 'Menu text transform', 'w9-floral-addon' ),
                'value'      => array(
                    __( 'Initial', 'w9-floral-addon' )    => 'initial',
                    __( 'lowercase', 'w9-floral-addon' )  => 'text-lowercase',
                    __( 'UPPERCASE', 'w9-floral-addon' )  => 'text-uppercase',
                    __( 'Capitalize', 'w9-floral-addon' ) => 'text-capitalize',
                ),
                'std'        => 'text-uppercase',
                'dependency' => array(
                    'element'            => 'menu_type',
                    'value_not_equal_to' => 'floral-widget-vertical-multi-level',
                )
            ),
            
            array(
                'type'       => 'switcher',
                'param_name' => 'menu_tree_arrow',
                'heading'    => __( 'Enable tree menu arrow', 'w9-floral-addon' ),
                'dependency' => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-vertical-multi-level',
                ),
                'std'        => '1',
            ),
            
            array(
                'type'       => 'switcher',
                'param_name' => 'menu_tree_icon',
                'heading'    => __( 'Show menu icon of menu item', 'w9-floral-addon' ),
                'dependency' => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-vertical-multi-level',
                ),
                'std'        => '0',
            ),
            
            
            //Item Spacing
            array(
                'type'       => 'slider',
                'param_name' => 'menu_item_spacing',
                'heading'    => __( 'Menu item spacing', 'w9-floral-addon' ),
                'min'        => 0,
                'max'        => 60,
                'step'       => 5,
                'std'        => 20
            ),
            
            //Menu List Icon
            array(
                'type'       => 'checkbox',
                'param_name' => 'enable_listing_icon',
                'heading'    => __( 'Enable listing icon ?', 'w9-floral-addon' ),
                'value'      => array(
                    __( 'Yes !!!', 'w9-floral-addon' ) => 'yes'
                ),
                'dependency' => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-vertical-menu',
                )
            ),
            array(
                'type'                 => 'dropdown',
                'param_name'           => 'icon_type',
                'heading'              => __( 'Icon library', 'w9-floral-addon' ),
                'value'                => array(
                    __( '9WPThemes', 'w9-floral-addon' )    => '9wpthemes',
                    __( 'Floral', 'w9-floral-addon' )    => 'floral',
                    __( 'Font Awesome', 'w9-floral-addon' ) => 'fontawesome'
                ),
                'std'                  => '9wpthemes',
                'description'          => __( 'Select icon library.', 'w9-floral-addon' ),
                'dependency'           => array(
                    'element' => 'enable_listing_icon',
                    'value'   => 'yes',
                ),
                'integrated_shortcode' => 'vc_icon'
            ),
            array(
                'type'        => 'iconpicker',
                'heading'     => __( 'Icon', 'w9-floral-addon' ),
                'param_name'  => 'icon_9wpthemes',
                'value'       => '', // default value to backend editor admin_label
                'settings'    => array(
                    'emptyIcon'    => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 100,
                    'type'         => '9wpthemes',
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                    'source'       => Floral_Icons::get_theme_base_icons()
                ),
                'admin_label' => true,
                'dependency'  => array(
                    'element' => 'icon_type',
                    'value'   => '9wpthemes',
                ),
                'description' => __( 'Select icon from library.', 'w9-floral-addon' ),
            ),
	
	        array(
		        'type'        => 'iconpicker',
		        'heading'     => __( 'Icon', 'w9-floral-addon' ),
		        'param_name'  => 'icon_floral',
		        'value'       => '', // default value to backend editor admin_label
		        'settings'    => array(
			        'emptyIcon'    => false,
			        // default true, display an "EMPTY" icon?
			        'iconsPerPage' => 100,
			        'type'         => 'floral',
			        // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			        'source'       => Floral_Icons::get_theme_base_icons()
		        ),
		        'admin_label' => true,
		        'dependency'  => array(
			        'element' => 'icon_type',
			        'value'   => 'floral',
		        ),
		        'description' => __( 'Select icon from library.', 'w9-floral-addon' ),
	        ),
	        
            array(
                'type'                 => 'iconpicker',
                'heading'              => __( 'Icon', 'w9-floral-addon' ),
                'param_name'           => 'icon_fontawesome',
                'value'                => '', // default value to backend editor admin_label
                'settings'             => array(
                    'emptyIcon'    => false,
                    // default true, display an "EMPTY" icon?
                    'iconsPerPage' => 100,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'admin_label'          => true,
                'dependency'           => array(
                    'element' => 'icon_type',
                    'value'   => 'fontawesome',
                ),
                'description'          => __( 'Select icon from library.', 'w9-floral-addon' ),
                'integrated_shortcode' => 'vc_icon'
            ),
	
	        array(
		        'type'       => 'dropdown',
		        'param_name' => 'icon_color',
		        'heading'    => __( 'Menu icon list color', 'w9-floral-addon' ),
		        'value'      => array_merge( array(
			        __( 'Default CSS', 'w9-floral-addon' )  => '__',
		        ), Floral_Map_Helpers::get_just_colors() ),
		        'param_holder_class' => 'vc_colored-dropdown',
		        'dependency'           => array(
			        'element' => 'enable_listing_icon',
			        'value'   => 'yes',
		        ),
		        'std'        => '__'
	        ),
            
            //Number column
            array(
                'type'        => 'dropdown',
                'param_name'  => 'menu_number_column',
                'heading'     => __( 'Vertical menu number columns', 'w9-floral-addon' ),
                'admin_label' => true,
                'value'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'dependency'  => array(
                    'element' => 'menu_type',
                    'value'   => 'floral-widget-vertical-menu',
                )
            ),
        ), Floral_Map_Helpers::widget_common_params() )
    )
);