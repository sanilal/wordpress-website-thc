<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: extras.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 *  Extras helper functions
 *
 * @package floral
 */


/**
 * Put file content
 *
 * @param $path
 * @param $content
 *
 * @return mixed
 */
function floral_put_file_content( $path, $content ) {
	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}
	
	return $wp_filesystem->put_contents(
		$path,
		$content,
		FS_CHMOD_FILE // predefined mode settings for WP files
	);
}

/**
 * Get file content
 *
 * @param $path
 *
 * @return bool
 */
function floral_get_file_contents( $path ) {
	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}
	
	if ( file_exists( $path ) ) {
		return $wp_filesystem->get_contents( $path );
	}
	
	return false;
}

/**
 * If floral is demo mode or not
 *
 * @return bool
 */
function floral_is_rtl() {
	$is_rtl = floral_get_option( 'rtl-mode' );
	
	return isset( $_GET['rtl_mode'] ) || ! empty( $is_rtl );
}

/**
 * floral_copy_dir
 *
 * @param       $source_d
 * @param       $destination_d
 * @param array $skip_list
 *
 * @return bool|mixed
 */
function floral_copy_dir( $source_d, $destination_d, $skip_list = array() ) {
	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
	}
	
	if ( ! file_exists( $source_d ) ) {
		return false;
	}
	
	if ( ! file_exists( $destination_d ) ) {
		if ( ! wp_mkdir_p( $destination_d ) ) {
			return false;
		}
	}
	
	return copy_dir( $source_d, $destination_d, $skip_list );
}

/**
 * -----------------------------------------------------------------------------------------
 * Based on `https://github.com/mecha-cms/mecha-cms/blob/master/system/kernel/converter.php`
 * -----------------------------------------------------------------------------------------
 * Minify HTML
 *
 * @param $input
 *
 * @return mixed
 */
function floral_minify_html( $input ) {
	if ( trim( $input ) === "" ) {
		return $input;
	}
	// Remove extra white-space(s) between HTML attribute(s)
	$input = preg_replace_callback( '#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function ( $matches ) {
		return '<' . $matches[1] . preg_replace( '#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2] ) . $matches[3] . '>';
	}, str_replace( "\r", "", $input ) );
	// Minify inline CSS declaration(s)
	if ( strpos( $input, ' style=' ) !== false ) {
		$input = preg_replace_callback( '#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function ( $matches ) {
			return '<' . $matches[1] . ' style=' . $matches[2] . minify_css( $matches[3] ) . $matches[2];
		}, $input );
	}
	
	return preg_replace(
		array(
			// t = text
			// o = tag open
			// c = tag close
			// Keep important white-space(s) after self-closing HTML tag(s)
			'#<(img|input)(>| .*?>)#s',
			// Remove a line break and two or more white-space(s) between tag(s)
			'#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
			'#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s',
			// t+c || o+t
			'#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s',
			// o+o || c+c
			'#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s',
			// c+t || t+o || o+t -- separated by long white-space(s)
			'#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s',
			// empty tag
			'#<(img|input)(>| .*?>)<\/\1>#s',
			// reset previous fix
			'#(&nbsp;)&nbsp;(?![<\s])#',
			// clean up ...
			'#(?<=\>)(&nbsp;)(?=\<)#',
			// --ibid
			// Remove HTML comment(s) except IE comment(s)
			'#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
		),
		array(
			'<$1$2</$1>',
			'$1$2$3',
			'$1$2$3',
			'$1$2$3$4$5',
			'$1$2$3$4$5$6$7',
			'$1$2$3',
			'<$1$2',
			'$1 ',
			'$1',
			""
		),
		$input );
}


/**
 * Minify CSS
 *
 * @param $input
 *
 * @return mixed
 */
function floral_minify_css( $input ) {
	if ( trim( $input ) === "" ) {
		return $input;
	}
	
	return preg_replace(
		array(
			// Remove comment(s)
			'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
			// Remove unused white-space(s)
			'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
			// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
			'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
			// Replace `:0 0 0 0` with `:0`
			'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
			// Replace `background-position:0` with `background-position:0 0`
			'#(background-position):0(?=[;\}])#si',
			// Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
			'#(?<=[\s:,\-])0+\.(\d+)#s',
			// Minify string value
			'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
			'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
			// Minify HEX color code
			'#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
			// Replace `(border|outline):none` with `(border|outline):0`
			'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
			// Remove empty selector(s)
			'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
		),
		array(
			'$1',
			'$1$2$3$4$5$6$7',
			'$1',
			':0',
			'$1:0 0',
			'.$1',
			'$1$3',
			'$1$2$4$5',
			'$1$2$3',
			'$1:0',
			'$1$2'
		),
		$input );
}

