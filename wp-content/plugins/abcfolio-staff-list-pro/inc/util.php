<?php
//Get columns qty. Fix if needed.
function abcfsl_util_grid_cols_qty( $gridColsXL , $gridColsLG, $gridColsMD ){

    $gridColsQty['XL'] = $gridColsXL;
    $gridColsQty['LG'] = $gridColsLG;
    $gridColsQty['MD'] = $gridColsMD;
    $gridColsQty['oneBreak'] = false;

    if( $gridColsLG + $gridColsMD == 0 ) {
       $gridColsQty['oneBreak'] = true;
       return $gridColsQty;
    }

    $colsQtyFixed = $gridColsXL;
    if( $gridColsLG > $colsQtyFixed ){ $gridColsLG = $colsQtyFixed; }
    if( $gridColsLG == 0 ){ $gridColsLG = $colsQtyFixed; }

    $colsQtyFixed = $gridColsLG;
    if( $gridColsMD > $colsQtyFixed ){ $gridColsMD = $colsQtyFixed; }
    if( $gridColsMD == 0 ){ $gridColsMD = $colsQtyFixed; }

    $gridColsQty['LG'] = $gridColsLG;
    $gridColsQty['MD'] = $gridColsMD;

    if( $gridColsLG == $gridColsXL && $gridColsMD == $gridColsXL ){
       $gridColsQty['oneBreak'] = true;
    }

    return $gridColsQty;
}

//Get fieldOrder meta. Convert saved meta to array.
function abcfsl_util_field_order( $tplateOptns, $isSingle=false ){

    $fieldOrder = '';
    $fieldOrderA = array();

    if( $isSingle ){
        $fieldOrder = isset( $tplateOptns['_fieldOrderS'] ) ? $tplateOptns['_fieldOrderS'][0] : '';
        if(empty($fieldOrder)){
            $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';
        }
    }
    else {
        $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';
    }

    if(empty($fieldOrder)){
        for ( $i = 1; $i <= 40; $i++ ) { $fieldOrderA[$i] = 'F' . $i; }
    }
    else{
        $fieldOrderA = unserialize( $fieldOrder );

        // Array has duplicates
        if(count(array_unique($fieldOrderA)) < count($fieldOrderA)){
            $fieldOrderU = array_unique($fieldOrderA);
            $fieldOrderA = array_combine(range(1, count($fieldOrderU)), array_values($fieldOrderU));
        }
    }

    //[1] => F1 [2] => F4 [3] => F5
    return $fieldOrderA;
}

//Parse custom class string. Returns string of classes: List, Single Page, Both. lst_ spg_
function abcfsl_util_pg_type_cls_bldr( $input, $isSingle ){

    //List only class starts with: 'lst_'
    //Single Page only class starts with: 'spg_'
    $pgType = 'L';
    if( $isSingle ){$pgType = 'S';}

    $cls['clsLst'] = '';
    $cls['clsSpg'] = '';
    $cls['clsBoth'] = '';
    if(empty($input)){ return '';}

    $hasLstCls = false;
    $hasSpgCls = false;

    if (strpos($input,'lst_') !== false) { $hasLstCls = true; }
    if (strpos($input,'spg_') !== false) { $hasSpgCls = true; }
    if(!$hasLstCls && !$hasSpgCls) { return $input; }

    $inputFixed = preg_replace('/\s+/', ' ', $input);
    $clsLst = '';
    $clsSpg = '';
    $clsBoth = '';

    $pieces = explode(' ', $inputFixed);

    foreach($pieces as $value){
        $prefix = substr($value, 0, 4);
        switch ($prefix){
        case 'lst_':
            $clsLst .= substr($value, 4) . ' ';
            break;
        case 'spg_':
            $clsSpg .= substr($value, 4) . ' ';
            break;
        default:
            $clsBoth .= $value . ' ';
            break;
        }
    }

    $out = '';
    switch ($pgType){
        case 'L':
            $out = trim($clsBoth . $clsLst);
            break;
        case 'S':
            $out = trim($clsBoth . $clsSpg);
            break;
        default:
            break;
    }
    return $out;
}

function abcfsl_util_class_name_bldr( $optnValue, $clsBaseName, $clsPfix, $default='' ){

    if( empty( $optnValue ) ) { return $default; }
    if( empty( $clsBaseName ) ) { return $default; }
    if( $optnValue == 'C' ) { return $default; }

    return $clsPfix . $clsBaseName . $optnValue;
}
//===================================================================

