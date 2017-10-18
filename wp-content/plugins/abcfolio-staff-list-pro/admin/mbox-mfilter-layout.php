<?php
function abcfsl_mbox_mfilter_layout( $filterOptns ) {

    echo  abcfl_html_tag('div','','inside hidden');
        abcfsl_mbox_mfilter_layout_filters_cntr( $filterOptns);
        abcfsl_mbox_mfilter_layout_filter_item( $filterOptns );
    echo abcfl_html_tag_end('div');
}

//Items container
function abcfsl_mbox_mfilter_layout_filters_cntr( $filterOptns ){

    //echo abcfl_input_hline('2');

    //$fCntrW = isset( $filterOptns['_fCntrW'] ) ? esc_attr( $filterOptns['_fCntrW'][0] ) : '';
    $mfCntrJustify = isset( $filterOptns['_mfCntrJustify'] ) ? esc_attr( $filterOptns['_mfCntrJustify'][0] ) : 'E';
    $mfCntrMT = isset( $filterOptns['_mfCntrMT'] ) ? esc_attr( $filterOptns['_mfCntrMT'][0] ) : '';
    $mfCntrMB = isset( $filterOptns['_mfCntrMB'] ) ? esc_attr( $filterOptns['_mfCntrMB'][0] ) : '';

    $cboJustify = abcfsl_cbo_pagination_justify();

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(277), abcfsl_aurl(0) );
    echo abcfl_input_cbo('mfCntrJustify', '',$cboJustify, $mfCntrJustify,  abcfsl_txta(163), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfsl_mbox_mfilter_layout_margin_t( 'mfCntrMT', $mfCntrMT, 0, 15 );
    echo abcfsl_mbox_mfilter_layout_margin_t( 'mfCntrMB', $mfCntrMB, 0, 89 );
}

//Filter item
function abcfsl_mbox_mfilter_layout_filter_item( $filterOptns ){

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(316), abcfsl_aurl(0) );

    $mfCboSize = isset( $filterOptns['_mfCboSize'] ) ? $filterOptns['_mfCboSize'][0] : '';
    $mfBtnColor = isset( $filterOptns['_mfBtnColor'] ) ? $filterOptns['_mfBtnColor'][0] : '';

    $cboSize = abcfsl_cbo_mfilter_cbo_size();
    $cboBtnColor = abcfsl_cbo_mfilter_buttons();

    echo abcfl_input_cbo_strings( 'mfCboSize', '', $cboSize, $mfCboSize, abcfsl_txta(132), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'mfBtnColor', '', $cboBtnColor, $mfBtnColor, abcfsl_txta(338), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    // ACTION -----------------------------------------------
    abcfsl_mbox_mfilter_layout_frm_action( $filterOptns );
}

//Top margin.
function abcfsl_mbox_mfilter_layout_margin_t( $fieldName, $fielValue, $help=0, $lbl=15 ){

    $cboMarginTop = abcfsl_cbo_margin_t_b( false );
    echo abcfl_input_cbo_strings( $fieldName, '', $cboMarginTop, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Section header
function abcfsl_mbox_mfilter_layout_section_hdr( $iconName, $lblID, $helpID, $hline = true, $hlineH = '2' ){

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

// ACTION
function abcfsl_mbox_mfilter_layout_frm_action( $filterOptns ){

    $mfFrmAction = isset( $filterOptns['_mfFrmAction'] ) ? esc_attr( $filterOptns['_mfFrmAction'][0] ) : '';

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(193), abcfsl_aurl(62) );
    echo abcfl_input_txt('mfFrmAction', '', $mfFrmAction,  abcfsl_txta(0, 'URL'), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

