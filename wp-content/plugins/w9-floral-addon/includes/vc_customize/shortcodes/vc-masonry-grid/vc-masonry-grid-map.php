<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-masonry-grid-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once Floral_Addon::plugin_dir() . "includes/vc_customize/shortcodes-grid/__core/floral-grids-common.php";
$gridParams = Floral_Grids_Common::getMasonryCommonAtts();
vc_map( array(
    'name'           => __( 'Masonry Posts', 'w9-floral-addon' ),
    'base'           => Floral_SC_Masonry_Grid::SC_BASE,
    'icon'           => 'w9 w9-ico-software-layout-header-4boxes',
    'category'       => __( 'Content', 'w9-floral-addon' ),
    'description'    => __( 'Posts, pages or custom posts in grid', 'w9-floral-addon' ),
    'php_class_name' => 'Floral_SC_Masonry_Grid',
    'params'         => $gridParams,
) );
