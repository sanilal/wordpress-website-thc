<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Multi_Text
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( !class_exists( 'ReduxFramework_multi_label_text' ) ) {
    
    /**
     * Main ReduxFramework_multi_label_text class
     *
     * @since       1.0.0
     */
    class ReduxFramework_multi_label_text {
        
        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }
        
        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {
            
            $this->add_text   = ( isset( $this->field['add_text'] ) ) ? $this->field['add_text'] : esc_html__( 'Add More', 'floral' );
            $this->show_empty = ( isset( $this->field['show_empty'] ) ) ? $this->field['show_empty'] : true;
            
            echo '<ul id="' . $this->field['id'] . '-ul" class="redux-multi-label-text">';

            echo '<li style="display:none;">';
            echo '<span>Label</span><input type="text" id="' . $this->field['id'] . '-label" name="" value="" class="regular-text" /> <a href="javascript:void(0);" class="deletion redux-multi-label-text-remove">' . esc_html__( 'Remove', 'floral' ) . '</a>';
            echo '<br/>';
            echo '<span>Content</span><input name="" id="' . $this->field['id'] . '-content" class="regular-text-content"  type="text" value=""/>';
            echo '</li>';

            if ( isset( $this->value ) && is_array( $this->value ) ) {
                foreach ( $this->value as $k => $value ) {
                    if ( !empty( $value ) ) {
                        $cname = isset( $value['label'] ) ? $value['label'] : '';
                        $cval  = isset( $value['content'] ) ? $value['content'] : '';

                        echo '<li>';
                        echo '<span>Label</span><input type="text" id="' . $this->field['id'] . '-' . $k . '-label" name="' . $this->field['name'] . $this->field['name_suffix'] . '[' . $k . '][label]' . '" value="' . esc_attr( $cname ) . '" class="regular-text ' . $this->field['class'] . '" /> <a href="javascript:void(0);" class="deletion redux-multi-label-text-remove">' . esc_html__( 'Remove', 'floral' ) . '</a>';
                        echo '<br/>';
                        echo '<span>Content</span><input type="text" name="' . $this->field['name'] . $this->field['name_suffix'] . '[' . $k . '][content]' . '" id="' . $this->field['id'] . '-content" class="regular-text regular-text-content ' . $this->field['class'] . '" value="' . $cval . '' . '"/>';
                        echo '</li>';
                    }
                }
            } elseif ( $this->show_empty == true ) {
                echo '<li>';
                echo '<span>Label</span><input type="text" id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[0][label]' . '" value="" class="regular-text ' . $this->field['class'] . '" /> <a href="javascript:void(0);" class="deletion redux-multi-label-text-remove">' . esc_html__( 'Remove', 'floral' ) . '</a>';
                echo '<br/>';
                echo '<span>Content</span><input name="' . $this->field['name'] . $this->field['name_suffix'] . '[0][content]' . '" id="' . $this->field['id'] . '-color" class="regular-text regular-text-content ' . $this->field['class'] . '"  type="text" value=""/>';
                echo '</li>';
            }

            echo '</ul>';
            echo '<span style="clear:both;display:block;height:0;" /></span>';
            $this->field['add_number'] = ( isset( $this->field['add_number'] ) && is_numeric( $this->field['add_number'] ) ) ? $this->field['add_number'] : 1;
            echo '<a href="javascript:void(0);" class="button button-primary redux-multi-label-text-add" data-add_number="' . $this->field['add_number'] . '" data-id="' . $this->field['id'] . '-ul" data-name="' . $this->field['name'] . $this->field['name_suffix'] . '">' . $this->add_text . '</a><br/>';
        }
        
        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {
            
            wp_enqueue_script(
                'redux-field-multi-label-text-js',
//                ReduxFramework::$_url . 'inc/fields/multi_label_text/field_multi_label_text' . Redux_Functions::isMin() . '.js',
                ReduxFramework::$_url . 'inc/fields/multi_label_text/field_multi_label_text.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

//            if ( $this->parent->args['dev_mode'] ) {
            wp_enqueue_style(
                'redux-field-multi-label-text-css',
                ReduxFramework::$_url . 'inc/fields/multi_label_text/field_multi_label_text.css',
                array(),
                time(),
                'all'
            );
//            }
        }
    }
}