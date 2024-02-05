<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: breadcrumb.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

//$breadcrumb_wrapper_class = array();
//
//$template_prefix = floral_get_template_prefix();
//
//$breadcrumb_float_mode = floral_get_meta_or_option( 'page-title-breadcrumbs-float-mode', '', '1', $template_prefix );
//
//if ( $breadcrumb_float_mode == '0' ) {
//    $breadcrumb_wrapper_class[] = 'text-' . floral_get_meta_or_option( 'page-title-breadcrumbs-align', '', 'center', $template_prefix );
//} else {
//    $breadcrumb_wrapper_class[] = 'float-mode';
//}

?>
<div class="floral-breadcrumb-wrapper no-mb float-mode">
    <?php Floral_Breadcrumb()->print_breadcrumb_html( '', 'no-mb' ); ?>
</div>
