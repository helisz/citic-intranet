<?php
//var_dump( $wpdb->last_query );

//== EXPORT TEMPLATE START ==================================
function abcfslc_dba_export_tplate_add_meta( $tplateID ) {
    //duplicate all post meta just in two SQL queries
    global $wpdb;
    $postMetaInfo = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id= $tplateID");

    if ( count($postMetaInfo)!= 0 ) {
           $sqlQuery = "INSERT $wpdb->abcfslc_export_tplate ( meta_key, meta_value ) ";
           foreach ($postMetaInfo as $metaInfo) {
                   $metaKey = $metaInfo->meta_key;
                   $metaValue = addslashes( $metaInfo->meta_value );
                   $sqlQquerySel[]= "SELECT '$metaKey', '$metaValue'";
           }
           $sqlQuery.= implode(" UNION ALL ", $sqlQquerySel);
           $wpdb->query($sqlQuery);
   }
}

function abcfslc_dba_export_tplate_delete_meta_keys() {

    abcfslc_dba_export_tplate_delete_meta_row( '_pImgIDL' );
    abcfslc_dba_export_tplate_delete_meta_row( '_pImgIDS' );
    abcfslc_dba_export_tplate_delete_meta_row( '_pImgUrlL' );
    abcfslc_dba_export_tplate_delete_meta_row( '_pImgUrlS' );

    abcfslc_dba_export_tplate_delete_meta_row( '_edit_lock' );
    abcfslc_dba_export_tplate_delete_meta_row( '_edit_last' );
    abcfslc_dba_export_tplate_delete_meta_row( '_wp_old_slug' );
    //abcfslc_dba_export_tplate_delete_meta_row( '' );
}

function abcfslc_dba_export_tplate_delete_meta_row( $key ) {
   global $wpdb;
   $wpdb->query( "DELETE FROM $wpdb->abcfslc_export_tplate WHERE meta_key = '$key'" );
}

function abcfslc_dba_export_tplate_get_tbl() {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT * FROM $wpdb->abcfslc_export_tplate
        ORDER BY export_id, meta_key", OBJECT_K );
    return $dbRows;
}

function abcfslc_dba_export_tplate_qty() {

    global $wpdb;
    return $wpdb->get_var( "SELECT COUNT(1) FROM $wpdb->abcfslc_export_tplate" );
}

function abcfslc_dba_export_tplate_data() {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT export_id, meta_key, meta_value
        FROM $wpdb->abcfslc_export_tplate
        ORDER BY export_id, meta_key");

//var_dump( $wpdb->last_query );

    return $dbRows;
}

//-----------------------------------------------
function abcfslc_dba_export_tplate_create_tbl() {

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    global $charset_collate;

    $tblExportTpalte = $wpdb->abcfslc_export_tplate;

    if( $wpdb->get_var("SHOW TABLES LIKE '$tblExportTpalte'") != $tblExportTpalte ) {
        $sql = "CREATE TABLE " . $tblExportTpalte . " (
            export_id int unsigned NOT NULL AUTO_INCREMENT,
            meta_key varchar(255) NOT NULL,
            meta_value longtext,
            PRIMARY KEY  (export_id)
            ) $charset_collate;";
        dbDelta($sql);
     }
}

function abcfslc_dba_export_tplate_truncate_tbl(){
    global $wpdb;
    $sql = "TRUNCATE TABLE $wpdb->abcfslc_export_tplate";
    $wpdb->query($sql);
}

function abcfslc_dba_export_tplate_drop_tbl(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS $wpdb->abcfslc_export_tplate";
    $wpdb->query($sql);
}
//== EXPORT TEMPLATE END ===============================

//== IMPORT TEMPLATE START =============================
function abcfslc_dba_import_tplate_add_row( $parDB ) {

    global $wpdb;
    $wpdb->query($wpdb->prepare(
            "INSERT $wpdb->abcfslc_import_tplate ( export_id, post_id, meta_key, meta_value )
            VALUES (%d, %d, %s, %s)",
            $parDB['export_id'],
            $parDB['post_id'],
            $parDB['meta_key'],
            $parDB['meta_value'] ));
}

