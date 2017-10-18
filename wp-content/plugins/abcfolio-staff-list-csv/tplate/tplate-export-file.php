<?php
function abcfslc_tplate_export_file(){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $opts = abcfslc_autil_tplate_export_file_optns();
    $tplateID = $opts['tplateID'];

    abcfslc_tplate_export_preview_tbl_refresh( $tplateID );

    switch ( abcfslc_autil_export_status( $tplateID ) ){
        case 'NOTEMPLATE':
            abcfslc_autil_err_no_template();
            break;
        case 'EMPTY':
            abcfslc_autil_err_export_tbl_empty();
            break;
       default:
            abcfslc_tplate_export_preview_qty();
            abcfslc_tplate_export_file_form( $slug );
            break;
    }

//TEST
//print_r($opts);
//abcfslc_tplate_export_file_run_TEST( $tplateID );
}

//function abcfslc_tplate_export_file_qty(){
//    $qty = abcfslc_tplate_export_preview_qty();
//    abcfslc_autil_msg_info( $qty . abcfslc_txta(75) );
//}

function abcfslc_tplate_export_file_form( $slug ){

    echo abcfl_html_form( 'abcfslc_frmTplateExportCSV', '');
    wp_nonce_field($slug . '_nonce');
    echo abcfl_html_tag('div','', 'submit' );
    echo abcfl_input_btn( 'btnTplateExportCSV', 'btnTplateExportCSV', 'submit', abcfslc_txta(63), 'button-primary abcficBtnWide' );
    echo abcfl_html_tag_ends('div,form');
}


//Executed from admin init action
function abcfslc_tplate_export_file_action(){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    //-----------------------------------------------
    if ( isset($_POST['btnTplateExportCSV']) ){
        check_admin_referer( $slug . '_nonce' );
        $opts = abcfslc_autil_tplate_export_file_optns();
        abcfslc_tplate_export_file_run( $opts );
    }
}

function abcfslc_tplate_export_file_run( $opts ){

    $columnNames= abcfslc_tplate_export_file_column_names();

    $filename = 'staff_list_template_' . date('Ymd') . '.csv';

//    //UTF-8; UTF-16LE;
//    $opts['encoding'] = 'UTF-8';
//    //I = export/import; S = spreadsheet
//    $opts['destination'] = 'I';

        $encoding = 'UTF-8';
        $destination = 'EI';
        $bom = 'N';


    // Must be first, will send appropriate headers to download the CSV file
    ABCFSLC_Write_Helpers::headers( $filename, $encoding );
    $file = 'php://output';
    $writer = new ABCFSLC_Writer( $file, $opts['delimiter'], $opts['enclosure'], $encoding, $bom, $destination );

    //First row. Column names.
    $writer->addRow( $columnNames );

    $dbRows = abcfslc_dba_export_tplate_data();

    if (!$dbRows) {
        $writer->save();
        exit();
    }

    foreach ( $dbRows as $dbRow ) {
        $row = array();
        $row [0] = $dbRow->export_id;
        $row [1] = $dbRow->meta_key;
        $row [2] = $dbRow->meta_value;

        $writer->addRow( $row );
    }
    //var_dump($items);

    $writer->save();
    exit();
}

function abcfslc_tplate_export_file_column_names(){

    $out[0] = 'export_id';
    $out[1] = 'meta_key';
    $out[2] = 'meta_value';

    return $out;
}



//Returns single CSV row as an array.
function abcfslc_tplate_export_file_row_array( $postID ){

    //post_id, sl_field_name, meta_value. Single post ID, Name and meta records
    $dbRows = abcfslc_dba_export_file_row_data( $postID );
    if (!$dbRows) { return array(); }

    //PHP 5.4
    //$row = [];
    $row = array();
    foreach ( $dbRows as $dbRow ) {
        $row [$dbRow->sl_field_name] = $dbRow->meta_value;
    }
    return $row;
}


//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function abcfslc_tplate_export_file_run_TEST( $tplateID ){

    //$postIDs = abcfslc_dba_export_to_file_post_ids();
    $columnNames= abcfslc_dba_export_tbl_column_names();

// echo"<pre>", print_r('--- abcfslc_dba_export_file_column_names ---'), "</pre>";
// echo"<pre>", print_r($columnNames), "</pre>";
// return;

// $exportMap = abcfslc_map_saved_optns( $tplateID, 'E' );
//
//echo"<pre>", print_r('--- $exportMap ---'), "</pre>";
//echo"<pre>", print_r($exportMap), "</pre>";
//return;


    $postIDs = abcfslc_dba_export_file_post_ids();

    $i = 1;
    //PHP 5.4
    //$row = [];
    $row = array();
    foreach ( $postIDs as $key => $postID) {
        $row = abcfslc_tplate_export_file_row_array( $postID );
        //if($i == 1) {exit;}
    }
//
        //return wp_parse_args( $row , $defaultColumns );
}

