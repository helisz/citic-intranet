<?php
//-- TABS ----------------------------------------
function abcfsls_autil_vtabs_manager_s( $mgrID ){
    //---Manager START
    echo abcfl_html_tag( 'div', 'abcfVTabsMgr_' . $mgrID, 'abcflVTabsMgr' );
}

function abcfsls_autil_vtabs_li( $cls, $lbl1, $lbl2='', $url='#'){

    $lbl1 = abcfl_html_tag_with_content( $lbl1, 'span', '');
    $lbl2 = abcfl_html_tag_with_content( $lbl2, 'span', '');
    $lbl = trim( $lbl1 . ' ' . $lbl2 );

    $out = abcfl_html_tag( 'li', '', $cls );
        $out .= abcfl_html_a_tag( $url, $lbl, '', '' );
    $out .= abcfl_html_tag_end( 'li' );

    return $out;
}

function abcfsls_txta_reqired( $id, $suffix='' ) {
    $txt = abcfsls_txta( $id, $suffix );
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}

function abcfsls_mbox_mfilter_layout_field_order( $filterOptns ) {

    //[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,1,2],[3,2,1]
    $fieldOrder =  isset( $filterOptns['_mfFieldOrder'] ) ?  $filterOptns['_mfFieldOrder'][0] : '';

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(139), abcfsls_aurl(0) );

    echo abcfl_input_txt('mfFieldOrder', '', $fieldOrder, abcfsls_txta(0), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //echo abcfl_input_cbo_strings('mfFieldOrder', '', $cboOrder, $fieldOrder, '', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}



//Add new field
function abcfsls_mbox_tplate_field_add_field_cbo_OLD( $fieldType, $F ){
    echo abcfl_input_info_lbl(abcfsls_txta(42), 'abcflMTop15', 16, 'SB');

    $cboLineType = abcfsls_cbo_field_type();
    echo abcfl_input_cbo('fieldType_' . $F, '',$cboLineType, $fieldType, abcfsls_txta_r(42), abcfsls_txta(111), '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Generic class + style
function abcfsls_mbox_tplate_field_class_and_style( $clsInputID, $styleInputID, $F,  $clsLbl, $styleLbl, $clsInputName, $styleInputName, $hline=true, $genericHdr=true ){

    if( $hline ) { echo abcfl_input_hline('2'); }

    if( $genericHdr ) {
        echo abcfl_input_info_lbl(abcfsls_txta(35), 'abcflMTop15', 16, 'SB');
        echo abcfl_input_info_lbl(abcfsls_txta(50), 'abcflMTop5 abcflFontFV', 13);
    }

    echo abcfl_input_txt($clsInputName . $F, '', $clsInputID, abcfsls_txta($clsLbl), abcfsls_txta(51), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt($styleInputName . $F, '', $styleInputID, abcfsls_txta($styleLbl), abcfsls_txta(52), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Generic class + style  ??????? move to autil
function abcfsls_autil_class_and_style( $clsInputID, $styleInputID, $F,  $clsLbl, $styleLbl, $clsInputName, $styleInputName, $hline=true, $genericHdr=true ){

    if( $hline ) { echo abcfl_input_hline('2'); }

    $lbl = abcfsls_txta($clsLbl);
    if( $genericHdr ) {
        echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(35), abcfsls_aurl(0) );
    }
    else{
        $lbl = abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta( $clsLbl ), abcfsls_aurl(0), 'abcflFontWP abcflFontS12 abcflFontW400' );
    }

    echo abcfl_input_txt($clsInputName . $F, '', $clsInputID, $lbl, abcfsls_txta(51), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt($styleInputName . $F, '', $styleInputID, abcfsls_txta( $styleLbl ), abcfsls_txta(52), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//???????????????????????????????????????
function abcfsl_autil_show_field_for_field_order( $showFieldOn, $fieldTypeH, $isSingle ){

    $out = false;

    //Hidden field. Fileld type. N = field not selected yet.
    //For SL value of Show/Hide N,Y,H
    if($fieldTypeH == 'N'){ return $out; }

    switch ( $showFieldOn ) {
    case 'Y':
        $out = true;
        break;
    case 'L':
        if( !$isSingle ){ $out = true; }
        break;
    case 'S':
        if($isSingle ){ $out = true; }
        break;
    default:
        break;
    }

    return $out;
}