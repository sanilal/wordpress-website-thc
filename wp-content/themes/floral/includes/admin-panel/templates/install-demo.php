<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: install-demo.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$demo_config = array(
    'main'   => array(
        'name'        => esc_html__( 'Main Demo', 'floral' ),
        'preview-url' => '9wpthemes.com/?switcher&see=wp-floral',
        'path'        => '',
        //'disabled'    => true
    ),
);

// last installed demo
$last_installed_demo = (array) get_theme_mod( 'last-installed-demo', array() );
?>
<div class="page-install-demo">
    <div class="first-notice white-board">
        <?php echo sprintf( __( 'Installing a demo provides pages, posts, images, theme options, widgets, sliders and mores. <strong>IMPORTANT</strong>: The included plugins need to be installed and activated before you install a demo. Please check the %s tab to ensure your server meets all requirements for a successful import. <span style="color: red;">Settings that need attention will be listed in red</span>. <a href="%s">View more info here.</a>', 'floral' ), '<strong style="color: #0085BA;">' . esc_html__( '"System Status"', 'floral' ) . '</strong>', esc_url( admin_url( 'admin.php?page=' . $this->menu_slug . '&tab=system-status' ) ) ); ?>
    </div>
    <?php if ( !empty( $last_installed_demo ) ): ?>
        <div class="notice notice-warning is-dismissible" style="margin-bottom: 50px;">
            <p>
                <strong><?php _e( 'Your site have been installed demo data, please reset the database before install new demo data. <br/> This just prevent your database from storing unexpected data, and help your site works well.', 'floral' ); ?></strong>
            </p>
            <p>
                <?php echo sprintf( __( 'You can use this plugin to reset the database: <a href="%1$s" target="_blank">%1$s</a>', 'floral' ), 'https://wordpress.org/plugins/wordpress-reset/' ) ?>
            </p>
        </div>
    <?php endif; ?>
    
    <div class="demo-list">
        <?php foreach ( $demo_config as $demo => $config ):
            $demo_name = !empty( $config['name'] ) ? $config['name'] : esc_html__( 'No name', 'floral' );