/**
 * Minify JS
 *
 * @param $input
 *
 * @return mixed
 */
function floral_minify_js( $input ) {
	if ( trim( $input ) === "" ) {
		return $input;
	}
	
	return preg_replace(
		array(
			// Remove comment(s)
			'#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
			// Remove white-space(s) outside the string and regex
			'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
			// Remove the last semicolon
			'#;+\}#',
			// Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
			'#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
			// --ibid. From `foo['bar']` to `foo.bar`
			'#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
		),
		array(
			'$1',
			'$1$2',
			'}',
			'$1$3',
			'$1.$3'
		),
		$input );
}

/**
 * Minify js using JShrink api
 *
 * @param $input
 * @param $output
 *
 * @return bool|mixed
 * @throws Exception
 */
function floral_jshrink_minify_js( $input, $output ) {
	require_once( floral_theme_dir() . 'includes/library/jshrink/Minifier.php' );
	
	if ( ! file_exists( $input ) || empty( $output ) ) {
		return false;
	}
	
	$input_content = floral_get_file_contents( $input );
	$minified_js   = JShrink\Minifier::minify( $input_content, array( 'flaggedComments' => false ) );

//    $minified_js = floral_minify_js( $input_content );
	
	return floral_put_file_content( $output, $minified_js );
}

/**
 * Get all terms by taxanomy
 *
 * @param        $tax
 * @param string $key_field -accept slug or id
 *
 * @param array  $args
 *
 * @return array
 */
function floral_get_terms_by_tax( $tax, $key_field = 'id', $args = array() ) {
	$terms_list = array();
	if ( ! taxonomy_exists( $tax ) ) {
		return $terms_list;
	}
	
	$default_args = array( 'hide_empty' => true );
	
	$args             = wp_parse_args( $args, $default_args );
	$args['taxonomy'] = $tax;
	
	$terms = get_terms( $args );
	
	if ( is_array( $terms ) ) {
		switch ( $key_field ) {
			case 'slug':
				foreach ( $terms as $term ) {
					$terms_list[ $term->slug ] = $term->name;
				}
				break;
			case 'id':
				foreach ( $terms as $term ) {
					$terms_list[ $term->term_id ] = $term->name;
				}
				break;
		}
	}
	
	return $terms_list;
}

/* GET USER MENU LIST
    ================================================== */
if ( ! function_exists( 'floral_get_menu_list' ) ) {
	function floral_get_menu_list() {
		
		if ( ! is_admin() ) {
			return array();
		}
		
		$user_menus = floral_get_terms_by_tax( 'nav_menu' );
		
		return $user_menus;
	}
}
/**
 * Clean the html classes
 *
 * @param        $class
 * @param string $fallback
 *
 * @return string
 */
function floral_clean_html_classes( $class, $fallback = '' ) {
	if ( empty( $class ) ) {
		return '';
	}
	
	if ( is_string( $class ) ) {
		$class = explode( ' ', $class );
	}
	
	if ( is_array( $class ) ) {
		$extra_class = array();
		foreach ( $class as $id => $c ) {
			$c = trim( $c );
			if ( empty( $c ) ) {
				unset( $class[ $id ] );
				continue;
			}
			
			if ( strpos( $c, ' ' ) !== false ) {
				$extra_class = array_merge( $extra_class, explode( ' ', $c ) );
				unset( $class[ $id ] );
			}
		}
		
		$class = array_merge( $class, $extra_class );
		$class = array_map( 'sanitize_html_class', $class );
		
		return implode( ' ', $class );
	} else {
		return sanitize_html_class( $class, $fallback );
	}
}

/**
 * Get preset fonts list
 * @return array
 */
