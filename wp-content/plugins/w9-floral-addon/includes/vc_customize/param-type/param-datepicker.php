<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-datepicker.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_add_shortcode_param( 'datepicker', 'floral_param_datepicker' );

function floral_param_datepicker( $settings, $value ) {
    // Get settings params
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';

    $class = array( $param_name, $type . '_field' );
    ob_start();
    $uni_id = uniqid( 'floral-datepicker-' )
    ?>
    <div class="floral-param-datepicker">
        <input type="text"
               id = "<?php echo esc_attr( $uni_id ); ?>"
               name="<?php echo esc_attr( $param_name ); ?>"
               class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>"
               value="<?php echo esc_attr( $value ); ?>">
    </div>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                var $datepicker = $('#ui-datepicker-div');
                $(<?php echo '\'#' . $uni_id . '\'' ?>).datetimepicker({
                    beforeShow: function() {
                        $datepicker.addClass('vc_datepicker');
                    },
                    onClose: function() {
                        $datepicker.css('display', 'none');
                        $datepicker.removeClass('vc_datepicker');
                    },
                    timeFormat: 'HH:mm:ss',
                    dateFormat: 'yy-mm-dd'
                });
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}