<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: theme-required-plugins.php
 * @time    : 8/26/16 12:07 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once( floral_theme_dir() . 'includes/library/tgm/class-floral-tgma.php' );


add_action( 'tgmpa_register', 'floral_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function floral_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'               => 'W9 Floral Add-on', // The plugin name
            'slug'               => 'w9-floral-addon', // The plugin slug (typically the folder name)
            'source'             => 'http://9wpthemes.com/wp-content/uploads/wp-updates/?action=download&slug=w9-floral-addon', // The plugin source
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'               => 'Visual Composer', // The plugin name
            'slug'               => 'js_composer', // The plugin slug (typically the folder name)
//            'source'             => 'http://demo.9wpthemes.com/demo-resources/plugins/js_composer.zip', // The plugin source
            'source'             => floral_theme_dir() . '/includes/plugins/js_composer.zip', // The plugin source
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name'               => 'Revolution Slider', // The plugin name
            'slug'               => 'revslider', // The plugin slug (typically the folder name)
//            'source'             => 'http://demo.9wpthemes.com/demo-resources/plugins/revslider.zip', // The plugin source
            'source'             => floral_theme_dir() . '/includes/plugins/revslider.zip', // The plugin source
            'required'           => true, // If false, the plugin is only 'recommended' instead of required
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'       => '', // If set, overrides default API URL and points to an external URL
        ),
//        array(
//            'name'               => 'Envato WordPress Toolkit', // The plugin name
//            'slug'               => 'envato-wordpress-toolkit', // The plugin slug (typically the folder name)
//            'source'             => 'http://resources.osthemes.biz/plugins/envato-wordpress-toolkit.zip', // The plugin source
//            'required'           => true, // If false, the plugin is only 'recommended' instead of required
//            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
//            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
//            'external_url'       => '', // If set, overrides default API URL and points to an external URL
//        ),
        array(
            'name'     => 'Contact Form 7', // The plugin name
            'slug'     => 'contact-form-7', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
//        array(
//            'name'     => 'WP Mail SMTP', // The plugin name
//            'slug'     => 'wp-mail-smtp', // The plugin slug (typically the folder name)
//            'required' => true, // If false, the plugin is only 'recommended' instead of required
//        ),
        array(
            'name'     => 'WooCommerce', // The plugin name
            'slug'     => 'woocommerce', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
        array(
            'name'     => 'MailChimp for WordPress', // The plugin name
            'slug'     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
            'required' => true, // If false, the plugin is only 'recommended' instead of required
        ),
    );
    
    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => '_9wpthemes', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        
        'strings' => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'floral' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'floral' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'floral' ), // %s = plugin name.
            'updating'                        => esc_html__( 'Updating Plugin: %s', 'floral' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'floral' ),
            'notice_can_install_required'     => _n_noop(
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                'floral'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'floral'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'floral'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'floral'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop(
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                'floral'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'floral'
            ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                'floral'
            ),
            'update_link'                     => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                'floral'
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                'floral'
            ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'floral' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'floral' ),
            'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'floral' ),
            'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'floral' ),  // %1$s = plugin name(s).
            'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'floral' ),  // %1$s = plugin name(s).
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'floral' ), // %s = dashboard link.
            'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'floral' ),
            'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'floral' ),
            
            'nag_type' => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        )
    );
    
    floral_tgmpa( $plugins, $config );
}
