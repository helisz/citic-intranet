<?php

if ( ! defined( 'ABSPATH' ) ) {exit;}

add_action( 'init', 'abcfsl_register_tax_category', 10);
add_action( 'init', 'abcfsl_register_post_types', 100 );

//----------------------------------------
function abcfsl_register_post_types() {

    $slug = 'edit.php?post_type=cpt_staff_lst_item';

    register_post_type( 'cpt_staff_lst_item', abcfsl_post_types_args_sm() );
    register_post_type( 'cpt_staff_lst', abcfsl_post_types_args_st() );
    register_post_type( 'cpt_staff_lst_menu', abcfsl_post_types_args_cm() );
    register_post_type( 'cpt_staff_az_menu', abcfsl_post_types_args_azm() );
    register_post_type( 'cpt_staff_mfilter', abcfsl_post_types_mfilter( $slug, abcfsl_post_types_mfilter_lbls() ) );
}

function abcfsl_register_tax_category() {
    register_taxonomy( 'tax_staff_member_cat', array( 'cpt_staff_lst_item'), abcfsl_tax_category_args() );
}

//-- Staff Member ---------------------------------------------
function abcfsl_post_types_lbls_sm() {

    $lbls = array(
            'menu_name' => 'Staff List',
            'name'               => 'Staff Members',
            'add_new'            => __( 'Add New' ),
            'add_new_item'       => 'Staff Member',
            'edit_item'          => 'Staff Member',
            'new_item'           => __( 'New'),
            'all_items'          => 'Staff Members', //Main menu label
            'search_items'       => __( 'Search', 'staff-list' ),
            'not_found'          => __( 'No records found', 'staff-list' ),
            'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );
    return $lbls;
}

function abcfsl_post_types_args_sm() {

    $args = array(
        'labels'        => abcfsl_post_types_lbls_sm(),
        'description'   => '',
        'taxonomies'    => array( 'tax_staff_lst_grp' ),
        'public'        => true,
    'exclude_from_search'   => true,
    'publicly_queryable'   => false,
    'show_in_nav_menus'   => false,
    'show_ui'       => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'   => 'dashicons-groups',
        'menu_position' => 81,
        'capability_type' => 'staff_member',
        'map_meta_cap' => true
    );
    return $args;
}
//-- Staff Template --------------------------------
function abcfsl_post_types_lbls_st() {

    $lbls = array(
        'menu_name'	     => __( 'Menu Staff', 'staff-list' ),
        'name'               => __( 'Staff Templates', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Staff Template', 'staff-list' ),
        'edit_item'          => __( 'Staff Template', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Staff Templates', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );
    return $lbls;
}

function abcfsl_post_types_args_st() {

    $args = array(
        'labels'        => abcfsl_post_types_lbls_st(),
        'description'   => '',
        'public'        => true,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => 'edit.php?post_type=cpt_staff_lst_item'
    );

    return $args;
}

//-- Category Menu --------------------------------
function abcfsl_post_types_lbls_cm() {
    $lbls = array(
        'name'               => __( 'Category Menus', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Category Menu', 'staff-list' ),
        'edit_item'          => __( 'Category Menu', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Category Menus', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );
    return $lbls;
}

function abcfsl_post_types_args_cm() {
    $args = array(
        'labels'        => abcfsl_post_types_lbls_cm(),
        'description'   => '',
        'public'        => false,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => 'edit.php?post_type=cpt_staff_lst_item'
    );
    return $args;
}

//--AZ Menu --------------------------------------
function abcfsl_post_types_lbls_azm() {
    $lbls = array(
        'name'               => __( 'AZ Menus', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'AZ Menu', 'staff-list' ),
        'edit_item'          => __( 'AZ Menu', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'AZ Menus', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );
    return $lbls;
}

function abcfsl_post_types_args_azm() {
    $args = array(
        'labels'        => abcfsl_post_types_lbls_azm(),
        'description'   => '',
        'public'        => false,
        'hierarchical'  => false,
        'supports'      => array( 'title' ),
        'has_archive'   => false,
        'show_ui'       => true,
        'show_in_menu'  => 'edit.php?post_type=cpt_staff_lst_item'
    );
    return $args;
}
//==============================================================
function abcfsl_post_types_mfilter( $slug, $lbls ) {

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


// MULTI MENUS ---------------------------
function abcfsl_post_types_mfilter_lbls() {

    $lbls = array(
        'name'               => __( 'Multi Filters', 'staff-list' ),
        'add_new'            => __( 'Add New' ),
        'add_new_item'       => __( 'Multi Filter', 'staff-list' ),
        'edit_item'          => __( 'Multi Filter', 'staff-list' ),
        'new_item'           => __( 'New'),
        'all_items'          => __( 'Multi Filters', 'staff-list' ), //Main menu label
        'search_items'       => __( 'Search', 'staff-list' ),
        'not_found'          => __( 'No records found', 'staff-list' ),
        'not_found_in_trash' => __( 'No records found in the Trash', 'staff-list' )
    );
    return $lbls;
}


// -- Categories taxonomy -------------------------------------------
function abcfsl_tax_category_lbls() {
    $lbls = array(
            'name'              => _x( 'Staff Categories', 'taxonomy general name', 'staff-list' ),
            'singular_name'     => _x( 'Staff Category', 'taxonomy singular name', 'staff-list' ),
            'search_items'      => __( 'Search Staff Categories', 'staff-list' ),
            'all_items'         => __( 'Staff Categories', 'staff-list' ),
            'parent_item'       => __( 'Parent Category', 'staff-list' ),
            'parent_item_colon' => __( 'Parent Category:', 'staff-list' ),
            'edit_item'         => __( 'Edit Staff Category', 'staff-list' ),
            'update_item'       => __( 'Update Staff Category', 'staff-list' ),
            'add_new_item'      => __( 'Add Staff Category', 'staff-list' ),
            'new_item_name'     => __( 'New Staff Category Name', 'staff-list' )
    );
    return $lbls;
}

function abcfsl_tax_category_args() {
//Taxonomy capabilities include
//assign_terms,
//edit_terms,
//manage_terms (displays the taxonomy in the admin navigation)
//and delete_terms.
    $args = array(
        'labels' => abcfsl_tax_category_lbls(),
        'public'  => false,
        'show_ui' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'show_in_nav_menus' => false,
        'show_in_menu'  => false,
        'rewrite' => array( 'slug' => 'staff_category' ),
        'capabilities' => array(
            'manage_terms'  => 'manage_staff_categories' ,
            'edit_terms'    => 'manage_staff_categories',
            'delete_terms'  => 'manage_staff_categories',
            'assign_terms'  => 'assign_staff_categories'
        )
    );
    return $args;
}

//Role Staff Member Editor : staff_member_editor
//Editorlssua Hr, Staff Member Editor
//Staff Editor Test
//63zvB3#o2NCREAW94Ofxx4cU

//Posts > Categories : Test Category
//Posts > Categories : Test Category Editor
//Staff List > Categories : Test Staff Category – Editor
//Staff List > Categories : Test Staff Category – Admin

//manage_post_tags
//edit staff-members ???
//edit-staff-members
//Test Category Updated by Editor

//Cheatin’ uh?. Sorry, you are not allowed to manage these items.
//You attempted to edit an item that doesn’t exist. Perhaps it was deleted?
// Test Staff Category – Events Calendar
//https://lssutest.wpengine.com/wp-admin/edit-tags.php

//manage_post_tags
//Empty Term

//Created user Staff Editor Test ans assigned it to role Editor
// manage_tribe_events_cats

//Calendars

//Test Staff Category – Editor