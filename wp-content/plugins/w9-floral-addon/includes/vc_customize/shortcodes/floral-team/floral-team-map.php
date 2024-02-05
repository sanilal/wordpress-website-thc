<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-team-map.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$social_list        = Floral_SC_Team::get_team_social_list();
$member_social_list = array();
foreach ( $social_list as $key => $social ) {
	$member_social_list[ $social['label'] ] = $key;
}

vc_map( array(
	'name'           => esc_html__( 'Floral Team Member', 'w9-floral-addon' ),
	'base'           => Floral_SC_Team::SC_BASE,
	'class'          => '',
	'icon'           => 'w9 w9-ico-185082-man-people-streamline-user',
	'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
	'php_class_name' => 'Floral_SC_Team',
	'description'    => __( 'Create team member with social profile', 'w9-floral-addon' ),
	'params'         => array(
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Team member style', 'w9-floral-addon' ),
			'param_name' => 'member_style',
			'value'      => array(
				__( 'Style 1', 'w9-floral-addon' )           => 'style-1',
				__( 'Style 1 - inverse', 'w9-floral-addon' ) => 'style-1i',
				__( 'Style 2', 'w9-floral-addon' )           => 'style-2',
				__( 'Style 3', 'w9-floral-addon' )           => 'style-3',
				__( 'Style 4', 'w9-floral-addon' )           => 'style-4',
				__( 'Style 5', 'w9-floral-addon' )           => 'style-5',
			),
			'std'        => 'style-1'
		),
		
		array(
			'type'       => 'switcher',
			'heading'    => __( 'Is inverse style ?', 'w9-floral-addon' ),
			'param_name' => 'is_inverse',
			'std'        => '0',
			'dependency'       => array(
				'element'            => 'member_style',
				'value' => array( 'style-4' )
			),
		),
		
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Hover style', 'w9-floral-addon' ),
			'param_name' => 'hover_style',
			'value'      => array(
				__( 'Style 1', 'w9-floral-addon' ) => 'hover-style-1',
				__( 'Style 2', 'w9-floral-addon' ) => 'hover-style-2',
			),
			'dependency' => array(
				'element' => 'member_style',
				'value'   => array( 'style-1', 'style-1i' )
			),
			'std'        => 'style-1'
		),
		
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Member name', 'w9-floral-addon' ),
			'description' => __( 'Fill the team member name.', 'w9-floral-addon' ),
			'param_name'  => 'member_name',
			'admin_label' => true
		),
		array(
			'type'        => 'vc_link',
			'heading'     => __( 'Member URL', 'w9-floral-addon' ),
			'description' => __( 'Link when click to member name.', 'w9-floral-addon' ),
			'param_name'  => 'member_url',
		),
		array(
			'type'        => 'textfield',
			'heading'     => __( 'Role ', 'w9-floral-addon' ),
			'description' => __( 'Role of member in the team.', 'w9-floral-addon' ),
			'param_name'  => 'member_role',
			'admin_label' => true,
		),
		array(
			'type'        => 'textarea_safe',
			'heading'     => __( 'Member description', 'w9-floral-addon' ),
			'description' => __( 'Fill the menber description.', 'w9-floral-addon' ),
			'param_name'  => 'member_description',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Member avatar', 'w9-floral-addon' ),
			'description' => __( 'Select member avatar.', 'w9-floral-addon' ),
			'param_name'  => 'member_avatar',
			'admin_label' => true,
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Image size', 'w9-floral-addon' ),
			'param_name'       => 'avatar_size',
			'value'            => wp_parse_args( array( __( 'Custom', 'w9-floral-addon' ) => 'custom' ), get_intermediate_image_sizes() ),
			'std'              => 'floral_370',
			'description'      => __( 'Select image size from common image size of theme or defined your custom size.', 'w9-floral-addon' ),
			'edit_field_class' => 'vc_col-sm-6'
		),
		array(
			'type'             => 'textfield',
			'heading'          => __( 'Custom image size', 'w9-floral-addon' ),
			'param_name'       => 'custom_avatar_size',
			'description'      => __( 'Enter image size string are not listed in image size or enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'w9-floral-addon' ),
			'dependency'       => array(
				'element' => 'avatar_size',
				'value'   => array( 'custom' )
			),
			'edit_field_class' => 'vc_col-sm-6'
		),
		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Image ratio', 'w9-floral-addon' ),
			'description'      => __( 'Image ratio base on image size width.', 'w9-floral-addon' ),
			'param_name'       => 'avatar_ratio',
			'value'            => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
			'std'              => 'original',
			'dependency'       => array(
				'element'            => 'member_style',
				'value_not_equal_to' => array( 'style-4' )
			),
			'edit_field_class' => 'vc_col-sm-6'
		),
		array(
			'type'        => 'dropdown',
			'heading'     => __( 'Avatar click action', 'w9-floral-addon' ),
			'param_name'  => 'avatar_onclick',
			'value'       => array(
				__( 'None', 'w9-floral-addon' )                    => '',
				__( 'Open Image In Light Box', 'w9-floral-addon' ) => 'lightbox',
				__( 'Member Url', 'w9-floral-addon' )              => 'member_url',
			),
			'description' => __( 'Select action for click action.', 'w9-floral-addon' ),
			'std'         => 'member_url',
		),
		array(
			'type'        => 'param_group',
			'heading'     => __( 'Socials list', 'w9-floral-addon' ),
			'description' => __( 'List socials url of member.', 'w9-floral-addon' ),
			'param_name'  => 'member_socials',
			'value'       => urlencode( json_encode( array(
				array(
					'social_type' => 'facebook',
					'social_url'  => 'https://www.facebook.com/',
				),
				array(
					'social_type' => 'twitter',
					'social_url'  => 'https://twitter.com',
				),
				array(
					'social_type' => 'googleplus',
					'social_url'  => 'https://plus.google.com/',
				),
				array(
					'social_type' => 'linkedin',
					'social_url'  => 'https://www.linkedin.com/',
				),
			) ) ),
			'params'      => array(
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Social', 'w9-floral-addon' ),
					'description'      => __( 'Please select common social from this list.', 'w9-floral-addon' ),
					'param_name'       => 'social_type',
					'admin_label'      => true,
					'value'            => $member_social_list,
					'edit_field_class' => 'vc_col-sm-3  vc_column-with-padding',
				),
				array(
					'type'             => 'textfield',
					'heading'          => __( 'Social URL', 'w9-floral-addon' ),
					'description'      => __( 'Fill social URL of type in left to.', 'w9-floral-addon' ),
					'param_name'       => 'social_url',
					'admin_label'      => true,
					'edit_field_class' => 'vc_col-sm-9',
				)
			)
		),
		
		Floral_Map_Helpers::design_options(),
		Floral_Map_Helpers::animation_css(),
		Floral_Map_Helpers::animation_duration(),
		Floral_Map_Helpers::animation_delay(),
		Floral_Map_Helpers::extra_class()
	)
) );