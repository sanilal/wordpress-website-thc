<div class="<?php floral_the_clean_html_classes( $nav_width ); ?>">
	<div class="floral-nav-body-content">
		<?php foreach ( $nav_modules as $key => $nav_module ):
			$nav_item_class = array( 'floral-nav-item' );
			$nav_item_class[] = 'floral-nav-' . $key . '-wrapper';
			
			if ( $key === $nav_module_desktop_biggest ) {
				$nav_item_class[] = 'biggest-nav-item-desktop';
				$nav_item_class[] = $nav_module_desktop_biggest_align;
			}
			if ( $key === $nav_module_mobile_biggest ) {
				$nav_item_class[] = 'biggest-nav-item-mobile';
				$nav_item_class[] = $nav_module_mobile_biggest_align;
			}
			
			if (empty($is_sticky_content)) {
				$nav_item_class[] = isset( $nav_module['desktop_order'] ) ? 'nav-item-desktop-' . $nav_module['desktop_order'] : 'nav-item-desktop-none';
			} else {
				$nav_item_class[] = isset( $nav_module['desktop_sticky_order'] ) ? 'nav-item-desktop-sticky-' . $nav_module['desktop_sticky_order'] : 'nav-item-desktop-sticky-none';
			}
			
			$nav_item_class[] = isset( $nav_module['mobile_order'] ) ? 'nav-item-mobile-' . $nav_module['mobile_order'] : 'nav-item-mobile-none';
			
			?>
			<div class="<?php floral_the_clean_html_classes( $nav_item_class ); ?> ">
				<?php
				
				if ( $key === 'logo' ) {
					
					$logo_option = empty($is_sticky_content) ? $nav_logo_select : $nav_sticky_logo_select;
					
					?>
					<div class="floral-nav-logo">
						<div class="__nav-logo">
							<?php echo Floral_Image::logo( $logo_option ); ?>
						</div>
					</div>
					<?php
				} elseif ( $key === 'main-menu' ) {
						echo $main_menu;
				} elseif ( $key === 'cart' && function_exists( 'wc_get_cart_url' ) ) {
					// dark, light, transparent
					$mini_cart_theme = floral_get_option( 'shop-mini-cart-theme', '', 'theme-dark' );
					if ( empty( $mini_cart_theme ) ) {
						$mini_cart_theme = 'theme-dark';
					}
					
					$show_minicart = ! is_cart() && ! is_checkout();
					
					$scroll_bar_theme = ( $mini_cart_theme === 'theme-dark' ) ? 'light' : 'dark';
					?>
					<div class="floral-mini-cart woocommerce dropdown">
						<a class="__cart-toggle" href="<?php echo wc_get_cart_url(); ?>">
							<i class="floral-block-icon <?php echo floral_get_option( 'shop-cart-icon' ); ?>"></i>
							<span class="__number-product"></span>
						</a>
						<div class="__cart-wrapper <?php floral_the_clean_html_classes( $mini_cart_theme ); ?>" data-scrollbar-theme="<?php echo esc_attr( $scroll_bar_theme ); ?>" data-allow-minicart="<?php echo esc_attr( $show_minicart ); ?>">
							<div class="widget_shopping_cart_content"></div>
						</div>
					</div>
					<?php
					
				} elseif ( $key === 'search' ) {
					?>
					<div class="floral-search-button-caller">
						<a href="javascript:void(0);" onclick="floral.page.popup('floral-search', 'popup')">
							<i class="floral-block-icon <?php echo floral_get_option( 'nav-search-icon' ) ?>"></i>
						</a>
					</div>
					<?php
				} elseif ( $key === 'popup' ) {
					$popup_type    = floral_get_option( 'nav-module-popup-type' );
					$popup_content = floral_get_option( 'nav-module-popup-' . $popup_type );
					$popup_id      = floral_add_popup_item( array( 'type'    => $popup_type,
					                                               'content' => $popup_content
					) );
					?>
					<div class="floral-popup-caller">
						<a href="javascript:void(0);" onclick="floral.page.popup('<?php echo esc_attr( $popup_type ) ?>', '<?php echo esc_attr( $popup_content ) ?>')">
							<i class="floral-block-icon <?php echo floral_get_option( 'nav-toggle-popup-icon' ); ?>"></i>
						</a>
					</div>
					<?php
				} elseif ( $key === 'toggle-leftzone' ) {
					?>
					<div class="floral-subzone-caller floral-leftzone-caller">
						<a href="javascript:void(0);" onclick="floral.page.page_leftzone()">
							<i class="floral-block-icon <?php echo floral_get_option( 'nav-toogle-leftzone-icon' ); ?>"></i>
						</a>
					</div>
					<?php
				} elseif ( $key === 'toggle-rightzone' ) {
					?>
					<div class="floral-subzone-caller floral-rightzone-caller">
						<a href="javascript:void(0);" onclick="floral.page.page_rightzone()">
							<i class="floral-block-icon <?php echo floral_get_option( 'nav-toogle-rightzone-icon' ); ?>"></i>
						</a>
					</div>
					<?php
				} elseif ( $key === 'custom-content' ) {
					$custom_content = floral_get_meta_or_option( 'nav-custom-content' );
					if ( ! empty( $custom_content ) ) {
						?>
						<div class="floral-nav-custom-content">
							<?php
							echo do_shortcode( ( $custom_content ) );
							?>
						</div>
						<?php
					}
				}
				?>
			</div>
		<?php endforeach; ?>
	</div>
</div>