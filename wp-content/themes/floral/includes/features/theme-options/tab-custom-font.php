<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: tab-custom-font.php
 * @time    : 1/10/2017 9:59 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( floral_get_current_preset() === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
	$this->sections[] = array(
		'title'      => esc_html__( 'Custom Font', 'floral' ),
		'desc'       => '<span style="color:red"><strong>' . esc_html__( 'Notice: Save your changes and refresh the page before go to Typography section!', 'floral' ) . '</strong></span>',
		'subsection' => true,
		'icon'       => 'el el-fontsize',
		'fields'     => array(
			array(
				'id'     => 'section_custom_font_1',
				'type'   => 'info',
				'title'  => esc_html__( 'Custom Font 1', 'floral' ),
				'indent' => true
			),
			array(
				'id'      => 'custom_font_1_name',
				'type'    => 'text',
				'title'   => esc_html__( 'Custom font Name 1', 'floral' ),
				'desc'    => '',
				'default' => ''
			),
			array(
				'id'             => 'custom_font_1_eot',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 1 (.eot)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .eot here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'eot' )
			),
			array(
				'id'             => 'custom_font_1_ttf',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 1 (.ttf)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .ttf here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'ttf' ),
			),
			array(
				'id'             => 'custom_font_1_woff',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 1 (.woff)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .woff here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'woff' )
			),
			array(
				'id'             => 'custom_font_1_svg',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 1 (.svg)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .svg here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'svg' )
			),
			array(
				'id'     => 'section_custom_font_2',
				'type'   => 'info',
				'title'  => esc_html__( 'Custom Font 2', 'floral' ),
				'indent' => true
			),
			array(
				'id'      => 'custom_font_2_name',
				'type'    => 'text',
				'title'   => esc_html__( 'Custom font Name 2', 'floral' ),
				'desc'    => '',
				'default' => ''
			),
			array(
				'id'             => 'custom_font_2_eot',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 2 (.eot)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .eot here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'eot' )
			),
			array(
				'id'             => 'custom_font_2_ttf',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 2 (.ttf)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .ttf here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'ttf' )
			),
			array(
				'id'             => 'custom_font_2_woff',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 2 (.woff)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .woff here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'woff' )
			),
			array(
				'id'             => 'custom_font_2_svg',
				'type'           => 'media',
				'url'            => true,
				'preview'        => 'false',
				'title'          => esc_html__( 'Custom font 2 (.svg)', 'floral' ),
				'subtitle'       => esc_html__( 'Upload your font .svg here.', 'floral' ),
				'desc'           => '',
				'library_filter' => array( 'svg' )
			),
		)
	);
}