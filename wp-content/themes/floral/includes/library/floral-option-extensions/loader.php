<?php

// You may replace {$redux_opt_name} with a string if you wish.
// Make sure {$redux_opt_name} is defined.

if ( !function_exists( 'redux_load_class_file' ) ) :
    function redux_load_class_file() {
        $path    = dirname( __FILE__ ) . '/extensions/';
        $folders = scandir( $path, 1 );
        foreach ( $folders as $folder ) {
            if ( $folder === '.' or $folder === '..' or !is_dir( $path . $folder ) ) {
                continue;
            }
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if ( !class_exists( $extension_class ) ) {
                // In case you wanted override your override, hah.
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                if ( $class_file ) {
                    require_once( $class_file );
                }
            }
        }
    }
    
    redux_load_class_file();
endif;


if ( !function_exists( 'redux_register_custom_extension_loader' ) ) :
    function redux_register_custom_extension_loader( $ReduxFramework ) {
        $path    = dirname( __FILE__ ) . '/extensions/';
        $folders = scandir( $path, 1 );
        foreach ( $folders as $folder ) {
            if ( $folder === '.' or $folder === '..' or !is_dir( $path . $folder ) ) {
                continue;
            }
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if ( class_exists( $extension_class ) ) {
                // In case you wanted override your override, hah.
                new $extension_class( $ReduxFramework );
            }
        }
    }
    
    // Modify redux_demo to match your opt_name
    add_action( "redux/extensions/before", 'redux_register_custom_extension_loader', 0 );
endif;