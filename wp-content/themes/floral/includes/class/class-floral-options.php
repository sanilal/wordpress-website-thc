<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: class-floral-options.php
 * @time    : 8/26/16 12:21 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if ( !class_exists( 'Floral_Options' ) ) {
    
    class Floral_Options extends Floral_Base {
        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;
        public $compiler;
        public $variables;
        public $trigger_auto_save;
        
        public function __construct() {
            parent::__construct();
            if ( !class_exists( 'ReduxFramework' ) ) {
                return;
            }
            
            $this->trigger_auto_save = false;
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            
            // synchronizing_override_default_data
            $this->synchronizing_override_default_data();
            
            // Set the default arguments
            $this->set_arguments();
            
            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();
            
            // Create the sections and fields
            $this->set_sections();
            
            
            if ( !isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }
            
            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            add_action( 'redux/options/' . $this->args['opt_name'] . '/compiler', array( $this, 'compiler_action' ), 10, 3 );
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
//            add_filter( 'redux/options/' . $this->args['opt_name'] . '/sections', array( $this, 'dynamic_section' ) );

//            add_filter( 'redux/options/' . floral_get_current_preset() . '/options', array( $this, 'switch_theme_options_by_meta' ) );
            
            // switch_theme_options_by_meta
//            add_action( 'redux/extensions/before', array( $this, 'switch_theme_options_by_meta' ) );
//            add_action( 'redux/options/' . floral_get_current_preset() . '/ajax_save/response', array( $this, 'filter_notification_bar_on_ajax_save' ) );
            
            
            /*-------------------------------------
            	TRIGGER AUTO SAVE
            ---------------------------------------*/
            if ( $this->trigger_auto_save ) {
                set_transient( 'floral_redux_trigger_auto_save_at_' . floral_get_current_preset(), 'true' );
            }
//            delete_transient( 'floral_redux_trigger_auto_save' );
            
            /*-------------------------------------
            	INIT THE REDUX OBJECT
            ---------------------------------------*/
            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            
            /*-------------------------------------
            	Create theme options variables
            ---------------------------------------*/
            $this->variables = new Floral_Variables();
            
            /*-------------------------------------
            	Create SCSS Compiler
            ---------------------------------------*/
            $this->compiler = new Floral_SCSS();
            $this->compiler->set_variables( $this->variables->get_variables() );
            
        }
        
        
        /**
         * synchronizing_override_default_data
         */
        function synchronizing_override_default_data() {
            // set theme mod for page title override default
            $_current_page_title_data    = get_theme_mod( 'floral-page-title-override-default-' . floral_get_current_preset() );
            $page_title_override_default = floral_get_option( 'page-title-override-default' );
            if ( empty( $page_title_override_default ) ) {
                $page_title_override_default = array();
            }
            if ( $_current_page_title_data !== $page_title_override_default ) {
                set_theme_mod( 'floral-page-title-override-default-' . floral_get_current_preset(), floral_get_option( 'page-title-override-default' ) );
                
                if ( is_array( $_current_page_title_data ) && is_array( $page_title_override_default ) && count( $_current_page_title_data ) > count( $page_title_override_default ) ) {
                    $this->trigger_auto_save = true;
                }
            }
            
            // set theme mod for footer override default
            $_current_footer_data = get_theme_mod( 'floral-footer-override-default-' . floral_get_current_preset() );
            $footer_override_data = floral_get_option( 'footer-override-default' );
            if ( empty( $footer_override_data ) ) {
                $footer_override_data = array();
            }
            if ( $_current_footer_data !== $footer_override_data ) {
                set_theme_mod( 'floral-footer-override-default-' . floral_get_current_preset(), floral_get_option( 'footer-override-default' ) );
                
                if ( is_array( $_current_footer_data ) && is_array( $footer_override_data ) && count( $_current_footer_data ) > count( $footer_override_data ) ) {
                    $this->trigger_auto_save = true;
                }
            }
            
            // set theme mod for content template override default
            $_current_content_template_data = get_theme_mod( 'floral-content-template-override-default-' . floral_get_current_preset() );
            $content_template_override_data = floral_get_option( 'content-template-override-default' );
            if ( empty( $content_template_override_data ) ) {
                $content_template_override_data = array();
            }
            if ( $_current_content_template_data !== floral_get_option( 'content-template-override-default' ) ) {
                set_theme_mod( 'floral-content-template-override-default-' . floral_get_current_preset(), floral_get_option( 'content-template-override-default' ) );
                
                if ( is_array( $_current_content_template_data ) && is_array( $content_template_override_data ) && count( $_current_content_template_data ) > count( $content_template_override_data ) ) {
                    $this->trigger_auto_save = true;
                }
            }
            
            // set theme mod for header override default
            $_current_header_data = get_theme_mod( 'floral-header-override-default-' . floral_get_current_preset() );
            $header_override_data = floral_get_option( 'header-override-default' );
            if ( empty( $header_override_data ) ) {
                $header_override_data = array();
            }
            if ( $_current_header_data !== floral_get_option( 'header-override-default' ) ) {
                set_theme_mod( 'floral-header-override-default-' . floral_get_current_preset(), floral_get_option( 'header-override-default' ) );
                
                if ( is_array( $_current_header_data ) && is_array( $header_override_data ) && count( $_current_header_data ) > count( $header_override_data ) ) {
                    $this->trigger_auto_save = true;
                }
            }
        }
        
        function filter_notification_bar_on_ajax_save( $return_array ) {
            if ( isset( $return_array['notification_bar'] ) ) {
                
                ob_start();
                ?>
                <div class="preset_created_success admin-notice notice-green" style="display: none;">
                    <strong><?php echo esc_html__( 'Preset has been created successfully, please wait when the page is reloading.', 'floral' ); ?></strong>
                </div>
                <div class="action-error admin-notice notice-red" style="display: none;">
                    <strong><?php echo esc_html__( 'There was an error occurred, please refresh the page and try again!', 'floral' ); ?></strong>
                </div>
                <div class="action-success admin-notice notice-green" style="display: none;">
                    <strong><?php echo esc_html__( 'Successful action!', 'floral' ); ?></strong>
                </div>
                <div class="action-success-redirect admin-notice notice-green" style="display: none;">
                    <strong><?php echo esc_html__( 'Successful action, please wait when the page is reloading.', 'floral' ); ?></strong>
                </div>
                <div class="action-trigger-auto-save admin-notice notice-yellow" style="display: none;">
                    <strong><?php echo esc_html__( 'Auto save options after changing override default settings, please wait a bit!', 'floral' ); ?></strong>
                </div>
                <?php
                $return_array['notification_bar'] .= ob_get_clean();
            }
            
            return $return_array;
        }
        
        /**
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field    set with compiler=>true is changed.
         *
         * @param $options
         * @param $css
         * @param $changed_values
         */
        function compiler_action( $options, $css, $changed_values ) {
            $compiler = new Floral_SCSS();
            $compiler->set_variables( $this->variables->get_variables() );

            $formatter = floral_resource_suffix() ? 'compressed' : 'expanded';
            $compiler->compile_all( $formatter, defined( 'DOING_AJAX' ) );

            unset( $compiler );
            // remove transient
            @delete_transient( 'floral_redux_trigger_auto_save_at_' . floral_get_current_preset() );
        }
        
        
        /**
         *
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         *
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section( $sections ) {
            if ( floral_get_option( 'sub-enable-popup' ) ) {
                include floral_theme_dir() . 'includes/features/theme-options/tab-test-options.php';
            }
            
            return $sections;
        }
        
        /**
         *
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;
            
            return $args;
        }
        
        public function get_default( $key ) {
            $this->ReduxFramework->get_default_value( $key );
        }
        
        /**
         *
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';
            
            return $defaults;
        }
        
        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'FloralOptionFramework' ) ) {
                remove_filter( 'plugin_row_meta', array( FloralOptionFramework::instance(), 'plugin_metalinks' ), null, 2 );
                
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( FloralOptionFramework::instance(), 'admin_notices' ) );
            }
        }
        
        private function set_sections() {
            $page_title_override_template       = get_theme_mod( 'floral-page-title-override-default-' . floral_get_current_preset(), array() );
            $footer_override_template           = get_theme_mod( 'floral-footer-override-default-' . floral_get_current_preset(), array() );
            $content_template_override_template = get_theme_mod( 'floral-content-template-override-default-' . floral_get_current_preset(), array() );
            $header_override_template           = get_theme_mod( 'floral-header-override-default-' . floral_get_current_preset(), array() );
            /**
             * Loading different option tabs
             */
            require floral_theme_dir() . 'includes/features/theme-options/tab-general.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-general-page-transitions.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-general-404.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-general-search.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-general-custom-sidebars.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-colors.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-typo.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-custom-font.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-logo-favicon.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-content-template.php';
            
            if ( !empty( $content_template_override_template ) && is_array( $content_template_override_template ) ) {
                foreach ( $content_template_override_template as $template ) {
                    include floral_theme_dir() . 'includes/features/theme-options/tab-template/tab-content-template.php';
                }
            }
            
            require floral_theme_dir() . 'includes/features/theme-options/tab-header.php';
            if ( !empty( $header_override_template ) && is_array( $header_override_template ) ) {
                foreach ( $header_override_template as $template ) {
                    include floral_theme_dir() . 'includes/features/theme-options/tab-template/tab-header-template.php';
                }
            }
            
            require floral_theme_dir() . 'includes/features/theme-options/tab-header-style.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-header-module.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-header-menu.php';
            
            require floral_theme_dir() . 'includes/features/theme-options/tab-general-subzone.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-title.php';
            
            if ( !empty( $page_title_override_template ) && is_array( $page_title_override_template ) ) {
                foreach ( $page_title_override_template as $template ) {
                    include floral_theme_dir() . 'includes/features/theme-options/tab-template/tab-title-template.php';
                }
            }
            
            
            require floral_theme_dir() . 'includes/features/theme-options/tab-footer.php';
            
            if ( !empty( $footer_override_template ) && is_array( $footer_override_template ) ) {
                foreach ( $footer_override_template as $template ) {
                    include floral_theme_dir() . 'includes/features/theme-options/tab-template/tab-footer-template.php';
                }
            }
            
            require floral_theme_dir() . 'includes/features/theme-options/tab-blog-archive.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-blog-single.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-page-settings.php';
//            require floral_theme_dir() . 'includes/features/theme-options/tab-page-special-template.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-product-archive.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-product-single.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-cpt.php';
//            require floral_theme_dir() . 'includes/features/theme-options/tab-cpt-portfolio-archive.php';
//            require floral_theme_dir() . 'includes/features/theme-options/tab-cpt-portfolio-single.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-cpt-service-archive.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-cpt-service-single.php';
	        require floral_theme_dir() . 'includes/features/theme-options/tab-cpt-event-archive.php';
	        require floral_theme_dir() . 'includes/features/theme-options/tab-cpt-event-single.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-social-profiles.php';
            require floral_theme_dir() . 'includes/features/theme-options/tab-custom-code.php';
            
            if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
                $this->sections['theme_docs'] = array(
                    'icon'   => 'el-icon-list-alt',
                    'title'  => esc_html__( 'Documentation', 'floral' ),
                    'fields' => array(
                        array(
                            'id'       => '17',
                            'type'     => 'raw',
                            'markdown' => true,
                            'content'  => floral_get_file_contents( dirname( __FILE__ ) . '/../README.md' )
                        ),
                    ),
                );
            }
            
            if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                $this->sections['docs'] = array(
                    'icon'    => 'el-icon-book',
                    'title'   => esc_html__( 'Documentation', 'floral' ),
                    'content' => nl2br( floral_get_file_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                );
            }
        }
        
        private function setHelpTabs() {
            
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'      => 'redux-help-tab-1',
                'title'   => esc_html__( 'Theme Information 1', 'floral' ),
                'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'floral' )
            );
            
            $this->args['help_tabs'][] = array(
                'id'      => 'redux-help-tab-2',
                'title'   => esc_html__( 'Theme Information 2', 'floral' ),
                'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'floral' )
            );
            
            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'floral' );
        }
        
        /**
         *
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        private function set_arguments() {
            /*-------------------------------------
            	THEME OPTIONS NAME
            ---------------------------------------*/
            /*-------------------------------------
            	OTHER ARGUMENTS
            ---------------------------------------*/
            $this->args = array(
                'opt_name'              => floral_get_current_preset(),
                'global_variable'       => FLORAL_THEME_OPTIONS_VAR,
                'display_name'          => $this->theme->get( 'Name' ),
                'display_version'       => $this->theme->get( 'Version' ),
                'dev_mode'              => false,
                'forced_dev_mode_off'   => true,
                'page_slug'             => 'theme_options',
//                'page_priority'         => 4,
                'update_notice'         => true,
                'admin_bar'             => floral_is_plugin_active( 'w9-floral-addon/w9-floral-addon.php' ) ? true : false,
                'menu_type'             => 'menu',
                'page_title'            => esc_html__( 'Options', 'floral' ),
                'menu_title'            => esc_html__( 'Theme Options', 'floral' ),
                'allow_sub_menu'        => true,
                'page_parent_post_type' => '',
                'customizer'            => false,
                'default_mark'          => '*',
                'page_parent'           => 'themes.php',
                'page_permissions'      => 'manage_options',
                'hints'                 =>
                    array(
                        'icon'          => 'el-icon-question-sign',
                        'icon_position' => 'right',
                        'icon_size'     => 'normal',
                        'tip_style'     =>
                            array(
                                'color' => 'dark',
//                                'style' => 'youtube'
                            ),
                        'tip_position'  =>
                            array(
                                'my' => 'bottom center',
                                'at' => 'top center',
                            ),
                        'tip_effect'    =>
                            array(
                                'show' =>
                                    array(
                                        'effect'   => 'fade',
                                        'duration' => '100',
                                        'event'    => 'mouseover',
                                    ),
                                'hide' =>
                                    array(
                                        'effect'   => 'fade',
                                        'duration' => '200',
                                        'event'    => 'mouseleave unfocus',
                                    ),
                            ),
                    ),
                'output'                => true,
                'output_tag'            => true,
                'compiler'              => true,
                'page_icon'             => 'icon-themes',
                'save_defaults'         => true,
                'show_import_export'    => true,
                'transient_time'        => '3600',
                'network_sites'         => true,
                'templates_path'        => floral_theme_dir() . 'includes/library/floral-option-templates/panel',
            );
        }
    }
}