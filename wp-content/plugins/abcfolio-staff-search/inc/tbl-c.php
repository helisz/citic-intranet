<?php
function abcfsls_cnt_tbl_c( $scodeArgs ){
//echo"<pre>", print_r($fieldOrder), "</pre>";

    $clsPfixSL = $scodeArgs['prefix'];
    $pversion = ' ' . $clsPfixSL . '_' . $scodeArgs['pversion'];
    $tplateID = $scodeArgs['id'];

    //??????????????????????????
    //Errors. Menu not selected. Template not selected.

    //------------------------------------------------
    $tplateOptns = get_post_custom( $tplateID );
    $txtDir = isset( $tplateOptns['_txtDir'] ) ? $tplateOptns['_txtDir'][0] : 'L';
    $out = abcfsls_tbl_parts_tbl_id( $txtDir );

    //-- JS parameters ---------------
    $parJS = abcfsls_cnt_js_params( $tplateID, $out['tblID'], $tplateOptns );

    //Categories menu
    $menuCats = abcfsls_cnt_tbl_c_menu_builder( isset( $tplateOptns['_catMenuID'] ) ? $tplateOptns['_catMenuID'][0] : '0' );
    $columnTypes = abcfsls_cnt_tbl_c_column_types( $tplateOptns );

    $parJS['searchCatSlug'] = $menuCats['firstSlug'];
    $parJS['columns'] =  $columnTypes;
    $parJS['clsFItemHligh'] = $menuCats['clsFItemHligh'];
    $parJS['hdrBkgColor'] = isset( $tplateOptns['_tblHdrBkgColor'] ) ? $tplateOptns['_tblHdrBkgColor'][0] : '';
    $parJS['tblType'] = 'C';

    $jsTbl = abcfsls_cnt_js_tbl_c( $parJS );
    //-----------------------------------------

    //-- Table Header and Footer HTML -----------------
    $parTbl = abcfsls_tbl_parts_tbl_params( $out['tblID'], $tplateOptns, $out['txtLR'], $clsPfixSL, $pversion, true );
    $parTbl['searchCatSlug'] = '';

    $tblHdrFtr = abcfsls_tbl_parts_table( $parTbl );
    //-------------------------------------------------

    //Optional container if table width or top margin used
    $tblWrap = abcfsls_tbl_parts_wrap( $tplateOptns, $clsPfixSL );

    return $tblWrap['cntrS'] . $jsTbl . $menuCats['menuWrap'] . $tblHdrFtr . $tblWrap['cntrE'];
}



function abcfsls_cnt_tbl_c_column_types( $tplateOptns ){

    $fieldOrder = abcfsls_util_field_order( $tplateOptns );

    $columnTypes = array();
    foreach ( $fieldOrder as $F ) {
        $columnTypes = abcfsls_cnt_tbl_c_column_display_type( $F, $tplateOptns, $columnTypes );
    }
    return $columnTypes;

// $columnTypes
//    [F1] => TXT
//    [F4] => HPL
//    [F5] => TXT
}

//Field ID and field display type Text or Hyperlink: [F1] => TXT; [F4] => HPL
function abcfsls_cnt_tbl_c_column_display_type( $F, $tplateOptns, $columnTypes ){

    //Search field type. Quit if field is not used or hidden.
    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0]  :'N';
    $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? $tplateOptns['_hideDelete_' . $F][0]  : 'N';
    if( $fieldType == 'N' || $hideField != 'N' ) { return $columnTypes;}
    //-------------------------------------

    $linkToSingle = isset( $tplateOptns['_linkToSingle_' . $F] ) ? esc_attr( $tplateOptns['_linkToSingle_' . $F][0] ) : '0';
    if($linkToSingle == '1') { $fieldType = 'H'; }

    $columnType = 'TXT';

    switch ( $fieldType ){
        case 'H':
        case 'EM':
            $columnType = 'HPL';
            break;
       default:
            break;
    }

    $columnTypes[ $F ] = $columnType;
    return $columnTypes;
}

//=== AJAX START ===================================
function abcfsls_cnt_tbl_c_rows_data_ajax( $post ){

    $tplateID = $post['tplateID'];
    $staffTplateID = $post['staffTplateID'];
    $searchCatSlug = $post['searchCatSlug'];

    $tplateOptns = get_post_custom( $tplateID );
    $staffTOptns = get_post_custom( $staffTplateID );

    //Array. Order of Search fields. F1, F2, F3...
    $fieldOrder = abcfsls_util_field_order( $tplateOptns );

    //Single page URL from Staff Tempate shortcode
    $sPgBaseUrl = abcfsls_util_single_pg_base_url( $staffTOptns );

    $catMenuID = isset( $tplateOptns['_catMenuID'] ) ? $tplateOptns['_catMenuID'][0] : '0';
    $qryOptns = abcfsls_cnt_tbl_c_staff_ids_qry_optns( $staffTplateID, $catMenuID, $searchCatSlug );
    $staffIDs = abcfsls_db_staff_tplate_member_ids_category( $qryOptns );

    $i = 0;
    $dataArray = array();

    //print_r($staffIDs); die;

    if ( $staffIDs ) {
        foreach ( $staffIDs as $staffID ) {
            $dataArray[] = abcfsls_cnt_tbl_c_data_row( $tplateOptns, $fieldOrder, $staffTOptns, $staffID, $sPgBaseUrl);
            $i++;
        }
    }
    //Array for JSON
    return array( "data" => $dataArray );
}

