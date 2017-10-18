<?php
/**
 * Custom post types setup
*/
if ( ! defined( 'ABSPATH' ) ) {exit;}

add_action( 'init', 'abcfsls_register_post_types', 100 );

//----------------------------------------
function abcfsls_register_post_types() {

    $slug = 'edit.php?post_type=cptsls_tbl_a';

    register_post_type( 'cptsls_tbl_a', abcfsls_post_types_tbl_a( $slug, abcfsls_post_types_tbl_a_lbls() ) );
    register_post_type( 'cptsls_tbl_c',abcfsls_post_types_tbl_c( $slug, abcfsls_post_types_tbl_c_lbls() ) );
    register_post_type( 'cptsls_mfilter', abcfsls_post_types_mfilter( $slug, abcfsls_post_types_mfilter_lbls() ) );

    // ISOTOPE
    //register_post_type( 'cptsls_i_cat', abcfsls_post_types_isotope_menu( $slug, abcfsls_post_types_isotope_cat_lbls() ) );
    //register_post_type( 'cptsls_i_az', abcfsls_post_types_isotope_menu( $slug, abcfsls_post_types_isotope_az_lbls() ) );
}

//--------------------------------
function abcfsls_post_types_tbl_a( $slug, $lbls ) {

    $args = array(
        'labels'        => $lbls,
        'description'   => '',
        'public'        => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_nav_menus'     => false,
        'show_ui'       => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_in_menu'  => $slug,
    );

    return $args;
}

function abcfsls_post_types_tbl_a_lbls() {

    $lbls = array(
        'menu_name'	     => __( 'Table A', 'staff-search' ),
        'name'               => __( 'Table A', 'staff-search' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Table A', 'staff-search' ),
        'edit_item'          => __( 'Table A', 'staff-search' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Table A', 'staff-search' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-search' ),
        'not_found'          => __( 'No records found', 'staff-search' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-search' )
    );

    return $lbls;
}
//--------------------------------
function abcfsls_post_types_tbl_c( $slug, $lbls ) {

    $args = array(
            'labels'        => $lbls,
            'description'   => '',
            'public'        => false,
            'hierarchical'  => false,
            'supports'      => array( 'title' ),
            'has_archive'   => false,
            'show_ui'       => true,
            'show_in_menu'  => $slug
    );

    return $args;
}

function abcfsls_post_types_tbl_c_lbls() {

    $lbls = array(
        'menu_name'	     => __( 'Table C', 'staff-search' ),
        'name'               => __( 'Table C', 'staff-search' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Table C', 'staff-search' ),
        'edit_item'          => __( 'Table C', 'staff-search' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Table C', 'staff-search' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-search' ),
        'not_found'          => __( 'No records found', 'staff-search' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-search' )
    );

    return $lbls;
}


//-----------------------------------------------------
function abcfsls_post_types_mfilter( $slug, $lbls ) {

    $args = array(
            'labels'        => $lbls,
            'description'   => '',
            'public'        => false,
            'hierarchical'  => false,
            'supports'      => array( 'title' ),
            'has_archive'   => false,
            'show_ui'       => true,
            'show_in_menu'  => $slug
    );

    return $args;
}

function abcfsls_post_types_mfilter_lbls() {

    $lbls = array(
        'name'               => __( 'Multi Filters Plus', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Multi Filter Plus', 'staff-list' ),
        'edit_item'          => __( 'Multi Filter Plus', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Multi Filters Plus', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );
    return $lbls;
}

// ISOTOPE   ---------------------------
function abcfsls_post_types_isotope_cat_lbls() {

    $lbls = array(
        'name'               => __( 'Isotope Category', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Isotope Category', 'staff-list' ),
        'edit_item'          => __( 'Isotope Category', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Isotope Category', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );

    return $lbls;
}

function abcfsls_post_types_isotope_az_lbls() {

    $lbls = array(
        'name'               => __( 'Isotope AZ', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Isotope AZ', 'staff-list' ),
        'edit_item'          => __( 'Isotope AZ', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Isotope AZ', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );

    return $lbls;
}

function abcfsls_post_types_isotope_menu( $slug, $lbls ) {

    $args = array(
            'labels'        => $lbls,
            'description'   => '',
            'public'        => false,
            'hierarchical'  => false,
            'supports'      => array( 'title' ),
            'has_archive'   => false,
            'show_ui'       => true,
            'show_in_menu'  => $slug
    );

    return $args;
}