function floral_get_preset_fonts() {
	$fonts = array(
		"Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
		"'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
		"'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
		"'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
		"Courier, monospace"                                   => "Courier, monospace",
		"Garamond, serif"                                      => "Garamond, serif",
		"Georgia, serif"                                       => "Georgia, serif",
		"Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
		"'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
		"'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
		"'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
		"'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
		"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
		"Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
		"'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
		"'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
		"Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
		"blacksword, sans-serif"                               => "blacksword, sans-serif",
	);
	
	$default_options = floral_get_options_by_theme_options_name( FLORAL_THEME_OPTIONS_DEFAULT_NAME );
	if ( is_array( $default_options ) ) {
		for ( $i = 1; $i <= 2; $i ++ ) {
			if ( array_key_exists( 'custom_font_' . $i . '_name', $default_options ) ) {
				$custom_font = $default_options[ 'custom_font_' . $i . '_name' ];
			}
			if ( array_key_exists( 'custom_font_' . $i . '_ttf', $default_options ) ) {
				$ttf = $default_options[ 'custom_font_' . $i . '_ttf' ];
			}
			if ( array_key_exists( 'custom_font_' . $i . '_eot', $default_options ) ) {
				$eot = $default_options[ 'custom_font_' . $i . '_eot' ];
			}
			if ( array_key_exists( 'custom_font_' . $i . '_woff', $default_options ) ) {
				$woff = $default_options[ 'custom_font_' . $i . '_woff' ];
			}
			if ( isset( $custom_font ) && isset( $ttf ) && isset( $eot ) && isset( $woff ) && $custom_font != '' ) {
				$fonts[ $custom_font ] = 'Custom - ' . $custom_font;
			}
		}
	}
	
	return $fonts;
}

if ( ! function_exists( 'floral_custom_font_styles' ) ) {
	function floral_custom_font_styles() {
		$default_options = floral_get_options_by_theme_options_name( FLORAL_THEME_OPTIONS_DEFAULT_NAME );
		$custom_font_css = '';
		
		for ( $i = 1; $i <= 2; $i ++ ) {
			$src         = array();
			$custom_font = isset( $default_options[ 'custom_font_' . $i . '_name' ] ) ? $default_options[ 'custom_font_' . $i . '_name' ] : '';
			if ( $custom_font != '' ) {
				if ( isset( $default_options[ 'custom_font_' . $i . '_eot' ] ) && ! empty( $default_options[ 'custom_font_' . $i . '_eot' ]['url'] ) ) {
					$eot   = $default_options[ 'custom_font_' . $i . '_eot' ]['url'];
					$src[] = "url('$eot?#iefix') format('embedded-opentype')";
				}
				if ( isset( $default_options[ 'custom_font_' . $i . '_ttf' ] ) && ! empty( $default_options[ 'custom_font_' . $i . '_ttf' ]['url'] ) ) {
					$ttf   = $default_options[ 'custom_font_' . $i . '_ttf' ]['url'];
					$src[] = "url('$ttf') format('truetype')";
				}
				if ( isset( $default_options[ 'custom_font_' . $i . '_woff' ] ) && ! empty( $default_options[ 'custom_font_' . $i . '_woff' ]['url'] ) ) {
					$woff  = $default_options[ 'custom_font_' . $i . '_woff' ]['url'];
					$src[] = "url('$woff') format('woff')";
				}
				if ( isset( $default_options[ 'custom_font_' . $i . '_svg' ] ) && ! empty( $default_options[ 'custom_font_' . $i . '_svg' ]['url'] ) ) {
					$svg   = $default_options[ 'custom_font_' . $i . '_svg' ]['url'];
					$src[] = "url('$svg?#svgFontName') format('svg')";
				}
				if ( $src ) {
					$custom_font_css .= "@font-face { ";
					$custom_font_css .= "font-family: \"$custom_font\"; ";
					$custom_font_css .= "src: " . implode( ", ", $src ) . "; }" . "\r\n";
				}
			}
		}
		if ( $custom_font_css != '' ) {
			echo sprintf( '<style>%s</style>', $custom_font_css );
		}
	}
	
	add_action( 'wp_head', 'floral_custom_font_styles', 100 );
	add_action( 'admin_head', 'floral_custom_font_styles', 100 );
}

/**
 * @param        $class
 * @param string $fallback
 */
function floral_the_clean_html_classes( $class, $fallback = '' ) {
	echo floral_clean_html_classes( $class, $fallback );
}


/**
 * check if a plugin is active
 *
 * @param $plugin
 *
 * @return bool
 */
function floral_is_plugin_active( $plugin ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	return is_plugin_active( $plugin );
}

/**
 * check if woocommerce is active
 * @return bool
 */
function floral_is_woocommerce_active() {
	return floral_is_plugin_active( 'woocommerce/woocommerce.php' );
}


