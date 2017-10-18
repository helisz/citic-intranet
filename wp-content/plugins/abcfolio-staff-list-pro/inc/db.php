<?php
//var_dump( $wpdb->last_query );
//echo"<pre>", print_r($optns), "</pre>";
function abcfsl_db_staff_member_ids( $parentID, $optns  ){

    $menuType = $optns['menu']['menuType'];
    $filterField = $optns['menu']['filterField'];
    $qryFilter = $optns['menu']['qryFilter'];
    $first = $optns['menu']['first'];
    $scodeCat = $optns['scodeCat'];
    $scodeOrder = strtoupper($optns['scodeOrder']);

    $postIDs = false;
    switch ( $menuType ) {
        case 'CAT':
            $postIDs = abcfsl_db_staff_ids_menu_cat( $parentID, $scodeCat, $qryFilter, $first, $scodeOrder );
            break;
        case 'AZM':
            $postIDs = abcfsl_db_staff_ids_menu_az( $parentID, $filterField, $scodeCat, $qryFilter, $first, $scodeOrder );
            break;
        case 'MTF':
            $postIDs = abcfsl_db_mf_MTF( $parentID, $scodeCat, $optns, $scodeOrder );
            break;
        case 'MFP':
            $postIDs = abcfsls_db_mf_MFP( $parentID, $scodeCat, $optns, $scodeOrder );
            break;
        default:
            $postIDs = abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );
            break;
    }
    return $postIDs;
}

//== AZ MENU ================================
function abcfsl_db_staff_ids_menu_az( $parentID, $filterField, $scodeCat, $qryFilter, $first, $scodeOrder ) {

    $catsIDs = array();
    $outIDs = array();
    $catFilter = false;
    if( empty( $qryFilter ) ) { $qryFilter = $first; }

    if( !empty( $scodeCat ) ) {
        $catFilter = true;
        //Staff members, filtered by categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat );
    }

    //Show all records
    if( empty( $qryFilter ) ) {

        //All staff members, sorted
        $outIDs = abcfsl_db_staff_ids_sorted_all( $parentID, $scodeOrder );
        if( $catFilter ) {
            //Return only if also included in categories
            $outIDs = array_intersect( $outIDs, $catsIDs );
        }
        return $outIDs;
    }

    //Staff members, filtered by az. Sorted.
    $outIDs = abcfsl_db_staff_ids_sorted_az( $parentID, $filterField, $qryFilter, $scodeOrder );
    if( $catFilter ) {
        //Return only if also included in categories
        $outIDs = array_intersect( $outIDs, $catsIDs );
    }
    return $outIDs;
}

//== CATEGORIES MENU ================================
function abcfsl_db_staff_ids_menu_cat( $parentID, $scodeCat, $qryFilter, $first, $scodeOrder ) {

    $catsIDs = array();
    $outIDs = array();
    $catFilter = false;
    if( empty( $qryFilter ) ) { $qryFilter = $first; }

    if( !empty( $scodeCat ) ) {
        $catFilter = true;
        //Staff members, filtered by categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat );
    }

    //Show all records
    if( empty( $qryFilter ) ) {

        //All staff members, sorted
        $outIDs = abcfsl_db_staff_ids_sorted_all( $parentID, $scodeOrder );
        if( $catFilter ) {
            //Return only if also included in categories
            $outIDs = array_intersect( $outIDs, $catsIDs );
        }
        return $outIDs;
    }

    //Staff members, filtered by az. Sorted.
    $outIDs = abcfsl_db_staff_ids_sorted_cat( $parentID, $qryFilter, $scodeOrder );
    if( $catFilter ) {
        //Return only if also included in categories
        $outIDs = array_intersect( $outIDs, $catsIDs );
    }
    return $outIDs;
}

//Returns all records. Sorted. Shortcode categories filtered. abcfsl_db_staff_ids_all
function abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder ) {

    if( !empty( $scodeCat ) ) {
        //Staff members, filtered by categories. NOT sorted.
        $catsIDs = abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat );

        //All staff members, sorted
        $outIDs = abcfsl_db_staff_ids_sorted_all( $parentID, $scodeOrder );

        //Return only included in categories
        return array_intersect( $outIDs, $catsIDs );

    }

    //All staff members, sorted
    return abcfsl_db_staff_ids_sorted_all( $parentID, $scodeOrder );
}

//Return all records OR record filtererd by shortcode category option.?????????????????????
function abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder='ASC' ) {
    return  abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );
}

