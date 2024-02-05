<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-custom-code.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Custom Code
*/

$this->sections[] = array(
	'title' => esc_html__('Custom CSS & Script', 'floral'),
	'desc' => esc_html__('Easily add custom CSS to your website.', 'floral'),
	'icon' => 'el el-edit',
	'fields' => array(

		array(
		    'id'       => 'custom-css',
		    'type'     => 'ace_editor',
		    'title'    => esc_html__('Custom CSS', 'floral'),
		    'subtitle' => esc_html__('Insert your custom CSS code right here. It will be displayed globally in the website. SCSS syntax is allowed.', 'floral'),
		    'mode'     => 'scss',
		    'theme'    => 'monokai',
		    'desc'     => '',
		    'default'  => "",
			'options' => array('minLines' => 20, 'maxLines' => 60)
		),

		array(
			'id' => 'custom-js',
			'type' => 'ace_editor',
			'mode' => 'javascript',
			'theme' => 'monokai',
			'title' => esc_html__('Custom JS', 'floral'),
			'subtitle' => esc_html__('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'floral'),
			'desc' => '',
			'default' => '',
			'options' => array('minLines' => 20, 'maxLines' => 60)
		),
	),
);