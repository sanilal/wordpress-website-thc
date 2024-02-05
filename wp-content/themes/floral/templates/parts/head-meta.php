<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: head-meta.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ): ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
<?php endif; ?>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if IE]>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
$favicon_16 = floral_get_option( 'favicon-16', 'url' );
if ( !empty( $favicon_16 ) ) : ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_16 ); ?>" sizes="16x16">
<?php endif;
$favicon_32 = floral_get_option( 'favicon-32', 'url' );
if ( !empty( $favicon_32 ) ) : ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_32 ); ?>" sizes="32x32">
<?php endif;
$favicon_96 = floral_get_option( 'favicon-96', 'url' );
if ( !empty( $favicon_96 ) ) : ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_96 ); ?>" sizes="96x96">
<?php endif;
$favicon_160 = floral_get_option( 'favicon-160', 'url' );
if ( !empty( $favicon_160 ) ) : ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_160 ); ?>" sizes="160x160">
<?php endif;
$favicon_192 = floral_get_option( 'favicon-192', 'url' );
if ( !empty( $favicon_192 ) ) : ?>
    <link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_192 ); ?>" sizes="192x192">
<?php endif;
$favicon_a_57 = floral_get_option( 'favicon-a-57', 'url' );
if ( !empty( $favicon_a_57 ) ) : ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url( $favicon_a_57 ); ?>">
<?php endif;
$favicon_a_60 = floral_get_option( 'favicon-a-60', 'url' );
if ( !empty( $favicon_a_60 ) ) : ?>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url( $favicon_a_60 ); ?>">
<?php endif;
$favicon_a_72 = floral_get_option( 'favicon-a-72', 'url' );
if ( !empty( $favicon_a_72 ) ) : ?>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $favicon_a_72 ); ?>">
<?php endif;
$favicon_a_76 = floral_get_option( 'favicon-a-76', 'url' );
if ( !empty( $favicon_a_76 ) ) : ?>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( $favicon_a_76 ); ?>">
<?php endif;
$favicon_a_114 = floral_get_option( 'favicon-a-114', 'url' );
if ( !empty( $favicon_a_114 ) ) : ?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $favicon_a_114 ); ?>">
<?php endif;
$favicon_a_120 = floral_get_option( 'favicon-a-120', 'url' );
if ( !empty( $favicon_a_120 ) ) : ?>
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( $favicon_a_120 ); ?>">
<?php endif;
$favicon_a_144 = floral_get_option( 'favicon-a-144', 'url' );
if ( !empty( $favicon_a_144 ) ) : ?>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( $favicon_a_144 ); ?>">
<?php endif;
$favicon_a_152 = floral_get_option( 'favicon-a-152', 'url' );
if ( !empty( $favicon_a_152 ) ) : ?>
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( $favicon_a_152 ); ?>">
<?php endif;
$favicon_a_180 = floral_get_option( 'favicon-a-180', 'url' );
if ( !empty( $favicon_a_180 ) ) : ?>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $favicon_a_180 ); ?>">
<?php endif;
if ( floral_get_option( 'favicon-win-color' ) != '' ) : ?>
    <meta name="msapplication-TileColor" content="<?php echo esc_attr( floral_get_option( 'favicon-win-color' ) ); ?>" />
<?php endif;
$favicon_win_70 = floral_get_option( 'favicon-win-70', 'url' );
if ( !empty( $favicon_win_70 ) ) : ?>
    <meta name="msapplication-square70x70logo" content="<?php echo esc_url( $favicon_win_70 ); ?>" />
<?php endif;
$favicon_win_150 = floral_get_option( 'favicon-win-150', 'url' );
if ( !empty( $favicon_win_150 ) ) : ?>
    <meta name="msapplication-square150x150logo" content="<?php echo esc_url( $favicon_win_150 ); ?>" />
<?php endif;
$favicon_win_310 = floral_get_option( 'favicon-win-310', 'url' );
if ( !empty( $favicon_win_310 ) ) : ?>
    <meta name="msapplication-wide310x150logo" content="<?php echo esc_url( $favicon_win_310 ); ?>" />
<?php endif;
$favicon_win_310_quad = floral_get_option( 'favicon-win-310-quad', 'url' );
if ( !empty( $favicon_win_310_quad ) ) : ?>
    <meta name="msapplication-square310x310logo" content="<?php echo esc_url( $favicon_win_310_quad ); ?>" />
<?php endif; ?>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->