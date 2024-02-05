<?php
/**
 * Copyright 2016, 9WPThemes
 * @filename: floral_shortcode_service_list.php
 * @time    : 4/24/2017 8:33 AM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Service_List
 * @var $atts
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( !post_type_exists( Floral_CPT_Service::CPT_SLUG ) ) {
	return;
}

$sl_data = $sl_category = $sl_manual_data = $sl_total_items = $sl_tx_color = $sl_tx_custom_color =
$css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$class_service_list = array(
	$sl_tx_color . '-color',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
	Floral_Map_Helpers::get_class_animation( $animation_css )
);

$style_inline_service_list = array();
if (($sl_tx_color === 'custom') && !empty($sl_tx_custom_color) ) {
	$style_inline_service_list[] = 'color:' . $sl_tx_custom_color;
}

$name = $time = $price = $link = '';

$a_href   = '#';
$a_target = '_self';
$a_title  = '';

ob_start(); ?>
	<div class="floral-sc-service-list clearfix <?php floral_the_clean_html_classes( $class_service_list ) ?>" <?php echo Floral_Map_Helpers::get_inline_style( $style_inline_service_list, $animation_duration, $animation_delay ); ?>>
		
		<?php
		if ( $sl_data == 'manual' ) {
			$manual_service_data = (array) vc_param_group_parse_atts( $sl_manual_data );
			foreach ( $manual_service_data as $value ) :
				$name = isset( $value['name'] ) ? $value['name'] : '';
				$time            = isset( $value['time'] ) ? $value['time'] : '';
				$price           = isset( $value['price'] ) ? $value['price'] : '';
				$link            = isset( $value['link'] ) ? $value['link'] : '';
				
				//parse link
				$link = ( $link == '||' ) ? '' : $link;
				$link = vc_build_link( $link );
				if ( strlen( $link['url'] ) > 0 ) {
					$a_href   = $link['url'];
					$a_title  = $link['title'];
					$a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
				}
				?>
				<div class="service-list-item">
                            <h4 class="__title">
                                <?php if ( !(empty( $a_href ) || ($a_href === '#' ) ) ): ?>
	                                <a href="<?php echo esc_url( $a_href ); ?>" class="__name"
	                                   title="<?php echo esc_html( $a_title ); ?>" target="<?php echo esc_attr( $a_target ); ?>">
                                        <?php echo esc_html( $name ); ?>
                                    </a>
                                <?php else: ?>
									<span class="__name">
	                                	<?php echo esc_html( $name ); ?>
									</span>
                                <?php endif; ?>
	                            <?php if ( !empty( $time ) ): ?>
		                            <?php echo '<span class="__time">' . esc_html( $time ) . '</span>'; ?>
	                            <?php endif; ?>
<!--	                            <span class="__line"></span>-->
                            </h4>
					<?php if ( !empty( $price ) ): ?>
						<span class="__price"><?php echo esc_html( $price ); ?></span>
					<?php endif; ?>
				</div>
			<?php endforeach;
		} elseif ($sl_data == 'cpt') {
			$item_amount = intval( $sl_total_items );
			$args        = array(
				'posts_per_page' => ( !empty( $item_amount ) ) ? $item_amount : 10,
				'post_type'      => 'service',
				'orderby'        => 'date',
				'order'          => 'ASC',
				'post_status'    => 'publish'
			);
			if ( $sl_category != '' ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => Floral_CPT_Service::TAX_SLUG,
						'field'    => 'slug',
						'terms'    => explode( '||', $sl_category ),
						'operator' => 'IN'
					)
				);
			}
			$data = new WP_Query( $args );
			
			while ( $data->have_posts() ): $data->the_post();
				$name  = get_the_title();
				$time  = get_post_meta( get_the_ID(), 'meta-service-time', true ) ;
				$price = get_post_meta( get_the_ID(), 'meta-service-price', true );
				// get a link
				$a_title = $name;
				?>
				<div class="service-list-item">
                            <h4 class="__title">
	                                <a href="<?php  the_permalink(); ?>" class="__name"
	                                   title="<?php echo esc_html( $a_title ); ?>">
                                        <?php echo esc_html( $name ); ?>
                                    </a>
	                            <?php if ( !empty( $time ) ): ?>
		                            <?php echo '<span class="__time">' . esc_html( $time ) . '</span>'; ?>
	                            <?php endif; ?>
<!--	                            <span class="__line"></span>-->
                            </h4>
					<?php if ( !empty( $price ) ): ?>
						<span class="__price"><?php echo esc_html( $price ); ?></span>
					<?php endif; ?>
				</div>
			<?php endwhile;
		}
		?>
	</div>
<?php
wp_reset_postdata();
$content = ob_get_clean();

echo $content;