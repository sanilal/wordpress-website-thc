<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-importer.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
	define( 'WP_LOAD_IMPORTERS', true );
}

if ( ! class_exists( 'WP_Import_N' ) ) {
	require_once floral_theme_dir() . 'includes/admin-panel/floral-install-demo/wordpress-importer/wordpress-importer.php';
}


class Floral_Importer extends WP_Import_N {
	const DEFAULT_POST_STEPS = 10;
	const _MC4WP_DEFAULT_FORM_ID = 'mc4wp_default_form_id';
	
	
	var $_data_demo = 'floral_data_demo.log';
	var $_processed_posts = 'floral_current_processed_posts.log';
	var $_processed_terms = 'floral_current_processed_terms.log';
	var $_processed_menu_items = 'floral_current_processed_menu_items.log';
	var $_menu_items_orphans = 'floral_current_menu_item_orphans.log';
	var $_missing_menu_items = 'floral_current_missing_menu_items.log';
	var $_url_remap = 'floral_current_url_remap.log';
	var $_post_orphans = 'floral_current_post_orphans.log';
	var $_featured_images = 'floral_current_featured_images.log';
	
	var $data_demo_path;
	var $data_options_path;
	var $data_update_path;
	var $data_revslider_path;
	
	
	var $demo_blog_path;
	
	/**
	 * Floral_Importer constructor.
	 *
	 * @param      $demo_data_path
	 * @param      $demo_blog_path
	 * @param bool $fetching_image
	 */
	function __construct( $demo_data_path, $demo_blog_path, $fetching_image = true ) {
		// config path
		$this->data_demo_path      = $demo_data_path . DIRECTORY_SEPARATOR . 'data-demo.xml';
		$this->data_options_path   = $demo_data_path . DIRECTORY_SEPARATOR . 'data-options.json';
		$this->data_update_path    = $demo_data_path . DIRECTORY_SEPARATOR . 'data-update.json';
		$this->data_revslider_path = $demo_data_path . DIRECTORY_SEPARATOR . 'revslider';
		
		$this->_data_demo = $demo_data_path . DIRECTORY_SEPARATOR . $this->_data_demo;
		
		$this->_processed_posts      = $demo_data_path . DIRECTORY_SEPARATOR . $this->_processed_posts;
		$this->_processed_terms      = $demo_data_path . DIRECTORY_SEPARATOR . $this->_processed_terms;
		$this->_processed_menu_items = $demo_data_path . DIRECTORY_SEPARATOR . $this->_processed_menu_items;
		$this->_menu_items_orphans   = $demo_data_path . DIRECTORY_SEPARATOR . $this->_menu_items_orphans;
		$this->_missing_menu_items   = $demo_data_path . DIRECTORY_SEPARATOR . $this->_missing_menu_items;
		$this->_url_remap            = $demo_data_path . DIRECTORY_SEPARATOR . $this->_url_remap;
		$this->_post_orphans         = $demo_data_path . DIRECTORY_SEPARATOR . $this->_post_orphans;
		$this->_featured_images      = $demo_data_path . DIRECTORY_SEPARATOR . $this->_featured_images;
		
		
		// this is for re-update site url
		$this->demo_blog_path = $demo_blog_path;
		//set $fetch_attachments
		$this->fetch_attachments = $fetching_image;
		
		add_action( 'wp_import_insert_post', array( __CLASS__, 'update_mc4wp_default_form_id' ), 10, 4 );
	}
	
	/**
	 * Override the default import start function
	 *
	 * @return string
	 */
	function _import_start() {
		if ( ! is_file( $this->data_demo_path ) ) {
			return 'false';
		}
		
		$import_data = floral_get_file_contents( $this->_data_demo );
		$import_data = json_decode( $import_data, true );
		
		if ( empty( $import_data ) ) {
			$import_data = $this->parse( $this->data_demo_path );
			if ( is_wp_error( $import_data ) ) {
				return 'error';
			}
			floral_put_file_content( $this->_data_demo, json_encode( $import_data ) );
		}
		
		
		$this->version = $import_data['version'];
		$this->get_authors_from_import( $import_data );
		$this->posts      = $import_data['posts'];
		$this->terms      = $import_data['terms'];
		$this->categories = $import_data['categories'];
		$this->tags       = $import_data['tags'];
		$this->base_url   = esc_url( $import_data['base_url'] );
		
		wp_defer_term_counting( true );
		wp_defer_comment_counting( true );
		
		do_action( 'import_start' );
		
		$this->load_last_transition_data();
		
		return 'true';
	}
	
	function load_last_transition_data() {
		$pt = floral_get_file_contents( $this->_processed_terms );
		$pt = json_decode( $pt, true );
		if ( ! empty( $pt ) && is_array( $pt ) ) {
			$this->processed_terms = $pt;
		}
		
		$pp = floral_get_file_contents( $this->_processed_posts );
		$pp = json_decode( $pp, true );
		if ( ! empty( $pp ) && is_array( $pp ) ) {
			$this->processed_posts = $pp;
		}
		
		$pmt = floral_get_file_contents( $this->_processed_menu_items );
		$pmt = json_decode( $pmt, true );
		if ( ! empty( $pmt ) && is_array( $pmt ) ) {
			$this->processed_menu_items = $pmt;
		}
		
		$mmt = floral_get_file_contents( $this->_missing_menu_items );
		$mmt = json_decode( $mmt, true );
		if ( ! empty( $mmt ) && is_array( $mmt ) ) {
			$this->missing_menu_items = $mmt;
		}
		
		$mio = floral_get_file_contents( $this->_menu_items_orphans );
		$mio = json_decode( $mio, true );
		if ( ! empty( $mio ) && is_array( $mio ) ) {
			$this->menu_item_orphans = $mio;
		}
		
		$urm = floral_get_file_contents( $this->_url_remap );
		$urm = json_decode( $urm, true );
		if ( ! empty( $urm ) && is_array( $urm ) ) {
			$this->url_remap = $urm;
		}
		
		$pop = floral_get_file_contents( $this->_post_orphans );
		$pop = json_decode( $pop, true );
		if ( ! empty( $pop ) && is_array( $pop ) ) {
			$this->post_orphans = $pop;
		}
		
		$fm = floral_get_file_contents( $this->_featured_images );
		$fm = json_decode( $fm, true );
		if ( ! empty( $fm ) && is_array( $fm ) ) {
			$this->featured_images = $fm;
		}
	}
	
