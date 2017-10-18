<?php
//var_dump( $wpdb->last_query );
//echo"<pre>", print_r( $wpdb->last_query ), "</pre>";

//Table C
function abcfsls_db_staff_tplate_member_ids_category( $optns ) {

    global $wpdb;
    $postIDs = false;

    $parentID = $optns['staffTplateID'];
    if( $parentID == 0 ) { return $postIDs; }
    if( empty( $optns['catSlug'] ) ) { return $postIDs; }

    switch ( $optns['catSlug'] ) {
        case 'all' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
                "SELECT ID
                FROM $wpdb->posts
                WHERE post_parent = %d
                AND post_status = 'publish'
                ORDER BY menu_order ASC", $parentID ));
            break;
       default:
            $postIDs = $wpdb->get_col( $wpdb->prepare(
                "SELECT p.ID
                FROM $wpdb->term_relationships tr
                JOIN $wpdb->posts p ON tr.object_id = p.ID
                JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                JOIN $wpdb->terms t ON tt.term_id = t.term_id
                WHERE p.post_parent = %d
                AND t.slug = %s
                AND p.post_status = 'publish'
                ORDER BY p.menu_order ASC", $parentID, $optns['catSlug'] ));
            break;
    }

    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $postIDs );
    //return $postIDs;
}

//Table A
function abcfsls_db_staff_tplate_member_ids( $parentID ){

    global $wpdb;

    //print_r($parentID);

    if( $parentID == 0 ) { return false;}

    $postIDs = $wpdb->get_col( $wpdb->prepare(
    "SELECT ID
    FROM $wpdb->posts
    WHERE post_parent = %d
    AND post_status = 'publish'
    ORDER BY menu_order ASC", $parentID ));

    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $postIDs );
    //$postIDs = abcfsl_db_staff_members_not_hidden( $parentID, $postIDs );
    //var_dump($postIDs);
    //return $postIDs;
}

//== MULTI FILTER PLUS START ===========================

//Menu type: MTF. Filter Multi Filter Plus. Called from: abcfsl_db_staff_member_ids
function abcfsls_db_mf_MFP( $parentID, $scodeCat, $optns, $scodeOrder='ASC' ) {

    //No multi filters. Filtered only by shortcode option Category .//???????????????????
    //$runNoFilters = abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder );
    //$runNoFilters = abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );

$runNoFilters = array();
if ( function_exists( 'abcfsl_db_staff_ids_no_menu' ) ){
    $runNoFilters = abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );
}
else{
    $runNoFilters = abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder );
}

    $totalQty = count( $runNoFilters );
    if( $totalQty == 0 ) { return array(); }

    if( $optns['filtersEmpty'] ) { return $runNoFilters; }
    //-------------------------------------------

    $menu = $optns['menu'];
    $minLen = $optns['menu']['minLen'];

    //--------------------------------
    $runF1 = abcfsls_db_mf_run( $parentID, $menu['filter1Type'], $optns['filters'][1], $menu['filter1Field'], $runNoFilters, $minLen[1] );
    if( $runF1['qty'] == 0 ) { return array(); }

    $runF2 = abcfsls_db_mf_run( $parentID, $menu['filter2Type'], $optns['filters'][2], $menu['filter2Field'], $runF1['postIDs'], $minLen[2] );
    if( $runF2['qty'] == 0 ) { return array(); }

    $runF3 = abcfsls_db_mf_run( $parentID, $menu['filter3Type'], $optns['filters'][3], $menu['filter3Field'], $runF2['postIDs'], $minLen[3] );
    if( $runF3['qty'] == 0 ) { return array(); }

    $runF4 = abcfsls_db_mf_run( $parentID, $menu['filter4Type'], $optns['filters'][4], $menu['filter4Field'], $runF3['postIDs'], $minLen[4] );
    if( $runF4['qty'] == 0 ) { return array(); }

    $runF5 = abcfsls_db_mf_run( $parentID, $menu['filter5Type'], $optns['filters'][5], $menu['filter5Field'], $runF4['postIDs'], $minLen[5] );
    if( $runF5['qty'] == 0 ) { return array(); }

    $runF6 = abcfsls_db_mf_run( $parentID, $menu['filter6Type'], $optns['filters'][6], $menu['filter6Field'], $runF5['postIDs'], $minLen[6] );
    if( $runF6['qty'] == 0 ) { return array(); }

    $postIDsOut = array_intersect( $runNoFilters, $runF6['postIDs'] );
    //return array_intersect( $runNoFilters, $runF6['postIDs'] );

    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $postIDsOut );
}

