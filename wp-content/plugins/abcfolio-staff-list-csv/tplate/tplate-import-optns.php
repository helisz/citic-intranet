<?php
function abcfslc_tplate_import_optns(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    if ( isset($_POST['btnCSVSave']) ){

        check_admin_referer( $slug . '_nonce' );
        //print_r($_POST);
        abcfslc_tplate_import_optns_update( $_POST );
        abcfslc_autil_tplate_import_truncate_tbl();

        echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
        echo abcfl_html_tag_with_content( abcfslc_txta(27), 'p', '' );
        echo abcfl_html_tag_end('div');
    }
    if ( isset($_POST['btnCSVReset']) ){
        check_admin_referer( $slug . '_nonce' );
        abcfslc_tplate_import_optns_reset();
        abcfslc_autil_tplate_import_truncate_tbl();
    }

    //$importStatus = abcfslc_autil_import_status('1', 'x');
    $opts = abcfslc_autil_tplate_import_optns();
    $fileName = $opts['csvFilename'];
    $importStatus = abcfslc_autil_tplate_import_status( $fileName );

    switch ($importStatus){
        case 'FAILED':
            abcfslc_tplate_import_optns_failed( $opts, $slug );
            break;
        case 'IMPORTED':
            abcfslc_tplate_import_optns_imported( $opts, $slug );
            break;
        case 'EMPTY':
        case 'READY':
        case 'NOFILE':
            abcfslc_tplate_import_optns_empty( $opts, $slug );
            break;
       default:
            break;
    }
}

function abcfslc_tplate_import_optns_failed( $opts, $slug ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_tplate_import_optns_form( $opts, $slug, true  );
}

function abcfslc_tplate_import_optns_empty( $opts, $slug ){
    abcfslc_tplate_import_optns_form( $opts, $slug, false );
}

function abcfslc_tplate_import_optns_imported( $opts, $slug ){
    abcfslc_autil_lbls_import_ok_go_to();
    abcfslc_tplate_import_optns_form( $opts, $slug, true );
}

function abcfslc_tplate_import_optns_form( $opts, $slug, $hideButtons ){

    //Wrap START
    echo  abcfl_html_tag('div', '', 'wrap' );
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(93) . ' - ' . abcfslc_txta(10), abcfslc_aurl(3), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );

    echo abcfl_html_form( 'frm_csv_import_optns', '');
    wp_nonce_field($slug . '_nonce');

    abcfslc_tplate_import_optns_select_file_fields( $opts );
    abcfslc_tplate_import_optns_select_file_btn( $hideButtons );

    //echo abcfl_input_hline('2', '20', '50P');
    //abcfslc_tplate_import_optns_delimiter( $opts );

    echo abcfl_input_hline('2', '20', '50P');
    abcfslc_tplate_import_optns_tplate_name( $opts );

    abcfslc_autil_btns_save_reset( $hideButtons );

    //Wrap END
    echo abcfl_html_tag_ends('form,div');
}
//================================================================

function abcfslc_tplate_import_optns_select_file_fields( $opts ){

    echo abcfl_input_txt_readonly('csvFilename', '', esc_attr( $opts['csvFilename'] ), abcfslc_txta_r(13), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt_readonly('csvUrl', '', esc_attr( $opts['csvUrl'] ), abcfslc_txta(14), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt_readonly('csvQFilename', '', esc_attr( $opts['csvQFilename'] ), abcfslc_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_tplate_import_optns_delimiter( $opts ){

    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(19), abcfslc_aurl(4), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );
    //------------------------------------------------------------
    $cboD = abcfslc_cbo_delimiter();
    $cboE = abcfslc_cbo_enclosure();
    echo abcfl_input_cbo('delimiter', '', $cboD, $opts['delimiter'] , abcfslc_txta(35), '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('enclosure', '', $cboE, $opts['enclosure'] , abcfslc_txta(36), '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('escape', '', $cboE, $opts['escape'] , abcfslc_txta(37), '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_tplate_import_optns_tplate_name( $opts ){

    $lbl = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfslc_txta(2), abcfslc_aurl(5) );

    echo abcfl_input_txt('tplateName', '', esc_attr( $opts['tplateName'] ), abcfslc_txta_r(88), '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_tplate_import_optns_select_file_btn( $hideButtons ){

    if( $hideButtons ) { return; }
    echo  abcfl_html_tag('div','','abcflPTop20');
    echo abcfl_input_btn('btnCSVChoose', 'btnCSVChoose', 'button', abcfslc_txta(16), 'button' );
    echo abcfl_html_tag_end('div');
}

function abcfslc_tplate_import_optns_reset() {
    $optns['delimiter'] =  ',';
    update_option( 'abcfslc_tplate_import_optns', $optns, 'no' );
}

function abcfslc_tplate_import_optns_update( $post) {

    //delete_option( 'abcfslc_tplate_import_optns' );
    //return;

    $csvUrl = isset( $post['csvUrl'] ) ? esc_attr( $post['csvUrl'] ) : '';
    $csvFileName = isset( $post['csvFilename'] ) ? esc_attr( $post['csvFilename'] ) : '';
    $csvQFileName = abcfslc_tplate_import_optns_get_file_path( $csvUrl, $csvFileName);

    $tplateName = isset( $post['tplateName'] ) ? $post['tplateName'] : '';
    if(empty( $tplateName )) { $tplateName = 'My Staff Template' ;}

    $optns['csvUrl'] = $csvUrl;
    $optns['csvFilename'] = $csvFileName;
    $optns['csvQFilename'] =  $csvQFileName;
    //$optns['delimiter'] =  isset( $post['delimiter'] ) ? $post['delimiter']  : 'tab';
    //$optns['enclosure'] =  isset( $post['enclosure'] ) ? esc_attr( $post['enclosure'] ) : 'Q';
    //$optns['escape'] =  isset( $post['escape'] ) ? esc_attr( $post['escape'] ) : '';
    $optns['tplateName'] =  $tplateName;

    //Remove blank values
    $optns = array_filter( $optns );

//echo"<pre>", print_r($optns), "</pre>"; die;

    update_option( 'abcfslc_tplate_import_optns', $optns, 'no' );
}

function abcfslc_tplate_import_optns_get_file_path( $csvUrl, $csvFileName) {

    if( empty( $csvUrl ) || empty( $csvFileName ) ){ return ''; }

    $subfolder = abcfslc_dba_cbo_file_folder( $csvUrl );
    if( empty( $subfolder ) ){ return '';}

    $uploadDir = wp_upload_dir();
    $baseDir = $uploadDir['basedir'];

    $fileQName = '';
    if( !empty( $baseDir ) ){
        $fileQName = trailingslashit( $baseDir ) . $subfolder;
    }

    return $fileQName;
}

