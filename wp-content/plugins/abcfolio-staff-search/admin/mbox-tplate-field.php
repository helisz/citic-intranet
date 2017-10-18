<?php
//Field options for a single field (F)
function abcfsls_mbox_tplate_field( $tplateOptns, $F ){

//echo"<pre>", print_r($tplateOptns), "</pre>";

    if( $F == 'F1' ) {echo  abcfl_html_tag('div','','inside');}
    else {echo  abcfl_html_tag('div','','inside hidden');}

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) : 'N';
    $fieldTypeH = isset( $tplateOptns['_fieldTypeH_' . $F] ) ? esc_attr( $tplateOptns['_fieldTypeH_' . $F][0] ) : 'N';

    //== Field type not selected. Display only Add New Field cbo ==================
    if($fieldType == 'N'){
        abcfsls_mbox_tplate_field_add_field_cbo( $fieldType, $F );
        echo abcfl_html_tag_end('div');
        return;
    }
    //==========================================================
    $staffTplateID = isset( $tplateOptns['_staffTplateID'] ) ?  $tplateOptns['_staffTplateID'][0] : '0';
    $hideDelete = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
    $fieldLocked = isset( $tplateOptns['_fieldLocked_' . $F] ) ? esc_attr( $tplateOptns['_fieldLocked_' . $F][0] ) : '0';
    $colHdr = isset( $tplateOptns['_colHdr_' . $F] ) ? esc_attr( $tplateOptns['_colHdr_' . $F][0] ) : '';
    $staffF = isset( $tplateOptns['_staffF_' . $F] ) ? $tplateOptns['_staffF_' . $F][0] : 'F0';

    $linkToSingle = isset( $tplateOptns['_linkToSingle_' . $F] ) ? $tplateOptns['_linkToSingle_' . $F][0] : '0';
    $newTab = isset( $tplateOptns['_newTab_' . $F] ) ?  $tplateOptns['_newTab_' . $F][0] : '0';
    $showLbl = isset( $tplateOptns['_showLbl_' . $F] ) ? $tplateOptns['_showLbl_' . $F][0] : '0';
    $noSearch = isset( $tplateOptns['_noSearch_' . $F] ) ? $tplateOptns['_noSearch_' . $F][0] : '0';
    $noPrint = isset( $tplateOptns['_noPrint_' . $F] ) ? $tplateOptns['_noPrint_' . $F][0] : '0';

    $tagCls = isset( $tplateOptns['_cellCls_' . $F] ) ? esc_attr( $tplateOptns['_cellCls_' . $F][0] ) : '';
    $tagStyle = isset( $tplateOptns['_cellStyle_' . $F] ) ? esc_attr( $tplateOptns['_cellStyle_' . $F][0] ) : '';

    $staffTplateOptns = get_post_custom($staffTplateID);

    //== Render mbox fields ============================================
    //Field name & hidden Field Type
    abcfsls_mbox_tplate_field_number_and_datatype( $fieldTypeH, $F );
    abcfsls_mbox_tplate_field_lock( $fieldLocked, $F );
    //---------------------------------------------------------------
    //Field type (hidden value).
    switch ( $fieldTypeH ){
        case 'T':
            abcfsls_mbox_tplate_field_section_hdr( 0, 126 );
            abcfsls_mbox_tplate_field_col_header( $colHdr, $F );
            abcfsls_mbox_tplate_field_staff_field( $staffTplateID, $staffTplateOptns, $staffF, $F );
            abcfsls_mbox_tplate_field_link_to_single( $linkToSingle, $F );
            abcfsls_mbox_tplate_field_no_search( $noSearch, $F );
            abcfsls_mbox_tplate_field_no_print( $noPrint, $F );
            abcfsls_mbox_tplate_field_hide_delete( $hideDelete, $F );
            //----------------------------------
            //abcfsls_autil_class_and_style( $tagCls, $tagStyle, $F, 53, 54, 'tagCls_', 'tagStyle_', true, true );
            abcfsls_autil_cls_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, true, '2' );
            break;
        case 'H':
            abcfsls_mbox_tplate_field_section_hdr( 0, 126 );
            abcfsls_mbox_tplate_field_col_header( $colHdr, $F );
            abcfsls_mbox_tplate_field_staff_field( $staffTplateID, $staffTplateOptns, $staffF, $F );
            abcfsls_mbox_tplate_field_show_lbl( $showLbl, $F, 128 );
            abcfsls_mbox_tplate_field_open_in_new_tab( $newTab, $F );
            abcfsls_mbox_tplate_field_no_search( $noSearch, $F );
            abcfsls_mbox_tplate_field_no_print( $noPrint, $F );
            abcfsls_mbox_tplate_field_hide_delete( $hideDelete, $F );
            //----------------------------------
            //abcfsls_autil_class_and_style( $tagCls, $tagStyle, $F, 53, 54, 'tagCls_', 'tagStyle_', true, true );
            abcfsls_autil_cls_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, true, '2' );
            break;
        case 'EM':
            abcfsls_mbox_tplate_field_section_hdr( 0, 126 );
            abcfsls_mbox_tplate_field_col_header( $colHdr, $F );
            abcfsls_mbox_tplate_field_staff_field( $staffTplateID, $staffTplateOptns, $staffF, $F );
            abcfsls_mbox_tplate_field_show_lbl( $showLbl, $F, 137 );
            abcfsls_mbox_tplate_field_no_search( $noSearch, $F );
            abcfsls_mbox_tplate_field_no_print( $noPrint, $F );
            abcfsls_mbox_tplate_field_hide_delete( $hideDelete, $F );
            //----------------------------------
            //abcfsls_autil_class_and_style( $tagCls, $tagStyle, $F, 53, 54, 'tagCls_', 'tagStyle_', true, true );
            abcfsls_autil_cls_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, true, '2' );
            break;
        case 'MP':
            abcfsls_mbox_tplate_field_section_hdr( 0, 126 );
            abcfsls_mbox_tplate_field_col_header( $colHdr, $F );
            abcfsls_mbox_tplate_field_staff_field( $staffTplateID, $staffTplateOptns, $staffF, $F );
            abcfsls_mbox_tplate_field_link_to_single( $linkToSingle, $F );
            abcfsls_mbox_tplate_field_no_search( $noSearch, $F );
            abcfsls_mbox_tplate_field_no_print( $noPrint, $F );
            abcfsls_mbox_tplate_field_hide_delete( $hideDelete, $F );
            //------------------------------------------------
            abcfsls_mbox_tplate_field_parts_MP( $tplateOptns, $F, $staffTplateOptns, $staffF );
            abcfsls_mbox_tplate_field_parts_MP_sort( $tplateOptns, $F, $staffTplateOptns, $staffF );
            //----------------------------------
            //abcfsls_autil_class_and_style( $tagCls, $tagStyle, $F, 53, 54, 'tagCls_', 'tagStyle_', true, true );
            abcfsls_autil_cls_style( 'tagCls_', $tagCls, 'tagStyle_', $tagStyle, $F, true, '2' );
            break;
       default:
            break;
    }
