<?php
function abcfslc_import_preview_file(){

    $opts = abcfslc_autil_import_file_optns();
    $tplateID =  $opts['tplateID'];
    $fileName = $opts['csvFilename'];

    $importStatus = abcfslc_autil_import_status( $tplateID, $fileName );

    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_preview_file_failed( $opts );
            break;
        case 'IMPORTED':
            abcfslc_import_preview_file_imported( $opts );
            break;
        case 'EMPTY':
        case 'READY':
            abcfslc_import_preview_file_empty( $opts );
            break;
        case 'NOTEMPLATE':
            abcfslc_autil_err_no_template();
            break;
        case 'NOFILE':
            abcfslc_autil_err_no_file();
            break;
       default:
            break;
    }
}

function abcfslc_import_preview_file_empty( $opts ){
    abcfslc_import_preview_file_render_tbl( $opts );
}

function abcfslc_import_preview_file_imported( $opts ){
    abcfslc_autil_lbls_import_ok_go_to();
    abcfslc_import_preview_file_render_tbl( $opts );
}

function abcfslc_import_preview_file_failed( $opts ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_import_preview_file_render_tbl( $opts );
}

function abcfslc_import_preview_file_render_tbl( $opts ){

    $fileQName = $opts['csvQFilename'];
    $delimiter = $opts['delimiter'];
    $enclosure = $opts['enclosure'];
    $escape = $opts['escape'];

    //$enclosure = stripslashes($opts['enclosure']);
    //$enclosure = chr(34);
    //$e = stripslashes($opts['enclosure']);

    $returnQty = 0;
    $rowOffset = 0;
    //$flushEmpty = true;
    //$collectGarbage = true;
    $csv = new ABCFSLC_CSV_Read( $fileQName, $delimiter, $enclosure, $escape, $returnQty, $rowOffset );

    echo abcfl_input_info_lbl( abcfslc_txta(30) . ': <span class="abcflFontW400 abcflBlack">' . $opts['csvFilename'], 'abcflMTop10', 14, 'B');
    //$rows = $csv->toTable();
    echo abcfslc_import_preview_file_csv_tbl( $csv->toTable() );

        //$columnNames = $abcfpb->firstRow();
        //print_r($columnNames);
}

//== IMPORT CSV TABLE START  =======================================
function abcfslc_import_preview_file_csv_tbl( $rows ) {

    if (empty( $rows )) { return '';}

    //Table. '<table class="wp-list-table widefat striped posts">';
    $out = '<table class="abcfTblFile">';

    // Table head.
    $out .= '<thead><tr><th>&nbsp;</th>';
    foreach ($rows as $row) {
        foreach ($row as $key => $col) {
            $out .= '<th>' . ($key + 1) .  '</th>';
        }
        break;
    }
    $out .= '</tr></thead>';

    // Table body.
    $out .= '<tbody>';
    foreach ($rows as $i => $row) {
        $out .= abcfslc_import_preview_file_csv_tbl_row( $row, $i );
    }
    $out .= '</tbody>';

    // Table end.
    $out .= '</table>';
    return $out;
}

function abcfslc_import_preview_file_csv_tbl_row( $row, $i ) {

        $out = '<tr>';
        if($i == 0){ $out = '<tr class="abcfNoWrap abcflFontW600">';}

        $out .= '<th>' . ( $i++ ) . '</th>';
        foreach ($row as $col) {
            $out .= '<td>' . $col .  '</td>';
        }
        $out .= '</tr>';

        return $out;
}
//== IMPORT CSV TABLE END  =======================================