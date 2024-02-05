<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral-thumbnail-slider.php
 * @time    : 12/13/2016 4:46 AM
 * @author  : 9WPThemes Team
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if(!class_exists('Floral_SC_Thumbnail_Slider')){
	class Floral_SC_Thumbnail_Slider extends WPBakeryShortCode{
		const SC_BASE = 'floral_shortcode_thumbnail_slider';
	}
}