/**
 * Do output
 *
 * @param $ob
 */
function floral_output( $ob ) {
	echo '<pre>';
	var_dump( $ob );
	echo '</pre>';
}

/**
 * Is file1 newer than file2
 *
 * @param $file1
 * @param $file2
 *
 * @return bool
 */
function floral_is_newer( $file1, $file2 ) {
	if ( ! file_exists( $file1 ) ) {
		return false;
	} elseif ( ! file_exists( $file2 ) ) {
		return true;
	} else {
		return filemtime( $file1 ) > filemtime( $file2 );
	}
}


/**
 * Scan dir recursively, exclude '.', '..', and specific exclude files
 *
 * @param       $input_path
 * @param array $excludes
 *
 * @return array
 */
function floral_recursive_scandir( $input_path, $excludes = array() ) {
	$result = array();
	if ( ! is_dir( $input_path ) ) {
		$input_path = dirname( $input_path );
	}
	$scan_dir = scandir( $input_path, 1 );
	foreach ( $scan_dir as $file ) {
		if ( in_array( $file, array_merge( array( '.', '..' ), (array) $excludes ) ) ) {
			continue;
		}
		if ( is_dir( $input_path . DIRECTORY_SEPARATOR . $file ) ) {
			$result = array_merge( $result, floral_recursive_scandir( $input_path . DIRECTORY_SEPARATOR . $file, (array) $excludes ) );
		} else {
			$result[] = $input_path . DIRECTORY_SEPARATOR . $file;
		}
	}
	
	return $result;
}

/**
 * Post/Custom post type helper action
 */

function floral_get_post_content_by_id( $post_id, $post_type = 'post' ) {
	$the_post = get_post( $post_id );
	if ( $the_post instanceof WP_Post ) {
		if ( $the_post->post_type == $post_type ) {
			$content = apply_filters( 'the_content', $the_post->post_content );
		}
	}
	
	wp_reset_postdata();
	
	if ( isset( $content ) ) {
		return $content;
	} else {
		return false;
	}
}

//Should use this for avoid import problem
function floral_get_post_content_by_name( $post_name, $post_type = 'post' ) {
	$content_rendered = '';
	if ( post_type_exists( $post_type ) ) {
		$the_post = get_page_by_path( $post_name, OBJECT, $post_type );
		if ( is_array( $the_post ) ) {
			$the_post = reset( $the_post );
		}
		
		if ( $the_post instanceof WP_Post ) {
			$post_content     = $the_post->post_content;
			$content_rendered = apply_filters( 'the_content', $post_content );
			if ( function_exists( 'visual_composer' ) ) {
				$addition_css = visual_composer()->parseShortcodesCustomCss( $post_content );
			}
			if ( ! empty( $addition_css ) ) {
				if ( class_exists( 'Floral_VC_Customize' ) ) {
					Floral_VC_Customize::add_custom_shortcode_css( $addition_css );
				} else {
					$content_rendered .= sprintf( '<style id="%s-content-template-css">%s</style>', uniqid( Floral_Enqueue::STYLE_PREFIX ), $addition_css );
				}
			}
		}
	}
	
	return $content_rendered;
}

function floral_get_post_name_list( $key = "post_name", $args, $value_key = false ) {
	$default_args = array( 'numberposts' => - 1 );
	$args         = wp_parse_args( $args, $default_args );
	$posts        = get_posts( $args );
	$list         = array();
	
	if ( is_array( $posts ) ) {
		if ( $value_key ) {
			foreach ( $posts as $post ) {
				$list[ $post->post_title ] = $post->post_name;
			}
		} else {
			foreach ( $posts as $post ) {
				$list[ $post->{$key} ] = $post->post_title;
			}
		}
		
	}
	wp_reset_postdata();
	
	return $list;
}

/**
 * floral_get_content_template_list
 *
 * @param bool $value_key
 *
 * @param bool $allow_static
 *
 * @return array
 */
function floral_get_content_template_list( $value_key = false, $allow_static = true ) {
	static $content_template_list;
	static $content_template_list_vc;
	
	
	if ( $allow_static ) {
		if ( $value_key == false ) {
			if ( empty( $content_template_list ) ) {
				$content_template_list = floral_get_post_name_list( 'post_name', array( 'post_type' => 'content-template' ), $value_key );
			}
			
			return $content_template_list;
		} else {
			if ( empty( $content_template_list_vc ) ) {
				$content_template_list_vc = floral_get_post_name_list( 'post_name', array( 'post_type' => 'content-template' ), $value_key );
			}
			
			return $content_template_list_vc;
		}
	} else {
		return floral_get_post_name_list( 'post_name', array( 'post_type' => 'content-template' ), $value_key );
	}
}

