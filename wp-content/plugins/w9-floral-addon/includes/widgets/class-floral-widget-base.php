<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-base.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

abstract class Floral_Widget_Base extends WP_Widget {
    private $settings;
    
    public function __construct( $args = array() ) {
        $random_id      = uniqid();
        $this->settings = array(
            'id'      => 'floral-default-id-' . $random_id,
            'name'    => sprintf( esc_html__( 'Floral Default Widget %s' ), $random_id ),
            'options' => array(
                'classname'   => 'floral-default-class-' . $random_id,
                'description' => ''
            ),
            'fields'  => array()
        );
        
        $this->settings = wp_parse_args( $args, $this->settings );
        
        parent::__construct( $this->settings['id'], $this->settings['name'], $this->settings['options'] );
    }
    
    
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        if ( !empty( $this->settings['fields'] ) ) {
            foreach ( $this->settings['fields'] as $field ) {
                if ( isset( $new_instance[$field['id']] ) ) {
                    if ( in_array( $field['type'], array( 'text', 'number' ) ) ) {
                        $instance[$field['id']] = sanitize_text_field( $new_instance[$field['id']] );
                    } else {
                        $instance[$field['id']] = $new_instance[$field['id']];
                    }
                } else {
                    if ( $field['type'] == 'checkbox' ) {
                        $instance[$field['id']] = '0';
                    }
                }
            }
        }
        
