<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: helpers-options.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Get Options array
 * @return array
 */
function floral_get_options() {
	
	if ( isset( $GLOBALS[ FLORAL_THEME_OPTIONS_VAR ] ) && is_array( $GLOBALS[ FLORAL_THEME_OPTIONS_VAR ] ) ) {
		$theme_options = $GLOBALS[ FLORAL_THEME_OPTIONS_VAR ];
	} else {
		$theme_options = get_option( floral_get_current_preset(), array() );
	}
	
	return $theme_options;
}

/**
 * @param $theme_options_name
 *
 * @return bool|mixed|void
 */
function floral_get_options_by_theme_options_name( $theme_options_name ) {
	$options = false;
	if ( floral_is_preset_exist( $theme_options_name ) ) {
		$options = get_option( $theme_options_name, array() );
	}
	
	return $options;
}


/**
 * @param        $key
 * @param string $post_id
 *
 * @return null
 */
function floral_get_meta_option( $key, $post_id = '', $subkey = '', $default = null ) {
	if ( !is_singular() ) {
		return $default;
	}
	
	if ( empty( $post_id ) ) {
		$post_id = get_the_ID();
		if ( $post_id === false ) {
//            var_dump($key);
			return $default;
		}
	}
	
	$key = 'meta-' . $key;
	
	if ( function_exists( 'redux_post_meta' ) ) {
		$meta_options = redux_post_meta( floral_get_current_preset(), $post_id );
		
		if ( isset( $meta_options[ $key ] ) ) {
			if ( empty( $subkey ) ) {
				return $meta_options[ $key ];
			} elseif ( is_array( $meta_options[ $key ] ) && isset( $meta_options[ $key ][ $subkey ] ) && ! empty( $meta_options[ $key ][ $subkey ] ) ) {
				return $meta_options[ $key ][ $subkey ];
			}
		}
	} else {
		$meta_options = get_post_meta( $post_id, $key, true );
		if ( isset( $meta_options ) ) {
			if ( empty( $subkey ) ) {
				return $meta_options;
			} elseif ( is_array( $meta_options ) && isset( $meta_options[ $subkey ] ) && ! empty( $meta_options[ $subkey ] ) ) {
				return $meta_options[ $subkey ];
			}
		}
	}
	
	return $default;
}


/**
 * @param $key
 *
 * @return bool|null
 */
function floral_get_option( $key, $subkey = '', $default = null, $template_prefix = '' ) {
	$theme_options = floral_get_options();
	
	if ( isset( $theme_options[ $template_prefix . $key ] ) ) {
		if ( empty( $subkey ) ) {
			return floral_check_redux_multi_default( $theme_options[ $template_prefix . $key ], $default );
		} elseif ( is_array( $theme_options[ $template_prefix . $key ] ) && isset( $theme_options[ $template_prefix . $key ][ $subkey ] ) && ! empty( $theme_options[ $template_prefix . $key ][ $subkey ] ) ) {
			return floral_check_redux_multi_default( $theme_options[ $template_prefix . $key ][ $subkey ], $default );
		}
	} elseif ( isset( $theme_options[ $key ] ) ) {
		if ( empty( $subkey ) ) {
			return floral_check_redux_multi_default( $theme_options[ $key ], $default );
		} elseif ( is_array( $theme_options[ $key ] ) && isset( $theme_options[ $key ][ $subkey ] ) && ! empty( $theme_options[ $key ][ $subkey ] ) ) {
			return floral_check_redux_multi_default( $theme_options[ $key ][ $subkey ], $default );
		}
		
	}
	
	return $default;
}

/**
 *
 * @param        $key
 * @param string $subkey
 * @param null   $default
 * @param string $template_prefix
 *
 * @return mixed|null
 */
function floral_get_meta_or_option( $key, $subkey = '', $default = null, $template_prefix = '' ) {
	$theme_options = floral_get_options();
	
	if ( is_singular() ) {
		$meta_option = floral_get_meta_option( $key, '', $subkey );
		
		if ( $meta_option !== '' && $meta_option !== '-1' && $meta_option !== null ) { // default values
			return floral_check_redux_multi_default( $meta_option, $default );
		}
	}
	
	if ( isset( $theme_options[ $template_prefix . $key ] ) ) {
		if ( empty( $subkey ) ) {
			return floral_check_redux_multi_default( $theme_options[ $template_prefix . $key ], $default );
		} elseif ( is_array( $theme_options[ $template_prefix . $key ] ) && isset( $theme_options[ $template_prefix . $key ][ $subkey ] ) && ! empty( $theme_options[ $template_prefix . $key ][ $subkey ] ) ) {
			return floral_check_redux_multi_default( $theme_options[ $template_prefix . $key ][ $subkey ], $default );
		}
	} elseif ( isset( $theme_options[ $key ] ) ) {
		if ( empty( $subkey ) ) {
			return floral_check_redux_multi_default( $theme_options[ $key ], $default );
		} elseif ( is_array( $theme_options[ $key ] ) && isset( $theme_options[ $key ][ $subkey ] ) && ! empty( $theme_options[ $key ][ $subkey ] ) ) {
			return floral_check_redux_multi_default( $theme_options[ $key ][ $subkey ], $default );
		}
		
	}
	
	return $default;
}

