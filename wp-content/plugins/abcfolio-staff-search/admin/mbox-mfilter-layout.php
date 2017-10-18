<?php
function abcfsls_mbox_mfilter_layout( $filterOptns ) {

    echo  abcfl_html_tag('div','','inside hidden');
        abcfsls_mbox_mfilter_layout_filters_cntr( $filterOptns);
        abcfsls_mbox_mfilter_layout_controls( $filterOptns );
    echo abcfl_html_tag_end('div');
}

//Items container
function abcfsls_mbox_mfilter_layout_filters_cntr( $filterOptns ){

    //echo abcfl_input_hline('2');

    //$fCntrW = isset( $filterOptns['_fCntrW'] ) ? esc_attr( $filterOptns['_fCntrW'][0] ) : '';
    $mfCntrJustify = isset( $filterOptns['_mfCntrJustify'] ) ? esc_attr( $filterOptns['_mfCntrJustify'][0] ) : 'E';
    $mfCntrMT = isset( $filterOptns['_mfCntrMT'] ) ? esc_attr( $filterOptns['_mfCntrMT'][0] ) : '';
    $mfCntrMB = isset( $filterOptns['_mfCntrMB'] ) ? esc_attr( $filterOptns['_mfCntrMB'][0] ) : '';
    $mfCntrCustCls = isset( $filterOptns['_mfCntrCustCls'] ) ? esc_attr( $filterOptns['_mfCntrCustCls'][0] ) : '';
    $mfCntrCustStyle = isset( $filterOptns['_mfCntrCusStyle'] ) ? esc_attr( $filterOptns['_mfCntrCusStyle'][0] ) : '';

    $cboJustify = abcfsl_cbo_pagination_justify();

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(277), abcfsls_aurl(0) );
    echo abcfl_input_cbo('mfCntrJustify', '',$cboJustify, $mfCntrJustify,  abcfsl_txta(163), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfsls_mbox_mfilter_layout_margin_t( 'mfCntrMT', $mfCntrMT, 0, 15 );
    echo abcfsls_mbox_mfilter_layout_margin_t( 'mfCntrMB', $mfCntrMB, 0, 89 );
    //-----------------------------------------------
    abcfsls_autil_cls_style( 'mfCntrCustCls', $mfCntrCustCls, 'mfCntrCusStyle', $mfCntrCustStyle, '', true, '2' );
}

//Filter item
function abcfsls_mbox_mfilter_layout_controls( $filterOptns ){

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(316), abcfsls_aurl(0) );

    $mfCboSize = isset( $filterOptns['_mfCboSize'] ) ? $filterOptns['_mfCboSize'][0] : '';
    $mfSBtnColor = isset( $filterOptns['_mfSBtnColor'] ) ? $filterOptns['_mfSBtnColor'][0] : '';
    $mfRBtnColor = isset( $filterOptns['_mfRBtnColor'] ) ? $filterOptns['_mfRBtnColor'][0] : '';

    $mfFrmGroupCustCls = isset( $filterOptns['_mfFrmGroupCustCls'] ) ? esc_attr( $filterOptns['_mfFrmGroupCustCls'][0] ) : '';
    $mfFrmGroupStyle = isset( $filterOptns['_mfFrmGroupStyle'] ) ? esc_attr( $filterOptns['_mfCntrCusStyle'][0] ) : '';

    $cboSize = abcfsl_cbo_mfilter_cbo_size();
    $cboBtnColor = abcfsl_cbo_mfilter_buttons();

    echo abcfl_input_cbo_strings( 'mfCboSize', '', $cboSize, $mfCboSize, abcfsl_txta(132), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'mfSBtnColor', '', $cboBtnColor, $mfSBtnColor, abcfsls_txta(141) . ' - ' . abcfsls_txta(140), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'mfRBtnColor', '', $cboBtnColor, $mfRBtnColor,  abcfsls_txta(142) . ' - ' . abcfsls_txta(140), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

     //-----------------------------------------------
    abcfsls_autil_cls_style( 'mfFrmGroupCustCls', $mfFrmGroupCustCls, 'mfFrmGroupStyle', $mfFrmGroupStyle, '', true, '2' );

    // ACTION -----------------------------------------------
    abcfsls_mbox_mfilter_layout_frm_action( $filterOptns );
}

//Top margin.
function abcfsls_mbox_mfilter_layout_margin_t( $fieldName, $fielValue, $help=0, $lbl=15 ){

    $cboMarginTop = abcfsl_cbo_margin_t_b( false );
    echo abcfl_input_cbo_strings( $fieldName, '', $cboMarginTop, $fielValue, abcfsl_txta( $lbl ), abcfsl_txta( $help ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//Section header
function abcfsls_mbox_mfilter_layout_section_hdr( $iconName, $lblID, $helpID, $hline = true, $hlineH = '2' ){

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

function abcfsls_mbox_mfilter_layout_filters_cntr_css( $filterOptns ){


    $mfCntrCustCls = isset( $filterOptns['_mfCntrCustCls'] ) ? esc_attr( $filterOptns['_mfCntrCustCls'][0] ) : '';
    $mfCntrCustStyle = isset( $filterOptns['_mfCntrCusStyle'] ) ? esc_attr( $filterOptns['_mfCntrCusStyle'][0] ) : '';

    //echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(277), abcfsls_aurl(0) );
    abcfsls_autil_cls_style( 'mfCntrCustCls', $mfCntrCustCls, 'mfCntrCusStyle', $mfCntrCustStyle, '', true, '2' );
}

// ACTION
function abcfsls_mbox_mfilter_layout_frm_action( $filterOptns ){

    $mfFrmAction = isset( $filterOptns['_mfFrmAction'] ) ? esc_attr( $filterOptns['_mfFrmAction'][0] ) : '';

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(160), abcfsls_aurl(9) );
    echo abcfl_input_txt('mfFrmAction', '', $mfFrmAction,  abcfsls_txta(0, 'URL'), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}