echo abcfl_html_tag_end('div');
}

//== SECTION HEADERS =========================================================


//Field number and datatype
function abcfsls_mbox_tplate_field_number_and_datatype( $fieldTypeH, $F ){

    $cboLineType = abcfsls_cbo_field_type();
    $fieldType = $cboLineType[$fieldTypeH];

    //echo abcfl_input_info_lbl( $F. '.&nbsp;&nbsp;' . $fieldType, 'abcflBlue abcflMTop10', '20', 'SB' );
    echo abcfl_html_tag_cls( 'div', 'abcflFontWPSB abcflFontS20 abcflBlue abcflMTop10' ) . $F. '.&nbsp;&nbsp;' . $fieldType . abcfl_html_tag_end('div');
    echo abcfl_input_hidden( '', 'fieldTypeH_' . $F, $fieldTypeH );
}

//Section header + optional help link (?)
function abcfsls_mbox_tplate_field_section_hdr( $aurl, $txta, $hline=true){
    if( $hline ) { echo abcfl_input_hline('2', '20'); }
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta($txta), abcfsls_aurl($aurl) );
}
//==============================================================================

//== FIELDS ====================================================================
function abcfsls_mbox_tplate_field_lock( $fieldLocked, $F ){

    $clsBoxlbl = '';
    $boxLbl = abcfsls_txta(296);
    if($fieldLocked == '1'){
        $clsBoxlbl = 'abcflBBRed';
        $boxLbl = abcfsls_txta(297);
    }
    echo abcfl_input_checkbox('lineLocked_'. $F,  '', $fieldLocked, $boxLbl, '', '', '', 'abcflFldCntr', '', '', $clsBoxlbl );
}

function abcfsls_mbox_tplate_field_show_lbl( $showLbl, $F, $lblID ){
    echo abcfl_input_checkbox('showLbl_'. $F,  '', $showLbl, abcfsls_txta( $lblID ), '', '', '', 'abcflFldCntr', '', '', '' );
}


