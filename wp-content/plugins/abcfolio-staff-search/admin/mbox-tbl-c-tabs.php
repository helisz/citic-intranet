<?php

function abcfsls_mbox_tbl_c_tabs(){

    $obj = ABCFSLS_Main();
    $slug = $obj->pluginSlug;
    $clsPfix = $obj->prefix;

    abcfsls_v_tabs_div_s( '1' ); //---Manager START
        abcfsls_mbox_tbl_c_nav_tabs();
        bcfsls_mbox_tbl_c_tabs_cnt( $clsPfix );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsls_mbox_tbl_c_nav_tabs(){

    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsls_v_tabs_li('abcflVTabsTabActive', abcfsls_txta(13));
        echo abcfsls_v_tabs_li('', abcfsls_txta(88));
        echo abcfsls_v_tabs_li( '', abcfsls_txta(84));
        echo abcfsls_v_tabs_li('', abcfsls_txta(123));
        echo abcfsls_v_tabs_li('', abcfsls_txta(9));
        echo abcfsls_v_tabs_li( '', abcfsls_txta(38) );
        echo abcfsls_v_tabs_li( '', abcfsls_txta(3) );
    echo abcfl_html_tag_end( 'ul' );

}

function bcfsls_mbox_tbl_c_tabs_cnt( $clsPfix ){

    global $post;
    $tplateID = $post->ID;
    $tplateOptns = get_post_custom( $tplateID );

//echo"<pre>", print_r($_POST), "</pre>";  die;

    echo abcfl_html_tag( 'div', 'abcfVTabsCntCntr_1', 'abcflVTabsCntCntr' ); //---Content START

    abcfsls_mbox_tbl_layout($tplateOptns);
    abcfsls_mbox_tbl_lbls($tplateOptns);
    abcfsls_mbox_tbl_paging($tplateOptns);
    abcfsls_mbox_tbl_print($tplateOptns);
    abcfsls_mbox_tbl_data( $tplateOptns, 'C' );
    mbox_col_order( $tplateID, $tplateOptns );
    abcfsls_mbox_tbl_shortcode( $tplateOptns, 'C' );

    echo abcfl_html_tag_end( 'div' ); //---Content END

}
