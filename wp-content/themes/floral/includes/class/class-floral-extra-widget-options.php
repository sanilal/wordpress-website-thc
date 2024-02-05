<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-extra-widget-options.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Extra_Widget_Options extends Floral_Base {
    /**
     * Floral_Extra_Widget_Classes constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    public function add_filters() {
        add_filter( 'widget_update_callback', array( $this, 'update_extra_classes' ), 10, 4 );
        add_filter( 'dynamic_sidebar_params', array( $this, 'add_extra_widget_classes' ) );
    }

    public function add_actions() {
        add_action( 'in_widget_form', array( $this, 'append_extra_widget_classes_field' ), 10, 3 );
    }

    /**
     * Append the extra class field.
     *
     * @param $widget
     * @param $return
     * @param $instance
     */
    function append_extra_widget_classes_field( $widget, $return, $instance ) {
        if ( !isset( $instance['floral_extra_widget_classes'] ) ) {
            $instance['floral_extra_widget_classes'] = '';
        }
//        if ( !isset( $instance['floral_remove_title_bb'] ) ) {
//            $instance['floral_remove_title_bb'] = '0';
//        }

        if ( !isset( $instance['floral_remove_default_mb'] ) ) {
            $instance['floral_remove_default_mb'] = '0';
        }
        // Do Not Add It To Monster Widget
        if ( strpos( $widget->id_base, 'monster' ) !== false ) {
            return;
        }
	    
	    echo sprintf( '
        <hr style="margin-top: 20px"/>
        <p>
            <label for="widget-%1$s-%2$s-floral_extra_widget_classes">' . esc_html__( 'Extra Widget Classes', 'floral' ) . '</label>
            <input type="text" class="widefat" id="widget-%1$s-%2$s-floral_extra_widget_classes" name="widget-%1$s[%2$s][floral_extra_widget_classes]" value="%3$s"/>
        </p>
        <p>
            <input type="checkbox" class="checkbox" id="widget-%1$s-%2$s-floral_remove_default_mb" name="widget-%1$s[%2$s][floral_remove_default_mb]" value="1" %4$s/>
            <label for="widget-%1$s-%2$s-floral_remove_default_mb">' . esc_html__( 'Remove Default Margin Bottom', 'floral' ) . ' <i>(' . esc_html__( 'Each widget has its own margin bottom property, this option will remove them!', 'floral' ) . ')</i></label>
        </p>
        ', $widget->id_base, $widget->number, $instance['floral_extra_widget_classes'], checked( $instance['floral_remove_default_mb'], 1, false ) );
    }

    /**
     * Fired on widget update
     *
     * @param $instance
     * @param $new_instance
     * @param $old_instance
     * @param $widget
     *
     * @return mixed
     */
    function update_extra_classes( $instance, $new_instance, $old_instance, $widget ) {
        $instance['floral_extra_widget_classes'] = isset( $new_instance['floral_extra_widget_classes'] ) ? $new_instance['floral_extra_widget_classes'] : '';
//        $instance['floral_remove_title_bb']      = isset( $new_instance['floral_remove_title_bb'] ) ? $new_instance['floral_remove_title_bb'] : '0';
        $instance['floral_remove_default_mb']    = isset( $new_instance['floral_remove_default_mb'] ) ? $new_instance['floral_remove_default_mb'] : '0';

        return $instance;
    }


    /**
     * Add extra classes to the front-end
     *
     * @param $params
     *
     * @return mixed
     */
    function add_extra_widget_classes( $params ) {
        global $wp_registered_widgets;

        $widget_id  = $params[0]['widget_id'];
        $widget_obj = $wp_registered_widgets[$widget_id];
        $widget_opt = get_option( $widget_obj['callback'][0]->option_name );
        $widget_num = $widget_obj['params'][0]['number'];

//        if ( isset( $widget_opt[$widget_num]['floral_remove_title_bb'] ) && !empty( $widget_opt[$widget_num]['floral_remove_title_bb'] ) ) {
//            $widget_opt[$widget_num]['floral_extra_widget_classes'] .= ' remove-title-bb';
//        }

        if ( isset( $widget_opt[$widget_num]['floral_remove_default_mb'] ) && !empty( $widget_opt[$widget_num]['floral_remove_default_mb'] ) ) {
            $widget_opt[$widget_num]['floral_extra_widget_classes'] .= ' mb-0-i';
        }

        if ( isset( $widget_opt[$widget_num]['floral_extra_widget_classes'] ) && !empty( $widget_opt[$widget_num]['floral_extra_widget_classes'] ) ) {
            $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$widget_opt[$widget_num]['floral_extra_widget_classes']} ", $params[0]['before_widget'], 1 );
        }

        return $params;
    }
}