/**
 * Get template prefix
 *
 * @param string $data_type
 *
 * @param null   $data_prefix
 *
 * @return string
 */
function floral_get_template_prefix( $data_type = 'prefix', $data_prefix = null ) {
	$data = array(
		'404'          => array(
			'prefix' => '_404-page-',
			'name'   => esc_html__( '404 Error Page', 'floral' )
		),
		'search'       => array(
			'prefix' => 'search-page-',
			'name'   => esc_html__( 'Search Page', 'floral' )
		),
		'post'         => array(
			'prefix' => 'blog-single-',
			'name'   => esc_html__( 'Blog Singe', 'floral' )
		),
		'archive-post' => array(
			'prefix' => 'blog-archive-',
			'name'   => esc_html__( 'Blog Archive', 'floral' )
		),
		'page'         => array(
			'prefix' => 'page-',
			'name'   => esc_html__( 'Single Page', 'floral' )
		)
	);
	
//	if ( class_exists( 'Floral_CPT_Portfolio' ) && post_type_exists( Floral_CPT_Portfolio::CPT_SLUG ) ) {
//		$data['portfolio']         = array(
//			'prefix' => 'portfolio-single-',
//			'name'   => esc_html__( 'Portfolio Single', 'floral' )
//		);
//		$data['archive-portfolio'] = array(
//			'prefix' => 'portfolio-archive-',
//			'name'   => esc_html__( 'Portfolio Archive', 'floral' )
//		);
//	}
	
	if ( class_exists( 'Floral_CPT_Service' ) && post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
		$data['service']         = array(
			'prefix' => 'service-single-',
			'name'   => esc_html__( 'Service Single', 'floral' )
		);
		$data['archive-service'] = array(
			'prefix' => 'service-archive-',
			'name'   => esc_html__( 'Service Archive', 'floral' )
		);
	}
	
	if ( class_exists( 'Floral_CPT_Event' ) && post_type_exists( Floral_CPT_Event::CPT_SLUG ) ) {
		$data['event']         = array(
			'prefix' => 'event-single-',
			'name'   => esc_html__( 'Event Single', 'floral' )
		);
		$data['archive-event'] = array(
			'prefix' => 'event-archive-',
			'name'   => esc_html__( 'Event Archive', 'floral' )
		);
	}
	
	if ( floral_is_woocommerce_active() ) {
		$data['product']         = array(
			'prefix' => 'product-single-',
			'name'   => esc_html__( 'Product Single', 'floral' )
		);
		$data['archive-product'] = array(
			'prefix' => 'product-archive-',
			'name'   => esc_html__( 'Product Archive', 'floral' )
		);
	}
	
	
	static $__template_prefix;
	$_template = '';
	$post_type = get_post_type();
	switch ( $data_type ) {
		case 'prefix':
			if ( empty( $__template_prefix ) ) {
				if ( is_404() ) {
					$__template_prefix = $data['404']['prefix'];
				} elseif ( is_search() ) {
					$__template_prefix = $data['search']['prefix'];
				} elseif ( is_singular( 'page' ) ) {
					$__template_prefix = $data['page']['prefix'];
				} elseif ( is_singular( 'post' ) ) {
					$__template_prefix = $data['post']['prefix'];
				} elseif ( ( is_archive() && $post_type == 'post' ) || is_home() ) {
					$__template_prefix = $data['archive-post']['prefix'];
				}
				
//				elseif ( is_singular( 'portfolio' ) ) {
//					$__template_prefix = $data['portfolio']['prefix'];
//				} elseif ( ( is_archive() && $post_type == 'portfolio' ) ) {
//					$__template_prefix = $data['archive-portfolio']['prefix'];
//				}
				
				elseif ( is_singular( 'service' ) ) {
					$__template_prefix = $data['service']['prefix'];
				} elseif ( ( is_archive() && $post_type == 'service' ) ) {
					$__template_prefix = $data['archive-service']['prefix'];
				} elseif ( is_singular( 'event' ) ) {
					$__template_prefix = $data['event']['prefix'];
				} elseif ( ( is_archive() && $post_type == 'event' ) ) {
					$__template_prefix = $data['archive-event']['prefix'];
				} elseif ( is_singular( 'product' ) ) {
					$__template_prefix = $data['product']['prefix'];
				} elseif ( ( is_archive() && $post_type == 'product' ) ) {
					$__template_prefix = $data['archive-product']['prefix'];
				} else {
					$__template_prefix = '';
				}
			}
			$_template = $__template_prefix;
			break;
		case 'name':
			if ( empty( $data_prefix ) ) {
				if ( is_404() ) {
					$_template = $data['404']['name'];
				} elseif ( is_search() ) {
					$_template = $data['search']['name'];
				} elseif ( is_singular( 'page' ) ) {
					$_template = $data['page']['name'];
				} elseif ( is_singular( 'post' ) ) {
					$_template = $data['post']['name'];
				} elseif ( ( is_archive() && $post_type == 'post' ) || is_home() ) {
					$_template = $data['archive-post']['name'];
				}
				
//				elseif ( is_singular( 'portfolio' ) ) {
//					$_template = $data['portfolio']['name'];
//				} elseif ( ( is_archive() && $post_type == 'portfolio' ) ) {
//					$_template = $data['archive-portfolio']['name'];
//				}
				
				elseif ( is_singular( 'service' ) ) {
					$_template = $data['service']['name'];
				} elseif ( ( is_archive() && $post_type == 'service' ) ) {
					$_template = $data['archive-service']['name'];
				} elseif ( is_singular( 'event' ) ) {
					$_template = $data['event']['name'];
				} elseif ( ( is_archive() && $post_type == 'event' ) ) {
					$_template = $data['archive-event']['name'];
				} elseif ( is_singular( 'product' ) ) {
					$_template = $data['product']['name'];
				} elseif ( ( is_archive() && $post_type == 'product' ) ) {
					$_template = $data['archive-product']['name'];
				}
			} else {
				foreach ( $data as $item => $value ) {
					if ( $data_prefix == $value['prefix'] ) {
						$_template = $value['name'];
						break;
					}
				}
			}
			break;
		case 'options_field':
			$_template = array();
			foreach ( $data as $item => $value ) {
				$_template[ $value['prefix'] ] = $value['name'];
			}
			break;
	}
	
	return $_template;
}


