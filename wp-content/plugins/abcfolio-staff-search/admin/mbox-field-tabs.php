<?php
function abcfsls_mbox_field_tabs(){

    $optns = abcfsls_mbox_field_tabs_tplate_optns();
    $tplateOptns = $optns['tplateOptns'];

    abcfsls_v_tabs_div_s( '2' ); //---Manager START
        abcfsls_mbox_field_tabs_render_tabs( $tplateOptns );
        abcfsls_mbox_field_tabs_render_cnt( $tplateOptns, $optns['prefix'] );
    echo abcfl_html_tag_end( 'div' ); //---Manager END

    //wp_nonce_field( $slug, $slug . '_nonce' );
}

function abcfsls_mbox_field_tabs_render_tabs( $tplateOptns ){

//echo"<pre>", print_r($tplateOptns), "</pre>";  //die;
    echo abcfl_html_tag( 'ul', '', 'abcflVTabsNavCntr' );
        echo abcfsls_v_tabs_li( 'abcflVTabsTabActive', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F1' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F2' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F3' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F4' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F5' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F6' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F7' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F8' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F9' ) );
        echo abcfsls_v_tabs_li( '', abcfsls_mbox_field_tabs_lbl( $tplateOptns, 'F10' ) );
    echo abcfl_html_tag_end( 'ul' );
}

function abcfsls_mbox_field_tabs_render_cnt( $tplateOptns, $clsPfix ){

    echo abcfl_html_tag( 'div', 'abcfVTabsCntCntr_2', 'abcflVTabsCntCntr' ); //---Content START

    $i = 0;
    for ($i = 1; $i <= 10; ++$i) {
        abcfsls_mbox_tplate_field($tplateOptns, 'F' . $i);
    }

    echo abcfl_html_tag_end( 'div' ); //---Content END
}

function abcfsls_mbox_field_tabs_lbl( $tplateOptns, $F ){

    $lbl = isset( $tplateOptns['_colHdr_' . $F] ) ? esc_attr( $tplateOptns['_colHdr_' . $F][0]  ) : '';
    return $F . '&nbsp;&nbsp;' . $lbl;
}

function abcfsls_mbox_field_tabs_tplate_optns(){

    global $post;
    $postID = $post->ID;
    $tplateOptns = get_post_custom( $postID );

    $obj = ABCFSLS_Main();

    return array(
        'postID' => $post->ID,
        'tplateOptns' => $tplateOptns,
        'pluginSlug' => $obj->pluginSlug,
        'prefix' =>  $obj->prefix
    );
}

