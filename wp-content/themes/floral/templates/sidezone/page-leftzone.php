<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: page-leftzone.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$leftzone_content = floral_get_meta_or_option('page-leftzone-sidebar');
$leftzone_bottom_content = floral_get_meta_or_option('page-leftzone-bottom-sidebar');
$leftzone_position = floral_get_meta_or_option('page-leftzone-position');
$leftzone_default_open = floral_get_meta_or_option('page-leftzone-default-open');

$leftzone_classes = array();

if($leftzone_position === 'static'){
    $leftzone_classes[] = 'zone-static';
}else{
    $leftzone_classes[] = 'zone-fixed';
}

?>
<div id="page-leftzone" class="page-leftzone  <?php floral_the_clean_html_classes( $leftzone_classes ); ?>">
    <div class="zone-content">
        <div class="sidebar sidebar-zone-main clearfix">
            <?php dynamic_sidebar( $leftzone_content ); ?>
        </div>
        <div class="sidebar sidebar-zone-bottom clearfix">
            <?php dynamic_sidebar( $leftzone_bottom_content ); ?>
        </div>
        <div class="dismiss-zone <?php echo floral_get_meta_or_option('page-leftzone-dismiss-position') ?>">
            <a href="javascript:void(0);" onclick="floral.page.page_leftzone()" title="<?php echo esc_html__('Close', 'floral')?>">
                <i class="<?php echo floral_get_option('page-leftzone-dismiss-icon')?>"></i>
            </a>
        </div>
    </div>
</div>