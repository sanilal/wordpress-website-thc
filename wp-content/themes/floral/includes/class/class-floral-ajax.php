<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-ajax.php
 * @time    : 9/5/16 3:36 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_AJAX extends Floral_Base {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add_actions() {
        /*-------------------------------------
        	PRESET MANAGEMENT ACTION
        ---------------------------------------*/
        add_action( 'wp_ajax_do_create_preset', array( __CLASS__, 'do_create_preset' ) );
        add_action( 'wp_ajax_do_remove_preset', array( __CLASS__, 'do_remove_preset' ) );
        add_action( 'wp_ajax_do_make_global_preset', array( __CLASS__, 'do_make_global_preset' ) );
        add_action( 'wp_ajax_do_change_preset_title', array( __CLASS__, 'do_change_preset_title' ) );
        
        /*-------------------------------------
        	GET ICON LIST
        ---------------------------------------*/
        add_action( 'wp_ajax_floral_html_icon_list', array( __CLASS__, 'get_html_icon_list_ajax' ) );
        
        
        /*-------------------------------------
        	SEARCH AJAX
        ---------------------------------------*/
        add_action( 'wp_ajax_floral_load_search_results', array( __CLASS__, 'load_search_results' ) );
        add_action( 'wp_ajax_nopriv_floral_load_search_results', array( __CLASS__, 'load_search_results' ) );
        
        /*-------------------------------------
        	CHECK EMAIL EXIST
        ---------------------------------------*/
        add_action( 'wp_ajax_floral_check_email_exist', array( __CLASS__, 'check_email_exists' ) );
        add_action( 'wp_ajax_nopriv_floral_check_email_exist', array( __CLASS__, 'check_email_exists' ) );
        
        /*-------------------------------------
        	WOOCOMMERCE QUICK VIEW
        ---------------------------------------*/
        add_action( 'wp_ajax_load_quick_view_wrapper', array( __CLASS__, 'woocommerce_load_quick_view_wrapper' ) );
        add_action( 'wp_ajax_nopriv_load_quick_view_wrapper', array( __CLASS__, 'woocommerce_load_quick_view_wrapper' ) );
        add_action( 'wp_ajax_load_quick_view_product_content', array( __CLASS__, 'woocommerce_load_quick_view_product_content' ) );
        add_action( 'wp_ajax_nopriv_load_quick_view_product_content', array( __CLASS__, 'woocommerce_load_quick_view_product_content' ) );
        
        /*-------------------------------------
        	WOOCOMMERCE CART ACTIONS
        ---------------------------------------*/
        add_action( 'wp_ajax_woocommerce_remove_cart_item', array( __CLASS__, 'woocommerce_remove_cart_item' ) );
        add_action( 'wp_ajax_nopriv_woocommerce_remove_cart_item', array( __CLASS__, 'woocommerce_remove_cart_item' ) );
        add_action( 'wp_ajax_woocommerce_undo_cart_item', array( __CLASS__, 'woocommerce_undo_cart_item' ) );
        add_action( 'wp_ajax_nopriv_woocommerce_undo_cart_item', array( __CLASS__, 'woocommerce_undo_cart_item' ) );
        
        /*-------------------------------------
        	GET CONTENT TEMPLATE VIA AJAX
        ---------------------------------------*/
        
        add_action( 'wp_ajax_get_content_template', array( __CLASS__, 'get_content_template' ) );
        add_action( 'wp_ajax_nopriv_get_content_template', array( __CLASS__, 'get_content_template' ) );
        /*-------------------------------------
        	GET SIDEBAR VIA AJAX
        ---------------------------------------*/
        
        
    }
    
    static function reload_css() {
        $is_scss_changed = Floral_SCSS()->is_scss_changed( array( 'bs' ) );
        if ( $is_scss_changed ) {
            try {
                Floral_SCSS()->compile_all();
            } catch ( Exception $e ) {
                echo json_encode( $e->getMessage() );
                die();
            }
        }
        echo json_encode( $is_scss_changed );
        die();
    }
    
    static function get_html_icon_list_ajax() {
        echo Floral_Icons::get_html_theme_base_icon_list();
        die();
    }
    
    static function check_email_exists() {
        $email     = isset( $_REQUEST['email_to_check'] ) ? $_REQUEST['email_to_check'] : '';
        $is_exist  = false;
        $message   = 'This field is required';
        $encrypted = '';
        
        if ( !empty( $email ) ) {
            require floral_theme_dir() . 'includes/library/verify-email/class.verifyEmail.php';
            $vmail = new verifyEmail();
            
            if ( $vmail->isValid( $email ) ) {
                $is_exist = $vmail->check( $email );
                
                if ( $is_exist ) {
                    $message = 'The email is exists!';
                    // path to file contain secure key
                    $secure_key_file = floral_theme_dir() . 'includes/library/defuse-crypto/floral-secure-key.txt';
                    
                    $crypto = new Floral_Crypto( $secure_key_file );
                    
                    $encrypted = $crypto->encrypt( $email );
                } else {
                    $message = esc_html__( 'The email seem does not exist, please try an other one!', 'floral' );
                }
            } else {
                $message = esc_html__( 'The email is not valid, please try an other one!', 'floral' );
            }
        }
        
        self::__return_json( array(
            'status'    => $is_exist,
            'email'     => $email,
            'message'   => $message,
            'encrypted' => $encrypted
        ) );
    }
    
    static function do_regenerate_presets_css( $ajax_response = true ) {
        $status  = 'fail';
        $message = '';
        $time    = microtime();
        
        $preset_list = floral_get_preset_list();
        
        
        if ( empty( $preset_list ) ) {
            $status  = 'success';
            $message = esc_html__( 'There is no preset exist, please reload the page and try again.', 'floral' );
        } else {
            $input_style = floral_theme_dir() . 'assets/scss/style.scss';
            if ( is_array( $preset_list ) ) {
                $success = array();
                $fail    = array();
                
                foreach ( $preset_list as $preset_name => $preset_title ) {
                    try {
                        $output = floral_get_current_blog_css_file_dir( $preset_name );
                        // compile css
                        $vars = Floral_Options()->variables->get_variables();
                        Floral_Options()->compiler->set_variables( $vars );
                        Floral_Options()->compiler->compile( $input_style, $output, 'compressed' );
                        
                        $success[] = $preset_title;
                    } catch ( Exception $e ) {
                        $fail[] = $preset_title . ', error: ' . $e->getMessage();
                    }
                }
                
                $status             = 'success';
                $message['success'] = implode( '||', $success );
                $message['fail']    = implode( '||', $fail );
            }
        }
        
        if ( $ajax_response ) {
            echo json_encode( array(
                'status'  => $status,
                'message' => $message,
                'time'    => microtime() - $time
            ) );
            die();
        } else {
            return array(
                'status'  => $status,
                'message' => $message,
                'time'    => microtime() - $time
            );
        }
        
    }
    
    static function do_create_preset() {
        $status  = '';
        $message = '';
        
        $preset_title = isset( $_POST['preset_title'] ) ? preg_replace( '/[^a-zA-Z0-9\s_-]/', '', ( $_POST['preset_title'] ) ) : '';
        $preset_clone = isset( $_POST['preset_clone'] ) ? preg_replace( '/[^a-zA-Z0-9_-]/', '', ( $_POST['preset_clone'] ) ) : '';
        $preset_edit  = isset( $_POST['preset_edit'] ) ? $_POST['preset_edit'] : '';
        
        if ( !empty( $preset_title ) ) {
            $preset_name = uniqid( sanitize_key( '_floral_ps_' . $preset_title ) );
            if ( strlen( $preset_title ) > 30 ) {
                $preset_title = substr( $preset_title, 30 );
            }
            
            $valid = floral_is_valid_preset( $preset_name, $preset_title );
            
            if ( $valid ) {
                floral_create_new_preset( $preset_name, $preset_title );
                
                if ( !empty( $preset_clone ) && $preset_clone !== 'none' && floral_is_preset_exist( $preset_clone ) ) {
                    $preset_clone_options = get_option( $preset_clone, array() );
                    
                    update_option( $preset_name, $preset_clone_options );
                }
                
                
                $status = 'success';
                if ( !empty( $preset_edit ) && $preset_edit == 'true' ) {
                    $status = 'edit';
                    
                    $theme_options_slug = Floral_Options()->ReduxFramework->args['page_slug'];
                    
                    $message = admin_url( 'admin.php?page=' . $theme_options_slug . '&opt_name=' . $preset_name );
                }
            } else {
                $status  = 'validation-error';
                $message = '<span class="message" style="color: red;">' . esc_html__( 'Preset is already exist, please try an other one!', 'floral' ) . '</span>';
            }
        } else {
            $status = 'validation-error';
        }
        
        echo json_encode( array(
            'status'  => $status,
            'message' => $message,
        ) );
        die();
    }
    
    static function do_change_preset_title() {
        $preset_title = isset( $_GET['preset_title'] ) ? preg_replace( '/[^a-zA-Z0-9\s_-]/', '', ( $_GET['preset_title'] ) ) : '';
        $preset_name  = isset( $_GET['preset_name'] ) ? trim( $_GET['preset_name'] ) : '';
        
        if ( strlen( $preset_title ) > 30 ) {
            $preset_title = substr( $preset_title, 30 );
        }
        
        $status = floral_change_preset_title( $preset_name, $preset_title );
        
        self::__return_json( array(
            'status' => $status,
        ) );
    }
    
    static function do_make_global_preset() {
        $preset_name = isset( $_GET['preset_name'] ) ? trim( $_GET['preset_name'] ) : '';
        
        $status = floral_set_global_preset( $preset_name );
        
        self::__return_json( array(
            'status' => $status,
        ) );
    }
    
    static function do_remove_preset() {
        $status      = false;
        $redirect    = '';
        $preset_name = isset( $_GET['preset_name'] ) ? trim( $_GET['preset_name'] ) : '';
        
        if ( $preset_name !== FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
            $status = floral_remove_preset( $preset_name );
            delete_option( $preset_name );
            
            // try to clean junk css files
            @floral_clean_preset_css_files( $preset_name );
            
            $theme_options_slug = Floral_Options()->ReduxFramework->args['page_slug'];
            $redirect           = $message = admin_url( 'admin.php?page=' . $theme_options_slug );
        }
        
        self::__return_json( array(
            'status'   => $status,
            'redirect' => $redirect
        ) );
    }
    
    static function woocommerce_load_quick_view_product_content() {
        $product_id = isset( $_GET['product_id'] ) ? $_GET['product_id'] : 0;
	
	    $args = array(
            'p'         => $product_id,
            'post_type' => 'product'
        );
        
        ob_start();
	    $the_query = new WP_Query( $args );
     
//        $display = 'none';
        if ( $the_query->have_posts() ):
            while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                
                <?php wc_get_template_part( 'content', 'quick-view' ); ?>
            
            <?php endwhile; // end of the loop.
        else:
            ?>
            <div class="quick-view-product">
                <h3 class="mb-25 mt-25 text-center"><?php echo esc_html__( 'No product found!', 'floral' ); ?></h3>
            </div>
            <?php
        endif;
	
	    wp_reset_postdata();
        echo ob_get_clean();
        die();
    }
    
    static function woocommerce_load_quick_view_wrapper() {
        $product_id = isset( $_GET['product_id'] ) ? $_GET['product_id'] : 0;
	
	    $args = array(
            'p'         => $product_id,
            'post_type' => 'product'
        );
        
        ob_start();
        ?>
        <div id="floral-quick-view" class="floral-woocommerce-quick-view-wrapper modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="quick-view-content">
                            <div class="block-loader-inner" style="display: none;">
                                <div class="sk-spinner sk-spinner-pulse"></div>
                            </div>
                            <?php
                            $the_query = new WP_Query( $args );
                            if ( $the_query->have_posts() ):
                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                    
                                    <?php wc_get_template_part( 'content', 'quick-view' ); ?>
                                
                                <?php endwhile; // end of the loop.
                            else:
                                ?>
                                <div class="quick-view-product">
                                    <h3 class="mb-25 mt-25 text-center"><?php echo esc_html__( 'No product found!', 'floral' ); ?></h3>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                    <?php if ( floral_get_option( 'shop-quick-view-nav' ) ) : ?>
                        <div class="quick-view-nav">
                            <div class="qv-nav-item qv-next">
                                <i class="floral-inline-icon w9 w9-ico-ios-arrow-thin-right"></i>
                            </div>
                            <div class="qv-nav-item qv-prev">
                                <i class="floral-inline-icon w9 w9-ico-ios-arrow-thin-left"></i>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
	    wp_reset_postdata();
        echo ob_get_clean();
        die();
    }
    
    
    static function woocommerce_remove_cart_item() {
        $status        = false;
        $message       = '';
        $cart_item_key = isset( $_REQUEST['cik'] ) ? sanitize_text_field( $_REQUEST['cik'] ) : '';
        $nonce         = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
        
        // taken from woocommerce/includes/class-wc-form-handler.php
        if ( wp_verify_nonce( $nonce, 'woocommerce-cart' ) ) {
            if ( function_exists( 'WC' ) && $cart_item = WC()->cart->get_cart_item( $cart_item_key ) ) {
                WC()->cart->remove_cart_item( $cart_item_key );
                $status             = 'success';
                $product            = wc_get_product( $cart_item['product_id'] );
                $item_removed_title = apply_filters( 'woocommerce_cart_item_removed_title', $product ? $product->get_title() : esc_html__( 'Item', 'floral' ), $cart_item );
                // Don't show undo link if removed item is out of stock.
                if ( $product->is_in_stock() && $product->has_enough_stock( $cart_item['quantity'] ) ) {
                    $removed_notice = sprintf( esc_html__( '%s removed.', 'floral' ), $item_removed_title );
                    $removed_notice .= ' <a class="undo" href="' . esc_url( WC()->cart->get_undo_url( $cart_item_key ) ) . '">' . esc_html__( 'Undo?', 'floral' ) . '</a>';
                } else {
                    $removed_notice = sprintf( esc_html__( '%s removed.', 'floral' ), $item_removed_title );
                }
                
                $message = $removed_notice;
            } else {
                $message = '<span style="color: purple;">' . esc_html__( 'Item does not exist!', 'floral' ) . ' </span>';
            }
        } else {
            $message = '<span style = "color: red;" >' . esc_html__( 'Invalid wpnonce', 'floral' ) . '</span>';
        }
        
        echo json_encode( array(
            'status'  => $status,
            'message' => $message
        ) );
        
        die();
    }
    
    static function woocommerce_undo_cart_item() {
        $status        = false;
        $message       = '';
        $cart_item_key = isset( $_REQUEST['cik'] ) ? sanitize_text_field( $_REQUEST['cik'] ) : '';
        $nonce         = isset( $_REQUEST['_nonce'] ) ? $_REQUEST['_nonce'] : '';
        
        if ( wp_verify_nonce( $nonce, 'woocommerce-cart' ) ) {
            if ( function_exists( 'WC' ) && isset( WC()->cart->removed_cart_contents[$cart_item_key] ) ) {
                WC()->cart->restore_cart_item( $cart_item_key );
                $status = 'success';
            } else {
                $message = esc_html__( 'Item does not exist!', 'floral' );
            }
        } else {
            $message = esc_html__( 'Invalid wpnonce. ', 'floral' );
        }
        
        echo json_encode( array(
            'status'  => $status,
            'message' => $message
        ) );
        
        die();
    }
    
    static function __return_json( array $response ) {
        echo json_encode( $response );
        die();
    }
    
    static function get_content_template() {
        $template = isset( $_REQUEST['template'] ) ? $_REQUEST['template'] : false;
        if ( $template ) {
            echo do_shortcode( '[vc_row][vc_column][vc_row_inner][vc_column_inner][vc_column_text]I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.[/vc_column_text][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]' );
        } else {
            echo esc_html__( 'No content template found', 'floral' );
        }
        wp_die();
    }
    
    static function load_search_results() {
        $query = $_POST['query'];
        
        $args   = array(
            'posts_per_page' => 20,
            'post_status'    => 'publish',
            's'              => $query
        );
        $search = new WP_Query( $args );
        
        
        if ( $search->have_posts() ) :
            while ( $search->have_posts() ) : $search->the_post();
                echo Floral_Wrap::link( '<h4 class="floral-ajax-search-result">' . get_the_title() . '</h4>', get_permalink() );
            endwhile;
        else :
            echo esc_html__( 'No result found', 'floral' );
        endif;
        
        wp_reset_postdata();
        wp_die();
    }
}