function abcfsls_db_mf_run( $parentID, $filterType, $filterValue, $filterField, $postIDsIn, $minLen ) {

    $out['postIDs'] = $postIDsIn;
    $out['qty'] = count( $postIDsIn );

    if( !empty( $filterValue ) ){

        $postIDs = abcfsl_db_mf_run_filter_type( $parentID, $filterType, $filterValue, $filterField, $minLen );
        $postIDsOut = array_intersect( $postIDsIn, $postIDs );
        $out['postIDs'] = $postIDsOut;
        $out['qty'] = count( $postIDsOut );
    }

    return $out;
}

//Called from abcfsl_db_mf_run_filter_type
function abcfsls_db_mf_txt( $parentID, $filterField, $filterValue, $minLen ) {

    //Template options. Field to filter not selected.
    if(empty( $filterField )) { return array(); }

    $like = abcfsls_db_sanitize_like( $filterValue, $minLen );
    if(empty( $like )) { return array(); }

    return abcfsls_db_mf_like( $parentID, $filterField, $like );

}

//Called from abcfsl_db_mf_run_filter_type
function abcfsls_db_mf_txt_m( $parentID, $filterFields, $filterValue, $minLen ) {

    //No fields to filter by selected.Aarray contains only empty values
    if(!array_filter( $filterFields, 'trim' ) ) {
        return array();
    }

    $like = abcfsls_db_sanitize_like( $filterValue, $minLen );
    if(empty( $like )) { return array(); }

    $postIDs = array();

    //Run query for each field that is not empty
    foreach ( $filterFields as $key => $filterField ) {
        if( empty( $filterField ) ) { continue; }

        $items = abcfsls_db_mf_like( $parentID, $filterField, $like );

        $postIDs = array_merge ( $postIDs, $items);
    }

    return array_unique( $postIDs );
}

//Called from abcfsl_db_mf_run_filter_type OLD NAME//???????????????????????
function abcfsls_db_mf_drop( $parentID, $filterField, $filterValue ) {

    if(empty( $filterField )) { return array(); }
    if(empty( $filterValue )) { return array();}

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND pm.meta_value = %s", $parentID, $filterField, $filterValue ));

    return isset( $out ) ? $out : array();
}

//Called from abcfsl_db_mf_run_filter_type NEW NAME
function abcfsls_db_mf_drop_not_sorted( $parentID, $filterField, $filterValue ) {

    if(empty( $filterField )) { return array(); }
    if(empty( $filterValue )) { return array();}

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND pm.meta_value = %s", $parentID, $filterField, $filterValue ));

    return isset( $out ) ? $out : array();
}

//------------------------------------------------------
//LIKE filter records.
function abcfsls_db_mf_like( $parentID, $filterField, $like ) {

    //Template options. Field to filter not selected.
    if(empty( $filterField )) { return array(); }

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND pm.meta_value LIKE %s;", $parentID, $filterField, $like ));

    return isset( $out ) ? $out : array();
}

function abcfsls_db_sanitize_like( $filterValue, $minLen ) {

    //????????????? Add message!
    if( $filterValue < $minLen ){
        return '';
    }

    if( $filterValue > 20 ){
        $filterValue = mb_substr( $filterValue, 0, 20);
    }

    $value = $filterValue;
    //$value = strtolower( stripslashes( sanitize_text_field( $filterValue ) ) );
    if ( strpos( $value, 'drop' ) !== false) { return ''; }
    if ( strpos( $value, 'delete' ) !== false) { return ''; }
    if ( strpos( $value, 'update' ) !== false) { return ''; }
    if ( strpos( $value, 'insert' ) !== false) { return ''; }

    global $wpdb;
    $wild = '%';
    $like = $wild . $wpdb->esc_like( $value ) . $wild;

    return $like;
}

//== MULTI FILTER PLUS  END ===========================

