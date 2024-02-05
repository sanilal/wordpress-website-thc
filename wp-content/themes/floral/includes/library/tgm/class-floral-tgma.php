<?php
/**
 * Created by PhpStorm.
 * User: Sinzii Rosy
 * Date: 6/14/2016
 * Time: 8:03 PM
 */
require_once( floral_theme_dir() . 'includes/library/tgm/class-tgm-plugin-activation.php' );
// set the singleton instance to null
TGM_Plugin_Activation::$instance = null;

// Extend the base tgma class
class Floral_TGMA extends TGM_Plugin_Activation {

    public function get_tgmpa_url() {
        static $url;
        if ( !isset( $url ) ) {
            $parent = 'admin.php';
            $url    = add_query_arg(
                array(
                    'page' => urlencode( '_9wpthemes' ),
                    'tab'  => urlencode( 'required-plugins' ) // see class floral admin panel for more information about this.
                ),
                self_admin_url( $parent )
            );
        }

        return $url;
    }

    /**
     * Echoes plugin installation form.
     *
     * This method is the callback for the admin_menu method function.
     * This displays the admin page and form area where the user can select to install and activate the plugin.
     * Aborts early if we're processing a plugin installation action.
     *
     * @since 1.0.0
     *
     * @return null Aborts early if we're processing a plugin installation action.
     */
    public function install_plugins_page() {
        // Store new instance of plugin table in object.
        $plugin_table = new TGMPA_List_Table;

        // Return early if processing a plugin installation action.
        if ( ( ( 'tgmpa-bulk-install' === $plugin_table->current_action() || 'tgmpa-bulk-update' === $plugin_table->current_action() ) && $plugin_table->process_bulk_actions() ) || $this->do_plugin_install() ) {
            return;
        }

        // Force refresh of available plugin information so we'll know about manual updates/deletes.
        wp_clean_plugins_cache( false );
        ?>
        <div class="tgmpa">
            <?php $plugin_table->prepare_items(); ?>

            <?php
            if ( !empty( $this->message ) && is_string( $this->message ) ) {
                echo wp_kses_post( $this->message );
            }
            ?>
            <?php $plugin_table->views(); ?>

            <form id="tgmpa-plugins" action="" method="post">
                <input type="hidden" name="tgmpa-page" value="<?php echo esc_attr( $this->menu ); ?>" />
                <input type="hidden" name="plugin_status" value="<?php echo esc_attr( $plugin_table->view_context ); ?>" />
                <?php $plugin_table->display(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Returns the singleton instance of the class.
     *
     * @since 2.4.0
     *
     * @return \Floral_TGMA The Floral_TGMA object.
     */
    public static function get_instance() {
        if ( !isset( self::$instance ) && !( self::$instance instanceof self ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}


if ( !function_exists( 'floral_load_tgm_plugin_activation' ) ) {
    /**
     * Ensure only one instance of the class is ever invoked.
     *
     * @since 2.5.0
     */
    function floral_load_tgm_plugin_activation() {
        $GLOBALS['tgmpa'] = $GLOBALS['floral_tgmpa'] = Floral_TGMA::get_instance();
    }
}

if ( did_action( 'plugins_loaded' ) ) {
    floral_load_tgm_plugin_activation();
} else {
    add_action( 'plugins_loaded', 'floral_load_tgm_plugin_activation' );
}

if ( !function_exists( 'floral_tgmpa' ) ) {
    /**
     * Helper function to register a collection of required plugins.
     *
     * @since 2.0.0
     * @api
     *
     * @param array $plugins An array of plugin arrays.
     * @param array $config  Optional. An array of configuration values.
     */
    function floral_tgmpa( $plugins, $config = array() ) {
        $instance = call_user_func( array( get_class( $GLOBALS['floral_tgmpa'] ), 'get_instance' ) );

        foreach ( $plugins as $plugin ) {
            call_user_func( array( $instance, 'register' ), $plugin );
        }

        if ( !empty( $config ) && is_array( $config ) ) {
            // Send out notices for deprecated arguments passed.
            if ( isset( $config['notices'] ) ) {
                _deprecated_argument( __FUNCTION__, '2.2.0', 'The `notices` config parameter was renamed to `has_notices` in TGMPA 2.2.0. Please adjust your configuration.' );
                if ( !isset( $config['has_notices'] ) ) {
                    $config['has_notices'] = $config['notices'];
                }
            }

            if ( isset( $config['parent_menu_slug'] ) ) {
                _deprecated_argument( __FUNCTION__, '2.4.0', 'The `parent_menu_slug` config parameter was removed in TGMPA 2.4.0. In TGMPA 2.5.0 an alternative was (re-)introduced. Please adjust your configuration. For more information visit the website: http://tgmpluginactivation.com/configuration/#h-configuration-options.' );
            }
            if ( isset( $config['parent_url_slug'] ) ) {
                _deprecated_argument( __FUNCTION__, '2.4.0', 'The `parent_url_slug` config parameter was removed in TGMPA 2.4.0. In TGMPA 2.5.0 an alternative was (re-)introduced. Please adjust your configuration. For more information visit the website: http://tgmpluginactivation.com/configuration/#h-configuration-options.' );
            }

            call_user_func( array( $instance, 'config' ), $config );
        }
    }
}

