<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-multi-select.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_add_shortcode_param( 'multi-select', 'floral_param_type_multi_select' );

function floral_param_type_multi_select( $settings, $value ) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $options    = isset( $settings['options'] ) ? (array) $settings['options'] : array();
    
    $class = array( $param_name, $type . '_field' );
    
    ob_start();
    ?>
    <input type="hidden" class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>" id="<?php echo esc_attr( $param_name ); ?>" name="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
    <select multiple="multiple" class="widefat widget-select2"
            id="<?php echo esc_attr( $param_name ); ?>"
            data-value="<?php echo esc_attr( $value ) ?>">
        <?php foreach ( $options as $option_key => $option_value ) : ?>
            <option value="<?php echo esc_attr( $option_key ); ?>"><?php echo esc_html( $option_value ); ?></option>
        <?php endforeach; ?>
    </select>
    <input type="checkbox" class="widefat widget-select-all" id="<?php echo esc_attr( $param_name ); ?>_select_all">
    <label for="<?php echo esc_attr( $param_name ); ?>_select_all"><?php echo esc_html__( 'Select All', 'w9-floral-addon' ); ?></label>
    <script>
        (function($) {
            'use strict';
            
            $(document).ready(function() {
                if (typeof (floral_admin) !== 'undefined') {
                    floral_admin.widget_select2();
                }
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}