<?php
/**
 * Copyright(c) 2016, 9WPThemes
 * @filename: system-status.php
 * @time    : 8/26/16 12:31 PM
 * @author  : 9WPThemes Team
 */
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$sys_status = $this->getSystemStatus();
?>
<table class="widefat" cellspacing="0" id="status">
    <thead>
    <tr>
        <th colspan="2">
            <?php esc_html_e( 'Server Environment', 'floral' ); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <?php esc_html_e( 'Server Info', 'floral' ); ?>:
        </td>
        <td>
            <?php echo esc_html( $sys_status['server_info'] ); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'PHP Version', 'floral' ); ?>:
        </td>
        <td>
            <?php
            if ( version_compare( $sys_status['php_ver'], '5.4' ) == - 1 ) {
                echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current PHP version is %s - The theme only work with version greater than or equal to <strong>5.4</strong>. Please contact you hosting provider to upgrade the PHP version.', 'floral' ), $sys_status['php_ver'] ) . '</mark>';
            } else {
                echo '<mark class="yes">' . esc_html( $sys_status['php_ver'] ) . '</mark>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'ABSPATH', 'floral' ); ?>:
        </td>
        <td>
            <?php echo '<code>' . esc_html( $sys_status['abspath'] ) . '</code>'; ?>
        </td>
    </tr>
    
    <?php if ( function_exists( 'ini_get' ) ) : ?>
        <tr>
            <td>
                <?php esc_html_e( 'PHP Memory Limit (memory_limit)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if ( $sys_status['php_mem_limit']['raw'] < 300000000 ) {
                    echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current value is %s - Recommended value is <strong>300 M</strong>. Please contact you hosting provider to change this option.', 'floral' ), $sys_status['php_mem_limit']['size'] ) . '</mark>';
                } else {
                    echo '<mark class="yes">' . esc_html( $sys_status['php_mem_limit']['size'] ) . '</mark>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'PHP Post Max Size (post_max_size)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if ( $sys_status['php_post_max_size']['raw'] < 64000000 ) {
                    echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current value is %s - Recommended value is <strong>64 M</strong>. Please contact you hosting provider to change this option.', 'floral' ), $sys_status['php_post_max_size']['size'] ) . '</mark>';
                } else {
                    echo '<mark class="yes">' . esc_html( $sys_status['php_post_max_size']['size'] ) . '</mark>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'PHP Max Input Time (max_input_time)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if($sys_status['php_max_input_time'] != - 1 && $sys_status['php_max_input_time'] < 300) {
                    echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current value is %s - Recommended value is <strong>300</strong>. Please contact you hosting provider to change this option.', 'floral' ), $sys_status['php_max_input_time'] ) . '</mark>';
                } else {
                    echo '<mark class="yes">' . esc_html( $sys_status['php_max_input_time'] ) . '</mark>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'PHP Max Execution Time (max_execution_time)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if ( $sys_status['php_max_execution_time'] < 300 ) {
                    echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current value is %s - Recommended value is <strong>300</strong>. Please contact you hosting provider to change this option.', 'floral' ), $sys_status['php_max_execution_time'] ) . '</mark>';
                } else {
                    echo '<mark class="yes">' . esc_html( $sys_status['php_max_execution_time'] ) . '</mark>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'PHP Max Input Vars (max_input_vars)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if ( $sys_status['php_max_input_var'] < 3000 ) {
                    echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current value is %s - Recommended value is <strong>3000</strong>. Please contact you hosting provider to change this option.', 'floral' ), $sys_status['php_max_input_var'] ) . '</mark>';
                } else {
                    echo '<mark class="yes">' . esc_html( $sys_status['php_max_input_var'] ) . '</mark>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'PHP Display Errors (display_errors)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if ( 'true' === $sys_status['php_display_errors'] ) {
                    echo '<mark class="yes">' . '&#10004;' . '</mark>';
                } else {
                    echo '<mark class="no">' . '&ndash;' . '</mark>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'Max Upload Size (upload_max_filesize)', 'floral' ); ?>:
            </td>
            <td>
                <?php
                if ( $sys_status['max_upload_size']['raw'] < 64000000 ) {
                    echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Current value is %s - Recommended value is <strong>64 M</strong>. Please contact you hosting provider to change this option.', 'floral' ), $sys_status['max_upload_size']['size'] ) . '</mark>';
                } else {
                    echo '<mark class="yes">' . esc_html( $sys_status['max_upload_size']['size'] ) . '</mark>';
                }
                ?>
            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <td>
            <?php esc_html_e( 'MySQL Version', 'floral' ); ?>:
        </td>
        <td><?php echo esc_html( $sys_status['mysql_ver'] ); ?></td>
    </tr>
    
    <tr>
        <td>
            <?php esc_html_e( 'Default Timezone is UTC', 'floral' ); ?>:
        </td>
        <td>
            <?php
            if ( $sys_status['def_tz_is_utc'] === 'false' ) {
                echo '<mark class="error">' . '&#10005; ' . sprintf( esc_html__( 'Default timezone is %s - it should be UTC', 'floral' ), esc_html( date_default_timezone_get() ) ) . '</mark>';
            } else {
                echo '<mark class="yes">' . '&#10004;' . '</mark>';
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>

<table class="widefat" cellspacing="0" id="status">
    <thead>
    <tr>
        <th colspan="2">
            <?php esc_html_e( 'WordPress Environment', 'floral' ); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <?php esc_html_e( 'Home URL', 'floral' ); ?>:
        </td>
        <td><?php echo '<code>' . esc_url( $sys_status['home_url'] ) . '</code>'; ?></td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Site URL', 'floral' ); ?>:
        </td>
        <td>
            <?php echo '<code>' . esc_url( $sys_status['site_url'] ) . '</code>'; ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Theme Directory Writable', 'floral' ); ?>:
        </td>
        <td><?php
            if ( $sys_status['data_writeable'] == 'true' ) {
                echo '<mark class="yes">' . '&#10004; <code>' . esc_html( $sys_status['data_writeable'] ) . '</code></mark> ';
            } else {
                echo sprintf( '<mark class="error">' . '&#10005; ' . esc_html__( 'To allow data saving, make <code>%s</code> writable.', 'floral' ) . '</mark>', esc_html( floral_theme_dir() ) );
            }
            ?></td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Uploads Directory Writable', 'floral' ); ?>:
        </td>
        <td><?php
            if ( $sys_status['uploads_folder_writeable'] == 'true' ) {
                echo '<mark class="yes">' . '&#10004; <code>' . esc_html( $sys_status['uploads_folder_writeable'] ) . '</code></mark> ';
            } else {
                echo sprintf( '<mark class="error">' . '&#10005; ' . esc_html__( 'To allow data saving, make uploads folder writable.', 'floral' ) . '</mark>' );
            }
            ?></td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'WP Content URL', 'floral' ); ?>:
        </td>
        <td>
            <?php echo '<code>' . esc_url( $sys_status['wp_content_url'] ) . '</code> '; ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'WP Version', 'floral' ); ?>:
        </td>
        <td>
            <?php bloginfo( 'version' ); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'WP Multisite', 'floral' ); ?>:
        </td>
        <td><?php if ( $sys_status['wp_multisite'] == true ) {
                echo '&#10004;';
            } else {
                echo '&ndash;';
            } ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Permalink Structure', 'floral' ); ?>:
        </td>
        <td>
            <?php echo esc_html( $sys_status['permalink_structure'] ); ?>
        </td>
    </tr>
    <?php $sof = $sys_status['front_page_display']; ?>
    <tr>
        <td>
            <?php esc_html_e( 'Front Page Display', 'floral' ); ?>:
        </td>
        <td><?php echo esc_html( $sof ); ?></td>
    </tr>
    <?php
    if ( $sof == 'page' ) :
        ?>
        <tr>
            <td>
                <?php esc_html_e( 'Front Page', 'floral' ); ?>:
            </td>
            <td>
                <?php echo esc_html( $sys_status['front_page'] ); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'Posts Page', 'floral' ); ?>:
            </td>
            <td>
                <?php echo esc_html( $sys_status['posts_page'] ); ?>
            </td>
        </tr>
        <?php
    endif;
    ?>
    <tr>
        <td>
            <?php esc_html_e( 'WP Memory Limit', 'floral' ); ?>:
        </td>
        <td>
            <?php
            $memory = $sys_status['wp_mem_limit']['raw'];
            
            if ( $memory < 40000000 ) {
                echo '<mark class="error">' . sprintf( esc_html__( '%s - We recommend setting memory to at least <strong>40MB</strong>. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', 'floral' ), esc_html( $sys_status['wp_mem_limit']['size'] ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark>';
            } else {
                echo '<mark class="yes">' . esc_html( $sys_status['wp_mem_limit']['size'] ) . '</mark>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Database Table Prefix', 'floral' ); ?>:
        </td>
        <td>
            <?php echo esc_html( $sys_status['db_table_prefix'] ); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'WP Debug Mode', 'floral' ); ?>:
        </td>
        <td>
            <?php if ( $sys_status['wp_debug'] === 'true' ) {
                echo '<mark class="yes">' . '&#10004;' . '</mark>';
            } else {
                echo '<mark class="no">' . '&ndash;' . '</mark>';
            } ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Language', 'floral' ); ?>:
        </td>
        <td>
            <?php echo esc_html( $sys_status['wp_lang'] ); ?>
        </td>
    </tr>
    </tbody>
</table>

<table class="widefat" cellspacing="0" id="status">
    <thead>
    <tr>
        <th colspan="2">
            <?php esc_html_e( 'Theme', 'floral' ); ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <?php esc_html_e( 'Name', 'floral' ); ?>:
        </td>
        <td><?php echo esc_html( $sys_status['theme']['name'] ); ?></td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Version', 'floral' ); ?>:
        </td>
        <td>
            <?php
            echo esc_html( $sys_status['theme']['version'] );

            if ( !empty( $theme_version_data['version'] ) && version_compare( $theme_version_data['version'], $active_theme->Version, '!=' ) ) {
                echo ' &ndash; <strong style="color:red;">' . esc_html( $theme_version_data['version'] ) . ' ' . esc_html__( 'is available', 'floral' ) . '</strong>';
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Author', 'floral' ); ?>:
        </td>
        <td>
            <?php echo sprintf( $sys_status['theme']['author'] ); ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php esc_html_e( 'Child Theme', 'floral' ); ?>:
        </td>
        <td>
            <?php
            echo is_child_theme() ? '<mark class="yes">' . '&#10004;' . '</mark>' : '&#10005; <em>' . sprintf( __( 'If you\'re modifying a parent theme you didn\'t build personally, we recommend using a child theme. See: <a href="%s" target="_blank">How to create a child theme</a>', 'floral' ), 'http://codex.wordpress.org/Child_Themes' ) . '</em>';
            ?>
        </td>
    </tr>
    <?php
    if ( is_child_theme() ) {
        ?>
        <tr>
            <td>
                <?php esc_html_e( 'Parent Theme Name', 'floral' ); ?>:
            </td>
            <td><?php echo esc_html( $sys_status['theme']['parent_name'] ); ?></td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'Parent Theme Version', 'floral' ); ?>:
            </td>
            <td><?php echo esc_html( $sys_status['theme']['parent_version'] ); ?></td>
        </tr>
        <tr>
            <td>
                <?php esc_html_e( 'Parent Theme Author', 'floral' ); ?>:
            </td>
            <td>
                <?php echo sprintf( $sys_status['theme']['author'] ); ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<table class="widefat" cellspacing="0" id="status">
    <thead>
    <tr>
        <th colspan="2">
            <?php esc_html_e( 'Browser', 'floral' ); ?>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <?php esc_html_e( 'Browser Info', 'floral' ); ?>:
        </td>
        <td>
            <?php
            foreach ( $sys_status['browser'] as $key => $value ) {
                echo '<strong>' . esc_html( ucfirst( $key ) ) . '</strong>: ' . esc_html( $value ) . '<br/>';
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>



