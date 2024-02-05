<?php

/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-demo-installer.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/*
 * INCLUDE FLORAL IMPORTER
 */
if ( file_exists( floral_theme_dir() . 'includes/admin-panel/floral-install-demo/class-floral-importer.php' ) ) {
    require_once floral_theme_dir() . 'includes/admin-panel/floral-install-demo/class-floral-importer.php';
}

//function dmp ($str) {
//    // do nothing
//}


class Floral_Demo_Installer {
    // the demo site you are build content and generate demo data
    const DEMO_SITE = 'http://floral.9wpthemes.com';
    // name of the current theme mode
    const DEMO_THEME_MOD = 'floral';
    
    
    /**
     * Install demo data phases
     */
    const PHASE_BEGIN = 0;
    const PHASE_CHECK_THEME_REQUIREMENT = 1;
    const PHASE_CHECK_LIBRARY = 2;
    const PHASE_CHECK_DATA_FILES = 3;
    const PHASE_IMPORT_DATA_OPTIONS = 4;
    const PHASE_IMPORT_DATA_DEMO_CATEGORIES = 5;
    const PHASE_IMPORT_DATA_DEMO_TAGS = 6;
    const PHASE_IMPORT_DATA_DEMO_TERMS = 7;
    const PHASE_IMPORT_DATA_DEMO_POSTS = 8;
    const PHASE_IMPORT_DATA_DEMO_UPDATE_N_CLEANUP = 9;
    const PHASE_IMPORT_DATA_UPDATE = 10;
    const PHASE_GENERATE_CSS = 11;
    const PHASE_IMPORT_REVSLIDER = 12;
    const PHASE_END = 13;
    
    static public $current_phase;
    