//Get href parts: url + link text + target for Sinle Page link.
function abcfsl_util_href_bldr_SPTL( $itemUrl, $itemTxt, $pretty, $itemID, $sPageUrl ){

    $out = abcfsl_util_url_selector( $itemID, $itemUrl, $sPageUrl, $pretty );
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $out['hrefUrl']; }

    $aTag['hrefUrl'] = $out['hrefUrl'];
    $aTag['hrefTxt'] = $itemTxt;
    $aTag['target'] = $out['target'];
    return $aTag;
}

//Get href parts: url + link text + target.
function abcfsl_util_href_bldr( $itemOptns, $itemID, $sPageUrl, $F ){

    $itemUrl = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';

    $out = abcfsl_util_url_selector( $itemID, $itemUrl, $sPageUrl, $pretty );
    $itemTxt = isset( $itemOptns['_urlTxt_' . $F] ) ? esc_attr( $itemOptns['_urlTxt_' . $F][0] ) : '';
    if( abcfl_html_isblank( $itemTxt ) ) { $itemTxt = $out['hrefUrl']; }

    $aTag['hrefUrl'] = $out['hrefUrl'];
    $aTag['hrefTxt'] = $itemTxt;
    $aTag['target'] = $out['target'];
    return $aTag;
}

//Get Single page Url if 'SP' used as url. Otherwise return URL as entered.
function abcfsl_util_url_selector( $itemID, $lnkUrl, $sPageUrl, $pretty ){

    $out['hrefUrl'] = '';
    $out['target'] = '';
    if( abcfl_html_isblank( $lnkUrl ) ) { return $out;}

    if($lnkUrl == 'NT SP') {
        $lnkUrl = 'SP';
        $out['target'] = '_blank';
    }

    if($lnkUrl == 'SP') {
        //If single page url is blank return empty sting.
        if( abcfl_html_isblank( $sPageUrl ) ) { return $out; }

        if( abcfsl_util_is_single_pretty( $sPageUrl, $pretty ) ) {
            $out['hrefUrl'] = trailingslashit( trailingslashit( $sPageUrl ) . $pretty ) ;
            return $out;
        }
        else {
            //Add staff member ID single page url.
            $out['hrefUrl'] = abcfl_html_url( array('smid' => $itemID), $sPageUrl );
            return $out;
        }
    }

    $out = abcfsl_util_get_target( $lnkUrl );
    return $out;
}

//URL builder for staff page. Check if single page URL is ready for pretty permalink
function abcfsl_util_is_single_pretty( $sPageUrl, $pretty ){

    if( empty( $pretty ) ) { return false; }

    if( strlen( $sPageUrl ) < 10 ) { return false; }
    $sPageUrl = rtrim( $sPageUrl, '/' );

    if( substr($sPageUrl, -3) == 'bio' ) { return true; }
    if( substr($sPageUrl, -7) == 'profile' ) { return true; }
    if( substr($sPageUrl, -6) == 'profil' ) { return true; }
    if( substr($sPageUrl, -7) == 'profilo' ) { return true; }
    if( substr($sPageUrl, -6) == 'perfil' ) { return true; }
    //if( substr($sPageUrl, -8) == 'attorney' ) { return true; }

    $out = false;
    if( function_exists( 'abcfslcp_is_single_pretty' )){
       $out = abcfslcp_is_single_pretty( $sPageUrl );
    }

    return $out;
}

//Get staffMemberID when rewrite is implemented
function abcfsl_util_staff_member_id ( $scodeArgs ){

    $staffID = (int)$scodeArgs['staff-id'];
    if( $staffID > 0 ){ return $staffID; }

    $smid = (int)$scodeArgs['smid'];
    $staffName= $scodeArgs['staff-name'];
    $staffMemberID = 0;

    if( $smid > 0) { return $smid; }
    if( empty( $staffName ) ) { return 0; }

    //?smid=63561
    if( !empty( $staffName ) & strlen( $staffName ) > 6 ){

        if ( substr($staffName, 0, 6) == '?smid=' ){ return (int) substr( $staffName, 6 ); }
        $staffMemberID = abcfsl_db_post_id_by_pretty( $staffName );
    }
    return $staffMemberID;
}

//--------------------------------------------------------
//Check for NT-new tab.


function abcfsl_util_get_target( $url ){

    $out['hrefUrl'] = $url;
    $out['target'] = '';
    if( abcfl_html_isblank( $url ) ) { return $out; }

    if(strlen($url) < 4) { return $out; }

    $targetNT = substr( $url, 0, 2 );
    if( $targetNT == 'NT' ) {
        $out['hrefUrl'] = trim( substr( $url, 2 ) );
        $out['target'] = '_blank';
    }
    return $out;
}

