<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-list-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'           => __( 'Floral List', 'w9-floral-addon' ),
	'base'           => Floral_SC_List::SC_BASE,
	'class'          => '',
	'icon'           => 'w9 w9-ico-basic-todo-txt',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'description'    => __( 'Build simple listing with icon', 'w9-floral-addon' ),
	'php_class_name' => 'Floral_SC_List',
	'params'         => array(
		array(
			'type'       => 'param_group',
			'heading'    => __( 'Lists', 'w9-floral-addon' ),
			'param_name' => 'values',
			'value'      => urlencode( json_encode( array(
				array(
					'title' => 'List Item 1'
				),
				array(
					'title' => 'List Item 2'
				),
				array(
					'title' => 'List Item 3'
				),
			) ) ),
			'params'     => array(
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Title', 'w9-floral-addon' ),
					'param_name'  => 'title',
					'description' => __( 'Enter title for list item.', 'w9-floral-addon' ),
					'admin_label' => true,
					'std'         => __( 'List Title', 'w9-floral-addon' ),
				),
				
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Use other icon?', 'w9-floral-addon' ),
					'description' => esc_html__( 'Pick icon for this list item, if not it use the default icon of the list.', 'w9-floral-addon' ),
					'param_name'  => 'add_icon',
					'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
				),
				
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Icon type', 'w9-floral-addon' ),
					'param_name'  => 'icon_type',
					'value'       => array(
						__( 'Icon Library', 'w9-floral-addon' )     => 'type-icon-lib',
						__( 'Background Image', 'w9-floral-addon' ) => 'type-bgi',
					),
					'std'         => 'type-icon-lib',
					'description' => __( 'Select icon type.', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'add_icon',
						'value'   => 'yes',
					),
				),
				
				array_merge( Floral_Map_Helpers::get_icons_picker_type( '9wpthemes', false ), array(
					'dependency' => array(
						'element' => 'icon_type',
						'value'   => 'type-icon-lib'
					)
				) ),
				Floral_Map_Helpers::get_icon_picker_9wpthemes( '', false ),
				Floral_Map_Helpers::get_icon_picker_floral( '', false ),
				Floral_Map_Helpers::get_icon_picker_fontawesome( '', false ),
				Floral_Map_Helpers::get_icon_picker_openiconic( '', false ),
				Floral_Map_Helpers::get_icon_picker_typicons( '', false ),
				Floral_Map_Helpers::get_icon_picker_entypo( '', false ),
				Floral_Map_Helpers::get_icon_picker_linecons( '', false ),
				Floral_Map_Helpers::get_icon_picker_monosocial( '', false ),
				array(
					'type'        => 'attach_image',
					'heading'     => __( 'Image', 'w9-floral-addon' ),
					'param_name'  => 'image',
					'value'       => '',
					'description' => __( 'Select image from media library.', 'w9-floral-addon' ),
					'dependency'  => array(
						'element' => 'icon_type',
						'value'   => 'type-bgi',
					),
				),
				
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Link (URL)', 'w9-floral-addon' ),
					'param_name' => 'item_link',
					'value'      => '',
				),
			)
		),
		
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'List style', 'w9-floral-addon' ),
			'param_name'       => 'list_style',
			'value'            => array(
				__( 'Vertical', 'w9-floral-addon' )   => 'vertical',
				__( 'Horizontal', 'w9-floral-addon' ) => 'horizontal',
			),
			'admin_label'      => true,
			'std'              => 'vertical',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'description'      => __( 'Select style for the list.', 'w9-floral-addon' )
		),
		
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Text font weight', 'w9-floral-addon' ),
			'param_name'       => 'list_text_fw',
			'value'            => array(
				__( 'Inherit', 'w9-floral-addon' )         => 'fw-inherit',
				__( 'Light (300)', 'w9-floral-addon' )     => 'fw-light',
				__( 'Regular (400)', 'w9-floral-addon' )   => 'fw-regular',
				__( 'Medium (500)', 'w9-floral-addon' )    => 'fw-medium',
				__( 'Semi Bold (600)', 'w9-floral-addon' ) => 'fw-semibold',
				__( 'Bold (700)', 'w9-floral-addon' )      => 'fw-bold',
			),
			'description'      => esc_html__( 'Select font weight. May be some value do not work because of the font does not support it.', 'w9-floral-addon' ),
			'std'              => 'fw-inherit',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		
		// item spacing
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'List item spacing', 'w9-floral-addon' ),
			'param_name'       => 'list_item_spacing',
			'value'            => array(
				'None' => '0',
				'5px'  => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
				'40px' => '40',
			),
			'std'              => '0',
			'admin_label'      => true,
			'description'      => esc_html__( 'Adjust the spacing between each list items.', 'w9-floral-addon' ),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		
		array(
			'type'             => 'dropdown',
			'heading'          => esc_html__( 'Icon alignment', 'w9-floral-addon' ),
			'param_name'       => 'list_icon_align',
			'value'            => array(
				esc_html__( 'Left', 'w9-floral-addon' )  => 'align-icon-left',
				esc_html__( 'Right', 'w9-floral-addon' ) => 'align-icon-right',
			),
			'admin_label'      => true,
			'description'      => esc_html__( 'Select the icon alignment.', 'w9-floral-addon' ),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		
		array(
			'type'        => 'slider',
			'heading'     => esc_html__( 'Icon size', 'w9-floral-addon' ),
			'param_name'  => 'list_icon_size',
			'unit'        => '%',
			'min'         => '50',
			'max'         => '200',
			'step'        => '5',
			'std'         => '100%',
			'description' => esc_html__( 'Adjust the icon size of the list.', 'w9-floral-addon' ),
		),


//        array(
//            'type'        => 'checkbox',
//            'heading'     => esc_html__( 'Remove spacing of first and last item?', 'w9-floral-addon' ),
//            'description' => esc_html__( 'Remove the unexpected space of first and last item.', 'w9-floral-addon' ),
//            'param_name'  => 'list_fix_first_last_item',
//            'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
//        ),
		
		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Default icon for the list?', 'w9-floral-addon' ),
			'description' => esc_html__( 'Add default icon for all item in list.', 'w9-floral-addon' ),
			'param_name'  => 'list_icon',
			'value'       => array( esc_html__( 'Yes', 'w9-floral-addon' ) => 'yes' ),
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Icon type', 'w9-floral-addon' ),
			'param_name'  => 'list_icon_type',
			'value'       => array(
				__( 'Icon Library', 'w9-floral-addon' )     => 'type-icon-lib',
				__( 'Background Image', 'w9-floral-addon' ) => 'type-bgi',
			),
			'std'         => 'type-icon-lib',
			'description' => __( 'Select icon type.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'list_icon',
				'value'   => 'yes',
			),
		),
		
		array_merge( Floral_Map_Helpers::get_icons_picker_type( '9wpthemes', false ), array(
			'dependency' => array(
				'element' => 'list_icon_type',
				'value'   => 'type-icon-lib'
			)
		) ),
		Floral_Map_Helpers::get_icon_picker_9wpthemes( '', false ),
		Floral_Map_Helpers::get_icon_picker_floral( '', false ),
		Floral_Map_Helpers::get_icon_picker_fontawesome( '', false ),
		Floral_Map_Helpers::get_icon_picker_openiconic( '', false ),
		Floral_Map_Helpers::get_icon_picker_typicons( '', false ),
		Floral_Map_Helpers::get_icon_picker_entypo( '', false ),
		Floral_Map_Helpers::get_icon_picker_linecons( '', false ),
		Floral_Map_Helpers::get_icon_picker_monosocial( '', false ),
		
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Image', 'w9-floral-addon' ),
			'param_name'  => 'list_icon_image',
			'value'       => '',
			'description' => __( 'Select image from media library.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'list_icon_type',
				'value'   => 'type-bgi',
			),
		),
		
		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Icon color', 'w9-floral-addon' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'param_name'         => 'icon_color',
			'value'              => Floral_Map_Helpers::get_colors(),
			'description'        => esc_html__( 'Select color for the list icon.', 'w9-floral-addon' ),
			'std'                => 'p'
		),
		
		array(
			'type'       => 'colorpicker',
			'heading'    => __( 'Custom icon color', 'w9-floral-addon' ),
			'param_name' => 'icon_custom_color',
			'dependency' => array( 'element' => 'icon_color', 'value' => 'custom' )
		),
		
		// fix vertical position
		array(
			'type'        => 'slider',
			'heading'     => __( 'Fix icon vertical position', 'w9-floral-addon' ),
			'param_name'  => 'list_icon_fix_vertical_position',
			'unit'        => 'px',
			'min'         => '-5',
			'max'         => '5',
			'step'        => '1',
			'std'         => '0px',
			'description' => esc_html__( 'Allow you to fix the vertical position of the icon.', 'w9-floral-addon' ),
		),
		
		array(
			'type'        => 'slider',
			'heading'     => __( 'Icon and text spacing', 'w9-floral-addon' ),
			'param_name'  => 'list_icon_text_spacing',
			'unit'        => 'em',
			'min'         => '0',
			'max'         => '2',
			'step'        => '0.1',
			'std'         => '0.8em',
			'description' => esc_html__( 'Adjust the spacing between icon and text.', 'w9-floral-addon' ),
		),
		
		
		Floral_Map_Helpers::extra_class(),
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay()
	)
) );