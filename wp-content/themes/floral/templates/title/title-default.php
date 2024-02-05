<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: title-default.php
 * @time    : 8/26/16 12:35 PM
 * @author  : 9WPThemes Team
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$template_prefix = floral_get_template_prefix();
// Layout
$site_title_layout = floral_get_meta_or_option( 'page-title-layout', '', 'container', $template_prefix );

//
// Classes
//
$site_title_inner_class              = array();
$site_title_breadcrumb_wrapper_class = array();

// text options
$site_title_inner_class[] = floral_get_meta_or_option( 'page-title-text-align', '', 'container', $template_prefix );

//$site_title_breadcrumb_wrapper_class[] = '';

$title_text_class   = array();
$title_text_class[] = floral_get_meta_or_option( 'title-font-style', '', '', $template_prefix );
$title_text_class[] = floral_get_meta_or_option( 'title-text-transform', '', 'text-uppercase', $template_prefix );

$subtitle_text_class   = array();
$subtitle_text_class[] = floral_get_meta_or_option( 'subtitle-font-style', '', 'fs-italic', $template_prefix );
$subtitle_text_class[] = floral_get_meta_or_option( 'subtitle-text-transform', '', 'text-transform-__', $template_prefix );

//
// Title image options
//
$title_bg_url = floral_get_meta_or_option( 'page-title-background', 'url', '', $template_prefix );

//
// Parallax effect options
//
$parallax_effect   = floral_get_meta_or_option( 'page-title-parallax-effect', '', 'no-effect', $template_prefix );
$parallax_position = floral_get_meta_or_option( 'page-title-parallax-position', '', 'center', $template_prefix );

//
// Page title
//
$page_subtitle = floral_get_page_subtitle();

//
// Breadcrumb
//
$page_title_breadcrumb                 = floral_get_meta_or_option( 'page-title-breadcrumbs', '', false, $template_prefix );
$breadcrumb_position                   = floral_get_meta_or_option( 'breadcrumbs-position', '', 'right', $template_prefix );
$site_title_breadcrumb_wrapper_class[] = $breadcrumb_position;
// prepended text
//$get_prepended_text = floral_get_meta_or_option( 'breadcrumbs-prepended-text', '', '', $template_prefix );
$get_prepended_text = '';

//
// Calculate columns
//
$site_title_inner_col   = '';
$breadcrumb_wrapper_col = '';
if ( ! $page_title_breadcrumb ) {
	$site_title_inner_col   = '';
	$breadcrumb_wrapper_col = '';
}

$site_title_inner_class[]              = $site_title_inner_col;
$site_title_breadcrumb_wrapper_class[] = $breadcrumb_wrapper_col;
?>
<section class="site-title page-title <?php floral_the_clean_html_classes( $template_prefix ) ?>">
	<?php if ( $parallax_effect !== 'no-effect' ): ?>
		<div class="bg-wrapper"
			 data-stellar-background-ratio="<?php echo esc_attr( $parallax_effect ); ?>"
			 style="background-image: url('<?php echo esc_url( $title_bg_url ); ?>'); background-position: center <?php echo esc_attr( $parallax_position ); ?>;">
		</div>
	<?php else: ?>
		<div class="bg-wrapper no-parallax" style="background-image: url('<?php echo esc_url( $title_bg_url ); ?>'); background-position: center <?php echo esc_attr( $parallax_position ); ?>;"></div>
	<?php endif; ?>
	<div class="site-title-layout <?php echo esc_attr( $site_title_layout ); ?>">
		<div class="row">
			<div class="col-xs-12">
				<div class="site-title-inner-wrapper">
					<div class="site-title-inner <?php floral_the_clean_html_classes( $site_title_inner_class ); ?>">
						<h1 class="title no-mb <?php floral_the_clean_html_classes( $title_text_class ); ?>"><?php echo floral_get_page_title(); ?></h1>
						<?php if ( $page_subtitle ): ?>
							<p class="sub-title no-mb <?php floral_the_clean_html_classes( $subtitle_text_class ); ?>"><?php echo esc_html( $page_subtitle ); ?></p>
						<?php endif; ?>
					</div>
					<?php if ( $page_title_breadcrumb ) : ?>
						<div class="site-title-breadcrumb-wrapper clearfix <?php floral_the_clean_html_classes( $site_title_breadcrumb_wrapper_class ); ?>">
							<div class="floral-breadcrumb-wrapper float-mode">
								<?php Floral_Breadcrumb()->print_breadcrumb_html( $get_prepended_text, 'no-mb' ); ?>
								<div class="__shape">
									<div class="__rect"></div>
									<div class="__slope">
										<svg height="100%" width="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
											<?php if ( $breadcrumb_position === 'left' ) { ?>
												<polygon points="0,0 0,100 100,100" />
											<?php } else { ?>
												<polygon points="0,100 100,100 100,0" />
											<?php } ?>
										</svg>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>