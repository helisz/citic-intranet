<?php
function abcfsls_mbox_mfilter_tabs(){

    abcfsls_v_tabs_div_s( '1' ); //---Manager START
        abcfsls_mbox_mfilter_tabs_render_nav_tabs();
        abcfsls_mbox_mfilter_tabs_render_cnt();
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    $obj = ABCFSLS_Main();
    $slug = $obj->pluginSlug;

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsls_mbox_mfilter_tabs_render_nav_tabs( ){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsls_v_tabs_li( 'abcflVTabsTabActive',  abcfsls_txta(151)  . ' 1');
        echo abcfsls_v_tabs_li( '', abcfsls_txta(151)  . ' 2' );
        echo abcfsls_v_tabs_li( '',  abcfsls_txta(151)  . ' 3' );
        echo abcfsls_v_tabs_li( '',  abcfsls_txta(151)  . ' 4' );
        echo abcfsls_v_tabs_li( '',  abcfsls_txta(151)  . ' 5' );
        echo abcfsls_v_tabs_li( '',  abcfsls_txta(151)  . ' 6' );
        echo abcfsls_v_tabs_li( '', abcfsls_txta(143) );
        echo abcfsls_v_tabs_li( '', abcfsls_txta(88) );
        echo abcfsls_v_tabs_li( '', abcfsls_txta(13) );
        echo abcfsls_v_tabs_li( '', abcfsls_txta(3) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsls_mbox_mfilter_tabs_render_cnt( ){

    global $post;
    $filterID = $post->ID;
    $filterOptns = get_post_custom( $filterID );
    $mFilterType1 = isset( $filterOptns['_mFilterType1'] ) ? esc_attr( $filterOptns['_mFilterType1'][0] ) : '';

    echo abcfl_html_tag( 'div', 'abcfVTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

        abcfsls_mbox_mfilter_filters( $filterID, $filterOptns, '1' );

        //Inputs are hidden if Filter 1 is not selected.
        if ( !empty( $mFilterType1 ) ){
            abcfsls_mbox_mfilter_filters( $filterID, $filterOptns, '2' );
            abcfsls_mbox_mfilter_filters( $filterID, $filterOptns, '3' );
            abcfsls_mbox_mfilter_filters( $filterID, $filterOptns, '4' );
            abcfsls_mbox_mfilter_filters( $filterID, $filterOptns, '5' );
            abcfsls_mbox_mfilter_filters( $filterID, $filterOptns, '6' );
            abcfsls_mbox_mfilter_order( $filterID, $filterOptns );
            abcfsls_mbox_mfilter_labels( $filterOptns );
            abcfsls_mbox_mfilter_layout( $filterOptns );
            abcfsls_mbox_mfilter_shortcode( $filterID, 'MFP-' );
        }

    echo abcfl_html_tag_end( 'div' ); //---Content END
}