    /**
     * Floral_Demo_Installer constructor.
     */
    function __construct() {
        add_action( 'wp_ajax_install_demo_data', array( $this, 'install_data_demo' ) );
    }
    
    
    /**
     * Install demo data ajax function
     */
    function install_data_demo() {
        
        /*
         * GET REQUEST DATA
         */
        $phase     = isset( $_REQUEST['phase'] ) ? $_REQUEST['phase'] : self::PHASE_BEGIN;
        $demo_name = isset( $_REQUEST['demo_name'] ) ? $_REQUEST['demo_name'] : '';
        $demo_path = isset( $_REQUEST['demo_path'] ) ? $_REQUEST['demo_path'] : '';
        $dummy     = isset( $_REQUEST['dummy'] ) ? $_REQUEST['dummy'] : '';
        $options   = isset( $_REQUEST['options'] ) ? $_REQUEST['options'] : '1||1||1||1';
        
        $options = explode( '||', $options );
        //
        $demo_data_folder = FLORAL_DEMO_DATA_PATH . $demo_name;
        
        // check demo name
        if ( empty( $demo_name ) || !is_dir( $demo_data_folder ) ) {
            echo self::_return( 'error', esc_html__( 'Demo Not Found', 'floral' ) );
            die();
        }

        global $wp_filesystem;
        if ( empty( $wp_filesystem ) ) {
            require_once( ABSPATH . '/wp-admin/includes/file.php' );
            WP_Filesystem();
        }
        if ( $wp_filesystem->is_writable( floral_theme_dir() ) ) {
            if ( !class_exists( 'Floral_Importer' ) ) {
                echo self::_return( 'error', esc_html__( 'Importer Not Found', 'floral' ) );
                die();
            }
        }
        
        $fetching_images = true;
        if ( isset( $options[2] ) ) {
            $fetching_images = $options[2] != '0';
        }
        
        $importer = new Floral_Importer( $demo_data_folder, $demo_path, $fetching_images );

        self::$current_phase = $phase;
        switch ( $phase ) {
            case self::PHASE_BEGIN:
                echo self::_return( 'success', esc_html__( 'Start Install Demo Data', 'floral' ) );
                break;
            case self::PHASE_CHECK_THEME_REQUIREMENT:
                echo self::check_theme_requirement();
                break;
            case self::PHASE_CHECK_LIBRARY:
                echo self::check_library();
                break;
            case self::PHASE_CHECK_DATA_FILES:
                echo self::_return_with_arr( $importer->check_data_file( $options ) );
                break;
            case self::PHASE_IMPORT_DATA_OPTIONS:
                if ( isset( $options[0] ) && $options[0] == '1' ) {
                    echo self::_return_with_arr( $importer->import_data_options() );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_DATA_DEMO_CATEGORIES:
                if ( isset( $options[1] ) && $options[1] == '1' ) {
                    echo self::_return_with_arr( $importer->_import_categories() );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_DATA_DEMO_TAGS:
                if ( isset( $options[1] ) && $options[1] == '1' ) {
                    echo self::_return_with_arr( $importer->_import_tags() );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_DATA_DEMO_TERMS:
                if ( isset( $options[1] ) && $options[1] == '1' ) {
                    echo self::_return_with_arr( $importer->_import_terms() );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_DATA_DEMO_POSTS:
                if ( isset( $options[1] ) && $options[1] == '1' ) {
                    if ( !empty( $dummy ) && $dummy !== 'complete' ) {
                        $dummy = explode( '||', $dummy );
                        $dummy = $dummy[0];
                    }
                    echo self::_return_with_arr( $importer->_import_posts( $dummy ) );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_DATA_DEMO_UPDATE_N_CLEANUP:
                if ( isset( $options[1] ) && $options[1] == '1' ) {
                    echo self::_return_with_arr( $importer->_update_information_and_cleanup() );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_DATA_UPDATE:
                if ( isset( $options[0] ) && $options[0] == '1' ) {
                    echo self::_return_with_arr( $importer->update_data_changed() );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_GENERATE_CSS:
                if ( isset( $options[0] ) && $options[0] == '1' ) {
                    echo self::generate_css( $demo_data_folder );
                    break;
                } else {
                    self::$current_phase ++;
                }
            case self::PHASE_IMPORT_REVSLIDER:
                if ( isset( $options[3] ) && $options[3] == '1' ) {
                    if ( empty( $dummy ) || $dummy == 'complete' ) {
                        $dummy = '';
                    }
                    echo self::_return_with_arr( $importer->import_revslider( $dummy ) );
                    break;
                } else {
                    self::$current_phase ++;
                }
            default:
                self::$current_phase = self::PHASE_END;
                $importer->delete_last_transition_data();

                // save last installed demo
                $last_installed_demo   = get_theme_mod( 'last-installed-demo', array() );
                $last_installed_demo[] = $demo_name;
                set_theme_mod( 'last-installed-demo', $last_installed_demo );
                echo self::_return( 'success', esc_html__( 'We\'ve Just Got The End! Check out the site!', 'floral' ) );
                break;
        }
        die();
    }
    
    /**
     * Return message
     *
     * @param $array_rs
     *
     * @return false|string
     */
    static function _return_with_arr( $array_rs ) {
        $array_rs['phase'] = self::$current_phase;

        return wp_json_encode( $array_rs );
    }
    
    /**
     * @param        $status
     * @param        $message
     * @param string $process
     *
     * @return false|string
     */
    static function _return( $status, $message, $process = 'complete' ) {
        return wp_json_encode( array(
            'status'  => $status,
            'message' => $message,
            'phase'   => self::$current_phase,
            'process' => $process
        ) );
    }
    
    
    /**
     * Check theme requirement
     * @return false|string
     */
    static function check_theme_requirement() {
        $check_theme_requirement = Floral_Admin_Panel::check_theme_requirement();
        
        $is_theme_addon_active = floral_is_plugin_active( 'w9-floral-addon/w9-floral-addon.php' );
        
        $is_vc_active = floral_is_plugin_active( 'js_composer/js_composer.php' );

        
        if ( !$is_theme_addon_active || !$is_vc_active ) {
            return self::_return( 'error', esc_html__( 'W9 Floral Addon and Visual Composer plugins are required, please install and activate these two plugins and try again.', 'floral' ) );
        } elseif ( $check_theme_requirement ) {
            return self::_return( 'success', esc_html__( 'Passed theme requirement checking.', 'floral' ) );
        } else {
            return self::_return( 'warning', esc_html__( 'Some server configuration do not meet recommended theme requirement.', 'floral' ) );
        }
    }
    
    
    /**
     * Check library
     * @return false|string
     */
    static function check_library() {
        if ( !class_exists( 'Floral_Importer' ) ) {
            echo self::_return( 'error', esc_html__( 'Importer Not Found', 'floral' ) );
        }
        
        if ( !floral_is_plugin_active( 'revslider/revslider.php' ) ) {
            return self::_return( 'warning', esc_html__( 'Revolution Slider does not active, installation will not import sliders.', 'floral' ) );
        }
        
        return self::_return( 'success', esc_html__( 'Library loaded.', 'floral' ) );
    }
    
    /**
     * Regenerate CSS
     *
     * @param $demo_data_folder
     *
     * @return false|string
     */
    static function generate_css( $demo_data_folder ) {
        
        Floral()->options->compiler->set_variables( Floral()->options->variables->get_variables() );
        $formatter = floral_resource_suffix() ? 'compressed' : 'expanded';
        $rs        = Floral()->options->compiler->compile_all( $formatter );
        
        $source_d = trailingslashit( $demo_data_folder ) . 'floral-preset-css/';
        if ( !file_exists( $source_d ) ) {
            $copy_css_rs = false;
        } else {
            $upload_dir = wp_upload_dir();
            if ( $upload_dir['error'] === false ) {
                $destination_d = trailingslashit( $upload_dir['basedir'] ) . 'floral-preset-css/';

                if ( file_exists( $destination_d ) ) {
                    try {
                        self::rrmdir( $destination_d );
                    } catch ( Exception $e ) {
                        // do nothing
                    }
                }
                wp_mkdir_p( $destination_d );

                $copy_css_rs = floral_copy_dir( $source_d, $destination_d );
            } else {
                $copy_css_rs = false;
            }
        }

        $message = '';

        if ( $rs ) {
            $message .= esc_html__( 'Regenerate CSS Successful.', 'floral' ) . '<br/>';
        } else {
            $message .= esc_html__( 'There was some error when regenerate css, please try to re-generate css after install demo data.', 'floral' ) . '<br/>';
        }

        if ( $copy_css_rs ) {
            $message .= esc_html__( 'Copy Preset CSS Successful.', 'floral' );
        } else {
            $message .= sprintf( esc_html__( 'Copy Preset CSS Fail, please do copy folder "%s" to "%s" manually or you need to Save & Generate CSS manually yourself in Theme Options.', 'floral' ), $source_d, $destination_d );
        }


        if ( $rs && $copy_css_rs ) {
            return self::_return( 'success', $message );
        } else {
            return self::_return( 'warning', $message );
        }
    }

    static function rrmdir( $dir ) {
        if ( @is_dir( $dir ) ) {
            $objects = @scandir( $dir );
            foreach ( $objects as $object ) {
                if ( $object != "." && $object != ".." ) {
                    if ( @is_dir( $dir . "/" . $object ) ) {
                        self::rrmdir( $dir . "/" . $object );
                    } else {
                        @unlink( $dir . "/" . $object );
                    }
                }
            }
            @rmdir( $dir );
        }
    }
}

new Floral_Demo_Installer();