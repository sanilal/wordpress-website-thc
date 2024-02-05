<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_share' ); // Sharing plugins can hook into here

$atts = array(
	'module_type'                  => 'share-this',
	'profiles'                     => 'social-twitter-url||social-facebook-url||social-googleplus-url',
    'share_this_label'            => esc_html__( 'Share:', 'floral' ),
//	'share_this_label'             => 'Share:',
	'icon_size'                    => '15',
	'icon_color'                   => 'custom-style',
	'colors'                       => 'text',
	'colors_hover'                 => 'p',
	'is_rounded_icon'              => '0',
	'rounded_size'                 => '30',
	'background_colors'            => 'p',
	'background_hover_colors'      => 'gray2',
	'spacing_between_items'        => '10',
	'floral_extra_widget_classes' => '',
	'floral_remove_default_mb'    => '1',
);

$extra_class   = array( 'floral-widget-social-profiles' );
$extra_class[] = $atts['floral_extra_widget_classes'];
if ( ! empty( $atts['floral_remove_default_mb'] ) ) {
	$extra_class[] = 'mb-0-i';
}

$args = array(
	'id'            => 'floral-widget-social-profiles',
	'name'          => esc_html__( 'Floral Social Profiles', 'floral' ),
	'before_widget' => '<section class="floral-widget %s ' . floral_clean_html_classes( $extra_class ) . '">',
	'after_widget'  => '</section>',
	'before_title'  => '<h3 class="floral-widget-title">',
	'after_title'   => '</h3>'
);


?>
<div class="product-sharing-wrapper pt-25 pt-xxs-max-15">
	<?php the_widget( 'Floral_Widget_Social_Profiles', $atts, $args ); ?>
</div>
