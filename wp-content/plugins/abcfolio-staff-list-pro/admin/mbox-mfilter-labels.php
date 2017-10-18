<?php
function abcfsl_mbox_mfilter_labels( $filterOptns ) {

    echo  abcfl_html_tag('div','','inside hidden');
        abcfsl_mbox_mfilter_labels_labels( $filterOptns );
        abcfsl_mbox_mfilter_labels_hlp_txt( $filterOptns );
    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_mfilter_labels_labels( $filterOptns ) {

    $mfCboLbl1 = isset( $filterOptns['_mfCboLbl1'] ) ? esc_attr( $filterOptns['_mfCboLbl1'][0] ) : '';
    $mfCboLbl2 = isset( $filterOptns['_mfCboLbl2'] ) ? esc_attr( $filterOptns['_mfCboLbl2'][0] ) : '';
    //$mfCboLbl3 = isset( $filterOptns['_mfCboLbl3'] ) ? esc_attr( $filterOptns['_mfCboLbl3'][0] ) : '';
    $mfBtnTxt = isset( $filterOptns['_mfBtnTxt'] ) ? esc_attr( $filterOptns['_mfBtnTxt'][0] ) : '';

    //echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(306), abcfsl_aurl(0) );

    echo abcfl_input_txt('mfCboLbl1', '', $mfCboLbl1, abcfsl_txta(65)  . ' 1', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfCboLbl2', '', $mfCboLbl2, abcfsl_txta(65)  . ' 2', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    //echo abcfl_input_txt('mfCboLbl3', '', $mfCboLbl3, abcfsl_txta(65)  . ' 3', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfBtnTxt', '', $mfBtnTxt, abcfsl_txta(283), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_mbox_mfilter_labels_hlp_txt( $filterOptns ) {

    $mfHelpTxt = isset( $filterOptns['_mfHelpTxt'] ) ? esc_attr( $filterOptns['_mfHelpTxt'][0] ) : '';
    $mfHelpTxtF = isset( $filterOptns['_mfHelpTxtF'] ) ? esc_attr( $filterOptns['_mfHelpTxtF'][0] ) : '';
    $mfHelpTxtMT = isset( $filterOptns['_mfHelpTxtMT'] ) ? esc_attr( $filterOptns['_mfHelpTxtMT'][0] ) : '';
    $mfNoDataMsg = isset( $filterOptns['_mfNoDataMsg'] ) ? esc_attr( $filterOptns['_mfNoDataMsg'][0] ) : '';

    $cboHelpF = abcfsl_cbo_mfilter_help_font_size();
    $cboHelpMT = abcfsl_cbo_mfilter_help_margin_top();

    echo abcfl_input_txt( 'mfNoDataMsg', '', $mfNoDataMsg, abcfsl_txta(168), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(162), abcfsl_aurl(0) );
    echo abcfl_input_txt('mfHelpTxt', '', $mfHelpTxt, abcfsl_txta(162), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('mfHelpTxtF', '', $cboHelpF, $mfHelpTxtF, abcfsl_txta(10), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_cbo_strings('mfHelpTxtMT', '', $cboHelpMT, $mfHelpTxtMT, abcfsl_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}


//Section header
function abcfsl_mbox_mfilter_labels_section_hdr( $iconName, $lblID, $helpID, $hline = true, $hlineH = '2' ){

    $src = ABCFSL_PLUGIN_URL . 'images/' . $iconName;

    if( $hline ){ echo abcfl_input_hline($hlineH); }

    echo abcfl_html_tag_cls(  'div', 'abcflPosRel', false );
    echo abcfl_html_tag( 'div', '', 'abcflFloatL abcflPTop2 abcflLineH1' );
        echo abcfl_html_img_tag('', $src, '', '');
    echo abcfl_html_tag_end('div');

    echo abcfl_html_tag( 'div', '', 'abcflFloatL abcflPLeft20' );
        echo abcfl_input_info_lbl(abcfsl_txta( $lblID ), 'abcflMTop10', 16, 'SB');
        echo abcfl_input_info_lbl(abcfsl_txta($helpID), 'abcflMTop5', 12, 'SB');
    echo abcfl_html_tag_end('div');

    echo abcfl_html_tag_cls(  'div', 'abcflClr', true );
    echo abcfl_html_tag_end('div');
}

