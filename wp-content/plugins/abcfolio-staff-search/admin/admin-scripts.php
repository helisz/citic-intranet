<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_enqueue_scripts', 'abcfsls_enq_admin_css', 10 );
add_action( 'admin_enqueue_scripts', 'abcfsls_enq_admin_js' );

//==ADMIN========================================================================================
//Admin CSS
function abcfsls_enq_admin_css() {

    $obj = ABCFSLS_Main();
    $ver = $obj->pluginVersion;

    //wp_register_style('abcf_lib_admin', ABCFSLS_PLUGIN_URL . 'library/abcfl-admin.css', $ver, 'all');
    wp_register_style('abcfsls_admin', ABCFSLS_PLUGIN_URL . 'css/admin.css', $ver, 'all');

    //wp_enqueue_style('abcf_lib_admin-l');
    wp_enqueue_style('abcfsls_admin');
}

function abcfsls_enq_admin_js() {

    global $typenow;
    $obj = ABCFSLS_Main();
    $ver = $obj->pluginVersion;

    if( $typenow == 'cptsls_mfilter' ) {
        wp_register_script( 'abcfsls_cat_menu_items', ABCFSLS_PLUGIN_URL .'js/filter-items.js',
                array('jquery', 'common', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'jquery-ui-mouse'), $ver, true );
        wp_enqueue_script( 'abcfsls_cat_menu_items' );
    }

    $addJS = false;
    switch ( $typenow ) {
        case 'cptsls_tbl_a':
        case 'cptsls_tbl_c':
        case 'cptsls_mfilter':
        case 'cptsls_i_cat':
        case 'cptsls_i_az':
            $addJS = true;
            break;
        default:
            break;
    }

    if( $addJS) {

        wp_register_script( 'abcfsls_sort_fields', ABCFSLS_PLUGIN_URL .'js/sort-fields.js',
                array('jquery', 'common', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'jquery-ui-mouse'), $ver, true );

        wp_localize_script( 'abcfsls_sort_fields', 'abcfsls_ls_sort_fields', array(
                'abcfajaxnonce' => wp_create_nonce( 'abcfnonce' )
        )
        );
        //---------------------------
        wp_register_script( 'abcf_vtabs', ABCFSLS_PLUGIN_URL . 'js/vtabs.js', array( 'jquery' ), $ver, true );
        wp_localize_script('abcf_vtabs', 'abcfVTabs', array(
                            'mgr_1' => '#abcfVTabsMgr_1',
                            'mgr_2' => '#abcfVTabsMgr_2',
                            'cntCntr_1' => '#abcfVTabsCntCntr_1',
                            'cntCntr_2' => '#abcfVTabsCntCntr_2'
        ));

        wp_enqueue_script( 'abcfsls_sort_fields' );
        wp_enqueue_script('abcf_vtabs');
        //--------------------------------------
        wp_register_script( 'abcfsls_i_cat_items', ABCFSLS_PLUGIN_URL .'js/cat-menu-items.js', array('jquery', 'common', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'jquery-ui-sortable', 'jquery-ui-mouse'), $ver, true );
        wp_enqueue_script( 'abcfsls_i_cat_items' );
    }
}



