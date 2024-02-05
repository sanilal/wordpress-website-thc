<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-masonry-grid.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once Floral_Addon::plugin_dir() . "includes/vc_customize/shortcodes-grid/__core/floral-basic-grid-custom.php";
class Floral_SC_Masonry_Grid extends Floral_Basic_Grid {
    const SC_BASE = 'vc_masonry_grid';
    
    public function shortcodeScripts() {
        parent::shortcodeScripts();
        wp_register_script( 'vc_masonry', vc_asset_url( 'lib/bower/masonry/dist/masonry.pkgd.min.js' ), array(), WPB_VC_VERSION, true );
    }
    
    public function enqueueScripts() {
        wp_enqueue_script( 'vc_masonry' );
        parent::enqueueScripts();
    }
    
    public function buildGridSettings() {
        parent::buildGridSettings();
        $this->grid_settings['style'] .= '-masonry';
    }
    
    protected function contentAllMasonry( $grid_style, $settings, $content ) {
        return parent::contentAll( $grid_style, $settings, $content );
    }
    
    protected function contentLazyMasonry( $grid_style, $settings, $content ) {
        return parent::contentLazy( $grid_style, $settings, $content );
    }
    
    protected function contentLoadMoreMasonry( $grid_style, $settings, $content ) {
        return parent::contentLoadMore( $grid_style, $settings, $content );
    }
}