<?php
//-- TABS ----------------------------------------
function abcfsls_v_tabs_div_s( $mgrID ){
    //---Manager START
    echo abcfl_html_tag( 'div', 'abcfVTabsMgr_' . $mgrID, 'abcflVTabsMgr' );
}

function abcfsls_v_tabs_li( $cls, $lbl1, $lbl2='', $url='#'){

    $lbl1 = abcfl_html_tag_with_content( $lbl1, 'span', '');
    $lbl2 = abcfl_html_tag_with_content( $lbl2, 'span', '');
    $lbl = trim( $lbl1 . ' ' . $lbl2 );

    $out = abcfl_html_tag( 'li', '', $cls );
        $out .= abcfl_html_a_tag( $url, $lbl, '', '' );
    $out .= abcfl_html_tag_end( 'li' );

    return $out;
}