function abcfsls_cnt_tbl_c_staff_ids_qry_optns( $staffTplateID, $catMenuID, $searchCatSlug ){

    $optns['staffTplateID'] = 0;
    $optns['catSlug'] = '';

    // No menu selected. Return no records.
    if( $catMenuID == 0 ){ return $optns; }
    if( empty( $searchCatSlug ) ) { return $optns; }

    //Ajax call. Use selected category as filter.
    $optns['staffTplateID'] = $staffTplateID;
    $optns['catSlug'] = $searchCatSlug;

    return $optns;
}

function abcfsls_cnt_tbl_c_data_row( $tplateOptns, $fieldOrder, $staffTOptns, $staffID, $sPgBaseUrl ){

    $staffMOptns = get_post_custom( $staffID );
    //$hideSMember = isset( $staffMOptns['_hideSMember'] ) ? esc_attr( $staffMOptns['_hideSMember'][0] ) : '0';
    //if($hideSMember == 1) { return '';}

    $tblColumns = abcfsls_cnt_tbl_c_column_types( $tplateOptns );

    $dataRow = array();
    foreach ( $tblColumns as $F => $columnType ) {
        $dataRow = abcfsls_cnt_tbl_c_data_cell( $dataRow, $tplateOptns, $staffTOptns, $staffMOptns, $F, $columnType, $sPgBaseUrl, $staffID );
    }

    //Return table row
    return $dataRow;
}

function abcfsls_cnt_tbl_c_data_cell( $dataRow, $tplateOptns, $staffTOptns, $staffMOptns, $F, $columnType, $sPgBaseUrl, $staffID ){

//echo"<pre>", print_r($staffMOptns['_showField_' . $F]), "</pre>";
//echo"<pre>", print_r($optnsSPg), "</pre>";

    $out = abcfsls_tbl_parts_field_properties( $tplateOptns, $F, $staffTOptns );

    $fieldType = $out['fieldType'];
    $staffF = $out['staffF'];
    $staffFieldType = $out['staffFieldType'];

    $c = trim( $fieldType . $staffF . $staffFieldType );

    if ( empty ( $c ) ) { return ''; }

    //$cellCnt['SHOW'] = '';
    //$cellCnt['SORT'] = '';
    //$cellCnt['SEARCH'] = '';
    //$cellCnt['SEARCH_F'] = $F;
    //Cell data
    $cellCnt = abcfsls_cnt_staff_field( $staffFieldType, $fieldType, $tplateOptns, $F, $staffMOptns, $staffF, $staffTOptns );

    //-- SINGLE PAGE. Modify $cellCnt to create link to a single page ---
    $linkToSingle = isset( $tplateOptns['_linkToSingle_' . $F] ) ? esc_attr( $tplateOptns['_linkToSingle_' . $F][0] ) : '0';
    $cellCnt = abcfsls_util_spg_cell_cnt( $staffID, $linkToSingle, $cellCnt, $staffMOptns, $sPgBaseUrl, $fieldType, $staffTOptns );
    //-------------------------------------

    $display = $cellCnt['SHOW'];
    $filter = $cellCnt['SEARCH'];
    $sort = $cellCnt['SORT'];

    if( $columnType == 'TXT' ){
        $dataRow[ $cellCnt['SEARCH_F'] ] = $display;
        return $dataRow;
    }

    $parts['_'] = $display;
    $parts['display'] = $display;
    $parts['sort'] = $sort;
    $parts['filter'] = $filter;

    $dataRow[ $cellCnt['SEARCH_F'] ] = $parts;
    return $dataRow;

    //"F3": "Tiger Nixon",
    //"F4": {
    //    "display": "Mon 25th Apr 11",
    //    "sort": "1303686000"
    //    "filter": "1303686000"
    //},
}
//=== AJAX END ===================================

