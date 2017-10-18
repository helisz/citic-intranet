<?php

function abcfsls_mbox_tbl_print( $tplateOptns ){

    echo  abcfl_html_tag( 'div', '', 'inside hidden' );

    $btnPrint = isset( $tplateOptns['_btnPrint'] ) ? $tplateOptns['_btnPrint'][0] : '0';
    $printAuto = isset( $tplateOptns['_printAuto'] ) ? $tplateOptns['_printAuto'][0] : '0';
    $printFS = isset( $tplateOptns['_printFS'] ) ? $tplateOptns['_printFS'][0] : '12';

    $btnPdf = isset( $tplateOptns['_btnPdf'] ) ? $tplateOptns['_btnPdf'][0] : '0';
    $pdfOrient = isset( $tplateOptns['_pdfOrient'] ) ? $tplateOptns['_pdfOrient'][0] : 'landscape';
    $pdfFS = isset( $tplateOptns['_pdfFS'] ) ? $tplateOptns['_pdfFS'][0] : '10';
    $pdfPgSize = isset( $tplateOptns['_pdfPgSize'] ) ? $tplateOptns['_pdfPgSize'][0] : 'LETTER';
    $pdfPgMargin = isset( $tplateOptns['_pdfPgMargin'] ) ? $tplateOptns['_pdfPgMargin'][0] : '40';

    $btnExcel = isset( $tplateOptns['_btnExcel'] ) ? $tplateOptns['_btnExcel'][0] : '0';
    $btnCsv = isset( $tplateOptns['_btnCsv'] ) ? $tplateOptns['_btnCsv'][0] : '0';
//-------------------------------------------------------------------------
    $cboPrintFS = abcfsls_dba_cbo_print_fs();
    $cboPDFPgSize = abcfsls_cbo_pdf_pg_size();
    $cboOrient = abcfsls_cbo_pdf_orientation();
    $cboPrintFS = abcfsls_dba_cbo_print_fs();
    $cboPDFPgMargin = abcfsls_dba_cbo_pfd_pg_margin();

    //echo abcfl_input_info_lbl( abcfsls_txta(123), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(123), abcfsls_aurl(3) );
    echo abcfl_input_checkbox('btnPrint',  '', $btnPrint, abcfsls_txta(125), '', '', '', 'abcflFldCntr', '', '', 'abcflFontS16 abcflFontW600' );
    echo abcfl_input_checkbox('printAuto',  '', $printAuto, abcfsls_txta(131), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_cbo('printFS', '', $cboPrintFS, $printFS, abcfsls_txta(10), '', '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('1');
    echo abcfl_input_checkbox('btnPdf',  '', $btnPdf, 'PDF', '', '', '', 'abcflFldCntr', '', '', 'abcflFontS16 abcflFontW600' );
    echo abcfl_input_cbo('pdfPgSize', '', $cboPDFPgSize, $pdfPgSize, abcfsls_txta(133), '', '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('pdfOrient', '', $cboOrient, $pdfOrient, abcfsls_txta(132), '', '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('pdfPgMargin', '', $cboPDFPgMargin, $pdfPgMargin, abcfsls_txta(134), abcfsls_txta(7) . ': 40.', '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('pdfFS', '', $cboPrintFS, $pdfFS, abcfsls_txta(10), abcfsls_txta(7) . ': 10px.', '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_input_hline('1');
    echo abcfl_input_checkbox('btnExcel',  '', $btnExcel, 'Excel', '', '', '', 'abcflFldCntr', 'abcflFontS16', '', 'abcflFontS16 abcflFontW600' );
    echo abcfl_input_checkbox('btnCsv',  '', $btnCsv, 'CSV', '', '', '', 'abcflFldCntr', '', '', 'abcflFontS16 abcflFontW600' );

    echo abcfl_html_tag_end('div');
}