        return $instance;
    }
    
    public function form( $instance ) {
        
        if ( empty( $this->settings['fields'] ) ) {
            parent::form( $instance );
            
            return;
        }
        
        foreach ( $this->settings['fields'] as $field ) {
            if ( !isset( $field['id'] ) || !isset( $field['type'] ) ) {
                continue;
            }
            $id                          = $field['id'];
            $default_value               = isset( $field['default'] ) ? $field['default'] : '';
            $value                       = isset( $instance[$id] ) ? $instance[$id] : $default_value;
            
            ob_start();
            switch ( $field['type'] ) {
                case "text" :
                    ?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                               name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>"
                               type="text" data-type="text"
                               value="<?php echo esc_attr( $value ); ?>" />
                    </p>
                    <?php
                    break;
                case "number" :
                    $number_step = isset( $field['step'] ) ? $field['step'] : '1';
                    $number_min          = isset( $field['min'] ) ? ' min="' . esc_attr( $field['min'] ) . '"' : '';
                    $number_max          = isset( $field['max'] ) ? ' max="' . esc_attr( $field['max'] ) . '"' : '';
                    ?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                               name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>"
                               type="number" step="<?php echo esc_attr( $number_step ); ?>"<?php echo sprintf( '%s', $number_min ); ?><?php echo sprintf( '%s', $number_max ); ?>
                               value="<?php echo esc_attr( $value ); ?>" data-type="number" />
                    </p>
                    <?php
                    break;
                case "select" :
                    if ( !isset( $field['select-group'] ) ) {
                        $field['select-group'] = '';
                    }
                    switch ( $field['select-group'] ) {
                        case 'get-terms-list': {
                            $taxonomies = get_taxonomies();
                            // "category", "post_tag", "nav_menu", "link_category", "post_format", "content-template-category", "review-category"
                            $taxonomy = $field['options']['taxonomy'];
                            if ( array_key_exists( $taxonomy, $taxonomies ) ) {
                                $terms = get_terms( array(
                                    'taxonomy' => $taxonomy,
                                ) );
                                ?>
                                <p>
                                    <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                                    <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>" data-type="select">
                                        <?php
                                        if ( $taxonomy === 'category' ) {
                                            ?>
                                            <option value="all" <?php selected( 'all', $value ); ?>><?php echo __( 'Show All', 'w9-floral-addon' ); ?></option>
                                            <?php
                                        }
                                        foreach ( $terms as $term ) : ?>
                                            <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $term->slug, $value ); ?>><?php echo( $term->name ); ?></option>
                                        <?php endforeach;
                                        ?>
                                    </select>
                                </p>
                                <?php
                            }
                            break;
                        }
                        case 'show-tag-cloud' : {
                            $current_taxonomy = '';
                            if ( !empty( $instance[$id] ) && taxonomy_exists( $instance[$id] ) ) {
                                
                                $current_taxonomy = $instance[$id];
                            } else {
                                
                                $current_taxonomy = 'post_tag';
                            }
                            
                            $taxonomies = get_taxonomies( array( 'show_tagcloud' => true ), 'object' );
                            $input      = '<input type="hidden" id="' . esc_attr( $this->get_field_id( $id ) ) . '" name="' . esc_attr( $this->get_field_name( $id ) ) . '" value="%s" />';
                            
                            switch ( count( $taxonomies ) ) {
                                
                                // No tag cloud supporting taxonomies found, display error message
                                case 0:
                                    echo '<p>' . __( 'The tag cloud will not be displayed since there are no taxonomies that support the tag cloud widget.' ) . '</p>';
                                    printf( $input, '' );
                                    break;
                                
                                // Just a single tag cloud supporting taxonomy found, no need to display options
                                case 1:
                                    $keys     = array_keys( $taxonomies );
                                    $taxonomy = reset( $keys );
                                    printf( $input, esc_attr( $taxonomy ) );
                                    break;
                                
                                // More than one tag cloud supporting taxonomy found, display options
                                default:
                                    printf(
                                        '<p><label for="%1$s">%2$s</label>' .
                                        '<select class="widefat" id="%1$s" name="%3$s">',
                                        $this->get_field_id( $id ),
                                        !empty( $field['title'] ) ? $field['title'] : __( 'Taxonomy:', 'w9-floral-addon' ),
                                        $this->get_field_name( $id )
                                    );
                                    
                                    foreach ( $taxonomies as $taxonomy => $tax ) {
                                        printf(
                                            '<option value="%s"%s>%s</option>',
                                            esc_attr( $taxonomy ),
                                            selected( $taxonomy, $current_taxonomy, false ),
                                            $tax->labels->name
                                        );
                                    }
                                    
                                    echo '</select></p>';
                            }
                            break;
                        }
                        default: {
                            ?>
                            <p>
                                <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>" data-type="select">
                                    <?php foreach ( $field['options'] as $option_key => $option_value ) : ?>
                                        <option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </p>
                            <?php
                        }
                    }
                    break;
                case "checkbox" :
                    ?>
                    <p>
                        <input id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> data-type="checkbox" />
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                    </p>
                    <?php
                    break;
                case "textarea":
                    ?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                        <textarea class="widefat" rows="8" cols="40" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>" data-type="textarea"><?php echo esc_textarea( $value ); ?></textarea>
                    </p>
                    <?php
                    break;
                case "multi-select" :
                    ?>
                    <p>
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                        <input name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>" type="hidden" value="<?php echo esc_attr( $value ); ?>" />
                        <select multiple="multiple" class="widefat widget-select2"
                                id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                                data-value="<?php echo esc_attr( $value ) ?>" data-type="multi-select">
                            <?php foreach ( $field['options'] as $option_key => $option_value ) : ?>
                                <option value="<?php echo esc_attr( $option_key ); ?>"><?php echo esc_html( $option_value ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <?php
                    break;
                case 'number-slider':
                    $data_slider = array();
                    $data_slider['unit'] = isset( $field['unit'] ) ? $field['unit'] : '';
                    $min                 = floatval( $field['min'] );
                    $max                 = floatval( $field['max'] );
                    $step                = floatval( $field['step'] );
                    
                    $data_slider['min']  = ( isset( $field['min'] ) && !empty( $min ) ) ? $min : 0;
                    $data_slider['max']  = ( isset( $field['max'] ) && !empty( $max ) ) ? $max : 1;
                    $data_slider['step'] = ( isset( $field['step'] ) && !empty( $step ) ) ? $step : 0.1;
                    ?>
                    <div class="slider-wrapper">
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label>
                        <div class="floral-param-slider" data-slider="<?php echo esc_attr( json_encode( $data_slider ) ); ?>">
                            <div class="slider-object"></div>
                            <input type="text" readonly="readonly" class="slider-value" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>" value="<?php echo esc_attr( $value ); ?>" data-type="number-slider" />
                        </div>
                    </div>
                    <?php
                    break;
                case 'file-selector':
                    ?>
                    <p class="floral-file-selector">
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?> </label>
                        <input type="text" class="widefat"
                               id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                               name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>"
                               value="<?php echo esc_attr( $value ); ?>" readonly="readonly" data-type="file-selector">
                        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to browse file', 'w9-floral-addon' ) ?>"
                                class="browse-files button-primary selector-btn" type="button"><?php echo esc_html__( 'Browse', 'w9-floral-addon' ) ?></button>
                        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to remove file', 'w9-floral-addon' ) ?>"
                                class="browse-files button-secondary remove-btn" type="button"><?php echo esc_html__( 'Remove', 'w9-floral-addon' ) ?></button>
                    </p>
                    <?php
                    break;
                case 'image-selector':
                    ?>
                    <p class="floral-image-selector floral-file-selector">
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?> </label>
                        <input type="text" class="widefat"
                               id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                               name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>"
                               value="<?php echo esc_attr( $value ); ?>" readonly="readonly" data-type="image-selector">
                        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to browse image', 'w9-floral-addon' ) ?>"
                                class="browse-files browse-images button-primary selector-btn" type="button"><?php echo esc_html__( 'Browse Image', 'w9-floral-addon' ) ?></button>
                        <button style="margin-top: 10px" title="<?php echo esc_html__( 'Click to remove image', 'w9-floral-addon' ) ?>"
                                class="browse-files browse-images button-secondary remove-btn" type="button"><?php echo esc_html__( 'Remove Image', 'w9-floral-addon' ) ?></button>
                        <br />
                        <?php if ( !empty( $value ) ): ?>
                            <img class="widget-image-selected" src="<?php echo esc_attr( $value ); ?>" alt="" />
                        <?php endif; ?>
                    </p>
                    <?php
                    break;
                case 'icon-picker':
                    $iconpicker_lib = array(
                        '9wpthemes'    => '9WPThemes',
                        'floral'    => 'Floral',
                        'font-awesome' => 'Font Awesome',
                    );
                    
                    $iconpicker_id = uniqid( 'widget-field-icon-picker-' );
                    ?>
                    <div class="floral-icon-picker" id="<?php echo $iconpicker_id; ?>">
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?> </label>
                        <div class="__input-wrapper">
                            <input class="picker-input" type="hidden"
                                   name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>"
                                   id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                                   value="<?php echo esc_attr( $value ); ?>" data-type="icon-picker" />
                            <span class="picker-preview"><i class="<?php echo esc_attr( $value ); ?>"></i></span>
                            <select class="floral-icon-picker-lib widefat">
                                <?php foreach ( $iconpicker_lib as $key => $option ) :
                                    $current_icon_lib = '';
                                    if ( preg_match( '/^w9 w9-ico-/', $value ) ) {
                                        $current_icon_lib = '9wpthemes';
                                    } elseif ( preg_match( '/^floral-ico floral-ico-/', $value ) ) {
                                        $current_icon_lib = 'floral';
                                    } elseif ( preg_match( '/^fa fa-/', $value ) ) {
                                        $current_icon_lib = 'font-awesome';
                                    }
                                    $selected = ( $key == $current_icon_lib ) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo $selected; ?>><?php echo esc_html( $option ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="button" class="button-primary picker-pick"><?php echo __( 'Choose Icon', 'w9-floral-addon' ); ?></button>
                        <button type="button" class="button-secondary picker-remove"><?php echo __( 'Remove Icon', 'w9-floral-addon' ); ?></button>
                    </div>
                    <script>
                        jQuery(document).ready(function ($) {
                            floral_admin.icon_picker("<?php echo '#' . $iconpicker_id; ?>");
                        });
                    </script>
                    <?php
                    break;
                case 'colorpicker':
                    ?>
                    <p class="floral-color-picker" style="font-size: 0">
                        <label for="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"><?php echo esc_html( $field['title'] ); ?></label><br />
                        <input class="widefat color-init" id="<?php echo esc_attr( $this->get_field_id( $id ) ); ?>"
                               name="<?php echo esc_attr( $this->get_field_name( $id ) ); ?>"
                               type="text" value="<?php echo esc_attr( $value ); ?>" data-type="colorpicker" />
                    </p>
                    <?php
                    break;
            }
            $inner_field = ob_get_clean();
            
            $dependency = isset( $field['dependency'] ) ? $field['dependency'] : array();
            $atts       = '';
            if ( !empty( $dependency ) && is_array( $dependency ) ) {
                $dep_el           = ( isset( $dependency['element'] ) && is_string( $dependency['element'] ) ) ? $dependency['element'] : '';
                $dep_equal_to     = isset( $dependency['equal_to'] ) ? $dependency['equal_to'] : null;
                $dep_not_equal_to = isset( $dependency['not_equal_to'] ) ? $dependency['not_equal_to'] : null;
                
                $open_wrapper_attr = array();
                if ( !empty( $dep_el ) && $this->_is_field_exist( $dep_el ) !== false ) {
                    $open_wrapper_attr['dep_el'] = $this->get_field_id( $dep_el );
                    if ( isset( $dep_equal_to ) ) {
                        $open_wrapper_attr['dep_equal_to'] = $dep_equal_to;
                        if ( $this->_check_value( $instance, $dep_el, $dep_equal_to ) !== true ) {
                            $open_wrapper_attr['style'] = 'display: none;';
                        } else {
                            $a = $this->check_parent_field( $instance, $dep_el );
                            if ( $a === false ) {
                                $open_wrapper_attr['style'] = 'font-size: 20px; display: none;';
                            }
                        }
                    } elseif ( isset( $dep_not_equal_to ) ) {
                        $open_wrapper_attr['dep_not_equal_to'] = $dep_not_equal_to;
                        if ( $this->_check_value( $instance, $dep_el, $dep_not_equal_to ) === true ) {
                            $open_wrapper_attr['style'] = 'display: none;';
                        } else {
                            if ( $a = $this->check_parent_field( $instance, $dep_el ) === false ) {
                                $open_wrapper_attr['style'] = 'display: none;';
                            }
                        }
                    }
                }
                
                if ( count( $open_wrapper_attr ) > 0 ) {
                    foreach ( $open_wrapper_attr as $key => $value ) {
                        $atts .= sprintf( ' %s="%s"', $key, $value );
                    }
                }
            }
            echo sprintf( '<div class="widget-field-wrapper" data-id="%s" %s>%s</div>', esc_attr( $this->get_field_id( $id ) ), $atts, $inner_field );
        }
    }
    
    private function check_parent_field( $instance, $target ) {
        foreach ( $this->settings['fields'] as $field ) {
            if ( $field['id'] === $target ) {
                $dependency = isset( $field['dependency'] ) ? $field['dependency'] : array();
                
                if ( !empty( $dependency ) && is_array( $dependency ) ) {
                    $dep_el           = ( isset( $dependency['element'] ) && is_string( $dependency['element'] ) ) ? $dependency['element'] : '';
                    $dep_equal_to     = isset( $dependency['equal_to'] ) ? $dependency['equal_to'] : null;
                    $dep_not_equal_to = isset( $dependency['not_equal_to'] ) ? $dependency['not_equal_to'] : null;
                    
                    if ( !empty( $dep_el ) && $this->_is_field_exist( $dep_el ) !== false ) {
                        if ( isset( $dep_equal_to ) ) {
                            return $this->_check_value( $instance, $dep_el, $dep_equal_to );
                        } elseif ( isset( $dep_not_equal_to ) ) {
                            return !$this->_check_value( $instance, $dep_el, $dep_not_equal_to );
                        }
                    }
                }
            }
        }
        
        return true;
    }
    
    private function _is_field_exist( $dep_el ) {
        foreach ( $this->settings['fields'] as $field ) {
            if ( $field['id'] === $dep_el ) {
                return $field;
            }
        }
        
        return false;
    }
    
    private function _check_value( $instance, $target, $value ) {
        if ( $this->_is_field_exist( $target ) !== false && isset( $instance[$target] ) ) {
            
            $field_type = $this->_is_field_exist( $target )['type'];
            switch ( $field_type ) {
                case 'text':
                case 'number':
                case "select":
                case "textarea":
                case 'number-slider':
                case 'file-selector':
                case 'image-selector':
                case 'icon-picker':
                case 'colorpicker':
                    return $instance[$target] == $value;
                case 'checkbox':
                    return $instance[$target] == '1';
                case 'multi-select':
                    $vals = explode( '||', $instance[$target] );
                    
                    return in_array( $value, $vals );
                default:
                    return null;
            }
        }
        
        return null;
    }
    
    public function get_inline_style( $styles ) {
        if ( is_string( $styles ) ) {
            $styles = explode( ';', preg_replace( "/\r|\n/", " ", strip_tags( $styles ) ) );
        }
        
        if ( count( $styles ) > 0 ) {
            return 'style="' . implode( '; ', $styles ) . '"';
        }
        
        return '';
    }
    
    public function widget_custom_css( $style ) {
        if ( empty( $style ) ) {
            return;
        } else {
            $_css = '';
            if ( is_string( $style ) ) {
                $_css = $style;
            }
            
            if ( is_array( $style ) ) {
                foreach ( $style as $handler => $prop ) {
                    if ( is_string( $prop ) ) {
                        $_css .= sprintf( '%s {%s;}', $handler, $prop );
                    }
                    
                    if ( is_array( $prop ) ) {
                        $_css .= sprintf( '%s {%s;}', $handler, implode( '; ', $prop ) );
                    }
                }
            }
            
            $css = <<<CSS
                    $_css
CSS;
            echo sprintf( '<style>%s</style>', ( $css ) );
        }
    }
    
    public function widget( $args, $instance ) {
        echo sprintf( '%s', $args['before_widget'] );
        $this->widget_content( $args, $instance );
        echo sprintf( '%s', $args['after_widget'] );
    }
    
    public function widget_content( $args, $instance ) {
        echo 'Just override this function! yay :) :)';
    }
    
    public function the_widget_title( $args, $instance ) {
        if ( !empty( $instance['title'] ) ) {
            echo sprintf( '%1$s %2$s %3$s', $args['before_title'], $instance['title'], $args['after_title'] );
        }
    }
    
}