<?php
function abcfslc_import_preview_tbl(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $fileOpts = abcfslc_autil_import_file_optns();
    $tplateID =  $fileOpts['tplateID'];
    //$fileQName = $fileOpts['csvQFilename'];
    $fileName = $fileOpts['csvFilename'];
    //-----------------------------------------------
    if ( isset($_POST['btnLoadTbl']) ){
        check_admin_referer( $slug . '_nonce' );
        //echo"<pre>", print_r($_POST), "</pre>";
        abcfslc_import_preview_tbl_refresh( $tplateID, $fileOpts );
    }
    //---------------------------------------------
    //$tplateName = abcfslc_dba_template_name( $tplateID );
    //$notImported = abcfslc_dba_count_not_imported();

    //--WRAP START --------------------------------
    echo  abcfl_html_tag('div', '', '' );

    $importStatus = abcfslc_autil_import_status( $tplateID, $fileName  );
    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_preview_tbl_failed( $tplateID, $fileName );
            break;
        case 'IMPORTED':
            abcfslc_import_preview_tbl_imported();
            break;
        case 'READY':
            abcfslc_import_preview_tbl_ready( $tplateID, $fileName, $slug );
            break;
        case 'EMPTY':
            abcfslc_import_preview_tbl_empty( $tplateID, $fileName, $slug );
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
    //-- WRAP END --------------------------------------
    echo abcfl_html_tag_end( 'div' );
}

function abcfslc_import_preview_tbl_empty( $tplateID, $fileName, $slug ){

    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_import_preview_tbl_form( $slug, 34 );
    abcfslc_tbls_render_import_tbl();
}

function abcfslc_import_preview_tbl_ready( $tplateID, $fileName, $slug ){

    abcfslc_autil_msg_info( abcfslc_txta(66) );
    abcfslc_import_preview_tbl_form( $slug, 34 );

    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_tbls_render_import_tbl();
}

function abcfslc_import_preview_tbl_imported(){
    abcfslc_autil_lbls_import_ok_go_to();
}

function abcfslc_import_preview_tbl_failed( $tplateID, $fileName ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_tbls_render_import_tbl();
}

