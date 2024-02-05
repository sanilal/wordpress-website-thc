<?php
/**
 * Widget tag cloud extension
 * @filename: class-floral-widget-tag-cloud.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Core class used to implement a Tag cloud widget.
 *
 * @since 2.8.0
 *
 * @see   WP_Widget
 */
class Floral_Widget_Tag_Cloud extends Floral_Widget_Base {
    /**
     * Floral_Widget_Logo constructor.
     */
    public function __construct() {
        $args = array(
            'id'      => 'floral-widget-tag-cloud',
            'name'    => __( 'Floral Tag Cloud', 'w9-floral-addon' ),
            'options' => array(
                'classname'   => 'floral-widget-tag-cloud',
                'description' => __( 'Like widget "Tag Cloud", but it has more extended options...', 'w9-floral-addon' )
            ),
            'fields'  => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => __( 'Title', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'           => 'taxonomy',
                    'type'         => 'select',
                    'select-group' => 'show-tag-cloud',
                ),
                
                array(
                    'id'      => 'tag_color',
                    'type'    => 'select',
                    'title'   => __( 'Tag Color', 'w9-floral-addon' ),
                    'options' => array(
                        'default'      => __( 'Default', 'w9-floral-addon' ),
                        'custom-style' => __( 'Custom style', 'w9-floral-addon' ),
                    ),
                    'default' => 'default'
                ),

                //text color

                array(
                    'id'         => 'text_color',
                    'type'       => 'select',
                    'title'      => __( 'Text Color', 'w9-floral-addon' ),
                    'options'    => array(
                            '__'        => __( 'Default CSS', 'w9-floral-addon' ),
                            'custom'    => __( 'Custom Color', 'w9-floral-addon' ),
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
                    'dependency' => array(
                        'element'  => 'tag_color',
                        'equal_to' => 'custom-style'
                    ),
                    'default'    => 'text'
                ),

                array(
                    'id'         => 'text_color_cp',
                    'type'       => 'colorpicker',
                    'dependency' => array(
                        'element'  => 'text_color',
                        'equal_to' => 'custom'
                    ),
                    'default'    => ''
                ),

                array(
                    'id'         => 'text_hover_color',
                    'type'       => 'select',
                    'title'      => __( 'Text Color - Hover', 'w9-floral-addon' ),
                    'options'    => array(
                            '__'        => __( 'Default CSS', 'w9-floral-addon' ),
                            'custom'    => __( 'Custom Color', 'w9-floral-addon' ),
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
                    'dependency' => array(
                        'element'  => 'tag_color',
                        'equal_to' => 'custom-style'
                    ),
                    'default'    => 'p',
                ),

                array(
                    'id'         => 'text_hover_color_cp',
                    'type'       => 'colorpicker',
                    'dependency' => array(
                        'element'  => 'text_hover_color',
                        'equal_to' => 'custom'
                    ),
                    'default'    => ''
                ),

                // background color

                array(
                    'id'         => 'background_color',
                    'type'       => 'select',
                    'title'      => __( 'Background Color', 'w9-floral-addon' ),
                    'options'    => array(
                            '__'          => __( 'Default CSS', 'w9-floral-addon' ),
                            'transparent' => __( 'Transparent', 'w9-floral-addon' ),
                            'custom'      => __( 'Custom Color', 'w9-floral-addon' ),
                            'p'           => __( 'Primary', 'w9-floral-addon' ),
                            's'           => __( 'Secondary', 'w9-floral-addon' ),
                            'meta-text'   => __( 'Meta Text Color', 'w9-floral-addon' ),
                            'border'      => __( 'Border Color', 'w9-floral-addon' ),
                            'text'        => __( 'Text Color', 'w9-floral-addon' ),
                            'light'       => __( 'Light #FFF', 'w9-floral-addon' ),
                            'dark'        => __( 'Dark #000', 'w9-floral-addon' ),
                            'gray2'       => __( 'Gray #222', 'w9-floral-addon' ),
                            'gray4'       => __( 'Gray #444', 'w9-floral-addon' ),
                            'gray6'       => __( 'Gray #666', 'w9-floral-addon' ),
                            'gray8'       => __( 'Gray #888', 'w9-floral-addon' ),
                        ) + floral_get_most_used_colors( 'key_name' ),
                    'default'    => '__',
                    'dependency' => array(
                        'element'  => 'tag_color',
                        'equal_to' => 'custom-style'
                    ),
                ),

                array(
                    'id'         => 'background_color_cp',
                    'type'       => 'colorpicker',
                    'dependency' => array(
                        'element'  => 'background_color',
                        'equal_to' => 'custom'
                    ),
                    'default'    => ''
                ),

                array(
                    'id'         => 'background_hover_color',
                    'type'       => 'select',
                    'title'      => __( 'Background Hover Color', 'w9-floral-addon' ),
                    'options'    => array(
                            '__'          => __( 'Default CSS', 'w9-floral-addon' ),
                            'transparent' => __( 'Transparent', 'w9-floral-addon' ),
                            'custom'      => __( 'Custom Color', 'w9-floral-addon' ),
                            'p'           => __( 'Primary', 'w9-floral-addon' ),
                            's'           => __( 'Secondary', 'w9-floral-addon' ),
                            'meta-text'   => __( 'Meta Text Color', 'w9-floral-addon' ),
                            'border'      => __( 'Border Color', 'w9-floral-addon' ),
                            'text'        => __( 'Text Color', 'w9-floral-addon' ),
                            'light'       => __( 'Light #FFF', 'w9-floral-addon' ),
                            'dark'        => __( 'Dark #000', 'w9-floral-addon' ),
                            'gray2'       => __( 'Gray #222', 'w9-floral-addon' ),
                            'gray4'       => __( 'Gray #444', 'w9-floral-addon' ),
                            'gray6'       => __( 'Gray #666', 'w9-floral-addon' ),
                            'gray8'       => __( 'Gray #888', 'w9-floral-addon' ),
                        ) + floral_get_most_used_colors( 'key_name' ),
                    'default'    => '__',
                    'dependency' => array(
                        'element'  => 'tag_color',
                        'equal_to' => 'custom-style'
                    ),
                ),

                array(
                    'id'         => 'background_hover_color_cp',
                    'type'       => 'colorpicker',
                    'dependency' => array(
                        'element'  => 'background_hover_color',
                        'equal_to' => 'custom'
                    ),
                    'default'    => ''
                ),

                // border color

                array(
                    'id'         => 'border_color',
                    'type'       => 'select',
                    'title'      => __( 'Border Color', 'w9-floral-addon' ),
                    'options'    => array(
                            '__'          => __( 'Default CSS', 'w9-floral-addon' ),
                            'custom'      => __( 'Custom Color', 'w9-floral-addon' ),
                            'p'           => __( 'Primary', 'w9-floral-addon' ),
                            's'           => __( 'Secondary', 'w9-floral-addon' ),
                            'meta-text'   => __( 'Meta Text Color', 'w9-floral-addon' ),
                            'border'      => __( 'Border Color', 'w9-floral-addon' ),
                            'text'        => __( 'Text Color', 'w9-floral-addon' ),
                            'light'       => __( 'Light #FFF', 'w9-floral-addon' ),
                            'dark'        => __( 'Dark #000', 'w9-floral-addon' ),
                            'gray2'       => __( 'Gray #222', 'w9-floral-addon' ),
                            'gray4'       => __( 'Gray #444', 'w9-floral-addon' ),
                            'gray6'       => __( 'Gray #666', 'w9-floral-addon' ),
                            'gray8'       => __( 'Gray #888', 'w9-floral-addon' ),
                        ) + floral_get_most_used_colors( 'key_name' ),
                    'default'    => '__',
                    'dependency' => array(
                        'element'  => 'tag_color',
                        'equal_to' => 'custom-style'
                    ),
                ),

                array(
                    'id'         => 'border_color_cp',
                    'type'       => 'colorpicker',
                    'dependency' => array(
                        'element'  => 'border_color',
                        'equal_to' => 'custom'
                    ),
                    'default'    => ''
                ),

                array(
                    'id'         => 'border_hover_color',
                    'type'       => 'select',
                    'title'      => __( 'Border Hover Color', 'w9-floral-addon' ),
                    'options'    => array(
                            '__'          => __( 'Default CSS', 'w9-floral-addon' ),
                            'custom'      => __( 'Custom Color', 'w9-floral-addon' ),
                            'p'           => __( 'Primary', 'w9-floral-addon' ),
                            's'           => __( 'Secondary', 'w9-floral-addon' ),
                            'meta-text'   => __( 'Meta Text Color', 'w9-floral-addon' ),
                            'border'      => __( 'Border Color', 'w9-floral-addon' ),
                            'text'        => __( 'Text Color', 'w9-floral-addon' ),
                            'light'       => __( 'Light #FFF', 'w9-floral-addon' ),
                            'dark'        => __( 'Dark #000', 'w9-floral-addon' ),
                            'gray2'       => __( 'Gray #222', 'w9-floral-addon' ),
                            'gray4'       => __( 'Gray #444', 'w9-floral-addon' ),
                            'gray6'       => __( 'Gray #666', 'w9-floral-addon' ),
                            'gray8'       => __( 'Gray #888', 'w9-floral-addon' ),
                        ) + floral_get_most_used_colors( 'key_name' ),
                    'default'    => '__',
                    'dependency' => array(
                        'element'  => 'tag_color',
                        'equal_to' => 'custom-style'
                    ),
                ),

                array(
                    'id'         => 'border_hover_color_cp',
                    'type'       => 'colorpicker',
                    'dependency' => array(
                        'element'  => 'border_hover_color',
                        'equal_to' => 'custom'
                    ),
                    'default'    => ''
                ),
            )
        
        );
        parent::__construct( $args );
    }

    public function widget( $args, $instance ) {
        $taxonomy = $tag_color = $text_color = $text_color_cp = $text_hover_color = $text_hover_color_cp = $background_color = $background_color_cp = $background_hover_color = $background_hover_color_cp = $border_color = $border_color_cp = $border_hover_color = $border_hover_color_cp = '';
        extract( $instance, EXTR_IF_EXISTS );
        $current_taxonomy = !empty( $taxonomy ) ? $taxonomy : 'post_tag';

        $tag_cloud = wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
            'taxonomy' => $current_taxonomy,
            'echo'     => false
        ) ) );