/**
 * floral_get_current_post_type
 *
 * Taken and modified from internet, https://gist.github.com/bradvin/1980309
 * @return mixed|null|string
 */
function floral_get_current_post_type() {
	global $post, $typenow, $current_screen;
	
	if ( $post && $post->post_type ) {
		return $post->post_type;
	} elseif ( $typenow ) {
		return $typenow;
	} elseif ( $current_screen && $current_screen->post_type ) {
		return $current_screen->post_type;
	} elseif ( isset( $_REQUEST['post_type'] ) ) {
		return sanitize_key( $_REQUEST['post_type'] );
	} elseif ( isset( $_GET['post'] ) ) {
		return get_post_field( 'post_type', $_GET['post'] );
	}
	
	return null;
}

/**
 * Get sidebar list
 *
 * @param bool $value_key
 *
 * @return array
 */
function floral_get_sidebar_list( $value_key = false ) {
	global $wp_registered_sidebars;
	$data = array();
	
	if ( $value_key ) {
		foreach ( $wp_registered_sidebars as $key => $value ) {
			$data[ $value['name'] ] = $key;
		}
	} else {
		foreach ( $wp_registered_sidebars as $key => $value ) {
			$data[ $key ] = $value['name'];
		}
	}
	
	return $data;
}

/**
 * floral_add_popup_item
 *
 * @param $item
 *
 * @return string
 */
function floral_add_popup_item( $item ) {
	global $floral_popup_list;
	if ( ! isset( $floral_popup_list ) ) {
		$floral_popup_list = array();
	}
	
	$item['id'] = $item['type'] . '-' . $item['content'];
	if ( ! isset( $floral_popup_list[ $item['id'] ] ) ) {
		$floral_popup_list[ $item['id'] ] = $item;
	}
	
	return $item['id'];
}

/**
 * floral_get_popup_list
 * @return array
 */
function floral_get_popup_list() {
	global $floral_popup_list;
	if ( ! isset( $floral_popup_list ) ) {
		$floral_popup_list = array();
	}
	
	return $floral_popup_list;
}