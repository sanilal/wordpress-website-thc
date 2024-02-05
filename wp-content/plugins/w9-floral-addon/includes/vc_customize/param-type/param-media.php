<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-media.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_add_shortcode_param( 'media', 'floral_param_media' );

function floral_param_media( $settings, $value ) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = array( $param_name, $type . '_field' );
    ob_start();

    $uni_id = uniqid( 'floral-image-selector-' );
    ?>
    <p class="floral-file-selector floral-image-selector <?php echo esc_attr( $uni_id ); ?>" style="margin: 0;">
        <input type="text"
               id="<?php echo esc_attr( $param_name ); ?>"
               name="<?php echo esc_attr( $param_name ); ?>"
               class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>"
               value="<?php echo esc_attr( $value ); ?>" readonly="readonly">
        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to browse media', 'w9-floral-addon' ) ?>"
                class="browse-files browse-images button-primary selector-btn" type="button"><?php echo esc_html__( 'Browse', 'w9-floral-addon' ) ?></button>
        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to remove media', 'w9-floral-addon' ) ?>"
                class="browse-files browse-images button-secondary remove-btn" type="button"><?php echo esc_html__( 'Remove', 'w9-floral-addon' ) ?></button>
        <br />
        <?php if ( !empty( $value ) ): ?>
            <img class="widget-image-selected" src="<?php echo esc_attr( $value ); ?>" alt="" />
        <?php endif; ?>
    </p>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                if (typeof floral_admin !== 'undefined') {
                    floral_admin.file_selector($(<?php echo '\'.' . $uni_id . '\'' ?>));
                }
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}

vc_add_shortcode_param( 'getfile', 'floral_file_selector' );

function floral_file_selector( $settings, $value ) {
    $param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
    $type       = isset( $settings['type'] ) ? $settings['type'] : '';
    $class      = array( $param_name, $type . '_field' );
    ob_start();
    
    $uni_id = uniqid( 'floral-file-selector-' );
    ?>
    <p class="floral-file-selector <?php echo esc_attr( $uni_id ); ?>" style="margin: 0;">
        <input type="text"
               id="<?php echo esc_attr( $param_name ); ?>"
               name="<?php echo esc_attr( $param_name ); ?>"
               class="wpb_vc_param_value wpb-textinput <?php floral_the_clean_html_classes( $class ); ?>"
               value="<?php echo esc_attr( $value ); ?>" readonly="readonly">
        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to browse media', 'w9-floral-addon' ) ?>"
                class="browse-files button-primary selector-btn" type="button"><?php echo esc_html__( 'Browse', 'w9-floral-addon' ) ?></button>
        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to remove media', 'w9-floral-addon' ) ?>"
                class="browse-files button-secondary remove-btn" type="button"><?php echo esc_html__( 'Remove', 'w9-floral-addon' ) ?></button>
    </p>
    <script>
        (function ($) {
            'use strict';
            $(document).ready(function () {
                if (typeof floral_admin !== 'undefined') {
                    floral_admin.file_selector($(<?php echo '\'.' . $uni_id . '\'' ?>));
                }
            });
        })(jQuery);
    </script>
    <?php
    return ob_get_clean();
}