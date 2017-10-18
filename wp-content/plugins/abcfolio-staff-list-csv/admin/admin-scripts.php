<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_enqueue_scripts', 'abcfslc_enq_admin_css', 10 );
add_action( 'admin_enqueue_scripts', 'abcfslc_enq_admin_js' );

//==ADMIN========================================================================================
//Admin CSS
function abcfslc_enq_admin_css() {

    $obj = ABCFSLC_Main();
    $ver = $obj->pluginVersion;

    //wp_register_style('abcf_lib_admin', ABCFSLC_PLUGIN_URL . 'library/abcfl-admin.css', $ver, 'all');
    wp_register_style('abcfslc_admin', ABCFSLC_PLUGIN_URL . 'css/admin.css', $ver, 'all');
    //wp_enqueue_style('abcf_lib_admin');
    wp_enqueue_style('abcfslc_admin');

    wp_register_style('abcfslc_jquery_ui', ABCFSLC_PLUGIN_URL . 'css/jquery-ui.css', $ver, 'all');
    wp_register_style('abcfslc_jquery_ui_structure', ABCFSLC_PLUGIN_URL . 'css/jquery-ui.structure.css', $ver, 'all');
    wp_register_style('abcfslc_jquery_ui_theme', ABCFSLC_PLUGIN_URL . 'css/jquery-ui.theme.css', $ver, 'all');

    wp_enqueue_style('abcfslc_jquery_ui');
    wp_enqueue_style('abcfslc_jquery_ui_structure');
    wp_enqueue_style('abcfslc_jquery_ui_theme');
}

function abcfslc_enq_admin_js() {

    $obj = ABCFSLC_Main();
    $ver = $obj->pluginVersion;

    wp_enqueue_media();
    wp_register_script( 'abcfslc_select_csv', ABCFSLC_PLUGIN_URL . 'js/select-cvs.js', array( 'jquery' ), $ver, true );
    wp_localize_script( 'abcfslc_select_csv', 'abcfslcCSV', array(
            'titleTxt' => __( 'CSV File', 'staff_list_csv' ),
            'buttonTxt' => __( 'Choose File', 'staff_list_csv' ),
            'btnCSVChoose' => '#btnCSVChoose',
            'csvUrl' => '#csvUrl',
            'csvFilename' => '#csvFilename',
            'csvQFilename' => '#csvQFilename'
        )
    );
    wp_enqueue_script('abcfslc_select_csv');

    wp_register_script( 'abcfslc_import_csv', ABCFSLC_PLUGIN_URL . 'js/import-csv.js', array( 'jquery' ), $ver, true );
    wp_localize_script( 'abcfslc_import_csv', 'slcIVars', array( 'nonce' => wp_create_nonce( 'abcfslc_nonce' ), ) );
    wp_enqueue_script('abcfslc_import_csv');

    wp_enqueue_script( 'jquery-ui-dialog' );
    wp_enqueue_script( 'jquery-ui-progressbar' );
    wp_enqueue_style( 'wp-jquery-ui-dialog' );

}


