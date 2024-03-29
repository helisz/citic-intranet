<?php
//var_dump( $wpdb->last_query ); die;
function abcfsl_dba_chidren_qty( $parentID ) {
    global $wpdb;
    return  $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(1) FROM $wpdb->posts WHERE post_parent = %d AND post_type = 'cpt_staff_lst_item' AND post_status != 'trash'", $parentID ) );
}

function abcfsl_dba_duplicate_post_meta( $postID, $newPostID ) {
    //duplicate all post meta just in two SQL queries
    global $wpdb;
    $postMetaInfo = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id= $postID");

    if ( count($postMetaInfo)!= 0 ) {
           $sqlQuery = "INSERT $wpdb->postmeta ( post_id, meta_key, meta_value ) ";
           foreach ($postMetaInfo as $metaInfo) {
                   $metaKey = $metaInfo->meta_key;
                   $metaValue = addslashes($metaInfo->meta_value);
                   $sqlQquerySel[]= "SELECT $newPostID, '$metaKey', '$metaValue'";
           }
           $sqlQuery.= implode(" UNION ALL ", $sqlQquerySel);
           $wpdb->query($sqlQuery);
   }

}

function abcfsl_dba_max_custom_post_id() {
    global $wpdb;
    return  $wpdb->get_var( "SELECT MAX(ID) FROM $wpdb->posts" );
}

function abcfsl_dba_cbo_tplates( $defaultTxt = ' - - - ' ) {
    global $wpdb;
    $cps = array();
    //$cps[0] = abcfsl_txta(244);
    $cps[0] = $defaultTxt;
    $dbRows = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst' AND post_status = 'publish'
        ORDER BY post_title" );
    if ($dbRows) { foreach ($dbRows as $row) {$cps[$row->ID] = $row->post_title;} }
    return $cps;
}

function abcfsl_dba_cbo_menus() {
    global $wpdb;
    $out = array();
    $out[0] = '- - -';
    $rowID = '0';

    $dbRows = $wpdb->get_results( "SELECT ID, post_title, post_type
        FROM $wpdb->posts
        WHERE post_type IN ('cpt_staff_az_menu', 'cpt_staff_lst_menu', 'cpt_staff_mfilter')
        AND post_status = 'publish'
        ORDER BY post_title" );

    if ($dbRows) {
        foreach ($dbRows as $row) {
            switch ( $row->post_type ) {
            case 'cpt_staff_az_menu':
                $rowID = 'AZM-' . $row->ID;
                $out[$rowID] = $row->post_title;
                break;
            case 'cpt_staff_lst_menu':
                $rowID = 'CAT-' . $row->ID;
                $out[$rowID] = $row->post_title;
                break;
            case 'cpt_staff_mfilter':
               $rowID = 'MTF-' . $row->ID;
                $out[$rowID] = $row->post_title;
               break;
            default:
                break;
            }
        }
    }
    $out['SCD-1'] = abcfsl_txta(3);
    return $out;
}


function abcfsl_dba_items_for_order($parentID) {
    global $wpdb;
    $dbRows = $wpdb->get_results( $wpdb->prepare(
    "SELECT ID, post_title, menu_order
    FROM $wpdb->posts
    WHERE post_parent = %d
    AND post_status = 'publish'
    ORDER BY menu_order ASC", $parentID ), OBJECT_K );
    return $dbRows;
}

function abcfsl_dba_get_post_children_ids($parentID) {
    global $wpdb;
    $postIDs = $wpdb->get_col( $wpdb->prepare(
    "SELECT ID
    FROM $wpdb->posts
    WHERE post_parent = %d
    AND post_status = 'publish'", $parentID ));
    return $postIDs;
}

function abcfsl_dba_update_menu_order( $postID, $parentID, $menuOrder ) {
    global $wpdb;
    $wpdb->query($wpdb->prepare(
        "UPDATE $wpdb->posts
        SET menu_order = %d
        WHERE ID = %d AND post_parent = %d", $menuOrder, $postID, $parentID ));
}

function abcfsl_dba_update_menu_order_sort_txt( $parentID ) {

    global $wpdb;
    $result = $wpdb->query("UPDATE $wpdb->posts u
        JOIN (SELECT @row := @row + 1 as MenuOrder, pd.ID
        FROM (SELECT p.ID
        FROM $wpdb->posts p
        JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        WHERE p.post_parent = $parentID
        AND post_status = 'publish'
        AND pm.meta_key = '_sortTxt'
        ORDER BY pm.meta_value) pd, (SELECT @row := 0) d) d2
        ON u.ID = d2.ID
        SET u.menu_order = d2.MenuOrder;");

    if ($result === false){
        echo $wpdb->last_error;
        die;
    }
}