	function save_current_transition_data() {
		floral_put_file_content( $this->_processed_terms, json_encode( $this->processed_terms ) );
		floral_put_file_content( $this->_processed_posts, json_encode( $this->processed_posts ) );
		floral_put_file_content( $this->_processed_menu_items, json_encode( $this->processed_menu_items ) );
		floral_put_file_content( $this->_missing_menu_items, json_encode( $this->missing_menu_items ) );
		floral_put_file_content( $this->_menu_items_orphans, json_encode( $this->menu_item_orphans ) );
		floral_put_file_content( $this->_url_remap, json_encode( $this->url_remap ) );
		floral_put_file_content( $this->_post_orphans, json_encode( $this->post_orphans ) );
		floral_put_file_content( $this->_featured_images, json_encode( $this->featured_images ) );
	}
	
	function delete_last_transition_data() {
        @unlink( $this->_data_demo );
		
		@unlink( $this->_processed_terms );
		@unlink( $this->_processed_posts );
		@unlink( $this->_processed_menu_items );
		@unlink( $this->_missing_menu_items );
		@unlink( $this->_menu_items_orphans );
		@unlink( $this->_url_remap );
		@unlink( $this->_post_orphans );
		@unlink( $this->_featured_images );
		
		delete_transient( self::_MC4WP_DEFAULT_FORM_ID );
	}
	
	/**
	 * Import end
	 */
	function _import_end() {
		wp_import_cleanup( $this->id );
		
		wp_cache_flush();
		foreach ( get_taxonomies() as $tax ) {
			delete_option( "{$tax}_children" );
			_get_term_hierarchy( $tax );
		}
		
		wp_defer_term_counting( false );
		wp_defer_comment_counting( false );
		
		do_action( 'import_end' );
	}
	
	/**
	 * Import categories
	 *
	 * @return false|string
	 */
	function _import_categories() {
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );
		
		$parse_rs = $this->_import_start();
		if ( $parse_rs == 'false' ) {
			return $this->__return( 'error', esc_html__( 'Data file not found.', 'floral' ) );
		} elseif ( $parse_rs == 'error' ) {
			return $this->__return( 'error', esc_html__( 'Parsing data error.', 'floral' ) );
		}
		wp_suspend_cache_invalidation( true );
		
		$import_cats_rs = $this->process_categories();
//        $import_cats_rs = 'true';
		
		wp_suspend_cache_invalidation( false );
		
		$this->save_current_transition_data();
		
		switch ( $import_cats_rs ) {
			case 'false':
				return $this->__return( 'info', esc_html__( 'No category to import.', 'floral' ) );
			case 'true':
				return $this->__return( 'success', esc_html__( 'Import categories success.', 'floral' ) );
			default:
				return $this->__return( 'warning', $import_cats_rs );
		}
	}
	
	
	/**
	 * Import tags
	 *
	 * @return false|string
	 */
	function _import_tags() {
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );
		
		$parse_rs = $this->_import_start();
		if ( $parse_rs == 'false' ) {
			return $this->__return( 'error', esc_html__( 'Data file not found.', 'floral' ) );
		} elseif ( $parse_rs == 'error' ) {
			return $this->__return( 'error', esc_html__( 'Parsing data error.', 'floral' ) );
		}
		
		
		wp_suspend_cache_invalidation( true );
		$import_tags_rs = $this->process_tags();
//        $import_tags_rs = 'true';
		wp_suspend_cache_invalidation( false );
		
		$this->save_current_transition_data();
		
		switch ( $import_tags_rs ) {
			case 'false':
				return $this->__return( 'info', esc_html__( 'No tag to import.', 'floral' ) );
			case 'true':
				return $this->__return( 'success', esc_html__( 'Import tags success.', 'floral' ) );
			default:
				return $this->__return( 'warning', $import_tags_rs );
		}
	}
	
	
	/**
	 * Import terms
	 * @return false|string
	 */
	function _import_terms() {
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );
		
		$parse_rs = $this->_import_start();
		if ( $parse_rs == 'false' ) {
			return $this->__return( 'error', esc_html__( 'Data file not found.', 'floral' ) );
		} elseif ( $parse_rs == 'error' ) {
			return $this->__return( 'error', esc_html__( 'Parsing data error.', 'floral' ) );
		}
		
		wp_suspend_cache_invalidation( true );
		$import_terms_rs = $this->process_terms();
//        $import_terms_rs = 'true';
		
		wp_suspend_cache_invalidation( false );
		
		$this->save_current_transition_data();
		
		switch ( $import_terms_rs ) {
			case 'false':
				return $this->__return( 'info', esc_html__( 'No term to import.', 'floral' ) );
			case 'true':
				return $this->__return( 'success', esc_html__( 'Import terms success.', 'floral' ) );
			default:
				return $this->__return( 'warning', $import_terms_rs );
		}
	}
	
	/**
	 * Import posts
	 *
	 * @param $last_point
	 *
	 * @return false|string
	 */
	function _import_posts( $last_point ) {
		add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );
		
		$parse_rs = $this->_import_start();
		if ( $parse_rs == 'false' ) {
			return $this->__return( 'error', esc_html__( 'Data file not found.', 'floral' ) );
		} elseif ( $parse_rs == 'error' ) {
			return $this->__return( 'error', esc_html__( 'Parsing data error.', 'floral' ) );
		}
		
		wp_suspend_cache_invalidation( true );
		$import_posts_rs = $this->_process_posts( $last_point );
