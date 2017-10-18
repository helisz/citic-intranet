<?php

//== UPDATE COLUMN ORDER - START ===================================================
//Add new column to meta columns order. If column already exists exit with no updates. Called from save template.
function abcfsls_autil_update_column_order( $tplatID, $hideDelete, $F ){

    if( $hideDelete == 'D' ){ return; }

    $tplateOptns = get_post_custom( $tplatID );
    $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';

    //Check if new meta field exists. Empty or populated.
    if( empty( $fieldOrder ) ){
        abcfsls_autil_add_meta_column_order( $tplatID, '_fieldOrder', $F );
        return;
    }
    abcfsls_autil_update_meta_column_order( $tplatID, '_fieldOrder', $fieldOrder, $F );

}

//No field order yet. Add new option with a single field (first one)
function abcfsls_autil_add_meta_column_order( $postID, $metaFieldName, $F ){
    $metaValue[1] = $F;
    update_post_meta( $postID, $metaFieldName, $metaValue );
}

//Meta field exists.
function abcfsls_autil_update_meta_column_order( $postID, $metaFieldName, $fieldOrder, $F ){

    //Field order exists. Check if field is already present in an array if so exit. Otherwise add a new field and exit.
    $metaDataArray = unserialize( $fieldOrder );

    //Check if field is already in an array. If so exit.
    if (in_array($F, $metaDataArray)) { return; }

    for ( $i = 1; $i <= 10; $i++ ) {
        //Add new field to first available key and exit.
        if(!isset($metaDataArray[$i])){
           $metaDataArray[$i] = $F;
           update_post_meta( $postID, $metaFieldName, $metaDataArray );
           return;
        }
    }
}
//== UPDATE COLUMN ORDER - END =================================================

//== Duplicate template ========================
add_action( 'admin_action_dupslsatplate', 'abcfsls_autil_dup_sls_a_tplate' );

function abcfsls_autil_dup_sls_a_tplate(){

    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'dupslsatplate' == $_REQUEST['action'] ) ) ) {
            wp_die('No post to duplicate has been supplied!');
            exit;
    }

    //get the original post id
    $postID = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);

    $post = get_post( $postID );
    if (!isset( $post )) { wp_die('Post creation failed, could not find original post: ' . $postID); }
    if ($post == null) { wp_die('Post creation failed, could not find original post: ' . $postID); }

    $out = abcfsls_autil_duplicate_template($postID, $post);
    if( $out == 'KO' ){ wp_die('Post creation failed: ' . $postID);}

    wp_redirect( admin_url( 'edit.php?post_type=cptsls_tbl_a' ) );
    exit;
}

//Create a copy of template.
function abcfsls_autil_duplicate_template($postID, $post) {

    $out = 'KO';
    $newTitle = $post->post_title . ' - Copy';
    $postData = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $post->post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'publish',
            'post_title'     => $newTitle,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
    );

    //Duplicate post
    $newPostID = wp_insert_post( $postData );

    if ( is_wp_error( $newPostID ) ) { return $out; }
    if (!$newPostID) { return $out; }

    wp_update_post( array('ID' => $newPostID, 'post_title'   => $newTitle . ' ' . $newPostID ) );

    //Duplicate all post meta.
    abcfsls_dba_duplicate_post_meta( $postID, $newPostID );

   return 'OK';
}

//Generic class + style  section.
function abcfsls_autil_cls_style( $clsName, $clsValue, $styleName, $styleValue, $F,
                                    $addHdr, $hline='', $clsLbl='', $styleLbl='', $clsHelp='',
                                    $styleHelp='', $aurl=8, $customHdrID='' ){

    //$hdr = true; GENERIC header is added to CSS section.
    //$customHdrID=''; CUSTOM header is added to CSS section.
    //$aurl = 0; No ? icon.
    //If field label or text parameter is blank, defaults are shown.

    //Default labels and descriptions
    if ( empty( $clsLbl ) ) { $clsLbl = 53; }
    if ( empty( $styleLbl ) ) { $styleLbl = 54; }
    if ( empty( $clsHelp ) ) { $clsHelp = 51; }
    if ( empty( $styleHelp ) ) { $styleHelp = 52; }

    //Default text of a header.
    $hdrTxt = 35;
    if( !empty( $customHdrID ) ) {
        $addHdr = true;
        $hdrTxt = $customHdrID;
    }

    if( !empty( $hline ) ) { echo abcfl_input_hline( $hline ); }

    //? Icon is added to Header label or Class label.
    $lbl = abcfsls_txta( $clsLbl );
    if( $addHdr ) {
        echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta( $hdrTxt ), abcfsls_aurl( $aurl ) );
    }
    else{
        $lbl = abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta( $clsLbl ), abcfsls_aurl( $aurl ), 'abcflFontWP abcflFontS13 abcflFontW400' );
    }

    echo abcfl_input_txt( $clsName . $F, '', $clsValue, $lbl, abcfsls_txta( $clsHelp ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_input_txt( $styleName . $F, '', $styleValue, abcfsls_txta( $styleLbl ), abcfsls_txta( $styleHelp ), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

function abcfsls_autil_center_yn( $fieldName, $aCenter, $lbl, $hlp ){

    $cboYN = abcfsls_cbo_yn();
    echo abcfl_input_cbo( $fieldName, '',$cboYN, $aCenter, abcfsls_txta($lbl), abcfsls_txta($hlp), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl' );
}