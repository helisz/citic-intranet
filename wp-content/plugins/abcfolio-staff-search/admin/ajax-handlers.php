<?php
add_action( 'wp_ajax_update_col_order', 'abcfsls_ajax_update_col_order' );
add_action( 'wp_ajax_update_filter_order', 'abcfsls_ajax_update_filter_order' );

function abcfsls_ajax_update_filter_order() {

    if(!$_POST){
        $out = array( 'error' => true, 'error_msg' => 'Error: POST is missing.');
        wp_send_json( $out );
        die();
    }

    $ajaxNonce = isset($_POST['abcfajaxnonce']) ? $_POST['abcfajaxnonce'] : '';
    if ( ! wp_verify_nonce( $ajaxNonce, 'abcfnonce' ) ){
        $out = array( 'error' => true, 'msg' => 'Error: Permissions check failed');
        //echo $out;
        wp_send_json( $out );
        die();
    }

    $defaults = array(
        'order' => array('_0'),
        'postid' => 'ul_0'
     );

    $post = wp_parse_args( $_POST, $defaults );
    $order = $post['order'];
    $postID = str_ireplace( 'ul_', '', $post['postid'] );

    if($order[0] == '_0'){
        $out = array( 'error' => true, 'error_msg' => 'Error: Order is missing.');
        wp_send_json( $out );
        die();
    }

    $fieldOrder = 0;
    $fields = array();

    foreach( $order as $F ) {
        $fieldOrder ++;
        $fields[$fieldOrder] = $F;
    }

    //A passed array will be serialized into a string.
    if(!empty($fields)){
        // Array has duplicates
        if(count(array_unique($fields)) < count($fields)){
            $fieldsU = array_unique($fields);
            $fields = array_combine(range(1, count($fieldsU)), array_values($fieldsU));
        }
        update_post_meta( $postID, '_mfOrder', $fields );
    }

    die();
}

function abcfsls_ajax_update_col_order() {

    if(!$_POST){
        $out = array( 'error' => true, 'error_msg' => 'Error: POST is missing.');
        wp_send_json( $out );
        die();
    }

    $ajaxNonce = isset($_POST['abcfajaxnonce']) ? $_POST['abcfajaxnonce'] : '';
    if ( ! wp_verify_nonce( $ajaxNonce, 'abcfnonce' ) ){
        $out = array( 'error' => true, 'msg' => 'Error: Permissions check failed');
        //echo $out;
        wp_send_json( $out );
        die();
    }

    $defaults = array(
        'order' => array('_0'),
        'postid' => 'ul_0'
     );

    $post = wp_parse_args( $_POST, $defaults );
    $order = $post['order'];
    $postID = str_ireplace( 'ul_', '', $post['postid'] );

    if($order[0] == '_0'){
        $out = array( 'error' => true, 'error_msg' => 'Error: Order is missing.');
        wp_send_json( $out );
        die();
    }

    $fieldOrder = 0;
    $fields = array();

    foreach( $order as $F ) {
        $fieldOrder ++;
        $fields[$fieldOrder] = $F;
    }

    //A passed array will be serialized into a string.
    if(!empty($fields)){
        // Array has duplicates
        if(count(array_unique($fields)) < count($fields)){
            $fieldsU = array_unique($fields);
            $fields = array_combine(range(1, count($fieldsU)), array_values($fieldsU));
        }
        update_post_meta( $postID, '_fieldOrder', $fields );
    }

    die();
}
