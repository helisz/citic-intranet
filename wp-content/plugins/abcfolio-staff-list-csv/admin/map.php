<?php

//Used for Import & Export tabs. Returns single field HTML (row). TR: Lbl_cbo OR checkbox div.
function abcfslc_map_field_rows( $tplateID, $ie, $fileOpts='' ){

    $tplateOptns = get_post_custom( $tplateID );
    $savedMap = abcfslc_map_saved_optns( $tplateID, $ie );

    $cbo = '';
    if( !empty( $fileOpts ) ) { $cbo = abcfslc_map_csv_columns_cbo( $fileOpts ); }

    $fieldRows = '';
    if( $ie == 'E' ){
        $fieldRows = abcfslc_map_row_bldr( abcfslc_txta_r(45), '', 'postID',  abcfslc_map_value_by_key( 'postID', $savedMap ), $cbo, $ie );
    }
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta_r(100), '', 'postTitle',  abcfslc_map_value_by_key( 'postTitle', $savedMap ), $cbo, $ie );

    for ( $i = 1; $i <= 40; $i++ ) {
        $fieldRows .= abcfslc_map_field_row( $tplateOptns, 'F' . $i, $cbo, $savedMap, $ie  );
    }

    $fieldRows .=  abcfslc_map_row_bldr_divider( $ie );

    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(102), '', '_imgUrlL',  abcfslc_map_value_by_key( '_imgUrlL', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(103), '', '_imgUrlS',  abcfslc_map_value_by_key( '_imgUrlS', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(104), '', '_imgLnkL',  abcfslc_map_value_by_key( '_imgLnkL', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(82) . ' 1', '', '_overTxtI1',  abcfslc_map_value_by_key( '_overTxtI1', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(82) . ' 2', '', '_overTxtI2',  abcfslc_map_value_by_key( '_overTxtI2', $savedMap ), $cbo, $ie );
    $fieldRows .=  abcfslc_map_row_bldr_divider( $ie );

    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(105), '', '_fbookUrl',  abcfslc_map_value_by_key( '_fbookUrl', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(106), '', '_googlePlusUrl',  abcfslc_map_value_by_key( '_googlePlusUrl', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(107), '', '_twitUrl',  abcfslc_map_value_by_key( '_twitUrl', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(108), '', '_likedUrl',  abcfslc_map_value_by_key( '_likedUrl', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(109), '', '_emailUrl',  abcfslc_map_value_by_key( '_emailUrl', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(110), '', '_socialC1Url',  abcfslc_map_value_by_key( '_socialC1Url', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(111), '', '_socialC2Url',  abcfslc_map_value_by_key( '_socialC2Url', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(112), '', '_socialC3Url',  abcfslc_map_value_by_key( '_socialC3Url', $savedMap ), $cbo, $ie );
    $fieldRows .=  abcfslc_map_row_bldr_divider( $ie );

    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(101), '', '_sortTxt',  abcfslc_map_value_by_key( '_sortTxt', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(76), '', '_pretty',  abcfslc_map_value_by_key( '_pretty', $savedMap ), $cbo, $ie );
    $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(113), '', '_sPgTitle',  abcfslc_map_value_by_key( '_sPgTitle', $savedMap ), $cbo, $ie );
    $fieldRows .=  abcfslc_map_row_bldr_divider( $ie );

    //-- CATEGORIES
    //if( $ie == 'I' ){
        $fieldRows .= abcfslc_map_row_bldr( abcfslc_txta(114), '', '_categories',  abcfslc_map_value_by_key( '_categories', $savedMap ), $cbo, $ie );
    //}


//echo"<pre>", print_r('--- map.php map_field_rows ---'), "</pre>";
//echo"<pre>", print_r($fieldRows), "</pre>";

    return $fieldRows;
}
//-----------------------------------------------------

function abcfslc_map_field_row( $tplateOptns, $F, $cboCSVColumns, $savedMap, $ie  ){

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
    if( $fieldType == 'N' ) { return ''; }

    $row = '';
    //-----------------------------------------------------
    switch ($fieldType){
        case 'T':
        case 'PT':
        case 'LT':
            $row = abcfslc_map_field_T( $tplateOptns, $F, $cboCSVColumns, $savedMap, $ie );
            break;
        case 'MP':
            $row = abcfslc_map_field_MP( $tplateOptns, $F, $cboCSVColumns, $savedMap, $ie );
            break;
        case 'EM':
        case 'H':
            $row = abcfslc_map_field_H( $tplateOptns, $F, $cboCSVColumns, $savedMap, $ie );
            break;
        case 'TH':
            $row = abcfslc_map_field_TH( $tplateOptns, $F, $cboCSVColumns, $savedMap, $ie );
            break;
        case 'CE':
            $row = abcfslc_map_field_CE( $tplateOptns, $F, $cboCSVColumns, $savedMap, $ie );
            break;
       default:
            break;
    }
    return $row;
}

function abcfslc_map_field_T( $tplateOptns, $F, $cbo, $savedMap, $ie  ){

    $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';

    $fieldID = '_txt_' . $F;
    return abcfslc_map_row_bldr( $lbl, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );
}

function abcfslc_map_field_CE( $tplateOptns, $F, $cbo, $savedMap, $ie  ){

    $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';

    $fieldID = '_editorCnt_' . $F;
    return abcfslc_map_row_bldr( $lbl, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );
}

function abcfslc_map_field_H( $tplateOptns, $F, $cbo, $savedMap, $ie ){

    $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
    $url = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';

    $fieldID = '_urlTxt_' . $F;
    $out = abcfslc_map_row_bldr( $lbl, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );

    $fieldID = '_url_' . $F;
    $out .= abcfslc_map_row_bldr( $url, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );
    return $out;
}

function abcfslc_map_field_TH( $tplateOptns, $F, $cbo, $savedMap, $ie ){

    $url = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';

    $fieldID = '_url_' . $F;
    return abcfslc_map_row_bldr( $url, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );
}

function abcfslc_map_field_MP( $tplateOptns, $F, $cbo, $savedMap, $ie  ){

    $lblP1 = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : '';
    $lblP2 = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : '';
    $lblP3 = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : '';
    $lblP4 = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : '';

    $fieldID = '_mp1_' . $F;
    //$columnID = abcfslc_map_value_by_key( $fieldID, $savedMap );
    $out = abcfslc_map_row_bldr( $lblP1, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );

    $fieldID = '_mp2_' . $F;
    $out .= abcfslc_map_row_bldr( $lblP2, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );

    $fieldID = '_mp3_' . $F;
    $out .= abcfslc_map_row_bldr( $lblP3, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );

    $fieldID = '_mp4_' . $F;
    $out .= abcfslc_map_row_bldr( $lblP4, $F, $fieldID, abcfslc_map_value_by_key( $fieldID, $savedMap ), $cbo, $ie );
    return $out;
}

//-----------------------------------------------------
function abcfslc_map_row_bldr( $lbl, $F, $fieldID, $fieldValue, $cbo, $ie ){

    if( $ie == 'I' ){
        return abcfslc_map_row_bldr_import( $lbl, $F, $fieldID, $fieldValue, $cbo );
    }
    else {
        return abcfslc_map_row_bldr_export( $lbl, $F, $fieldID, $fieldValue );
    }

}

function abcfslc_map_row_bldr_import( $lbl, $F, $fieldID, $fieldValue, $cbo ){

    $cboCSVColumn = aabcfslc_map_fields_cbo( $fieldID, '', $cbo, $fieldValue, '100%' );

    $out = '<tr>';
    $out .= '<td>' . $F . ' ' . $lbl .  '</td>';
    $out .= '<td>' . $cboCSVColumn .  '</td>';
    $out .= '</tr>';

    return $out;
}

//CBO control
function aabcfslc_map_fields_cbo( $fldID, $fldName, $values, $selected, $size='', $cls='', $style='' ) {

    $cboOptions = abcfl_input_cbo_get_options($values, $selected);
    $optns = abcfl_input_get_options( $fldID, $fldName, '', '', $size, $cls, $style, '', '',  '');
    extract( $optns );

    return  '<select' . $id . 'type="text"' . $cls . $style . $fldName . ' >' . $cboOptions . '</select>';
}

function abcfslc_map_row_bldr_export( $lbl, $F, $fieldID, $fieldValue ){

    //abcfslc_export_checkbox_row( $fldID, $fldName, $fldValue, $lblTxt='')
    $checkbox = abcfslc_map_export_checkbox_row( $fieldID, '', $fieldValue, '&nbsp;&nbsp;' . trim( $F . ' ' . $lbl ) );
    $out = '<div class="abcflFontFVS14 abcflFontW400 abcflPTop10">' . $checkbox .  '</div>';

    return $out;
}

//1=checked; 0=unchecked;
function abcfslc_map_export_checkbox_row( $fldID, $fldName, $fldValue, $lblTxt='') {

    //if( $fldID == 'postTitle' || $fldID == 'postID' ) { return $lblTxt; }

    $optns = abcfl_input_get_options( $fldID, $fldName, $lblTxt, '', '', '', '', '', '');
    extract( $optns );
    $checked = '';
    if($fldValue == 1){ $checked = ' checked '; }
    return '<label><input type="checkbox" ' . $id .  $fldName . ' value="' . $fldValue . '"' . $checked . ' >' . $lblTxt . '</label>';
}


function abcfslc_map_row_bldr_divider( $ie ){

    $out = '';

    if( $ie == 'I' ){
        $out = '<tr class="buba">';
        $out .= '<td>' . '&nbsp;' .  '</td>';
        $out .= '<td>' . '&nbsp;' .  '</td>';
        $out .= '</tr>';
    }
    else {
        $out =  abcfl_input_hline( '1', '10', '50Pc');;
    }

    return $out;
}
//-----------------------------------------------------

function abcfslc_map_value_by_key( $fieldID, $savedMap ){

    //$fieldID = CSV Column No
    //$fieldID = 1 or 0
    foreach ($savedMap as $key => $value) {
        if ($key == $fieldID) {
            return $value;
        }
    }
    return '0';
}

function abcfslc_map_saved_optns( $tplateID, $ie ){

   $defaults = array();
   if( $ie == 'I' ){
        return wp_parse_args( get_option( 'abcfslc_import_map_' . $tplateID, array() ) , $defaults );
    }
    else{
         return wp_parse_args( get_option( 'abcfslc_export_map_' . $tplateID, array() ) , $defaults );
    }
}

function abcfslc_map_csv_columns_cbo( $fileOpts ){

    $fileQName = $fileOpts['csvQFilename'];
    if( empty( $fileQName ) ) { return ''; }

    $returnQty = 0;
    $rowOffset = 0;
    $cboFirstRow = new ABCFSLC_CSV_Read( $fileQName, $fileOpts['delimiter'], $fileOpts['enclosure'], $fileOpts['escape'],  $returnQty, $rowOffset );

    return $cboFirstRow->cboFirstRow();
}