<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-number.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_add_shortcode_param( 'number', 'floral_param_type_number' );

function floral_param_type_number( $settings, $value ) {
    // Get settings params
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $min        = isset( $settings['min'] ) ? $settings['min'] : '';
    $max        = isset( $settings['max'] ) ? $settings['max'] : '';
    $suffix     = isset( $settings['suffix'] ) ? $settings['suffix'] : '';
    
    $class = array( $param_name, $type . '_field' );
    ob_start();
    ?>
    <input type="number"
           name="<?php echo esc_attr( $param_name ); ?>"
           min="<?php echo esc_attr( $min ); ?>"
           max="<?php echo esc_attr( $max ); ?>"
           class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>"
           value="<?php echo esc_attr( $value ); ?>"
           style="max-width: 100%; line-height: initial; height: auto;"><?php echo wp_kses_post( $suffix ); ?>
    <?php
    return ob_get_clean();
}