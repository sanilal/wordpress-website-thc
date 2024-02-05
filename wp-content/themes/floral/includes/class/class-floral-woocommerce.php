<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-woocommerce.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_Woocommerce extends Floral_Base {
	
	function __construct() {
		require_once floral_theme_dir() . 'includes/common/woocommerce.php';
		parent::__construct();
		self::init_quick_view_features();
	}
	
	function add_actions() {
		/*-------------------------------------
			remove actions
		---------------------------------------*/
		// PRODUCT ARCHIVE ---------------------------------------------------------
		
		// remove default product link
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
		
		// remove default add to cart button
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		// remove loop price with priority 10
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		//
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		
		// show or hide product rating in archive product
		$product_show_rating = floral_get_option( 'product-archive-show-rating' );
		if ( empty( $product_show_rating ) ) {
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		}
		
		// show or hide result count in archive product
		$product_archive_show_result_count = floral_get_option( 'product-archive-show-result-count' );
		if ( empty( $product_archive_show_result_count ) ) {
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		}
		
		// show or hide catalog ordering in archive product
		$product_archive_show_catalog_ordering = floral_get_option( 'product-archive-show-catalog-ordering' );
		if ( empty( $product_archive_show_catalog_ordering ) ) {
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		}
		
		// show or hide sale flash mode in archive product
		$product_archive_sale_flash = floral_get_option( 'product-archive-sale-flash' );
		if ( empty( $product_archive_sale_flash ) ) {
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
		}
		
		// PRODUCT SINGLE ---------------------------------------------------------
		// sale flash
		$product_single_sale_flash = floral_get_option( 'product-single-sale-flash' );
		if ( empty( $product_single_sale_flash ) ) {
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		}
		
		// add to cart button
		$product_single_add_to_cart_btn = floral_get_option( 'product-single-add-to-cart-btn' );
		if ( empty( $product_single_add_to_cart_btn ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		}
		
		// rating
		$product_single_product_rating = floral_get_option( 'product-single-product-rating' );
		if ( empty( $product_single_product_rating ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		}
		
		// product meta
		$product_single_product_meta = floral_get_option( 'product-single-product-meta' );
		if ( empty( $product_single_product_meta ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
		
		// share icons
		$product_single_sharing_icons = floral_get_option( 'product-single-sharing-icons' );
		if ( empty( $product_single_sharing_icons ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		}
		// related products
		$product_single_related_products = floral_get_option( 'product-single-related-products' );
		if ( empty( $product_single_related_products ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
		
		/*-------------------------------------
			add actions
		---------------------------------------*/
		// PRODUCT ARCHIVE ---------------------------------------------------------
		// show or hide add to cart button in archive product
//        $product_archive_add_to_cart_btn = floral_get_option( 'product-archive-add-to-cart-btn' );
//        if ( !empty( $product_archive_add_to_cart_btn ) ) {
//            // add add-to-cart button
//            add_action( 'floral_woocommerce_product_actions', 'woocommerce_template_loop_add_to_cart' );
//        }
		
		// show or hide secondary image on hover in archive product
		$product_archive_secondary_image_on_hover = floral_get_option( 'product-archive-secondary-image-on-hover' );
		if ( ! empty( $product_archive_secondary_image_on_hover ) ) {
			add_action( 'woocommerce_before_shop_loop_item_title', array(
				__CLASS__,
				'template_secondary_image_on_hover'
			), 13 );
		}
		
		$shop_quick_view = floral_get_option( 'shop-quick-view' );
		if ( ! empty( $shop_quick_view ) ) {
			add_action( 'woocommerce_before_shop_loop_item_title', array( __CLASS__, 'template_quick_view' ) );
		}
		
		// add product link
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 15 );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 20 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );
		
		// add product categories template
//		$get_display_type = floral_get_option( 'product-archive-display-type', '', '' );
//		if ( in_array( $get_display_type, array( 'classic', 'modern' ) ) ) {
//			add_action( 'woocommerce_after_shop_loop_item_title', array(
//				__CLASS__,
//				'template_product_categories'
//			), 3 );
//		}
		
		// loop price with priority 1
//        add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 1 );
		add_action( 'woocommerce_after_shop_loop_item_title', array(
			__CLASS__,
			'display_button_and_add_to_cart'
		), 10 );
		
		// cart
		add_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 11 );
		
		// new product
//        add_action( 'woocommerce_product_options_general_product_data', array( __CLASS__, 'new_product_option' ) );
		
		// PRODUCT SINGLE ---------------------------------------------------------
		
		
		/*-------------------------------------
			CART ACTIONS
		---------------------------------------*/
		add_action( 'wp_loaded', array( __CLASS__, 'empties_the_cart' ) );

        /*-------------------------------------
            Loop shop columns
        ---------------------------------------*/
        add_filter( 'loop_shop_columns', array( __CLASS__, 'get_loop_shop_columns' ) );

	}
	
	function add_filters() {
		add_filter( 'loop_shop_per_page', array( __CLASS__, 'products_per_page' ) );
		add_filter( 'single_product_archive_thumbnail_size', array(
			__CLASS__,
			'single_product_archive_thumbnail_size'
		) );
		
		// number related products
		add_filter( 'woocommerce_output_related_products_args', array( __CLASS__, 'amount_of_products_in_related' ) );
		
		// remove filters
		
	}
	
	/**
	 * Products per page
	 *
	 * @param $current
	 *
	 * @return bool|int|null
	 */
	static function products_per_page( $current ) {
		$pa_products_per_page = isset( $_GET['item_per_page'] ) ? $_GET['item_per_page'] : floral_get_option( 'product-archive-item-per-page' );
		
		$pa_products_per_page = intval( $pa_products_per_page );
		
		if ( empty( $pa_products_per_page ) ) {
			$pa_products_per_page = 12;
		}
		
		return $pa_products_per_page;
	}
	
	static function amount_of_products_in_related( $current ) {
		$ps_products_related = floral_get_option( 'product-single-related-products-amount' );
		
		
		$ps_products_related = intval( $ps_products_related );
		
		if ( ! empty( $ps_products_related ) ) {
			$current['posts_per_page'] = $ps_products_related;
		}
		
		return $current;
	}
	
	/**
	 * Categories template for product archive
	 */
	static function template_product_categories() {
		wc_get_template( 'loop/categories.php' );
	}
	
	
	/**
	 * Get secondary image on hover
	 */
	static function template_secondary_image_on_hover( $get_custom_size = false, $size = '' ) {
		global $product;
		$gallery_images = $product->get_gallery_image_ids();
		if ( is_array( $gallery_images ) && count( $gallery_images ) > 0 ) {
			if ( $get_custom_size === true && ! empty( $size ) ) {
				$img_attr['extra-class'] = 'product-secondary-image';
				$img_attr['ratio']       = 'original';
				$img_attr['alt']         = 'image';
				echo Floral_Image::get_image( $gallery_images[0], $size, $img_attr );
			} else {
				echo wp_get_attachment_image( $gallery_images[0], apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' ), false, array( 'class' => 'product-secondary-image' ) );
			}
		}
	}
	
	static function template_quick_view() {
		wc_get_template( 'loop/quick-view.php' );
	}
	
	/**
	 * get_current_product_archive_display_type
	 *
	 * @return bool|null|string
	 */
	static function get_current_product_archive_display_type() {
		global $floral_current_product_archive_display_type;

//		if ( empty( $floral_current_product_archive_display_type ) ) {
//			$_display_type = isset( $_GET['display-type'] ) ? $_GET['display-type'] : '';
//			if ( ! in_array( $_display_type, array( 'simple', 'classic', 'modern' ) ) ) {
//				$_display_type = floral_get_option( 'product-archive-display-type', '', '' );
//			}
//			$floral_current_product_archive_display_type = $_display_type;
//		}
		
		$floral_current_product_archive_display_type = 'standard';
		
		return $floral_current_product_archive_display_type;
	}
	
	static function set_current_product_archive_display_type( $display_type ) {
		global $floral_current_product_archive_display_type;
//		if ( in_array( $display_type, array( 'simple', 'classic', 'modern' ) ) ) {
//			$floral_current_product_archive_display_type = $display_type;
//		}
	}
	
	static function reset_current_product_archive_display_type() {
		global $floral_current_product_archive_display_type;
//		$floral_current_product_archive_display_type = floral_get_option( 'product-archive-display-type', '', '' );
		$floral_current_product_archive_display_type = 'standard';
	}
	
	/**
	 * Display price and add to cart button ()
	 */
	
	static function display_button_and_add_to_cart() {
		$product_archive_add_to_cart_btn = floral_get_option( 'product-archive-add-to-cart-btn' );
		$show_button                     = false;
		$block_meta_class                = '';
		
		if ( ! empty( $product_archive_add_to_cart_btn ) && function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {
			// add add-to-cart button
			$show_button      = true;
			$block_meta_class = 'show-add-to-cart';
		}
		
		echo '<div class="__block-meta-wrapper"><div class="__block-meta ' . $block_meta_class . '">';
		wc_get_template( 'loop/price.php' );
		
		if ( $show_button === true ) {
			woocommerce_template_loop_add_to_cart();
		}
		echo '</div></div>';
	}
	
	/**
	 * Change image size to shop single when using display type modern
	 *
	 * @param $image_size
	 *
	 * @return string
	 */
	static function single_product_archive_thumbnail_size( $image_size ) {
		if ( self::get_current_product_archive_display_type() === 'modern' ) {
			$image_size = 'shop_single';
		}
		
		return $image_size;
	}
	
	/**
	 * get custom thumbnail size
	 *
	 * @param $image_size
	 *
	 * @return string
	 */
	static function get_custom_size_thumbnail( $get_custom_size = false, $size = '' ) {
		global $product;
		$feature_image = get_post_thumbnail_id($product->get_id());
		if ( !empty($feature_image) ) {
			if ( $get_custom_size === true && ! empty( $size ) ) {
				$img_attr['extra-class'] = 'wp-post-image';
				$img_attr['ratio']       = 'original';
				$img_attr['alt']         = 'image';
				echo Floral_Image::get_image( $feature_image, $size, $img_attr );
			}
		}
	}
	
	static function new_product_option() {
		echo '<div class="options_group">';
		woocommerce_wp_checkbox(
			array(
				'id'          => 'floral_new_product',
				'label'       => esc_html__( 'Is a new product?', 'floral' ),
				'description' => esc_html__( 'Check it if this is a new product.', 'floral' )
			)
		);
		echo '</div>';
	}
	
	static function init_quick_view_features() {
		add_filter( 'body_class', function ( $classes ) {
			if ( floral_get_option( 'shop-quick-view' ) ) {
				$classes[] = 'product-quick-view-enabled';
				
				if ( floral_get_option( 'shop-quick-view-nav' ) ) {
					$classes[] = 'product-quick-view-nav-enabled';
				}
			}
			
			if ( floral_get_option( 'shop-mini-cart-ajax-actions' ) ) {
				$classes[] = 'mini-cart-ajax-actions-enabled';
			}
			
			global $post;
			
			if ( class_exists( 'Floral_WC_Shortcodes' ) ) {
				$shortcodes = Floral_WC_Shortcodes::get_shortcode_list();
				
				if ( ! empty( $post ) ) {
					foreach ( $shortcodes as $shortcode => $function ) {
						if ( strpos( $post->post_content, '[' . $shortcode ) !== false ) {
							$classes[] = 'woocommerce';
							$classes[] = 'woocommerce-page';
							break;
						}
					}
				}
			}
			
			
			return $classes;
		}, 20 );
	}
	
	static function empties_the_cart() {
		if ( isset( $_GET['empty-cart'] ) ) {
			function_exists( 'WC' ) && WC()->cart->empty_cart();
		}
	}
	
	static function get_empty_cart_url() {
		global $wp;
		
		$empty_cart_url = home_url( add_query_arg( array( 'empty-cart' => '' ), $wp->request ) );
		
		return $empty_cart_url;
	}

    /**
     * Get current loop shop columns from theme options
     * @param $columns
     *
     * @return bool|null
     */
	static function get_loop_shop_columns($columns) {
	    return isset($_GET['numcols'])
            ? $_GET['numcols']
            : floral_get_option( 'product-archive-display-columns', '', '3' );
    }
}