<?php
function abcfslc_import_optns(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    if ( isset($_POST['btnCSVSave']) ){

        check_admin_referer( $slug . '_nonce' );
        //print_r($_POST);
        abcfslc_import_tab_optns_update( $_POST );
        abcfslc_autil_truncate_import_tbl();

        echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
        echo abcfl_html_tag_with_content( abcfslc_txta(27), 'p', '' );
        echo abcfl_html_tag_end('div');
    }
    if ( isset($_POST['btnCSVReset']) ){
        check_admin_referer( $slug . '_nonce' );
        abcfslc_import_tab_optns_reset();
        abcfslc_autil_truncate_import_tbl();
    }

    $importStatus = abcfslc_autil_import_status('1', 'x');
    $opts = abcfslc_autil_import_file_optns();

    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_optns_failed( $opts, $slug );
            break;
        case 'IMPORTED':
            abcfslc_import_optns_imported( $opts, $slug );
            break;
        case 'EMPTY':
        case 'READY':
            abcfslc_import_optns_empty( $opts, $slug );
            break;
       default:
            break;
    }
}

function abcfslc_import_optns_failed( $opts, $slug ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_import_optns_form( $opts, $slug, true  );
}

function abcfslc_import_optns_empty( $opts, $slug ){
    abcfslc_import_optns_form( $opts, $slug, false );
}

function abcfslc_import_optns_imported( $opts, $slug ){
    abcfslc_autil_lbls_import_ok_go_to();
    abcfslc_import_optns_form( $opts, $slug, true );
}

function abcfslc_import_optns_form( $opts, $slug, $hideButtons ){

    //Wrap START
    echo  abcfl_html_tag('div', '', 'wrap' );
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(91) . ' - ' . abcfslc_txta(10), abcfslc_aurl(4), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );

    echo abcfl_html_form( 'frm_csv_import_optns', '');
    wp_nonce_field($slug . '_nonce');

    abcfslc_import_optns_select_file_fields( $opts );
    abcfslc_import_optns_select_file_btn( $hideButtons );

    echo abcfl_input_hline('2', '20', '50P');
    abcfslc_import_optns_delimiter( $opts );
    echo abcfl_input_hline('1', '20', '50P');
    abcfslc_import_optns_img( $opts );
    abcfslc_import_optns_tplate( $opts['tplateID'] );
    abcfslc_autil_btns_save_reset( $hideButtons );

    //Wrap END
    echo abcfl_html_tag_ends('form,div');
}
//================================================================

function abcfslc_import_optns_select_file_fields( $opts ){

    echo abcfl_input_txt_readonly('csvFilename', '', esc_attr( $opts['csvFilename'] ), abcfslc_txta(13), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt_readonly('csvUrl', '', esc_attr( $opts['csvUrl'] ), abcfslc_txta(14), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt_readonly('csvQFilename', '', esc_attr( $opts['csvQFilename'] ), abcfslc_txta(15), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_import_optns_delimiter( $opts ){

    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(91) . ' - ' . abcfslc_txta(19), abcfslc_aurl(3), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );
    //------------------------------------------------------------
    $cboD = abcfslc_cbo_delimiter();
    $cboE = abcfslc_cbo_enclosure();
    echo abcfl_input_cbo('delimiter', '', $cboD, $opts['delimiter'] , abcfslc_txta(35), '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('enclosure', '', $cboE, $opts['enclosure'] , abcfslc_txta(36), '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('escape', '', $cboE, $opts['escape'] , abcfslc_txta(37), '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_import_optns_tplate( $tplateID ){
    //-------------------------------------
    echo abcfl_input_hline('2', '20', '50P');
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(91) . ' - ' . abcfslc_txta(31), abcfslc_aurl(0), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );

    echo abcfslc_autil_optns_tplate( $tplateID );
}

function abcfslc_import_optns_img( $opts ){

    $cboImg = abcfslc_cbo_img_url();

    $lbl = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfslc_txta(2), abcfslc_aurl(5) );

    echo abcfl_input_cbo('img', '', $cboImg, $opts['img'] , $lbl, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('imgDir', '', esc_attr( $opts['imgDir'] ), abcfslc_txta(86), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfslc_import_optns_select_file_btn( $hideButtons ){

    if( $hideButtons ) { return; }
    echo  abcfl_html_tag('div','','abcflPTop20');
    echo abcfl_input_btn('btnCSVChoose', 'btnCSVChoose', 'button', abcfslc_txta(16), 'button' );
    echo abcfl_html_tag_end('div');
}

function abcfslc_import_tab_optns_reset() {
    $optns['delimiter'] =  ',';
    update_option( 'abcfslc_csv_import_optns', $optns, 'no' );
}

function abcfslc_import_tab_optns_update( $post) {

    //delete_option( 'abcfslc_csv_import_optns' );
    //return;

    $csvUrl = isset( $post['csvUrl'] ) ? esc_attr( $post['csvUrl'] ) : '';
    $csvFileName = isset( $post['csvFilename'] ) ? esc_attr( $post['csvFilename'] ) : '';
    $optns['tplateID'] = isset( $post['tplateID'] ) ? $post['tplateID'] : '0';

    $delimiter = isset( $post['delimiter'] ) ? $post['delimiter']  : ',';
    $enclosure = isset( $post['enclosure'] ) ? esc_attr( $post['enclosure'] ) : '';
    $escape = isset( $post['escape'] ) ? esc_attr( $post['escape'] ) : '';

    $csvQFileName = abcfslc_import_tab_optns_get_file_path( $csvUrl, $csvFileName);

    $optns['csvUrl'] = $csvUrl;
    $optns['csvFilename'] = $csvFileName;
    $optns['csvQFilename'] =  $csvQFileName;
    $optns['delimiter'] =  $delimiter;
    $optns['enclosure'] =  $enclosure;
    $optns['escape'] =  $escape;
    $optns['img'] = isset( $post['img'] ) ? $post['img'] : 'U';
    $optns['imgDir'] =  isset( $post['imgDir'] ) ? esc_attr( $post['imgDir'] ) : '';

    //Remove blank values
    $optns = array_filter( $optns );

    update_option( 'abcfslc_csv_import_optns', $optns, 'no' );
}

function abcfslc_import_tab_optns_get_file_path( $csvUrl, $csvFileName) {

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