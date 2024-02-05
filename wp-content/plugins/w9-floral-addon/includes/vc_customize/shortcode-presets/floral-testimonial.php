<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-testimonial.php
 * @time    : 9/15/16 10:35 AM
 * @author  : 9WPThemes Team
 */

if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$presets_settings['floral_shortcode_testimonial'] = array(
    array(
        'name'     => __( 'Common Section Title', 'w9-floral-addon' ),
//            'default'  => true,
        'settings' => array (
            'testimonial_source' => 'review-manual',
            'testimonial_values' => '%5B%7B%22testimonial_content%22%3A%22I%20had%20a%20few%20questions%20but%20they%20got%20back%20to%20me%20promptly%20with%20the%20answers.%20I%20love%20the%20clean%20design%20and%20intelligent%20user%20interface.%20So%20far%20bug%20free%20and%20working%20great.%22%2C%22testimonial_rate%22%3A%225%22%2C%22testimonial_author_name%22%3A%22Misskuma%22%2C%22testimonial_author_job%22%3A%22Themeforest%20Author%22%2C%22testimonial_author_url%22%3A%22url%3A%2523%7C%7C%7C%22%2C%22testimonial_author_avatar%22%3A%22628%22%7D%2C%7B%22testimonial_content%22%3A%22Of%20course%2C%20the%20theme%20is%20amazing!%20But%20what%20really%20impressed%20me%20was%20the%20excellent%20customer%20support.%20This%20is%20a%20class%20act%20all%20the%20way.%20Thank%20you!%22%2C%22testimonial_rate%22%3A%225%22%2C%22testimonial_author_name%22%3A%22Jerremy%22%2C%22testimonial_author_job%22%3A%22Themeforest%20Author%22%2C%22testimonial_author_url%22%3A%22url%3A%2523%7C%7C%7C%22%2C%22testimonial_author_avatar%22%3A%22627%22%7D%2C%7B%22testimonial_content%22%3A%22Great%20theme%2C%20really%20customizable%20and%20with%20a%20lot%20of%20functions.%20Also%20the%20customer%20service%20is%20excellent.%20Just%20an%20amazing%20template%20to%20look%20at%20and%20use.%20Thanks!%22%2C%22testimonial_rate%22%3A%225%22%2C%22testimonial_author_name%22%3A%22Doppiaddi%22%2C%22testimonial_author_job%22%3A%22Themeforest%20Author%22%2C%22testimonial_author_url%22%3A%22url%3A%2523%7C%7C%7C%22%2C%22testimonial_author_avatar%22%3A%22629%22%7D%2C%7B%22testimonial_content%22%3A%22Of%20course%2C%20the%20theme%20is%20amazing!%20But%20what%20really%20impressed%20me%20was%20the%20excellent%20customer%20support.%20This%20is%20a%20class%20act%20all%20the%20way.%20Thank%20you!%22%2C%22testimonial_rate%22%3A%225%22%2C%22testimonial_author_name%22%3A%22Jerremy%22%2C%22testimonial_author_job%22%3A%22Themeforest%20Author%22%2C%22testimonial_author_url%22%3A%22url%3A%2523%7C%7C%7C%22%2C%22testimonial_author_avatar%22%3A%22630%22%7D%5D',
            'testimonial_category' => '',
            'testimonial_items' => '',
            'testimonial_style' => 'style-modern',
            'testimonial_border_box_shadow' => '',
            'testimonial_show_author_avatar' => 'yes',
            'testimonial_show_author_rating' => '',
            'testimonial_color_scheme' => 'color-dark',
            'testimonial_layout' => 'layout-slider',
            'testimonial_columns' => '1',
            'testimonial_spacing' => '5',
            'el_class' => '',
            'sc_loop' => '1',
            'sc_center' => '1',
            'sc_nav' => '0',
            'sc_dots' => '1',
            'sc_nav_pag_style' => 'owl-control-shortcodes',
            'sc_nav_pag_scheme_color' => 'owl-color-primary',
            'sc_autoplay' => '1',
            'sc_autoplaytimeout' => '5000',
            'sc_autoplayhoverpause' => '1',
            'sc_mouse_wheel' => '0',
            'animation_in' => '',
            'animation_out' => 'fadeOut',
            'sc_auto_width' => '0',
            'sc_auto_height' => '0',
            'sc_start_position' => '1',
            'sc_margin_right' => '',
            'sc_pag_margin_top' => '60',
            'sc_items' => '3',
            'sc_items_desktop' => 'inherit',
            'sc_items_desktop_small' => '2',
            'sc_items_tablet' => 'inherit',
            'sc_items_tablet_small' => '1',
            'sc_items_mobile' => 'inherit',
            'css' => '',
            'animation_css' => '',
            'animation_duration' => '',
            'animation_delay' => '',
        ),
    ),
);
