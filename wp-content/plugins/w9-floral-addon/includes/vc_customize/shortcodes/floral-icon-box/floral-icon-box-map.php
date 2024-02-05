<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-icon-box-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'           => __( 'Icon Box', 'w9-floral-addon' ),
	'base'           => Floral_SC_Icon_Box::SC_BASE,
	'icon'           => 'w9 w9-ico-basic-flag2',
	'category'       => FLORAL_SC_CATEGORY,
	'description'    => __( 'Adds icon box with font icons', 'w9-floral-addon' ),
	'php_class_name' => 'Floral_SC_Icon_Box',
	'params'         => array(
		Floral_Map_Helpers::get_icons_picker_type(),
		Floral_Map_Helpers::get_icon_picker_9wpthemes(),
		Floral_Map_Helpers::get_icon_picker_floral(),
		Floral_Map_Helpers::get_icon_picker_fontawesome(),
		Floral_Map_Helpers::get_icon_picker_openiconic(),
		Floral_Map_Helpers::get_icon_picker_typicons(),
		Floral_Map_Helpers::get_icon_picker_entypo(),
		Floral_Map_Helpers::get_icon_picker_linecons(),
		Floral_Map_Helpers::get_icon_picker_monosocial(),
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Icon style', 'w9-floral-addon' ),
			'param_name'  => 'ib_i_style',
			'admin_label' => true,
			'value'       => array(
				__( 'Normal', 'w9-floral-addon' )  => 'normal',
				__( 'Rounded', 'w9-floral-addon' ) => 'rounded',
			),
			'description' => __( 'Select icon style.', 'w9-floral-addon' ),
//		    'dependency'  => array(
//			    'element' => 'ib_i_align',
//			    'value' => array( 'left' ,'top-center', 'right')
//		    ),
			'std'         => 'rounded'
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Icon alignment', 'w9-floral-addon' ),
			'param_name'  => 'ib_i_style_rounded_align',
//			'admin_label' => true,
			'value'       => array(
				__( 'Left', 'w9-floral-addon' )       => 'left',
				__( 'Top-Center', 'w9-floral-addon' ) => 'top-center',
				__( 'Right', 'w9-floral-addon' )      => 'right',
			),
			'description' => __( 'Select icon alignment.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'ib_i_style',
				'value'   => 'rounded'
			),
			'std'         => 'left'
		),
		
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Icon alignment', 'w9-floral-addon' ),
			'param_name'  => 'ib_i_style_normal_align',
//			'admin_label' => true,
			'value'       => array(
				__( 'Top-Left', 'w9-floral-addon' )   => 'top-left-inline',
				__( 'Top-Right', 'w9-floral-addon' )  => 'top-right-inline',
				__( 'Top-Center', 'w9-floral-addon' ) => 'top-center',
				__( 'Left', 'w9-floral-addon' )       => 'left',
				__( 'Right', 'w9-floral-addon' )      => 'right',
				__( 'Bottom', 'w9-floral-addon' )     => 'bottom'
			),
			'description' => __( 'Select icon alignment.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element' => 'ib_i_style',
				'value'   => 'normal'
			),
		),
		
		array(
			'type'       => 'slider',
			'heading'    => __( 'Icon scale', 'w9-floral-addon' ),
			'param_name' => 'ib_i_size',
			'unit'       => '%',
			'min'        => '50',
			'max'        => '200',
			'step'       => '5',
			'std'        => '100%',
			'dependency' => array(
				'element'            => 'ib_i_style_normal_align',
				'value_not_equal_to' => array( 'bottom' )
			),
		),
		
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Title', 'w9-floral-addon' ),
			'param_name'  => 'ib_title',
			'value'       => '',
			'description' => __( 'Enter the title for this element.', 'w9-floral-addon' ),
		),
		array(
			'type'        => 'vc_link',
			'heading'     => __( 'Link (URL)', 'w9-floral-addon' ),
			'param_name'  => 'ib_link',
			'value'       => '',
			'description' => __( 'Note: If \'Icon Alignment\' is \'bottom\', this will be a text under the icon.', 'w9-floral-addon' ),
		),
//		array(
//			'type'        => 'textfield',
//			'heading'     => __( 'Sub title', 'w9-floral-addon' ),
//			'param_name'  => 'ib_sub_title',
//			'value'       => '',
//			'description' => __( 'Provide the sub title for this element.', 'w9-floral-addon' ),
//		),
		array(
			'type'        => 'textarea',
			'heading'     => __( 'Description', 'w9-floral-addon' ),
			'param_name'  => 'ib_description',
			'value'       => '',
			'description' => __( 'Provide the description for this element.', 'w9-floral-addon' )
		),
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Icon color', 'w9-floral-addon' ),
			'param_name'         => 'ib_i_color',
			'group'              => __( 'Style', 'w9-floral-addon' ),
			'description'        => __( 'Select icon color. You can add more colors by setting "Define Most Used Colors" in theme options.', 'w9-floral-addon' ),
