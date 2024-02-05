<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-buttonset.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//array(
//    'type'        => 'buttonset',
//    'heading'     => esc_html__( 'Button Set', 'w9-floral-addon' ),
//    'param_name'  => 'buttonset_param',
//    'value'       => '',
//    'admin_label' => true,
//    'options'     => array(
//        'on'  => 'Hello On',
//        'off' => 'Hello Off'
//    ),
//    'multiple'    => true
//)


vc_add_shortcode_param( 'buttonset', 'floral_param_buttonset' );

function floral_param_buttonset( $settings, $value ) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $value      = empty( $value ) ? array() : explode( '||', $value );
    $options    = isset( $settings['options'] ) ? (array) $settings['options'] : array();
    $multi      = empty( $settings['multiple'] ) ? 'false' : 'true';
    
    
    $class = array( 'wpb_vc_param_value', $param_name, $type . '_field' );
    if ( $multi == 'true' ) {
        $class[] = 'checkbox';
    } else {
        $class[] = 'radio';
    }
    
    $value = array_unique( $value );
    foreach ( $value as $key => $item ) {
        if ( !array_key_exists( $item, $options ) ) {
            unset( $value[$key] );
        }
    }
    
    ob_start();
    $uni_id = uniqid( 'floral-buttonset-' );
    ?>
    <div id="<?php echo esc_attr( $uni_id ); ?>" class="floral-param-buttonset" data-multiple="<?php echo esc_attr( $multi ); ?>">
        <?php foreach ( $options as $option_key => $option_value ): ?>
            <?php if ( $multi == 'true' ): ?>
                <input type="checkbox" id="<?php echo esc_attr( $uni_id . $option_key ); ?>"
                       name="<?php echo esc_attr( $param_name . '_checkbox' ); ?>"
                       value="<?php echo esc_attr( $option_key ); ?>" <?php echo ( in_array( $option_key, $value ) ) ? 'checked="checked"' : ''; ?>>
                <label for="<?php echo esc_attr( $uni_id . $option_key ); ?>"><?php echo esc_html( $option_value ); ?></label>
            <?php else: ?>
                <input type="radio" id="<?php echo esc_attr( $uni_id . $option_key ); ?>"
                       name="<?php echo esc_attr( $param_name . '_radio' ); ?>"
                       value="<?php echo esc_attr( $option_key ); ?>" <?php echo ( in_array( $option_key, $value ) ) ? 'checked="checked"' : ''; ?>>
                <label for="<?php echo esc_attr( $uni_id . $option_key ); ?>"><?php echo esc_html( $option_value ); ?></label>
            <?php endif; ?>
        <?php endforeach; ?>
        
        <input type="hidden" class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>" id="<?php echo esc_attr( $param_name ); ?>" name="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( implode( '||', $value ) ); ?>" />
    </div>
    <script>
        (function ($) {
            'use strict';

            $(document).ready(function () {
                if (typeof floral_admin !== 'undefined') {
                    floral_admin.do_buttonset($(<?php echo '\'#' . $uni_id . '\'' ?>));
                }
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}