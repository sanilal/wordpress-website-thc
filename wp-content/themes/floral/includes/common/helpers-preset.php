<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: helpers-preset.php
 * @time    : 9/5/16 3:36 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


/**
 * @return string
 */
function floral_get_preset_list() {
    return get_theme_mod( FLORAL_PRESET_LIST_KEY, array() );
}

/**
 * Is preset exist
 *
 * @param $preset_name
 *
 * @return bool
 */
function floral_is_preset_exist( $preset_name ) {
    return !empty( $preset_name ) && array_key_exists( $preset_name, floral_get_preset_list() );
}


/**
 * floral_is_valid_preset
 *
 * @param $preset_name
 * @param $preset_title
 *
 * @return bool
 */
function floral_is_valid_preset( $preset_name, $preset_title ) {
    if ( !empty( $preset_name ) && !empty( $preset_title ) ) {
        $preset_list = floral_get_preset_list();
        
        return !in_array( $preset_name, array_keys( $preset_list ) ) && !in_array( $preset_title, array_values( $preset_list ) );
    }
    
    return false;
}

/**
 * floral_create_new_preset
 *
 * @param $preset_name
 * @param $preset_title
 */
function floral_create_new_preset( $preset_name, $preset_title ) {
    if ( floral_is_valid_preset( $preset_name, $preset_title ) ) {
        set_theme_mod( FLORAL_PRESET_LIST_KEY, array_merge( floral_get_preset_list(), array(
            $preset_name => $preset_title,
        ) ) );
    }
}

/**
 * floral_remove_preset
 *
 * @param $preset_name
 *
 * @return bool
 */
function floral_remove_preset( $preset_name ) {
    if ( floral_is_preset_exist( $preset_name ) ) {
        $preset_list = floral_get_preset_list();
        if ( $preset_name === floral_get_global_preset() ) {
            floral_set_global_preset( FLORAL_THEME_OPTIONS_DEFAULT_NAME );
        }
        
        unset( $preset_list[$preset_name] );
        
        set_theme_mod( FLORAL_PRESET_LIST_KEY, $preset_list );
        
        return true;
    }
    
    return false;
}


function floral_change_preset_title( $preset_name, $preset_title ) {
    if ( floral_is_preset_exist( $preset_name ) ) {
        $preset_list = floral_get_preset_list();
        
        $preset_list[$preset_name] = $preset_title;
        
        set_theme_mod( FLORAL_PRESET_LIST_KEY, $preset_list );
        
        return true;
    }
    
    return false;
}

/**
 * get global preset
 *
 * @return string
 */
function floral_get_global_preset() {
    return get_theme_mod( FLORAL_GLOBAL_PRESET_KEY );
}


/**
 * set global preset
 *
 * @param $preset_name
 *
 * @return bool
 */
function floral_set_global_preset( $preset_name ) {
    if ( !empty( $preset_name ) && array_key_exists( $preset_name, floral_get_preset_list() ) ) {
        set_theme_mod( FLORAL_GLOBAL_PRESET_KEY, $preset_name );
        
        return true;
    }
    
    return false;
}


/**
 * get current preset
 * @return string
 */
function floral_get_current_preset() {
    global $floral_global_preset_name;
    
    if ( empty( $floral_global_preset_name ) ) {
        $_main                     = floral_get_global_preset();
        $floral_global_preset_name = !empty( $_main ) ? $_main : FLORAL_THEME_OPTIONS_DEFAULT_NAME;
    }
    
    return $floral_global_preset_name;
}

/**
 * Set current preset
 *
 * @param $preset_name
 */
function floral_set_current_preset( $preset_name ) {
    global $floral_global_preset_name;
    if ( !empty( $preset_name ) && array_key_exists( $preset_name, floral_get_preset_list() ) ) {
        $floral_global_preset_name = $preset_name;
    }
}

/**
 * get_current_blog_css_folder
 *
 * @param string $current_preset
 *
 * @return string
 */
function floral_get_current_blog_css_folder( $current_preset = '' ) {
    $blog_id = get_current_blog_id();
    if ( empty( $blog_id ) ) {
        return floral_theme_dir();
    } else {
        if ( empty( $current_preset ) ) {
            $current_preset = floral_get_current_preset();
        }
        
        if ( $blog_id == 1 && $current_preset === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
            return floral_theme_dir();
        } else {
            $upload_dir = wp_upload_dir();
            if ( $upload_dir['error'] === false ) {
                $preset_css_folder = trailingslashit( $upload_dir['basedir'] ) . 'floral-preset-css/blog-' . $blog_id;
                
                if ( !file_exists( $preset_css_folder ) && !wp_mkdir_p( $preset_css_folder ) ) {
                    return floral_theme_dir();
                }
                
                return trailingslashit( $preset_css_folder );
            }
            
            return floral_theme_url();
        }
    }
}

/**
 * get_current_blog_css_folder_path
 *
 * @param string $current_preset
 *
 * @return string
 */
function floral_get_current_blog_css_folder_path( $current_preset = '' ) {
    $blog_id = get_current_blog_id();
    if ( empty( $blog_id ) ) {
        return floral_theme_url();
    } else {
        if ( empty( $current_preset ) ) {
            $current_preset = floral_get_current_preset();
        }
        
        if ( $blog_id == 1 && $current_preset === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
            return floral_theme_url();
        } else {
            $upload_dir = wp_upload_dir();
            
            if ( $upload_dir['error'] === false ) {
                $preset_css_folder = trailingslashit( $upload_dir['baseurl'] ) . 'floral-preset-css/blog-' . $blog_id;
                
                return trailingslashit( $preset_css_folder );
            } else {
                return floral_theme_url();
            }
        }
    }
}


/**
 * floral_clean_preset_css_files
 *
 * @param $preset_name
 */
function floral_clean_preset_css_files( $preset_name ) {
    if ( $preset_name === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
        return;
    }
    
    $current_css_folder = floral_get_current_blog_css_folder( $preset_name );
    $css_files = floral_recursive_scandir( $current_css_folder );
    
    $preset_list = floral_get_preset_list();
    
    if ( !empty( $preset_list ) && is_array( $preset_list ) ) {
        foreach ( $preset_list as $preset_name => $preset_title ) {
            foreach ( $css_files as $id => $file ) {
                if ( strpos( $file, $preset_name ) !== false ) {
                    unset( $css_files[$id] );
                }
            }
        }
    }
    
    // unlink the files
    foreach ( $css_files as $id => $file ) {
        @unlink( $file );
    }
}

//floral_set_global_preset( '__preset_1' );
//$current = floral_get_preset_list();
////////
//set_theme_mod( FLORAL_PRESET_LIST_KEY, array_merge( $current, array(
//    '__preset_1'     => 'Preset 1',
//    '__preset_2'     => 'Preset 2',
//    '__main_options' => 'Preset 3',
//) ) );
//remove_theme_mod( FLORAL_PRESET_LIST_KEY );

//set_theme_mod( '_options_preset_2', array() );





