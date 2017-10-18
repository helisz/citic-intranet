<?php

function abcfsls_mbox_tbl_shortcode( $tplateOptns, $tbl ){

    echo  abcfl_html_tag('div', '', 'inside hidden' );

    echo abcfl_input_info_lbl(abcfsls_txta(3), 'abcflMTop5', 20, 'SB');

    switch ($tbl){
        case 'A':
            $scode = abcfsls_scode_build_scode_tbl_a();
            echo abcfsls_mbox_tbl_shortcode_input( $scode );
            break;
        case 'C':
            $scode = abcfsls_scode_build_scode_tbl_c();
            echo abcfsls_mbox_tbl_shortcode_input( $scode );
       default:
            break;
    }

    //echo abcfl_input_info_lbl(abcfsls_txta(60), 'abcflMTop40', 20, 'SB');
    echo abcfl_input_hline('2');
    //-------------------------------

    echo abcfsls_mbox_tbl_shortcode_help();

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_tbl_shortcode_input( $scode ) {

return abcfl_input_txt_readonly('scode', '', $scode, abcfsls_txta(0),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');

}

function abcfsls_mbox_tbl_shortcode_help() {

    $out = abcfl_input_info_lbl(abcfsls_txta(60), 'abcflMTop20', 20, 'SB');
    //$out .= abcfl_input_info_lbl(abcfsls_txta(305), 'abcflMTop5', 12);

    $out .= abcfl_html_tag( 'ol', '', 'abcflFontS12 abcflFontFV' );
    $out .= abcfl_html_tag_with_content( abcfsls_txta(61), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsls_txta(62), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsls_txta(63), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsls_txta(64), 'li', '' );
    $out .= abcfl_html_tag_end( 'ol' );

    return $out;
}