function abcfslc_dba_import_tplate_get_tbl() {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT * FROM $wpdb->abcfslc_import_tplate
        ORDER BY import_id, meta_key", OBJECT_K );
    return $dbRows;
}

function abcfslc_dba_import_tplate_add_postmeta( $tplateID ) {

    global $wpdb;

    $wpdb->query($wpdb->prepare(
            "UPDATE $wpdb->abcfslc_import_tplate
            SET post_id = %d;", $tplateID));

    $wpdb->query("INSERT $wpdb->postmeta
            (post_id, meta_key, meta_value)
            SELECT post_id, meta_key, meta_value
            FROM $wpdb->abcfslc_import_tplate;");
}




//-----------------------------------------
function abcfslc_dba_import_tplate_qty_not_imported() {

    global $wpdb;
    return $wpdb->get_var(  "SELECT count(1) FROM $wpdb->abcfslc_import_tplate WHERE post_id = 0" );
}

function abcfslc_dba_import_tplate_qty_imported() {

    global $wpdb;
    return $wpdb->get_var( "SELECT count(1) FROM $wpdb->abcfslc_import_tplate WHERE post_id > 0" );
}

function abcfslc_dba_import_tplate_qty_import_all() {

    global $wpdb;
    return $wpdb->get_var( "SELECT count(1) FROM $wpdb->abcfslc_import_tplate" );
}

//-----------------------------------------------
function abcfslc_dba_import_tplate_create_tbl() {

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    global $charset_collate;

    $tblExportTpalte = $wpdb->abcfslc_import_tplate;

    if( $wpdb->get_var("SHOW TABLES LIKE '$tblExportTpalte'") != $tblExportTpalte ) {
        $sql = "CREATE TABLE " . $tblExportTpalte . " (
            import_id int NOT NULL AUTO_INCREMENT,
            export_id int NOT NULL,
            post_id int NOT NULL,
            meta_key varchar(255) NOT NULL,
            meta_value longtext,
            PRIMARY KEY  (import_id)
            ) $charset_collate;";
        dbDelta($sql);
     }
}

function abcfslc_dba_import_tplate_drop_tbl(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS $wpdb->abcfslc_import_tplate";
    $wpdb->query($sql);
}

function abcfslc_dba_import_tplate_truncate_tbl(){
    global $wpdb;
    $sql = "TRUNCATE TABLE $wpdb->abcfslc_import_tplate";
    $wpdb->query($sql);
}



//== IMPORT TEMPLATE END =============================
//
//== EXPORT START ======================================
function abcfslc_dba_export_create_tbl() {

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    global $wpdb;
    global $charset_collate;

    $tblImport = $wpdb->abcfslc_export_csv;

    if( $wpdb->get_var("SHOW TABLES LIKE '$tblImport'") != $tblImport ) {
        $sql = "CREATE TABLE " . $tblImport . " (
            import_id int unsigned NOT NULL AUTO_INCREMENT,
            post_id bigint(20) unsigned NOT NULL,
            sl_field_name varchar(200) NOT NULL DEFAULT '-',
            meta_value longtext,
            meta_key varchar(255) NOT NULL,
            field_order int unsigned NOT NULL,
            PRIMARY KEY  (import_id)
            ) $charset_collate;";
        dbDelta($sql);
     }
}

function abcfslc_dba_export_truncate_tbl(){
    global $wpdb;
    $sql = "TRUNCATE TABLE $wpdb->abcfslc_export_csv";
    $wpdb->query($sql);
}

//Add POSTS
function abcfslc_dba_export_add_posts_to_tbl_OK( $tplateID ) {
    global $wpdb;
    $wpdb->query($wpdb->prepare("INSERT $wpdb->abcfslc_export_csv
            (post_id, sl_field_name, meta_value, meta_key, field_order)
            SELECT ID, 'Post Title', post_title, 'postTitle', 0
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_type = 'cpt_staff_lst_item'
            AND post_status = 'publish'
            ORDER BY ID;", $tplateID));

    $wpdb->query( "UPDATE $wpdb->abcfslc_export_csv
        SET csv_row_no = import_id;" );
}

function abcfslc_dba_export_add_posts_to_tbl( $tplateID ) {
    global $wpdb;
    $wpdb->query($wpdb->prepare("INSERT $wpdb->abcfslc_export_csv
            (post_id, sl_field_name, meta_value, meta_key, field_order)
            SELECT ID, 'Post ID', ID, 'postID', 0
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_type = 'cpt_staff_lst_item'
            AND post_status = 'publish'
            ORDER BY ID;", $tplateID));

    $wpdb->query($wpdb->prepare("INSERT $wpdb->abcfslc_export_csv
            (post_id, sl_field_name, meta_value, meta_key, field_order)
            SELECT ID, 'Post Title', post_title, 'postTitle', 1
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_type = 'cpt_staff_lst_item'
            AND post_status = 'publish'
            ORDER BY ID;", $tplateID));
}


//Get POSTS from export tbl for postmeta insert
function abcfslc_dba_export_staff_posts() {
    global $wpdb;
    $out = $wpdb->get_col("SELECT DISTINCT post_id
    FROM $wpdb->abcfslc_export_csv");
    return $out;
}

//Add POSTMETA
function abcfslc_dba_export_add_postsmeta_item( $postID, $fieldName, $metaKey, $metaValue, $fieldOrder ) {
    global $wpdb;
    $rowsAffected = $wpdb->query($wpdb->prepare(
            "INSERT $wpdb->abcfslc_export_csv  (post_id, sl_field_name, meta_value, meta_key, field_order)
            VALUES (%d, %s, %s, %s, %d)", $postID, $fieldName, $metaValue,  $metaKey, $fieldOrder ));

    if($rowsAffected != 1) { return 0; }
    return $rowsAffected;
}

function abcfslc_dba_export_get_tbl() {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT * FROM $wpdb->abcfslc_export_csv
        ORDER BY post_id, field_order, meta_key", OBJECT_K );
    return $dbRows;
}

function abcfslc_dba_export_get_postmeta( $postID ) {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta
        WHERE post_id = $postID
        ORDER BY meta_key", OBJECT_K );
    return $dbRows;
}

function abcfslc_dba_export_qty_to_export() {

    global $wpdb;
    return $wpdb->get_var( "SELECT COUNT(1)
        FROM $wpdb->abcfslc_export_csv
        WHERE meta_key = 'postID'" );
}

//--  EXPORT to CSV   ----------------------------------------
function abcfslc_dba_export_tbl_column_names() {
    global $wpdb;
    $dbRows = $wpdb->get_col( "SELECT DISTINCT sl_field_name
        FROM $wpdb->abcfslc_export_csv
        ORDER BY field_order, meta_key");
    return $dbRows;
}

function abcfslc_dba_export_file_post_ids() {
    global $wpdb;
    $dbRows = $wpdb->get_col( "SELECT DISTINCT post_id
        FROM $wpdb->abcfslc_export_csv
        ORDER BY post_id" );
    return $dbRows;
}

function abcfslc_dba_export_file_row_data( $postID ) {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT post_id, sl_field_name, meta_value
        FROM $wpdb->abcfslc_export_csv
        WHERE post_id  = $postID
        ORDER BY field_order, meta_key");

//var_dump( $wpdb->last_query );

    return $dbRows;
}
//== EXPORT END ======================================

//== IMPORT START ======================================
function abcfslc_dba_import_create_tbl() {
//To create tables we need dbDelta function located in upgrade.php. We'll have to load this file, as it is not loaded by default
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    global $wpdb;
    global $charset_collate;

    $tblImport = $wpdb->abcfslc_import_csv;

    if( $wpdb->get_var("SHOW TABLES LIKE '$tblImport'") != $tblImport ) {
          $sql = "CREATE TABLE " . $tblImport . " (
              import_id int unsigned NOT NULL AUTO_INCREMENT,
              tplate_id int unsigned NOT NULL,
              csv_row_no int unsigned NOT NULL,
              csv_col_name varchar(200) NOT NULL DEFAULT '-',
              sl_field_name varchar(200) NOT NULL DEFAULT '-',
              field_order int unsigned NOT NULL,
              post_id bigint(20) unsigned NOT NULL DEFAULT '0',
              meta_key varchar(255) NOT NULL,
              meta_value longtext,
              PRIMARY KEY  (import_id)
              ) $charset_collate;";
        dbDelta($sql);
     }
}

function abcfslc_dba_import_truncate_tbl(){
    global $wpdb;
    $sql = "TRUNCATE TABLE $wpdb->abcfslc_import_csv";
    $wpdb->query($sql);
}

function abcfslc_dba_import_add_row( $parDB ) {

    global $wpdb;
    $rowsAffected = $wpdb->query($wpdb->prepare(
            "INSERT $wpdb->abcfslc_import_csv (tplate_id, post_id, csv_row_no, csv_col_name, sl_field_name, meta_key, meta_value, field_order )
            VALUES (%d, %d, %d, %s, %s, %s, %s, %d )",
            $parDB['tplateID'],
            $parDB['postID'],
            $parDB['csvRowNo'],
            $parDB['csvColName'],
            $parDB['slFieldName'],
            $parDB['metaKey'],
            $parDB['cellValue'],
            $parDB['fieldOrder'] ));

    if($rowsAffected != 1) { return 0; }
    return (int)$wpdb->insert_id;
}

function abcfslc_dba_import_add_row_OLD( $tplateID, $postID, $csvRowNo, $csvColName, $slFieldName, $metaKey, $cellValue, $fieldOrder ) {

    global $wpdb;
    $rowsAffected = $wpdb->query($wpdb->prepare(
            "INSERT $wpdb->abcfslc_import_csv (tplate_id, post_id, csv_row_no, csv_col_name, sl_field_name, meta_key, meta_value, field_order )
            VALUES (%d, %d, %d, %s, %s, %s, %s, %d )", $tplateID, $postID, $csvRowNo, $csvColName, $slFieldName, $metaKey, $cellValue, $fieldOrder ));

    if($rowsAffected != 1) { return 0; }
    return (int)$wpdb->insert_id;
}

function abcfslc_dba_import_get_tbl() {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT * FROM $wpdb->abcfslc_import_csv
        ORDER BY csv_row_no, field_order, meta_key", OBJECT_K );

    return $dbRows;
}

//-- IMPORT DATA START -------------------------------------

//Get an array of blog ids
function abcfslc_dba_get_posts_to_insert() {
    global $wpdb;
    return $wpdb->get_results("SELECT import_id, csv_row_no, meta_value
        FROM $wpdb->abcfslc_import_csv
        WHERE meta_key = 'postTitle' AND post_id = 0", OBJECT_K );
}

function abcfslc_dba_qty_posts_to_insert() {

    global $wpdb;
    return $wpdb->get_var(  "SELECT COUNT(1)
        FROM $wpdb->abcfslc_import_csv
        WHERE meta_key = 'postTitle' AND post_id = 0" );
}

function abcfslc_dba_import_add_post_meta( $postID, $importID, $csvRowNo ){

    $run = false;
    if( $postID > 0 && $csvRowNo > 0 ) { $run = true; }
    if( !$run ) { return 0; }

    global $wpdb;
    $rowsAffected = $wpdb->query( $wpdb->prepare(
        "UPDATE $wpdb->abcfslc_import_csv
        SET post_id = %d
        WHERE csv_row_no = %d
        AND post_id = 0", $postID, $csvRowNo ));

    $run = false;
    if($rowsAffected > 0) { $run = true; }
    if( !$run ) { return 0; }

    $wpdb->query( $wpdb->prepare( "INSERT $wpdb->postmeta (post_id, meta_key, meta_value)
        SELECT post_id, meta_key, meta_value
        FROM $wpdb->abcfslc_import_csv
        WHERE post_id = %d
        AND meta_key != 'postTitle'
        AND meta_key != '_categories'", $postID) );

//var_dump( $wpdb->last_query );
//    $wpdb->query("INSERT $wpdb->postmeta (post_id, meta_key, meta_value)
//        SELECT post_id, meta_key, meta_value
//        FROM $wpdb->abcfslc_import_csv
//        WHERE post_id = $postID AND meta_key != 'postTitle'" );

//var_dump( $wpdb->last_query ); _categories

return $rowsAffected;
//    $wpdb->query($wpdb->prepare("INSERT $wpdb->postmeta (post_id, meta_key, meta_value)
//        SELECT post_id, meta_key, meta_value
//        FROM $wpdb->abcfslc_import_csv
//        WHERE post_id = %d AND meta_key != ''", $postID, $csvRow ));

}

//function abcfic_dba_add_album_xx( $aName, $aNameDesc ) {
//
//    global $wpdb;
//    $rowsAffected = $wpdb->query($wpdb->prepare(
//            "INSERT $wpdb->abcficalbums (album_name, album_desc)
//            VALUES (%s, %s)", $aName, $aNameDesc));
//
//    if($rowsAffected != 1) { return 0; }
//    return (int)$wpdb->insert_id;
//}
//-- IMPORT DATA END ---------------------------------



function abcfslc_dba_qty_not_imported() {

    global $wpdb;
    return $wpdb->get_var(  "SELECT count(1)  FROM $wpdb->abcfslc_import_csv WHERE post_id = 0" );

//SELECT count(1)
//FROM wp_abcfslc_import_csv
//WHERE post_id = 0;
}

function abcfslc_dba_qty_imported() {

    global $wpdb;
    return $wpdb->get_var( "SELECT count(1)  FROM $wpdb->abcfslc_import_csv WHERE post_id > 0" );
}

function abcfslc_dba_qty_import_all() {

    global $wpdb;
    return $wpdb->get_var( "SELECT count(1) FROM $wpdb->abcfslc_import_csv" );
}

function abcfslc_dba_cbo_templates() {
    global $wpdb;
    $cps = array();
    $cps[0] = ' - - - ';
    $dbRows = $wpdb->get_results( "SELECT ID, post_title FROM $wpdb->posts
        WHERE post_type = 'cpt_staff_lst' AND post_status = 'publish'
        ORDER BY post_title" );
    if ($dbRows) { foreach ($dbRows as $row) {$cps[$row->ID] = $row->post_title;} }
    return $cps;
}

function abcfslc_dba_cbo_file_folder( $csvUrl ) {

    global $wpdb;
    $id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $csvUrl ) );

    $id = isset( $id ) ? $id : 0;

    $folderQPath = '';
    if( $id > 0 ){
        $folderQPath = $wpdb->get_var( $wpdb->prepare( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id='%d';", $id ) );
    }

    return $folderQPath;

}

function abcfslc_dba_template_name( $tplateID ) {
    global $wpdb;

    return $wpdb->get_var( $wpdb->prepare( "SELECT post_title FROM $wpdb->posts WHERE ID='%d';", $tplateID ) );
}

//-- UNINSTALL --------------------------------------
function abcfslc_dba_import_drop_tbl(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS $wpdb->abcfslc_import_csv";
    $wpdb->query($sql);
}

function abcfslc_dba_export_drop_tbl(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS $wpdb->abcfslc_export_csv";
    $wpdb->query($sql);
}

function abcfslc_dba_import_cat_drop_tbl(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS $wpdb->abcfslc_import_cat";
    $wpdb->query($sql);
}





//Get an array of blog ids
function abcfslc_dba_wpmu_blogs() {
    global $wpdb;
    return $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs WHERE archived = '0' AND spam = '0' AND deleted = '0'");
}

function abcfslc_dba_import_map_option_names() {
    global $wpdb;
    return $wpdb->get_col("SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'abcfslc_import_map_%'");
}

function abcfslc_dba_export_map_option_names() {
    global $wpdb;
    return $wpdb->get_col("SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'abcfslc_export_map_%'");
}

//-- CAT ---------------------------------
function abcfslc_dba_cat_create_tbl() {
//To create tables we need dbDelta function located in upgrade.php. We'll have to load this file, as it is not loaded by default
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    global $wpdb;
    global $charset_collate;

    $tblCat = $wpdb->abcfslc_import_cat;

    if( $wpdb->get_var("SHOW TABLES LIKE '$tblCat'") != $tblCat ) {
          $sql = "CREATE TABLE " . $tblCat . " (
              import_id int unsigned NOT NULL,
              csv_row_no int unsigned NOT NULL,
              meta_value longtext NOT NULL DEFAULT '',
              status int unsigned NOT NULL DEFAULT 0,
              status_icon VARCHAR(500) NOT NULL DEFAULT '',
              PRIMARY KEY  (import_id)
              ) $charset_collate;";
        dbDelta($sql);
     }
}

function abcfslc_dba_cat_drop_tbl(){
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS $wpdb->abcfslc_import_cat";
    $wpdb->query($sql);
}

function abcfslc_dba_cat_truncate_tbl(){
    global $wpdb;
    $sql = "TRUNCATE TABLE $wpdb->abcfslc_import_cat";
    $wpdb->query($sql);
}

function abcfslc_dba_cat_add_items() {
    global $wpdb;
    $rowsAffected = $wpdb->query("INSERT $wpdb->abcfslc_import_cat ( import_id, csv_row_no, meta_value )
            SELECT import_id, csv_row_no, meta_value
            FROM $wpdb->abcfslc_import_csv
            WHERE meta_key = '_categories'
            AND meta_value IS NOT NULL");

    //if( $rowsAffected != 1 ) { return 0; }
    return $rowsAffected;
}

function abcfslc_dba_cat_update_status( $importID, $status, $statusIcon ) {

    global $wpdb;
    $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->abcfslc_import_cat
        SET status = %d,
        status_icon = %s
        WHERE import_id = %d", $status, $statusIcon, $importID ));

}

function abcfslc_dba_cat_get_tbl() {
    global $wpdb;
    $dbRows = $wpdb->get_results( "SELECT import_id, csv_row_no, meta_value, status, status_icon
            FROM $wpdb->abcfslc_import_cat
            ORDER BY csv_row_no", OBJECT_K );

    return $dbRows;
}

function abcfslc_dba_cat_qty_all() {
    global $wpdb;
    return $wpdb->get_var( "SELECT COUNT(1)
        FROM $wpdb->abcfslc_import_cat" );
}

function abcfslc_dba_cat_qty_ok() {
    global $wpdb;
    return $wpdb->get_var( "SELECT COUNT(1)
        FROM $wpdb->abcfslc_import_cat
        WHERE status = 1" );
}


function abcfslc_dba_staff_list_term_exists( $catSlug ) {

    global $wpdb;

    return $wpdb->get_var( $wpdb->prepare( "SELECT t.term_id
        FROM $wpdb->terms t
        JOIN $wpdb->term_taxonomy tt ON t.term_id = tt.term_id
        WHERE t.slug = '%s'
        AND tt.taxonomy = 'tax_staff_member_cat';", $catSlug ) );

    //return $out;
}

function abcfslc_dba_cat_string_for_terms_insert( $postID ) {
    global $wpdb;

    return $wpdb->get_var( $wpdb->prepare("SELECT meta_value
        FROM $wpdb->abcfslc_import_csv
        WHERE post_id = %d
        AND meta_key = '_categories'", $postID ));
}
