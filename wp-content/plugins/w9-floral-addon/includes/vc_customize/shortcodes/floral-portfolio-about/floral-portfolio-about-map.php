<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-portfolio-about-map.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( is_admin()  && (!defined( 'DOING_AJAX' ) && ( !post_type_exists( Floral_CPT_Portfolio::CPT_SLUG ) || floral_get_current_post_type() !== Floral_CPT_Portfolio::CPT_SLUG ))) {
    return;
}

vc_map( array(
    'name'           => __( 'Floral Portfolio About', 'w9-floral-addon' ),
    'base'           => Floral_SC_Portfolio_About::SC_BASE,
    'php_class_name' => 'Floral_SC_Portfolio_About',
    'icon'           => 'w9 w9-ico-software-layout-8boxes',
    'category'       => array( __( 'Content', 'w9-floral-addon' ), FLORAL_PORTFOLIO_SC_CATEGORY ),
    'description'    => __('Get meta info about from single portfolio', 'w9-floral-addon' ),
    'post_type'      => Floral_CPT_Portfolio::CPT_SLUG,
    'params'         => array(
        Floral_Map_Helpers::extra_class(),
        Floral_Map_Helpers::design_options(),
        Floral_Map_Helpers::animation_css(),
        Floral_Map_Helpers::animation_duration(),
        Floral_Map_Helpers::animation_delay()
    )
) );
