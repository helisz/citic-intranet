<?php
function abcfslc_export_map(  ){

    $obj = ABCFSLC_Main();
    $slug = $obj->pluginSlug;

    $fileOpts = abcfslc_autil_export_file_optns();
    $tplateID =  $fileOpts['tplateID'];
    //-----------------------------------------------
    if ( isset($_POST['btnCSVSave']) ){
        check_admin_referer( $slug . '_nonce' );
//echo"<pre>", print_r($_POST), "</pre>";
        abcfslc_export_map_optn_update( $_POST, $tplateID );

        echo abcfl_html_tag('div','', 'notice notice-success is-dismissible' );
        echo abcfl_html_tag_with_content( abcfslc_txta(27), 'p', '' );
        echo abcfl_html_tag_end('div');
    }

    if ( isset($_POST['btnCSVReset']) ){
        check_admin_referer( $slug . '_nonce' );
        abcfslc_export_map_optn_delete( $tplateID );
    }

    //Cntr START ----------------
    echo  abcfl_html_tag('div', '', 'abcflMTop10 abcflMBottom20 abcflMLeft40' );

    $exportStatus = abcfslc_autil_export_status( $tplateID );
    switch ($exportStatus){
        case 'NOTEMPLATE':
            abcfslc_autil_err_no_template();
            break;
       default:
            abcfslc_export_map_ok( $tplateID, $slug );
            break;
    }

    //Cntr END --------------------
    echo abcfl_html_tag_ends('div');
}

function abcfslc_export_map_ok( $tplateID, $slug ){
    abcfslc_autil_lbl_tplate( $tplateID );
    abcfslc_export_map_form( $tplateID, $slug );
}

function abcfslc_export_map_form( $tplateID, $slug ){

    echo abcfl_html_form( 'abcfslc_frm_map', '');
    wp_nonce_field( $slug . '_nonce' );
    abcfslc_export_map_cntr( $tplateID );
    abcfslc_autil_btns_save_reset( false );
    echo abcfl_html_tag_end( 'form' );
}

//=== CHECKBOXES START =========================
function abcfslc_export_map_cntr( $tplateID ) {

    $valueTA = '0';
    //$optns = abcfslc_map_saved_optns( $tplateID, 'E' );
    //    if (isset($optns['abcfslcToggleAll'])) {
    //     $valueTA = '1';
    //    }

    $toggle = abcfslc_map_row_bldr_export( 'Toggle All', '', 'abcfslcToggleAll', $valueTA );

    echo abcfl_input_info_lbl( abcfslc_txta(67), 'abcflMTop20', 16, 'SB');
    echo $toggle;

    echo abcfl_input_hline('2', '10', '50P');

    $rows = abcfslc_map_field_rows( $tplateID, 'E' );

    echo abcfl_html_tag('div','', '' );
    echo $rows;
    echo abcfl_html_tag_end('div');
}
//== CHECKBOXES END ==========================================

//=========================================================
function abcfslc_export_map_optn_update( $post, $tplateID ){

//echo"<pre>", print_r('--- POST ---'), "</pre>";
//echo"<pre>", print_r($post), "</pre>";

    $fieldsOnly = array();
    foreach ( $post as $key => $value ) {

        if ( strpos( $key, '_F' ) > 0) { $fieldsOnly[$key] = '1'; }

        switch ($key){
            case 'abcfslcToggleAll':
            case '_sortTxt':
            case '_pretty':
            case '_sPgTitle':
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
            case '_categories':
            case '_overTxtI1':
            case '_overTxtI2':
                $fieldsOnly[$key] = '1';
                break;
           default:
                break;
        }
        //print_r($key . ' - ');

        $fieldsOnly['postID'] = '1';
        $fieldsOnly['postTitle'] = '1';
    }
    update_option( 'abcfslc_export_map_' . $tplateID, $fieldsOnly, 'no' );
}

function abcfslc_export_map_optn_delete( $tplateID){
    $defaults = array(
    'postID' => '1',
    'postTitle' => '1'
    );

    delete_option( 'abcfslc_export_map_' . $tplateID );
    update_option( 'abcfslc_export_map_' . $tplateID, $defaults, 'no' );
}

//#####################################################
//-- $fieldID -----------------
//postTitle
//_txt_F1
//_txt_F2
//_editorCnt_F3
//_mp1_F4
//_mp2_F4
//_mp3_F4
//_mp4_F4
//_urlTxt_F5
//_url_F5
//_urlTxt_F6
//_url_F6
//_url_F7
//_txt_F8
//_txt_F10
//_txt_F11
//_sortTxt
//_imgUrlL
//_imgUrlS
//_imgLnkL
//_fbookUrl
//_googlePlusUrl
//_twitUrl
//_likedUrl
//_emailUrl
//_socialC1Url
//_socialC2Url
//_socialC3Url1

