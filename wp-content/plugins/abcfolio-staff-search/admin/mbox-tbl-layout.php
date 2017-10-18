<?php

function abcfsls_mbox_tbl_layout( $tplateOptns ){

//echo"<pre>", print_r($tplateOptns), "</pre>";

    echo  abcfl_html_tag( 'div', '', 'inside' );

    $tblCntrW = isset( $tplateOptns['_tblCntrW'] ) ? esc_attr( $tplateOptns['_tblCntrW'][0] ) : '';
    $tblCntrTM = isset( $tplateOptns['_tblCntrTM'] ) ? esc_attr( $tplateOptns['_tblCntrTM'][0] ) : '';

    $tblBaseStyle = isset( $tplateOptns['_tblBaseStyle'] ) ? $tplateOptns['_tblBaseStyle'][0] : 'N';
    $tblStripe = isset( $tplateOptns['_tblStripe'] ) ? $tplateOptns['_tblStripe'][0] : '0';
    $tblOrderCol = isset( $tplateOptns['_tblOrderCol'] ) ? $tplateOptns['_tblOrderCol'][0] : '0';
    $initOrder = isset( $tplateOptns['_initOrder'] ) ? $tplateOptns['_initOrder'][0] : '0';
    $searchHlight = isset( $tplateOptns['_searchHlight'] ) ? $tplateOptns['_searchHlight'][0] : '0';
    $tblSearching = isset( $tplateOptns['_tblSearching'] ) ? $tplateOptns['_tblSearching'][0] : '0';
    $tblOrdering = isset( $tplateOptns['_tblOrdering'] ) ? $tplateOptns['_tblOrdering'][0] : '0';
    //$hasFooter = isset( $tplateOptns['_hasFooter'] ) ? $tplateOptns['_hasFooter'][0] : '0';
    $tblResponsive = isset( $tplateOptns['_tblResponsive'] ) ? $tplateOptns['_tblResponsive'][0] : '0';
    $tblNoWrap = isset( $tplateOptns['_tblNoWrap'] ) ? $tplateOptns['_tblNoWrap'][0] : '0';
    $tblCustCls = isset( $tplateOptns['_tblCustCls'] ) ? $tplateOptns['_tblCustCls'][0] : '';

    $tblHdrBkgColor = isset( $tplateOptns['_tblHdrBkgColor'] ) ? $tplateOptns['_tblHdrBkgColor'][0] : '';
    $tblHdrFSize = isset( $tplateOptns['_tblHdrFSize'] ) ?  $tplateOptns['_tblHdrFSize'][0] : '';
    $tblHdrFColor = isset( $tplateOptns['_tblHdrFColor'] ) ? $tplateOptns['_tblHdrFColor'][0] : '';
    $txtDir= isset( $tplateOptns['_txtDir'] ) ? $tplateOptns['_txtDir'][0] : 'L';

    $tblBdyFSize = isset( $tplateOptns['_tblBdyFSize'] ) ? $tplateOptns['_tblBdyFSize'][0] : '';
    $tblBdyFColor = isset( $tplateOptns['_tblBdyFColor'] ) ?  $tplateOptns['_tblBdyFColor'][0] : '';

    $cboTblBaseStyle = abcfsls_cbo_base_style();
    $cboTblHdrBkgColor = abcfsls_cbo_tbl_hdr_bkg_color();
    $cboTblHdrFSize = abcfsls_cbo_font_size_tbl_hdr();
    $cboHdrFColor = abcfsls_cbo_font_color_hdr();
    $cboBdyFColor = abcfsls_cbo_font_color_bdy();
    $cboTblFSize = abcfsls_cbo_font_size_tbl();
    $cboTxtDir = abcfsls_cbo_align();
    $cboInitOrder = abcfsls_cbo_init_order();

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(27), abcfsls_aurl(1) );
    echo abcfl_input_cbo_strings('tblBaseStyle', '', $cboTblBaseStyle, $tblBaseStyle, abcfsls_txta(74), abcfsls_txta(75), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('txtDir', '', $cboTxtDir, $txtDir, abcfsls_txta(78), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');


    echo abcfl_input_checkbox('tblSearching',  '', $tblSearching, abcfsls_txta(135), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_checkbox('searchHlight',  '', $searchHlight, abcfsls_txta(81), '', '', '', 'abcflFldCntr', '', '', '' );

    echo abcfl_input_checkbox('tblResponsive',  '', $tblResponsive, abcfsls_txta(99), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_checkbox('tblNoWrap',  '', $tblNoWrap, abcfsls_txta(112), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_checkbox('tblStripe',  '', $tblStripe, abcfsls_txta(76), '', '', '', 'abcflFldCntr', '', '', '' );
    //echo abcfl_input_checkbox('hasFooter',  '', $hasFooter, abcfsls_txta(83), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_txt('tblCustCls' , '', $tblCustCls, abcfsls_txta(53), abcfsls_txta(93), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('2');
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(161), abcfsls_aurl(10) );
    echo abcfl_input_checkbox('tblOrdering',  '', $tblOrdering, abcfsls_txta(136), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_checkbox('tblOrderCol',  '', $tblOrderCol, abcfsls_txta(77), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_cbo_strings('initOrder', '', $cboInitOrder, $initOrder, abcfsls_txta(162), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('2');
    echo abcfl_input_info_lbl( abcfsls_txta(58), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_cbo_strings('tblHdrFSize', '', $cboTblHdrFSize, $tblHdrFSize, abcfsls_txta(10), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('tblHdrFColor', '', $cboHdrFColor, $tblHdrFColor, abcfsls_txta(70), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('tblHdrBkgColor', '', $cboTblHdrBkgColor, $tblHdrBkgColor, abcfsls_txta(69), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('2');
    echo abcfl_input_info_lbl( abcfsls_txta(59), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_cbo_strings('tblBdyFSize', '', $cboTblFSize, $tblBdyFSize, abcfsls_txta(10), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('tblBdyFColor', '', $cboBdyFColor, $tblBdyFColor, abcfsls_txta(70), '', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('2');
    echo abcfl_input_info_lbl( abcfsls_txta(49), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_txt('tblCntrW', '', $tblCntrW,  abcfsls_txta(14), abcfsls_txta(16) . abcfsls_txta(7). ': 100%. ' . abcfsls_txta(110) . abcfsls_txta(109), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('tblCntrTM', '', $tblCntrTM, abcfsls_txta(15), abcfsls_txta(16) .abcfsls_txta(7). ': 0. ' . abcfsls_txta(110) . abcfsls_txta(109), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}

