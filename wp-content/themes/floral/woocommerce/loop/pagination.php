<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if( ! defined('ABSPATH')) {
	exit;
}

$total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
$format  = isset($format) ? $format : '';

if($total <= 1) {
	return;
}

// get paging type
$archive_paging_type = isset($_GET['paging-type']) ? $_GET['paging-type'] : '';
if( ! in_array($archive_paging_type, array('default', 'load-more', 'infinite-scroll'))) {
	$archive_paging_type = floral_get_option('product-archive-paging-type', '', 'default');
}

// Post navigation
?>
<div class="navigation-type-<?php floral_the_clean_html_classes($archive_paging_type); ?> navigation-style-2 navigation-align-center">
	<div class="__separator"></div>
	<?php
	switch($archive_paging_type) {
        case 'load-more':
            Floral_Blog::paging_load_more();
            break;
        case 'infinite-scroll':
            Floral_Blog::paging_infinite_scroll();
            break;
        default:
            $links = paginate_links(apply_filters('woocommerce_pagination_args', array( // WPCS: XSS ok.
                'base'      => $base,
                'format'    => $format,
                'add_args'  => false,
                'current'   => max(1, $current),
                'total'     => $total,
        //        'prev_text' => '<i class="floral-inline-icon w9 w9-ico-ios-arrow-thin-left"></i>',
                'prev_text' => '<i class="fa fa-angle-left"></i>',
        //        'next_text' => '<i class="floral-inline-icon w9 w9-ico-ios-arrow-thin-right"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>',
                'type'      => 'list',
                'end_size'  => 1,
                'mid_size'  => 2
            )));
            if( ! empty($links)) : ?>
                    <nav class="floral-pagination">
                  <?php echo wp_kses_post($links); ?>
                    </nav>
                <?php
            endif; ?>
</div>
<?php } ?>