//        echo '<pre>';
//        var_dump( $instance );
//        echo '</pre>';
        
        if ( empty( $tag_cloud ) ) {
            return;
        }

        echo $args['before_widget'];
        $this->the_widget_title( $args, $instance );

        $unique_class   = uniqid( 'tagcloud-' );
        $internal_style = array();

        $tagcloud_class = array();

        if ( $tag_color === 'custom-style' ) {
            $tagcloud_class[] = $unique_class;

            //text color

            if ( $text_color !== 'custom' ) {
                $tagcloud_class[] = 'tag-tx-color-' . $text_color;
            } else {
                if ( !empty( $text_color_cp ) ) {
                    $internal_style[".tagcloud.$unique_class a"][] = 'color: ' . $text_color_cp;
                }
            }

            if ( $text_hover_color !== 'custom' ) {
                $tagcloud_class[] = 'tag-tx-hover-color-' . $text_hover_color;
            } else {
                if ( !empty( $text_hover_color_cp ) ) {
                    $internal_style[".tagcloud.$unique_class a:hover"][] = 'color: ' . $text_hover_color_cp;
                }
            }

            // bg color

            if ( $background_color !== 'custom' ) {
                $tagcloud_class[] = 'tag-bg-color-' . $background_color;
            } else {
                if ( !empty( $background_color_cp ) ) {
                    $internal_style[".tagcloud.$unique_class a"][] = 'background-color: ' . $background_color_cp;
                }
            }

            if ( $background_hover_color !== 'custom' ) {
                $tagcloud_class[] = 'tag-bg-hover-color-' . $background_hover_color;
            } else {
                if ( !empty( $background_hover_color_cp ) ) {
                    $internal_style[".tagcloud.$unique_class a:hover"][] = 'background-color: ' . $background_hover_color_cp;
                }
            }

            // border color

            if ( $border_color !== 'custom' ) {
                $tagcloud_class[] = 'tag-border-color-' . $border_color;
            } else {
                if ( !empty( $border_color_cp ) ) {
                    $internal_style[".tagcloud.$unique_class a"][] = 'border-color: ' . $border_color_cp;
                }
            }

            if ( $border_hover_color !== 'custom' ) {
                $tagcloud_class[] = 'tag-border-hover-color-' . $border_hover_color;
            } else {
                if ( !empty( $border_hover_color_cp ) ) {
                    $internal_style[".tagcloud.$unique_class a:hover"][] = 'border-color: ' . $border_hover_color_cp;
                }
            }
        }
        ob_start();
        ?>
        <div class="tagcloud <?php floral_the_clean_html_classes( $tagcloud_class ); ?>">';
            <?php echo $tag_cloud; ?>
        </div>
        <?php
        $this->widget_custom_css( $internal_style );
        echo ob_get_clean();
        echo $args['after_widget'];
    }
}