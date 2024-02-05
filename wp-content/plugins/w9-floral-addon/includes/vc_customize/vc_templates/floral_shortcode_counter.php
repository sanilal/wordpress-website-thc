<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: floral_shortcode_counter.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 *
 * @var $this Floral_SC_Counter
 * @var $atts
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style                        = '';
$icon_position                = '';
$values                       = '';
$time                         = '';
$text_align                   = '';
$icon_color                   = '';
$custom_icon_color            = '';
$number_color                 = '';
$custom_number_color          = '';
$title_color                  = '';
$custom_title_color           = '';
$floral_item_width            = '';
$floral_responsive_item_width = '';

$el_class = $css = $animation_css = $animation_duration = $animation_delay = '';

$atts = vc_map_get_attributes( $this::SC_BASE, $atts );
extract( $atts );

$sc_classes = array(
	'row',
	$el_class,
	'counter-' . $style,
	Floral_Map_Helpers::get_class_animation( $animation_css ),
	vc_shortcode_custom_css_class( $css ),
);

$item_classes = array(
	$text_align,
	$floral_item_width,
	$floral_responsive_item_width,
	($style === 'style1') ? $icon_position : ''
);

if ( $time === '' ) {
	$time = 1.5;
}

// icon
$icon_classes = array(
	$icon_color . '-color',
);
$icon_inline  = array(
	! empty( $custom_icon_color ) ? 'color: ' . $custom_icon_color : '',
);

// number
$counter_classes = array(
	$number_color . '-color'
);
$counter_inline  = array(
	! empty( $custom_number_color ) ? 'color: ' . $custom_number_color : '',
);
// title
$title_classes = array(
	$title_color . '-color'
);
$title_inline  = array(
	! empty( $custom_title_color ) ? 'color: ' . $custom_title_color : '',
);


$values = (array) vc_param_group_parse_atts( $values );
wp_enqueue_script( 'waypoints' );

?>
<div data-count-time="<?php echo esc_attr( $time ); ?>" class="floral-counter-wrapper <?php floral_the_clean_html_classes( $sc_classes ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( '', $animation_duration, $animation_delay ); ?>>
	<?php foreach ( $values as $counter ):
		$data_string = '';
		$mask = '';
		if ( isset( $counter['from'] ) ) {
			$data_string .= ' data-count-from="' . $counter['from'] . '"';
		}
		if ( isset( $counter['to'] ) ) {
			$data_string .= ' data-count-to="' . $counter['to'] . '"';
			$mask        .= $counter['to'];
		}
		if ( isset( $counter['prefix'] ) ) {
			$data_string .= ' data-prefix="' . $counter['prefix'] . '"';
			$mask        .= $counter['prefix'];
		}
		if ( isset( $counter['suffix'] ) ) {
			$data_string .= ' data-suffix="' . $counter['suffix'] . '"';
			$mask        .= $counter['suffix'];
		}
		vc_icon_element_fonts_enqueue( $counter['type'] );
		$_icon = isset( $counter[ 'icon_' . $counter['type'] ] ) ? esc_attr( $counter[ 'icon_' . $counter['type'] ] ) : 'fa fa-adjust';
		
		?>
		<div class="floral-counter-item ls-005 <?php floral_the_clean_html_classes( $item_classes ); ?>">
			<div class="counter-item-inner">
				<div class="__main">
					<div class="underground-man">
						<div class="__counter" <?php echo $data_string; ?>><?php echo esc_html( $mask ); ?></div>
						<div class="__title"><?php echo esc_html( $counter['title'] ) ?></div>
					</div>
					<div class="showed-man">
						<?php if ( $style === 'style1' ) { ?>
							<div class="__icon <?php floral_the_clean_html_classes( $icon_classes ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $icon_inline ); ?>>
								<span class="<?php echo $_icon; ?>"></span>
							</div>
						<?php } ?>
						<div class="__counter <?php floral_the_clean_html_classes( $counter_classes ); ?>" <?php echo $data_string; ?>  <?php echo Floral_Map_Helpers::get_inline_style( $counter_inline ); ?>>
							<?php echo esc_html( $mask ); ?>
						</div>
						<div class="__title <?php floral_the_clean_html_classes( $title_classes ); ?>" <?php echo Floral_Map_Helpers::get_inline_style( $title_inline ); ?>><?php echo esc_html( $counter['title'] ) ?></div>
					</div>
				</div>
				<div class="__description"><?php echo ( ! empty( $counter['description'] ) ) ? wp_kses_post( $counter['description'] ) : '' ?></div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

