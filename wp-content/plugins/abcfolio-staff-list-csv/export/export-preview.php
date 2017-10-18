<?php
function abcfslc_export_preview(){

    $fileOpts = abcfslc_autil_export_file_optns();
    $tplateID =  $fileOpts['tplateID'];

    abcfslc_export_preview_tbl_refresh( $tplateID );
    //--WRAP START --------------------------------------------
    echo  abcfl_html_tag('div', '', 'wrap' );

    switch ( abcfslc_autil_export_status( $tplateID ) ){
        case 'NOTEMPLATE':
            abcfslc_autil_err_no_template();
            break;
        case 'EMPTY':
            abcfslc_autil_err_export_tbl_empty();
            break;
       default:
            abcfslc_export_preview_qty();
            abcfslc_tbls_export_render_tbl();
            break;
    }

   //--WRAP END --------------------------------------------
    echo abcfl_html_tag_end('div');
}

function abcfslc_export_preview_qty(){
    $qty = abcfslc_dba_export_qty_to_export();
    abcfslc_autil_msg_info( $qty . abcfslc_txta(75) );
}

//== DB TABLE - TRUNCATE AND LOAD - START =================
function abcfslc_export_preview_tbl_refresh( $tplateID ){

//abcfslc_dba_export_drop_tbl();
//abcfslc_dba_export_create_tbl();
    abcfslc_dba_export_truncate_tbl();
    abcfslc_dba_export_add_posts_to_tbl( $tplateID );
    abcfslc_export_preview_add_postmeta( $tplateID );
}

function abcfslc_export_preview_add_postmeta( $tplateID ){

    $exportMap = abcfslc_map_saved_optns( $tplateID, 'E' );
    $tplateOptns = get_post_custom( $tplateID );
    $exportOpts = abcfslc_autil_export_file_optns();
    $optnImg = $exportOpts['img'];

    unset($exportMap['abcfslcToggleAll']);
    unset($exportMap['postID']);
    unset($exportMap['postTitle']);

//echo"<pre>", print_r('--- Map Export ---'), "</pre>";
//echo"<pre>", print_r($exportMap), "</pre>";

    //Export table has only posts
    $dbRows = abcfslc_dba_export_staff_posts();

//echo"<pre>", print_r($dbRows), "</pre>";  die;
    if ($dbRows) {
        foreach ( $dbRows as $key => $postID ) {
            abcfslc_export_preview_add_postmeta_single_post( $postID, $exportMap, $tplateOptns, $optnImg );
       }
    }
}

//Add all map items. If item has a metadata - add it. If not insert space.
function abcfslc_export_preview_add_postmeta_single_post( $postID, $exportMap, $tplateOptns, $optnImg ){

    $metaValue = ' ';
    $dbRows = abcfslc_dba_export_get_postmeta( $postID );

    //Post ID = 0,
    //Post Title = 1;
    //F fields = $fieldOrder; Start at 2.
    //Other fields = custom order; Start at 130.
    //abcfslc_field_lbls_lbl switch ( $metaKey );
    $fieldOrder = 1;

    foreach ( $exportMap as $metaKey => $value ) {
        $fieldOrder++;
        switch ( $metaKey ){
            case '_imgUrlL':
            case '_imgUrlS':
                $metaValue = abcfslc_export_preview_get_meta_key_value_img( $metaKey, $dbRows, $optnImg );
                break;
            case '_categories':
                $metaValue = abcfslc_export_preview_post_categories( $postID );
                break;
           default:
                $metaValue = abcfslc_export_preview_get_meta_key_value( $metaKey, $dbRows );
                break;
        }

        //Get Label and Field Order
        $out = abcfslc_field_lbls_lbl( $metaKey, $tplateOptns, $fieldOrder );

        abcfslc_dba_export_add_postsmeta_item( $postID, $out['lbl'], $metaKey, $metaValue, $out['order'] );
    }
}

function abcfslc_export_preview_get_meta_key_value( $metaKey, $dbRows ){

    $metaValue = ' ';
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {

            if( $dbRow->meta_key == $metaKey ){
                $metaValue = $dbRow->meta_value;
                break;
            }
       }
    }
    return $metaValue;
}

function abcfslc_export_preview_get_meta_key_value_img( $metaKey, $dbRows, $optnImg ){

    $metaValue = ' ';
    if ($dbRows) {
        foreach ( $dbRows as $dbRow ) {

            if( $dbRow->meta_key == $metaKey ){
                $metaValue = abcfslc_export_preview_img_url( $dbRow->meta_value, $optnImg );
                break;
            }
       }
    }
    return $metaValue;
}

//Return categories string for a post.
function abcfslc_export_preview_img_url( $metaValue, $optnImg ){

    if( $metaValue == 'SP' ) { return $metaValue; }
    if( $optnImg == 'U' ) { return $metaValue; }

    $metaValueImg = basename( $metaValue );

    return $metaValueImg;
}

//Return categories string for a post.
function abcfslc_export_preview_post_categories( $postID ){

    $terms = get_the_terms( $postID, 'tax_staff_member_cat');
    $slugs = '';

    if ( ! empty( $terms ) ) {
        foreach($terms as $term){
            $slugs .= $term->slug . ',';
        }
        $slugs = rtrim($slugs, ',');
    }

    return $slugs;
}
