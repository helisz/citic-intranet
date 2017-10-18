<?php
function abcfslc_import_map(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $fileOpts = abcfslc_autil_import_file_optns();
    $tplateID =  $fileOpts['tplateID'];
    $fileName = $fileOpts['csvFilename'];

    //-----------------------------------------------
    if ( isset($_POST['btnCSVSave']) ){
        check_admin_referer( $slug . '_nonce' );
//echo"<pre>", print_r($_POST), "</pre>";
        abcfslc_import_map_optn_update( $_POST, $tplateID );
        abcfslc_autil_truncate_import_tbl();

        echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
        echo abcfl_html_tag_with_content( abcfslc_txta(27), 'p', '' );
        echo abcfl_html_tag_end('div');
    }
    if ( isset($_POST['btnCSVReset']) ){
        check_admin_referer( $slug . '_nonce' );
        abcfslc_import_map_optn_delete( $tplateID);
    }

    //--WRAP START --------------------------------------------
    echo  abcfl_html_tag('div', '', 'wrap' );

    $importStatus = abcfslc_autil_import_status( $tplateID, $fileName  );

    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_map_failed( $tplateID, $fileName, $fileOpts );
            break;
        case 'IMPORTED':
            abcfslc_import_map_imported( $tplateID, $fileName, $fileOpts, $slug );
            break;
        case 'EMPTY':
        case 'READY':
            abcfslc_import_map_empty_ready( $tplateID, $fileName, $fileOpts, $slug );
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

    //--WRAP END --------------------------------------------
    echo abcfl_html_tag_end('div');
}

function abcfslc_import_map_empty_ready( $tplateID, $fileName, $fileOpts, $slug ){
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_import_map_form( $tplateID, $fileOpts, $slug, false );
}

function abcfslc_import_map_imported( $tplateID, $fileName, $fileOpts, $slug ){
    abcfslc_autil_lbls_import_ok_go_to();
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_import_map_form( $tplateID, $fileOpts, $slug, true );
}

function abcfslc_import_map_failed( $tplateID, $fileName, $fileOpts ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    echo abcfslc_import_map_cntr( $tplateID, $fileOpts );
}

function abcfslc_import_map_form( $tplateID, $fileOpts, $slug, $hideButtons ){

    echo abcfl_html_form( 'abcfslc_frm_map', '');
    wp_nonce_field( $slug . '_nonce' );
    echo abcfslc_import_map_cntr( $tplateID, $fileOpts );

    abcfslc_autil_btns_save_reset( $hideButtons );

    echo abcfl_html_tag_end( 'form' );


//$map = abcfslc_map_saved_optns( $tplateID, 'I' );
$map = get_option( 'abcfslc_import_map_' . $tplateID, array() );

//$tplateOptns = get_post_custom( $tplateID );
//echo"<pre>", print_r($map), "</pre>";  //die;
}

//=== MAP CNTR START =========================
function abcfslc_import_map_cntr( $tplateID, $fileOpts ) {

    $tblRows = abcfslc_map_field_rows( $tplateID, 'I', $fileOpts );

    $out = '<table class="abcfTblMap abcfStriped2">';
    $out .= $tblRows;
    $out .= '</table>';

    return $out;
}
//== MAP CNTR END ==========================================

function abcfslc_import_map_optn_update( $post, $tplateID){

    $fieldMap = array();
    foreach ($post as $key => $value) {
        if ( strpos( $key, '_F' ) > 0) { $fieldMap[$key] = $value; }
        switch ($key){
            case 'postTitle':
            case '_sortTxt':
            case '_pretty':
            case '_sPgTitle':
            case '_categories':
            case '_imgUrlL':
            case '_imgUrlS':
            case '_imgLnkL':
            case '_fbookUrl':
            case '_googlePlusUrl':
            case '_twitUrl':
            case '_likedUrl':
            case '_emailUrl':
            case '_socialC1Url':
            case '_socialC2Url':
            case '_socialC3Url':
                $fieldMap[$key] = $value;
                break;
           default:
                break;
        }
    }
    if( isset( $fieldMap['postTitle'] ) ){
        if ( $fieldMap['postTitle'] == 0) { $fieldMap['postTitle'] = 1; }
    }

    update_option( 'abcfslc_import_map_' . $tplateID, $fieldMap, 'no' );
}

function abcfslc_import_map_optn_delete( $tplateID){
    delete_option( 'abcfslc_import_map_' . $tplateID );
}

//select * from wp_options WHERE option_name LIKE 'abcfslc_import_map_%'
//Array
//(
//    [_wpnonce] => 506f5f680d
//    [_wp_http_referer] => /blog/wp-admin/admin.php?page=abcfslc_tabs_import&tab=tabMapping
//    [txt_F1] => 0
//    [txt_F2] => 0
//    [editorCnt_F3] => 0
//    [mp1_F4] => 0
//    [mp2_F4] => 0
//    [mp3_F4] => 0
//    [mp4_F4] => 0
//    [urlTxt_F5] => 0
//    [url_F5] => 0
//    [urlTxt_F6] => 0
//    [url_F6] => 0
//    [url_F7] => 0
//    [txt_F8] => 0
//    [txt_F10] => 0
//    [btnSaveMappings] => Save Changes
//)

