<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-slider-container-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//----- GENERAL TAB ------------
//1. Loop
//2. Center
//3. Autoplay
//4. Autoplay Timeout
//
//5. Navigation
//6. Pagination
//7. Navigation & Pagination Style
//
//8. Item Margin Right
//9. Pause On Hover
//
//10. Items
//
//11. Auto Width
//12. Auto Height
//
//13. Animate Out
//14. Animate In
//
//15. Mousewheel Enable?
//
//16. Start Position (Item Active First?)
//
//----- RESPONSIVE TAB -------------
//1. Items On Large Desktop ( >= 1200px)
//2. Items On Desktop ( >= 992px)
//3. Items on Tablet ( >= 768px)
//4. Items On Small Tablet ( >= 480px)
//5. Item On Mobile ( < 480px)

vc_map( array(
    'name'                    => esc_html__( 'Floral Slider Container', 'w9-floral-addon' ),
    'base'                    => Floral_SC_Slider_Container::SC_BASE,
    'icon'                    => 'w9 w9-ico-software-font-kerning',
    'category'                => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'as_parent'               => array( 'except' => Floral_SC_Slider_Container::SC_BASE ),
    'content_element'         => true,
    'show_settings_on_create' => true,
    'description'             => __( 'A slider container', 'w9-floral-addon' ),
    'js_view'                 => 'VcColumnView',
    'php_class_name'          => 'Floral_SC_Slider_Container',
    'params'                  => array(
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Loop', 'w9-floral-addon' ),
            'param_name'       => 'sc_loop',
            'description'      => esc_html__( 'Infinity loop.', 'w9-floral-addon' ),
            'std'              => '0',
            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding'
        ),
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Center', 'w9-floral-addon' ),
            'param_name'       => 'sc_center',
            'description'      => esc_html__( 'Center item. Works well with even an odd number of items.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => '0',
        ),
        
        
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Navigation', 'w9-floral-addon' ),
            'param_name'       => 'sc_nav',
            'description'      => esc_html__( 'Show navigation.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => 0,
        ),
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Pagination', 'w9-floral-addon' ),
            'param_name'       => 'sc_dots',
            'description'      => esc_html__( 'Show pagination.', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => 0,
        ),
        
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Navigation & pagination style', 'w9-floral-addon' ),
            'param_name'       => 'sc_nav_pag_style',
            'value'            => array(
                __( 'Style 1', 'w9-floral-addon' ) => 'owl-control-default',
                __( 'Style 2', 'w9-floral-addon' ) => 'owl-control-shortcodes',
                __( 'Style 3', 'w9-floral-addon' ) => 'owl-control-floral',
                __( 'Style 4', 'w9-floral-addon' ) => 'owl-control-style-4'
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => 'owl-control-default'
        
        ),
        
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Navigation & pagination color scheme', 'w9-floral-addon' ),
            'param_name'       => 'sc_nav_pag_scheme_color',
            'value'            => array(
                __( 'Primary', 'w9-floral-addon' ) => 'owl-color-primary',
                __( 'Light', 'w9-floral-addon' )   => 'owl-color-light',
                __( 'Dark', 'w9-floral-addon' )    => 'owl-color-dark',
                __( 'Gray #2', 'w9-floral-addon' ) => 'owl-color-gray-2',
                __( 'Gray #4', 'w9-floral-addon' ) => 'owl-color-gray-4',
                __( 'Gray #6', 'w9-floral-addon' ) => 'owl-color-gray-6',
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => 'owl-color-primary'
        
        ),
        
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Autoplay', 'w9-floral-addon' ),
            'param_name'       => 'sc_autoplay',
            'description'      => esc_html__( 'Autoplay.', 'w9-floral-addon' ),
            'value'            => array( esc_html__( 'Yes, please', 'w9-floral-addon' ) => 'true' ),
            'std'              => '1',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Autoplay timeout', 'w9-floral-addon' ),
            'param_name'       => 'sc_autoplaytimeout',
            'description'      => esc_html__( 'Autoplay interval timeout in ms.', 'w9-floral-addon' ),
            'value'            => '',
            'std'              => 5000,
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Pause on hover', 'w9-floral-addon' ),
            'param_name'       => 'sc_autoplayhoverpause',
            'description'      => esc_html__( 'Pause on mouse hover.', 'w9-floral-addon' ),
            'std'              => '1',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        
        array(
            'type'             => 'switcher',
            'heading'          => esc_html__( 'Enable mouse-wheel?', 'w9-floral-addon' ),
            'param_name'       => 'sc_mouse_wheel',
            'description'      => esc_html__( 'Scroll the mouse-wheel to slide the slider.', 'w9-floral-addon' ),
            'std'              => false,
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Animate in effect', 'w9-floral-addon' ),
            'param_name'       => 'animation_in',
            'value'            => Floral_Map_Helpers::get_animations(),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => '',
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => __( 'Animate out effect', 'w9-floral-addon' ),
            'param_name'       => 'animation_out',
            'value'            => Floral_Map_Helpers::get_animations_out(),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => '',
        ),
        array(
            'type'             => 'switcher',
            'heading'          => __( 'Auto width', 'w9-floral-addon' ),
            'param_name'       => 'sc_auto_width',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => '0',
        ),
        array(
            'type'             => 'switcher',
            'heading'          => __( 'Auto height', 'w9-floral-addon' ),
            'param_name'       => 'sc_auto_height',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'std'              => '0',
        ),
        
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Start position', 'w9-floral-addon' ),
            'param_name'       => 'sc_start_position',
            'description'      => esc_html__( 'Choose which item will be activated first. Default is the first item (Start from 0).', 'w9-floral-addon' ),
            'value'            => '',
            'std'              => '',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Item margin right', 'w9-floral-addon' ),
            'param_name'       => 'sc_margin_right',
            'description'      => esc_html__( 'Slider item margin right in px. This is intended to make spaces between items. Recommended value is 30 (not include px).', 'w9-floral-addon' ),
            'value'            => '',
            'min'              => '0',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        
        array(
            'type'             => 'number',
            'heading'          => esc_html__( 'Pagination spacing', 'w9-floral-addon' ),
            'param_name'       => 'sc_pag_margin_top',
            'description'      => esc_html__( 'Enter a spacing between the content slider with the pagination (not include px). Accept negative value (this will bring the pagination go inside the content slider). Default value is 20.', 'w9-floral-addon' ),
            'value'            => '20',
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
//        array(
//            'type'       => 'checkbox',
//            'heading'    => esc_html__( 'Hover effect on item', 'w9-floral-addon' ),
//            'param_name' => 'sc_hover_item',
//            'value'      => array( esc_html__( 'Yes, please', 'w9-floral-addon' ) => 'true' ),
//        ),
//        array(
//            'type'        => 'colorpicker',
//            'heading'     => esc_html__( 'Color', 'w9-floral-addon' ),
//            'param_name'  => 'sc_hover_item_color',
//            'value'       => '',
//            'description' => esc_html__( 'Select color for hover effect', 'w9-floral-addon' ),
//            'dependency'  => array(
//                'element' => 'sc_hover_item',
//                'value'   => 'true',
//            ),
//        ),
        
        /*-------------------------------------
             RESPONSIVE
        ---------------------------------------*/
        array(
            'type'             => 'dropdown',
            'value' => array(
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
            ),
            'heading'          => esc_html__( 'Items large desktop', 'w9-floral-addon' ),
            'param_name'       => 'sc_items',
            'description'      => esc_html__( 'Browser Width >= 1600', 'w9-floral-addon' ),
            'std'              => '1',
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
        ),
        array(
            'type'             => 'dropdown',
            'value' => array(
                __( 'Inherit from bigger screen', 'w9-floral-addon' ) => 'inherit',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
            ),
            'heading'          => esc_html__( 'Items desktop', 'w9-floral-addon' ),
            'param_name'       => 'sc_items_desktop',
            'description'      => esc_html__( 'Browser Width >= 1200', 'w9-floral-addon' ),
            'std'              => 'inherit',
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column vc_column-with-padding',
        ),
        array(
            'type'             => 'dropdown',
            'value' => array(
                __( 'Inherit from bigger screen', 'w9-floral-addon' ) => 'inherit',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
            ),
            'heading'          => esc_html__( 'Items desktop small', 'w9-floral-addon' ),
            'param_name'       => 'sc_items_desktop_small',
            'description'      => esc_html__( 'Browser Width >= 992', 'w9-floral-addon' ),
            'std'              => 'inherit',
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
        ),
        array(
            'type'             => 'dropdown',
            'value' => array(
                __( 'Inherit from bigger screen', 'w9-floral-addon' ) => 'inherit',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
            ),
            'heading'          => esc_html__( 'Items tablet', 'w9-floral-addon' ),
            'param_name'       => 'sc_items_tablet',
            'description'      => esc_html__( 'Browser Width >= 768', 'w9-floral-addon' ),
            'std'              => 'inherit',
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
        ),
        array(
            'type'             => 'dropdown',
            'value' => array(
                __( 'Inherit from bigger screen', 'w9-floral-addon' ) => 'inherit',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
            ),
            'heading'          => esc_html__( 'Items tablet small', 'w9-floral-addon' ),
            'param_name'       => 'sc_items_tablet_small',
            'description'      => esc_html__( 'Browser Width >= 480', 'w9-floral-addon' ),
            'std'              => 'inherit',
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
        ),
        array(
            'type'             => 'dropdown',
            'value' => array(
                __( 'Inherit from bigger screen', 'w9-floral-addon' ) => 'inherit',
                '1',
                '2',
                '3',
                '4',
                '5',
                '6',
                '7',
                '8',
                '9',
                '10',
            ),
            'heading'          => esc_html__( 'Items mobile', 'w9-floral-addon' ),
            'param_name'       => 'sc_items_mobile',
            'description'      => esc_html__( 'Browser Width < 480', 'w9-floral-addon' ),
            'std'              => 'inherit',
            'group'            => __( 'Responsive', 'w9-floral-addon' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
        ),
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    ) ) );