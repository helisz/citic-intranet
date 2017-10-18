<?php
function abcfslc_tplate_import_preview_tbl(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $opts = abcfslc_autil_tplate_import_optns();

    //$fileQName = $opts['csvQFilename'];
    $fileName = $opts['csvFilename'];
    //-----------------------------------------------
    if ( isset($_POST['btnLoadTbl']) ){
        check_admin_referer( $slug . '_nonce' );
        //echo"<pre>", print_r($_POST), "</pre>";
        abcfslc_tplate_import_preview_tbl_refresh( $opts );
    }
    //---------------------------------------------
    //$tplateName = abcfslc_dba_template_name( $tplateID );
    //$notImported = abcfslc_dba_count_not_imported();

    //--WRAP START --------------------------------
    echo  abcfl_html_tag('div', '', '' );

    $importStatus = abcfslc_autil_tplate_import_status( $fileName );

    //print_r($importStatus);

    switch ($importStatus){
        case 'FAILED':
            abcfslc_tplate_import_preview_tbl_failed( $opts );
            break;
        case 'IMPORTED':
            abcfslc_tplate_import_preview_tbl_imported();
            break;
        case 'READY':
            abcfslc_tplate_import_preview_tbl_ready( $opts, $slug );
            break;
        case 'EMPTY':
            abcfslc_tplate_import_preview_tbl_empty( $opts, $slug );
            break;
        case 'NOFILE':
            abcfslc_autil_err_no_file();
            break;
       default:
            break;
    }
    //-- WRAP END --------------------------------------
    echo abcfl_html_tag_end( 'div' );
}

function abcfslc_tplate_import_preview_tbl_empty( $opts, $slug ){

    abcfslc_autil_tplate_import_lbls_optns( $opts );
    abcfslc_tplate_import_preview_tbl_form( $slug, 34 );
    abcfslc_tbls_tplate_render_import_tbl();
}

function abcfslc_tplate_import_preview_tbl_ready( $opts, $slug ){

    abcfslc_autil_msg_info( abcfslc_txta(66) );
    abcfslc_tplate_import_preview_tbl_form( $slug, 34 );

    abcfslc_autil_tplate_import_lbls_optns( $opts );
    abcfslc_tbls_tplate_render_import_tbl();
}

function abcfslc_tplate_import_preview_tbl_imported(){
    abcfslc_autil_lbls_import_ok_go_to();
}

function abcfslc_tplate_import_preview_tbl_failed( $opts ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_autil_tplate_import_lbls_optns( $opts );
    abcfslc_tbls_tplate_render_import_tbl();
}

function abcfslc_tplate_import_preview_tbl_form( $slug, $btnLblID ){

        echo abcfl_html_form( 'abcfslc_frm_tbl', '');
        wp_nonce_field($slug . '_nonce');
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnLoadTbl', 'btnLoadTbl', 'submit', abcfslc_txta($btnLblID), 'button-primary abcficBtnWide' );
        echo abcfl_html_tag_ends('div,form');
}




//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//== DB TABLE - TRUNCATE AND LOAD - START =================
function abcfslc_tplate_import_preview_tbl_refresh( $opts ){

    //abcfslc_dba_import_drop_tbl();
    //abcfslc_dba_import_create_tbl();
//echo"<pre>", print_r($csvRows), "</pre>"; die;

    abcfslc_autil_tplate_import_truncate_tbl();
    abcfslc_tplate_import_preview_tbl_load_data( $opts );
    //abcfslc_tplate_import_preview_tbl_update_qty( );

    //abcfslc_tbls_tplate_render_import_tbl();
}

//function abcfslc_tplate_import_preview_tbl_update_qty(){
//
//    $qty = abcfslc_dba_qty_posts_to_insert();
//    update_option( 'abcfslc_tplate_import_qty', $qty );
//    update_option( 'abcfslc_tplate_imported_qty', 0 );
//}

//Get CSV. Add records to temp table.
function abcfslc_tplate_import_preview_tbl_load_data( $opts ){

    $fileQName = $opts['csvQFilename'];
    if( empty( $fileQName ) ) { return ''; }

    //Import file column names have to match staff template export file.
    $csvColumns = abcfslc_tplate_import_preview_tbl_csv_columns( $opts );
    if( !$csvColumns ) {
        abcfslc_autil_tplate_import_file_no_match();
        return;
    }
    //-----------------------------------------------

    $returnQty = 0;
    $rowOffset = 1;
    $abcfpb = new ABCFSLC_CSV_Read( $fileQName, $opts['delimiter'], $opts['enclosure'], $opts['escape'], $returnQty, $rowOffset );
    $csvRows = $abcfpb->toArray();

    if (!$csvRows) { return; }

    //CSV rows
    foreach ( $csvRows as $csvRow ) {
        abcfslc_tplate_import_preview_tbl_add_row( $csvRow );
    }
}

function abcfslc_tplate_import_preview_tbl_add_row( $csvRow ){

    if ( count( $csvRow ) != 3 ) { return; }

//    [1] => Array
//        (
//            [0] => 1
//            [1] => sc_member_order
//            [2] => 0
//        )

    if( abcfl_html_isblank( $csvRow[0] ) ){ return; }
    if( abcfl_html_isblank( $csvRow[1] ) ){ return; }
    if( abcfl_html_isblank( $csvRow[2] ) ){ return; }

    $parDB['export_id'] = $csvRow[0];
    $parDB['post_id'] = 0;
    $parDB['meta_key'] = $csvRow[1];
    $parDB['meta_value'] = $csvRow[2];

    abcfslc_dba_import_tplate_add_row( $parDB );
}

//Check CSV file layout. It has to match export layout.
function abcfslc_tplate_import_preview_tbl_csv_columns( $opts ){

     //echo"<pre>", print_r($opts['csvQFilename']), "</pre>"; die;

    $fileQName = $opts['csvQFilename'];
    if( empty( $fileQName ) ) { return ''; }

    $returnQty = 0;
    $rowOffset = 0;
    $cboFirstRow = new ABCFSLC_CSV_Read( $fileQName, $opts['delimiter'], $opts['enclosure'], $opts['escape'],  $returnQty, $rowOffset );

    $csvColumns = $cboFirstRow->cboFirstRow();

    //echo"<pre>", print_r($csvColumns), "</pre>"; die;
    //    [0] =>  - - -
    //    [1] => export_id
    //    [2] => meta_key
    //    [3] => meta_value

    if ( count( $csvColumns ) != 4 ) { return false; }
    if( $csvColumns[1] != 'export_id' ){ return false; }
    if( $csvColumns[2] != 'meta_key' ){ return false; }
    if( $csvColumns[3] != 'meta_value' ){ return false; }

    return true;
}

//#####################################################################
