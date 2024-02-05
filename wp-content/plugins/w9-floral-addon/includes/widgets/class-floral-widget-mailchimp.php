<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-mailchimp.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !floral_is_plugin_active( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
    return;
}


class Floral_Widget_MailChimp extends Floral_Widget_Base {
    private $default_instance_settings = array(
        'form_id' => ''
    );
    
    /**
     * Floral_Widget_MailChimp constructor.
     */
    public function __construct() {
       
        $args = array(
            'id'      => 'floral-widget-mailchimp',
            'name'    => esc_html__( 'Floral MailChimp', 'w9-floral-addon' ),
            'options' => array(
                'classname'   => 'floral-widget-mailchimp',
                'description' => esc_html__( 'Like "MailChimp Sign-Up Form", but it has more extended options.', 'w9-floral-addon' )
            ),
            'fields'  => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'    => 'bg_img',
                    'type'  => 'image-selector',
                    'title' => esc_html__( 'Background Image', 'w9-floral-addon' ),
                ),
                array(
                    'id'      => 'overlay',
                    'type'    => 'select',
                    'title'   => esc_html__( 'Overlay', 'w9-floral-addon' ),
                    'options' => array(
                        'none'          => esc_html__( 'None', 'w9-floral-addon' ),
                        'overlay_dark'  => esc_html__( 'Dark', 'w9-floral-addon' ),
                        'overlay_light' => esc_html__( 'Light', 'w9-floral-addon' ),
                    ),
                    'default' => 'none'
                ),
    
                array(
                    'id'      => 'overlay_opacity',
                    'type'    => 'number-slider',
                    'title'   => __( 'Overlay Opacity', 'w9-floral-addon' ),
                    'min'     => '0',
                    'max'     => '1',
                    'step'    => '0.1',
                    'default' => '0.5',
                    'dependency' => array(
                        'element'  => 'overlay',
                        'not_equal_to' => 'none'
                    ),
                ),
            )
        
        );
        parent::__construct( $args );
    }
    
    public function form( $instance ) {
        parent::form( $instance );
        ?>
        <p class="help">
            <?php printf( __( 'You can edit your sign-up form in the <a href="%s">MailChimp for WordPress form settings</a>.', 'mailchimp-for-wp' ), admin_url( 'admin.php?page=mailchimp-for-wp-forms' ) ); ?>
        </p>
        <?php
    }
    
    public function widget_content( $args, $instance ) {
        $bg_img = $overlay = $overlay_opacity = '';
        extract( $instance, EXTR_IF_EXISTS );
        $instance = array_merge( $this->default_instance_settings, $instance );
        $widget_inner_wrapper_class = array();

        $widget_inner_wrapper_style = array();
        $overlay_style = array();
        
        if ( !empty( $bg_img ) ) {
            $widget_inner_wrapper_class[] = 'widget-bgi_on';
            $widget_inner_wrapper_style[]   = 'background-image:url(' . esc_url( $bg_img ) . ')';
        }
        
        if ( !empty( $overlay ) && ($overlay !== 'none') ) {
            $widget_inner_wrapper_class[] = 'widget-overlay_on' . ' ' . $overlay;
            $overlay_style[] = 'opacity: ' . $overlay_opacity;
        }

        ob_start();
        ?>
        <div class="widget-inner-wrapper <?php floral_the_clean_html_classes( $widget_inner_wrapper_class ); ?>" <?php echo $this->get_inline_style( $widget_inner_wrapper_style ); ?>>
            <?php if ( !empty( $overlay ) && ($overlay !== 'none') ): ?>
                <div class="__overlay" <?php echo $this->get_inline_style( $overlay_style ); ?>></div>
            <?php endif; ?>
            <div class="widget-inner">
                <?php
                $this->the_widget_title( $args, $instance );
                mc4wp_show_form( $instance['form_id'] );
                ?>
            </div>
        </div>
        <?php
        echo ob_get_clean();
    }
}