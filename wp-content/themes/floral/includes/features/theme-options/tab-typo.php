<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-typo.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$this->sections[] = array(
    'title'  => esc_html__( 'Typography', 'floral' ),
    'desc'   => esc_html__( 'Typography settings.', 'floral' ),
    'icon'   => 'el el-font',
    'fields' => array(
        array(
            'id'          => 'primary-font',
            'type'        => 'typography',
            'title'       => esc_html__( 'Primary font', 'floral' ),
            'subtitle'    => esc_html__( 'Specify the primary font properties.', 'floral' ),
            'google'      => true,
            'fonts'       => floral_get_preset_fonts(),
            'line-height' => false,
            'all_styles'  => true, // Enable all Google Font style/weight variations to be added to the page
            'color'       => false,
            'text-align'  => false,
            'font-style'  => false,
            'subsets'     => true,
            'font-size'   => false,
            'font-weight' => false,
            'units'       => 'px', // Defaults to px
            'default'     => array(
                'font-family' => 'Poppins',
            ),
            'compiler' => true
        ),

        array(
            'id'          => 'secondary-font',
            'type'        => 'typography',
            'title'       => esc_html__( 'Secondary font', 'floral' ),
            'subtitle'    => esc_html__( 'Specify the secondary font properties.', 'floral' ),
            'google'      => true,
            'fonts'       => floral_get_preset_fonts(),
            'line-height' => false,
            'all_styles'  => true, // Enable all Google Font style/weight variations to be added to the page
            'color'       => false,
            'text-align'  => false,
            'font-style'  => false,
            'subsets'     => true,
            'font-size'   => false,
            'font-weight' => false,
            'units'       => 'px', // Defaults to px
            'default'     => array(
                'font-family' => 'Playfair Display',
            ),
            'compiler' => true
        ),
	
	    array(
		    'id'          => 'third-font',
		    'type'        => 'typography',
		    'title'       => esc_html__( 'Third font', 'floral' ),
		    'subtitle'    => esc_html__( 'Specify the third font properties.', 'floral' ),
		    'google'      => true,
		    'fonts'       => floral_get_preset_fonts(),
		    'line-height' => false,
		    'all_styles'  => true, // Enable all Google Font style/weight variations to be added to the page
		    'color'       => false,
		    'text-align'  => false,
		    'font-style'  => false,
		    'subsets'     => true,
		    'font-size'   => false,
		    'font-weight' => false,
		    'units'       => 'px', // Defaults to px
		    'default'     => array(
			    'font-family' => 'blacksword, sans-serif',
		    ),
		    'compiler' => true
	    ),
        
        array(
            'id'             => 'body-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'Body font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the body font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'text-align'     => false,
            'color'          => false,
            'letter-spacing' => false,
            'line-height'    => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'body', '.default-fz' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '14px',
	            'font-family' => 'Poppins',
	            'font-weight' => '400',
                'google'      => true
            ),
        ),
        
        array(
            'id'             => 'h1-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'H1 font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the H1 font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'text-align'     => false,
            'line-height'    => false,
            'color'          => false,
            'letter-spacing' => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'h1' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '48px',
	            'font-family' => 'Poppins',
	            'font-weight' => '600',
            ),
        ),
        
        array(
            'id'             => 'h2-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'H2 font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the H2 font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'line-height'    => false,
            'text-align'     => false,
            'color'          => false,
            'letter-spacing' => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '36px',
	            'font-family' => 'Poppins',
	            'font-weight' => '600',
            ),
        ),
        
        array(
            'id'             => 'h3-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'H3 font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the H3 font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'text-align'     => false,
            'line-height'    => false,
            'color'          => false,
            'letter-spacing' => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'h3' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '28px',
	            'font-family' => 'Poppins',
	            'font-weight' => '600',
            ),
        ),
        
        array(
            'id'             => 'h4-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'H4 font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the H4 font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'text-align'     => false,
            'line-height'    => false,
            'color'          => false,
            'letter-spacing' => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '24px',
	            'font-family' => 'Poppins',
	            'font-weight' => '600',
            ),
        ),

        array(
            'id'             => 'h5-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'H5 font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the H5 font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'line-height'    => false,
            'text-align'     => false,
            'color'          => false,
            'letter-spacing' => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'h5' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '18px',
	            'font-family' => 'Poppins',
	            'font-weight' => '600',
            ),
        ),
        
        array(
            'id'             => 'h6-font',
            'type'           => 'typography',
            'title'          => esc_html__( 'H6 font', 'floral' ),
            'subtitle'       => esc_html__( 'Specify the H6 font properties.', 'floral' ),
            'google'         => true,
            'fonts'          => floral_get_preset_fonts(),
            'line-height'    => false,
            'text-align'     => false,
            'color'          => false,
            'letter-spacing' => false,
            'all_styles'     => true, // Enable all Google Font style/weight variations to be added to the page
            'output'         => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
            'units'          => 'px', // Defaults to px
            'default'        => array(
	            'font-size'   => '14px',
	            'font-family' => 'Poppins',
	            'font-weight' => '600',
            ),
        ),
    )
);