function abcfslc_import_preview_tbl_form( $slug, $btnLblID ){

        echo abcfl_html_form( 'abcfslc_frm_tbl', '');
        wp_nonce_field($slug . '_nonce');
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnLoadTbl', 'btnLoadTbl', 'submit', abcfslc_txta($btnLblID), 'button-primary abcficBtnWide' );
        echo abcfl_html_tag_ends('div,form');
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//== DB TABLE - TRUNCATE AND LOAD - START =================
function abcfslc_import_preview_tbl_refresh( $tplateID, $fileOpts ){

    //abcfslc_dba_import_drop_tbl();
    //abcfslc_dba_import_create_tbl();

    abcfslc_autil_truncate_import_tbl();
    abcfslc_tpate_check( $tplateID );
    abcfslc_import_preview_tbl_load_data( $tplateID, $fileOpts );
    abcfslc_import_preview_tbl_update_qty( );

    abcfslc_import_cat_tbl_refresh();
}

function abcfslc_import_preview_tbl_update_qty(){

    $qty = abcfslc_dba_qty_posts_to_insert();
    update_option( 'abcfslc_import_qty', $qty );
    update_option( 'abcfslc_imported_qty', 0 );
}

//Get CSV. Add records to temp table.
function abcfslc_import_preview_tbl_load_data( $tplateID, $fileOpts ){

    $fileQName = $fileOpts['csvQFilename'];
    if( empty( $fileQName ) ) { return ''; }

    $map = abcfslc_import_preview_tbl_map_fields( $tplateID );
    $cboCSVCols = abcfslc_map_csv_columns_cbo( $fileOpts );

    $tplateOptns = get_post_custom( $tplateID );

    $returnQty = 0;
    $rowOffset = 1;
    $abcfpb = new ABCFSLC_CSV_Read( $fileQName, $fileOpts['delimiter'], $fileOpts['enclosure'], $fileOpts['escape'], $returnQty, $rowOffset );
    $csvRows = $abcfpb->toArray();

    $i = 0;
    //CSV rows
    foreach ( $csvRows as $csvRow ) {
        $i++;
        abcfslc_import_preview_tbl_add_records( $tplateID, $i, $csvRow, $map, $cboCSVCols, $tplateOptns, $fileOpts['img'], $fileOpts['imgDir'] );
    }
}

//Get cells of a single CSV row. Insert each cell into a new row.
function abcfslc_import_preview_tbl_add_records( $tplateID, $csvRowNo, $csvRow, $map, $cboCSVCols, $tplateOptns, $img, $imgDir ){

    $par['tplateID'] = $tplateID;
    $par['csvRowNo'] = $csvRowNo;
    $par['postID'] = 0;
    $par['colNo'] = '';
    $par['cellValue'] = '';
    $par['fieldOrder'] = '';
    $par['metaKey'] = '';
    $par['csvColName'] = '';
    $par['slFieldName'] = '';
    $par['img'] = $img;
    $par['imgDir'] = $imgDir;

    $fieldOrder = 1;
    foreach ( $csvRow as $colNo => $cellValue ) {

        $par['colNo'] = $colNo + 1;
        $par['cellValue'] = $cellValue;
        $par['fieldOrder'] = $fieldOrder++;;

        //abcfslc_import_preview_tbl_add_record( $tplateID, $rowNo, ($colNo + 1), $cellValue, $map, $cboCSVCols, $tplateOptns, $fieldOrder );
        abcfslc_import_preview_tbl_add_record( $par, $tplateOptns, $map, $cboCSVCols );
    }
}

//function abcfslc_import_preview_tbl_add_record( $tplateID, $csvRowNo, $colNo, $cellValue, $map, $cboCSVCols, $tplateOptns, $fieldOrder ){
function abcfslc_import_preview_tbl_add_record( $par, $tplateOptns, $map, $cboCSVCols ){

    //Array of keys or array of single key. Example [urlTxt_F5] => 11 [imgUrlL] => 11
    //echo"<pre>", print_r($cboCSVCols), "</pre>";  //die;
    //var_dump($row);
    //print_r($key . '-');

    $metaKeys = array_keys( $map, $par['colNo']);
    $metaKeys = array_filter( $metaKeys );

    $postID = 0;
    $par['postID'] = $postID;

    if( !empty( $metaKeys ) ){
        foreach ( $metaKeys as $metaKey ) {

            //print_r($par['fieldOrder'] . '-');

            if( $metaKey == 'postTitle' && abcfl_html_isblank( $par['cellValue'] ) ) { $par['cellValue'] = '?'; }

            $out = abcfslc_field_lbls_lbl( $metaKey, $tplateOptns, $par['fieldOrder'] );
            //For F fields csv order. For other fields, order set in abcfslc_field_lbls_lbl.
            $par['fieldOrder'] = $out['order'];
            $par['slFieldName'] = $out['lbl'];

            $par['csvColName'] = abcfslc_import_preview_tbl_csv_col_name( $metaKey, $map, $cboCSVCols );
            $par['metaKey'] = $metaKey;
            abcfslc_import_preview_tbl_add_row( $par );
        }
    }
}

function abcfslc_import_preview_tbl_add_row( $par ){

    $cellValue = $par['cellValue'];
    $metaKey = $par['metaKey'];

    if( abcfl_html_isblank( $cellValue ) ){ return; }

    if( $metaKey == '_imgUrlL' || $metaKey == '_imgUrlS' ){
        $cellValue = abcfslc_import_preview_tbl_img_url( $cellValue, $par['img'], $par['imgDir'] );
    }

    $parDB['tplateID'] = $par['tplateID'];
    $parDB['postID'] = $par['postID'];
    $parDB['csvRowNo'] = $par['csvRowNo'];
    $parDB['csvColName'] = $par['csvColName'];
    $parDB['slFieldName'] = $par['slFieldName'];
    $parDB['metaKey'] = $metaKey;
    $parDB['cellValue'] = $cellValue;
    $parDB['fieldOrder'] = $par['fieldOrder'];

    abcfslc_dba_import_add_row( $parDB );
}


function abcfslc_import_preview_tbl_img_url( $cellValue, $img, $imgDir ){

    if( $img == 'U' ) { return $cellValue; }
    if( abcfl_html_isblank( $imgDir ) ) { return $cellValue; }

    return trailingslashit( $imgDir ) . $cellValue;
}

function abcfslc_import_preview_tbl_csv_col_name( $metaKey, $map, $cboCSVCols ){

    $colName = '';
    if( isset( $map[$metaKey] ) ){
        $colNo = $map[$metaKey];
        if( isset( $cboCSVCols[$colNo] ) ){
            $colName = $cboCSVCols[$colNo];
        }
    }
    return $colName;
}
