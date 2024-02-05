<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_countdown.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Countdown
 * @var $atts
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$cd_type = $cd_style = $time_type = $show_time_remaining = $progress_bar_title = $time_start = $time_finish = $standard_bgc = $standard_custom_bgc = $standard_tx_color = $standard_separator_color = $standard_border_color = $standard_outline_color =
$progressbar_bar_color = $progressbar_bar_current_value_color = $progressbar_bar_total_value_color = $progressbar_tx_color = $el_class = $css = $tablet_css = $mobile_css = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

Floral_VC_Customize::add_responsive_shortcode_css( $tablet_css, $mobile_css );

if ( $cd_type === 'standard' ) {
    if ( !$this->validateDate( $time_finish ) ) {
        echo __( 'Wrong time input!', 'w9-floral-addon' );
        
        return;
    }
} elseif ( $cd_type === 'progressbar' ) {
    if ( !$this->validateDate( $time_start ) || !$this->validateDate( $time_finish ) ) {
        echo __( 'Wrong time input!', 'w9-floral-addon' );
        
        return;
    }
}

$class_countdown = array(
    $el_class,
    vc_shortcode_custom_css_class( $css ),
    vc_shortcode_custom_css_class( $tablet_css ),
    vc_shortcode_custom_css_class( $mobile_css ),
);
wp_enqueue_script( FLORAL_SCRIPT_PREFIX . 'jquery-countdown', Floral_Addon::plugin_url() . 'assets/vendor/jquery.countdown/jquery.countdown.min.js', false, true );
if ( $cd_type === 'standard' ) {
    $unique_id = 'opening-hours-' . uniqid();
    
    if ( $standard_bgc !== 'custom' ) {
        $class_countdown[] = 'canvas-bgc-' . $standard_bgc;
    }
    $class_countdown[] = 'canvas-tx-color-' . $standard_tx_color;
    $class_countdown[] = 'canvas-separator-color-' . $standard_separator_color;
    $class_countdown[] = 'canvas-border-color-' . $standard_border_color;
    $class_countdown[] = 'canvas-outline-color-' . $standard_outline_color;
    
    $internal_style = array();
    if ( ( $standard_bgc === 'custom' ) && ( $standard_custom_bgc !== '' ) ) {
        $internal_style["#$unique_id .style-rectangle .canvas, #$unique_id .style-circle .times"] = 'background-color: ' . $standard_custom_bgc;
    }
    
    if ( !empty( $internal_style ) ) {
        Floral_VC_Customize::add_custom_shortcode_css( $internal_style );
    }
    
    ?>
    <div class="countdown type-standard <?php floral_the_clean_html_classes( $class_countdown ); ?>">
        <div id="<?php echo esc_attr( $unique_id ) ?>" class="opening-hours">
			<?php include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-countdown/' . $cd_style . '.php' ); ?>
        </div>
    </div>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            var elm = '#<?php echo esc_attr( $unique_id )?>';
            var end_time = '<?php echo esc_html( $time_finish ); ?>';
            $(document).ready(function () {
                $(elm).countdown(end_time, function (event) {
                    setTimeout(function () {
                        $(elm).css('opacity', '1');
                    }, 500);
                    
                }).on('update.countdown', function (event) {
                    $('.second', elm).html(event.strftime('%S'));
                    $('.minutes', elm).html(event.strftime('%M'));
                    $('.hours', elm).html(event.strftime('%H'));
                    <?php if($time_type === 'm-d-h-m-s') { ?>
                    $('.days', elm).html(event.strftime('%n'));
                    $('.months', elm).html(event.strftime('%m'));
	                <?php } elseif($time_type === 'd-h-m-s') { ?>
                    $('.days', elm).html(event.strftime('%D'));
                    <?php } ?>
                    
                }).on('finish.countdown', function (event) {
                    $('.second', elm).html('00');
                });
            });
        })(jQuery);
    </script>
    <?php
} else {
    if ( $cd_type === 'progressbar' ) {
        $unique_id = 'progress-' . uniqid();
        if ( $progressbar_bar_color !== 'custom' ) {
            $class_countdown[] = 'bar-color-' . $progressbar_bar_color;
        }
        
        $class_countdown[] = 'bar-tx-color-' . $progressbar_tx_color;
        
        $internal_style = array();
        if ( $progressbar_bar_color === 'custom' ) {
            if ( $progressbar_bar_current_value_color !== '' ) {
                $internal_style["#$unique_id .__body .__current-progress"] = 'background-color: ' . $progressbar_bar_current_value_color;
            }
            
            if ( $progressbar_bar_total_value_color !== '' ) {
                $internal_style["#$unique_id .__body .__bar"] = 'background-color: ' . $progressbar_bar_total_value_color;
            }
        }
        
        if ( !empty( $internal_style ) ) {
            Floral_VC_Customize::add_custom_shortcode_css( $internal_style );
        }
        ?>
        <div class="countdown type-progress-bar <?php floral_the_clean_html_classes( $class_countdown ); ?>">
            <div id="<?php echo esc_attr( $unique_id ) ?>" class="progress">
                <div class="__header">
                    <div class="__title"><?php echo esc_html( $progress_bar_title ) ?></div>
                    <div class="__percent">0%</div>
                </div>
                <div class="__body">
                    <div class="__bar">
                        <div class="__current-progress"></div>
                    </div>
                    <div class="__time-remaining"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            (function ($) {
                "use strict";
                var elm = '#<?php echo esc_attr( $unique_id )?>',
                    start_time = '<?php echo esc_html( $time_start ); ?>',
                    end_time = '<?php echo esc_html( $time_finish ); ?>';
                $(document).ready(function () {
                    var start = new Date(start_time),
                        finish = new Date(end_time),
                        current = new Date(),
                        progress = finish - start;
                    if ((progress > 0) && (current < finish)) {
                        $(elm).countdown(end_time).on('update.countdown', function (event) {
                                var now = new Date(),
                                    time_elapped = now - start,
                                    percent = ( time_elapped > 0 ) ? time_elapped / progress * 100 : 0;
                                $('.__percent', elm).html(percent.toFixed(1) + '%');
                                $('.__current-progress', elm).css('width', percent + '%');
                                <?php if ( $show_time_remaining === 'yes' ) : ?>
                                $('.__time-remaining', elm).html(event.strftime('%-m month%!m %-n day%!n %H:%M:%S'));
                                <?php endif ?>
                            })
                            .on('finish.countdown', function (event) {
                                $('.__percent', elm).html('100%');
                                $('.__current-progress', elm).css('width', '100%');
                                <?php if ( $show_time_remaining === 'yes' ) : ?>
                                $('.__time-remaining', elm).empty();
                                <?php endif ?>
                            });
                    }
                });
            })(jQuery);
        </script>
        <?php
    }
}