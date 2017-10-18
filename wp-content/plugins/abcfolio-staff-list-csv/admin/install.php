<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Create all tables. Set default options. Called on register_activation hook
 */
register_activation_hook( ABCFSLC_PLUGIN_FILE, 'abcfslc_activate' );

/**
 * Fired when the plugin is activated. $network_wide =
 * TRUE if WPMU superadmin uses "Network Activate" action,
 * FALSE if WPMU is disabled or plugin is activated on an individual blog.
 */
function abcfslc_activate( $network_wide ) {

    if ( function_exists( 'is_multisite' ) && is_multisite() ) {

            if ( $network_wide ) {
                    // Get all blog ids
                    $blogIDs = abcfslc_dba_wpmu_blogs();
                    foreach ( $blogIDs as $blogID ) {
                            switch_to_blog( $blogID );
                            abcfslc_install_single_activate();
                    }
                    restore_current_blog();
            }
            else{
                abcfslc_install_single_activate();
            }
    }
    else {
        abcfslc_install_single_activate();
    }
}

function abcfslc_install_single_activate() {
    abcfslc_dba_import_create_tbl();
    abcfslc_dba_export_create_tbl();
    abcfslc_dba_cat_create_tbl();
    abcfslc_dba_export_tplate_create_tbl();
}

