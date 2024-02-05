<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: head-social-meta.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (! is_singular()
		|| floral_get_option('social-meta-tag') !== '1') {
    return;
}

$title             = get_the_title();
$permalink         = get_permalink();
$site_name         = get_bloginfo( 'name' );
$excerpt           = get_the_excerpt();
$content           = get_the_content();

if (function_exists( 'mb_strimwidth' ) && $excerpt == '') {
    $excerpt = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $content );
    $excerpt = trim($excerpt);
    $excerpt = strip_tags($excerpt);
    $excerpt = mb_strimwidth( $excerpt, 0, 100, '...' );
}

$image_url = '';
if (has_post_thumbnail(get_the_ID())) {
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
    $image_url = $thumbnail[0];
}

?>
<!-- Facebook Meta -->
<meta property="og:title" content="<?php echo esc_attr($title); ?> - <?php echo esc_attr($site_name); ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="<?php echo esc_url($permalink); ?>"/>
<meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>"/>
<meta property="og:description" content="<?php echo esc_attr($excerpt);?>">
<?php if (!empty($image_url)) : ?>
    <meta property="og:image" content="<?php echo esc_url($image_url); ?>"/>
<?php endif; ?>

<?php //if ( function_exists( 'is_product' ) && is_product() ) : ?>
<!--    --><?php //$product = new WC_Product( $post->ID ); ?>
<!--    <meta property="og:price:amount" content="--><?php //echo esc_attr($product->price);?><!--" />-->
<!--    <meta property="og:price:currency" content="--><?php //echo esc_attr(get_woocommerce_currency()); ?><!--" />-->
<?php //endif; ?>

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
<meta name="twitter:description" content="<?php echo esc_attr($excerpt); ?>">

<?php if (!empty($image_url)) : ?>
    <meta property="twitter:image:src" content="<?php echo esc_url($image_url); ?>"/>
<?php endif; ?>
