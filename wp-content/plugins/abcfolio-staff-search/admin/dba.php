<?php
function abcfsls_dba_cbo_staff_tplates() {
    global $wpdb;
    $cps = array();
    $cps[0] = '- - -';
    $dbRows = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst' AND post_status = 'publish'
        ORDER BY post_title" );
    if ($dbRows) { foreach ($dbRows as $row) {$cps[$row->ID] = $row->post_title;} }
    return $cps;
}

function abcfsls_dba_duplicate_post_meta( $postID, $newPostID ) {
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

function abcfsls_dba_cbo_category_menus() {

    global $wpdb;
    $out = array();
    $out[0] = '- - -';

    $dbRows = $wpdb->get_results( "SELECT ID, post_title
        FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst_menu'
        AND post_status = 'publish'
        ORDER BY post_title" );

    if ($dbRows) {
        foreach ($dbRows as $row) {$out[$row->ID] = $row->post_title;}
    }

    return $out;
}