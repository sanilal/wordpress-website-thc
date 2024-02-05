<?php
/**
 * The template for the header sticky bar.
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author        Redux Framework
 * @package       ReduxFramework/Templates
 * @version       :      3.5.7.8
 */


//var_dump( floral_change_preset_title( 'preset757a4338a00726', 'HELLO' ) );
$preset_list = floral_get_preset_list();

$global_preset = floral_get_global_preset();

$current_preset = floral_get_current_preset();

wp_enqueue_style( 'wp-jquery-ui-dialog' );
wp_enqueue_script( 'jquery-ui-dialog' );
wp_enqueue_script( 'jquery-effects-core' );
wp_enqueue_script( 'jquery-effects-shake' );

$trigger_auto_save = get_transient( 'floral_redux_trigger_auto_save_at_' . $current_preset );
?>
<div class="floral-preset-management">
    <div class="pull-left col-left">
        <?php if ( !empty( $preset_list ) ): ?>
            <div class="preset-container-select">
                <select class="options-preset-select">
                    <?php foreach ( (array) $preset_list as $preset_name => $preset_title ):
                        $admin_url = admin_url( 'admin.php?page=' . $this->parent->args['page_slug'] . '&opt_name=' . $preset_name );
                        ?>
                        <option value="<?php echo esc_attr( $admin_url ); ?>" <?php selected( $preset_name, $current_preset ); ?>><?php echo esc_html( $preset_title ); ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="button create-preset"><?php echo esc_html__( 'Create new', 'floral' ); ?></button>
            </div>
            <script>
                (function ($) {
                    $(document).ready(function () {
                        $('.floral-preset-management').find('select.options-preset-select').each(function () {
                            var default_params = {
                                width        : '200px',
                                triggerChange: true,
                                allowClear   : false
                            };
                            
                            $(this).select2(default_params);
                        })
                    })
                })(jQuery);
            
            </script>
        <?php endif; ?>
        <div class="logging-panel"></div>
    </div>
    <div class="pull-right col-right">
        <div class="hint redux-hint-qtip" qtip-title="<?php echo esc_attr( 'Global Preset Of The Theme', 'floral' ) ?>" qtip-content="" data-hasqtip="1" aria-describedby="qtip-1">
            <a href="http://docs.9wpthemes.com/floral-documentation/#document-8">
                <i class="fa fa-question-circle"></i>
            </a>
        </div>
        <span class="global-mark"><?php echo esc_html__( 'Global:', 'floral' ); ?></span>
        <a class="global-preset-title" href="<?php echo admin_url( 'admin.php?page=' . $this->parent->args['page_slug'] . '&opt_name=' . $global_preset ) ?>"><?php echo esc_html( $preset_list[$global_preset] ); ?></a>
    </div>
