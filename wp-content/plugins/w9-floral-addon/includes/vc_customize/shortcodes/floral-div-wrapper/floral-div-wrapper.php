<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-div-wrapper.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Floral_SC_Div_Wrapper extends WPBakeryShortCodesContainer {
    const SC_BASE = 'floral_shortcode_div_wrapper';

    public function getColumnControls( $controls = 'full', $extended_css = '' ) {
        $controls_start = '<div class="vc_controls vc_controls-visible controls_column floral-div-wrapper-controls ' . ( !empty( $extended_css ) ? " {$extended_css}" : '' ) . '">';
        $controls_end   = '</div>';

        if ( 'bottom-controls' === $extended_css ) {
            $control_title = sprintf( __( 'Append to this %s', 'w9-floral-addon' ), strtolower( $this->settings( 'name' ) ) );
        } else {
            $control_title = sprintf( __( 'Prepend to this %s', 'w9-floral-addon' ), strtolower( $this->settings( 'name' ) ) );
        }

        $controls_move   = '<a class="vc_control column_move" data-vc-control="move" href="#" title="' . sprintf( __( 'Move this %s', 'w9-floral-addon' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
        $controls_add    = '<a class="vc_control column_add" data-vc-control="add" href="#" title="' . $control_title . '"><span class="vc_icon"></span></a>';
        $controls_edit   = '<a class="vc_control column_edit" data-vc-control="edit" href="#" title="' . sprintf( __( 'Edit this %s', 'w9-floral-addon' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
        $controls_clone  = '<a class="vc_control column_clone" data-vc-control="clone" href="#" title="' . sprintf( __( 'Clone this %s', 'w9-floral-addon' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
        $controls_delete = '<a class="vc_control column_delete" data-vc-control="delete" href="#" title="' . sprintf( __( 'Delete this %s', 'w9-floral-addon' ), strtolower( $this->settings( 'name' ) ) ) . '"><span class="vc_icon"></span></a>';
        $controls_full   = $controls_move . $controls_add . $controls_edit . $controls_clone . $controls_delete;

        $editAccess = vc_user_access_check_shortcode_edit( $this->shortcode );
        $allAccess  = vc_user_access_check_shortcode_all( $this->shortcode );

        if ( !empty( $controls ) ) {
            if ( is_string( $controls ) ) {
                $controls = array( $controls );
            }
            $controls_string = $controls_start;
            foreach ( $controls as $control ) {
                $control_var = 'controls_' . $control;
                if ( ( $editAccess && 'edit' == $control ) || $allAccess ) {
                    if ( isset( ${$control_var} ) ) {
                        $controls_string .= ${$control_var};
                    }
                }
            }

            return $controls_string . $controls_end;
        }

        if ( $allAccess ) {
            return $controls_start . $controls_full . $controls_end;
        } elseif ( $editAccess ) {
            return $controls_start . $controls_edit . $controls_end;
        }

        return $controls_start . $controls_end;
    }

    /**
     * @param      $atts
     * @param null $content
     *
     * @return string
     */
    public function contentAdmin( $atts, $content = null ) {
        $width = $el_class = '';

        $atts = shortcode_atts( $this->predefined_atts, $atts );
        extract( $atts );
        $this->atts = $atts;
        $output     = '';

        for ( $i = 0; $i < count( $width ); $i ++ ) {
            $output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';
            if ( $this->backened_editor_prepend_controls ) {
                $output .= $this->getColumnControls( $this->settings( 'controls' ) );
            }
            $output .= '<div class="wpb_element_wrapper">';

            if ( isset( $this->settings['custom_markup'] ) && '' !== $this->settings['custom_markup'] ) {
                $markup = $this->settings['custom_markup'];
                $output .= $this->customMarkup( $markup );
            } else {
                $output .= $this->paramsHtmlHolders( $atts );
                $output .= $this->outputTitle( $this->settings['name'] );
                $output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';
                $output .= do_shortcode( shortcode_unautop( $content ) );
                $output .= '</div>';
            }

            $output .= '</div>';
            if ( $this->backened_editor_prepend_controls ) {
                $output .= $this->getColumnControls( 'add', 'bottom-controls' );

            }
            $output .= '</div>';
        }

        return $output;
    }

}