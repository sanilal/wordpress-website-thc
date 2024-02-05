<?php
/**
 * Created by PhpStorm.
 * User: Sinzii Rosy
 * Date: 7/22/2016
 * Time: 4:38 PM
 */

global $post, $product;

$terms = get_the_terms( $post->ID, 'product_cat' );

$cat_count = 0;
if ($terms) {
	$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
}

if ( $cat_count > 0 ) {
	echo sprintf( wc_get_product_category_list( $post->ID,', ', '<span class="posted_in">', '</span>' ) );
}