/**
 * floral_check_redux_multi_default
 *
 * @param $array
 * @param $default
 *
 * @return array
 */
function floral_check_redux_multi_default( $array, $default ) {
	if ( is_array( $array ) ) {
		$unit = '';
		if ( key_exists( 'units', $array ) ) {
			$unit = $array['units'];
		}
		
		foreach ( $array as $key => $value ) {
			if ( ( ( $value == '' ) || ( $key != 'units' && $value == $unit ) ) && is_array( $default ) ) {
				if ( key_exists( $key, $array ) && key_exists( $key, $default ) ) {
					$array[ $key ] = $default[ $key ];
				}
			};
		}
	}
	
	return $array;
}

/**
 * Metabox default value is '' or '-1', this is where theme options go on!
 *
 * @param $value
 *
 * @return bool
 */
function floral_is_meta_default_value( $value ) {
	return ( $value == '' || $value == '-1' );
}

/**
 * Resource Suffix
 * @return string
 */
function floral_resource_suffix() {
	return ( floral_get_option( 'use-min-files' ) ) ? '.min' : '';
}


/**
 * Get most used colors
 *
 * @param string $output
 * @param bool   $by_key
 *
 * @return array|string
 */
function floral_get_most_used_colors( $output = 'key_color', $by_key = false ) {
	$options          = floral_get_options_by_theme_options_name( FLORAL_THEME_OPTIONS_DEFAULT_NAME );
	$most_used_colors = isset( $options['most-used-color'] ) ? $options['most-used-color'] : array();
	$rs               = array();
	
	if ( ! empty( $most_used_colors ) && is_array( $most_used_colors ) ) {
		foreach ( (array) $most_used_colors as $id => $item ) {
			$name  = isset( $item['name'] ) ? preg_replace( '/[^a-zA-Z0-9\s_-]/', '', trim( $item['name'] ) ) : '';
			$color = isset( $item['color'] ) ? $item['color'] : '';
			if ( empty( $name ) || empty( $color ) ) {
				continue;
			}
			$key = sanitize_key( $name );
			
			switch ( $output ) {
				case 'key_color':
					$rs[ $key ] = $color;
					break;
				case 'name_key':
					$rs[ $name ] = $key;
					break;
				case 'key_name':
					$rs[ $key ] = $name;
					break;
				case 'name_color':
					$rs[ $name ] = $color;
					break;
				case 'color':
					if ( $by_key !== false ) {
						if ( $key == $by_key ) {
							return $color;
						}
					} else {
						$rs[] = $color;
					}
					break;
			}
		}
	}
	
	
	if ( $output === 'color' && $by_key !== false ) {
		return '';
	}
	
	return $rs;
}

/**
 * get_current_blog_css_file_path
 * @return string
 */
function floral_get_current_blog_css_file_path() {
	$blog_id = get_current_blog_id();
	
	if ( empty( $blog_id ) ) {
		return get_stylesheet_uri();
	} else {
		$current_preset  = floral_get_current_preset();
		$blog_css_folder = floral_get_current_blog_css_folder_path();
		
		if ( $current_preset === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
			return $blog_css_folder . 'style' . floral_resource_suffix() . '.css';
		} else {
			return $blog_css_folder . 'preset-' . sanitize_title( $current_preset ) . floral_resource_suffix() . '.css';
		}
	}
}

function floral_get_current_blog_css_file_dir( $preset_name = '' ) {
	$blog_id = get_current_blog_id();
	
	if ( empty( $blog_id ) ) {
		return floral_theme_dir() . 'style.css';
	} else {
		if ( floral_is_preset_exist( $preset_name ) ) {
			$current_preset = $preset_name;
		} else {
			$current_preset = floral_get_current_preset();
		}
		$blog_css_folder = floral_get_current_blog_css_folder();
		
		if ( $current_preset === FLORAL_THEME_OPTIONS_DEFAULT_NAME ) {
			return $blog_css_folder . 'style' . floral_resource_suffix() . '.css';
		} else {
			return $blog_css_folder . 'preset-' . sanitize_title( $current_preset ) . floral_resource_suffix() . '.css';
		}
	}
}
