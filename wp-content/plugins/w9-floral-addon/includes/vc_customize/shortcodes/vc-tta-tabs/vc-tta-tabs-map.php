<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-tta-tabs-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

vc_map( array(
	'name'                    => __( 'Tabs', 'w9-floral-addon' ),
	'base'                    => 'vc_tta_tabs',
	'icon'                    => 'w9 w9-ico-basic-folder',
	'is_container'            => true,
	'show_settings_on_create' => false,
	'as_parent'               => array(
		'only' => 'vc_tta_section',
	),
	'category'                => __( 'Content', 'w9-floral-addon' ),
	'description'             => __( 'Tabbed content', 'w9-floral-addon' ),
	'params'                  => array(
		array(
			'type'        => 'textfield',
			'param_name'  => 'title',
			'heading'     => __( 'Widget title', 'w9-floral-addon' ),
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'w9-floral-addon' ),
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				__( 'Classic - Floral', 'w9-floral-addon' ) => 'classic-floral',
				__( 'Classic', 'w9-floral-addon' )           => 'classic',
				__( 'Modern', 'w9-floral-addon' )            => 'modern',
				__( 'Flat', 'w9-floral-addon' )              => 'flat',
				__( 'Outline', 'w9-floral-addon' )           => 'outline',
			),
			'heading'     => __( 'Style', 'w9-floral-addon' ),
			'description' => __( 'Select tabs display style.', 'w9-floral-addon' ),
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'shape',
			'value'       => array(
				__( 'Square', 'w9-floral-addon' )  => 'square',
				__( 'Rounded', 'w9-floral-addon' ) => 'rounded',
				__( 'Round', 'w9-floral-addon' )   => 'round',
			),
			'heading'     => __( 'Shape', 'w9-floral-addon' ),
			'description' => __( 'Select tabs shape.', 'w9-floral-addon' ),
			'std'         => 'square',
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'classic-floral', 'springv' )
			)
		),
		array(
			'type'               => 'dropdown',
			'param_name'         => 'color',
			'heading'            => __( 'Color', 'w9-floral-addon' ),
			'description'        => __( 'Select tabs color.', 'w9-floral-addon' ),
			'value'              => Floral_Map_Helpers::get_just_colors(),
			'std'                => 'p',
			'param_holder_class' => 'vc_colored-dropdown',
			'dependency'         => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'classic-floral' )
			)
		),
		array(
			'type'        => 'checkbox',
			'param_name'  => 'no_fill_content_area',
			'heading'     => __( 'Do not fill content area?', 'w9-floral-addon' ),
			'description' => __( 'Do not fill content area with color.', 'w9-floral-addon' ),
			'dependency'         => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'classic-floral' )
			)
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'spacing',
			'value'       => array(
				__( 'None', 'w9-floral-addon' ) => '',
				'1px'                            => '1',
				'2px'                            => '2',
				'3px'                            => '3',
				'4px'                            => '4',
				'5px'                            => '5',
				'10px'                           => '10',
				'15px'                           => '15',
				'20px'                           => '20',
				'25px'                           => '25',
				'30px'                           => '30',
				'35px'                           => '35',
			),
			'heading'     => __( 'Spacing', 'w9-floral-addon' ),
			'description' => __( 'Select tabs spacing.', 'w9-floral-addon' ),
			'std'         => '1',
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'classic-floral' )
			)
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'gap',
			'value'       => array(
				__( 'None', 'w9-floral-addon' ) => '',
				'1px'                            => '1',
				'2px'                            => '2',
				'3px'                            => '3',
				'4px'                            => '4',
				'5px'                            => '5',
				'10px'                           => '10',
				'15px'                           => '15',
				'20px'                           => '20',
				'25px'                           => '25',
				'30px'                           => '30',
				'35px'                           => '35',
			),
			'heading'     => __( 'Gap', 'w9-floral-addon' ),
			'description' => __( 'Select tabs gap.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'classic-floral' )
			)
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'tab_position',
			'value'       => array(
				__( 'Top', 'w9-floral-addon' )    => 'top',
				__( 'Bottom', 'w9-floral-addon' ) => 'bottom',
			),
			'heading'     => __( 'Position', 'w9-floral-addon' ),
			'std'         => 'top',
			'description' => __( 'Select tabs navigation position.', 'w9-floral-addon' ),
			'dependency'  => array(
				'element'            => 'style',
				'value_not_equal_to' => array( 'classic-floral' )
			)
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'alignment',
			'value'       => array(
				__( 'Left', 'w9-floral-addon' )   => 'left',
				__( 'Right', 'w9-floral-addon' )  => 'right',
				__( 'Center', 'w9-floral-addon' ) => 'center',
			),
			'heading'     => __( 'Alignment', 'w9-floral-addon' ),
			'description' => __( 'Select tabs section title alignment.', 'w9-floral-addon' ),
		),
		array(
			'type'        => 'dropdown',
			'param_name'  => 'autoplay',
			'value'       => array(
				__( 'None', 'w9-floral-addon' ) => 'none',
				'1'                              => '1',
				'2'                              => '2',
				'3'                              => '3',
				'4'                              => '4',
				'5'                              => '5',
				'10'                             => '10',
				'20'                             => '20',
				'30'                             => '30',
				'40'                             => '40',
				'50'                             => '50',
				'60'                             => '60',
			),
			'std'         => 'none',
			'heading'     => __( 'Autoplay', 'w9-floral-addon' ),
			'description' => __( 'Select auto rotate for tabs in seconds (Note: disabled by default).', 'w9-floral-addon' ),
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
	'js_view'                 => 'VcBackendTtaTabsView',
	'custom_markup'           => '
<div class="vc_tta-container" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
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
[vc_tta_section title="' . sprintf( '%s %d', __( 'Tab', 'w9-floral-addon' ), 1 ) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf( '%s %d', __( 'Tab', 'w9-floral-addon' ), 2 ) . '"][/vc_tta_section]
	',
	'admin_enqueue_js'        => array(
		vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
	),
) );