//Staff IDs, categories shortcode. NOT sorted.
function abcfsl_db_staff_ids_not_sorted_cats( $parentID, $scodeCat ) {

    if( empty( $scodeCat ) ) { return array(); }

    $scodeCat = str_replace(' ', '', $scodeCat);
    $scodeCat = rtrim(trim($scodeCat), ',');

    //Single category
    if( strpos($scodeCat, ',') === false ){
        return abcfsl_db_staff_ids_not_sorted_cat( $parentID, $scodeCat );
    }

    $catIDs = array();
    $uniqueIDs = array();
    $cats = explode( ',', $scodeCat );

    foreach ( $cats as $catValue ) {
        $catIDs = abcfsl_db_staff_ids_not_sorted_cat( $parentID, $catValue );
        $uniqueIDs = array_unique (array_merge ($uniqueIDs, $catIDs));
    }

    return $uniqueIDs;
}
//== NO MENU, AZ MENU, CATEGORIES MENU == END =========================

//== MULTIFILTER START ===========================
//Menu type: MTF.  Multi filter output.
function abcfsl_db_mf_MTF( $parentID, $scodeCat, $optns, $scodeOrder ) {

    //Shortcode CAT filter. If present, first set is filterd by category.
    $qryType = '';
    if( !empty( $scodeCat ) ) { $qryType = 'CAT'; }

    //First run. No multi filters. Filtered by category if shortcode has a category option.
    //$runNoFilters = abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder );
    $runNoFilters = abcfsl_db_staff_ids_no_menu( $parentID, $scodeCat, $scodeOrder );
    $totalQty = count( $runNoFilters );
    if( $totalQty == 0 ) { return array(); }
    //-------------------------------------------
    if( $optns['filtersEmpty'] ) { return $runNoFilters; }

    //-------------------------------------------
    $filter1Value = $optns['filters'][1];
    $filter2Value = $optns['filters'][2];

    $filter1Type = $optns['menu']['filter1Type'];
    $filter2Type = $optns['menu']['filter2Type'];

    $filter1Field = $optns['menu']['filter1Field'];
    $filter2Field = $optns['menu']['filter2Field'];

    //---------------------------------
    $minLen = 3;
    $runF1 = abcfsl_db_mf_run( $parentID, $filter1Type, $filter1Value, $filter1Field, $runNoFilters, $minLen  );
    if( $runF1['qty'] == 0 ) { return array(); }

    $runF2 = abcfsl_db_mf_run( $parentID, $filter2Type, $filter2Value, $filter2Field, $runF1['postIDs'], $minLen );
    if( $runF2['qty'] == 0 ) { return array(); }

    $postIDsOut = array_intersect( $runNoFilters, $runF2['postIDs'] );
    //return array_intersect( $runNoFilters, $runF2['postIDs'] );

    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $postIDsOut );
}

function abcfsl_db_mf_run( $parentID, $filterType, $filterValue, $filterField, $postIDsIn, $minLen ) {

    //$postIDsIn = all records from the last query.
    //$filterValue = filter to run.
    //Filter value empty = return all records from the last query.
    //Filter not empty = run query.
    //Return only matching records from last query and query in. Dicard others.

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

function abcfsl_db_mf_run_filter_type( $parentID, $filterType, $filterValue, $filterField, $minLen ) {

    $postIDs = array();

    switch ( $filterType ) {
        case 'C' :
            $postIDs = abcfsl_db_staff_ids_not_sorted_cat( $parentID, $filterValue );
            break;
        case 'AZ' :
            $postIDs = abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $filterValue );
            break;
        case 'TXT' :
            $postIDs = abcfsls_db_mf_txt( $parentID, $filterField, $filterValue, $minLen );
            break;
        case 'TXTM' :
            $postIDs = abcfsls_db_mf_txt_m( $parentID, $filterField, $filterValue, $minLen );
            break;
        case 'DROP':
            if ( function_exists( 'abcfsls_db_mf_drop_not_sorted' ) ){
                $postIDs = abcfsls_db_mf_drop_not_sorted( $parentID, $filterField, $filterValue );
            }
            else{
                $postIDs = abcfsls_db_mf_drop($parentID, $filterField, $filterValue );
            }
            break;
       default:
            break;
    }
    return $postIDs;
}
//== MULTIFILTER END ===========================

//== STAFF IDs SQL START =======================
function abcfsl_db_staff_ids_not_sorted_cat( $parentID, $filterValue ) {

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'", $parentID, $filterValue ));

    return isset( $out ) ? $out : array();
}

