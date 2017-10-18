<?php
/*
 * Categories validation
 */

function abcfslc_import_cat(  ){

    $fileOpts = abcfslc_autil_import_file_optns();
    $tplateID =  $fileOpts['tplateID'];
    $fileName = $fileOpts['csvFilename'];

    //--WRAP START --------------------------------
    echo  abcfl_html_tag('div', '', '' );

    $importStatus = abcfslc_autil_import_status( $tplateID, $fileName );
    //$importStatus = 'EMPTY';

    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_cat_failed();
            break;
        case 'IMPORTED':
            abcfslc_import_cat_imported();
            break;
        case 'READY':
            abcfslc_import_cat_ready();
            break;
        case 'EMPTY':
            abcfslc_import_cat_empty();
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
//============================================================
function abcfslc_import_cat_ready(){
    // Category table is loaded and statues updated from import_preview_tbl
    //Show output
    abcfslc_import_cat_show_status();
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(11), abcfslc_aurl(2), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );
    echo abcfslc_import_cat_render_tbl();
}

function abcfslc_import_cat_failed(){
    abcfslc_autil_import_failed_lbls();

    //Create table if doesn't exist
    abcfslc_dba_cat_create_tbl();
    abcfslc_import_cat_render_tbl();
}

function abcfslc_import_cat_imported(){
    abcfslc_autil_lbls_import_ok_go_to();
}
function abcfslc_import_cat_empty(){
   abcfslc_autil_msg_info( abcfslc_txta(57) );

}
//== Check table status  =====================================================

function abcfslc_import_cat_show_status(){

    $status = abcfslc_import_cat_status();

    switch ($status) {
        case 0:
            abcfslc_autil_msg_info( abcfslc_txta(115) );
            break;
        case 1:
            abcfslc_autil_msg_ok( abcfslc_txta(79) );
            break;
        case 2:
            abcfslc_autil_msg_err( abcfslc_txta(80), false );
            break;
        case 3:
            abcfslc_autil_msg_err( abcfslc_txta(81) , false );
            break;
        default:
            break;
    }
}

function abcfslc_import_cat_status(){

    //Create table if doesn't exist
    abcfslc_dba_cat_create_tbl();

    $qty = abcfslc_dba_cat_qty_all();
    $qtyOK  = abcfslc_dba_cat_qty_ok();

    //Empty table
    if( $qty == 0 ) { return 0; }
    //OK
    if( $qtyOK == $qty ) {return 1; }
    //Validation Errors
    if( $qty > $qtyOK ) { return 2; }
    //All categories are invalid
    if(  $qtyOK == 0 ) { return 3; }

}

//== DB TABLE TRUNCATE AND LOAD - START =================

//Called from abcfslc_import_preview_tbl_refresh
function abcfslc_import_cat_tbl_refresh(){

    //abcfslc_dba_cat_drop_tbl();
    //abcfslc_dba_cat_create_tbl();
    abcfslc_dba_cat_truncate_tbl();
    abcfslc_dba_cat_add_items();
    abcfslc_import_cat_tbl_update_statuses();
}

function abcfslc_import_cat_tbl_update_statuses( ){

    $rows = '';
    $iconOK = abcfl_html_img_tag( '', ABCFSLC_ICONS_URL . 'ok.png', 'OK', 'OK', 16, 16, 'abcfslcImgCenter' );
    $iconSomeOK = abcfl_html_img_tag( '', ABCFSLC_ICONS_URL . 'someok.png','Error', 'Error', 16, 16, 'abcfslcImgCenter' );
    $iconKO = abcfl_html_img_tag( '', ABCFSLC_ICONS_URL . 'ko.png','Error', 'Error', 16, 16, 'abcfslcImgCenter' );


    $dbRows = abcfslc_dba_cat_get_tbl();
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {
            abcfslc_import_cat_tbl_update_status( $dbRow->import_id, $dbRow->meta_value, $iconOK, $iconKO, $iconSomeOK );
       }
    }
}

function abcfslc_import_cat_tbl_update_status( $importID, $metaValue, $iconOK, $iconKO, $iconSomeOK ){

    $cats = abcfslc_import_cat_comma_separated_to_array( $metaValue );
    if( empty( $cats ) ) { return '';}

     //print_r( $termID . ' - ');

    $termID = '';
    $exist = 0;
    $notExists = 0;
    $statusIcon = '';
    $status = 0;

    foreach( $cats as $key => $catSlug ) {

        $termID = abcfslc_dba_staff_list_term_exists( $catSlug );
        if( $termID > 0) {
            $exist++;
        }
        else{
           $notExists++;
        }
    }

    if( $exist > 0 && $notExists == 0 ) { $statusIcon = $iconOK; $status = 1; }
    if( $exist > 0 && $notExists > 0 ) { $statusIcon = $iconSomeOK; $status = 2; }
    if( $exist == 0 && $notExists > 0 ) { $statusIcon = $iconKO; $status = 3; }

    abcfslc_dba_cat_update_status( $importID, $status, $statusIcon );

    return $iconKO;
}

function abcfslc_import_cat_comma_separated_to_array( $string ){

    if( empty( $string ) ) { return array('');}

    $vals = explode( ',', $string );

    //Trim whitespace
    foreach( $vals as $key => $val ) { $vals[$key] = trim($val); }

    $vals = array_unique($vals);

    //Return empty array if no items found
    //http://php.net/manual/en/function.explode.php#114273
    return array_diff( $vals, array(''));
}
//== CAT TABLE START  =======================================
function abcfslc_import_cat_render_tbl(){

    $rows = '';
    $dbRows = abcfslc_dba_cat_get_tbl();
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {
            $rows .= abcfslc_import_cat_tbl_row(
                    $dbRow->csv_row_no,
                    $dbRow->meta_value,
                    $dbRow->status_icon
                    );
       }
    }

    $tbl = '<table class="abcfTblImport">';
    $tbl .= abcfslc_import_cat_tbl_head();
    $tbl .= $rows;
    $tbl .= '</table>';

    return $tbl;
}

function abcfslc_import_cat_tbl_head(){

    $out = '<thead><tr>';
    $out .= '<th>' . abcfslc_txta(20) . '</th>';
    $out .= '<th>' . abcfslc_txta(114) . '</th>';
    $out .= '<th>' . abcfslc_txta(78) . '</th>';
    $out .= '</tr></thead>';

  return $out;
}

function abcfslc_import_cat_tbl_row( $rowNo, $metaValue, $status ){

    //$statusIcon = abcfslc_autil_check_categories( $metaValue, $iconOK, $iconKO, $iconSomeOK );

    $out = '';
    $out .= '<td>' . $rowNo .  '</td>';
    $out .= '<td>' . $metaValue .  '</td>';
    $out .= '<td>' . $status .  '</td>';
    $out .= '</tr>';

    return $out;
}
//== CAT TABLE END  ====================================================

//#####################################################


//    if( $qty == 0 ){
//        //echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(115), abcfslc_aurl( 0 ), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop20' );
//        abcfslc_autil_msg_info( abcfslc_txta(115) );
//    }
//    else {
//        //echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(114), abcfslc_aurl( 0 ), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop20' );
//        abcfslc_autil_msg_info( abcfslc_txta(114) );
//    }