//=== CATEGORIES MENU START ===================================
function abcfsls_cnt_tbl_c_menu_builder( $menuID ){

    $clsPfixSL = 'abcfsl';
    $baseCls = '';
    $customCls = '';

    $menuOptns = get_post_custom( $menuID );
    $fCntrW = isset( $menuOptns['_fCntrW'] ) ? esc_attr( $menuOptns['_fCntrW'][0] ) : '';
    $fCntrCenter = isset( $menuOptns['_fCntrCenter'] ) ? esc_attr( $menuOptns['_fCntrCenter'][0] ) : 'Y';

    // TODO check if used?
    $fCntrCls = isset( $menuOptns['_fCntrCls'] ) ? esc_attr( $menuOptns['_fCntrCls'][0] ) : '';
    $fCntrStyle = isset( $menuOptns['_fCntrStyle'] ) ? esc_attr( $menuOptns['_fCntrStyle'][0] ) : '';

    //Plugin container CSS
    $cntrStyle = abcfl_css_w_responsive( $fCntrW, $fCntrW ) . $fCntrStyle;
    $centerCls = abcfsl_cnt_menu_center_cls( $fCntrCenter, $clsPfixSL );
    $clsFItemsCntrMT = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMT'] ) ? esc_attr( $menuOptns['_fItemsCntrMT'][0] ) : 'N', 'MT', $clsPfixSL );
    $clsFItemsCntrMB = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMB'] ) ? esc_attr( $menuOptns['_fItemsCntrMB'][0] ) : 'N', 'MB', $clsPfixSL );
    $clsFtemMLR = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemMLR'] ) ? esc_attr( $menuOptns['_fItemMLR'][0] ) : '10', 'FItemMLR', $clsPfixSL );

    //Menu container -----------------
    $cntCntrCls = ltrim( trim( $centerCls . ' ' . $clsFtemMLR . ' ' . $clsFItemsCntrMB . ' ' . $clsFItemsCntrMT ) );
    $div = abcfsl_cnt_menu_generic_div($clsPfixSL, 'FiltersCntr', $cntCntrCls, $cntrStyle, '', '', $menuID, 'Y', false);

    $menuCntr = abcfsls_cnt_tbl_c_menu_items_cntr( $menuID, $menuOptns, $baseCls, $customCls, $clsPfixSL );

//echo"<pre>", print_r($menu), "</pre>";

    $menu['menuWrap'] = $div['cntrS'] . $menuCntr['menuCntr'] . $div['cntrE'];
    $menu['firstSlug'] = $menuCntr['firstSlug'];
    $menu['clsFItemHligh'] = $menuCntr['clsFItemHligh'];

    return $menu;
}

//Retuns array: Menu container DIV + UL + Items AND parameters.
function abcfsls_cnt_tbl_c_menu_items_cntr(  $menuID, $menuOptns, $baseCls, $customCls, $clsPfixSL ){

    //Categories list ID
    $ulID = 'slsUlCats';
    $ulCls = '';

    $clsFItemColor = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemColor'] ) ? esc_attr( $menuOptns['_fItemColor'][0] ) : 'D', 'FItemColor', $clsPfixSL );
    $clsFiltersCntr = trim ( $clsPfixSL . 'FItemsCntr ' . $clsFItemColor . ' ' . $customCls );
    $fItemsCenter = isset( $menuOptns['_fItemsCenter'] ) ? esc_attr( $menuOptns['_fItemsCenter'][0] ) : 'Y';
    if($fItemsCenter == 'Y') { $ulCls = $clsPfixSL . 'TxtCenter'; }

    //Div, filters container.
    $divFiltersCntr = abcfsl_cnt_menu_generic_div( $clsPfixSL, $baseCls, $clsFiltersCntr, '' );

    $menuItems = abcfsls_cnt_tbl_c_cat_items( $menuID, $menuOptns, $clsPfixSL );

    $menu['menuCntr'] = $divFiltersCntr['cntrS'] . abcfl_html_tag( 'ul', $ulID, $ulCls ) . $menuItems['menuItemsHTML'] . abcfl_html_tag_end( 'ul'). $divFiltersCntr['cntrE'];
    $menu['firstSlug'] = $menuItems['firstSlug'];
    $menu['clsFItemHligh'] = $menuItems['clsFItemHligh'];

    return $menu;
}

