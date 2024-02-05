<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-logo-favicon.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * Favicon Section
*/

$this->sections[] = array(
	'title' => esc_html__('Logo & Favicon', 'floral'),
	'desc' => esc_html__('Configure the logo and favicon in a lot of plataforms. Generate and download your package at http://realfavicongenerator.net/ .', 'floral'),
	'icon' => 'el-icon-wrench',
	'fields' => array(
        
        
        array(
            'id' => 'random-general-number',
            'type' => 'info',
            'desc' => esc_html__('Logo', 'floral')
        ),
        
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Logo', 'floral' ),
            'subtitle' => esc_html__( 'Upload your logo here.', 'floral' ),
            'desc'     => '',
            'default' => array(
                'url' => floral_theme_url(). 'assets/images/floral-logo.png'
            )
        ),
        
        array(
            'id'       => 'logo-option-1',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Logo Option 1', 'floral' ),
            'subtitle' => esc_html__( 'Upload your logo here.', 'floral' ),
            'desc'     => '',
            'default' => array(
                'url' => floral_theme_url(). 'assets/images/floral-logo.png'
            )
        ),
        
        array(
            'id'       => 'logo-option-2',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Logo Option 2', 'floral' ),
            'subtitle' => esc_html__( 'Upload your logo here.', 'floral' ),
            'desc'     => '',
            'default' => array(
                'url' => floral_theme_url(). 'assets/images/floral-logo.png'
            )
        ),
        
        array(
            'id'       => 'logo-option-3',
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( 'Logo Option 3', 'floral' ),
            'subtitle' => esc_html__( 'Upload your logo here.', 'floral' ),
            'desc'     => '',
            'default' => array(
                'url' => floral_theme_url(). 'assets/images/floral-logo.png'
            )
        ),

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'title' => esc_html__('Favicons', 'floral'),
            'desc' => esc_html__('Generate and download your image package at http://realfavicongenerator.net/ .', 'floral')
		),

		array(
			'title' => esc_html__('Favicon 16x16', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (16x16).', 'floral'),
			'id' => 'favicon-16',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
			'default' => array(
				'url' => floral_theme_url(). 'assets/images/floral-favicon.png'
			)
		),

		array(
			'title' => esc_html__('Favicon 32x32', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (32x32).', 'floral'),
			'id' => 'favicon-32',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 96x96', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (96x96).', 'floral'),
			'id' => 'favicon-96',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 160x160', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (160x160).', 'floral'),
			'id' => 'favicon-160',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 192x192', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (192x192).', 'floral'),
			'id' => 'favicon-192',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'desc' => esc_html__('Apple Favicons', 'floral')
		),

		array(
			'title' => esc_html__('Favicon 57x57', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (57x57).', 'floral'),
			'id' => 'favicon-a-57',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 114x114', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (114x114).', 'floral'),
			'id' => 'favicon-a-114',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 72x72', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (72x72).', 'floral'),
			'id' => 'favicon-a-72',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 144x144', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (144x144).', 'floral'),
			'id' => 'favicon-a-144',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 60x60', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (60x60).', 'floral'),
			'id' => 'favicon-a-60',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 120x120', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (120x120).', 'floral'),
			'id' => 'favicon-a-120',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 76x76', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (76x76).', 'floral'),
			'id' => 'favicon-a-76',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 152x152', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (152x152).', 'floral'),
			'id' => 'favicon-a-152',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Favicon 180x180', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions (180x180).', 'floral'),
			'id' => 'favicon-a-180',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'id' => 'random-general-number',
			'type' => 'info',
			'desc' => esc_html__('Windows Metro', 'floral')
		),

		array(
		    'id'       => 'favicon-win-color',
		    'type'     => 'color',
		    'title'    => esc_html__('Custom tile background color', 'floral'),
		    'subtitle' => esc_html__('Pick a background color for the tile.', 'floral'),
		    'validate' => 'color',
		    'transparent' => false,
		    'description' => 'You can see a few recommended tile colors at "Favicon for Windows 8 - Tile" section at http://realfavicongenerator.net/',
		),

		array(
			'title' => esc_html__('Tile image 70x70', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 70x70. Recommended: 128x128.', 'floral'),
			'id' => 'favicon-win-70',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Tile image 150x150', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 150x150. Recommended: 270x270.', 'floral'),
			'id' => 'favicon-win-150',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Tile image 310x150', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 310x150. Recommended: 558x270.', 'floral'),
			'id' => 'favicon-win-310',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

		array(
			'title' => esc_html__('Tile image 310x310', 'floral'),
			'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 310x310. Recommended: 558x558.', 'floral'),
			'id' => 'favicon-win-310-quad',
			'type' => 'media',
			'readonly' => false,
			'url'=> true,
		),

	),
);