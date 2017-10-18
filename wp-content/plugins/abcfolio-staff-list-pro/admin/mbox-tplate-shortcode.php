<?php
function abcfsl_mbox_tplate_shortcode( $tplateOptns ) {

    //$sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';

    echo  abcfl_html_tag('div','','inside  hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

        abcfsl_mbox_tplate_field_section_hdr( 54, 170, false);

        $scodes = abcfsl_scode_build_scode();

        echo abcfl_input_txt_readonly('scodeL', '', $scodes['scodeL'], abcfsl_txta(68),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');
        echo abcfl_input_txt_readonly('scodeLC', '', $scodes['scodeLC'], abcfsl_txta(87),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');
        echo abcfl_input_txt_readonly('scodeLR', '', $scodes['scodeLR'], abcfsl_txta(138),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');

        //======================================================
        echo abcfl_input_hline('2', '30');
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(242), abcfsl_aurl(54), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop20');

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(87), abcfsl_aurl(55), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop20');
        echo abcfl_input_info_lbl(abcfsl_txta(135), 'abcflMTop5', 12);

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(187), abcfsl_aurl(56), 'abcflFontWP abcflFontS18 abcflFontW600 abcflMTop20');


        //echo abcfl_input_info_lbl(abcfsl_txta(242), 'abcflMTop40', 20, 'SB');
        //echo abcfl_input_hline('2');
        //-------------------------------
        //echo abcfsl_mbox_tplate_shortcode_staff_pg_help();

        //echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(12), 'abcflFontFVS13 abcflFontW400 abcflMTop05' );
        //echo abcfl_input_txt('sPageUrl', '', $sPageUrl, abcfsl_txta(271), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        //-------------------------------
        //echo abcfl_input_hline('1', '20');
        //echo abcfsl_mbox_tplate_shortcode_staff_pg_cat_help();

    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_tplate_shortcode_staff_pg_help() {

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

function abcfsl_mbox_tplate_shortcode_staff_pg_cat_help() {

    $out = abcfl_input_info_lbl(abcfsl_txta(87), 'abcflMTop20', 20, 'SB');
    $out .= abcfl_input_info_lbl(abcfsl_txta(135), 'abcflMTop5', 12);

    $out .= abcfl_html_tag( 'ol', '', 'abcflFontS12 abcflFontFV' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(272), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(234), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(136), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(274), 'li', '' );
    $out .= abcfl_html_tag_with_content( abcfsl_txta(275), 'li', '' );
    $out .= abcfl_html_tag_end( 'ol' );

    $out .= abcfl_input_div_lbl(abcfsl_txta(328), 'abcflMTop15', 12, '', 'V');

    return $out;
}


