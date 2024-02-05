<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-basic-grid-custom.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-basic-grid.php' );

class Floral_Basic_Grid extends WPBakeryShortCode_VC_Basic_Grid {
    
    protected function getFileName() {
        return 'vc_basic_grid';
    }
    
    //Overwrite default js
    public function shortcodeScripts() {
        parent::shortcodeScripts();
    
        wp_deregister_script('vc_grid');
        wp_register_script( 'vc_grid', Floral_Addon::plugin_url() . 'assets/js/floral-posts-grid.min.js',
            array(
                'jquery',
                'underscore',
                'vc_pageable_owl-carousel',
                'twbs-pagination',
                'waypoints',
                'vc_grid-js-imagesloaded',
            ), WPB_VC_VERSION, true
        );
    
    }
    
    public function buildGridSettings() {
        
        $this->grid_settings = array(
            'page_id'       => $this->atts['page_id'],
            // used in basic grid for initialization
            'style'         => $this->atts['style'],
            'element_width' => $this->atts['element_width'],
            'action'        => 'vc_get_vc_grid_data',
        );
        // used in ajax request for items
        if ( isset( $this->atts['shortcode_id'] ) && !empty( $this->atts['shortcode_id'] ) ) {
            $this->grid_settings['shortcode_id'] = $this->atts['shortcode_id'];
        } elseif ( isset( $this->atts['shortcode_hash'] ) && !empty( $this->atts['shortcode_hash'] ) ) {
            // @deprecated since 4.4.3
            $this->grid_settings['shortcode_hash'] = $this->atts['shortcode_hash'];
        }
        if ( 'load-more' === $this->atts['style'] ) {
            $this->grid_settings = array_merge( $this->grid_settings, array(
                // used in dispaly style load more button, lazy, pagination
                'items_per_page' => $this->atts['items_per_page'],
                'btn_data'       => vc_map_integrate_parse_atts( $this->shortcode, 'vc_btn', $this->atts, 'btn' . '_' ),
            ) );
        } elseif ( 'lazy' === $this->atts['style'] ) {
            $this->grid_settings = array_merge( $this->grid_settings, array(
                'items_per_page' => $this->atts['items_per_page'],
            ) );
        } elseif ( 'pagination' === $this->atts['style'] ) {
            $this->grid_settings = array_merge( $this->grid_settings, array(
                'items_per_page'  => $this->atts['items_per_page'],
                // used in pagination style
                'auto_play'       => $this->atts['autoplay'] > 0 ? true : false,
                'gap'             => (int) $this->atts['gap'],
                // not used yet, but can be used in isotope..
                'speed'           => (int) $this->atts['autoplay'] * 1000,
                'loop'            => $this->atts['loop'],
                'animation_in'    => $this->atts['paging_animation_in'],
                'animation_out'   => $this->atts['paging_animation_out'],
                'arrows_design'   => $this->atts['arrows_design'],
                'arrows_color'    => $this->atts['arrows_color'],
                'arrows_position' => $this->atts['arrows_position'],
                'paging_design'   => $this->atts['paging_design'],
                'paging_color'    => $this->atts['paging_color'],
            ) );
            // Add support slider action
        } elseif ( 'slider' === $this->atts['style'] ) {
            $this->grid_settings = array_merge( $this->grid_settings, array(
                'items_per_page'  => $this->atts['items_per_page'],
                'element_width'   => $this->atts['slider_element_width'],
                // used in pagination style
                'auto_play'       => $this->atts['autoplay'] > 0 ? true : false,
                'gap'             => (int) $this->atts['slider_gap'],
                // not used yet, but can be used in isotope..
                'speed'           => (int) $this->atts['autoplay'] * 1000,
                'loop'            => $this->atts['loop'],
                'animation_in'    => $this->atts['paging_animation_in'],
                'animation_out'   => $this->atts['paging_animation_out'],
                'arrows_design'   => $this->atts['arrows_design'],
                'arrows_color'    => $this->atts['arrows_color'],
                'arrows_position' => $this->atts['arrows_position'],
                'paging_design'   => $this->atts['paging_design'],
                'paging_color'    => $this->atts['paging_color'],
            ) );
        }
        $this->grid_settings['tag'] = $this->shortcode;
        
        
    }
    
