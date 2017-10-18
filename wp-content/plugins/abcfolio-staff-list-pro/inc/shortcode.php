<?php
/**
 * Process shortcode
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

//Add a hook for a shortcode tag.
//1.Shortcode tag to be searched in post content.
//2-Function to run when shortcode is found.
add_shortcode( 'abcf-staff-list', 'abcfsl_scode_add_list' );
add_shortcode( 'abcf-staff-grid-a', 'abcfsl_scode_add_grid_a' );
add_shortcode( 'abcf-staff-grid-b', 'abcfsl_scode_add_grid_b' );
add_shortcode( 'abcf-staff-single', 'abcfsl_scode_add_single' );

// ISOTOPE
add_shortcode( 'abcf-staff-grid-ia', 'abcfsl_scode_add_grid_ia' );

//Old shortcodes
add_shortcode( 'abcf-staff-grid', 'abcfsl_scode_add_grid_a' );
add_shortcode( 'abcf-staff-list-grid', 'abcfsl_scode_add_grid_b' );
add_shortcode( 'abcf-staff-sp', 'abcfsl_scode_add_single' );
add_shortcode( 'abcf-staff-cat-menu', 'abcfsl_scode_cat_menu' );
add_shortcode( 'abcf-staff-az-menu', 'abcfsl_scode_az_menu' );

//add_shortcode( 'abcf-staff-menu-category', 'abcfsl_scode_render_menu_category' );
//Render page.
function abcfsl_scode_cat_menu( $scodeArgs ) {
    $out = abcfsl_cnt_menu_from_category_shortcode( abcfsl_scode_args( $scodeArgs ) );
    return $out['menuItemsHTML'];
}

function abcfsl_scode_az_menu( $scodeArgs ) {
    $out = abcfsl_cnt_menu_from_shortcode( abcfsl_scode_args( $scodeArgs ), 'AZM' );
    return $out['menuItemsHTML'];
}

//-----------------------------------------------------------
function abcfsl_scode_add_grid_a( $scodeArgs ) {
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'A';
    return abcfsl_cnt_html( $args );
}

function abcfsl_scode_add_grid_b( $scodeArgs ) {
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'B';
    return abcfsl_cnt_html( $args );
}

function abcfsl_scode_add_list( $scodeArgs ) {
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'L';
    return abcfsl_cnt_html( $args );
}

// ISOTOPE
function abcfsl_scode_add_grid_ia( $scodeArgs ) {

    wp_enqueue_script( 'abcfsl_imagesloaded' );
    wp_enqueue_script( 'abcfsl_isotope' );
    $args = abcfsl_scode_args( $scodeArgs );
    $args['tplate']= 'IA';
    return abcfsl_cnt_html( $args );
}
//---------------------------------------------------------------

function abcfsl_scode_add_single( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_scode_defaults(), $scodeArgs );
    $staffMemberID = ( get_query_var('smid') ) ? get_query_var('smid' ) : 0;
    $args['smid'] =  $staffMemberID;
    $args['staff-name'] = get_query_var('staff-name');

    return abcfsl_cnt_spage($args);
}

function abcfsl_scode_defaults() {

    $obj = ABCFSL_Main();
    $ver = str_replace('.', '' , $obj->pluginVersion);
    $prefix = $obj->prefix;

    //SCMENUID
    return array( 'id' => '0',
        'pversion' => $ver,
        'prefix' => $prefix,
        'category' => '',
        'random' => false,
        'top' => '',
        'master' => '',
        'staff-id' => '0',
        'staff-az' => '',
        'staff-category' => '',
        'smid' => '0',
        'staff-name' => '',
        'page' => '',
        'order' => 'ASC',
        'menu-id' => ''
   );
}

function abcfsl_scode_args( $scodeArgs ) {

    $args = shortcode_atts( abcfsl_scode_defaults(), $scodeArgs );
    if( $args['random'] == '1' ) { $args['random'] = true;}

//    $slpCat = (get_query_var('slpcat') ) ? get_query_var( 'slpcat' ) : '';
//    $args['slpcat'] =  $slpCat;

    $staffAZ = (get_query_var('staff-az') ) ? get_query_var( 'staff-az' ) : '';
    $args['staff-az'] = $staffAZ;

    $staffCategory = (get_query_var('staff-category') ) ? get_query_var( 'staff-category' ) : '';
    $args['staff-category'] = $staffCategory;

    // PG ----
    $staffPg = (get_query_var('page') ) ? get_query_var( 'page' ) : '';
    $args['page'] = $staffPg;

    return $args;
}
//-- Shortcode builders -------------------------------------------
function abcfsl_scode_build_scode( $esc = true ) {

    global $post;
    $listID = $post->ID;
    $lstTplateID = $post->post_parent; //????????????????????????

    $tplateOptns = get_post_custom( $lstTplateID );
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '1';

    $scodeL = '[abcf-staff-list' . ' id="' . $listID . '"]';
    $scodeLR = '[abcf-staff-list' . ' id="' . $listID . '" random="1"]';
    $scodeLC = '[abcf-staff-list' . ' id="' . $listID . '" category="slug"]';
    $scodeSP = '[abcf-staff-single' . ' id="' . $listID . '"]';

    // ISOTOPE
    switch ($lstLayout) {
        case 2:
            $scodeL = '[abcf-staff-grid-b' . ' id="' . $listID . '"]';
            $scodeLR = '[abcf-staff-grid-b' . ' id="' . $listID . '" random="1"]';
            $scodeLC = '[abcf-staff-grid-b' . ' id="' . $listID . '" category="slug"]';
            break;
        case 3:
            $scodeL = '[abcf-staff-grid-a' . ' id="' . $listID . '"]';
            $scodeLR = '[abcf-staff-grid-a' . ' id="' . $listID . '" random="1"]';
            $scodeLC = '[abcf-staff-grid-a' . ' id="' . $listID . '" category="slug"]';
            break;
        case 10:
            $scodeL = '[abcf-staff-grid-ia' . ' id="' . $listID . '"]';
            $scodeLR = '[abcf-staff-grid-ia' . ' id="' . $listID . '" random="1"]';
            $scodeLC = '[abcf-staff-grid-ia' . ' id="' . $listID . '" category="slug"]';
            break;
        default:
            break;
    }

    if($esc){
        $scodeL = esc_attr( $scodeL );
        $scodeLR = esc_attr( $scodeLR );
        $scodeLC = esc_attr( $scodeLC );
        $scodeSP = esc_attr( $scodeSP );
    }
    $scodes['scodeL'] = $scodeL;
    $scodes['scodeLR'] = $scodeLR;
    $scodes['scodeLC'] = $scodeLC;
    $scodes['scodeSP'] = $scodeSP;
    return $scodes;
}

function abcfsl_scode_build_scode_cat_menu( $tplateID, $esc = true ) {
    $scode = '[abcf-staff-cat-menu' . ' id="' . $tplateID . '"]';
    if($esc){ $scode = esc_attr( $scode ); }
    return $scode;
}

function abcfsl_scode_build_scode_az_menu( $tplateID, $esc = true ) {
    $scode = '[abcf-staff-az-menu' . ' id="' . $tplateID . '"]';
    if($esc){ $scode = esc_attr( $scode ); }
    return $scode;
}

function abcfsl_scode_build_scode_menu_par( $menuID, $menuType ) {

    $scode = 'menu-id="' . $menuType . $menuID . '"';
    $scode = esc_attr( $scode );
    return $scode;
}

