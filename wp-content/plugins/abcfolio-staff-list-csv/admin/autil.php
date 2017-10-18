<?php

//== Options START ======================================
function abcfslc_autil_optns_tplate( $tplateID ){

    $cboTplates = abcfslc_dba_cbo_templates();
    return abcfl_input_cbo_strings( 'tplateID', '', $cboTplates, $tplateID, abcfslc_txta(17), '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}



function abcfslc_autil_optns_tplate_OLD( $tplateID ){
    //-------------------------------------
    echo abcfl_input_hline('2', '20', '50P');
//    echo abcfl_html_tag( 'h3', '', '' );
//    echo abcfslc_txta(17);
//    echo abcfl_html_tag_end('h3');
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(17), abcfslc_aurl(0), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );
    //---------------------------------------
    $cboTplates = abcfslc_dba_cbo_templates();
    echo abcfl_input_cbo_strings( 'tplateID', '', $cboTplates, $tplateID, '', '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_autil_import_file_optns(){

   $defaults = array(
    'csvFilename' => '',
    'csvUrl' => '',
    'csvPath' => '',
    'csvQFilename' => '',
    'delimiter' => ',',
    'enclosure' => '',
    'escape' => '',
    'img' => 'U',
    'imgDir' => '',
    'tplateID' => '0'
    );

   return wp_parse_args(get_option( 'abcfslc_csv_import_optns', array() ) , $defaults );
}

function abcfslc_autil_export_file_optns(){

   $defaults = array(
    'delimiter' => 'tab',
    'enclosure' => 'Q',
    'escape' => '',
    'encoding' => 'UTF-16LE',
    'img' => 'U',
    'tplateID' => '0'
    );

   return wp_parse_args(get_option( 'abcfslc_csv_export_optns', array() ) , $defaults );
}

//-------------------------------------------------
function abcfslc_autil_tplate_import_optns(){

   $defaults = array(
    'csvFilename' => '',
    'csvUrl' => '',
    'csvPath' => '',
    'csvQFilename' => '',
    'delimiter' => 'tab',
    'enclosure' => 'Q',
    'escape' => '',
    'encoding' => 'UTF-8',
    'tplateName' => ''
    );

   return wp_parse_args(get_option( 'abcfslc_tplate_import_optns', array() ) , $defaults );
}

function abcfslc_autil_tplate_export_file_optns(){

   $defaults = array(
    'delimiter' => 'tab',
    'enclosure' => 'Q',
    'escape' => '',
    'encoding' => 'UTF-8',
    'tplateID' => '0'
    );

   return wp_parse_args( get_option( 'abcfslc_tplate_export_optns', array() ) , $defaults );
}

//== Options Form END ======================================

function abcfslc_autil_btns_save_reset( $hideButtons ){

    if( $hideButtons ) { return; }
    echo abcfl_input_hline('2', '20', '50P');
    echo abcfl_html_tag('div','', 'submit abcflFloatL' );
    echo abcfl_input_btn( 'btnCSVSave', 'btnCSVSave', 'submit', abcfslc_txta(23), 'button-primary abcficBtnWide' );
    echo abcfl_html_tag_end('div');

   echo abcfl_html_tag('div','', 'submit abcflFloatL abcflPLeft40' );
   echo abcfl_input_btn( 'btnCSVReset', 'btnCSVReset', 'submit', abcfslc_txta(32), 'button-primary abcficBtnWide' );
   echo abcfl_html_tag_end('div');

   echo abcfl_html_tag_cls( 'div', 'abcflClr', true );
}

//== Labels START ======================================================
function abcfslc_autil_lbl_tplate($tplateID){
    $tplateName = abcfslc_dba_template_name( $tplateID );
    echo abcfl_input_info_lbl( abcfslc_txta(31) . ': <span class="abcflFontW400 abcflBlack">' . $tplateName . '</span>', 'abcflMTop10', 14, 'B');
}

function abcfslc_autil_lbls_file_tplate( $tplateID, $fileName ){
    $tplateName = abcfslc_dba_template_name( $tplateID );
    echo abcfl_input_info_lbl( abcfslc_txta(30) . ': <span class="abcflFontW400 abcflBlack">' . $fileName . '</span>&nbsp; &nbsp;&nbsp;&nbsp;' .
            abcfslc_txta(31) . ': <span class="abcflFontW400 abcflBlack">' . $tplateName . '</span> ', 'abcflMTop10', 14, 'B');
}

function abcfslc_autil_lbl_import_failed(){
    abcfslc_autil_msg_err( abcfslc_txta(58), false );
}

function abcfslc_autil_lbl_import_ok(){
    abcfslc_autil_msg_ok( abcfslc_txta(55) . ' ' . abcfslc_txta(60) );
}

function abcfslc_autil_lbls_import_ok_go_to(){
    abcfslc_autil_msg_info( abcfslc_txta(55) . ' ' . abcfslc_txta(59));
}

function abcfslc_autil_import_failed_lbls(){
    abcfslc_autil_lbl_import_failed();
    echo abcfl_input_hline('2', '15', '50P');
}

function abcfslc_autil_tplate_import_file_no_match( $hline=false ){
    abcfslc_autil_msg_err( abcfslc_txta(89) . ' ' .  abcfslc_txta(90), false );
    if( $hline ){ echo abcfl_input_hline('2', '15', '50P'); }
}

function abcfslc_autil_tplate_import_ok(){
    abcfslc_autil_msg_ok( abcfslc_txta(55) . ' ' . abcfslc_txta(60) );
}
//--------------------------------------------------
function abcfslc_autil_err_export_tbl_empty(){
    abcfslc_autil_msg_err( abcfslc_txta(74));
}
function abcfslc_autil_err_no_template(){
    abcfslc_autil_msg_err( abcfslc_txta(62) );
}

function abcfslc_autil_err_no_file(){
    abcfslc_autil_msg_err( abcfslc_txta(65) );
}

function abcfslc_autil_err_file_not_readable( $filename ){
    abcfslc_autil_msg_err( abcfslc_txta(69) .  $filename);
}

function abcfslc_autil_msg_err( $msg, $die=true ){
    echo abcfl_html_tag('div','', 'notice notice-error' );
    echo abcfl_html_tag_with_content( $msg, 'p', '' );
    echo abcfl_html_tag_end('div');
    if( $die ){ die; }
}

function abcfslc_autil_msg_ok( $msg, $die=false ){
    echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
    echo abcfl_html_tag_with_content( $msg, 'p', '' );
    echo abcfl_html_tag_end('div');
    if( $die ){ die; }
}

function abcfslc_autil_msg_info( $msg, $die=false ){
    echo abcfl_html_tag('div','abcfslcInfo', 'abcfslcNotice abcfslcNoticeInfo' );
    echo abcfl_html_tag_with_content( $msg, 'p', '' );
    echo abcfl_html_tag_end('div');
    if( $die ){ die; }
}

//== Labels END ======================================================
function abcfslc_autil_truncate_import_tbl(){
    abcfslc_dba_import_truncate_tbl();
    abcfslc_dba_cat_truncate_tbl();
    update_option( 'abcfslc_import_qty', 0 );
    update_option( 'abcfslc_imported_qty', 0 );
}

function abcfslc_autil_export_status( $tplateID ){

    if( $tplateID == 0 ) { return 'NOTEMPLATE'; }
    $qty = abcfslc_dba_export_qty_to_export();
    if( $qty == 0 ) { return 'EMPTY'; }

    return 'READY';
}

function abcfslc_autil_import_status( $tplateID, $fileName ){

    $qtyNotImported = abcfslc_dba_qty_not_imported();
    $qtyImported = abcfslc_dba_qty_imported();
    $qtyAll = abcfslc_dba_qty_import_all();

    if( $qtyImported > 0 && $qtyNotImported == 0 ) { return 'IMPORTED'; }
    if( empty( $fileName ) ) { return 'NOFILE'; }
    if( $tplateID == 0 ) { return 'NOTEMPLATE'; }
    if( $qtyAll == 0 ) { return 'EMPTY'; }
    if( $qtyAll > 0 && $qtyAll == $qtyNotImported ) { return 'READY'; }
    if( $qtyImported > 0 && $qtyNotImported > 0 ) { return 'FAILED'; }

    return 'UNKNOWN';
}

function abcfslc_autil_import_status_print(){

    $qtyNotImported = abcfslc_dba_qty_not_imported();
    $qtyImported = abcfslc_dba_qty_imported();
    $qtyAll = abcfslc_dba_qty_import_all();

    if( $qtyAll == 0 ) { print_r('EMPTY'); return 'EMPTY'; }
    if( $qtyAll > 0 && $qtyAll == $qtyNotImported ) {print_r('READY'); return 'READY'; }
    if( $qtyImported > 0 && $qtyNotImported > 0 ) {print_r('FAILED'); return 'FAILED'; }
    if( $qtyImported > 0 && $qtyNotImported == 0 ) { print_r('IMPORTED'); return 'IMPORTED'; }

//print_r('UNKNOWN');

    return 'UNKNOWN';
}
//=======================================================

//compare two PHP arrays by key
//http://stackoverflow.com/questions/6252679/compare-two-php-arrays-by-key
function abcfslc_autil_keys_are_equal( $array1, $array2 ) {
  $out = !array_diff_key($array1, $array2) && !array_diff_key($array2, $array1);

  return $out;

//  if($out){ return 'OK';}
//  else { return 'KO';}
}

//Returns true (an empty array) if all $check keys exist in $all
function abcfslc_autil_has_all_keys( $check, $all ) {

    $out = false;
    $check = array_filter($check); //remove empty
    //$diff = array_diff_key( $check, $all );
    $diff = array_filter( array_diff_key( $check, $all ) );
    if ( empty($diff) ) { $out = true; }
    return $out;
}

function abcfslc_input_cbo_form($fldID, $fldName, $values, $selected, $lblTxt='', $hlpTxt='', $size='', $isInt=true, $cls='', $style='',  $clsCntr='', $clsLbl='', $clsHlpUnder='') {

    $cboOptions = abcfl_input_cbo_get_options($values, $selected);
    $optns = abcfl_input_get_options( $fldID, $fldName, $lblTxt, $hlpTxt, $size, $cls, $style, $clsCntr, $clsLbl,  $clsHlpUnder);
    extract( $optns );

    return  $fldCntrDivS . $fldLblDiv . '<select' . $id . 'type="text"' . $cls . $style . $fldName . ' >' . $cboOptions . '</select>' . $hlpUnder . '</div>';
}

//-----------------------------------------------------
//Check for plugin updates
function abcfslc_autil_filter_update_checks($queryArgs) {

    $key = abcfl_autil_get_licence_key('abcfslc_optns');
    if ( !empty($key) ) { $queryArgs['license_key'] = $key; }
    return $queryArgs;
}

//== CAT ================================================

function abcfslc_autil_check_categories( $metaValue, $iconOK, $iconKO, $iconSomeOK ){

    $cats = abcfslc_autil_comma_separated_to_array( $metaValue );
    if( empty( $cats ) ) { return '';}

     //print_r( $termID . ' - ');

    $termID = '';
    $exist = 0;
    $notExists = 0;

    foreach( $cats as $key => $catSlug ) {

        $termID = abcfslc_dba_staff_list_term_exists( $catSlug );
        if( $termID > 0) {
            $exist++;
        }
        else{
           $notExists++;
        }
    }

    if( $exist > 0 && $notExists == 0 ) { return $iconOK; }
    if( $exist > 0 && $notExists > 0 ) { return $iconSomeOK; }
    if( $exist == 0 && $notExists > 0 ) { return $iconKO; }

    return $iconKO;
}

function abcfslc_autil_comma_separated_to_array( $string ){

    if( empty( $string ) ) { return array('');}

    $vals = explode( ',', $string );

    //Trim whitespace
    foreach( $vals as $key => $val ) { $vals[$key] = trim($val); }

    //Return empty array if no items found
    //http://php.net/manual/en/function.explode.php#114273
    return array_diff( $vals, array(''));
}
//== CAT END ========================================

function abcfslc_autil_tplate_import_truncate_tbl(){

    abcfslc_dba_import_tplate_create_tbl();
    abcfslc_dba_import_tplate_truncate_tbl();

//    update_option( 'abcfslc_tplate_import_qty', 0 );
//    update_option( 'abcfslc_tplate_imported_qty', 0 );

}

function abcfslc_autil_tplate_import_status( $fileName ){

    abcfslc_dba_import_tplate_create_tbl();

    $qtyNotImported = abcfslc_dba_import_tplate_qty_not_imported();
    $qtyImported = abcfslc_dba_import_tplate_qty_imported();
    $qtyAll = abcfslc_dba_import_tplate_qty_import_all();

    if( $qtyImported > 0 && $qtyNotImported == 0 ) { return 'IMPORTED'; }
    if( empty( $fileName ) ) { return 'NOFILE'; }
    //if( $tplateID == 0 ) { return 'NOTEMPLATE'; }
    if( $qtyAll == 0 ) { return 'EMPTY'; }
    if( $qtyAll > 0 && $qtyAll == $qtyNotImported ) { return 'READY'; }
    if( $qtyImported > 0 && $qtyNotImported > 0 ) { return 'FAILED'; }

    return 'UNKNOWN';
}

function abcfslc_autil_tplate_import_lbls_optns( $opts ){

    echo abcfl_input_info_lbl( abcfslc_txta(30) . ': <span class="abcflFontW400 abcflBlack">' . $opts['csvFilename'] . '</span>&nbsp; &nbsp;&nbsp;&nbsp;</span> ', 'abcflMTop10', 14, 'B');
    echo abcfl_input_info_lbl( abcfslc_txta(88) . ': <span class="abcflFontW400 abcflBlack">' . $opts['tplateName'] . '</span>&nbsp; &nbsp;&nbsp;&nbsp;</span> ', 'abcflMTop10', 14, 'B');
}