<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-scss.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use Leafo\ScssPhp\Compiler;

//require if not
require_once( floral_theme_dir() . 'includes/common/extras.php' );

class Floral_SCSS {
    // Constant
    const COMPILE_CORE = 0;
    const COMPILE_MODULES = 1;
    const COMPILE_ALL = 2;
    
    public $input;
    public $output;
    private $variables_path;
    
    public $variable;
    public $compiler;
    public $last_compile_time;
    
    
    function __construct( $input = '', $output = '' ) {
        
        if ( !class_exists( 'Compiler' ) ) {
            require( floral_theme_dir() . 'includes/library/scssphp/scss.inc.php' );
        }
        $this->compiler = new Compiler();
        $this->input    = floral_theme_dir() . 'assets/scss/style.scss';

        $this->output = floral_get_current_blog_css_file_dir();

        $this->variables_path = floral_theme_dir() . 'assets/scss/_variables.scss';
        // inportPaths
        $default_import_path = array(
            floral_theme_dir() . 'assets/scss/',
            floral_theme_dir() . 'assets/scss/core/',
            floral_theme_dir() . 'assets/scss/custom-style/',
            floral_theme_dir() . 'assets/scss/mixins/',
            floral_theme_dir() . 'assets/scss/modules/',
            floral_theme_dir() . 'assets/scss/rtl/',
            floral_theme_dir() . 'assets/scss/shortcodes/',
            floral_theme_dir() . 'assets/scss/bs/',
            floral_theme_dir() . 'assets/scss/bs/bootstrap/',
            floral_theme_dir() . 'assets/scss/bs/bootstrap/mixins/'
        );
        $this->set_import_paths( $default_import_path );
        $this->last_compile_time = false;
    }
    
    function set_import_paths( $paths ) {
        $this->compiler->setImportPaths( $paths );
    }
    
    function add_import_path( $path ) {
        $this->compiler->addImportPath( $path );
    }
    
    public function set_variables( $variables ) {
        $this->compiler->setVariables( (array) $variables );
    }
    
    public function add_variable( $name, $value ) {
        $current_vars = $this->compiler->getVariables();
        $current_vars = array_merge( $current_vars, array( $name => $value ) );
        $this->compiler->setVariables( (array) $current_vars );
    }
    
    
    public function compile_core() {
        
    }
    
    public function compile_modules() {
        
    }
    
    public function auto_compile_changed( $excludes = array(), $debug = false ) {
        if ( floral_is_dev_mode()) {
            if ( $this->is_scss_changed( $excludes ) ) {
                $this->compile_all();
                if ( $debug ) {
                    var_dump( $this->last_compile_time );
                }
            }
        }
    }
    
    public function is_scss_changed( $excludes = array() ) {
        if ( !file_exists( $this->output ) ) {
            return true;
        }
        $output_mtime = filemtime( $this->output );
        $scss_files   = floral_recursive_scandir( $this->input, $excludes );
        foreach ( $scss_files as $file ) {
            if ( filemtime( $file ) > $output_mtime ) {
                return true;
            }
        }

        return false;


    }
    
    
    function compile_single_scss_file( $files_config, $debug = false ) {
        if ( !is_array( $files_config ) ) {
            return;
        }
        
        $time    = microtime();
        $compile = false;
        foreach ( $files_config as $config ) {
            $input = isset( $config['input'] ) ? $config['input'] : '';
            if ( !file_exists( $input ) ) {
                continue;
            }
            
            $output     = isset( $config['output'] ) ? $config['output'] : '';
            $output_min = isset( $config['output_min'] ) ? $config['output_min'] : '';
            
            if ( !empty( $output ) ) {
                $this->compile( $input, $output, 'expanded' );
                $compile = true;
            }
            
            if ( !empty( $output_min ) ) {
                $this->compile( $input, $output_min, 'compressed' );
                $compile = true;
            }
        }
//        !$debug || !$compile || var_dump( "COMPILE SPECIFIC SCSS FILE TIME: " . ( microtime() - $time ) );
    }
    
    
    public function compile_variables() {
        $current_vars = $this->compiler->getVariables();
        ob_start();
        foreach ( $current_vars as $name => $value ) {
            echo self::variable_output_format( $name, $value );
        }
        $scss_vars = ob_get_clean();
        if ( !floral_put_file_content( $this->variables_path, $scss_vars ) ) {
            $this->return_fail_message( esc_html__( 'Could not save variables.scss file, please check your theme permission of create/write file.', 'floral' ) );
        };
        
    }
    
    static function variable_output_format( $name, $value ) {
        return sprintf( '$%s: %s;' . PHP_EOL, $name, $value );
    }
    
    public function compile_all( $formatter = '', $ajax_response = true ) {
        //debug time
        $start_time = microtime();
        try {
            $scss_code = floral_get_file_contents( $this->input );
            if ( floral_is_dev_mode() ) {
                $this->compiler->setLineNumberStyle( Compiler::LINE_COMMENTS );
                $this->compiler->setFormatter( 'Leafo\ScssPhp\Formatter\Expanded' );
                $this->compile_variables();
            } else {
                if ( empty( $formatter ) ) {
                    $formatter = 'Compressed';
                }
                $this->compiler->setLineNumberStyle( null );
                $this->compiler->setFormatter( 'Leafo\ScssPhp\Formatter\\' . ucfirst( $formatter ) );
            }
            
            $css = $this->compiler->compile( $scss_code );
            if ( !floral_put_file_content( $this->output, $css ) ) {
                
                if ( defined( 'DOING_AJAX' ) && ( $_REQUEST['action'] === floral_get_current_preset() . '_ajax_save' ) ) {
                    $this->return_fail_message( esc_html__( 'Could not save css, please check your theme permission of create/write file.', 'floral' ) );
                } else {
                    return false;
                }
            };
        } catch ( Exception $e ) {
            error_log( $e->getMessage() );
            if ( defined( 'DOING_AJAX' ) && ( $_REQUEST['action'] === floral_get_current_preset() . '_ajax_save' ) ) {
                $this->return_fail_message( $e->getMessage() . ', action name was: ' . $_REQUEST['action'] );
            } else {
                return false;
            }
        }
        //calculate the time
	    $this->last_compile_time = (float) microtime() - (float) $start_time;
        
        return true;
    }
    
    public function compile( $input, $output = false, $formatter = '' ) {
        try {
            $scss_code = floral_get_file_contents( $input );
            $this->compiler->setLineNumberStyle( null );
            $this->compiler->setFormatter( 'Leafo\ScssPhp\Formatter\\' . ( $formatter ? ucfirst( $formatter ) : 'Nested' ) );
            
            $css = $this->compiler->compile( $scss_code );
            
            if ( $output == false ) {
                return $css;
            } else {
                if ( !floral_put_file_content( $output, $css ) ) {
                    return false;
                };
            }
            
        } catch ( Exception $e ) {
            error_log( $e->getMessage() );
            
            return false;
        }
        
        return true;
    }
    
    private function return_fail_message( $message ) {
        echo json_encode( array(
            'status' => $message
        ) );
        die();
    }
}