</div>
<div id="redux-sticky">
    <div id="info_bar">
        <div class="floral_redux-current-preset">
            <h3 class="current-preset" data-current-preset="<?php echo esc_attr( $current_preset ); ?>">
                <span class="preset-title"><?php echo sprintf( '%s', $preset_list[$current_preset] ); ?></span>
            </h3>
            <div class="preset-actions">
                <div class="hint redux-hint-qtip" qtip-title="<?php echo esc_attr( 'Edit Preset Name', 'floral' ) ?>" qtip-content="" data-hasqtip="2" aria-describedby="qtip-2">
                    <a class="action-edit" href="javascript:void(0);">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>
                <?php if ( $current_preset !== $global_preset ): ?>
                    <div class="hint redux-hint-qtip" qtip-title="<?php echo esc_attr( 'Make This Preset As Global', 'floral' ) ?>" qtip-content="" data-hasqtip="3" aria-describedby="qtip-3">
                        <a class="action-make-global" href="javascript:void(0);">
                            <i class="fa fa-globe"></i>
                        </a>
                    </div>
                <?php endif; ?>
                
                <?php if ( $current_preset !== FLORAL_THEME_OPTIONS_DEFAULT_NAME ): ?>
                    <div class="hint redux-hint-qtip" qtip-title="<?php echo esc_attr( 'Remove This Preset', 'floral' ) ?>" qtip-content="" data-hasqtip="4" aria-describedby="qtip-4">
                        <a class="action-remove" href="javascript:void(0);">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="redux-action_bar" data-trigger-auto-save="<?php echo esc_attr( $trigger_auto_save ); ?>">
            <span class="spinner"></span>
            <?php if ( false === $this->parent->args['hide_save'] ) { ?>
                <?php submit_button( esc_attr__( 'Save Changes', 'floral' ), 'primary', 'redux_save', false ); ?>
                <?php submit_button( esc_attr__( 'Save & Generate CSS', 'floral' ), 'secondary', $this->parent->args['opt_name'] . '[compiler]', false, array( 'id' => 'button-generate-css' ) ); ?>
            <?php } ?>
            
            <?php if ( false === $this->parent->args['hide_reset'] ) { ?>
                <?php submit_button( esc_attr__( 'Reset Section', 'floral' ), 'secondary', $this->parent->args['opt_name'] . '[defaults-section]', false, array( 'id' => 'redux-defaults-section' ) ); ?>
                <?php submit_button( esc_attr__( 'Reset All', 'floral' ), 'secondary', $this->parent->args['opt_name'] . '[defaults]', false, array( 'id' => 'redux-defaults' ) ); ?>
            <?php } ?>
        </div>
        <div class="redux-ajax-loading" alt="<?php esc_attr_e( 'Working...', 'floral' ) ?>">&nbsp;</div>
        <div class="clear"></div>
    </div>
    
    <!-- Notification bar -->
    <div id="redux_notification_bar">
        <?php $this->notification_bar(); ?>
        <?php if ( isset( $_REQUEST['opt_name'] ) && floral_is_preset_exist( $_REQUEST['opt_name'] ) ) : ?>
            <div class="preset_switched_notice admin-notice notice-green" style="display: none;">
                <strong><?php echo sprintf( esc_html__( 'You are editing preset: %s', 'floral' ), $preset_list[$_REQUEST['opt_name']] ); ?></strong>
            </div>
        <?php endif; ?>
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
    </div>
</div>
<script type="text/html" id="template-create-preset">
    <div class="floral-preset-form-wrapper">
        <h4><?php echo esc_html__( 'Create new preset', 'floral' ); ?></h4>
        <div class="form-input">
            <div class="form-left">
                <label for="preset-title"><?php echo esc_html__( 'Name', 'floral' ); ?></label>
            </div>
            <div class="form-right">
                <input type="text" class="text preset-title" name="preset-title" placeholder="<?php echo esc_html__( 'Preset name', 'floral' ); ?>" />
            </div>
        </div>
        <div class="form-input">
            <div class="form-left">
                <label for="preset-clone"><?php echo esc_html__( 'Clone From', 'floral' ); ?></label>
            </div>
            <div class="form-right">
<!--                <select class="preset-clone redux-select-item" name="preset-clone">-->
                <select class="preset-clone redux-select-item" name="preset-clone">
                    <option value="none"><?php echo esc_html__( 'None', 'floral' ); ?></option>
                    <?php if ( !empty( $preset_list ) ): ?>
                        <?php foreach ( (array) $preset_list as $preset_name => $preset_title ): ?>
                            <option value="<?php echo esc_attr( $preset_name ); ?>"><?php echo esc_html( $preset_title ); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <div class="form-input">
            <div class="form-left">&nbsp;</div>
            <div class="form-right">
                <input type="checkbox" class="input-text preset-edit" name="preset-edit" id="id-preset-edit" checked="checked" />
                <label for="id-preset-edit"><?php echo esc_html__( 'Edit this preset after creation.', 'floral' ); ?></label>
            </div>
        </div>
        
        <div class="block-loading">
            <span class="spinner"></span>
        </div>
    </div>
</script>