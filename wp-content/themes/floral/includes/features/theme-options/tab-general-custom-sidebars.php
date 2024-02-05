<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: tab-general-custom-sidebars.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( floral_get_current_preset() === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
    $this->sections[] = array(
        'title'      => esc_html__( 'Custom Sidebar', 'floral' ),
        'desc'       => esc_html__( 'Easy create many custom sidebar as you want. Notice: This section is only managed by the default preset.', 'floral' ),
        'icon'       => 'el el-align-left',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'general-custom-sidebars',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'Custom sidebars', 'floral' ),
                'subtitle' => esc_html__( 'Custom sidebars can be assigned to any page or post.', 'floral' ),
                'desc'     => esc_html__( 'You can add as many custom sidebars as you need.', 'floral' )
            ),
        )
    );
}