//			'admin_label'        => true,
			'param_holder_class' => 'vc_colored-dropdown',
			'value'              => array(
				                        __( 'Primary Color', 'w9-floral-addon' )   => 'p',
				                        __( 'Secondary Color', 'w9-floral-addon' ) => 's',
				                        __( 'Gradient', 'w9-floral-addon' )        => 'gradient',
				                        __( 'Text Color', 'w9-floral-addon' )      => 'text',
				                        __( 'Meta Text Color', 'w9-floral-addon' ) => 'meta-text',
				                        __( 'Border Color', 'w9-floral-addon' )    => 'border',
				                        __( 'Light #FFF', 'w9-floral-addon' )      => 'light',
				                        __( 'Dark #000', 'w9-floral-addon' )       => 'dark',
				                        __( 'Gray #222', 'w9-floral-addon' )       => 'gray2',
				                        __( 'Gray #444', 'w9-floral-addon' )       => 'gray4',
				                        __( 'Gray #666', 'w9-floral-addon' )       => 'gray6',
				                        __( 'Gray #888', 'w9-floral-addon' )       => 'gray8',
			                        ) + floral_get_most_used_colors( 'name_key' ),
			'std'                => 'light'
		),
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Gradient color 1', 'w9-floral-addon' ),
			'param_name'         => 'ib_i_gradient_color_1',
			'description'        => __( 'Select first color for gradient.', 'w9-floral-addon' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'value'              => Floral_Map_Helpers::get_just_colors(),
			'std'                => 'p',
			'dependency'         => array(
				'element' => 'ib_i_color',
				'value'   => array( 'gradient' ),
			),
			'edit_field_class'   => 'vc_col-sm-6',
			'group'              => __( 'Style', 'w9-floral-addon' ),
		),
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Gradient color 2', 'w9-floral-addon' ),
			'param_name'         => 'ib_i_gradient_color_2',
			'description'        => __( 'Select second color for gradient.', 'w9-floral-addon' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'value'              => Floral_Map_Helpers::get_just_colors(),
			'std'                => 's',
			'dependency'         => array(
				'element' => 'ib_i_color',
				'value'   => array( 'gradient' ),
			),
			'edit_field_class'   => 'vc_col-sm-6',
			'group'              => __( 'Style', 'w9-floral-addon' )
		),
		
		array(
			'type'             => 'number',
			'heading'          => __( 'Gradient angle', 'w9-floral-addon' ),
			'param_name'       => 'ib_i_gradient_angle',
			'description'      => __( 'Enter the gradient angle.', 'w9-floral-addon' ),
			'edit_field_class' => 'vc_col-sm-6',
			'dependency'       => array(
				'element' => 'ib_i_color',
				'value'   => array( 'gradient' ),
			),
			'std'              => '45',
			'group'            => __( 'Style', 'w9-floral-addon' )
		),
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Icon background color', 'w9-floral-addon' ),
			'param_name'         => 'ib_i_bgc',
//			'admin_label'        => true,
			'group'              => __( 'Style', 'w9-floral-addon' ),
			'value'              => Floral_Map_Helpers::get_just_colors(),
			'param_holder_class' => 'vc_colored-dropdown',
			'description'        => __( 'Select icon background color. You can add more colors by setting "Define Most Used Colors" in theme options', 'w9-floral-addon' ),
			'dependency'         => array(
				'element' => 'ib_i_style',
				'value'   => array( 'rounded' )
			),
			'std'                => 'p'
		),
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Icon color when hover', 'w9-floral-addon' ),
			'param_name'         => 'ib_i_hover_color',
//			'admin_label'        => true,
			'group'              => __( 'Style', 'w9-floral-addon' ),
			'value'              => Floral_Map_Helpers::get_just_colors(),
			'param_holder_class' => 'vc_colored-dropdown',
			'description'        => __( 'Select icon color when hover. You can add more colors by setting "Define Most Used Colors" in theme options', 'w9-floral-addon' ),
			'dependency'         => array(
				'element' => 'ib_i_style',
				'value'   => array( 'rounded' )
			),
			'std'                => 'light'
		),
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Icon background color when hover', 'w9-floral-addon' ),
			'param_name'         => 'ib_i_hover_bgc',
//			'admin_label'        => true,
			'group'              => __( 'Style', 'w9-floral-addon' ),
			'value'              => Floral_Map_Helpers::get_just_colors(),
			'param_holder_class' => 'vc_colored-dropdown',
			'description'        => __( 'Select icon background color when hover. You can add more colors by setting "Define Most Used Colors" in theme options', 'w9-floral-addon' ),
			'dependency'         => array(
				'element' => 'ib_i_style',
				'value'   => array( 'rounded' )
			),
			'std'                => 'p'
		),
		
		array(
			'type'               => 'dropdown',
			'heading'            => __( 'Text color', 'w9-floral-addon' ),
			'param_name'         => 'ib_tx_color',
//			'admin_label'        => true,
			'group'              => __( 'Style', 'w9-floral-addon' ),
			'value'              => array_merge( array(
					'Inherit' => '__'
				)
				, Floral_Map_Helpers::get_just_colors() ),
			'param_holder_class' => 'vc_colored-dropdown',
			'description'        => __( 'Select text color.', 'w9-floral-addon' ),
			'std'                => '__'
		),
//        array(
//            'type'        => 'dropdown',
//            'heading'     => __( 'Box shadow effect', 'w9-floral-addon' ),
//            'param_name'  => 'ib_boxshadow_effect',
//            'admin_label' => true,
//            'group'       => __( 'Style', 'w9-floral-addon' ),
//            'value'       => array(
//                __( 'None', 'w9-floral-addon' )       => '',
//                __( 'Permanent', 'w9-floral-addon' )  => 'ib-eff-boxshadow',
//                __( 'Hover Only', 'w9-floral-addon' ) => 'ib-eff-hover-boxshadow',
//            ),
//            'description' => __( 'Select box shadow effect.', 'w9-floral-addon' ),
//            'std'         => ''
//        ),
		Floral_Map_Helpers::extra_class(),
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::design_options_on_tablet(),
		Floral_Map_Helpers::design_options_on_mobile(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay()
	)
) );