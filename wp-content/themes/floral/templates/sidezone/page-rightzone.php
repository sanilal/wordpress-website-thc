<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: page-rightzone.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}


$rightzone_content = floral_get_meta_or_option('page-rightzone-sidebar');
$rightzone_bottom_content = floral_get_meta_or_option('page-rightzone-bottom-sidebar');
$rightzone_position = floral_get_meta_or_option('page-rightzone-position');
$rightzone_default_open = floral_get_meta_or_option('page-rightzone-default-open');

$rightzone_classes = array();

if($rightzone_position === 'static'){
    $rightzone_classes[] = 'zone-static';
}else{
    $rightzone_classes[] = 'zone-fixed';
}

?>
<div id="page-rightzone" class="page-rightzone  <?php floral_the_clean_html_classes( $rightzone_classes ); ?>">
    <div class="zone-content">
        <div class="sidebar sidebar-zone-main clearfix">
            <?php dynamic_sidebar( $rightzone_content ); ?>
        </div>
        <div class="sidebar sidebar-zone-bottom clearfix">
            <?php dynamic_sidebar( $rightzone_bottom_content ); ?>
        </div>
        <div class="dismiss-zone <?php echo floral_get_meta_or_option('page-rightzone-dismiss-position') ?>">
            <a href="javascript:void(0);" onclick="floral.page.page_rightzone()" title="<?php echo esc_html__('Close', 'floral')?>">
                <i class="<?php echo floral_get_option('page-rightzone-dismiss-icon')?>"></i>
            </a>
        </div>
    </div>
</div>