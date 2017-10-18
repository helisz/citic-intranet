<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', 'abcfsls_script_enq_css', 21 );
add_action( 'wp_enqueue_scripts', 'abcfsls_script_reg_js' );

function abcfsls_script_enq_css() {

    $obj = ABCFSLS_Main();
    $ver = $obj->pluginVersion;

    wp_register_style('abcf_staff_search', ABCFSLS_PLUGIN_URL . 'css/staff-search.css', array(), $ver, 'all');
    wp_enqueue_style('abcf_staff_search');
}

//abcfsls_script_reg_js_production
function abcfsls_script_reg_js() {

    $obj = ABCFSLS_Main();
    $ver = $obj->pluginVersion;

    wp_register_script( 'abcf_datatables_js', ABCFSLS_PLUGIN_URL . 'js/dt/jquery.dataTables.min.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_datatables_responsive_js', ABCFSLS_PLUGIN_URL . 'js/dt/dataTables.responsive.min.js', array( 'jquery' ), $ver, true );

    wp_register_script( 'abcf_datatables_buttons_js', ABCFSLS_PLUGIN_URL . 'js/dt/dataTables.buttons.min.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_buttons_html5_js', ABCFSLS_PLUGIN_URL . 'js/dt/buttons.html5.min.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_buttons_print_js', ABCFSLS_PLUGIN_URL . 'js/dt/buttons.print.min.js', array( 'jquery' ), $ver, true );

    wp_register_script( 'abcf_pdfmake_js', ABCFSLS_PLUGIN_URL . 'js/dt/pdfmake.min.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_vfs_fonts_js', ABCFSLS_PLUGIN_URL . 'js/dt/vfs_fonts.min.js', array( 'jquery' ), $ver, true );

    wp_register_script( 'abcf_searchHighlight_js', ABCFSLS_PLUGIN_URL . 'js/dt/searchHighlight.min.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_jszip_js', ABCFSLS_PLUGIN_URL . 'js/dt/jszip.min.js', array( 'jquery' ), $ver, true );
}

//abcfsls_script_reg_js_debug
function abcfsls_script_reg_js_debug() {
    $obj = ABCFSLS_Main();
    $ver = $obj->pluginVersion;

    wp_register_script( 'abcf_datatables_js', ABCFSLS_PLUGIN_URL . 'js/debug/jquery.dataTables_1.10.15.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_datatables_responsive_js', ABCFSLS_PLUGIN_URL . 'js/debug/dataTables.responsive_2.2.0.js', array( 'jquery' ), $ver, true );

    wp_register_script( 'abcf_datatables_buttons_js', ABCFSLS_PLUGIN_URL . 'js/debug/dataTables.buttons_1.3.1.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_buttons_html5_js', ABCFSLS_PLUGIN_URL . 'js/debug/buttons.html5_1.3.1.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_buttons_print_js', ABCFSLS_PLUGIN_URL . 'js/debug/buttons.print_1.3.1.js', array( 'jquery' ), $ver, true );

    wp_register_script( 'abcf_pdfmake_js', ABCFSLS_PLUGIN_URL . 'js/debug/pdfmake_1.2.8.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_vfs_fonts_js', ABCFSLS_PLUGIN_URL . 'js/debug/vfs_fonts_1.2.8.js', array( 'jquery' ), $ver, true );

    wp_register_script( 'abcf_jszip_js', ABCFSLS_PLUGIN_URL . 'js/jszip.min_3.1.3.js', array( 'jquery' ), $ver, true );
    wp_register_script( 'abcf_searchHighlight_js', ABCFSLS_PLUGIN_URL . 'js/searchHighlight_1.0.1.js', array( 'jquery' ), $ver, true );
}


