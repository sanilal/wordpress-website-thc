<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-menu.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Widget_Menu extends Floral_Widget_Base {
	/**
	 * Floral_Widget_Menu constructor.
	 */
	public function __construct() {
		$args = array(
			'id'      => 'floral-widget-menu',
			'name'    => esc_html__( 'Floral Widget Menu', 'w9-floral-addon' ),
			'options' => array(
				'classname'   => 'floral-widget-menu',
				'description' => esc_html__( 'Floral custom menu.', 'w9-floral-addon' )
			),
			'fields'  => array(
				array(
					'id'      => 'title',
					'type'    => 'text',
					'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
					'default' => ''
				),
				// Menu
				array(
					'id'      => 'menu_id',
					'type'    => 'select',
					'title'   => __( 'Menu', 'w9-floral-addon' ),
					'options' => floral_get_menu_list()
				),
				
				// Menu Type
				array(
					'id'      => 'menu_type',
					'type'    => 'select',
					'title'   => __( 'Menu Type', 'w9-floral-addon' ),
					'options' => array(
						'floral-widget-vertical-menu'         => __( 'Simple Vertical Menu', 'w9-floral-addon' ),
						'floral-widget-horizontal-menu'       => __( 'Simple Horizontal Menu', 'w9-floral-addon' ),
						'floral-widget-vertical-multi-level'  => __( 'Vertical Tree Menu', 'w9-floral-addon' ),
						'floral-widget-vertical-section-menu' => __( 'Vertical Section Menu', 'w9-floral-addon' ),
					),
				),
				
				//Menu Horizontal With Sub Menu
				array(
					'id'         => 'menu_horizontal_submenu',
					'type'       => 'checkbox',
					'title'      => __( 'Enable sub menu', 'w9-floral-addon' ),
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-horizontal-menu',
					)
				),
				
				//Menu Horizontal Sub Menu Color Scheme
				array(
					'id'         => 'menu_horizontal_submenu_color',
					'type'       => 'select',
					'title'      => __( 'Sub Menu Color', 'w9-floral-addon' ),
					'options'    => array(
						'floral-widget-submenu-dark'  => __( 'Dark - Background Light', 'w9-floral-addon' ),
						'floral-widget-submenu-light' => __( 'Light - Background Dark', 'w9-floral-addon' ),
					),
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-horizontal-menu',
					)
				),
				
				//Font size
				array(
					'id'      => 'menu_fontsize',
					'title'   => __( 'Menu Font Size', 'w9-floral-addon' ),
					'type'    => 'number-slider',
					'unit'    => 'px',
					'min'     => 10,
					'max'     => 36,
					'step'    => 1,
					'default' => '12px'
				),
				
				//Font size
				array(
					'id'         => 'menu_sub_reduce_fontsize',
					'title'      => __( 'Reduce menu font size in submenu', 'w9-floral-addon' ),
					'type'       => 'checkbox',
					'default'    => false,
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-vertical-multi-level',
					)
				),
				
				//Font weight
				array(
					'id'      => 'menu_fontweight',
					'title'   => __( 'Menu Font Weight', 'w9-floral-addon' ),
					'type'    => 'number-slider',
					'min'     => 300,
					'max'     => 700,
					'step'    => 100,
					'default' => 400
				),
				
				//Text align
				array(
					'id'      => 'menu_text_align',
					'title'   => __( 'Menu Text Align', 'w9-floral-addon' ),
					'type'    => 'select',
					'options' => array(
						''            => __( 'Inherit', 'w9-floral-addon' ),
						'text-left'   => __( 'Left', 'w9-floral-addon' ),
						'text-right'  => __( 'Right', 'w9-floral-addon' ),
						'text-center' => __( 'Center', 'w9-floral-addon' ),
					),
					'default' => '',
				),
				
				//Text transform
				array(
					'id'         => 'menu_text_transform',
					'title'      => __( 'Menu Text Transform', 'w9-floral-addon' ),
					'type'       => 'select',
					'options'    => array(
						'initial'         => __( 'Initial', 'w9-floral-addon' ),
						'text-lowercase'  => __( 'lowercase', 'w9-floral-addon' ),
						'text-uppercase'  => __( 'UPPERCASE', 'w9-floral-addon' ),
						'text-capitalize' => __( 'Capitalize', 'w9-floral-addon' ),
					),
					'default'    => 'text-uppercase',
					'dependency' => array(
						'element'      => 'menu_type',
						'not_equal_to' => 'floral-widget-vertical-multi-level',
					)
				),
				
				array(
					'id'         => 'menu_tree_arrow',
					'title'      => __( 'Tree menu arrow', 'w9-floral-addon' ),
					'type'       => 'checkbox',
					'default'    => '1',
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-vertical-multi-level',
					)
				),
				
				array(
					'id'         => 'menu_tree_icon',
					'title'      => __( 'Show icon of menu item', 'w9-floral-addon' ),
					'default'    => false,
					'type'       => 'checkbox',
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-vertical-multi-level',
					)
				),
				
				//Item Spacing
				array(
					'id'      => 'menu_item_spacing',
					'title'   => __( 'Menu Item Spacing', 'w9-floral-addon' ),
					'type'    => 'number-slider',
					'min'     => 0,
					'max'     => 60,
					'step'    => 5,
					'default' => 20
				),
				
				//Menu List Icon
				array(
					'id'         => 'menu_list_icon',
					'title'      => __( 'Menu Icon List', 'w9-floral-addon' ),
					'type'       => 'icon-picker',
					'default'    => '',
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-vertical-menu',
					)
				),
				
				array(
					'id'         => 'menu_list_icon_color',
					'title'      => __( 'Menu Icon List Color', 'w9-floral-addon' ),
					'type'       => 'select',
					'options'    => array(
						                '__'        => __( 'Default CSS', 'w9-floral-addon' ),
						                'p'         => __( 'Primary', 'w9-floral-addon' ),
						                's'         => __( 'Secondary', 'w9-floral-addon' ),
						                'meta-text' => __( 'Meta Text Color', 'w9-floral-addon' ),
						                'border'    => __( 'Border Color', 'w9-floral-addon' ),
						                'text'      => __( 'Text Color', 'w9-floral-addon' ),
						                'light'     => __( 'Light #FFF', 'w9-floral-addon' ),
						                'dark'      => __( 'Dark #000', 'w9-floral-addon' ),
						                'gray2'     => __( 'Gray #222', 'w9-floral-addon' ),
						                'gray4'     => __( 'Gray #444', 'w9-floral-addon' ),
						                'gray6'     => __( 'Gray #666', 'w9-floral-addon' ),
						                'gray8'     => __( 'Gray #888', 'w9-floral-addon' ),
					                ) + floral_get_most_used_colors( 'key_name' ),
					'default'    => '__',
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-vertical-menu',
					)
				),
				
				//Number column
				array(
					'id'         => 'menu_number_column',
					'title'      => __( 'Vertical Menu Number Columns', 'w9-floral-addon' ),
					'type'       => 'select',
					'options'    => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
					),
					'dependency' => array(
						'element'  => 'menu_type',
						'equal_to' => 'floral-widget-vertical-menu',
					)
				)
			)
		
		);
		parent::__construct( $args );
	}
	
	public function widget_content( $args, $instance ) {
		$menu_id                       = '';
		$menu_type                     = '';
		$menu_horizontal_submenu       = '';
		$menu_horizontal_submenu_color = '';
		$menu_fontsize                 = '';
		$menu_sub_reduce_fontsize      = '';
		$menu_fontweight               = '';
		$menu_text_align               = '';
		$menu_text_transform           = '';
		$menu_tree_arrow               = '';
		$menu_tree_icon                = '';
		$menu_item_spacing             = '';
		$menu_list_icon                = '';
		$menu_list_icon_color          = '';
		$menu_number_column            = ''; //Class
		
		if ( empty( $menu_id ) ) {
			extract( $instance, EXTR_IF_EXISTS );
		}
		$this->the_widget_title( $args, $instance );
		
		$widget_menu_class         = array(
			$menu_type,
		);
		$widget_menu_content_class = array();
		//Add menu class
		if ( ! ( $menu_text_transform === 'initial' ) ) {
			$widget_menu_class[] = $menu_text_transform;
		}
		
		if ( ! empty( $menu_item_spacing ) ) {
			$widget_menu_class[] = 'menu-item-spacing-' . $menu_item_spacing;
		}
		
		if ( ! empty( $menu_text_align ) ) {
			$widget_menu_class[] = $menu_text_align;
		} else {
			$widget_menu_class[] = 'text-inherit';
		}
		
		if ( ! empty( $menu_number_column ) ) {
			$widget_menu_class[] = 'menu-number-column-' . $menu_number_column;
		}
		
		if ( $menu_type === 'floral-widget-horizontal-menu' && $menu_horizontal_submenu === '1' ) {
			$widget_menu_class[] = 'floral-enable-submenu';
			$widget_menu_class[] = $menu_horizontal_submenu_color;
		}
		
		if ( $menu_type === 'floral-widget-vertical-multi-level' ) {
			if ( $menu_tree_arrow != '1' ) {
				$widget_menu_class[] = 'floral-tree-menu-hide-arrow';
			}
			
			if ( $menu_tree_icon != '1' ) {
				$widget_menu_class[] = 'floral-tree-menu-hide-icon';
			}
			
			if ( $menu_sub_reduce_fontsize === '1' ) {
				$widget_menu_class[] = 'reduce-sub-menu-fontsize';
			}
		}
		
		
		if ( $menu_type === 'floral-widget-vertical-multi-level' ) {
			$menu_param = array(
				'menu'            => $menu_id,
				'menu_class'      => floral_clean_html_classes( $widget_menu_content_class ),
				'container_class' => 'floral-widget-menu-content clearfix',
				'walker'          => new Floral_Walker_Nav_Menu_Vertical(),
			);
		} else {
			$menu_param = array(
				'menu'            => $menu_id,
				'menu_class'      => floral_clean_html_classes( $widget_menu_content_class ),
				'container_class' => 'floral-widget-menu-content clearfix',
				'walker'          => new Walker_Nav_Menu(),
				'depth'           => 1
			);
			
			if ( $menu_type === 'floral-widget-horizontal-menu' && $menu_horizontal_submenu === '1' ) {
				$menu_param['depth'] = 2;
			}
			
			if ( $menu_type === 'floral-widget-vertical-menu' && ! empty( $menu_list_icon ) ) {
				$menu_param[ ( $menu_text_align === 'text-right' ) ? 'link_after' : 'link_before' ] = '<i class="__menu-pre-icon ' . $menu_list_icon . '"></i>';
				$widget_menu_class[]                                                                = 'list-icon_on';
				$widget_menu_class[]                                                                = 'list-icon-color-' . $menu_list_icon_color;
			}
		}
		
		ob_start();
		?>
		<div class="floral-widget-menu-inner <?php floral_the_clean_html_classes( $widget_menu_class ) ?>" <?php echo sprintf( 'style="font-size : %s; font-weight: %s"', $menu_fontsize, $menu_fontweight ) ?>>
			<?php wp_nav_menu( $menu_param ); ?>
		</div>
		<?php
		echo ob_get_clean();
	}
}
