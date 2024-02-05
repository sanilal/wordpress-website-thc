<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-slider.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//array(
//    'type'       => 'slider',
//    'heading'    => esc_html__( 'Slider', 'w9-floral-addon' ),
//    'param_name' => 'heading_slider_1',
//    'unit'       => 'px',
//    'min'        => '-100',
//    'max'        => '100',
//    'step'       => '5',
//    'std'        => '50px'
//)

vc_add_shortcode_param( 'slider', 'floral_param_slider' );

function floral_param_slider( $settings, $value ) {
    $param_name          = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type                = isset( $settings['type'] ) ? $settings['type'] : '';
    $data_slider         = array();
    $data_slider['unit'] = isset( $settings['unit'] ) ? $settings['unit'] : '';
    
    $min = floatval( $settings['min'] );
    $max = floatval( $settings['max'] );
    $step = floatval( $settings['step'] );
    
    $data_slider['min']  = ( isset( $settings['min'] ) && !empty( $min ) ) ? $min : 0;
    $data_slider['max']  = ( isset( $settings['max'] ) && !empty( $max ) ) ? $max : 1;
    $data_slider['step'] = ( isset( $settings['step'] ) && !empty( $step ) ) ? $step : 0.1;

    $std   = isset( $settings['std'] ) ? $settings['std'] : 0;
    $value = ($value != '') ? $value : $std;
    
    
    $class = array( $param_name, $type );
    ob_start();
    $uni_id = uniqid( 'floral-slider-' );
    ?>
    <div class="floral-param-slider <?php echo esc_attr( $uni_id ); ?>" data-slider="<?php echo esc_attr( json_encode( $data_slider ) ); ?>">
        <div class="slider-object"></div>
        <input type="text" readonly="readonly" class="slider-value wpb_vc_param_value <?php floral_the_clean_html_classes( $class ); ?>" id="<?php echo esc_attr( $param_name ); ?>" name="<?php echo esc_attr( $param_name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
    </div>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                if (typeof floral_admin !== 'undefined') {
                    floral_admin.do_slider($(<?php echo '\'.' . $uni_id . '\'' ?>));
                }
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

