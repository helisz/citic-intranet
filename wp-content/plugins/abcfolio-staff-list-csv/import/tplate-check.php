<?php

//== CHECK TEMPLATE MATCH - START ====================================================
//Check if currently selected template has the same set of fields as the one used for for match.
//In case template has been modified.
function abcfslc_tpate_check( $tplateID ){

    $tplateFields = abcfslc_import_preview_tbl_tplate_fields( $tplateID );
    $mapFilelds = abcfslc_import_preview_tbl_map_fields( $tplateID );

    $tplateMatch = abcfslc_autil_has_all_keys( $tplateFields, $mapFilelds );

    if ( !$tplateMatch ) {
        echo abcfl_html_tag('div','', 'notice notice-error is-dismissible' );
        echo abcfl_html_tag_with_content( 'Error. No match', 'p', '' );
        echo abcfl_html_tag_end('div');
        die;
    }
}

function abcfslc_import_preview_tbl_tplate_fields( $tplateID ){

    $tplateOptns = get_post_custom( $tplateID );

    $tplateFields = array();
    for ( $i = 1; $i <= 40; $i++ ) {
        $tplateFields = abcfslc_import_preview_tbl_field_id( $tplateOptns, ('F' . $i), $tplateFields );
    }
    return array_flip( $tplateFields );
}

function abcfslc_import_preview_tbl_map_fields( $tplateID ){

   $defaults = array();
   $map = wp_parse_args( get_option( 'abcfslc_import_map_' . $tplateID, array() ) , $defaults );
   return $map;
}

function abcfslc_import_preview_tbl_field_id( $tplateOptns, $F, $fieldIDs ){

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
    if( $fieldType == 'N' ) { $fieldIDs; }

    //-----------------------------------------------------
    switch ($fieldType){
        case 'T':
        case 'PT':
        case 'LT':
            $fieldIDs = abcfslc_import_preview_tbl_field_T( $F, $fieldIDs );
            break;
        case 'MP':
            $fieldIDs = abcfslc_import_preview_tbl_field_MP( $F, $fieldIDs );
            break;
        case 'EM':
        case 'H':
            $fieldIDs = abcfslc_import_preview_tbl_field_H( $F, $fieldIDs );
            break;
        case 'TH':
            $fieldIDs = abcfslc_import_preview_tbl_field_TH( $F, $fieldIDs );
            break;
        case 'CE':
            $fieldIDs = abcfslc_import_preview_tbl_field_CE( $F, $fieldIDs );
            break;
       default:
            break;
    }
    return $fieldIDs;
}

function abcfslc_import_preview_tbl_field_T( $F, $fieldIDs ){
    $fieldID = '_txt_' . $F;
    array_push( $fieldIDs, $fieldID );
    return $fieldIDs;
}

function abcfslc_import_preview_tbl_field_H( $F, $fieldIDs ){
    array_push( $fieldIDs, '_urlTxt_' . $F );
    array_push( $fieldIDs, '_url_' . $F );
    return $fieldIDs;
}

function abcfslc_import_preview_tbl_field_TH( $F, $fieldIDs ){
    array_push( $fieldIDs, '_url_' . $F );
    return $fieldIDs;
}

function abcfslc_import_preview_tbl_field_CE( $F, $fieldIDs ){
    array_push( $fieldIDs, '_editorCnt_' . $F );
    return $fieldIDs;
}

function abcfslc_import_preview_tbl_field_MP( $F, $fieldIDs ){
    array_push( $fieldIDs, '_mp1_' . $F );
    array_push( $fieldIDs, '_mp2_' . $F );
    array_push( $fieldIDs, '_mp3_' . $F );
    array_push( $fieldIDs, '_mp4_' . $F );
    return $fieldIDs;
}
//== CHECK TEMPLATE MATCH - END  =================================================