//            $demo_name = mb_strimwidth( $demo_name, 0, 13, '...' );
            if (strlen($demo_name) > 13) {
                $demo_name = substr($demo_name, 0, 10) . '...';
            }
            
            $demo_path = !empty( $config['path'] ) ? $config['path'] : '';
            $demo_preview_url = !empty( $config['preview-url'] ) ? $config['preview-url'] : '#';
            $demo_disabled = !empty( $config['disabled'] ) ? $config['disabled'] : false;
            // screen shot image for the demo
            if ( file_exists( FLORAL_DEMO_DATA_PATH . $demo . '/screen-shot.jpg' ) ) {
                $demo_screen_shot = FLORAL_DEMO_DATA_URL . $demo . '/screen-shot.jpg';
            } elseif ( file_exists( FLORAL_DEMO_DATA_PATH . $demo . '/screen-shot.png' ) ) {
                $demo_screen_shot = FLORAL_DEMO_DATA_URL . $demo . '/screen-shot.png';
            } else {
                $demo_screen_shot = floral_theme_url() . 'includes/admin-panel/assets/images/default-demo-screen-shot.jpg';
            }
            ?>
            <div class="demo-item <?php echo esc_attr( $demo . ' ' . $demo_name ); ?>">
                <div class="demo-item-inner">
                    <div class="screen-shot-wrapper">
                        <div class="demo-screen-shot">
                            <img src="<?php echo esc_url( $demo_screen_shot ); ?>" alt="<?php echo esc_attr( $demo_name ); ?>">
                            <div class="progressbar"></div>
                            <!--                            --><?php //if ( in_array( $demo, $last_installed_demo ) ):
                            ?>
                            <!--                                <div class="installed-overlay">-->
                            <!--                                    <div class="cell-vertical-align">-->
                            <!--                                        <div class="cell-middle"><span>--><?php //echo esc_html__( 'INSTALLED', 'floral' );
                            ?><!--</span>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            --><?php //endif;
                            ?>
                        </div>
                    </div>
                    <?php if ( in_array( $demo, $last_installed_demo ) ): ?>
                        <div class="demo-item-info installed">
                            <span class="demo-title"><?php echo sprintf( $demo_name ); ?></span>
                            <span class="spinner"></span>
                            <a href="#" class="button button-secondary button-install <?php echo ( $demo_disabled ) ? 'disabled' : ''; ?>" data-demo="<?php echo esc_attr( $demo ); ?>" data-path="<?php echo esc_attr( $demo_path ); ?>"><?php echo esc_html__( 'Re-Install', 'floral' ) ?></a>
                            <a href="<?php echo esc_url( $demo_preview_url ); ?>" target="_blank" class="button button-primary button-preview <?php echo ( $demo_disabled ) ? 'disabled' : ''; ?>"><?php echo esc_html__( 'Preview', 'floral' ) ?></a>
                        </div>
                    <?php else: ?>
                        <div class="demo-item-info">
                            <span class="demo-title"><?php echo sprintf( $demo_name ); ?></span>
                            <span class="spinner"></span>
                            <a href="#" class="button button-primary button-install <?php echo ( $demo_disabled ) ? 'disabled' : ''; ?>" data-demo="<?php echo esc_attr( $demo ); ?>" data-path="<?php echo esc_attr( $demo_path ); ?>"><?php echo esc_html__( 'Install', 'floral' ) ?></a>
                            <a href="<?php echo esc_url( $demo_preview_url ); ?>" target="_blank" class="button button-primary button-preview"><?php echo esc_html__( 'Preview', 'floral' ) ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a id="button-show-log" class="button button-primary button-show-log" title="<?php echo esc_html__( 'Show log!', 'floral' ) ?>">
        <span class="dashicons dashicons-warning"></span>
    </a>

    <div id="confirm-install-demo" title="<?php echo esc_html__( 'Install Demo Data', 'floral' ) ?>" style="display: none">
        <p class="question"><?php echo esc_html__( 'Install demo data:', 'floral' ) ?> <span class="demo-title"></span></p>
        <div class="options">
            <p class="label">
                <strong><i><?php echo esc_html__( 'Options for you (which one you want to install?):', 'floral' ) ?></i></strong>
            </p>
            <p class="option">
                <input type="checkbox" name="demo-options" id="demo-options" value="1" checked="checked">
                <label for="demo-options"><?php echo esc_html__( 'Demo options.', 'floral' ) ?></label>
            </p>
            <p class="option">
                <input type="checkbox" name="demo-data" id="demo-data" value="1" checked="checked">
                <label for="demo-data"><?php echo esc_html__( 'Demo data (included: pages, posts, images, ...).', 'floral' ); ?></label>
            </p>
            <p class="option" style="margin-left: 20px; display: none;">
                <input type="checkbox" name="fetching-demo-images" id="fetching-demo-images" value="1" checked="checked">
                <label for="fetching-demo-images"><?php echo esc_html__( 'Download images from our server. (uncheck this will reduce the installation time).', 'floral' ); ?></label>
            </p>
            <p class="option">
                <input type="checkbox" name="demo-revslider" id="demo-revslider" value="1" checked="checked">
                <label for="demo-revslider"><?php echo esc_html__( 'Demo revolution sliders (require Revolution Slider plugin activated).', 'floral' ) ?></label>
            </p>
        </div>
        <hr style="margin-top: 15px;">
        <p style="color: red;">
            <i><b><?php echo esc_html__( 'Notice 1:', 'floral' ); ?></b> <?php echo esc_html__( 'Before install demo data, please check again the system - status tab for recommended theme requirement . And make sure that your site is installed and activated all required plugins.', 'floral' ) ?>
            </i>
        </p>
        <p style="color: purple;">
            <i><b><?php echo esc_html__( 'Notice 2:', 'floral' ); ?></b> <?php echo esc_html__( 'A success installation may take about 5min to 30min depending on how much data might be loaded from our server. Please be patient when the installation is in process.', 'floral' ); ?>
            </i>
        </p>
        <p style="color: purple;">
            <i><b><?php echo esc_html__( 'Notice 3:', 'floral' ); ?></b> <?php echo esc_html__( 'When the installation is in process . Hit the show log button at bottom right of your screen to show up the logging panel, and see what is going on. ', 'floral' ); ?>
            </i>
        </p>
    </div>
</div>