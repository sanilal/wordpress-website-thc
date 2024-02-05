<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-switcher.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//array(
//    'type'        => 'switcher',
//    'heading'     => esc_html__( 'Switcher', 'w9-floral-addon' ),
//    'param_name'  => 'heading_switcher',
//    'value'       => '',
//    'admin_label' => true,
//    'settings'    => array(
//        'text_on'  => 'Mở',
//        'text_off' => 'Tắt',
//        'value_on' => '1',
//        'value_off' => '0',
//    )
//)
vc_add_shortcode_param( 'switcher', 'floral_param_switcher' );

function floral_param_switcher( $settings, $value ) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $text_on    = isset( $settings['settings']['text_on'] ) ? $settings['settings']['text_on'] : __( 'On', 'w9-floral-addon' );
    $text_off   = isset( $settings['settings']['text_off'] ) ? $settings['settings']['text_off'] : __( 'Off', 'w9-floral-addon' );
    $value_on   = isset( $settings['settings']['value_on'] ) ? $settings['settings']['value_on'] : 1;
    $value_off  = isset( $settings['settings']['value_off'] ) ? $settings['settings']['value_off'] : 0;

    $value = empty( $value ) ? $value_off : $value_on;

    $class = array( 'radio', $param_name, $type );
    
    ob_start();
    $uni_id = uniqid( 'floral-switcher-' );
    ?>
    <div class="floral-param-buttonset <?php echo esc_attr( $uni_id ); ?>">
        <input type="radio" id="<?php echo esc_attr( $uni_id . '-1' ); ?>" name="<?php echo esc_attr( $param_name . '_radio' ); ?>" value="<?php echo esc_attr( $value_on ); ?>" <?php checked( $value, $value_on ); ?>><label for="<?php echo esc_attr( $uni_id . '-1' ); ?>"><?php echo esc_html( $text_on ); ?></label>
        <input type="radio" id="<?php echo esc_attr( $uni_id . '-2' ); ?>" name="<?php echo esc_attr( $param_name . '_radio' ); ?>" value="<?php echo esc_attr( $value_off ); ?>" <?php checked( $value, $value_off ); ?>><label for="<?php echo esc_attr( $uni_id . '-2' ); ?>"><?php echo esc_html( $text_off ); ?></label>
        
        <input type="hidden" class="wpb_vc_param_value <?php floral_the_clean_html_classes( $class ); ?>" id="<?php echo esc_attr( $param_name ); ?>" name="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
    </div>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                if (typeof floral_admin !== 'undefined') {
                    floral_admin.do_switcher($(<?php echo '\'.' . $uni_id . '\'' ?>));
                }
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}