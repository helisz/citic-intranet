<?php
function abcfslc_export_optns(){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    if ( isset($_POST['btnCSVSave']) ){

        check_admin_referer( $slug . '_nonce' );
        abcfslc_export_optns_optn_update( $_POST );

        echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
        echo abcfl_html_tag_with_content( abcfslc_txta(27), 'p', '' );
        echo abcfl_html_tag_end('div');
    }
    if ( isset($_POST['btnCSVReset']) ){
        check_admin_referer( $slug . '_nonce' );
        abcfslc_export_optns_optn_reset();
    }

    $opts = abcfslc_autil_export_file_optns();

    abcfslc_export_optns_form( $opts, $slug, true  );
}

function abcfslc_export_optns_form( $opts, $slug ){

    //Wrap START
    echo  abcfl_html_tag('div', '', 'wrap' );
        echo abcfl_html_form( 'frm_csv_export_optns', '');
        wp_nonce_field($slug . '_nonce');

        abcfslc_export_optns_file( $opts );
        abcfslc_export_optns_tplate( $opts['tplateID'] );
        abcfslc_autil_btns_save_reset( false );
    //Wrap END
    echo abcfl_html_tag_ends('form,div');
}
//================================================================

function abcfslc_export_optns_optn_reset() {

    //$optns['delimiter'] =  'tab';
    //delete_option( 'abcfslc_csv_export_optns', $optns, 'no' );
    delete_option( 'abcfslc_csv_export_optns' );
}

function abcfslc_export_optns_optn_update( $post ) {

    //delete_option( 'abcfslc_csv_export_optns' );
    //return;

    $optns['tplateID'] = isset( $post['tplateID'] ) ? $post['tplateID'] : '0';
    $optns['delimiter'] =  isset( $post['delimiter'] ) ? $post['delimiter']  : 'tab';
    $optns['enclosure'] =  isset( $post['enclosure'] ) ? esc_attr( $post['enclosure'] ) : 'Q';
    $optns['escape'] =  isset( $post['escape'] ) ? esc_attr( $post['escape'] ) : '';
    $optns['encoding'] = isset( $post['encoding'] ) ? $post['encoding'] : 'UTF-16LE';
    $optns['img'] = isset( $post['img'] ) ? $post['img'] : 'U';

    //Remove blank values
    $optns = array_filter( $optns );

    update_option( 'abcfslc_csv_export_optns', $optns, 'no' );
}

function abcfslc_export_optns_file( $opts ){
  //------------------------------------------------------------
    echo abcfl_html_tag( 'h3', '', '' );
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(92) . ' - ' . abcfslc_txta(19), abcfslc_aurl(7), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );
    echo abcfl_html_tag_end('h3');
    //------------------------------------------------------------
    $cboD = abcfslc_cbo_delimiter();
    $cboE = abcfslc_cbo_enclosure();
    $cboEncoding = abcfslc_cbo_encoding();
    $cboImg = abcfslc_cbo_img_url();

    $lblE = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfslc_txta(83), abcfslc_aurl(6) );
    $lblI = abcfl_input_lbl_hlp( ABCFSL_ICONS_URL, abcfslc_txta(2), abcfslc_aurl(5) );

    echo abcfl_input_cbo('delimiter', '', $cboD, $opts['delimiter'] , abcfslc_txta(35), abcfslc_txta(70), '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('enclosure', '', $cboE, $opts['enclosure'] , abcfslc_txta(36), abcfslc_txta(72), '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('encoding', '', $cboEncoding, $opts['encoding'] , $lblE, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');


    echo abcfl_input_cbo('img', '', $cboImg, $opts['img'] , $lblI, '', '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

}

function abcfslc_export_optns_tplate( $tplateID ){
    //-------------------------------------
    echo abcfl_input_hline('2', '20', '50P');
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(92) . ' - ' . abcfslc_txta(95), abcfslc_aurl(0), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );

    echo abcfslc_autil_optns_tplate( $tplateID );
}