function abcfsl_util_cls_bldr( $cls, $clsPfix ){

    if( empty( $cls) ) { return ''; }
    return $clsPfix . $cls;
}

//Return class name or empty string. Used for cbos Class: None, Custom or Selected.
function abcfsl_util_cls_name_ncd_bldr( $optnValue, $clsBaseName, $clsPfix, $default='' ){

    if( $optnValue == 'N' || $optnValue == 'C'|| $optnValue == 'D' ){ return ''; }
    if( empty( $optnValue ) ) { $optnValue = $default; }
    if( empty( $optnValue) ) { return ''; }
    return $clsPfix . $clsBaseName . $optnValue;
}

//Return empty if N or C.
function abcfsl_util_cls_name_nc_bldr( $optnValue, $clsBaseName, $clsPfix, $default='' ){

    if( $optnValue == 'N' || $optnValue == 'C' ){ return ''; }
    if( $optnValue == 'D' ) { $optnValue = $default; }
    if( empty( $optnValue ) ) { $optnValue = $default; }
    if( empty( $optnValue) ) { return ''; }
    return ' ' . $clsPfix . $clsBaseName . $optnValue;
}

function abcfsl_util_center_cls( $centerYN, $clsPfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $clsPfix . 'MLRAuto'; }
    return $out;
}

function abcfsl_util_img_center_cls( $centerYN, $clsPfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $clsPfix . 'ImgCenter'; }
    return $out;
}

function abcfsl_util_imgs_folder_url( $socIconSize ){

    $imgsFolderUrl = ABCFSL_PLUGIN_URL . 'images';
    if( $socIconSize == 'C' ){
        $uploadDir = wp_upload_dir();
        $custom = 'abcfolio/staff-list';
        $baseURL = $uploadDir['baseurl'];
        $imgsFolderUrl = trailingslashit( $baseURL ) . $custom;
    }
    return trailingslashit( $imgsFolderUrl );

}

//-- PG Paginator START ---------------------------------------
// Return post IDs to show
function abcfsl_util_post_ids( $optns ){

    $out['postIDs'] = array();
    $out['totalQty'] = 0;

    $staffID = $optns['staffID'];
    $parentID = $optns['parentID'];

    $postIDs = array();
    //$postIDsH = array(); //Remove excluded. EXCLUDED

    if( $staffID > 0 ){
        $postIDs = abcfsl_db_staff_member( $staffID );
        $out['postIDs'] = $postIDs;
        $out['totalQty'] = count( $postIDs );
        return $out;
    }
    else {
        $postIDs = abcfsl_db_staff_member_ids( $parentID, $optns  );
        //$postIDsH = abcfsl_db_staff_members_hidden( $parentID );
    }

    $totalQty = count($postIDs);
    $out['totalQty'] = $totalQty;
    if( $totalQty == 0 ) { return $out; }

    if( $optns['random'] ){
        shuffle( $postIDs );
        $top = $optns['top'];
        if( $top > 0 ) { $postIDs = array_slice( $postIDs, 0, $top ); }
        $out['postIDs'] = $postIDs;
        return $out;
    }

    //-- If pagination, return subset of records. Otherwise, return all.
    $out['postIDs'] = abcfsl_util_page_post_ids( $postIDs, $optns['pageNo'], $optns['pgnationPgQty'] );
    return $out;
}


function abcfsl_util_page_post_ids( $postIDs, $pageNo, $pgnationPgQty ){

    //$output = array_slice($input, 0, 30)

    //if( $random ){ return $postIDs; }
    if( $pgnationPgQty == 0 ) { return $postIDs; }

    if( $pageNo == 0 && $pgnationPgQty > 0 ) { $pageNo = 1;}

    $start = ( $pageNo * $pgnationPgQty ) - $pgnationPgQty;
    $outPostIDs = array_slice( $postIDs, $start, $pgnationPgQty, true );

    return $outPostIDs;
}

