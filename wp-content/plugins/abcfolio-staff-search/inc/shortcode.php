<?php

if ( ! defined( 'ABSPATH' ) ) {exit;}

add_shortcode( 'abcf-staff-search-a', 'abcfsls_scode_staff_search_a' );
add_shortcode( 'abcf-staff-search-c', 'abcfsls_scode_staff_search_c' );

function abcfsls_scode_staff_search_a( $scodeArgs ) {

    $args = abcfsls_scode_args( $scodeArgs );

    abcfsls_js();
    abcfsls_js_buttons( $args['print'] );

    return abcfsls_cnt_tbl_a( $args );
}

function abcfsls_scode_staff_search_c( $scodeArgs ) {

    $args = abcfsls_scode_args( $scodeArgs );

    abcfsls_js();
    abcfsls_js_buttons( $args['print'] );
    wp_enqueue_script('sls_categories_js');

    return abcfsls_cnt_tbl_c( $args );
}

function abcfsls_js() {
    
    wp_enqueue_script('abcf_datatables_js');
    wp_enqueue_script('abcf_datatables_responsive_js');

    wp_enqueue_script('abcf_searchHighlight_js');
}

function abcfsls_js_buttons( $print ) {

    if( $print == 0 ){ return; }

    wp_enqueue_script('abcf_datatables_buttons_js');
    wp_enqueue_script('abcf_jszip_js');
    wp_enqueue_script('abcf_pdfmake_js');
    wp_enqueue_script('abcf_vfs_fonts_js');
    wp_enqueue_script('abcf_buttons_html5_js');
    wp_enqueue_script('abcf_buttons_print_js');
}

//--------------------------------------------
function abcfsls_scode_defaults() {

    $obj = ABCFSLS_Main();
    $ver = str_replace('.', '' , $obj->pluginVersion);
    $prefix = $obj->prefix;

    return array( 'id' => '0', 'staff-templates' => '', 'pversion' => $ver, 'prefix' => $prefix,
                 'smid' => '0', 'staff-id' => '0', 'category' => '', 'print' => '1' );
}

function abcfsls_scode_args( $scodeArgs ) {

    $args = shortcode_atts( abcfsls_scode_defaults(), $scodeArgs );
    return $args;
}

//---------------------------------------------------------------------------------
//Shortcode builder for metabox
function abcfsls_scode_build_scode_tbl_a( $esc = true ) {

    global $post;
    $listID = $post->ID;
    $scode = '[abcf-staff-search-a' . ' id="' . $listID . '"]';

    if($esc){
        $scode = esc_attr( $scode );
    }
    return $scode;
}

function abcfsls_scode_build_scode_tbl_c( $esc = true ) {

    global $post;
    $listID = $post->ID;
    $scode = '[abcf-staff-search-c' . ' id="' . $listID . '"]';

    if($esc){
        $scode = esc_attr( $scode );
    }
    return $scode;
}

function abcfsls_scode_build_scode_menu_par( $menuID, $menuType ) {

    $scode = 'menu-id="' . $menuType . $menuID . '"';
    $scode = esc_attr( $scode );
    return $scode;
}