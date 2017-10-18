<?php
function abcfsls_mbox_mfilter_labels( $filterOptns ) {

    echo  abcfl_html_tag('div','','inside hidden');
        abcfsls_mbox_mfilter_labels_labels( $filterOptns );
        abcfsls_mbox_mfilter_labels_hlp_txt( $filterOptns );
    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_labels_labels( $filterOptns ) {

    $mfLbl1 = isset( $filterOptns['_mfLbl1'] ) ? esc_attr( $filterOptns['_mfLbl1'][0] ) : '';
    $mfLbl2 = isset( $filterOptns['_mfLbl2'] ) ? esc_attr( $filterOptns['_mfLbl2'][0] ) : '';
    $mfLbl3 = isset( $filterOptns['_mfLbl3'] ) ? esc_attr( $filterOptns['_mfLbl3'][0] ) : '';
    $mfLbl4 = isset( $filterOptns['_mfLbl4'] ) ? esc_attr( $filterOptns['_mfLbl4'][0] ) : '';
    $mfLbl5 = isset( $filterOptns['_mfLbl5'] ) ? esc_attr( $filterOptns['_mfLbl5'][0] ) : '';
    $mfLbl6 = isset( $filterOptns['_mfLbl6'] ) ? esc_attr( $filterOptns['_mfLbl6'][0] ) : '';

    $mfSBtnTxt = isset( $filterOptns['_mfSBtnTxt'] ) ? esc_attr( $filterOptns['_mfSBtnTxt'][0] ) : '';
    $mfRBtnTxt = isset( $filterOptns['_mfRBtnTxt'] ) ? esc_attr( $filterOptns['_mfRBtnTxt'][0] ) : '';


    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(306), abcfsls_aurl(0) );

    echo abcfl_input_txt('mfLbl1', '', $mfLbl1,  abcfsls_txta(151)  . ' 1', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfLbl2', '', $mfLbl2,  abcfsls_txta(151)  . ' 2', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfLbl3', '', $mfLbl3,  abcfsls_txta(151)  . ' 3', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfLbl4', '', $mfLbl4,  abcfsls_txta(151)  . ' 4', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfLbl5', '', $mfLbl5,  abcfsls_txta(151)  . ' 5', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfLbl6', '', $mfLbl6,  abcfsls_txta(151)  . ' 6', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_hline('1');
    echo abcfl_input_txt('mfSBtnTxt', '', $mfSBtnTxt, abcfsls_txta(141), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('mfRBtnTxt', '', $mfRBtnTxt, abcfsls_txta(142), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsls_mbox_mfilter_labels_hlp_txt( $filterOptns ) {

    $mfHelpTxt = isset( $filterOptns['_mfHelpTxt'] ) ? esc_attr( $filterOptns['_mfHelpTxt'][0] ) : '';
    $mfHelpTxtF = isset( $filterOptns['_mfHelpTxtF'] ) ? esc_attr( $filterOptns['_mfHelpTxtF'][0] ) : '';
    $mfHelpTxtMT = isset( $filterOptns['_mfHelpTxtMT'] ) ? esc_attr( $filterOptns['_mfHelpTxtMT'][0] ) : '';
    $mfNoDataMsg = isset( $filterOptns['_mfNoDataMsg'] ) ? esc_attr( $filterOptns['_mfNoDataMsg'][0] ) : '';

    $cboHelpF = abcfsl_cbo_mfilter_help_font_size();
    $cboHelpMT = abcfsl_cbo_mfilter_help_margin_top();

    echo abcfl_input_txt( 'mfNoDataMsg', '', $mfNoDataMsg, abcfsl_txta(168), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(162), abcfsls_aurl(0) );
    echo abcfl_input_txt('mfHelpTxt', '', $mfHelpTxt, abcfsl_txta(162), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('mfHelpTxtF', '', $cboHelpF, $mfHelpTxtF, abcfsls_txta(10), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_cbo_strings('mfHelpTxtMT', '', $cboHelpMT, $mfHelpTxtMT, abcfsls_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}


//Section header
function abcfsls_mbox_mfilter_labels_section_hdr( $iconName, $lblID, $helpID, $hline = true, $hlineH = '2' ){

    $src = ABCFSLS_PLUGIN_URL . 'images/' . $iconName;

    if( $hline ){ echo abcfl_input_hline($hlineH); }

    echo abcfl_html_tag_cls(  'div', 'abcflPosRel', false );
    echo abcfl_html_tag( 'div', '', 'abcflFloatL abcflPTop2 abcflLineH1' );
        echo abcfl_html_img_tag('', $src, '', '');
    echo abcfl_html_tag_end('div');

    echo abcfl_html_tag( 'div', '', 'abcflFloatL abcflPLeft20' );
        echo abcfl_input_info_lbl(abcfsls_txta( $lblID ), 'abcflMTop10', 16, 'SB');
        echo abcfl_input_info_lbl(abcfsls_txta($helpID), 'abcflMTop5', 12, 'SB');
    echo abcfl_html_tag_end('div');

    echo abcfl_html_tag_cls(  'div', 'abcflClr', true );
    echo abcfl_html_tag_end('div');
}

