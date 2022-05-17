<?php
/**
 * If a Pantheon site is in Git mode, hide the Plugin installation functionality and show a notice.
 */

if ( ! wp_is_writable( WP_PLUGIN_DIR ) ) {
    if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
        define( 'DISALLOW_FILE_MODS', true );
    }

    add_action( 'admin_notices', '_pantheon_plugin_install_notice' );
    add_action( 'network_admin_notices', '_pantheon_plugin_install_notice' );
}

function _pantheon_plugin_install_notice() {
    $screen = get_current_screen(); 
    // Only show this notice on the plugins page.
    if ( 'plugins' === $screen->id || 'plugins-network' === $screen->id ) { ?>
        <div class="update-nag notice notice-warning is-dismissible" style="margin: 5px 6em 15px 0;">
            <p style="font-size: 14px; margin: 0;">
                If you wish to update or add plugins using the WordPress UI, switch your site to SFTP mode from <a href="https://dashboard.pantheon.io/sites/<?php echo $_ENV['PANTHEON_SITE']; ?>">your Pantheon dashboard</a>.
            </p>
        </div>
        <?php
    }
}