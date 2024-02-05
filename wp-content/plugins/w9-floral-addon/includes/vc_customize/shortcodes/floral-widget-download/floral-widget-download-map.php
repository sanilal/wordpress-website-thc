<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-widget-download-map.php
 * @time    : 12/9/2016 11:43 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map(
	array(
		'name'           => esc_html__( 'Floral Widget Download', 'w9-floral-addon' ),
		'base'           => Floral_SC_Widget_Download::SC_BASE,
		'icon'           => 'w9 w9-ico-download-1',
		'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_SC_CATEGORY ),
		'php_class_name' => 'Floral_SC_Widget_Download',
		'description'    => __( 'Floral widget download', 'w9-floral-addon' ),
		'params'         => array_merge( array(
			array(
				'type'        => 'textfield',
				'param_name'  => 'title',
				'heading'     => __( 'Widget title', 'w9-floral-addon' ),
				'description' => __( 'What text use as a widget title. Leave blank if you don\' want to show the widget title.', 'w9-floral-addon' ),
			),
			array(
				'type'       => 'getfile',
				'param_name' => 'file',
				'heading'    => esc_html__( 'Select File', 'w9-floral-addon' ),
			),
			
			array(
				'type'        => 'textfield',
				'param_name'  => 'display_text',
				'admin_label' => true,
				'heading'     => esc_html__( 'Display Text', 'w9-floral-addon' ),
				'std'         => __( 'DOWNLOAD', 'w9-floral-addon' )
			),
			
			array(
				'type'        => 'dropdown',
				'param_name'  => 'file_type',
				'admin_label' => true,
				'heading'     => esc_html__( 'File Type', 'w9-floral-addon' ),
				'value'       => array(
					esc_html__( 'DOC', 'w9-floral-addon' )    => 'DOC',
					esc_html__( 'XLS', 'w9-floral-addon' )    => 'XLS',
					esc_html__( 'PDF', 'w9-floral-addon' )    => 'PDF',
					esc_html__( 'PPT', 'w9-floral-addon' )    => 'PPT',
					esc_html__( 'Custom', 'w9-floral-addon' ) => 'custom',
				),
				'std'         => 'DOC'
			),
		
		), Floral_Map_Helpers::widget_common_params() )
	)
);
