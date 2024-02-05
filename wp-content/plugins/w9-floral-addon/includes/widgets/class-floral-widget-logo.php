<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-logo.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Widget_Logo extends Floral_Widget_Base {
    /**
     * Floral_Widget_Logo constructor.
     */
    public function __construct() {
        $args = array(
            'id'      => 'floral-widget-logo',
            'name'    => esc_html__( 'Floral Site Logo', 'w9-floral-addon' ),
            'options' => array(
                'classname'   => 'floral-widget-logo',
                'description' => esc_html__( 'Get and display site logo from theme option.', 'w9-floral-addon' )
            ),
            'fields'  => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'logo',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Logo Image', 'w9-floral-addon' ),
                    'options' => array(
                        'logo'          => __( 'Logo', 'w9-floral-addon' ),
                        'logo-option-1' => __( 'Logo Option 1', 'w9-floral-addon' ),
                        'logo-option-2' => __( 'Logo Option 2', 'w9-floral-addon' ),
                        'logo-option-3' => __( 'Logo Option 3', 'w9-floral-addon' ),
                    )
                ),
                array(
                    'id'      => 'logo_width',
                    'type'    => 'text',
                    'title'   => __( 'Logo Width (Fill number like 100, 200, 240 or auto)', 'w9-floral-addon' ),
                    'default' => '300'
                ),
                array(
                    'id'      => 'logo_height',
                    'type'    => 'text',
                    'title'   => __( 'Logo Height (Fill number like 100, 200, 240 or auto)', 'w9-floral-addon' ),
                    'default' => 'auto'
                ),
                array(
                    'id'      => 'logo_align',
                    'type'    => 'select',
                    'title'   => __( 'Logo Align', 'w9-floral-addon' ),
                    'options' => array(
                        '' => __( 'Inherit', 'w9-floral-addon' ),
                        'text-left'   => __( 'Left', 'w9-floral-addon' ),
                        'text-center' => __( 'Center', 'w9-floral-addon' ),
                        'text-right'  => __( 'Right', 'w9-floral-addon' ),
                    )
                ),
            )
        
        );
        parent::__construct( $args );
    }
    
    public function widget_content( $args, $instance ) {
        $logo = $logo_width = $logo_height = $logo_align = '';
        extract( $instance, EXTR_IF_EXISTS );
        $this->the_widget_title( $args, $instance );
        ob_start();
        ?>
        <div class="floral-logo-wrapper <?php esc_attr_e( $logo_align ); ?>">
            <?php echo Floral_Image::logo( $logo, $logo_width, $logo_height ); ?>
        </div>
        <?php
        echo ob_get_clean();
    }
}
