<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: panel-selector.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

?>
<?php
$panel_selector = floral_get_option( 'panel-selector', '', 0 );
if ( $panel_selector == 0 ) {
	return;
}
$bg_image_pattern = array( 'pattern-1.jpg', 'pattern-2.jpg', 'pattern-3.jpg', 'pattern-4.jpg', 'pattern-5.jpg', 'pattern-6.jpg', 'pattern-7.jpg', 'pattern-8.jpg', 'pattern-9.jpg', 'pattern-10.jpg', 'pattern-11.jpg', 'pattern-12.jpg' );
$theme_demos      = array(
    array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ), array(
        'name'        => esc_html__( 'Floral', 'floral' ),
        'preview-url' => '#',
        'img-small'   => 'demo-img_small.jpg',
        'img-large'   => 'demo-img_large.jpg'
    ),
);
?>
<div id="panel-style-selector">
    <div class="panel-selector-open"><i class="w9 w9-ico-gears"></i></div>
    <div class="panel-wrapper">
        <div class="panel-selector-header">
            <a href="#" class="buy-theme-btn p-bgc"><span><?php echo sprintf(esc_html__( 'BUY %s', 'floral' ), wp_get_theme()->get( 'Name' )); ?></span></a>
        </div>
        <div class="separator"></div>
        <div class="panel-selector-body clearfix">
            <section class="panel-selector-section layout-section clearfix">
                <h3 class="panel-selector-title"><?php echo esc_html__( 'Layout', 'floral' ); ?></h3>

                <div class="panel-selector-row clearfix">
                    <div class="__btn-wrapper __3 clearfix">
                        <div class="__btn">
                            <a data-type="layout" data-value="wide" href="#" class="panel-selector-btn"><?php echo esc_html__( 'Wide', 'floral' ); ?></a>
                        </div>
                        <div class="__btn">
                            <a data-type="layout" data-value="boxed" href="#" class="panel-selector-btn"><?php echo esc_html__( 'Boxed', 'floral' ); ?></a>
                        </div>
                        <div class="__btn">
                            <a data-type="layout" data-value="float" href="#" class="panel-selector-btn"><?php echo esc_html__( 'Float', 'floral' ); ?></a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="panel-selector-section background-section clearfix">
                <h3 class="panel-selector-title"><?php echo esc_html__( 'Background', 'floral' ); ?></h3>


                <div class="panel-selector-row no-padding clearfix">
                    <ul class="panel-primary-background clearfix">
                        <?php foreach ( $bg_image_pattern as $pattern ): ?>
                            <li data-name="<?php echo esc_html( $pattern ); ?>" data-type="pattern" style="background-image:  url(<?php echo esc_url( get_template_directory_uri() . '/assets/images/pattern/' . $pattern ); ?>)"></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
            <div class="separator"></div>
            <section class="panel-selector-section rtl-section clearfix">
                <h3 class="panel-selector-title"><?php echo esc_html__( 'RTL Mode', 'floral' ); ?></h3>

                <div class="panel-selector-row clearfix">
                    <div class="__btn-wrapper __2 clearfix">
                        <div class="__btn">
                            <a id="panel-selector-reset" href="#" class="panel-selector-btn inverse"><?php echo esc_html__( 'Reset', 'floral' ); ?></a>
                        </div>
                        <div class="__btn">
                            <a data-mode="off" id="panel-selector-rtl" href="#" class="panel-selector-btn"><?php echo esc_html__( 'RTL On', 'floral' ); ?></a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="separator"></div>
        <div class="panel-selector-footer">
            <section class="panel-selector-section demos-section clearfix">
                <h3 class="panel-selector-title"><?php echo esc_html__( 'Other demos', 'floral' ); ?></h3>

                <div class="panel-selector-row clearfix">
                    <div class="demos clearfix">
                        <?php foreach ( $theme_demos as $demo ): ?>
                            <div class="__item">
                                <a href="<?php echo esc_url( $demo['preview-url'] );; ?>" class="__item-content">
                                    <div class="__small">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/theme-demos/' . $demo['img-small'] ); ?>" alt="demo" />
                                    </div>
                                    <div class="__large">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/theme-demos/' . $demo['img-large'] ); ?>" alt="demo" />
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </section>
        </div>
    </div>
</div>