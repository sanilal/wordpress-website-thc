<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-colors.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
$most_used_field = array();

if ( floral_get_current_preset() == FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
    $preset_list     = floral_get_preset_list();
    $most_used_field = array(
        array(
            'id'    => mt_rand(),
            'type'  => 'info',
            'title' => esc_html__( 'Define Most Used Colors', 'floral' )
        ),
        array(
            'id'         => 'most-used-color',
            'type'       => 'multi_color',
            'title'      => esc_html__( 'Most used color', 'floral' ),
            'subtitle'   => '<strong>' . sprintf( esc_html__( 'Notice 1: This option is only displayed and managed by this preset: %s', 'floral' ), $preset_list[FLORAL_THEME_OPTIONS_DEFAULT_NAME] ) . '</strong><br/><br/><strong>' . esc_html__( 'Notice 2: After doing add some colors in this option, it only works for the this preset, and other presets haven\'t updated it. Please switch back to other preset and hit the button Save & Generate CSS to make other presets update the new colors.', 'floral' ) . '</strong>',
            'desc'       => esc_html__( 'Define your most used colors, which will be listed in the color dropdown in page builder. Notice: Color name should be unique, and different with other name. If some of them have the same name, the valid name and color is the latest one.', 'floral' ),
            'show_empty' => false
        ),
//        array(
//            'id'       => mt_rand(),
//            'title'    => esc_html__( 'Regenerate all preset css files', 'floral' ),
//            'type'     => 'raw',
//            'markdown' => true,
//            'content'  => floral_get_file_contents( floral_theme_dir() . 'includes/library/floral-options-templates/templates/generate-presets-css.html' )
//        ),
    );
}


$this->sections[] = array(
    'title'  => esc_html__( 'Colors', 'floral' ),
    'desc'   => esc_html__( 'Colors settings.', 'floral' ),
    'icon'   => 'el el-magic',
    'fields' => array_merge( array(
        array(
            'id'       => 'primary-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Primary color', 'floral' ),
            'subtitle' => esc_html__( 'Set primary color.', 'floral' ),
            'default'  => '#f76b6a',
            'validate' => 'color',
            'compiler' => true
        ),

        array(
            'id'       => 'secondary-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Secondary color', 'floral' ),
            'subtitle' => esc_html__( 'Set secondary color.', 'floral' ),
            'default'  => '#28476b',
            'validate' => 'color',
            'compiler' => true
        ),
        array(
            'id'       => 'text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Text color', 'floral' ),
            'subtitle' => esc_html__( 'Set Text Color.', 'floral' ),
            'default'  => '#444',
            'validate' => 'color',
            'compiler' => true
        ),

        array(
            'id'       => 'meta-text-color',
            'type'     => 'color',
            'title'    => esc_html__( 'Meta text color', 'floral' ),
            'subtitle' => esc_html__( 'Set meta text color.', 'floral' ),
            'default'  => '#999',
            'validate' => 'color',
            'compiler' => true
        ),

        array(
            'id'       => 'border-color',
            'type'     => 'color_rgba',
            'title'    => esc_html__( 'Border color', 'floral' ),
            'subtitle' => esc_html__( 'Set border color.', 'floral' ),
            'default'  => array(
                'color' => '#808080',
                'alpha' => '0.2',
                'rgba'  => 'rgba(128, 128, 128, 0.2)'
            ),
            'validate' => 'colorrgba',
            'compiler' => true
        ),
    ), $most_used_field )
);