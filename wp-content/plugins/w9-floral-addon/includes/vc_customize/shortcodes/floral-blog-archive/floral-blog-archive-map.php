<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-blog-archive-map.php
 * @time    : 4/9/2017 3:42 PM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map(
	array(
		'name'           => esc_html__( 'Floral Blog Archive', 'w9-floral-addon' ),
		'base'           => Floral_SC_Blog_Archive::SC_BASE,
		'icon'           => 'w9 w9-ico-dot-3',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Blog_Archive',
		'params'         => array(
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_display_type',
				'heading'     => esc_html__( 'Display type', 'w9-floral-addon' ),
				'description' => esc_html__( 'Select archive display type.', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'Wide', 'w9-floral-addon' )    => 'wide',
					esc_html__( 'Grid', 'w9-floral-addon' )    => 'grid',
					esc_html__( 'Masonry', 'w9-floral-addon' ) => 'masonry',
				),
				'std'         => 'wide',
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_display_style',
				'heading'     => esc_html__( 'Display style', 'w9-floral-addon' ),
				'description' => esc_html__( 'Select archive display style.', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'Classic', 'w9-floral-addon' ) => 'style-1',
					esc_html__( 'Modern', 'w9-floral-addon' )  => 'style-2'
				),
				'std'         => 'style-1',
				'dependency'  => array(
					'element' => 'ba_display_type',
					'value'   => array( 'wide' ),
				),
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_display_columns',
				'heading'     => esc_html__( 'Display columns', 'w9-floral-addon' ),
				'description' => esc_html__( 'Choose the number of columns to display on archive pages.', 'w9-floral-addon' ),
				'value'       => array(
					'2' => '2',
					'3' => '3',
					'4' => '4'
				),
				'std'         => '3',
				'dependency'  => array(
					'element' => 'ba_display_type',
					'value'   => array( 'masonry', 'grid' ),
				),
			),
			
			
			array(
				'type'        => 'switcher',
				'param_name'  => 'ba_item_header',
				'heading'     => esc_html__( 'Enable blog item header', 'w9-floral-addon' ),
				'description' => esc_html__( 'Enable blog item header.', 'w9-floral-addon' ),
				'std'         => 1
			),
			// meta
			//============================
			
			array(
				'type'        => 'dropdown',
				'heading'     => __( 'Blog item image size', 'w9-floral-addon' ),
				'param_name'  => 'ba_item_image_size',
				'value'       => get_intermediate_image_sizes(),
				'group'       => __( 'Meta', 'w9-floral-addon' ),
				'description' => __( 'Select image size from list.', 'w9-floral-addon' ),
				'std'         => 'floral_1170',
			),
			
			array(
				'type'       => 'dropdown',
				'param_name' => 'ba_item_image_ratio',
				'heading'    => esc_html__( 'Blog item image ratio', 'w9-floral-addon' ),
//			'description' => esc_html__( 'Action with the feature image of the blog item.', 'w9-floral-addon' ),
				'value'      => wp_parse_args( array( __( 'Original', 'w9-floral-addon' ) => 'original' ), Floral_Image::get_floral_ratio_list() ),
				'group'      => __( 'Meta', 'w9-floral-addon' ),
				'std'        => 'original',
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_item_image_action',
				'heading'     => esc_html__( 'Blog item feature image action', 'w9-floral-addon' ),
				'description' => esc_html__( 'Action with the feature image of the blog item.', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'None', 'w9-floral-addon' )         => 'none',
					esc_html__( 'Link to post', 'w9-floral-addon' ) => 'link',
				),
				'group'       => __( 'Meta', 'w9-floral-addon' ),
				'std'         => 'link',
			),
			
			
