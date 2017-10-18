<?php
function abcfslc_import_status(){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $fileOpts = abcfslc_autil_import_file_optns();
    $tplateID =  $fileOpts['tplateID'];
    $fileName = $fileOpts['csvFilename'];
    //-----------------------------------------------
    if ( isset($_POST['btnTruncateImportTbl']) ){
        check_admin_referer( $slug . '_nonce' );
        //echo"<pre>", print_r($_POST), "</pre>";
        abcfslc_autil_truncate_import_tbl();
    }
    //---------------------------------------------

    //--WRAP START --------------------------------
    echo  abcfl_html_tag('div', '', '' );

    $importStatus = abcfslc_autil_import_status( $tplateID, $fileName );

    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_status_failed( $tplateID, $fileName, $slug );
            break;
        case 'IMPORTED':
            abcfslc_import_status_imported( $tplateID, $fileName, $slug  );
            break;
        case 'READY':
            abcfslc_import_status_ready( $tplateID, $fileName );
            break;
        case 'EMPTY':
            abcfslc_import_status_empty( $tplateID, $fileName );
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

function abcfslc_import_status_failed( $tplateID, $fileName, $slug ){
        abcfslc_autil_lbl_import_failed();
        echo abcfl_input_info_lbl( abcfslc_txta(61), 'abcflMTop10', 14, 'SB');
        echo abcfl_input_hline('2', '10', '50P');
        abcfslc_import_status_delete_btn( $slug );
        abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
        abcfslc_tbls_render_import_tbl();
}

function abcfslc_import_status_imported( $tplateID, $fileName, $slug  ){
    abcfslc_autil_lbl_import_ok();
    abcfslc_import_status_delete_btn( $slug );
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_tbls_render_import_tbl();
}

function abcfslc_import_status_empty( $tplateID, $fileName ){
    abcfslc_autil_msg_info( abcfslc_txta(57) );
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
}

function abcfslc_import_status_ready( $tplateID, $fileName ){
    abcfslc_autil_msg_info( abcfslc_txta(64) );
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
}

function abcfslc_import_status_delete_btn( $slug ){
        echo abcfl_html_form( 'abcfslc_frm_tbl', '');
        wp_nonce_field($slug . '_nonce');
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnTruncateImportTbl', 'btnTruncateImportTbl', 'submit', abcfslc_txta(56), 'button-primary abcficBtnWide' );
        echo abcfl_html_tag_ends('div,form');
}
//##############################################################
//    $notImported = abcfslc_dba_count_not_imported();
//    $imported = abcfslc_dba_count_imported();
//    $all = abcfslc_dba_count_import_all();
//
//    $importStatus = 0;
//
//    //print_r($notImported);
//
//    //Nothing imported.
//    if( $all == $notImported ) { $importStatus = 0; }
//    //All imported.
//    if( $all == $imported ) { $importStatus = 1; }
//    //Some imported.
//    if( $all != $imported && $all != $notImported) { $importStatus = 2; }
//
//    $msg = 0;
//
//    switch ($importStatus){
//        case 0:
//            $msg = 57;
//            break;
//        case 1:
//            $msg = 55;
//            break;
//        case 2:
//            $msg = 58;
//            break;
//       default:
//            break;
//    }
//
//    echo abcfl_input_info_lbl( abcfslc_txta($msg), 'abcflMTop20', 16, 'SB');
//
//    if( $importStatus != 0 ){
//
//        echo abcfl_input_info_lbl( abcfslc_txta(60), 'abcflMTop20', 16, 'SB');
//
//        echo abcfl_html_form( 'abcfslc_frm_tbl', '');
//        wp_nonce_field($slug . '_nonce');
//        echo abcfl_html_tag('div','', 'submit' );
//        echo abcfl_input_btn( 'btnTruncateImportTbl', 'btnTruncateImportTbl', 'submit', abcfslc_txta(56), 'button-primary abcficBtnWide' );
//        echo abcfl_html_tag_ends('div,form');
//    }
//
//
//


//    if( $importStatus != 'ALL' ){
//
//        echo abcfl_input_info_lbl( abcfslc_txta(58), 'abcflMTop20', 16, 'SB');
//        echo abcfl_input_info_lbl( abcfslc_txta(61), 'abcflMTop20', 16, 'SB');
//
//        echo abcfl_html_form( 'abcfslc_frm_tbl', '');
//        wp_nonce_field($slug . '_nonce');
//        echo abcfl_html_tag('div','', 'submit' );
//        echo abcfl_input_btn( 'btnTruncateImportTbl', 'btnTruncateImportTbl', 'submit', abcfslc_txta(56), 'button-primary abcficBtnWide' );
//        echo abcfl_html_tag_ends('div,form');
//
//        //Display import table
//        abcfslc_tbls_render_import_tbl();
//    }
//    else{
//        echo abcfl_input_info_lbl( abcfslc_txta(55), 'abcflMTop20', 16, 'SB');
//        echo abcfl_input_info_lbl( abcfslc_txta( 60), 'abcflMTop20', 16, 'SB');
//    }

    //Display import table
    //abcfslc_tbls_render_import_tbl();