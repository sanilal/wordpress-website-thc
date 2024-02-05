<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: param-css_editor_lite.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !class_exists( 'WPBakeryVisualComposerCssEditorLite' ) ) {
    /**
     * Class WPBakeryVisualComposerCssEditorLite
     */
    class WPBakeryVisualComposerCssEditorLite {
        /**
         * @var array
         */
        protected $settings = array();
        /**
         * @var string
         */
        protected $value = '';
        /**
         * @var array
         */
        protected $layers = array( 'margin', 'padding' );
        /**
         * @var array
         */
        protected $positions = array( 'top', 'right', 'bottom', 'left' );
        
        /**
         *
         */
        function __construct() {
        }
        
        /**
         * Setters/Getters {{
         *
         * @param null $settings
         *
         * @return array
         */
        function settings( $settings = null ) {
            if ( is_array( $settings ) ) {
                $this->settings = $settings;
            }
            
            return $this->settings;
        }
        
        /**
         * @param $key
         *
         * @return string
         */
        function setting( $key ) {
            return isset( $this->settings[$key] ) ? $this->settings[$key] : '';
        }
        
        /**
         * @param null $value
         *
         * @return string
         */
        function value( $value = null ) {
            if ( is_string( $value ) ) {
                $this->value = $value;
            }
            
            return $this->value;
        }

        /**
         * vc_filter: vc_css_editor_lite - hook to override output of this method
         * @return mixed|void
         */
        function render() {
            $output = '<div class="vc_css-editor vc_row vc_ui-flex-row" data-css-editor-lite="true">';
            $output .= $this->onionLayout();
            $output .= '<input name="' . $this->setting( 'param_name' ) . '" class="wpb_vc_param_value  ' . $this->setting( 'param_name' ) . ' ' . $this->setting( 'type' ) . '_field" type="hidden" value="' . esc_attr( $this->value() ) . '"/>';
            $output .= '</div>';
            
            return apply_filters( 'vc_css_editor_lite', $output );
        }
        
        
        /**
         * @return string
         */
        function onionLayout() {
            $output = '<div class="vc_layout-onion vc_col-xs-7">'
                . '    <div class="vc_margin">' . $this->layerControls( 'margin' )
                . '      <div class="vc_border">' . $this->layerControls( 'border', 'width' )
                . '          <div class="vc_padding">' . $this->layerControls( 'padding' )
                . '              <div class="vc_content"><i></i></div>'
                . '          </div>'
                . '      </div>'
                . '    </div>'
                . '</div>';
            
            return apply_filters( 'vc_css_editor_lite_onion_layout', $output );
        }
        
        /**
         * @param        $name
         * @param string $prefix
         *
         * @return string
         */
        protected function layerControls( $name, $prefix = '' ) {
            $output = '<label>' . $name . '</label>';
            foreach ( $this->positions as $pos ) {
                $output .= '<input type="text" name="' . $name . '_' . $pos . ( '' !== $prefix ? '_' . $prefix : '' ) . '" data-name="' . $name . ( '' !== $prefix ? '-' . $prefix : '' ) . '-' . $pos . '" class="vc_' . $pos . '" placeholder="-" data-attribute="' . $name . '" value="">';
            }
            
            return apply_filters( 'vc_css_editor_lite_layer_controls', $output );
        }
    }
}

/**
 * @param $settings
 * @param $value
 *
 * @return mixed|void
 */
function floral_vc_css_editor_lite( $settings, $value ) {
    $css_editor_lite = new WPBakeryVisualComposerCssEditorLite();
    $css_editor_lite->settings( $settings );
    $css_editor_lite->value( $value );
    
    return $css_editor_lite->render();
}

add_action( 'vc_load_default_params', function () {
    vc_add_shortcode_param(
        'css_editor_lite',
        'floral_vc_css_editor_lite'
    );
} );
