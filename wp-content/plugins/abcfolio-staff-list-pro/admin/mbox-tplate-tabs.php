<?php

function abcfsl_mbox_tplate_tabs(){

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;
    $pfix = $obj->prefix;

    global $post;
    $tplateID = $post->ID;
    $tplateOptns = get_post_custom( $tplateID );

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $layout = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START

        switch ( $layout ) {
            case 10:
                abcfsl_mbox_tplate_tabs_render_tabs_isotope_a( $layout );
                abcfsl_mbox_tplate_tabs_render_cnt_isotope_a(  $tplateID, $tplateOptns, $layout, $pfix );
                break;
            default:
                abcfsl_mbox_tplate_tabs_render_tabs_default( $layout );
                abcfsl_mbox_tplate_tabs_render_cnt_default(  $tplateID, $tplateOptns, $layout, $pfix );
                break;
    }
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_tplate_tabs_render_tabs_default( $layout ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(68)  . ' - ' . abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(68)  . ' - ' . abcfsl_txta(202) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(27) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69)  . ' - ' . abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69)  . ' - ' . abcfsl_txta(9) );

        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(52) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(36) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64).  ' - ' . abcfsl_txta(68) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64).  ' - ' . abcfsl_txta(69) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(280) );

        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(180) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(100) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(170) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_tplate_tabs_render_tabs_isotope_a( $layout ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(68)  . ' - ' . abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(68)  . ' - ' . abcfsl_txta(202) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(27) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69)  . ' - ' . abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69)  . ' - ' . abcfsl_txta(9) );

        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(52) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64).  ' - ' . abcfsl_txta(68) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64).  ' - ' . abcfsl_txta(69) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(280) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(180) );

        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(170) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_tplate_tabs_render_cnt_default(  $tplateID, $tplateOptns, $layout, $pfix ){

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

    abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns );
    abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $pfix );
    abcfsl_mbox_tplate_img( $tplateOptns, $pfix );
    abcfsl_mbox_tplate_spg_layout( $tplateOptns );
    abcfsl_mbox_tplate_spg_optns( $tplateOptns );

    abcfsl_mbox_tplate_social( $tplateOptns );
    abcfsl_mbox_tplate_pg( $tplateOptns );
    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, false );
    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, true );
    abcfsl_mbox_tplate_staff_order( $tplateID, $tplateOptns );

    abcfsl_mbox_tplate_structured_data( $tplateOptns );
    abcfsl_mbox_tplate_menu( $tplateOptns );
    abcfsl_mbox_tplate_shortcode($tplateOptns);

    echo abcfl_html_tag_end( 'div' ); //---Content END

}

function abcfsl_mbox_tplate_tabs_render_cnt_isotope_a(  $tplateID, $tplateOptns, $layout, $pfix ){

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

    abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns );
    abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $pfix );
    abcfsl_mbox_tplate_img( $tplateOptns, $pfix );
    abcfsl_mbox_tplate_spg_layout( $tplateOptns );
    abcfsl_mbox_tplate_spg_optns( $tplateOptns );

    abcfsl_mbox_tplate_social( $tplateOptns );
    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, false );
    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, true );
    abcfsl_mbox_tplate_staff_order( $tplateID, $tplateOptns );
    abcfsl_mbox_tplate_structured_data( $tplateOptns );

    abcfsl_mbox_tplate_shortcode($tplateOptns);

    echo abcfl_html_tag_end( 'div' ); //---Content END

}


//#######################################################
//function abcfsl_mbox_tplate_tabs_render_nav_tabs( $layout ){
//
//    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
//        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(68)  . ' - ' . abcfsl_txta(13) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(68)  . ' - ' . abcfsl_txta(202) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(27) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69)  . ' - ' . abcfsl_txta(13) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(69)  . ' - ' . abcfsl_txta(9) );
//
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(52) );
//        if( $layout != 10 ){  echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(36) ); }
//        //echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(36) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64).  ' - ' . abcfsl_txta(68) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(64).  ' - ' . abcfsl_txta(69) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(280) );
//
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(180) );
//        if( $layout != 10 ){  echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(100) ); }
//        //echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(100) );
//        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(170) );
//    echo abcfl_html_tag_end( 'ul' );
//}

//function abcfsl_mbox_tplate_tabs_render_cnt(  $tplateID, $tplateOptns, $layout, $pfix ){
//
////    global $post;
////    $tplateID = $post->ID;
////    $tplateOptns = get_post_custom( $tplateID );
//
//    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START
//
//    print_r($layout);
//
//    abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns );
//    abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $pfix );
//    abcfsl_mbox_tplate_img( $tplateOptns, $pfix );
//    abcfsl_mbox_tplate_spg_layout( $tplateOptns );
//    abcfsl_mbox_tplate_spg_optns( $tplateOptns );
//
//    abcfsl_mbox_tplate_social( $tplateOptns );
//    if( $layout != 10 ){  abcfsl_mbox_tplate_pg( $tplateOptns ); }
//    //abcfsl_mbox_tplate_pg( $tplateOptns );
//    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, false );
//    abcfsl_mbox_tplate_field_order( $tplateID, $tplateOptns, true );
//    abcfsl_mbox_tplate_staff_order( $tplateID, $tplateOptns );
//
//    abcfsl_mbox_tplate_structured_data( $tplateOptns );
//    if( $layout != 10 ){  abcfsl_mbox_tplate_pg( abcfsl_mbox_tplate_menu( $tplateOptns ) ); }
//    //abcfsl_mbox_tplate_menu( $tplateOptns );
//    abcfsl_mbox_tplate_shortcode($tplateOptns);
//
//    echo abcfl_html_tag_end( 'div' ); //---Content END
//
//}

