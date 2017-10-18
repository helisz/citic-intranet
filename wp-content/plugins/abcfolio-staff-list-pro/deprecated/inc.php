<?php
function abcfsl_util_get_target_OLD( $href ){

    $out['hrefUrl'] = $href;
    $out['target'] = '';

    $targetNT = substr($href, 0, 2);
    if( $targetNT == 'NT' ) {
        $out['hrefUrl'] = trim( substr( $href, 2 ) );
        $out['target'] = '_blank';
    }
    return $out;
}

//== IMAGE WxH START ==========================================================

function abcfsl_util_img_alt( $imgID ){

    $imgMeta = '';
    if($imgID > 0){ $imgMeta = get_post_meta($imgID, '_wp_attachment_image_alt', true); }

    return $imgMeta;
}

function abcfsl_util_img_wh( $imgID, $imgUrl ){

    //$imgMeta = abcfsl_db_image_meta($postID);
    $filename = basename($imgUrl);
    $meta = '';
    $imgWH['w'] = 0;
    $imgWH['h'] = 0;
    $imgWH['ok'] = false;

    if($imgID > 0){ $meta = get_post_meta($imgID, '_wp_attachment_metadata'); }
    if(empty( $meta )) { return $imgWH; }

    $metaArray = isset( $meta ) ?  $meta[0] : '';
    if(empty($metaArray)) { return $imgWH; }

    //Check original image (stored in different part of the array than other sizes. return sizes if image is an original
    $imgWH = abcfsl_util_large_img_wh( $metaArray, $filename );
    if($imgWH['ok']){ return $imgWH; }

    //Check if array has 'sizes' array
    if(!array_key_exists('sizes', $metaArray)) { return $imgWH; }

    $sizes = $metaArray['sizes'];

    $defaults = array( 'file' => '', 'width' => '0', 'height' => '0' );
    foreach ( $sizes as $size ) {
        $sizeFixed = shortcode_atts( $defaults, $size );

        $sizeFile = $sizeFixed['file'];
        if($sizeFile == $filename){
            $imgWH['w'] = $sizeFixed['width'];
            $imgWH['h'] = $sizeFixed['height'];
            if($imgWH['w'] > 0 && $imgWH['h'] > 0) { $imgWH['ok'] = true; }
            break;
        }
    }

    return $imgWH;

//$filename = basename($url);
//$parts=explode(“?”,$filename);
//$filename = $parts[0];
}

function abcfsl_util_large_img_wh( $metaArray, $filename ){

    $imgWH['w'] = 0;
    $imgWH['h'] = 0;
    $imgWH['ok'] = false;

    $defaults = array( 'file' => '', 'width' => '0', 'height' => '0' );
    $meta = shortcode_atts( $defaults, $metaArray );

    //File can have folders prefixes: 2015/12/image.jpg
    $large =  basename($meta['file']);

    if( $large == $filename){
        $imgWH['w'] = $meta['width'];
        $imgWH['h'] = $meta['height'];
        if($imgWH['w'] > 0 && $imgWH['h'] > 0) { $imgWH['ok'] = true; }
    }
    return $imgWH;
}

function abcfsl_util_img_id_by_url( $url ){

    global $wpdb;
    $imageID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url ));
    if( !empty( $imageID ) ) { return $imageID; }

    // If the URL is auto-generated thumbnail, remove the sizes and get the URL of the original image
    $url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $url );
    $imageID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url ));
    if( !empty( $imageID ) ) { return $imageID; }

    return 0;
}

//== IMAGE WxH END ==========================================================

function abcfsl_db_staff_members_az_filter( $parentID, $filterField, $scodeCat, $qryFilter, $first ) {

    global $wpdb;

    $qryType = 'ALL';
    if( empty( $qryFilter ) &&  !empty( $first ) ) { $qryFilter = $first;}
    if( !empty( $scodeCat ) &&  !empty( $qryFilter ) ) { $qryType = 'CATAZ';}
    if( !empty( $scodeCat ) && empty( $qryFilter ) ) { $qryType = 'CAT'; }
    if( empty( $scodeCat ) && !empty( $qryFilter ) ) { $qryType = 'AZ'; }

    switch ( $qryType ) {
        case 'CAT' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'
            ORDER BY p.menu_order ASC", $parentID, $scodeCat ));
            break;
        case 'CATAZ' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s
            AND t.slug = %s
            ORDER BY p.menu_order ASC;", $parentID, $filterField, $qryFilter, $scodeCat ));
            break;
        case 'AZ' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT pm.post_id
            FROM $wpdb->postmeta pm
            JOIN $wpdb->posts p ON pm.post_id =  p.ID
            WHERE p.post_parent = %d
            AND p.post_status = 'publish'
            AND pm.meta_key = %s
            AND LEFT( pm.meta_value, 1 ) = %s
            ORDER BY p.menu_order ASC; ", $parentID, $filterField, $qryFilter ));
            break;
       default:
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_status = 'publish'
            ORDER BY menu_order ASC", $parentID ));
            break;
    }

    return $postIDs;
}

