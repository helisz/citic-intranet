<?php
function abcfsl_mbox_tplate_shortcode( $tplateOptns ) {

    $sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';

    echo  abcfl_html_tag('div','','inside  hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

        $scodes = abcfsl_scode_build_scode();
        echo abcfl_input_txt_readonly('scodeL', '', $scodes['scodeL'], abcfsl_txta(68), '', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');
        echo abcfl_input_txt_readonly('scodeLR', '', $scodes['scodeLR'], abcfsl_txta(138),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');

        echo abcfl_input_info_lbl(abcfsl_txta(242), 'abcflMTop40', 20, 'SB');
        echo abcfl_input_hline('2');
        //-------------------------------
        echo abcfsl_mbox_list_shortcode_staff_pg_help();
        echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(12), 'abcflFontFVS13 abcflFontW400 abcflMTop05' );

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_list_shortcode_staff_pg_help() {

    $out = abcfl_input_info_lbl(abcfsl_txta(68), 'abcflMTop20', 20, 'SB');
    $out .= abcfl_input_info_lbl(abcfsl_txta(305), 'abcflMTop5', 12);

    $out .= abcfl_html_tag( 'ol', '', 'abcflFontS12 abcflFontFV' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(272), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(304), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(274), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(275), 'li', '' );
    $out .= abcfl_html_tag_end( 'ol' );

    return $out;
}