//			array(
//				'type'        => 'checkbox',
//				'param_name'  => 'blog-archive-post-meta',
//				'heading'     => __( 'Meta', 'w9-floral-addon' ),
//				'description' => __( 'Disable or enable meta options.', 'w9-floral-addon' ),
//				'value'       => array(
//					'date'         => esc_html__( 'Date', 'w9-floral-addon' ),
//					'author'       => esc_html__( 'Author', 'w9-floral-addon' ),
//					'categories'   => esc_html__( 'Categories', 'w9-floral-addon' ),
//					'tags'         => esc_html__( 'Tags', 'w9-floral-addon' ),
//					'comments'     => esc_html__( 'Comments', 'w9-floral-addon' ),
//					'social-share' => esc_html__( 'Social Share', 'w9-floral-addon' ),
//				),
//				'std'         => array(
//					'date'         => 1,
//					'author'       => 1,
//					'categories'   => 1,
//					'tags'         => 0,
//					'comments'     => 1,
//					'social-share' => 1,
//				),
//			),
			
			array(
				'type'             => 'switcher',
				'heading'          => __( 'Show date ? ', 'w9-floral-addon' ),
				'param_name'       => 'ba_show_date',
				'std'              => '1',
				'group'            => __( 'Meta', 'w9-floral-addon' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			
			array(
				'type'             => 'switcher',
				'heading'          => __( 'Show author ? ', 'w9-floral-addon' ),
				'param_name'       => 'ba_show_author',
				'std'              => '1',
				'group'            => __( 'Meta', 'w9-floral-addon' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			
			array(
				'type'             => 'switcher',
				'heading'          => __( 'Show category ? ', 'w9-floral-addon' ),
				'param_name'       => 'ba_show_category',
				'std'              => '1',
				'group'            => __( 'Meta', 'w9-floral-addon' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			
			array(
				'type'             => 'switcher',
				'heading'          => __( 'Show tags ? ', 'w9-floral-addon' ),
				'param_name'       => 'ba_show_tags',
				'std'              => '0',
				'group'            => __( 'Meta', 'w9-floral-addon' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			
			array(
				'type'             => 'switcher',
				'heading'          => __( 'Show comments ? ', 'w9-floral-addon' ),
				'param_name'       => 'ba_show_comments',
				'std'              => '1',
				'group'            => __( 'Meta', 'w9-floral-addon' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			
			array(
				'type'             => 'switcher',
				'heading'          => __( 'Show social-share ? ', 'w9-floral-addon' ),
				'param_name'       => 'ba_show_social_share',
				'std'              => '1',
				'group'            => __( 'Meta', 'w9-floral-addon' ),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
			),
			
			//============================
			
			//paging
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_paging_type',
				'heading'     => esc_html__( 'Paging type', 'w9-floral-addon' ),
				'description' => esc_html__( 'Select archive paging type.', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'Default', 'w9-floral-addon' )         => 'default',
					esc_html__( 'Load More', 'w9-floral-addon' )       => 'load-more',
					esc_html__( 'Infinite Scroll', 'w9-floral-addon' ) => 'infinite-scroll'
				),
				'std'         => 'default'
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_paging_style',
				'heading'     => esc_html__( 'Paging style', 'w9-floral-addon' ),
				'description' => esc_html__( 'Select archive paging style.', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'Classic', 'w9-floral-addon' ) => 'style-1',
					esc_html__( 'Modern', 'w9-floral-addon' )  => 'style-2',
				),
				'std'         => 'style-2',
				'dependency'  => array(
					'element' => 'ba_paging_type',
					'value'   => array( 'default' ),
				)
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'ba_paging_align',
				'heading'     => esc_html__( 'Paging align', 'w9-floral-addon' ),
				'description' => esc_html__( 'Select archive paging align.', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'left', 'w9-floral-addon' )   => 'left',
					esc_html__( 'Center', 'w9-floral-addon' ) => 'center',
					esc_html__( 'Right', 'w9-floral-addon' )  => 'right',
				),
				'std'         => 'center',
				'dependency'  => array(
					'element' => 'ba_paging_type',
					'value'   => array( 'default' ),
				)
			),
			Floral_Map_Helpers::extra_class(),
			Floral_Map_Helpers::design_options(),
		)
	)
);