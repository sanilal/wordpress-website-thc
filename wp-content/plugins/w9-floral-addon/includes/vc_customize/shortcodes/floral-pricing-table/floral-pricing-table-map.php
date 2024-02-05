<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-pricing-table-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$button_param = vc_map_integrate_shortcode( 'floral_shortcode_' . 'button', '', __( 'Button', 'w9_sping_addon' ), array(
    'exclude' => array(
        'css',
        'el_class',
        'animation_css',
        'animation_duration',
        'animation_delay',
        'css_inline',
    ),
    // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
), array(
    'element' => 'enable_button',
    'value'   => 'yes',
) );


// populate integrated vc_icons params.
if ( is_array( $button_param ) && !empty( $button_param ) ) {
    foreach ( $button_param as $key => $param ) {
        if ( is_array( $param ) && !empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $button_param[$key]['admin_label'] );
            }
            if ( $param['param_name'] == 'btn_text' ) {
                $button_param[$key]['heading'] = __( 'Button Text', 'w9-floral-addon' );
                $button_param[$key]['std']     = __( 'PURCHASE NOW', 'w9-floral-addon' );
                unset( $button_param[$key]['group'] );
            }
            if ( $param['param_name'] == 'btn_link' ) {
                $button_param[$key]['heading'] = __( 'Button Link', 'w9-floral-addon' );
                unset( $button_param[$key]['group'] );
            }
        }
    }
}

//var_dump($button_param);

vc_map( array(
    'name'           => esc_html__( 'Floral Pricing Table', 'w9-floral-addon' ),
    'base'           => Floral_SC_Pricing_Table::SC_BASE,
    'class'          => '',
    'icon'           => 'w9 w9-ico-software-layout-8boxes',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
    'php_class_name' => 'Floral_SC_Pricing_Table',
    'description'    => __( 'Create floral pricing table', 'w9-floral-addon' ),
    'params'         => array_merge( array(
	    array(
		    'type'        => 'dropdown',
		    'heading'     => __( 'Layout', 'w9-floral-addon' ),
		    'param_name'  => 'layout',
		    'admin_label' => true,
		    'value'       => array(
			    __( 'Layout 1', 'w9-floral-addon' )   => 'layout-1',
			    __( 'Layout 2', 'w9-floral-addon' )  => 'layout-2'
		    ),
		    'description' => __( 'Select the layout of pricing table.', 'w9-floral-addon' )
	    ),
	
	    array(
		    'type'       => 'checkbox',
//		    'heading'    => __( 'Enable button', 'w9-floral-addon' ),
		    'param_name' => 'special',
		    'value'      => array(
			    __( 'Special !!!', 'w9-floral-addon' ) => 'yes'
		    ),
		    'dependency'  => array(
                'element' => 'layout',
                'value'   => 'layout-1',
            ),
	    ),
    	
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Table name', 'w9-floral-addon' ),
            'description' => __( 'Name of the the table.', 'w9-floral-addon' ),
            'param_name'  => 'name',
            'admin_label' => true
        ),
        array(
            'type'        => 'number',
            'heading'     => __( 'Price', 'w9-floral-addon' ),
            'description' => __( 'Fill price that you want in this pricing table.', 'w9-floral-addon' ),
            'param_name'  => 'price',
            'admin_label' => true,
        ),
        array(
            'type'             => 'textfield',
            'heading'          => __( 'Price unit', 'w9-floral-addon' ),
            'description'      => __( 'Please fill money unit that you want to use.', 'w9-floral-addon' ),
            'param_name'       => 'price_unit',
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type'             => 'buttonset',
            'heading'          => __( 'Price unit position', 'w9-floral-addon' ),
            'description'      => __( 'Please choose position appear money unit.', 'w9-floral-addon' ),
            'param_name'       => 'price_unit_position',
            'value'            => '',
            'std'              => 'left',
            'options'          => array(
                'left'  => __( 'Left', 'w9-floral-addon' ),
                'right' => __( 'Right', 'w9-floral-addon' ),
            ),
            'edit_field_class' => 'vc_col-sm-6',
        ),
        array(
            'type'        => 'param_group',
            'heading'     => __( 'Table features', 'w9-floral-addon' ),
            'description' => __( 'Insert features for this table.', 'w9-floral-addon' ),
            'param_name'  => 'table_features',
            'value'       => urlencode( json_encode( array(
                array(
                    'feature' => __( 'Table feature 1', 'w9-floral-addon' ),
                ),
                array(
                    'feature' => __( 'Table feature 2', 'w9-floral-addon' ),
                ),
                array(
                    'feature' => __( 'Table feature 3', 'w9-floral-addon' ),
                ),
            ) ) ),
            'params'      => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Feature', 'w9-floral-addon' ),
                    'description' => __( 'Single feature of table.', 'w9-floral-addon' ),
                    'param_name'  => 'feature',
                    'admin_label' => true
                )
            )
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => __( 'Enable button', 'w9-floral-addon' ),
            'param_name' => 'enable_button',
            'value'      => array(
                __( 'Yes, please!', 'w9-floral-addon' ) => 'yes'
            )
        ),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    ), $button_param, array( Floral_Map_Helpers::extra_class() ) )
) );