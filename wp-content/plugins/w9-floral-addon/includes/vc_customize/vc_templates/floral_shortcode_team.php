<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_team.php
 * @time    : 8/26/16 11:55 AM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Team
 * @var $atts
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$member_style       = '';
$is_inverse         = '';
$hover_style        = '';
$member_name        = '';
$member_url         = '';
$member_role        = '';
$member_avatar      = '';
$avatar_size        = '';
$custom_avatar_size = '';
$avatar_ratio       = '';
$avatar_onclick     = '';
$member_description = '';
$member_socials     = ''; //Include index social_type , social_url

$el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$member_hover_style = '';
if ( in_array( $member_style, array( 'style-1', 'style-1i' ) ) ) {
	$member_hover_style = 'item-' . $hover_style;
}
$inverse_style = '';
if ($member_style === 'style-4') {
	if ($is_inverse === '1') {
		$inverse_style = 'inverse-style';
	}
}

$sc_classes = array(
	$el_class,
	'item-' . $member_style,
	$inverse_style,
	$member_hover_style,
	Floral_Map_Helpers::get_class_animation( $animation_css ),
	vc_shortcode_custom_css_class( $css ),
);

if ( $avatar_size === 'custom' ) {
	$avatar_size = $custom_avatar_size;
}

$inline_css = array();

$member_socials = (array) vc_param_group_parse_atts( $member_socials );
$member_url     = (array) vc_build_link( $member_url );
$social_list    = Floral_SC_Team::get_team_social_list();

//Render HTML
?>
<div class="floral-team-member <?php floral_the_clean_html_classes( $sc_classes ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( $inline_css, $animation_duration, $animation_delay ) ?>>
	<?php
	if ( in_array( $member_style, array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5' ) ) ) {
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-team/' . $member_style . '.php' );
	} elseif ( $member_style === 'style-1i' ) {
		include( Floral_Addon::plugin_dir( __FILE__ ) . 'parts/floral-team/style-1.php' );
	}
	?>
</div>