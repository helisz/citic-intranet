<?php
//Return all records OR record filtererd by shortcode category option.
//function abcfsl_db_mf_run_no_filters( $parentID, $scodeCat, $scodeOrder ) {
//
//    //Shortcode CAT filter. If present, first set is filterd by category.
//    $qryType = '';
//    if( !empty( $scodeCat ) ) { $qryType = 'CAT'; }
//
//    //Array
//    $postIDs = '';
//
//    //global $wpdb;
//    switch ( $qryType ) {
//        case 'CAT' :
//            //$postIDs = abcfsl_db_cat_sorted( $parentID, $scodeCat );
//            $postIDs = abcfsl_db_staff_ids_sorted_cat( $parentID, $scodeCat, $scodeOrder );
//            break;
//        default:
//            $postIDs = abcfsl_db_staff_ids_sorted_all( $parentID, $scodeOrder );
////            $postIDs = $wpdb->get_col( $wpdb->prepare(
////            "SELECT ID
////            FROM $wpdb->posts
////            WHERE post_parent = %d
////            AND post_status = 'publish'
////            ORDER BY menu_order ASC", $parentID ));
//            break;
//    }
//
//    return isset( $postIDs ) ? $postIDs : array();
//}