    //Render Item
    public function renderAjax( $vc_request_param ) {
        $this->items = array(); // clear this items array (if used more than once);
        $id          = isset( $vc_request_param['shortcode_id'] ) ? $vc_request_param['shortcode_id'] : false;
        if ( !isset( $vc_request_param['page_id'] ) ) {
            return "{'status':'Nothing found'}";
        }
        if ( $id ) {
            $shortcode = $this->findPostShortcodeById( $vc_request_param['page_id'], $id );
        } else {
            /**
             * @deprecated since 4.4.3 due to invalid logic in hash algorithm
             */
            $hash      = isset( $vc_request_param['shortcode_hash'] ) ? $vc_request_param['shortcode_hash'] : false;
            $shortcode = $this->findPostShortcodeByHash( $vc_request_param['page_id'], $hash );
        }
        if ( !is_array( $shortcode ) ) {
            return "{'status':'Nothing found - " . $id . "'}"; // Nothing found
        }
        visual_composer()->registerAdminCss();
        visual_composer()->registerAdminJavascript();
        // Set post id
        $this->post_id = (int) $vc_request_param['page_id'];
        
        $shortcode_atts          = $shortcode['atts'];
        $this->shortcode_content = $shortcode['content'];
        $this->buildAtts( $shortcode_atts, $shortcode['content'] );
        
        $this->buildItems();
        
        return $this->renderItems();
    }
    
    public function renderItems() {
        $output = $items = '';
        $this->buildGridSettings();
        $atts         = $this->atts;
        $settings     = $this->grid_settings;
        $filter_terms = $this->filter_terms;
        $is_end       = isset($this->is_end) && $this->is_end;
        $css_classes  = 'vc_grid vc_row' . esc_attr($atts['gap'] > 0 ? ' vc_grid-gutter-' . (int) $atts['gap'] . 'px' : '');
        $currentScope = WPBMap::getScope();
        
        if(isset($this->atts['special_item']) && ! empty($this->atts['special_item'])) {
            $special_item_list = array();
            foreach($this->atts['special_item'] as $key => $item) {
                if( ! empty($item['index'])) {
                    $special_item_list[$item['index']] = $item;
                    unset($special_item_list[$item['index']]['index']);
                }
            }
        }
        
        if(is_array($this->items) && ! empty($this->items)) {
            require_once vc_path_dir('PARAMS_DIR', 'vc_grid_item/class-vc-grid-item.php');
            $this->grid_item = new Vc_Grid_Item();
            $this->grid_item->setGridAttributes($atts);
            $this->grid_item->setIsEnd($is_end);
            $this->grid_item->setTemplateById($atts['item']);
            $output .= $this->grid_item->addShortcodesCustomCss();
            ob_start();
            if(defined('DOING_AJAX') && DOING_AJAX) {
                wp_print_styles();
            }
            $output     .= ob_get_clean();
            $attributes = array(
                'filter_terms' => $filter_terms,
                'atts'         => $atts,
                'grid_item',
                $this->grid_item,
            );
            $output     .= apply_filters('vc_basic_grid_template_filter', vc_get_template('shortcodes/vc_basic_grid_filter.php', $attributes), $attributes);
            $counter    = 1;
            global $post;
            foreach($this->items as $postItem) {
                $this->query->setup_postdata($postItem);
                $post = $postItem;
                if(isset($special_item_list) && key_exists($counter, $special_item_list)) {
                    $tmp_atts      = array_merge($atts, $special_item_list[$counter]);
                    $tmp_grid_item = new Vc_Grid_Item();
                    $tmp_grid_item->setGridAttributes($tmp_atts);
                    $tmp_grid_item->setIsEnd($is_end);
                    $tmp_grid_item->setTemplateById($tmp_atts['item']);
                    $output .= $tmp_grid_item->addShortcodesCustomCss();
                    $items  .= $tmp_grid_item->renderItem($postItem);
                } else {
                    $items .= $this->grid_item->renderItem($postItem);
                }
                $counter ++;
            }
            
            wp_reset_postdata();
        } else {
            return '';
        }
        
        $items  = apply_filters($this->shortcode . '_items_list', $items);
        $output .= $this->renderPagination($atts['style'], $settings, $items, $css_classes);
        WPBMap::setScope($currentScope);
        
        return $output;
    }
    
    
    public function buildAtts( $atts, $content ) {
        parent::buildAtts( $atts, $content );
        if ( isset( $atts['style'] ) && $atts['style'] == 'slider' ) {
            $this->atts['slider_element_width'] = $this->atts['element_width'];
            $this->atts['element_width']        = 12;
            $this->atts['slider_gap']           = $this->atts['gap'];
            $this->atts['gap']                  = 0;
        }
        
        //Special item
        if ( isset( $atts['special_item'] ) ) {
            $this->atts['special_item'] = (array) vc_param_group_parse_atts( $atts['special_item'] );
        }
        
    }
    
    protected function contentSlider( $grid_style, $settings, $content ) {
        return parent::contentAll( $grid_style, $settings, $content );
    }
}