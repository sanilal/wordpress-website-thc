<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-counter-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'           => __( 'Floral Counter', 'w9-floral-addon' ),
	'base'           => Floral_SC_Counter::SC_BASE,
	'class'          => '',
	'icon'           => 'w9 w9-ico-basic-calculator',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'description'    => __( 'Make couter group to count anything you want', 'w9-floral-addon' ),
	'php_class_name' => 'Floral_SC_Counter',
	'params'         => array(
		
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Style', 'w9-floral-addon' ),
			'param_name'       => 'style',
			'value'            => array(
				__( 'Standard', 'w9-floral-addon' )         => 'style1',
				__( 'No Icon', 'w9-floral-addon' )     => 'style2',
			),
			'std'              => 'style1',
		),
		
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon position', 'w9-floral-addon' ),
			'param_name'       => 'icon_position',
			'value'            => array(
				__( 'Left', 'w9-floral-addon' )         => 'icon-pos-left',
				__( 'Right', 'w9-floral-addon' )     => 'icon-pos-right',
				__( 'Top', 'w9-floral-addon' )     => 'icon-pos-top',
			),
			'std'              => 'icon-pos-left',
			'dependency' => array(
				'element' => 'style',
				'value'   => 'style1'
			),
		),
		
		array(
			'type'       => 'param_group',
			'heading'    => __( 'Counters value', 'w9-floral-addon' ),
			'param_name' => 'values',
			'value'      => urlencode( json_encode( array(
				array(
					'title' => __( 'HAPPY CLIENT', 'w9-floral-addon' ),
					'from'  => '0',
					'to'    => '2316',
					'type'  => 'floral',
					'icon_floral' => 'flor-ico flor-ico-face-mask',
					'description' => ''
				),
				array(
					'title' => __( 'THERAPISTS', 'w9-floral-addon' ),
					'from'  => '0',
					'to'    => '485',
					'type'  => 'floral',
					'icon_floral' => 'flor-ico flor-ico-bowl',
					'description' => ''
				),
				array(
					'title' => __( 'TREATMENTS', 'w9-floral-addon' ),
					'from'  => '0',
					'to'    => '716',
					'type'  => 'floral',
					'icon_floral' => 'flor-ico flor-ico-medicine',
					'description' => ''
				),
				array(
					'title' => __( 'OTHER CARE', 'w9-floral-addon' ),
					'from'  => '0',
					'to'    => '1526',
					'type'  => 'floral',
					'icon_floral' => 'flor-ico flor-ico-medical',
					'description' => ''
				),
			) ) ),
			'params'     => array(
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title', 'w9-floral-addon' ),
					'param_name'  => 'title',
					'description' => __( 'Enter title for counter.', 'w9-floral-addon' ),
					'admin_label' => true,
					'std'         => __( 'Counter title', 'w9-floral-addon' ),
				),
				array(
					'type'        => 'number',
					'heading'     => __( 'From', 'w9-floral-addon' ),
					'description' => __( 'Begin value of counter.', 'w9-floral-addon' ),
					'param_name'  => 'from',
					'admin_label' => true,
				),
				array(
					'type'        => 'number',
					'heading'     => __( 'To', 'w9-floral-addon' ),
					'description' => __( 'Finish value of counter.', 'w9-floral-addon' ),
					'param_name'  => 'to',
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Prefix', 'w9-floral-addon' ),
					'param_name'  => 'prefix',
					'description' => __( 'Enter title prefix for counter.', 'w9-floral-addon' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Suffix', 'w9-floral-addon' ),
					'param_name'  => 'suffix',
					'description' => __( 'Enter title suffix for counter.', 'w9-floral-addon' ),
				),
				Floral_Map_Helpers::get_icons_picker_type(),
				Floral_Map_Helpers::get_icon_picker_9wpthemes( '', false ),
				Floral_Map_Helpers::get_icon_picker_floral( '', false ),
				Floral_Map_Helpers::get_icon_picker_fontawesome( '', false ),
				Floral_Map_Helpers::get_icon_picker_openiconic( '', false ),
				Floral_Map_Helpers::get_icon_picker_typicons( '', false ),
				Floral_Map_Helpers::get_icon_picker_entypo( '', false ),
				Floral_Map_Helpers::get_icon_picker_linecons( '', false ),
				Floral_Map_Helpers::get_icon_picker_monosocial( '', false ),
				array(
					'type'        => 'textarea',
					'heading'     => __( 'Description', 'w9-floral-addon' ),
					'param_name'  => 'description',
					'description' => __( 'Enter description for counter.', 'w9-floral-addon' ),
				),
			
			),
		),
		//Number counter in row
		array_merge( Floral_Map_Helpers::item_width(), array( 'group' => __( 'Responsive Options', 'w9-floral-addon' ) ) ),
		Floral_Map_Helpers::responsive_item_width(),
		//Counter Time
		array(
			'type'        => 'number',
			'heading'     => __( 'Count time', 'w9-floral-addon' ),
			'description' => __( 'Time length to run counter.', 'w9-floral-addon' ),
			'param_name'  => 'time',
			'admin_label' => true,
			'std'         => '2.5'
		),
		
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Content text align', 'w9-floral-addon' ),
			'param_name'       => 'text_align',
			'value'            => array(
				__( 'Inherit', 'w9-floral-addon' )   => 'text-__',
				__( 'Left', 'w9-floral-addon' )   => 'text-left',
				__( 'Center', 'w9-floral-addon' ) => 'text-center',
				__( 'Right', 'w9-floral-addon' )  => 'text-right',
			),
			'description'      => esc_html__( 'Select the counter content text alignment.', 'w9-floral-addon' ),
			'std'              => 'text-center',
		),
		
		// icon
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Icon color', 'w9-floral-addon' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'param_name'         => 'icon_color',
			'value'              => Floral_Map_Helpers::get_colors(),
			'description'        => __( 'Select color for the icon.', 'w9-floral-addon' ),
			'std'                => 's',
			'dependency'         => array(
				'element' => 'style',
				'value'   => 'style1'
			),
		),
		
		
		array(
			'type'       => 'colorpicker',
			'heading'    => __( 'Custom icon color', 'w9-floral-addon' ),
			'param_name' => 'custom_icon_color',
			'value'      => '',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => 'custom'
			),
		),
		
		// number
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Number color', 'w9-floral-addon' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'param_name'         => 'number_color',
			'value'              => Floral_Map_Helpers::get_colors(),
			'description'        => __( 'Select color for the number.', 'w9-floral-addon' ),
			'std'                => 'p',
		),
		
		
		array(
			'type'       => 'colorpicker',
			'heading'    => __( 'Custom number color', 'w9-floral-addon' ),
			'param_name' => 'custom_number_color',
			'value'      => '',
			'dependency' => array(
				'element' => 'number_color',
				'value'   => 'custom'
			),
		),
		
		// title
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Title color', 'w9-floral-addon' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'param_name'         => 'title_color',
			'value'              => Floral_Map_Helpers::get_colors(),
			'description'        => __( 'Select color for your title.', 'w9-floral-addon' ),
			'std'                => '__',
		),
		
		
		array(
			'type'       => 'colorpicker',
			'heading'    => __( 'Custom title color', 'w9-floral-addon' ),
			'param_name' => 'custom_title_color',
			'value'      => '',
			'dependency' => array(
				'element' => 'title_color',
				'value'   => 'custom'
			),
		),
		
		Floral_Map_Helpers::extra_class(),
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay()
	)
) );