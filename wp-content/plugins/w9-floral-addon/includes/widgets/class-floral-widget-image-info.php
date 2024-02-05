<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-widget-image-info.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_Widget_Image_Info extends Floral_Widget_Base {
    /**
     * Floral_Widget_Image_Info constructor.
     */
    public function __construct() {
        $args = array(
            'id'      => 'floral-widget-image-info',
            'name'    => esc_html__( 'Floral Image Info', 'w9-floral-addon' ),
            'options' => array(
                'classname'   => 'floral-widget-image-info',
                'description' => esc_html__( 'Widget to show image information in the sidebar.', 'w9-floral-addon' )
            ),
            'fields'  => array(
                array(
                    'id'      => 'title',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Title', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'    => 'image',
                    'type'  => 'image-selector',
                    'title' => esc_html__( 'Image', 'w9-floral-addon' ),
                ),
                array(
                    'id'    => 'image_alt',
                    'type'  => 'text',
                    'title' => esc_html__( 'Image Alt', 'w9-floral-addon' ),
                ),
                array(
                    'id'    => 'image_url',
                    'type'  => 'text',
                    'title' => esc_html__( 'Image Link', 'w9-floral-addon' ),
                ),
                array(
                    'id'      => 'image_width',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Image Width (*Option; units: px, em, auto, ...)', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'image_height',
                    'type'    => 'text',
                    'title'   => esc_html__( 'Image Height (*Option; units: px, em, auto, ...)', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'      => 'image_mb',
                    'type'    => 'number',
                    'title'   => __( 'Image Margin Bottom (*Option; unit: px)', 'w9-floral-addon' ),
                    'default' => ''
                ),
                array(
                    'id'    => 'information',
                    'type'  => 'textarea',
                    'title' => esc_html__( 'Information', 'w9-floral-addon' ),
                ),
                array(
                    'id'    => 'read_more_link',
                    'type'  => 'text',
                    'title' => esc_html__( 'Read More Link', 'w9-floral-addon' ),
                )
            )

        );
        parent::__construct( $args );
    }

    public function widget_content( $args, $instance ) {
        $image = $image_alt = $image_url = $image_width = $image_height = $image_mb = $information = $read_more_link = $vertical_align_middle = '';
        extract( $instance, EXTR_IF_EXISTS );
        $img_inline_css = array();
        if ( !empty( $image_width ) ) {
            $img_inline_css[] = 'width: ' . $image_width;
        }

        if ( !empty( $image_height ) ) {
            $img_inline_css[] = 'height: ' . $image_height;
        }

        if ( !empty( $image_mb ) ) {
            $img_inline_css[] = 'margin-bottom: ' . $image_mb . 'px';
        }

        $this->the_widget_title( $args, $instance );
        ob_start();
        ?>
        <div class="image-info-wrapper">
            
            <?php if ( !empty( $image ) ): ?>
                <div class="__image fz-0">
                    <?php if ( !empty( $image_url ) ): ?>
                    <a class="" href="<?php echo esc_url( $image_url ); ?>" title="<?php echo esc_attr( $image_alt ); ?>">
                        <?php endif; ?>

                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" <?php echo $this->get_inline_style( $img_inline_css ); ?>>

                        <?php if ( !empty( $image_url ) ): ?>
                    </a>
                <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( !empty( $information ) ): ?>
                <div class="information">
                    <?php echo wp_kses_post( $information ); ?>
                </div>
            <?php endif; ?>

            <?php if ( !empty( $read_more_link ) ): ?>
                <a class="read-more-link" href="<?php echo esc_url( $read_more_link ); ?>" target="_self" title="<?php echo esc_attr__( 'Click here to read more information.', 'w9-floral-addon' ) ?>"><?php echo esc_html__( 'Read more', 'w9-floral-addon' ); ?></a>
            <?php endif; ?>

        </div>
        <?php
        echo ob_get_clean();
    }
}
