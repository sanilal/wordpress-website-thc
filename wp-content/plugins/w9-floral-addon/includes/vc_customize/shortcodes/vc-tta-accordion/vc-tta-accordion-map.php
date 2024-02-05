<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: vc-tta-accordion-map.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

vc_map( array(
    'name'                    => __( 'Accordion', 'w9-floral-addon' ),
    'base'                    => 'vc_tta_accordion',
    'icon'                    => 'w9 w9-ico-arrows-hamburger1',
    'is_container'            => true,
    'show_settings_on_create' => false,
    'as_parent'               => array(
        'only' => 'vc_tta_section',
    ),
    'category'                => __( 'Content', 'w9-floral-addon' ),
    'description'             => __( 'Collapsible content panels', 'w9-floral-addon' ),
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
                __( 'Classic - Floral', 'w9-floral-addon' ) => 'floral-1',
                __( 'Classic', 'w9-floral-addon' )    => 'classic',
                __( 'Modern', 'w9-floral-addon' )     => 'modern',
                __( 'Flat', 'w9-floral-addon' )       => 'flat',
                __( 'Outline', 'w9-floral-addon' )    => 'outline',
            ),
            'heading'     => __( 'Style', 'w9-floral-addon' ),
            'description' => __( 'Select accordion display style.', 'w9-floral-addon' ),
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
            'description' => __( 'Select accordion shape.', 'w9-floral-addon' ),
            'std'         => 'square',
            'dependency'  => array(
                'element'            => 'style',
                'value_not_equal_to' => array('floral-1', 'floral-2', 'springv')
            )
        ),
        array(
            'type'               => 'dropdown',
            'param_name'         => 'color',
            'value'              => Floral_Map_Helpers::get_just_colors(),
            'std'                => 'p',
            'heading'            => __( 'Color', 'w9-floral-addon' ),
            'description'        => __( 'Select accordion color.', 'w9-floral-addon' ),
            'param_holder_class' => 'vc_colored-dropdown',
            'dependency'  => array(
	            'element'            => 'style',
	            'value_not_equal_to' => array('floral-1', 'floral-2')
            )
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'no_fill',
            'heading'     => __( 'Do not fill content area?', 'w9-floral-addon' ),
            'description' => __( 'Do not fill content area with color.', 'w9-floral-addon' ),
            'dependency'  => array(
                'element'            => 'style',
                'value_not_equal_to' => 'floral'
            )
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'spacing',
            'value'       => array(
                __( 'None', 'w9-floral-addon' ) => '',
                '1px'                       => '1',
                '2px'                       => '2',
                '3px'                       => '3',
                '4px'                       => '4',
                '5px'                       => '5',
                '10px'                      => '10',
                '15px'                      => '15',
                '20px'                      => '20',
                '25px'                      => '25',
                '30px'                      => '30',
                '35px'                      => '35',
            ),
            'heading'     => __( 'Spacing', 'w9-floral-addon' ),
            'description' => __( 'Select accordion spacing.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'gap',
            'value'       => array(
                __( 'None', 'w9-floral-addon' ) => '',
                '1px'                       => '1',
                '2px'                       => '2',
                '3px'                       => '3',
                '4px'                       => '4',
                '5px'                       => '5',
                '10px'                      => '10',
                '15px'                      => '15',
                '20px'                      => '20',
                '25px'                      => '25',
                '30px'                      => '30',
                '35px'                      => '35',
            ),
            'heading'     => __( 'Gap', 'w9-floral-addon' ),
            'description' => __( 'Select accordion gap.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'c_align',
            'value'       => array(
                __( 'Left', 'w9-floral-addon' )   => 'left',
                __( 'Right', 'w9-floral-addon' )  => 'right',
                __( 'Center', 'w9-floral-addon' ) => 'center',
            ),
            'heading'     => __( 'Alignment', 'w9-floral-addon' ),
            'description' => __( 'Select accordion section title alignment.', 'w9-floral-addon' ),
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
            'description' => __( 'Select auto rotate for accordion in seconds (Note: disabled by default).', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'collapsible_all',
            'heading'     => __( 'Allow collapse all?', 'w9-floral-addon' ),
            'description' => __( 'Allow collapse all accordion sections.', 'w9-floral-addon' ),
        ),
        // Control Icons
        array(
            'type'        => 'dropdown',
            'param_name'  => 'c_icon',
            'value'       => array(
                __( 'None', 'w9-floral-addon' )     => '',
                __( 'Chevron', 'w9-floral-addon' )  => 'chevron',
                __( 'Plus', 'w9-floral-addon' )     => 'plus',
                __( 'Triangle', 'w9-floral-addon' ) => 'triangle',
            ),
            'std'         => 'plus',
            'heading'     => __( 'Icon', 'w9-floral-addon' ),
            'description' => __( 'Select accordion navigation icon.', 'w9-floral-addon' ),
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'c_position',
            'value'       => array(
                __( 'Left', 'w9-floral-addon' )  => 'left',
                __( 'Right', 'w9-floral-addon' ) => 'right',
            ),
            'dependency'  => array(
                'element'   => 'c_icon',
                'not_empty' => true,
            ),
            'heading'     => __( 'Position', 'w9-floral-addon' ),
            'description' => __( 'Select accordion navigation icon position.', 'w9-floral-addon' ),
        ),
        // Control Icons END
        array(
            'type'        => 'textfield',
            'param_name'  => 'active_section',
            'heading'     => __( 'Active section', 'w9-floral-addon' ),
            'value'       => 1,
            'description' => __( 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).', 'w9-floral-addon' ),
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
    'js_view'                 => 'VcBackendTtaAccordionView',
    'custom_markup'           => '
<div class="vc_tta-container" data-vc-action="collapseAll">
	<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-backend-accordion-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-gap-2">
	   <div class="vc_tta-panels vc_clearfix {{container-class}}">
	      {{ content }}
	      <div class="vc_tta-panel vc_tta-section-append">
	         <div class="vc_tta-panel-heading">
	            <h4 class="vc_tta-panel-title vc_tta-controls-icon-position-left">
	               <a href="javascript:;" aria-expanded="false" class="vc_tta-backend-add-control">
	                   <span class="vc_tta-title-text">' . __( 'Add Section', 'w9-floral-addon' ) . '</span>
	                    <i class="vc_tta-controls-icon vc_tta-controls-icon-plus"></i>
					</a>
	            </h4>
	         </div>
	      </div>
	   </div>
	</div>
</div>',
    'default_content'         => '[vc_tta_section title="' . sprintf( '%s %d', __( 'Section', 'w9-floral-addon' ), 1 ) . '"][/vc_tta_section][vc_tta_section title="' . sprintf( '%s %d', __( 'Section', 'w9-floral-addon' ), 2 ) . '"][/vc_tta_section]',
) );