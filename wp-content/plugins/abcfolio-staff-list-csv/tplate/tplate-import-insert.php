<?php
function abcfslc_tplate_import_insert(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $opts = abcfslc_autil_tplate_import_optns();
    //$tplateID =  $opts['tplateID'];
    $fileName = $opts['csvFilename'];

    //-----------------------------------------------
    if ( isset($_POST['btnImportTplate']) ){
        check_admin_referer( $slug . '_nonce' );
        //echo"<pre>", print_r($_POST), "</pre>";
        abcfslc_tplate_import_insert_add_tplate( $opts );
    }
    //---------------------------------------------

    //--WRAP START --------------------------------------------
    echo  abcfl_html_tag('div', '', 'wrap' );
    //echo abcfl_input_hidden( 'tplateID', 'tplateID', $tplateID, $renderIfBlank=true );

    $importStatus = abcfslc_autil_tplate_import_status( $fileName );
    switch ($importStatus){
        case 'FAILED':
            abcfslc_tplate_import_insert_failed( $opts, $slug );
            break;
        case 'IMPORTED':
            abcfslc_tplate_import_insert_imported();
            break;
        case 'READY':
            abcfslc_tplate_import_insert_ready( $opts, $slug );
            break;
        case 'EMPTY':
            abcfslc_tplate_import_insert_empty( $opts );
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
    //-- WRAP END --------------------------------------------
    echo abcfl_html_tag_end( 'div' );
}


function abcfslc_tplate_import_insert_ready( $opts, $slug ){
    abcfslc_autil_msg_info( abcfslc_txta(64) );
    abcfslc_tplate_import_insert_btn_start( $slug );
    abcfslc_autil_tplate_import_lbls_optns( $opts );
    abcfslc_tbls_tplate_render_import_tbl();
}

function abcfslc_tplate_import_insert_empty( $opts ){
    abcfslc_autil_msg_info( abcfslc_txta(57) );
    abcfslc_autil_tplate_import_lbls_optns( $opts );
}

function abcfslc_tplate_import_insert_imported(){
    abcfslc_autil_lbls_import_ok_go_to();
}

function abcfslc_tplate_import_insert_failed( $opts, $slug ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_autil_tplate_import_lbls_optns( $opts );
    abcfslc_tplate_import_insert_btn_start( $slug );
    abcfslc_tbls_tplate_render_import_tbl();
}
//----------------------------------------------------------

function abcfslc_tplate_import_insert_btn_start_OLD(){

    //echo '<div id="progressbar" class="abcflWidth50Pc"></div>';
    echo '<div class="abcflWidth50Pc abcflPTop10"><div id="pBarImport"><div class="progress-label"></div></div></div>';

    echo abcfl_html_tag('div','btnImportCSV', 'submit' );
        echo abcfl_html_button( abcfslc_txta(47), 'btnImportTplate', 'button-primary abcficBtnWide' );
    echo abcfl_html_tag_end( 'div' );

    echo abcfl_html_tag( 'div', 'dialog', 'ui-helper-hidden', '', 'title="Import CSV"' );
        echo abcfl_html_tag_with_content( 'Import CSV file to Staff Members?', 'p', '' );
    echo abcfl_html_tag_end( 'div' );

}

function abcfslc_tplate_import_insert_btn_start( $slug ){

        echo abcfl_html_form( 'abcfslc_frm_tbl', '');
        wp_nonce_field($slug . '_nonce');
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnImportTplate', 'btnImportTplate', 'submit', abcfslc_txta(47), 'button-primary abcficBtnWide' );
        echo abcfl_html_tag_ends('div,form');
}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function abcfslc_tplate_import_insert_add_tplate( $opts ){

    $tplateName = $opts['tplateName'];
    $out = abcfslc_tplate_import_insert_create_template( $tplateName );
    $result = wp_parse_args( $out , array( 'tplateID' => 0, 'outErr' => '' ) );

    $tplateID = $result['tplateID'];

    if( $tplateID > 0 ){

        abcfslc_dba_import_tplate_add_postmeta( $tplateID );
        //abcfslc_autil_tplate_import_ok();

    }
    else{

        if( !empty( $out['outErr'] )){
            abcfslc_autil_msg_err( $out['outErr'] );
        }
        else{
            abcfslc_autil_lbl_import_failed();
        }
        return;
    }
}

function abcfslc_tplate_import_insert_create_template( $tplateTitle ) {

    //https://developer.wordpress.org/reference/functions/wp_insert_post/

    $postArr = array (
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'post_title'        => $tplateTitle,
        'post_status'       => 'publish',
        'post_type'         => 'cpt_staff_lst',
    );

    $postID = wp_insert_post( $postArr );

    $out['outErr'] = '';
    $out['tplateID'] = 0;

    if( !is_wp_error( $postID )){
        $out['tplateID'] = $postID;
        return $out;
    }else{
        $out['outErr'] = $postID->get_error_message();
        return $out;
    }

    return $out;
}