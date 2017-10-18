<?php

/**
 * Fired when the plugin is uninstalled.
 */

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )  { exit; }

// Leave no trail
if ( !is_multisite() ) {
    abcfslc_uninstall_single();
}
else {
    global $wpdb;
    $blogIDs = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs WHERE archived = '0' AND spam = '0' AND deleted = '0'" );
    $currentBlogID = get_current_blog_id();

    foreach ( $blogIDs as $blogID ) {
        switch_to_blog( $blogID );
        abcfslc_uninstall_single();
    }
    switch_to_blog( $currentBlogID );
}

function abcfslc_uninstall_single() {

    abcfslc_uninstall_drop_tbls();

    //Check DELETE ALL DATA option ?????????????????????????????

    delete_option( 'abcfslc_csv_import_optns' );
    delete_option( 'abcfslc_csv_export_optns' );
    delete_option( 'abcfslc_tplate_export_optns' );
    delete_option( 'abcfslc_tplate_import_optns' );

    //delete_option( 'abcfslc_import_qty' );
    //delete_option( 'abcfslc_imported_qty' );
    //delete_option( 'abcfslc_tplate_import_qty' );
    //delete_option( 'abcfslc_import_qty' );



    abcfslc_uninstall_map_optns();
}

function abcfslc_uninstall_drop_tbls(){
    global $wpdb;
    $wpdb->abcfslc_import_csv = $wpdb->prefix . 'abcfslc_import_csv';
    $wpdb->abcfslc_export_csv = $wpdb->prefix . 'abcfslc_export_csv';
    $wpdb->abcfslc_import_cat = $wpdb->prefix . 'abcfslc_import_cat';
    $wpdb->abcfslc_export_tplate = $wpdb->prefix . 'abcfslc_export_tplate';
    $wpdb->abcfslc_import_tplate = $wpdb->prefix . 'abcfslc_import_tplate';


    $sql1 = "DROP TABLE IF EXISTS $wpdb->abcfslc_import_csv";
    $wpdb->query($sql1);

    $sql2 = "DROP TABLE IF EXISTS $wpdb->abcfslc_export_csv";
    $wpdb->query($sql2);

    $sql3 = "DROP TABLE IF EXISTS $wpdb->abcfslc_import_cat";
    $wpdb->query($sql3);

    $sql4 = "DROP TABLE IF EXISTS $wpdb->abcfslc_export_tplate";
    $wpdb->query($sql4);
}

function abcfslc_uninstall_map_optns() {

    $iMapOptns = abcfslc_uninstall_import_map_option_names();
    foreach ( $iMapOptns as $iMapOptn ) {
        if( substr( $iMapOptn, 0, 19) == 'abcfslc_import_map_' ){ delete_option( $iMapOptn ); }
    }

    $eMapOptns = abcfslc_uninstall_export_map_option_names();
    foreach ( $eMapOptns as $eMapOptn ) {
        if( substr( $eMapOptn, 0, 19) == 'abcfslc_export_map_' ){ delete_option( $eMapOptn ); }
    }
}

function abcfslc_uninstall_import_map_option_names() {
    global $wpdb;
    return $wpdb->get_col("SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'abcfslc_import_map_%'");
}

function abcfslc_uninstall_export_map_option_names() {
    global $wpdb;
    return $wpdb->get_col("SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'abcfslc_export_map_%'");
}