//Pagination control HTML. Container + content.
function abcfsl_util_pagination( $tplateOptns, $totalQty, $pageNo, $clsPfix ){

    $par['totalQty'] = $totalQty;
    $par['pgQty'] = isset( $tplateOptns['_pgnationPgQty'] ) ? $tplateOptns['_pgnationPgQty'][0] : 0;
    $par['currentPage'] = $pageNo;
    $par['pgsToShow'] = isset( $tplateOptns['_pgnationPgsToShow'] ) ? $tplateOptns['_pgnationPgsToShow'][0] : '10';
    $par['pgnationSize'] = isset( $tplateOptns['_pgnationSize'] ) ? $tplateOptns['_pgnationSize'][0] : 'MD';
    $par['justify'] = isset( $tplateOptns['_pgnationJustify'] ) ? $tplateOptns['_pgnationJustify'][0] : 'E';
    $par['pgnationColor'] = isset( $tplateOptns['_pgnationColor'] ) ? $tplateOptns['_pgnationColor'][0] : 'G';
    $par['urlPattern'] = abcfsl_util_pagination_pg_url();
    $par['clsPfix'] = $clsPfix;

    $paginator = new ABCFSL_Paginator( $par );

    //Top location
    $pgnationTTM = isset( $tplateOptns['_pgnationTTM'] ) ? $tplateOptns['_pgnationTTM'][0] : '';
    $pgnationTBM = isset( $tplateOptns['_pgnationTBM'] ) ? $tplateOptns['_pgnationTBM'][0] : '';

    //Bottom location
    $pgnationBTM = isset( $tplateOptns['_pgnationBTM'] ) ? $tplateOptns['_pgnationBTM'][0] : '';
    $pgnationBBM = isset( $tplateOptns['_pgnationBBM'] ) ? $tplateOptns['_pgnationBBM'][0] : '';

    $pgnationCls = isset( $tplateOptns['_pgnationCls'] ) ? esc_attr( $tplateOptns['_pgnationCls'][0] ) : '';
    $pgnationStyle = isset( $tplateOptns['_pgnationStyle'] ) ? esc_attr( $tplateOptns['_pgnationStyle'][0] ) : '';

    $pgnationTB = isset( $tplateOptns['_pgnationTB'] ) ? $tplateOptns['_pgnationTB'][0] : 'B';
    $out['T'] = '';
    $out['B'] = '';
    switch ( $pgnationTB ){
       case 'T':
           $out['T'] = abcfsl_util_pagination_cntr( $paginator, $pgnationTTM, $pgnationTBM, $pgnationCls, $pgnationStyle, $clsPfix, 'T' );
           break;
       case 'B':
           $out['B'] = abcfsl_util_pagination_cntr( $paginator, $pgnationBTM, $pgnationBBM, $pgnationCls, $pgnationStyle, $clsPfix, 'B' );
           break;
       case 'TB':
           $out['T'] = abcfsl_util_pagination_cntr( $paginator, $pgnationTTM, $pgnationTBM, $pgnationCls, $pgnationStyle, $clsPfix, 'T' );
           $out['B'] = abcfsl_util_pagination_cntr( $paginator, $pgnationBTM, $pgnationBBM, $pgnationCls, $pgnationStyle, $clsPfix, 'B' );
           break;
       default:
           break;
   }
    return $out;
}

function abcfsl_util_pagination_cntr( $paginator, $tm, $bm, $customCls, $customStyle, $clsPfix, $tb ){

    $style = abcfl_css_mtrbl( $tm, '', $bm, '' );
    $style = trim($style . ' ' . $customStyle);
    $cls = trim( $clsPfix . 'PaginationCntr'. $tb . ' ' . $customCls );
    $div = abcfsl_cnt_generic_div_simple( $cls, $style );
    return $div['cntrS'] .  $paginator . $div['cntrE'];
}

//Page URL for paginator. Remove 'pagename' query var.
 function abcfsl_util_pagination_pg_url( ){

    $staffCat = ( get_query_var('staff-category') ) ? get_query_var('staff-category' ) : false;
    $staffAZ = (get_query_var('staff-az') ) ? get_query_var( 'staff-az' ) : false;

    $permalink = trailingslashit(untrailingslashit( get_permalink() ));

    $newURL = add_query_arg( array(
        'staff-category' => $staffCat,
        'staff-az' => $staffAZ,
        'page' => '(:num)',
    ), $permalink );

    return $newURL;
 }

 //-- Paginator END ---------------------------------------

 //Categories or AZ menu. No data message.
function abcfsl_util_no_data_msg(  $tplateMenuID, $noDataMsg, $totalQty ){

    if( $tplateMenuID == '0' ) { return '';}
    if( $totalQty > 0 ) { return '';}
    if( empty( $noDataMsg ) ) { return '';}

    $div = abcfsl_cnt_generic_div_simple( 'abcfslFS16 abcfslFW600 abcfslMLRAuto abcfslPadT5 abcfslTxtCenter', '' );

    return  $div['cntrS'] .  $noDataMsg . $div['cntrE'];
}




