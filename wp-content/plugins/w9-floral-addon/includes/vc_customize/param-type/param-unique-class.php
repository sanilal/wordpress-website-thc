<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-unique-class.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//
//array(
//    'type'        => 'unique_class',
//    'param_name'  => 'unique_class',
//    'value'       => '',
//)
//Note: This param need save in first time open window

vc_add_shortcode_param( 'unique_class', 'floral_param_unique_class' );

function floral_param_unique_class( $settings, $value ) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $default    = isset( $settings['std'] ) ? $settings['std'] : '';
    if ( empty( $value ) ) {
        $value = $default;
    }
    $type        = isset( $settings['type'] ) ? $settings['type'] : '';
    $js_selector = '.' . $param_name . '.' . $type . '_field' . '[value=\'' . $value . '\']';
    
    return '<div class="my_param_block">'
    . '<input name="' . $param_name
    . '" class="wpb_vc_param_value wpb-textinput '
    . $param_name . ' ' . $type . '_field" type="text" value="'
    . $value . '" />'
    . '</div>'
    . '<script>(function($){$("' . $js_selector . '").each(function(index){
            var unique_class = "w9-custom-" + time() + (index) + Math.floor(Math.random() * 1000);
            $(this).attr("value" , unique_class );
        })})(jQuery);</script>';
}