function abcfsl_db_staff_members_category_filter( $parentID, $scodeCat, $qryFilter, $first ) {

    global $wpdb;

    $qryType = 'ALL';
    if( empty( $qryFilter ) &&  !empty( $first ) ) { $qryFilter = $first;}
    if( !empty( $scodeCat ) &&  !empty( $qryFilter ) ) { $qryType = 'CATCAT';}
    if( !empty( $scodeCat ) && empty( $qryFilter ) ) {
        $qryFilter = $scodeCat;
        $qryType = 'CAT'; }
    if( empty( $scodeCat ) && !empty( $qryFilter ) ) { $qryType = 'CAT'; }

    $postIDs = false;

    switch ( $qryType ) {
        case 'CAT' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'
            ORDER BY p.menu_order ASC", $parentID, $qryFilter ));
            break;
        case 'CATCAT' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND t.slug = %s
            AND p.post_status = 'publish'
            ORDER BY p.menu_order ASC", $parentID, $scodeCat, $qryFilter ));
            break;
       default:
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_status = 'publish'
            ORDER BY menu_order ASC", $parentID ));
            break;
    }

    return $postIDs;
}

function abcfsl_db_staff_members_no_filter( $parentID, $scodeCat ) {

    global $wpdb;

    $qryType = 'ALL';
    if( !empty( $scodeCat ) ) { $qryType = 'CAT';}

    $postIDs = false;

    switch ( $qryType ) {
        case 'CAT' :
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT p.ID
            FROM $wpdb->term_relationships tr
            JOIN $wpdb->posts p ON tr.object_id = p.ID
            JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            JOIN $wpdb->terms t ON tt.term_id = t.term_id
            WHERE p.post_parent = %d
            AND t.slug = %s
            AND p.post_status = 'publish'
            ORDER BY p.menu_order ASC", $parentID, $scodeCat ));
            break;
       default:
            $postIDs = $wpdb->get_col( $wpdb->prepare(
            "SELECT ID
            FROM $wpdb->posts
            WHERE post_parent = %d
            AND post_status = 'publish'
            ORDER BY menu_order ASC", $parentID ));
            break;
    }

    return $postIDs;
}


function abcfsl_util_page_total_qty_OLD( $postIDs, $postIDsH, $pgnationPgQty, $random ){

    if( $random ){ return count($postIDs); }
    if( $pgnationPgQty == 0 ) { return count($postIDs); }

    //Get all not hidden.
    $postIDsVisible = array_diff ( $postIDs, $postIDsH );
    return count($postIDsVisible);
}


// If pagination, figure out what post IDs to return. If not, return all.
function abcfsl_util_page_post_ids_OLD( $postIDs, $postIDsH, $pageNo, $pgnationPgQty, $random ){

    if( $random ){ return $postIDs; }
    if( $pgnationPgQty == 0 ) { return $postIDs; }

    //Get all not hidden.
    $postIDsVisible = array_diff ( $postIDs , $postIDsH );
    //echo"<pre>", print_r( $postIDsVisible ), "</pre>";

    if( $pageNo == 0 && $pgnationPgQty > 0 ) { $pageNo = 1;}

    $start = ( $pageNo * $pgnationPgQty ) - $pgnationPgQty;
    $outPostIDs = array_slice( $postIDsVisible, $start, $pgnationPgQty, false );

    return $outPostIDs;
}


function abcfsl_util_page_total_qty( $postIDs, $pgnationPgQty, $random ){

    if( $random ){ return count($postIDs); }
    if( $pgnationPgQty == 0 ) { return count($postIDs); }

    return count($postIDs);
}