//        $import_posts_rs = 'true';
		wp_suspend_cache_invalidation( false );
		
		$this->save_current_transition_data();
		
		switch ( $import_posts_rs ) {
			case 'true':
				return $this->__return( 'success', esc_html__( 'Import posts success.', 'floral' ) );
				break;
			default:
				$process = $import_posts_rs['process'];
				$fail    = $import_posts_rs['fail'];
				if ( empty( $fail ) ) {
					return $this->__return( 'info', esc_html__( 'Importing posts...', 'floral' ), $process );
				} else {
					return $this->__return( 'warning', sprintf( esc_html__( 'Importing posts..., Warning: %s', 'floral' ), $fail ), $process );
				}
				break;
		}
		
	}
	
	/**
	 * Update information and cleanup
	 * @return false|string
	 */
	function _update_information_and_cleanup() {
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );
		
		$parse_rs = $this->_import_start();
		if ( $parse_rs == 'false' ) {
			return $this->__return( 'error', esc_html__( 'Data file not found.', 'floral' ) );
		} elseif ( $parse_rs == 'error' ) {
			return $this->__return( 'error', esc_html__( 'Parsing data error.', 'floral' ) );
		}
//        ob_start();
//        var_dump($this->missing_menu_items);
//        error_log(ob_get_clean());
		
		$this->backfill_parents();
		$this->backfill_attachment_urls();
		$this->remap_featured_images();
		
		$this->_import_end();
		
		return $this->__return( 'success', esc_html__( 'Demo Data Import Done!', 'floral' ) );
	}
	
	
	/**
	 * Return message
	 *
	 * @param        $status
	 * @param        $message
	 *
	 * @param string $process
	 *
	 * @return array
	 */
	function __return( $status, $message, $process = 'complete' ) {
		if ( $status == 'error' ) {
			$this->delete_last_transition_data();
		}
		
		return array(
			'status'  => $status,
			'message' => $message,
			'process' => $process
		);
	}
	
	
	/**
	 * Check data files
	 *
	 * @param array $options
	 *
	 * @return false|string
	 */
	function check_data_file( array $options ) {
		$warning = array();
		
		$this->delete_last_transition_data();
		
		if ( isset( $options[0] ) && $options[0] == 1 ) {
			if ( empty( $this->data_demo_path ) || ! file_exists( $this->data_demo_path ) ) {
				return $this->__return( 'error', esc_html__( 'Missing data-demo.xml file.', 'floral' ) );
			}
		}
		
		
		if ( isset( $options[2] ) && $options[2] == 1 ) {
			if ( empty( $this->data_options_path ) || ! file_exists( $this->data_options_path ) ) {
				return $this->__return( 'error', esc_html__( 'Missing data-options.json file.', 'floral' ) );
			}
			
			if ( empty( $this->data_update_path ) || ! file_exists( $this->data_update_path ) ) {
				$warning[] = esc_html__( 'Missing data-update.json file, the site will not work properly', 'floral' );
			}
		}
		
		if ( isset( $options[3] ) && $options[3] == 1 ) {
			if ( empty( $this->data_revslider_path ) || ! file_exists( $this->data_revslider_path ) ) {
				$warning[] = esc_html__( 'Missing revslider folder, the installation does not import revolution slider.', 'floral' );
			}
		}
		
		if ( count( $warning ) > 0 ) {
			return $this->__return( 'warning', sprintf( esc_html__( 'Data files loaded, WARNING: %s', 'floral' ), implode( ', ', $warning ) ) );
		}
		
		return $this->__return( 'success', esc_html__( 'Data files loaded.', 'floral' ) );
	}
	
	/**
	 * Import data options
	 * @return false|string
	 */
	function import_data_options() {
		
		if ( ! file_exists( $this->data_options_path ) ) {
			return $this->__return( 'error', esc_html__( 'Data options file not found', 'floral' ) );
		}
		
		$_options = floral_get_file_contents( $this->data_options_path );
		$_options = json_decode( $_options, true );
		
		$fail = array();
		global $wpdb;
		// import woocommerce attribute taxonomy
		if ( isset( $_options['_woocommerce_attr_taxs'] ) ) {
			if ( floral_is_woocommerce_active() ) {
				$_woocommerce_attr_taxs = $_options['_woocommerce_attr_taxs'];
				if ( isset( $_woocommerce_attr_taxs['option_value'] ) && is_array( $_woocommerce_attr_taxs['option_value'] ) ) {
					foreach ( $_woocommerce_attr_taxs['option_value'] as $attr_tax ) {
						$query = $wpdb->prepare(
							"INSERT INTO {$wpdb->prefix}woocommerce_attribute_taxonomies(`attribute_id`, `attribute_name`,
`attribute_label`, `attribute_type`, `attribute_orderby`, `attribute_public`) VALUE(%s, %s, %s, %s, %s, %s);",
							$attr_tax['attribute_id'], $attr_tax['attribute_name'], $attr_tax['attribute_label'],
							$attr_tax['attribute_type'], $attr_tax['attribute_orderby'], $attr_tax['attribute_public'] );
						
						ob_start();
						$rs = $wpdb->query( $query );
						ob_clean();
						
						if ( $rs === false ) {
							$fail[] = $attr_tax['attribute_name'];
						}
					}
				}
				
				delete_transient( 'wc_attribute_taxonomies' );
			}
			unset( $_options['_woocommerce_attr_taxs'] );
		}
		
		// check mc4wp_default_form_id
		if ( isset( $_options['mc4wp_default_form_id'] ) ) {
			if ( floral_is_plugin_active( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
				if ( isset( $_options['mc4wp_default_form_id']['option_value'] ) ) {
					set_transient( self::_MC4WP_DEFAULT_FORM_ID, $_options['mc4wp_default_form_id']['option_value'] );
				}
			}
			unset( $_options['mc4wp_default_form_id'] );
		}
		
		
		// import into options table
		foreach ( $_options as $option_name => $value ) {
			if ( get_option( $option_name ) === false ) {
				$query = $wpdb->prepare( "INSERT INTO $wpdb->options(`option_name`, `option_value`, `autoload`) VALUE(%s, %s, %s);", $option_name, $value['option_value'], $value['autoload'] );
			} else {
				$query = $wpdb->prepare( "UPDATE $wpdb->options SET `option_value` = %s, `autoload` = %s WHERE option_name = %s;", $value['option_value'], $value['autoload'], $option_name );
			}
			$rs = $wpdb->query( $query );
			if ( $rs === false ) {
				$fail[] = $option_name;
			}
		}
		
		if ( count( $fail ) > 0 ) {
			return $this->__return( 'warning', sprintf( esc_html__( 'All options imported, fail to save these options: %s', 'floral' ), implode( ', ', $fail ) ) );
		}
		
		return $this->__return( 'success', esc_html__( 'All options imported.', 'floral' ) );
	}
	
	/**
	 * Import revolution slider
	 *
	 * @param string $process
	 *
	 * @return false|string
	 */
	function import_revslider( $process = '' ) {
		
		if ( ! floral_is_plugin_active( 'revslider/revslider.php' ) || ! class_exists( 'RevSlider' ) ) {
			return $this->__return( 'warning', esc_html__( 'Doesn\'t import revolution slider.', 'floral' ) );
		}

//        return $this->__return( 'success', esc_html__( "Import Revolution Slider Success", 'floral') );
		
		if ( isset( $this->data_revslider_path ) && is_dir( $this->data_revslider_path ) ) {
			if ( ! empty( $process ) ) {
				$process = explode( '||', $process );
				unset( $process[0] );
			} else {
				$process = array();
			}
			$process_ = array_merge( $process, array( '.', '..' ) );
			
			//
			$import = false;
			$fail   = array();
			
			$files = scandir( $this->data_revslider_path );
			if ( $files !== false ) {
				$count_zip = self::count_zip( $files );
				
				foreach ( $files as $entry ) {
					if ( in_array( $entry, $process_ ) || strpos( $entry, '.zip' ) === false ) {
						continue;
					}
					
					try {
						ob_start();
						$slider = new RevSlider();
						$rs     = @$slider->importSliderFromPost( true, true, $this->data_revslider_path . DIRECTORY_SEPARATOR . $entry );
						ob_clean();
						
						if ( is_array( $rs ) && ! empty( $rs['success'] ) ) {
							if ( $rs['success'] == false ) {
								$fail[] = $entry;
							}
						}
					} catch ( Exception $e ) {
						$fail[] = $e->getMessage();
					}
					
					$import    = true;
					$process[] = $entry;
					array_unshift( $process, $count_zip );
					break;
				}
				
				if ( $import ) {
					if ( empty( $fail ) ) {
						return $this->__return( 'waring', sprintf( esc_html__( "Import Revolution Slider...", 'floral' ) ), implode( '||', $process ) );
					} else {
						return $this->__return( 'waring', sprintf( esc_html__( "Import Revolution Slider..., WARNING: Fail to import %s", 'floral' ), implode( ', ', $fail ) ), implode( '||', $process ) );
					}
				} else {
					if ( empty( $process ) ) {
						return $this->__return( 'success', esc_html__( "No Revolution Slider Imported", 'floral' ) );
					} else {
						return $this->__return( 'success', esc_html__( "Import Revolution Slider Success", 'floral' ) );
					}
				}
			} else {
				return $this->__return( 'info', esc_html__( 'Error when reading revslider folder. Please checking file permission on theme folder.', 'floral' ) );
			}
			
		} else {
			return $this->__return( 'info', esc_html__( 'No revolution slider data specified.', 'floral' ) );
		}
	}
	
	/**
	 * Count .zip file in a an array
	 *
	 * @param $array
	 *
	 * @return int
	 */
	static function count_zip( $array ) {
		$count = 0;
		foreach ( $array as $item ) {
			if ( strpos( $item, '.zip' ) !== false ) {
				$count ++;
			}
		}
		
		return $count;
	}
	
	/**
	 * Update data changed using data-update.json files
	 * @return false|string
	 */
	function update_data_changed() {
		global $wpdb;
		
		$site_url = site_url();
		$site_url = trailingslashit( $site_url );
		str_replace( array( 'http://', 'https://' ), '', $site_url );
		
		$import_data = floral_get_file_contents( $this->_data_demo );
		$import_data = json_decode( $import_data, true );
		
		if ( ! empty( $import_data ) && ! empty( $import_data['base_url'] ) ) {
			$demo_site = $import_data['base_url'] . $this->demo_blog_path;
		} else {
			$demo_site = trailingslashit( Floral_Demo_Installer::DEMO_SITE ) . $this->demo_blog_path;
		}
		str_replace( array( 'http://', 'https://' ), '', $demo_site );
		//
		//UPDATE URL
		//
		// in post guid
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET guid = REPLACE(guid, %s, %s)", $demo_site, $site_url ) );
		
		// menu item url
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key = '_menu_item_url'", $demo_site, $site_url ) );
		
		//post content
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content = REPLACE(post_content, %s, %s)", urlencode( $demo_site ), urlencode( $site_url ) ) );
		
		// vc shortcode
		$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_key = '_wpb_shortcodes_custom_css'", $demo_site, $site_url ) );
		
		//
		// Re-update terms count field
		//
		$wpdb->query( "UPDATE $wpdb->term_taxonomy tt SET count = (SELECT count(p.ID) FROM $wpdb->term_relationships tr LEFT JOIN $wpdb->posts p ON (p.ID = tr.object_id AND p.post_status = 'publish') WHERE tr.term_taxonomy_id = tt.term_taxonomy_id)" );
		
		if ( file_exists( $this->data_update_path ) ) {
			$data_update = (array) json_decode( floral_get_file_contents( $this->data_update_path ), true );
			
			//
			// Update page on front and page for posts id
			//
			if ( ! empty( $data_update['page'] ) ) {
				foreach ( (array) $data_update['page'] as $item => $value ) {
					$page = get_page_by_path( $value );
					if ( $page ) {
						update_option( $item, $page->ID );
					}
				}
			}
			
			//
			// update menu location and theme mods
			//
			$theme_mode = get_option( 'theme_mods_' . Floral_Demo_Installer::DEMO_THEME_MOD );
			
			// update menu locations
			if ( ! empty( $theme_mode['nav_menu_locations'] ) ) {
				foreach ( $theme_mode['nav_menu_locations'] as $location => $id ) {
					if ( isset( $data_update['nav_menu'][ $id ] ) ) {
						$nav = get_term_by( 'slug', $data_update['nav_menu'][ $id ], 'nav_menu' );
						if ( $nav !== false ) {
							$theme_mode['nav_menu_locations'][ $location ] = $nav->term_id;
						}
					}
				}
			}
			
			update_option( 'theme_mods_' . get_option( 'stylesheet' ), $theme_mode );
			unset( $theme_mode );
			
			//
			// Update nav menu id in widget nav menu
			//
			$widget_nav_menus = get_option( 'widget_nav_menu' );
			if ( ! empty( $widget_nav_menus ) ) {
				foreach ( (array) $widget_nav_menus as $item => $value ) {
					if ( isset( $data_update['nav_menu'][ $value['nav_menu'] ] ) ) {
						$nav = get_term_by( 'slug', $data_update['nav_menu'][ $value['nav_menu'] ], 'nav_menu' );
						if ( $nav !== false ) {
							$widget_nav_menus[ $item ]['nav_menu'] = $nav->term_id;
						}
					}
				}
			}
			update_option( 'widget_nav_menu', $widget_nav_menus );
			unset( $widget_nav_menus );
			
			// floral widget menu
			$floral_widget_menu = get_option( 'widget_floral-widget-menu' );
			if ( ! empty( $floral_widget_menu ) ) {
				foreach ( (array) $floral_widget_menu as $item => $value ) {
					if ( isset( $data_update['nav_menu'][ $value['menu_id'] ] ) ) {
						$nav = get_term_by( 'slug', $data_update['nav_menu'][ $value['menu_id'] ], 'nav_menu' );
						if ( $nav !== false ) {
							$floral_widget_menu[ $item ]['menu_id'] = $nav->term_id;
						}
					}
				}
			}
			update_option( 'widget_floral-widget-menu', $floral_widget_menu );
			unset( $floral_widget_menu );
			
			
			return $this->__return( 'success', esc_html__( 'Update Change Success.', 'floral' ) );
		} else {
			return $this->__return( 'warning', esc_html__( 'Missing data-update.json, the site won\'t work properly! Contact us if see this warning.', 'floral' ) );
		}
		
	}
	
	/**
	 * Process posts
	 *
	 * @param $last_point
	 *
	 * @return string
	 */
	function _process_posts( $last_point ) {
		$this->posts = apply_filters( 'wp_import_posts', $this->posts );
		
		$fail      = array();
		$end_point = $last_point + self::DEFAULT_POST_STEPS;
		
		foreach ( $this->posts as $current_point => $post ) {
			if ( $current_point < $last_point ) {
				continue;
			}
			
			if ( $current_point >= $end_point ) {
				return array(
					'process' => $end_point . '||' . count( $this->posts ),
					'fail'    => implode( ', ', array_unique( $fail ) )
				);
			}
			$post = apply_filters( 'wp_import_post_data_raw', $post );
			
			if ( ! post_type_exists( $post['post_type'] ) ) {
//                printf( esc_html__( 'Failed to import &#8220;%s&#8221;: Invalid post type %s', 'floral' ),
//                    esc_html( $post['post_title'] ), esc_html( $post['post_type'] ) );
//                echo '<br />';
				do_action( 'wp_import_post_exists', $post );
				$fail[] = sprintf( esc_html__( 'Invalid post type %s', 'floral' ), esc_html( $post['post_type'] ) );
				continue;
			}
			
			if ( isset( $this->processed_posts[ $post['post_id'] ] ) && ! empty( $post['post_id'] ) ) {
				continue;
			}
			
			if ( $post['status'] == 'auto-draft' ) {
				continue;
			}
			
			if ( 'nav_menu_item' == $post['post_type'] ) {
				$this->process_menu_item( $post );
				continue;
			}
			
			$post_type_object = get_post_type_object( $post['post_type'] );
			
			$post_exists = post_exists( $post['post_title'], '', $post['post_date'] );
			if ( $post_exists && get_post_type( $post_exists ) == $post['post_type'] ) {
//                printf( esc_html__( '%s &#8220;%s&#8221; already exists.', 'floral' ), $post_type_object->labels->singular_name, esc_html( $post['post_title'] ) );
//                echo '<br />';
				$comment_post_ID = $post_id = $post_exists;
			} else {
				$post_parent = (int) $post['post_parent'];
				if ( $post_parent ) {
					// if we already know the parent, map it to the new local ID
					if ( isset( $this->processed_posts[ $post_parent ] ) ) {
						$post_parent = $this->processed_posts[ $post_parent ];
						// otherwise record the parent for later
					} else {
						$this->post_orphans[ intval( $post['post_id'] ) ] = $post_parent;
						$post_parent                                      = 0;
					}
				}
				
				// map the post author
				$author = sanitize_user( $post['post_author'], true );
				if ( isset( $this->author_mapping[ $author ] ) ) {
					$author = $this->author_mapping[ $author ];
				} else {
					$author = (int) get_current_user_id();
				}
				
				$postdata = array(
					'import_id'      => $post['post_id'],
					'post_author'    => $author,
					'post_date'      => $post['post_date'],
					'post_date_gmt'  => $post['post_date_gmt'],
					'post_content'   => $post['post_content'],
					'post_excerpt'   => $post['post_excerpt'],
					'post_title'     => $post['post_title'],
					'post_status'    => $post['status'],
					'post_name'      => $post['post_name'],
					'comment_status' => $post['comment_status'],
					'ping_status'    => $post['ping_status'],
					'guid'           => $post['guid'],
					'post_parent'    => $post_parent,
					'menu_order'     => $post['menu_order'],
					'post_type'      => $post['post_type'],
					'post_password'  => $post['post_password']
				);
				
				$original_post_ID = $post['post_id'];
				$postdata         = apply_filters( 'wp_import_post_data_processed', $postdata, $post );
				
				if ( 'attachment' == $postdata['post_type'] ) {
					$remote_url = ! empty( $post['attachment_url'] ) ? $post['attachment_url'] : $post['guid'];
					
					// try to use _wp_attached file for upload folder placement to ensure the same location as the export site
					// e.g. location is 2003/05/image.jpg but the attachment post_date is 2010/09, see media_handle_upload()
					$postdata['upload_date'] = $post['post_date'];
					if ( isset( $post['postmeta'] ) ) {
						foreach ( $post['postmeta'] as $meta ) {
							if ( $meta['key'] == '_wp_attached_file' ) {
								if ( preg_match( '%^[0-9]{4}/[0-9]{2}%', $meta['value'], $matches ) ) {
									$postdata['upload_date'] = $matches[0];
								}
								break;
							}
						}
					}
					
					$comment_post_ID = $post_id = $this->process_attachment( $postdata, $remote_url );
				} else {
					$comment_post_ID = $post_id = wp_insert_post( $postdata, true );
					do_action( 'wp_import_insert_post', $post_id, $original_post_ID, $postdata, $post );
				}
				
				if ( is_wp_error( $post_id ) ) {
//                    printf( esc_html__( 'Failed to import %s &#8220;%s&#8221;', 'floral' ),
//                        $post_type_object->labels->singular_name, esc_html( $post['post_title'] ) );
//                    if ( defined( 'IMPORT_DEBUG_N' ) && IMPORT_DEBUG_N ) {
//                        echo ': ' . $post_id->get_error_message();
//                    }
//                    echo '<br />';
					$fail[] = sprintf( esc_html__( "Failed to import %s", 'floral' ), esc_html( $post['post_title'] ) );
					continue;
				}
				
				if ( $post['is_sticky'] == 1 ) {
					stick_post( $post_id );
				}
			}
			
			// map pre-import ID to local ID
			$this->processed_posts[ intval( $post['post_id'] ) ] = (int) $post_id;
			
			if ( ! isset( $post['terms'] ) ) {
				$post['terms'] = array();
			}
			
			$post['terms'] = apply_filters( 'wp_import_post_terms', $post['terms'], $post_id, $post );
			
			// add categories, tags and other terms
			if ( ! empty( $post['terms'] ) ) {
				$terms_to_set = array();
				foreach ( $post['terms'] as $term ) {
					// back compat with WXR 1.0 map 'tag' to 'post_tag'
					$taxonomy    = ( 'tag' == $term['domain'] ) ? 'post_tag' : $term['domain'];
					$term_exists = term_exists( $term['slug'], $taxonomy );
					$term_id     = is_array( $term_exists ) ? $term_exists['term_id'] : $term_exists;
					if ( ! $term_id ) {
						$t = wp_insert_term( $term['name'], $taxonomy, array( 'slug' => $term['slug'] ) );
						if ( ! is_wp_error( $t ) ) {
							$term_id = $t['term_id'];
							do_action( 'wp_import_insert_term', $t, $term, $post_id, $post );
						} else {
//                            printf( esc_html__( 'Failed to import %s %s', 'floral' ), esc_html( $taxonomy ), esc_html( $term['name'] ) );
//                            if ( defined( 'IMPORT_DEBUG_N' ) && IMPORT_DEBUG_N ) {
//                                echo ': ' . $t->get_error_message();
//                            }
//                            echo '<br />';
							$fail[] = sprintf( esc_html__( "Failed to import %s %s", 'floral' ), esc_html( $taxonomy ), esc_html( $term['name'] ) );
							do_action( 'wp_import_insert_term_failed', $t, $term, $post_id, $post );
							continue;
						}
					}
					$terms_to_set[ $taxonomy ][] = intval( $term_id );
				}
				
				foreach ( $terms_to_set as $tax => $ids ) {
					$tt_ids = wp_set_post_terms( $post_id, $ids, $tax );
					do_action( 'wp_import_set_post_terms', $tt_ids, $ids, $tax, $post_id, $post );
				}
				unset( $post['terms'], $terms_to_set );
			}
			
			if ( ! isset( $post['comments'] ) ) {
				$post['comments'] = array();
			}
			
			$post['comments'] = apply_filters( 'wp_import_post_comments', $post['comments'], $post_id, $post );
			
			// add/update comments
			if ( ! empty( $post['comments'] ) ) {
				$num_comments      = 0;
				$inserted_comments = array();
				foreach ( $post['comments'] as $comment ) {
					$comment_id                                         = $comment['comment_id'];
					$newcomments[ $comment_id ]['comment_post_ID']      = $comment_post_ID;
					$newcomments[ $comment_id ]['comment_author']       = $comment['comment_author'];
					$newcomments[ $comment_id ]['comment_author_email'] = $comment['comment_author_email'];
					$newcomments[ $comment_id ]['comment_author_IP']    = $comment['comment_author_IP'];
					$newcomments[ $comment_id ]['comment_author_url']   = $comment['comment_author_url'];
					$newcomments[ $comment_id ]['comment_date']         = $comment['comment_date'];
					$newcomments[ $comment_id ]['comment_date_gmt']     = $comment['comment_date_gmt'];
					$newcomments[ $comment_id ]['comment_content']      = $comment['comment_content'];
					$newcomments[ $comment_id ]['comment_approved']     = $comment['comment_approved'];
					$newcomments[ $comment_id ]['comment_type']         = $comment['comment_type'];
					$newcomments[ $comment_id ]['comment_parent']       = $comment['comment_parent'];
					$newcomments[ $comment_id ]['commentmeta']          = isset( $comment['commentmeta'] ) ? $comment['commentmeta'] : array();
					if ( isset( $this->processed_authors[ $comment['comment_user_id'] ] ) ) {
						$newcomments[ $comment_id ]['user_id'] = $this->processed_authors[ $comment['comment_user_id'] ];
					}
				}
				ksort( $newcomments );
				
				foreach ( $newcomments as $key => $comment ) {
					// if this is a new post we can skip the comment_exists() check
					if ( ! $post_exists || ! comment_exists( $comment['comment_author'], $comment['comment_date'] ) ) {
						if ( isset( $inserted_comments[ $comment['comment_parent'] ] ) ) {
							$comment['comment_parent'] = $inserted_comments[ $comment['comment_parent'] ];
						}
						$comment                   = wp_filter_comment( $comment );
						$inserted_comments[ $key ] = wp_insert_comment( $comment );
						do_action( 'wp_import_insert_comment', $inserted_comments[ $key ], $comment, $comment_post_ID, $post );
						
						foreach ( $comment['commentmeta'] as $meta ) {
							$value = maybe_unserialize( $meta['value'] );
							add_comment_meta( $inserted_comments[ $key ], $meta['key'], $value );
						}
						
						$num_comments ++;
					}
				}
				unset( $newcomments, $inserted_comments, $post['comments'] );
			}
			
			if ( ! isset( $post['postmeta'] ) ) {
				$post['postmeta'] = array();
			}
			
			$post['postmeta'] = apply_filters( 'wp_import_post_meta', $post['postmeta'], $post_id, $post );
			
			// add/update post meta
			if ( ! empty( $post['postmeta'] ) ) {
				foreach ( $post['postmeta'] as $meta ) {
					$key   = apply_filters( 'import_post_meta_key', $meta['key'], $post_id, $post );
					$value = false;
					
					if ( '_edit_last' == $key ) {
						if ( isset( $this->processed_authors[ intval( $meta['value'] ) ] ) ) {
							$value = $this->processed_authors[ intval( $meta['value'] ) ];
						} else {
							$key = false;
						}
					}
					
					if ( $key ) {
						// export gets meta straight from the DB so could have a serialized string
						if ( ! $value ) {
							$value = maybe_unserialize( $meta['value'] );
						}
						
						add_post_meta( $post_id, $key, $value );
						do_action( 'import_post_meta', $post_id, $key, $value );
						
						// if the post has a featured image, take note of this in case of remap
						if ( '_thumbnail_id' == $key ) {
							$this->featured_images[ $post_id ] = (int) $value;
						}
					}
				}
			}
		}
		
		unset( $this->posts );
		
		return 'true';
	}
	
	/**
	 * Process menu items
	 *
	 * @param array $item
	 */
	function process_menu_item( $item ) {
		// skip draft, orphaned menu items
		if ( 'draft' == $item['status'] ) {
			return;
		}

//        error_log('procees item: ' . $item['post_title']);
		$menu_slug = false;
		if ( isset( $item['terms'] ) ) {
			// loop through terms, assume first nav_menu term is correct menu
			foreach ( $item['terms'] as $term ) {
				if ( 'nav_menu' == $term['domain'] ) {
					$menu_slug = $term['slug'];
					break;
				}
			}
		}
		
		// no nav_menu term associated with this menu item
		if ( ! $menu_slug ) {
//            esc_html_e( 'Menu item skipped due to missing menu slug', 'floral' );
//            echo '<br />';
//            error_log('return by no slug');
			
			return;
		}
		
		$menu_id = term_exists( $menu_slug, 'nav_menu' );
		if ( ! $menu_id ) {
//            printf( esc_html__( 'Menu item skipped due to invalid menu slug: %s', 'floral' ), esc_html( $menu_slug ) );
//            echo '<br />';
//            error_log('return by no menu_id');
			
			return;
		} else {
			$menu_id = is_array( $menu_id ) ? $menu_id['term_id'] : $menu_id;
		}
		
		foreach ( $item['postmeta'] as $meta ) {
			$m  = $meta['key']; // fix for PHP 7
			$$m = $meta['value'];
		}
		unset( $m );
		
		if ( 'taxonomy' == $_menu_item_type && isset( $this->processed_terms[ intval( $_menu_item_object_id ) ] ) ) {
			$_menu_item_object_id = $this->processed_terms[ intval( $_menu_item_object_id ) ];
		} else {
			if ( 'post_type' == $_menu_item_type && isset( $this->processed_posts[ intval( $_menu_item_object_id ) ] ) ) {
				$_menu_item_object_id = $this->processed_posts[ intval( $_menu_item_object_id ) ];
			} else {
				if ( 'custom' != $_menu_item_type ) {
					// associated object is missing or not imported yet, we'll retry later
//                    error_log('return by no item type ' . ($_menu_item_type == ''));
					$this->missing_menu_items[] = $item;
					
					return;
				}
			}
		}
		
		if ( isset( $this->processed_menu_items[ intval( $_menu_item_menu_item_parent ) ] ) ) {
			$_menu_item_menu_item_parent = $this->processed_menu_items[ intval( $_menu_item_menu_item_parent ) ];
		} else {
			if ( $_menu_item_menu_item_parent ) {
				$this->menu_item_orphans[ intval( $item['post_id'] ) ] = (int) $_menu_item_menu_item_parent;
				$_menu_item_menu_item_parent                           = 0;
			}
		}
		
		// wp_update_nav_menu_item expects CSS classes as a space separated string
		$_menu_item_classes = maybe_unserialize( $_menu_item_classes );
		if ( is_array( $_menu_item_classes ) ) {
			$_menu_item_classes = implode( ' ', $_menu_item_classes );
		}
		
		$args = array(
			'menu-item-object-id'   => $_menu_item_object_id,
			'menu-item-object'      => $_menu_item_object,
			'menu-item-parent-id'   => $_menu_item_menu_item_parent,
			'menu-item-position'    => intval( $item['menu_order'] ),
			'menu-item-type'        => $_menu_item_type,
			'menu-item-title'       => $item['post_title'],
			'menu-item-url'         => $_menu_item_url,
			'menu-item-description' => $item['post_content'],
			'menu-item-attr-title'  => $item['post_excerpt'],
			'menu-item-target'      => $_menu_item_target,
			'menu-item-classes'     => $_menu_item_classes,
			'menu-item-xfn'         => $_menu_item_xfn,
			'menu-item-status'      => $item['status']
		);
		
		$id = wp_update_nav_menu_item( $menu_id, 0, $args );
		if ( $id && ! is_wp_error( $id ) ) {
			$this->processed_menu_items[ intval( $item['post_id'] ) ] = (int) $id;
			
			$args_key = array(
				'_menu_item_type',
				'_menu_item_menu_item_parent',
				'_menu_item_object_id',
				'_menu_item_object',
				'_menu_item_target',
				'_menu_item_classes',
				'_menu_item_xfn',
				'_menu_item_url',
				'_menu_item_orphaned'
			);
			// add nav menu metabox
			foreach ( $item['postmeta'] as $meta ) {
				$key   = apply_filters( 'import_post_meta_key', $meta['key'] );
				$value = false;
				
				if ( $key && ! in_array( $key, $args_key ) ) {
					// export gets meta straight from the DB so could have a serialized string
					if ( ! $value ) {
						$value = maybe_unserialize( $meta['value'] );
					}
//                    error_log('metabox: ' . $key . '-' . $value);
					
					update_post_meta( $id, $key, $value );
					do_action( 'import_post_meta', $id, $key, $value );
				}
			}
		}
	}
	
	/**
	 * Process categories
	 * @return string
	 */
	function process_categories() {
		$this->categories = apply_filters( 'wp_import_categories', $this->categories );
		
		if ( empty( $this->categories ) ) {
			return 'false';
		}
		
		$fail = array();
		foreach ( $this->categories as $current_point => $cat ) {
			// if the category already exists leave it alone
			$term_id = term_exists( $cat['category_nicename'], 'category' );
			if ( $term_id ) {
				if ( is_array( $term_id ) ) {
					$term_id = $term_id['term_id'];
				}
				if ( isset( $cat['term_id'] ) ) {
					$this->processed_terms[ intval( $cat['term_id'] ) ] = (int) $term_id;
				}
				continue;
			}
			
			$category_parent      = empty( $cat['category_parent'] ) ? 0 : category_exists( $cat['category_parent'] );
			$category_description = isset( $cat['category_description'] ) ? $cat['category_description'] : '';
			$catarr               = array(
				'category_nicename'    => $cat['category_nicename'],
				'category_parent'      => $category_parent,
				'cat_name'             => $cat['cat_name'],
				'category_description' => $category_description
			);
			
			$id = wp_insert_category( $catarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset( $cat['term_id'] ) ) {
					$this->processed_terms[ intval( $cat['term_id'] ) ] = $id;
				}
			} else {
				$fail[] = $cat['category_nicename'];
				continue;
			}
		}
		
		unset( $this->categories );
		if ( count( $fail ) > 0 ) {
			return sprintf( esc_html__( 'Warning: Fail to import categories: %s', 'floral' ), implode( ', ', $fail ) );
		}
		
		return 'true';
	}
	
	/**
	 * Process tags
	 * @return string
	 */
	function process_tags() {
		$this->tags = apply_filters( 'wp_import_tags', $this->tags );
		
		if ( empty( $this->tags ) ) {
			return 'false';
		}
		
		$fail = array();
		foreach ( $this->tags as $tag ) {
			// if the tag already exists leave it alone
			$term_id = term_exists( $tag['tag_slug'], 'post_tag' );
			if ( $term_id ) {
				if ( is_array( $term_id ) ) {
					$term_id = $term_id['term_id'];
				}
				if ( isset( $tag['term_id'] ) ) {
					$this->processed_terms[ intval( $tag['term_id'] ) ] = (int) $term_id;
				}
				continue;
			}
			
			$tag_desc = isset( $tag['tag_description'] ) ? $tag['tag_description'] : '';
			$tagarr   = array( 'slug' => $tag['tag_slug'], 'description' => $tag_desc );
			
			$id = wp_insert_term( $tag['tag_name'], 'post_tag', $tagarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset( $tag['term_id'] ) ) {
					$this->processed_terms[ intval( $tag['term_id'] ) ] = $id['term_id'];
				}
			} else {
				$fail[] = $tag['tag_name'];
				continue;
			}
		}
		
		unset( $this->tags );
		
		if ( count( $fail ) > 0 ) {
			return sprintf( esc_html__( 'Warning: Fail to import tags: %s', 'floral' ), implode( ', ', $fail ) );
		}
		
		return 'true';
	}
	
	/**
	 * Process terms
	 * @return string
	 */
	function process_terms() {
		$this->terms = apply_filters( 'wp_import_terms', $this->terms );
		
		if ( empty( $this->terms ) ) {
			return 'false';
		}
		
		$fail = array();
		foreach ( $this->terms as $term ) {
			// if the term already exists in the correct taxonomy leave it alone
			$term_id = term_exists( $term['slug'], $term['term_taxonomy'] );
			if ( $term_id ) {
				if ( is_array( $term_id ) ) {
					$term_id = $term_id['term_id'];
				}
				if ( isset( $term['term_id'] ) ) {
					$this->processed_terms[ intval( $term['term_id'] ) ] = (int) $term_id;
				}
				continue;
			}
			
			if ( empty( $term['term_parent'] ) ) {
				$parent = 0;
			} else {
				$parent = term_exists( $term['term_parent'], $term['term_taxonomy'] );
				if ( is_array( $parent ) ) {
					$parent = $parent['term_id'];
				}
			}
			$description = isset( $term['term_description'] ) ? $term['term_description'] : '';
			$termarr     = array( 'slug'        => $term['slug'],
			                      'description' => $description,
			                      'parent'      => intval( $parent )
			);
			
			$id = wp_insert_term( $term['term_name'], $term['term_taxonomy'], $termarr );
			if ( ! is_wp_error( $id ) ) {
				if ( isset( $term['term_id'] ) ) {
					$this->processed_terms[ intval( $term['term_id'] ) ] = $id['term_id'];
				}
			} else {
				$fail[] = $term['term_name'];
				continue;
			}
		}
		
		unset( $this->terms );
		
		if ( count( $fail ) > 0 ) {
			return sprintf( esc_html__( 'Warning: Fail to import terms: %s', 'floral' ), implode( ', ', $fail ) );
			
		}
		
		return 'true';
	}
	
	
	static function update_mc4wp_default_form_id( $post_id, $original_post_ID, $postdata, $post ) {
		if ( floral_is_plugin_active( 'mailchimp-for-wp/mailchimp-for-wp.php' ) && isset( $post['post_type'] ) && ( $post['post_type'] === 'mc4wp-form' ) ) {
			$old_default_form_id = get_transient( self::_MC4WP_DEFAULT_FORM_ID );
			if ( ! empty( $old_default_form_id ) ) {
				if ( $old_default_form_id == $original_post_ID ) {
					update_option( self::_MC4WP_DEFAULT_FORM_ID, $post_id );
				}
			}
		}
	}
}