<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-menu.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

require_once 'menu/floral-walker-nav-menu-edit.php';
require_once 'menu/floral-walker-nav-menu.php';
require_once 'menu/floral-walker-nav-menu-vertical.php';

class Floral_Menu extends Floral_Base {
    static $fields;
    protected function add_actions() {
        if ( is_admin() ) {
            add_action( 'admin_footer', array( $this, 'floral_advance_menu_form' ) );
            add_action( 'wp_ajax_floral_get_advance_menu_item_setting', array( $this, 'floral_get_advance_menu_item_setting_ajax' ) );
            add_action( 'wp_ajax_floral_save_advance_menu_item_setting', array( $this, 'floral_save_advance_menu_item_setting_ajax' ) );
        }
    }
    
    protected function add_filters() {
        add_filter( 'wp_edit_nav_menu_walker', array( $this, 'nav_menu_edit_walker' ), 10, 2 );
        add_filter( 'wp_setup_nav_menu_item', array( $this, 'read_custom_menu_items' ) );
    }
    
    static function get_fields() {
        if(empty(self::$fields)){
           self::$fields = array(
               array(
                   'id'      => 'menu_item_icon',
                   'title'   => esc_html__( 'Icon', 'floral' ),
                   'type'    => 'icon_picker',
                   'default' => ''
               ),
    
               array(
                   'id'      => 'hide_on_mobile',
                   'title'   => esc_html__('Hide this item on mobile?', 'floral'),
                   'type'    => 'checkbox',
                   'default' => ''
               ),
               
               array(
                   'id'      => 'submenu_bg_img',
                   'title'   => esc_html__('Sub menu background image', 'floral'),
                   'type'    => 'image_selector',
                   'default' => ''
               ),
    
               array(
                   'id'        => 'submenu_mega',
                   'title'     => esc_html__('Sub menu is mega menu?', 'floral'),
                   'type'      => 'checkbox',
                   'max_depth' => 0,
                   'default'   => ''
               ),
    
//               array(
//                   'id'        => 'submenu_content_template',
//                   'title'     => esc_html__( 'Use content template for sub menu', 'floral' ),
//                   'type'      => 'select',
//                   'max_depth' => 0,
//                   'options'   => array_merge( array('none' => esc_html__('None', 'floral')), floral_get_content_template_list()) ,
//                   'default'   => '',
//               ),
//
               array(
                   'id'        => 'submenu_number_column',
                   'title'     => esc_html__( 'Sub menu number column', 'floral' ),
                   'type'      => 'select',
                   'max_depth' => 0,
                   'options'   => array(
                       '1' => esc_html__( '1 columns', 'floral' ),
                       '2' => esc_html__( '2 columns', 'floral' ),
                       '3' => esc_html__( '3 columns', 'floral' ),
                       '4' => esc_html__( '4 columns', 'floral' ),
                       '5' => esc_html__( '5 columns', 'floral' ),
                   ),
                   'default'   => '1',
               ),
               array(
                   'id'      => 'submenu_position',
                   'title'   => esc_html__( 'Sub menu position', 'floral' ),
                   'type'    => 'select',
                   'options' => array(
                       'sub-menu-on-right'  => esc_html__( 'Right', 'floral' ),
                       'sub-menu-on-center' => esc_html__( 'Center', 'floral' ),
                       'sub-menu-on-left'   => esc_html__( 'Left', 'floral' ),
                   ),
                   'default' => 'sub-menu-on-right'
               ),
               array(
                   'id'      => 'submenu_hide_on_mobile',
                   'title'   => esc_html__( 'Hide sub menu on mobile?', 'floral' ),
                   'type'    => 'checkbox',
                   'default' => '',
               ),
               array(
                   'id'      => 'menu_item_href_surfix',
                   'title'   => esc_html__( 'Menu item href suffix', 'floral' ),
                   'type'    => 'text',
                   'default' => ''
               ),
           );
        }
        
        return self::$fields;
    }
    
    
    /**
     * Get menu item from ajax load
     */
    public function floral_get_advance_menu_item_setting_ajax() {
        $item_id = $_POST['floral_menu_item_id'];
        $depth   = $_POST['floral_menu_item_depth'];
        $fields  = self::get_fields();
        $form    = '';
        
        foreach ( $fields as $custom_field ):
            if ( isset( $custom_field['max_depth'] ) ) {
                if ( $depth > $custom_field['max_depth'] ) {
                    continue;
                }
            }
            
            $field      = $custom_field['id'];
            $input_type = $custom_field['type'];
            $title      = esc_html( $custom_field['title'] );
            $field_meta = esc_attr( '_menu_item_' . $field );
            
            $value = esc_attr( get_post_meta( $item_id, $field_meta, true ) );
            
            switch ( $input_type ) {
                case 'text':
                    $input = '<input type="text" id="' . $field . '" name="' . $field . '" value="' . $value . '"  />';
                    break;
                
                case 'checkbox':
                    $checked = ( $value == 'on' ) ? 'checked' : '';
                    $input   = '<input type="checkbox"  id="' . $field . '" name="' . $field . '" ' . $checked . '/>';
                    $input .= esc_html__( 'Yes', 'floral' );
                    break;
                
                case 'select':
                    $input = '<select id=" ' . $field . '" name=' . $field . '>';
                    foreach ( $custom_field['options'] as $key => $option ) {
                        $selected = ( $key == $value ) ? 'selected' : '';
                        $input .= '<option value="' . esc_attr( $key ) . '" ' . $selected . '>' . esc_attr( $option ) . '</option>';
                    }
                    $input .= '</select>';
                    break;
                
                case 'icon_picker':
                    $icon_lib     = array(
                        '9wpthemes'    => '9WPThemes',
                        'floral'       => 'Floral',
                        'font-awesome' => 'Font Awesome',
                    );
                    $iconpickerid = $field . '-icon-picker';
                    $input        = '<div class="floral-icon-picker" id="' . $iconpickerid . '">';
                    $input .= '<input class="picker-input" type="hidden" name="' . $field . '" id="' . $field . '" value="' . $value . '" />';
                    $input .= '<span class="picker-preview"><i class="' . $value . '"></i></span>';
                    $input .= '<select class="floral-icon-picker-lib" id="' . $field . '-icon-lib" name="' . $field . '-icon-lib"' . '>';
                    $current_icon_lib = '9wpthemes';
                    if ( preg_match( '/^w9 w9-ico-/', $value ) == 1 ) {
                        $current_icon_lib = '9wpthemes';
                    } elseif ( preg_match( '/^floral-ico floral-ico-/', $value ) == 1 ) {
                        $current_icon_lib = 'floral';
                    } elseif ( preg_match( '/^fa fa-/', $value ) == 1 ) {
                        $current_icon_lib = 'font-awesome';
                    }
                    foreach ( $icon_lib as $key => $option ) {
                        $selected = ( $key == $current_icon_lib ) ? 'selected' : '';
                        $input .= '<option value="' . esc_attr( $key ) . '" ' . $selected . '>' . esc_attr( $option ) . '</option>';
                    }
                    $input .= '</select>';
                    $input .= '<button type="button" class="button-secondary picker-pick">' . esc_html__( 'Choose Icon', 'floral' ) . ' </button>';
                    $input .= '<button type="button" class="button-secondary picker-remove">' . esc_html__( 'Remove Icon', 'floral' ) . ' </button>';
                    $input .= '</div>';
                    $input .= '<script>floral_admin.icon_picker("#' . $iconpickerid . '");</script>';
                    break;
                
                case 'image_selector':
                    $mediapickerid = $field . '-media-picker';
                    $img           = '';
                    if ( !empty( $value ) ) {
                        $img = '<img src="' . $value . '" alt=""/>';
                    }
                    $input = '<div id="' . $mediapickerid . '" class="floral-media-picker">';
                    $input .= '<button class="button-secondary floral-select-button"> ' . esc_html__( 'Select media', 'floral' ) . '</button>';
                    $input .= '<button class="button-secondary floral-reset-button"> ' . esc_html__( 'Reset', 'floral' ) . '</button>';
                    $input .= '<input type="hidden" class="floral-media-input" name="' . $field . '" id="' . $field . '" value="' . $value . '" />';
                    $input .= '<div class="floral-preview-area">' . $img . '</div>';
                    $input .= '<script>floral_admin.media_picker("#' . $mediapickerid . '");</script>';
                    $input .= '</div>';
                    break;
                
                default:
                    $input = '';
                
            }
            
            $form .= '<div class="floral-input-group group-' . $field . '">
                        <label for="' . $field . '">
                            ' . $title . '
                        </label>
                        ' . $input . '
                    </div>';
        endforeach;
        
        echo sprintf( '%s', $form );
        wp_die();
    }
    