function abcfsl_db_staff_ids_not_sorted_az( $parentID, $filterField, $filterValue ) {

    if(empty( $filterField )) { return array();}

    global $wpdb;
    $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s", $parentID, $filterField, $filterValue ));

    return isset( $out ) ? $out : array();
}

function abcfsl_db_staff_ids_sorted_all( $parentID, $scodeOrder ) {

    global $wpdb;
    $out = array();

    if( $scodeOrder == 'DESC' ){
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_status = 'publish'
            ORDER BY menu_order DESC", $parentID ));
    }
    else{
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_status = 'publish'
            ORDER BY menu_order ASC", $parentID ));
    }

    $outIDs = isset( $out ) ? $out : array();
    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $outIDs );
}

function abcfsl_db_staff_ids_sorted_az( $parentID, $filterField, $qryFilter, $scodeOrder ) {


    global $wpdb;
    $out =array();
    if( $scodeOrder == 'DESC' ){
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s
            ORDER BY p.menu_order DESC; ", $parentID, $filterField, $qryFilter ));
    }
    else{
        $out = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s
            ORDER BY p.menu_order ASC; ", $parentID, $filterField, $qryFilter ));
    }

    $outIDs = isset( $out ) ? $out : array();
    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $outIDs );
}

function abcfsl_db_staff_ids_sorted_cat( $parentID, $qryFilter, $scodeOrder ) {

    global $wpdb;
    $out = array();

    if( $scodeOrder == 'DESC' ){
    $out = $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'
            ORDER BY p.menu_order DESC", $parentID, $qryFilter ));
    }
    else{
    $out = $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'
            ORDER BY p.menu_order ASC", $parentID, $qryFilter ));
    }

    $outIDs = isset( $out ) ? $out : array();
    //Remove excluded. EXCLUDED
    return abcfsl_db_staff_members_not_hidden( $parentID, $outIDs );
}
//== STAFF IDS SQL END ========================

function abcfsl_db_image_meta( $postID ) {
    global $wpdb;
    $meta = $wpdb->get_col(
    "SELECT meta_value
    FROM $wpdb->postmeta
    WHERE post_id = ' . $postID .
    ' AND meta_key = '_wp_attachment_metadata'");
    return $meta;
}

//-- PRETTY -----------------------------------------
function abcfsl_db_post_id_by_pretty( $metaValue ) {

    if( empty( $metaValue ) ) { return 0; }

    global $wpdb;
    $postID = $wpdb->get_var( $wpdb->prepare(
        "SELECT pm.post_id
        FROM $wpdb->postmeta pm
        JOIN $wpdb->posts p ON  pm.post_id = p.ID
        WHERE p.post_status = 'publish'
        AND pm.meta_key = '_pretty'
        AND pm.meta_value = %s;", $metaValue ) );

    if( is_null($postID) ) { return 0; }
    return $postID;
}

function abcfsl_db_spg_title_by_pretty( $metaValue ) {

    $postID = abcfsl_db_post_id_by_pretty( $metaValue );
    if( is_null($postID) || $postID == 0 ) { return ''; }

    global $wpdb;
    $sPgTitle = $wpdb->get_var( $wpdb->prepare(
            "SELECT meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_sPgTitle'
            AND post_id = %d;", $postID ) );

    return $sPgTitle;
}

function abcfsl_db_staff_member( $staffID ) {

    global $wpdb;
    $postID = $wpdb->get_col( $wpdb->prepare(
        "SELECT ID
        FROM $wpdb->posts
        WHERE ID = %d
        AND post_status = 'publish'", $staffID ));

    return $postID;
}

function abcfsl_db_staff_members_hidden( $parentID ) {

    global $wpdb;

    $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm
            ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_hideSMember'
            AND pm.meta_value = 1", $parentID ));

    return $postIDs;
}

//Get all not hidden.
function abcfsl_db_staff_members_not_hidden( $parentID, $postIDs ) {

    //return $postIDs;

    $postIDsH = abcfsl_db_staff_members_hidden( $parentID );
    //Remove excluded. EXCLUDED
    return array_diff ( $postIDs , $postIDsH );

}

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function abcfsl_db_staff_members_expired( $parentID ) {

    global $wpdb;

    $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts p
            JOIN $wpdb->postmeta pm
            ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = '_expireDT'
            AND pm.meta_value = 1", $parentID ));

    return $postIDs;
}