<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral-gitem-image.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Floral_SC_Gitem_Image extends WPBakeryShortCode {
	const SC_BASE = 'floral_shortcode_gitem_image';
	
	public function __construct( $settings ) {
		parent::__construct( $settings );
		add_filter( 'vc_gitem_template_attribute_floral_gitem_image', array( $this, 'floral_gitem_image' ), 10, 2 );
	}
	
	public function get_lightbox_link( $image_id, $image_popup_size, $args = array(), $html = '' ) {
		$args = wp_parse_args( $args, array(
			'gallery'          => '',
//			'image_popup_size' => Floral_Image::$magnific_size,
		) );
		
		$image_args = array();
		if ( isset( $args['ratio'] ) ) {
			$image_args['ratio'] = $args['ratio'];
		}
		
		if ( empty( $image_popup_size ) ) {
			$image_popup_size = Floral_Image::$magnific_size;
		}
		$popup_image = wp_get_attachment_image_src( $image_id, $image_popup_size );

		$rel = '';
		
		if ($args['gallery'] === '') {
			$rel = 'floral-prettyPhoto';
		} elseif ($args['gallery'] === 'pp-gal' ) {
			$rel = 'prettyPhoto[pp_gal]';
		} else {
			$rel = sprintf( 'floral-owl-prettyPhoto[%s]', $args['gallery'] );
		}
		
		ob_start();
		?>
		<a href="<?php echo esc_attr( $popup_image[0] ); ?>" class="floral-pretty-photo-link" data-rel="<?php echo esc_attr($rel) ?>">
			<?php echo sprintf( '%s', $html ); ?>
		</a>
		<?php
		return ob_get_clean();
	}
	
	public function floral_gitem_image( $value, $data ) {
		/**
		 * @var null|Wp_Post $post ;
		 * @var string       $data ;
		 */
		extract( array_merge( array(
			'post' => null,
			'data' => '',
		), $data ) );
		
		$atts = array();
		parse_str( $data, $atts );
		$source           = '';
		$meta_key         = '';
		$meta_url         = '';
		$image            = '';
		$img_size         = '';
		$img_size_custom  = '';
		$image_ratio      = '';
		$action           = '';
		$link_target      = '';
		$add_hover_effect = '';
		$css              = '';
		$el_class         = '';
		extract( $atts );
		
		$sc_classes = array(
			'floral-gitem-image',
			$el_class,
			vc_shortcode_custom_css_class( $css ),
		);
		
		// Choose image source
		if ( $source == 'meta_key' ) {
			$image = get_post_meta( $post->ID, $meta_key, true );
		} elseif ( $source == 'featured_image' ) {
			$image = get_post_thumbnail_id( $post );
		}
		
		// Choose image custom size
		if ( $img_size == 'custom' ) {
			$img_size = $img_size_custom;
		}
		
		// Choose image ratio
		$img_attr = array( 'class' => 'img-responsive' );
		if ( ! empty( $image_ratio ) ) {
			$img_attr['ratio'] = $image_ratio;
		}
		
		$link_attr = ( $link_target === 'yes' ) ? array( 'target' => '_blank' ) : array();
		
		$hover_overlay_link = ( ! empty( $action ) && ( $action !== 'none' ) && ( $add_hover_effect === 'yes' ) ) ? '<div class="__overlay"><i class="flor-ico flor-ico-icon-link"></i></div>' : '';
		$hover_overlay_zoom = ( ! empty( $action ) && ( $action !== 'none' ) && ( $add_hover_effect === 'yes' ) ) ? '<div class="__overlay"><i class="flor-ico flor-ico-icon-zoom-in-alt"></i></div>' : '';
		// Render Image
		switch ( $action ) {
			case 'light_box' :
				$html                = array(
					'before' => $hover_overlay_zoom,
				);
				$img_attr['gallery'] = 'pp-gal';
				
				$content = Floral_Wrap::prettyphoto_image( $image, $img_size, $img_attr, $html );
				break;
			case 'post_link' :
				$html    = $hover_overlay_link . Floral_Image::get_image( $image, $img_size, $img_attr );
				$content = Floral_Wrap::link( $html, get_permalink( $post->ID ), $link_attr );
				break;
			case 'meta_url' :
				$html    = $hover_overlay_link . Floral_Image::get_image( $image, $img_size, $img_attr );
				$url     = get_post_meta( $post->ID, $meta_url, true );
				$content = Floral_Wrap::link( $html, $url, $link_attr );
				break;
			case 'post_link_and_light_box' :
				ob_start();
				?>
				<div class="__overlay">
					<div class="cell-vertical-wrapper">
						<div class="cell-middle">
							<div class="__inner">
								<?php
								$img_attr['gallery'] = 'pp-gal';
								echo $this->get_lightbox_link($image,'', $img_attr, '<i class="flor-ico flor-ico-icon-zoom-in-alt"></i>')
								?>
								<span class="__separator"></span>
								<?php
								echo Floral_Wrap::link( '<i class="flor-ico flor-ico-icon-link"></i>', get_permalink( $post->ID ), $link_attr );
								?>
							</div>
						</div>
					</div>
				</div>
				<?php
				$html = ob_get_clean();
				$content = $html .  Floral_Image::get_image( $image, $img_size, $img_attr );
				break;
			default:
				$content = Floral_Image::get_image( $image, $img_size, $img_attr );
		}
		
		
		return '<div class="' . floral_clean_html_classes( $sc_classes ) . '">' . $content . '</div>';
	}
}

