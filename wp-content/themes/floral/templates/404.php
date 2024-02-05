<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: 404.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

//$_404_img_src       = floral_get_option( '-404-image', 'url' , floral_theme_url(). 'assets/images/404-img.png' );

$_404_page_title    = floral_get_option( '-404-title' );
$_404_page_subtitle = floral_get_option( '-404-subtitle' );
$_404_go_back_text = floral_get_option( '-404-go-back-text' );
$_404_go_back_url   = floral_get_option( '-404-go-back-url' );
if ( empty( $_404_go_back_url ) ) {
	$_404_go_back_url = home_url( '/' );
}
// class
$class_404 = array();

// colors styling
$_404_text_color = floral_get_option( '-404-page-text-color', '', '' );

$class_404[] = $_404_text_color;

// background
$overlay_style        = array();
$_404_bgi             = floral_get_option( '-404-bg-image', 'url' );
$_404_overlay         = floral_get_option( '-404-overlay', '' );
$_404_overlay_opacity = floral_get_option( '-404-overlay-opacity', '' );

/**
 * Include page title
 */
//floral_get_template_part( 'page-title' );
?>
<main id="site-main-page" class="site-main-page <?php echo ( ! empty( $_404_overlay ) ) ? esc_attr( sanitize_html_class( $_404_overlay ) ) : ''; ?>">
	<div id="primary" class="content-area">
		<div class="overlay-object" style="<?php echo ( ! empty( $_404_bgi ) ) ? 'background-image:  url(\'' . esc_url( $_404_bgi ) . '\')' : ''; ?>">
			<div class="overlay" style="<?php echo ( ! empty( $_404_overlay_opacity ) ) ? 'opacity: ' . esc_attr( $_404_overlay_opacity ) : ''; ?>"></div>
		</div>
		<section class="error-404 not-found <?php floral_the_clean_html_classes( $class_404 ); ?> ">
			<div class="container">
				<div class="content-wrapper">
<!--					<div class="__img mb-30">-->
<!--						<img src="--><?php //echo esc_url( $_404_img_src ); ?><!--" alt="404 image" />-->
<!--					</div>-->
					<h3 class="page-title-404 fz-96 mb-20 p-color">
						<?php if ( ! empty( $_404_page_title ) ):
							echo esc_html( $_404_page_title );
						else:
							echo esc_html__( 'Page not found', 'floral' );
						endif; ?>
					</h3>
					<?php if ( ! empty( $_404_page_subtitle ) ): ?>
						<p class="page-subtitle-404 fz-48 s-font gray2-color mb-45">
							<?php echo esc_html( $_404_page_subtitle ); ?>
						</p>
					<?php endif; ?>
					<div class="__button">
						<a class="floral-btn btn-style-solid btn-shape-square btn-size-md light-color s-bgc none-hover-color p-hover-button-bgc" href="<?php echo esc_url( $_404_go_back_url ); ?>" title="<?php echo esc_html($_404_go_back_text) ?>" target="_self">
							<span><?php echo esc_html($_404_go_back_text) ?></span>
						</a>
					</div>
				</div><!-- .page-content -->
			</div>
		</section><!-- .error-404 -->
	</div><!-- #primary -->
</main><!-- #main -->
