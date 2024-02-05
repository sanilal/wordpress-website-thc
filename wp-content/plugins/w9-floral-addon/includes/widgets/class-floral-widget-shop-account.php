<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-shop-account.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( ! floral_is_woocommerce_active() ) {
	return;
}

class Floral_Widget_Shop_Account extends Floral_Widget_Base {
	/**
	 * Floral_Widget_Shop_Account constructor.
	 */
	public function __construct() {
		$args = array(
			'id'      => 'floral-widget-shop-account',
			'name'    => esc_html__( 'Floral Shop Account', 'w9-floral-addon' ),
			'options' => array(
				'classname'   => 'floral-shop-account',
				'description' => esc_html__( 'Widget for WooCommerce "my account".', 'w9-floral-addon' )
			),
			'fields'  => array(
				array(
					'id'      => 'title',
					'type'    => 'text',
					'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
					'default' => ''
				),
				
				array(
					'id'      => 'module_type',
					'type'    => 'select',
					'title'   => __( 'Module Type', 'w9-floral-addon' ),
					'options' => array(
						'link'  => __( 'Link', 'w9-floral-addon' ),
						'popup' => __( 'Popup', 'w9-floral-addon' ),
					),
					'default' => 'link'
				),
				
				array(
					'id'         => 'link_to',
					'type'       => 'select',
					'title'      => __( 'Link To', 'w9-floral-addon' ),
					'options'    => array(
						'my-account' => __( 'Link to "My account" page', 'w9-floral-addon' ),
						'custom'     => __( 'Custom link', 'w9-floral-addon' ),
					),
					'dependency' => array(
						'element'  => 'module_type',
						'equal_to' => 'link'
					),
					'default'    => 'my-account'
				),
				
				array(
					'id'         => 'custom_link',
					'type'       => 'text',
					'title'      => esc_html__( 'Custom Link', 'w9-floral-addon' ),
					'dependency' => array(
						'element'  => 'link_to',
						'equal_to' => 'custom'
					),
					'default'    => ''
				),
			)
		
		);
		parent::__construct( $args );
	}
	
	public function form( $instance ) {
		parent::form( $instance );
		?>
		<p class="help">
			<?php echo __( 'Please enable registration on the "My Account" page (WooCommerce > Settings > Account) if you want to show the registration.', 'w9-floral-addon' ); ?>
		</p>
		<?php
	}
	
	public function widget_content( $args, $instance ) {
		$module_type = $link_to = $custom_link = '';
		extract( $instance, EXTR_IF_EXISTS );
		$this->the_widget_title( $args, $instance );
		
		$link_url = '';
		if ( $link_to === 'my-account' ) {
			$link_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		} elseif ( $link_to === 'custom' ) {
			$link_url = ! empty( $custom_link ) ? esc_url( $custom_link ) : '';
		}
		
		$link_text = __( 'Login / Register', 'woothemes' );
		if ( get_option( 'woocommerce_enable_myaccount_registration' ) !== 'yes' ) {
			$link_text = __( 'Login', 'woothemes' );
		}
		
		$pre_text = __( 'Welcome Guest!', 'w9-floral-addon' ) . ' ';
		
		?>
		<div class="floral-shop-account">
			<?php if ( is_user_logged_in() ) { ?>
				<p>
					<span><?php echo __( 'Hello ', 'w9-floral-addon' ) ?> </span>
					<a href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>"><?php echo esc_html( wp_get_current_user()->display_name ); ?></a>
					<span>/</span>
					<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e( 'Logout', 'w9-floral-addon' ); ?></a>
				</p>
			<?php } else { ?>
				<?php if ( $module_type === 'link' ) { ?>
					<p>
						<span><?php echo $pre_text; ?></span>
						<a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
					</p>
				<?php } elseif ( $module_type === 'popup' ) {
					if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
						floral_add_popup_item( array( 'type' => 'woo-login', 'content' => 'popup', ) );
						floral_add_popup_item( array( 'type' => 'woo-register', 'content' => 'popup', ) );
						?>
						
						<div class="floral-popup-caller">
							<p>
								<span><?php echo $pre_text; ?></span>
								<a href="javascript:void(0);" onclick="floral.page.popup('woo-login', 'popup')">
									Login
								</a>
								<span><?php echo ' ' . __( 'Or', 'w9-floral-addon' ) . ' ' ?></span>
								<a href="javascript:void(0);" onclick="floral.page.popup('woo-register', 'popup')">
									Register
								</a>
							</p>
						</div>
					<?php } else {
						floral_add_popup_item( array( 'type' => 'woo-login', 'content' => 'popup', ) );
						?>
						<div class="floral-popup-caller">
							<p>
								<span><?php echo $pre_text; ?></span>
								<a href="javascript:void(0);" onclick="floral.page.popup('woo-login', 'popup')">
									Login
								</a>
							</p>
						</div>
						<?php
					}
				}
			} ?>
		</div>
		<?php
	}
}
