<?php
function abcfsl_mbox_mfilter_tabs(){

    abcfsl_v_tabs_manager_div_s( '1' ); //---Manager START
        abcfsl_mbox_mfilter_tabs_render_nav_tabs();
        abcfsl_mbox_mfilter_tabs_render_cnt();
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsl_mbox_mfilter_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsl_v_tabs_render_nav_tab( 'abcflVTabsTabActive', abcfsl_txta(65)  . ' 1');
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(65)  . ' 2' );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(178) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(13) );
        echo abcfsl_v_tabs_render_nav_tab( '', abcfsl_txta(3) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsl_mbox_mfilter_tabs_render_cnt( ){

    global $post;
    $filterID = $post->ID;
    $filterOptns = get_post_custom( $filterID );
    $mFilterType1 = isset( $filterOptns['_mFilterType1'] ) ? esc_attr( $filterOptns['_mFilterType1'][0] ) : '';

    echo abcfl_html_tag( 'div', 'abcfsl_VTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

        abcfsl_mbox_mfilter_items( $filterID, $filterOptns, '1' );

        //Inputs are hidden if Filter 1 is not selected.
        if ( !empty( $mFilterType1 ) ){
            abcfsl_mbox_mfilter_items( $filterID, $filterOptns, '2' );
            abcfsl_mbox_mfilter_labels( $filterOptns );
            abcfsl_mbox_mfilter_layout( $filterOptns );
            abcfsl_mbox_menu_shortcode_par( $filterID, 'MTF-' );
        }

    echo abcfl_html_tag_end( 'div' ); //---Content END

}