//Categories menu. Items HTML & parameters for DB.
function abcfsls_cnt_tbl_c_cat_items( $menuID, $menuOptns, $clsPfixSL ){

    $cats = array();
    $category = '';
    $noSlugTxt = ' Slug doesn\'t exist: ';
    $noSlug = false;

    $out['firstSlug'] = '';
    $out['qryFilter'] = '';
    $out['menuItemsHTML'] = '';
    $out['menuType'] = 'CAT';
    $out['filterField'] = '';

    //----------------------------------
    $terms = get_terms( array(
        'taxonomy' => 'tax_staff_member_cat',
        'hide_empty' => false
    ));

    //Create array: slug - category name
    foreach ( $terms as $slugCat ) {
        $cats[$slugCat->slug] = $slugCat->name;
    }

    //----------------------------------
    $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
    $catSlugs = get_post_meta( $menuID, '_catSlugs', true );

    $clsFItemFont = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemFont'] ) ? esc_attr( $menuOptns['_fItemFont'][0] ) : 'D', 'F', $clsPfixSL );
    $clsFItemHligh = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'D', 'FActive', $clsPfixSL );
    $upCase = isset( $menuOptns['_upCase'] ) ? esc_attr( $menuOptns['_upCase'][0] ) : 'N';

    $showAllLast = isset( $menuOptns['_showAllLast'] ) ? esc_attr( $menuOptns['_showAllLast'][0] ) : '0';

    $itemPar['clsFItemFont'] = $clsFItemFont;
    $itemPar['clsFItemHligh'] = $clsFItemHligh;
    $itemPar['upCase'] = $upCase;
    $itemPar['category'] = '';
    $itemPar['catSlug'] = '';
    $itemPar['noSlug'] = false;
    $itemPar['clsPfix'] = $clsPfixSL;
    $itemPar['currentItem'] = 0;

    //------------------------------------------------------------
    $firstSlug = '';
    $menuItemsHTML  = '';

    $itemAll = abcfsls_cnt_tbl_c_cat_item_all( $defaultFTxt, $showAllLast, $itemPar );
    $itemAllHTML = $itemAll['itemHTML'];

    $i = 1;
    if( !empty( $itemAllHTML ) ){
        if( $itemAll['first'] ){
            $itemPar['currentItem'] = $i;
            $i++;
        }
    }

    if ( !$catSlugs ){
        $out['menuItemsHTML'] = $menuItemsHTML;
        return $out;
    }
    //----------------------------------------------------------

    foreach ( $catSlugs as $field ) {
        $catSlug = esc_attr( $field['catSlug'] );

        if(isset( $cats[$catSlug] ) ){
            $category = $cats[$catSlug];
        }
        else {
            $category = $noSlugTxt . $catSlug;
            $noSlug = true;
        }

        $itemPar['category'] = $category;
        $itemPar['catSlug'] = $catSlug;
        $itemPar['noSlug'] = $noSlug;
        $itemPar['currentItem'] = $i;

        if( $i == 1 ) { $firstSlug = trim( $catSlug ); }
        $menuItemsHTML .= abcfsls_cnt_tbl_c_cat_item( $itemPar );
        $i++;
    }

    if( !empty( $itemAllHTML) ){
        if( $showAllLast == 0 ){
            $firstSlug = 'all';
            $menuItemsHTML = $itemAllHTML . $menuItemsHTML;
        }
        else {
            $menuItemsHTML = $menuItemsHTML . $itemAllHTML;
        }
    }

    $out['clsFItemHligh'] = $clsFItemHligh;
    $out['firstSlug'] = $firstSlug;
    $out['menuItemsHTML'] = $menuItemsHTML;
    return $out;
}

function abcfsls_cnt_tbl_c_cat_item_all( $defaultFTxt, $showAllLast, $itemPar ){

    $out['itemHTML'] = '';
    $out['first'] = false;

    $hasShowAll = false;
    if( !abcfl_html_isblank( $defaultFTxt ) ) { $hasShowAll = true; }
    if( !$hasShowAll ) { return $out; }

    if( $showAllLast == 0 ) {
        $out['first'] = true;
        $itemPar['currentItem'] = 1;
    }
    else {
        $out['first'] = false;
        $itemPar['currentItem'] = 0;
    }

    //--------------------------------------------
    $itemPar['category'] = $defaultFTxt;
    $itemPar['catSlug'] = 'all';
    $out['itemHTML'] = abcfsls_cnt_tbl_c_cat_item( $itemPar );

    return $out;

}

//Menu item. Single LI element with text hyperlink.
function abcfsls_cnt_tbl_c_cat_item( $itemPar ){

    $category = $itemPar['category'];

    //Slug doesn't exist.
    if( $itemPar['noSlug'] ) { return $category; }

    $clsActive = '';
    if( $itemPar['currentItem'] == 1 ){ $clsActive = $itemPar['clsFItemHligh']; }

    // a class="abcfslFActive1 abcfslUpper  abcfslF18_6
    $clsATag = trim( $clsActive . abcfsl_cnt_menu_cat_upper( $itemPar['upCase'], $itemPar['clsPfix'] ) . ' ' . $itemPar['clsFItemFont'] );
    //$cat1 =  abcfl_html_a_tag('#', 'Administratrators', '', 'staffCat', '', '', true, '', 'data-slug="administrators"');
    $catTag =  abcfl_html_a_tag('#', $category, '', $clsATag, '', '', true, '', 'data-slug="' . $itemPar['catSlug'] . '"');

    //-----------------------------------------------------
    return abcfl_html_tag_with_content( $catTag, 'li', '');
}
//=== CATEGORIES MENU END  ===================================