    /**
     * Save menu item from ajax
     */
    function floral_save_advance_menu_item_setting_ajax() {
        
        $menu_item_db_id = $_POST['floral_menu_item_id'];
        $menu_item_data  = array();
        parse_str( $_POST['floral_menu_item_submit_data'], $menu_item_data );
        
        foreach ( self::get_fields() as $custom_field ) {
            $field      = $custom_field['id'];
            $value      = $custom_field['default'];
            $field_meta = '_menu_item_' . $field;
            
            if ( isset( $menu_item_data[$field] ) ) {
                $value = $menu_item_data[$field];
            }
            update_post_meta( $menu_item_db_id, $field_meta, $value );
        }
        wp_die();
    }
    
    //Gen form container in footer
    public function floral_advance_menu_form() {
        ?>
        <div id="floral-advance-menu-form-container" class="floral-advance-menu-form-container" title="Edit menu item advance options">
            <div class="floral-waiting-overlay">
                <span class="spinner"></span>
            </div>
            <form action="" id="floral-advance-menu-form"></form>
        </div>
        <?php
    }
    
    
    /**
     * Read custom menu item
     *
     * @param object $menu_item
     *
     * @return object
     */
    function read_custom_menu_items( $menu_item ) {
        foreach ( self::get_fields() as $custom_field ) {
            $id               = $custom_field['id'];
            $field_meta       = '_menu_item_' . $id;
            $meta_value       = get_post_meta( $menu_item->ID, $field_meta, true );
            $menu_item->{$id} = $meta_value ? $meta_value : $custom_field['default'];
        }
        
        return $menu_item;
    }
    
    /**
     * Return walker name
     * @return string
     */
    function nav_menu_edit_walker() {
        return 'Floral_Walker_Nav_Menu_Edit';
    }
}