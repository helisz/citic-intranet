<?php
add_action( 'wp_ajax_sls_body_tbl_c', 'abcfsls_ajax_sls_body_tbl_c' );
add_action('wp_ajax_nopriv_sls_body_tbl_c', 'abcfsls_ajax_sls_body_tbl_c');

function abcfsls_ajax_sls_body_tbl_c() {

    if( !isset( $_POST['nonce'] ) || !wp_verify_nonce($_POST['nonce'], 'search_categories') ){
        $result = array( 'err' => true,
                        'errMsg' => 'Error: Permissions check failed.');
        wp_send_json( $result );
        die();
    }
    //---------------------------------------
    $defaults = array(
        'tplateID' => '0',
        'staffTplateID' => '0',
        'searchCatSlug' => ''
     );

    $result['type'] = "failure";
    $result['err'] = '';
    $result['errMsg'] = '';
    $result['data'] = '';

    $post = wp_parse_args( $_POST, $defaults );

    if( $post['tplateID'] == 0 ){
        $result = array( 'err' => true, 'errMsg' => 'Error: tplateID is missing.');
        wp_send_json( $result );
        die();
    }

    if($post['staffTplateID'] == 0){
        $result = array( 'err' => true, 'errMsg' => 'Error: staffTplateID is missing.');
        wp_send_json( $result );
        die();
    }

    $tblData = abcfsls_cnt_tbl_c_rows_data_ajax( $post );
    //sleep ( 30 );

    if( empty( $tblData ) ){
        $result['err'] = true;
        $result['errMsg'] = 'No data.';
        wp_send_json( $result );
        die();
    }

    wp_send_json( $tblData );
    die();
}