function abcfsls_mbox_tplate_field_open_in_new_tab( $newTab, $F ){
    echo abcfl_input_checkbox('newTab_'. $F,  '', $newTab, abcfsls_txta(113), '', '', '', 'abcflFldCntr', '', '', '' );
}

function abcfsls_mbox_tplate_field_link_to_single( $linkToSingle, $F ){
    echo abcfl_input_checkbox('linkToSingle_'. $F,  '', $linkToSingle, abcfsls_txta(87), '', '', '', 'abcflFldCntr', '', '', '' );
}

//Column Title
function abcfsls_mbox_tplate_field_col_header( $colHdr, $F ){
    echo abcfl_input_txt('colHdr_'. $F, '', $colHdr, abcfsls_txta_r(32), abcfsls_txta(121), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsls_mbox_tplate_field_no_search( $noSearch, $F ){
    echo abcfl_input_checkbox('noSearch_'. $F,  '', $noSearch, abcfsls_txta(119), '', '', '', 'abcflFldCntr', '', '', '' );
}

function abcfsls_mbox_tplate_field_no_print( $noPrint, $F ){
    echo abcfl_input_checkbox('noPrint_'. $F,  '', $noPrint, abcfsls_txta(138), '', '', '', 'abcflFldCntr', '', '', '' );
}

//Staff field cbo: F1, F2....
function abcfsls_mbox_tplate_field_staff_field( $staffTplateID, $staffTplateOptns, $fielValue, $F ){

    $cbo =  abcfsls_staff_fields_cbo($staffTplateID, $staffTplateOptns);
    echo abcfl_input_cbo_strings('staffF_' . $F, '', $cbo, $fielValue, abcfsls_txta_r(40), abcfsls_txta(97), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//=====================================================================
//Add new field
function abcfsls_mbox_tplate_field_add_field_cbo( $fieldType, $F ){
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(42), abcfsls_aurl(0) );
    $cboLineType = abcfsls_cbo_field_type();
    echo abcfl_input_cbo('fieldType_' . $F, '',$cboLineType, $fieldType, abcfsls_txta_r(42), abcfsls_txta(111), '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//==MP START ===================================================
function abcfsls_mbox_tplate_field_parts_MP( $tplateOptns, $F, $staffTplateOptns, $staffF ){

    //$staffTplateOptns = get_post_custom( $staffTplateID );

    $inputLblP1 = isset( $staffTplateOptns['_inputLblP1_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP1_' . $staffF][0] ) : '';
    $inputLblP2 = isset( $staffTplateOptns['_inputLblP2_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP2_' . $staffF][0] ) : '';
    $inputLblP3 = isset( $staffTplateOptns['_inputLblP3_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP3_' . $staffF][0] ) : '';
    $inputLblP4 = isset( $staffTplateOptns['_inputLblP4_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP4_' . $staffF][0] ) : '';

    $orderP1 = isset( $tplateOptns['_orderP1_' . $F] ) ? esc_attr( $tplateOptns['_orderP1_' . $F][0] ) : '0';
    $orderP2 = isset( $tplateOptns['_orderP2_' . $F] ) ? esc_attr( $tplateOptns['_orderP2_' . $F][0] ) : '0';
    $orderP3 = isset( $tplateOptns['_orderP3_' . $F] ) ? esc_attr( $tplateOptns['_orderP3_' . $F][0] ) : '0';
    $orderP4 = isset( $tplateOptns['_orderP4_' . $F] ) ? esc_attr( $tplateOptns['_orderP4_' . $F][0] ) : '0';

    $sfixP1 = isset( $tplateOptns['_sfixP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixP1_' . $F][0] ) : '';
    $sfixP2 = isset( $tplateOptns['_sfixP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixP2_' . $F][0] ) : '';
    $sfixP3 = isset( $tplateOptns['_sfixP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixP3_' . $F][0] ) : '';
    $sfixP4 = isset( $tplateOptns['_sfixP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixP4_' . $F][0] ) : '';

    echo abcfl_input_hline('2', '20');
    $cbo123 = abcfsls_cbo_123();

    echo abcfl_input_info_lbl(abcfsls_txta(98), 'abcflMTop20', '16', 'SB');
    echo abcfl_input_info_lbl(abcfsls_txta(102), 'abcflMTop10 abcflFontFV', 13);

    echo abcfsls_mbox_tplate_field_part_MP( '1', $inputLblP1, $orderP1, $sfixP1, $cbo123, $F );
    echo abcfsls_mbox_tplate_field_part_MP( '2', $inputLblP2, $orderP2, $sfixP2, $cbo123, $F );
    echo abcfsls_mbox_tplate_field_part_MP( '3', $inputLblP3, $orderP3, $sfixP3, $cbo123, $F );
    echo abcfsls_mbox_tplate_field_part_MP( '4', $inputLblP4, $orderP4, $sfixP4, $cbo123, $F );
    //echo abcfl_input_info_lbl(abcfsls_txta(1), 'abcflMTop10', '12', 'N');
}

function abcfsls_mbox_tplate_field_part_MP( $no, $lbl, $orderP, $sfixP, $cbo123, $F ){

    $divE = abcfl_html_tag_end( 'div');

    $out = abcfl_html_tag( 'div', '', 'abcflMultiFieldsCntr' ) .
    abcfl_html_tag( 'div', '', 'abcflFloatL abcflMPOrder abcflPRight10' ) .
    abcfl_input_cbo('orderP' . $no . '_' . $F, '', $cbo123, $orderP, $no . '. ' . $lbl, '', '100%', true, '', '', 'abcflFldCntr', 'abcflFldLbl') . $divE .
    abcfl_html_tag( 'div', '', 'abcflFloatL abcflMPSuffix' ) .
    abcfl_input_txt('sfixP' . $no . '_' . $F, '', $sfixP, abcfsls_txta(48), '', '100%', '', '', 'abcflFldCntr', 'abcflFldLbl') . $divE .
    abcfl_html_tag_cls( 'div', 'abcflClr', true ) . $divE;

    return $out;
}

function abcfsls_mbox_tplate_field_parts_MP_sort( $tplateOptns, $F, $staffTplateOptns, $staffF ){

    //$staffTplateOptns = get_post_custom( $staffTplateID );

    $forSort = isset( $tplateOptns['_forSort_' . $F] ) ? esc_attr( $tplateOptns['_forSort_' . $F][0] ) : '0';

    $inputLblP1 = isset( $staffTplateOptns['_inputLblP1_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP1_' . $staffF][0] ) : '';
    $inputLblP2 = isset( $staffTplateOptns['_inputLblP2_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP2_' . $staffF][0] ) : '';
    $inputLblP3 = isset( $staffTplateOptns['_inputLblP3_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP3_' . $staffF][0] ) : '';
    $inputLblP4 = isset( $staffTplateOptns['_inputLblP4_' . $staffF] ) ? esc_attr( $staffTplateOptns['_inputLblP4_' . $staffF][0] ) : '';

    $orderP1 = isset( $tplateOptns['_orderPS1_' . $F] ) ? esc_attr( $tplateOptns['_orderPS1_' . $F][0] ) : '0';
    $orderP2 = isset( $tplateOptns['_orderPS2_' . $F] ) ? esc_attr( $tplateOptns['_orderPS2_' . $F][0] ) : '0';
    $orderP3 = isset( $tplateOptns['_orderPS3_' . $F] ) ? esc_attr( $tplateOptns['_orderPS3_' . $F][0] ) : '0';
    $orderP4 = isset( $tplateOptns['_orderPS4_' . $F] ) ? esc_attr( $tplateOptns['_orderPS4_' . $F][0] ) : '0';

    echo abcfl_input_hline('2', '20');
    $cbo123 = abcfsls_cbo_123();

    echo abcfl_input_info_lbl(abcfsls_txta(94), 'abcflMTop20', '16', 'SB');
    echo abcfl_input_info_lbl(abcfsls_txta(95), 'abcflMTop10 abcflFontFV', 13);

    echo abcfl_input_checkbox('forSort_'. $F,  '', $forSort, abcfsls_txta(96), '', '', '', 'abcflFldCntr', '', '', '' );

    echo abcfl_input_cbo('orderPS1' . '_' . $F, '', $cbo123, $orderP1, '1. ' . $inputLblP1, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('orderPS2' . '_' . $F, '', $cbo123, $orderP2, '2. ' . $inputLblP2, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('orderPS3' . '_' . $F, '', $cbo123, $orderP3, '3. ' . $inputLblP3, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('orderPS4' . '_' . $F, '', $cbo123, $orderP4, '4. ' . $inputLblP4, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//==MP END ===================================================

function abcfsls_mbox_tplate_field_hide_delete( $hideDelete, $F ){

    $cboHD = abcfsls_cbo_hide_delete();
    $lblHD = abcfsls_txta(56) . '/'. abcfsls_txta_r(57);
    $hltHD = abcfsls_txta(56) . ' = '. abcfsls_txta(37);
    echo abcfl_input_cbo('hideDelete_' . $F, '',$cboHD, $hideDelete, $lblHD, $hltHD, '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

