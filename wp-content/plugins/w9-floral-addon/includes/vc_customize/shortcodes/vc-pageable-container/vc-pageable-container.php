<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-pageable-container.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'                    => __( 'Pageable Container', 'w9-floral-addon' ),
    'base'                    => 'vc_tta_pageable',
    'icon'                    => 'w9 w9-ico-software-layout-header',
    'is_container'            => true,
    'show_settings_on_create' => false,
    'as_parent'               => array(
        'only' => 'vc_tta_section',
    ),
    'category'                => __( 'Content', 'w9-floral-addon' ),
    'description'             => __( 'Pageable content container', 'w9-floral-addon' ),
    'params'                  => array(
        array(
            'type'        => 'textfield',
            'param_name'  => 'title',
            'heading'     => __( 'Widget title', 'w9-floral-addon' ),
            'description' => __( 'Enter text used as widget title (Note: located above content element).', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'hidden',
            'param_name' => 'no_fill_content_area',
            'std'        => true,
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'autoplay',
            'value'       => array(
                __( 'None', 'w9-floral-addon' ) => 'none',
                '1'                         => '1',
                '2'                         => '2',
                '3'                         => '3',
                '4'                         => '4',
                '5'                         => '5',
                '10'                        => '10',
                '20'                        => '20',
                '30'                        => '30',
                '40'                        => '40',
                '50'                        => '50',
                '60'                        => '60',
            ),
            'std'         => 'none',
            'heading'     => __( 'Autoplay', 'w9-floral-addon' ),
            'description' => __( 'Select auto rotate for pageable in seconds (Note: disabled by default).', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textfield',
            'param_name'  => 'active_section',
            'heading'     => __( 'Active section', 'w9-floral-addon' ),
            'value'       => 1,
            'description' => __( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'pagination_style',
            'value'       => array(
                __( 'None', 'w9-floral-addon' )                     => '',
                __( 'Square Dots', 'w9-floral-addon' )              => 'outline-square',
                __( 'Radio Dots', 'w9-floral-addon' )               => 'outline-round',
                __( 'Point Dots', 'w9-floral-addon' )               => 'flat-round',
                __( 'Fill Square Dots', 'w9-floral-addon' )         => 'flat-square',
                __( 'Rounded Fill Square Dots', 'w9-floral-addon' ) => 'flat-rounded',
            ),
            'heading'     => __( 'Pagination style', 'w9-floral-addon' ),
            'description' => __( 'Select pagination style.', 'w9-floral-addon' ),
            'std'         => 'outline-round',
        ),
        array(
            'type'               => 'dropdown',
            'param_name'         => 'pagination_color',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'heading'            => __( 'Pagination color', 'w9-floral-addon' ),
            'description'        => __( 'Select pagination color.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'std'                => 'p',
            'dependency'         => array(
                'element'   => 'pagination_style',
                'not_empty' => true,
            ),
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'tab_position',
            'value'       => array(
                __( 'Top', 'w9-floral-addon' )    => 'top',
                __( 'Bottom', 'w9-floral-addon' ) => 'bottom',
            ),
            'std'         => 'bottom',
            'heading'     => __( 'Pagination position', 'w9-floral-addon' ),
            'description' => __( 'Select pageable navigation position.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => __( 'Extra class name', 'w9-floral-addon' ),
            'param_name'  => 'el_class',
            'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'w9-floral-addon' ),
        ),
        array(
            'type'       => 'css_editor',
            'heading'    => __( 'CSS box', 'w9-floral-addon' ),
            'param_name' => 'css',
            'group'      => __( 'Design Options', 'w9-floral-addon' ),
        ),
    ),
    'js_view'                 => 'VcBackendTtaPageableView',
    'custom_markup'           => '
<div class="vc_tta-container vc_tta-o-non-responsive" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-pageable vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
        . '<ul class="vc_tta-tabs-list">'
        . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
        . '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
    'default_content'         => '
[vc_tta_section title="' . sprintf( '%s %d', __( 'Section', 'w9-floral-addon' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( '%s %d', __( 'Section', 'w9-floral-addon' ), 2 ) . '"][/vc_tta_section]
	',
    'admin_enqueue_js'        => array(
        vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
    ),
) );