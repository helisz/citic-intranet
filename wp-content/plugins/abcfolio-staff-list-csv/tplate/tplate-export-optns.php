<?php
function abcfslc_tplate_export_optns(){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    if ( isset($_POST['btnCSVSave']) ){

        check_admin_referer( $slug . '_nonce' );
        abcfslc_tplate_export_optns_optn_update( $_POST );

        echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
        echo abcfl_html_tag_with_content( abcfslc_txta(27), 'p', '' );
        echo abcfl_html_tag_end('div');
    }
    if ( isset($_POST['btnCSVReset']) ){
        check_admin_referer( $slug . '_nonce' );
        abcfslc_tplate_export_optns_optn_reset();
    }

    $opts = abcfslc_autil_tplate_export_file_optns();

    abcfslc_tplate_export_optns_form( $opts, $slug, true  );
}

function abcfslc_tplate_export_optns_form( $opts, $slug ){

//echo"<pre>", print_r($opts), "</pre>";

    //Wrap START
    echo  abcfl_html_tag('div', '', 'wrap' );
        echo abcfl_html_form( 'frm_csv_export_optns', '');
        wp_nonce_field($slug . '_nonce');

        abcfslc_tplate_export_optns_tplate( $opts['tplateID'] );
        //abcfslc_autil_optns_tplate( $opts['tplateID'] );
        abcfslc_autil_btns_save_reset( false );
    //Wrap END
    echo abcfl_html_tag_ends('form,div');
}

//================================================================
function abcfslc_tplate_export_optns_tplate( $tplateID ){
  //------------------------------------------------------------
    echo abcfl_html_tag( 'h3', '', '' );
    echo abcfl_input_sec_title_hlp( ABCFSLC_ICONS_URL, abcfslc_txta(94) . ' - ' . abcfslc_txta(95), abcfslc_aurl(7), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop10 abcflMBottom20' );
    echo abcfl_html_tag_end('h3');

    $cboTplates = abcfslc_dba_cbo_templates();
    echo abcfl_input_cbo_strings( 'tplateID', '', $cboTplates, $tplateID, abcfslc_txta(17), '', '30%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}


function abcfslc_tplate_export_optns_optn_reset() {

    //$optns['delimiter'] =  'tab';
    //delete_option( 'abcfslc_tplate_export_optns', $optns, 'no' );
    delete_option( 'abcfslc_tplate_export_optns' );
}

function abcfslc_tplate_export_optns_optn_update( $post ) {

    //delete_option( 'abcfslc_tplate_export_optns' );
    //return;

    $optns['tplateID'] = isset( $post['tplateID'] ) ? $post['tplateID'] : '0';

    //Remove blank values
    $optns = array_filter( $optns );

    update_option( 'abcfslc_tplate_export_optns', $optns, 'no' );
}