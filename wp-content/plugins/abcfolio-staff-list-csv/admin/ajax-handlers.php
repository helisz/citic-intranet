<?php
add_action( 'wp_ajax_import_csv', 'abcfslc_ajax_import_csv' );

function abcfslc_ajax_import_csv() {

    update_option( 'abcfslc_imported_qty', 0 );

    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce($_POST['nonce'], 'abcfslc_nonce') ){
        $response['status'] = 'error';
        $response['msg'] = 'Error: Permissions check failed';
        $response['data'] = -1;
        wp_send_json( $response );
        die();
    }

    $post = wp_parse_args( $_POST, array( 'tplateID' => '0' ) );

    if( $post['tplateID'] == 0 ){
        $response['status'] = 'error';
        $response['msg'] = 'Error: Template ID = 0.';
        $response['data'] = -1;
        wp_send_json( $response );
        die();
    }
    //--Copy data from CSV to DB table --------------------------------------
    $tplateID = $post['tplateID'];
    $postID = 1;
    $posts = 0;
    $errMsg = '';

    $dbRows = abcfslc_dba_get_posts_to_insert();

    if ($dbRows) {
        //$qtyToImport = count($dbRows);
        foreach ( $dbRows as $dbRow ) {
            //usleep(500000);
            if( $postID > 0 ){

                $posts++;
                $outInsert = abcfslc_ajax_handlers_import_insert_post( $dbRow->import_id, $dbRow->csv_row_no,  $dbRow->meta_value, $tplateID );
                $postID = $outInsert['postID'];
                $errMsg = $outInsert['errMsg'];

                update_option( 'abcfslc_imported_qty', $posts );
            }
            else {
                break;
            }
       }
    }
    //--------------------------------------------------------
    $response['status'] = 'success';
    $response['msg'] = '';
    $response['data'] = -1;

    if( !empty( $errMsg ) ){
        $response['status'] = 'error';
        $response['msg'] = 'Error: ' . $errMsg;
    }
    else {
        //update_option( 'abcfslc_imported_qty', 0 );
        $response['data'] = 0;
    }

    wp_send_json($response);
    die();
}

add_action( 'wp_ajax_get_import_status', 'abcfslc_ajax_get_import_status' );

function abcfslc_ajax_get_import_status() {

    $qty = get_option( 'abcfslc_import_qty', '0' );
    if( $qty == 0 ) { die( '-1' ); }

    $qtyToImport =   floatval( $qty );
    $qtyImported = floatval( get_option( 'abcfslc_imported_qty', '0' ) );
    $progress =  $qtyImported / $qtyToImport;
    die( $progress );
}
//============================================================

//Add post and post meta for a single CSV row.
function abcfslc_ajax_handlers_import_insert_post( $importID, $csvRowNo, $postTitle, $tplateID ) {

    $out['postID'] = 0;
    $out['errMsg'] = '';
    $rowsAffected = 0;
    $metaUpdated = false;

    $postData = array (
        'comment_status'    => 'closed',
        'ping_status'       => 'closed',
        'post_title'        => $postTitle,
        'post_status'       => 'publish',
        'post_type'         => 'cpt_staff_lst_item',
        'post_parent'  => $tplateID
    );

    //Add post
    $postID = wp_insert_post( $postData, true );

    if ( is_wp_error( $postID ) ) {
        $out['postID'] = 0;
        $out['errMsg'] = $postID->get_error_message();
        return $out;
    }

    //Add post meta
    if ( $postID > 0 ) {
        $rowsAffected = abcfslc_dba_import_add_post_meta( $postID, $importID, $csvRowNo );

        if( $rowsAffected > 0 ) { $metaUpdated = true; }
        if ( !$metaUpdated ) {
            $out['postID'] = 0;
            $out['errMsg'] = 'Error: Meata update failed.';
            return $out;
        }

        //Add categories
        $outStatus = abcfslc_ajax_handlers_add_post_categories( $postID );
        if ( $outStatus == 'KO' ) {
            $out['postID'] = 0;
            $out['errMsg'] = 'Error: Category update failed.';
            return $out;
        }
    }

    $out['postID'] = $postID;
    return $out;
}

function abcfslc_ajax_handlers_add_post_categories( $postID ){

    //Get category string from temp table
    $cats = abcfslc_dba_cat_string_for_terms_insert( $postID );
    if(empty( $cats )) { return 'OK'; }

    //Get category IDs
    $catIDs = abcfslc_ajax_handlers_term_ids_for_terms_insert( $cats );
    if(empty( $catIDs )) { return 'OK'; }

    $catIDs = array_map( 'intval', $catIDs );
    $catIDs = array_unique( $catIDs );
    if(empty( $catIDs )) { return 'OK'; }

    //Add categories for a current staff member
    $addCats = wp_set_object_terms( $postID, $catIDs, 'tax_staff_member_cat', true );

    // There was an error somewhere and the terms couldn't be set.
    if ( is_wp_error( $addCats ) ) {
        return 'KO';
    }
    // Success! These categories were added to the post.
    else {
        return 'OK';
    }

}

function abcfslc_ajax_handlers_cat_comma_separated_to_array( $string ){

    if( empty( $string ) ) { return array('');}

    $vals = explode( ',', $string );
    //Trim whitespace
    foreach( $vals as $key => $val ) { $vals[$key] = trim($val); }

    $vals = array_unique($vals);

    //Return empty array if no items found
    return array_diff( $vals, array(''));
}

function abcfslc_ajax_handlers_term_ids_for_terms_insert( $metaValue ){

    $cats = abcfslc_ajax_handlers_cat_comma_separated_to_array( $metaValue );
    if( empty( $cats ) ) { return '';}

    $termIDs = array();
    foreach( $cats as $key => $catSlug ) {

        $termID = abcfslc_dba_staff_list_term_exists( $catSlug );
        if( $termID > 0) {
            $termIDs[] = $termID;
        }
    }

    return $termIDs;
}



