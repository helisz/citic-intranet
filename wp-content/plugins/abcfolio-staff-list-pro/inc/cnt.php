<?php
//ALL CONTENT HTML. Called from a shortcode. Used by all layouts.
//Calls individual layouts. menus, pagination.
function abcfsl_cnt_html( $scodeArgs ){

    $tplateID = $scodeArgs['id'];
    $pageNo = $scodeArgs['page'];
    $clsPfix = $scodeArgs['prefix'];
    //SCMENUID
    $scodeMenuID = $scodeArgs['menu-id'];
    //----------------------------------------
    $tplateOptns = get_post_custom( $tplateID );
    $tplateOptns['tplateID'] = $tplateID;


    //$parentID is always used to get staff member IDs.
    $parentID = $tplateID;
    if( $scodeArgs['master'] > 0 ){ $parentID = $scodeArgs['master']; }
    //----------------------------------------
    //$sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $lstCntrW = isset( $tplateOptns['_lstCntrW'] ) ? esc_attr( $tplateOptns['_lstCntrW'][0] ) : '';
    $lstACenter = isset( $tplateOptns['_lstACenter'] ) ? esc_attr( $tplateOptns['_lstACenter'][0] ) : 'Y';
    $lstCntrCls = isset( $tplateOptns['_lstCntrCls'] ) ? esc_attr( $tplateOptns['_lstCntrCls'][0] ) : '';
    $lstCntrStyle = isset( $tplateOptns['_lstCntrStyle'] ) ? esc_attr( $tplateOptns['_lstCntrStyle'][0] ) : '';
    $pgnationPgQty = isset( $tplateOptns['_pgnationPgQty'] ) ? $tplateOptns['_pgnationPgQty'][0] : 0;
    //------------------------------------------------

    //SCMENUID
    $tplateMenuID = isset( $tplateOptns['_tplateMenuID'] ) ? esc_attr( $tplateOptns['_tplateMenuID'][0] ) : '';
    if( empty( $tplateMenuID ) ) { $tplateMenuID = $scodeMenuID; }

    // MULTIFILTER
    $filters = abcfsl_cnt_filter_post( $tplateMenuID );
    $filtersEmpty = abcfsl_cnt_filters_empty( $filters );

    //No paging if there are any search criteria present.
    if( !$filtersEmpty )  {
        $pgnationPgQty = 0;
        $pageNo = 0;
        $tplateOptns['_pgnationPgQty'][0] = 0;
    }
    //------------------------------------------------
    //??????????????????????????????????????????????
    //$lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : $clsPfix . 'ImgCenter';
    //$tplateOptns['_lstImgCls'] = array($lstImgCls);

    //-- Plugin container --------------------------------------------
    $cntCntrStyle = abcfl_css_w_responsive( $lstCntrW, $lstCntrW ) . $lstCntrStyle;
    $centerCls = abcfsl_util_center_cls( $lstACenter, $clsPfix );
    $cntCntrCustomCls = $lstCntrCls . $centerCls . ' ' . 'SL_' . $scodeArgs['tplate'] . '_v' . $scodeArgs['pversion'];
    $gridCntr = abcfsl_cnt_generic_div( $clsPfix, 'GridCntr', $cntCntrCustomCls, $cntCntrStyle, '', '', $tplateID, 'Y', false);

    //-- Get menu -------------------------------------
    $noDataMsgOld = isset( $tplateOptns['_noDataMsg'] ) ? esc_attr( $tplateOptns['_noDataMsg'][0] ) : '';

    //Menu HTML + menu options. Not search criteria. // MULTIFILTER
    $menu = abcfsl_cnt_menu_from_staff_shortcode( $tplateMenuID, $scodeArgs, $filters );

    $noDataMsg = $menu['noDataMsg'];
    if( empty( $noDataMsg ) ) { $noDataMsg = $noDataMsgOld; }

    $menuItemsHTML = $menu['menuItemsHTML'];
    $menu['menuItemsHTML'] = '';
    //-----------------------------------
    $optns['menu'] = $menu;
    $optns['scodeCat'] = $scodeArgs['category'];
    $optns['scodeOrder'] = $scodeArgs['order'];
    $optns['random'] = $scodeArgs['random'];
    $optns['top'] = $scodeArgs['top'];
    $optns['parentID'] =  $parentID;
    //-- PG -------------------
    $optns['pageNo'] =  $pageNo;
    $optns['pgnationPgQty'] =  $pgnationPgQty;
    $optns['staffID'] =  $scodeArgs['staff-id'];
    $optns['filters'] =  $filters;
    $optns['filtersEmpty'] = $filtersEmpty;
    //----------------------------------------------------
    //Returns grid items. Takes menu options. Returns filtered grid based on menu options.
    $items['itemsHTML'] = '';
    $items['totalQty'] = 0;
    $items['sdProperties'] = array();
    $items['js'] = '';

    //ISOTOPE
    switch ( $scodeArgs['tplate'] ) {
        case 'A' :
            $items = abcfsl_cnt_grid_a( $tplateOptns, $optns, $clsPfix );
            break;
        case 'B' :
            $items = abcfsl_cnt_grid_b( $tplateOptns, $optns, $clsPfix );
            break;
        case 'L' :
            $items = abcfsl_cnt_list( $tplateOptns, $optns, $clsPfix );
            break;
        case 'IA' :
            $items = abcfsl_cnt_grid_ia( $tplateOptns, $optns, $clsPfix );
            $out = abcfsl_cnt_return_isotope( $items, $gridCntr );
            return $out;
        default:
            break;
   }

     //-- PG -- Returns pagination section.
    $pagination = abcfsl_util_pagination( $tplateOptns, $items['totalQty'], $pageNo, $clsPfix );

    $msg = abcfsl_util_no_data_msg( $tplateMenuID, $noDataMsg, $items['totalQty'] );

    //Menu + pagination + Grid Items.
    //return $menuItemsHTML . $msg . $gridCntr['cntrS'] . $pagination['T'] . $items['itemsHTML']. $pagination['B'] . $gridCntr['cntrE'];

    $cntHTML = $menuItemsHTML . $msg . $gridCntr['cntrS'] . $pagination['T'] . $items['itemsHTML']. $pagination['B'] . $gridCntr['cntrE'];
    $cntSD = abcfsl_struct_data( $items['itemsSD'] );

    return $cntHTML . $cntSD;

}

function abcfsl_cnt_return_isotope( $items, $gridCntr ){

    //$msg = abcfsl_util_no_data_msg( $tplateMenuID, $noDataMsg, $items['totalQty'] );
    $msg = '';
    $isotopeMenu = '';
    $cntHTML =  $items['js'] . $isotopeMenu . $gridCntr['cntrS'] . $items['itemsHTML'] . $gridCntr['cntrE'];

    $cntSD = abcfsl_struct_data( $items['itemsSD'] );

    return $cntHTML . $cntSD;

}

//=======================================================================
/*
 * Content builders. Used by all layouts
 * Returns single text field container + content.
 */

//TEXT FIELD BUILDER. Renders single text fiel, dcontainer + content.
function abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $itemID, $sPageUrl, $F, $isSingle, $clsPfix ){

    $showFieldOn = '';
    $showField = true;
    $fieldType = 'N';

     //Quit if field is not selected or hidden.
    switch ( $F ){
        case 'SL': //Social PRO
            $showSocial = isset( $tplateOptns['_showSocial'] ) ? esc_attr( $tplateOptns['_showSocial'][0] ) : 'N';
            if( $showSocial != 'Y' ) { return ''; }

            $showFieldOn = isset( $tplateOptns['_showSocialOn'] ) ? esc_attr( $tplateOptns['_showSocialOn'][0] ) : 'Y';
            $fieldType = 'SL';
            break;
        case 'SPTL': //Single Page Text link
            $sPgLnkShow = isset( $tplateOptns['_sPgLnkShow'] ) ? $tplateOptns['_sPgLnkShow'][0] : 'N';
            if( $sPgLnkShow != 'Y' ) { return ''; }
            $showFieldOn = 'L';
            $fieldType = 'SPTL';
            break;
       default:
            $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
            $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? esc_attr( $tplateOptns['_hideDelete_' . $F][0] ) : 'N';
            if( $fieldType == 'N' || $hideField != 'N' ) { return ''; }

            $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';
            break;
    }

    //Quit if field is not selected or hidden.
    //if( !$showField ){ return ''; }

    switch ( $showFieldOn ){
        case 'L': //List only
            if( $isSingle ){ $showField = false; }
            break;
        case 'S': //Single page only
            if( !$isSingle ){ $showField = false; }
            break;
       default:
            break;
    }
    if( !$showField ){ return ''; }

    //------------------------------------------------------------
    $tagCls = '';
    $marginT = '';
    $tagFont = '';
    $tagType = '';
    $tagStyle = '';
    $newTab = '';

    $href['hrefUrl'] = '';
    $href['hrefTxt'] = '';
    $href['target'] = '';

    switch ($F){
        case 'SPTL':
            $tagType = isset( $tplateOptns['_sPgLnkTag'] ) ? $tplateOptns['_sPgLnkTag'][0] : 'div';
            $tagCls = isset( $tplateOptns['_sPgLnkCls'] ) ? esc_attr( $tplateOptns['_sPgLnkCls'][0] ) : '';
            $tagStyle = isset( $tplateOptns['_sPgLnkStyle'] ) ? esc_attr( $tplateOptns['_sPgLnkStyle'][0] ) : '';
            $marginT = isset( $tplateOptns['_sPgLnkMarginT'] ) ? $tplateOptns['_sPgLnkMarginT'][0] : 'N';
            $tagFont = isset( $tplateOptns['_sPgLnkFont'] ) ? $tplateOptns['_sPgLnkFont'][0] : 'D';

            $newTab = isset( $tplateOptns['_sPgLnkNT'] ) ? $tplateOptns['_sPgLnkNT'][0] : '0';
            if( $newTab == '0' ) { $newTab = 'N';} else { $newTab = 'Y';}

            $lineTxt = isset( $tplateOptns['_sPgLnkTxt'] ) ? esc_attr( $tplateOptns['_sPgLnkTxt'][0] ) : '';
            break;

       default:
            $tagType = isset( $tplateOptns['_tagType_' . $F] ) ? esc_attr( $tplateOptns['_tagType_' . $F][0] ) : 'div';
            $tagCls = isset( $tplateOptns['_tagCls_' . $F] ) ? esc_attr( $tplateOptns['_tagCls_' . $F][0] ) : '';
            $tagStyle = isset( $tplateOptns['_tagStyle_' . $F] ) ? esc_attr( $tplateOptns['_tagStyle_' . $F][0] ) : '';
            $marginT = isset( $tplateOptns['_tagMarginT_' . $F] ) ? esc_attr( $tplateOptns['_tagMarginT_' . $F][0] ) : 'N';
            $tagFont = isset( $tplateOptns['_tagFont_' . $F] ) ? esc_attr( $tplateOptns['_tagFont_' . $F][0] ) : 'D';
            $newTab = isset( $tplateOptns['_newTab_' . $F] ) ? esc_attr( $tplateOptns['_newTab_' . $F][0] ) : 'N';

            $href = abcfsl_util_href_bldr( $itemOptns, $itemID, $sPageUrl, $F );

            // HTML
            $lineTxt = isset( $itemOptns['_txt_' . $F] ) ? $itemOptns['_txt_' . $F][0]  : '';
            break;
    }

    //Field container custom class.
    $tagCustCls = abcfsl_util_pg_type_cls_bldr( $tagCls, $isSingle );

    //Top margin. Class name or empty string if Default or Custom selected.
    $tagMarginT = abcfsl_util_cls_name_nc_bldr( $marginT, 'MT', $clsPfix );

    //Font Size. Class name or empty string if Default or Custom selected.
    $tagFont = abcfsl_util_cls_name_nc_bldr( $tagFont, 'F', $clsPfix );

    //Tag, all classes.
    $tagClss = ltrim ( $tagMarginT . ' ' . $tagFont . ' ' . $tagCustCls );

    //------------------------------------------------------------

    $par = array(
        'tagType' => $tagType,
        'tagCls' => $tagClss,
        'tagStyle' => $tagStyle,
        'lnkCls' => isset( $tplateOptns['_lnkCls _' . $F] ) ? esc_attr( $tplateOptns['_lnkCls_' . $F][0] ) : '',
        'lnkStyle' => isset( $tplateOptns['_lnkStyle_' . $F] ) ? esc_attr( $tplateOptns['_lnkStyle_' . $F][0] ) : '',
        'lblTxt' => isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0] ) : '',
        'lblCls' => isset( $tplateOptns['_lblCls_' . $F] ) ? esc_attr( $tplateOptns['_lblCls_' . $F][0] ) : '',
        'lblStyle' => isset( $tplateOptns['_lblStyle_' . $F] ) ? esc_attr( $tplateOptns['_lblStyle_' . $F][0] ) : '',
        'txtCls' => isset( $tplateOptns['_txtCls_' . $F] ) ? esc_attr( $tplateOptns['_txtCls_' . $F][0] ) : '',
        'txtStyle' => isset( $tplateOptns['_txtStyle_' . $F] ) ? esc_attr( $tplateOptns['_txtStyle_' . $F][0] ) : '',
        'newTab' => $newTab,
        'lineTxt'  => $lineTxt,
        'editorCnt'  => isset( $itemOptns['_editorCnt_' . $F] ) ? esc_attr( $itemOptns['_editorCnt_' . $F][0] ) : '',
        'hrefUrl' => $href['hrefUrl'],
        'hrefTxt' => $href['hrefTxt'],
        'target' => $href['target'],
        'F' => $F,
        'sPageUrl' => $sPageUrl,
        'itemID'  => $itemID,
        'isSingle'  => $isSingle,
        'clsPfix'  => $clsPfix,
        'statTxt'  => isset( $tplateOptns['_statTxt_' . $F] ) ? $tplateOptns['_statTxt_' . $F][0] : '',
        'statTxtFs'  => isset( $tplateOptns['_statTxtFs_' . $F] ) ? $tplateOptns['_statTxtFs_' . $F][0] : ''
    );

    $out = '';
    switch ( $fieldType ){
        case 'T': //Text
        case 'PT': //Paragraph Text
            $out = abcfsl_cnt_txt_field_T( $par );
            break;
        case 'LT': //Lsbel + Text
            $out = abcfsl_cnt_txt_field_LT( $par );
            break;
        case 'STXT': //Static Text
            $out = abcfsl_cnt_txt_field_STXT( $par, $tplateOptns, $itemOptns, $F );
            break;
        case 'H': //Hyperlink
            $out = abcfsl_cnt_txt_field_H( $par );
            break;
        case 'TH': //Static Text + Hyperlink
            $out = abcfsl_cnt_txt_field_TH( $par, $itemOptns );
            break;
        case 'EM': //Email
            $out = abcfsl_cnt_txt_field_EM( $par );
            break;
         case 'MP': //Multipart
            $out = abcfsl_cnt_txt_field_MP( $par, $tplateOptns, $itemOptns, $F );
            break;
        case 'CE': //HTML
            $out = abcfsl_cnt_txt_field_WPE( $par );
            break;
        case 'HL': //PRO --- Horizontal Line
            $out = abcfsl_cnt_txt_field_HL( $par['tagCls'], $par['tagStyle'], $clsPfix );
            break;
        case 'SC': //PRO --- Shortcode
            $out = abcfsl_cnt_txt_field_SC( $par );
            break;
        case 'SPTL':  //Single Page Text Link
            $out = abcfsl_cnt_txt_field_SPTL( $par, $itemOptns );
            break;
        case 'SH': //Single Page Hyperlink
            $out = abcfsl_cnt_txt_field_SH( $par, $itemOptns, $F );
            break;
        case 'SL': //PRO --- Social Links
            $out = abcfsl_cnt_social_txt_field_SL( $par, $itemOptns, $tplateOptns );
            break;
       default:
            break;
    }
    return $out;
}

//Static Text
function abcfsl_cnt_txt_field_STXT( $par, $tplateOptns, $itemOptns, $F ){

    $txt = $par['statTxt'];
    if(abcfl_html_isblank($txt)) { return ''; }

    $render = abcfsl_util_have_content( $par['statTxtFs'], $tplateOptns, $itemOptns, $par['isSingle'] );
    if( !$render ) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $txt . $cntrE;
}

function abcfsl_util_have_content( $Fs, $tplateOptns, $itemOptns, $isSingle ){

    if( empty( $Fs ) ) { return true;  }
    $Fs = trim($Fs, ',');
    if( empty( $Fs ) ) { return true;  }

    $fieldFs = explode(",", $Fs);
    $values = '';
    foreach( $fieldFs as $F ) {
        $values .= abcfsl_util_field_has_value( $tplateOptns, $itemOptns, $F, $isSingle );
    }

    if( abcfl_html_isblank($values ) ) { return false; }
    return true;
}

function abcfsl_util_field_has_value( $tplateOptns, $itemOptns, $F, $isSingle ){

    $showFieldOn = isset( $tplateOptns['_showField_' . $F] ) ? esc_attr( $tplateOptns['_showField_' . $F][0] ) : 'L';

    switch ( $showFieldOn ){
        case 'N':
            if( $isSingle ){ return ''; }
            break;
        case 'L': //List only
            if( $isSingle ){ return ''; }
            break;
        case 'S': //Single page only
            if( !$isSingle ){ return ''; }
            break;
       default:
            break;
    }

    $txt = isset( $itemOptns['_txt_' . $F] ) ? $itemOptns['_txt_' . $F][0]  : '';
    if( !abcfl_html_isblank( $txt ) ) { return 'x'; }

    $txt = isset( $itemOptns['_url_' . $F] ) ? esc_attr( $itemOptns['_url_' . $F][0] ) : '';
    if( !abcfl_html_isblank( $txt ) ) { return 'x'; }

    $txt = isset( $itemOptns['_editorCnt_' . $F] ) ? esc_attr( $itemOptns['_editorCnt_' . $F][0] ) : '';
    if( !abcfl_html_isblank( $txt ) ) { return 'x'; }

    return '';
}

//==SINGLE PAGE LINK ===========================================================
//Single Page Hyperlink
function abcfsl_cnt_txt_field_SPTL( $par, $itemOptns ){

    $url = 'SP';
    if( $par['newTab'] == 'Y' ) { $url = 'NT SP'; }

    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';
    $href = abcfsl_util_href_bldr_SPTL( $url, $par['lineTxt'], $pretty, $par['itemID'], $par['sPageUrl'] );
    $link = abcfl_html_a_tag( $href['hrefUrl'], $href['hrefTxt'], $href['target'], $par['lnkCls'], $par['lnkStyle'], '', false);

    return abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] ) . $link . abcfl_html_tag_end( $par['tagType']);
}

//Single Page Hyperlink. Discontinued.
function abcfsl_cnt_txt_field_SH( $par, $itemOptns, $F ){

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $url = 'SP';
    if( $par['newTab'] == 'Y' ) { $url = 'NT SP'; }
    $itemOptns['_url_' . $F] = array( $url );
    $itemOptns['_urlTxt_' . $F] = array( $par['lblTxt'] );

    $href = abcfsl_util_href_bldr( $itemOptns, $par['itemID'], $par['sPageUrl'], $F );

    $link = abcfl_html_a_tag( $href['hrefUrl'], $href['hrefTxt'], $href['target'], $par['lnkCls'], $par['lnkStyle'], '', false);
    return $cntrS . $link . $cntrE;
}
//=======================================================================
//---MP builder START -------------------------------------------------------------
function abcfsl_cnt_txt_field_MP( $par, $tplateOptns, $itemOptns, $F ){

    $name = abcfsl_cnt_txt_field_MP_string_bldr( $tplateOptns, $itemOptns, $F, $par['isSingle'] );
    if( abcfl_html_isblank( $name ) ) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $name . $cntrE;
}

function abcfsl_cnt_txt_field_MP_string_bldr( $tplateOptns, $itemOptns, $F, $isSingle, $addSpan=true ){

    $mp1 = isset( $itemOptns['_mp1_' . $F] ) ? esc_attr( $itemOptns['_mp1_' . $F][0] ) : '';
    $mp2 = isset( $itemOptns['_mp2_' . $F] ) ? esc_attr( $itemOptns['_mp2_' . $F][0] ) : '';
    $mp3 = isset( $itemOptns['_mp3_' . $F] ) ? esc_attr( $itemOptns['_mp3_' . $F][0] ) : '';
    $mp4 = isset( $itemOptns['_mp4_' . $F] ) ? esc_attr( $itemOptns['_mp4_' . $F][0] ) : '';

    if( abcfl_html_isblank( $mp1 ) && abcfl_html_isblank( $mp2 ) && abcfl_html_isblank( $mp3 ) && abcfl_html_isblank( $mp4 ) ) { return ''; }

    $orderP1 = '';
    $orderP2 = '';
    $orderP3 = '';
    $orderP4 = '';
    $sfixP1 = '';
    $sfixP2 = '';
    $sfixP3 = '';
    $sfixP4 = '';

    if( !$isSingle ){
        $orderP1 = isset( $tplateOptns['_orderLP1_' . $F] ) ? $tplateOptns['_orderLP1_' . $F][0] : '0';
        $orderP2 = isset( $tplateOptns['_orderLP2_' . $F] ) ? esc_attr( $tplateOptns['_orderLP2_' . $F][0] ) : '0';
        $orderP3 = isset( $tplateOptns['_orderLP3_' . $F] ) ? esc_attr( $tplateOptns['_orderLP3_' . $F][0] ) : '0';
        $orderP4 = isset( $tplateOptns['_orderLP4_' . $F] ) ? esc_attr( $tplateOptns['_orderLP4_' . $F][0] ) : '0';

        $sfixP1 = isset( $tplateOptns['_sfixLP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP1_' . $F][0] ) : '';
        $sfixP2 = isset( $tplateOptns['_sfixLP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP2_' . $F][0] ) : '';
        $sfixP3 = isset( $tplateOptns['_sfixLP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP3_' . $F][0] ) : '';
        $sfixP4 = isset( $tplateOptns['_sfixLP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixLP4_' . $F][0] ) : '';
    }
    else {
        $orderP1 = isset( $tplateOptns['_orderSP1_' . $F] ) ? esc_attr( $tplateOptns['_orderSP1_' . $F][0] ) : '0';
        $orderP2 = isset( $tplateOptns['_orderSP2_' . $F] ) ? esc_attr( $tplateOptns['_orderSP2_' . $F][0] ) : '0';
        $orderP3 = isset( $tplateOptns['_orderSP3_' . $F] ) ? esc_attr( $tplateOptns['_orderSP3_' . $F][0] ) : '0';
        $orderP4 = isset( $tplateOptns['_orderSP4_' . $F] ) ? esc_attr( $tplateOptns['_orderSP4_' . $F][0] ) : '0';

        $sfixP1 = isset( $tplateOptns['_sfixSP1_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP1_' . $F][0] ) : '';
        $sfixP2 = isset( $tplateOptns['_sfixSP2_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP2_' . $F][0] ) : '';
        $sfixP3 = isset( $tplateOptns['_sfixSP3_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP3_' . $F][0] ) : '';
        $sfixP4 = isset( $tplateOptns['_sfixSP4_' . $F] ) ? esc_attr( $tplateOptns['_sfixSP4_' . $F][0] ) : '';
    }

    $parts = array();
    if( abcfsl_cnt_MP_field_not_empty( $orderP1, $mp1 ) ) { $parts[1] = abcfsl_cnt_MP_field_array( $orderP1, $mp1, $sfixP1, 'MP1' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP2, $mp2 ) ) { $parts[2] = abcfsl_cnt_MP_field_array( $orderP2, $mp2, $sfixP2, 'MP2' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP3, $mp3 ) ) { $parts[3] = abcfsl_cnt_MP_field_array( $orderP3, $mp3, $sfixP3, 'MP3' ); }
    if( abcfsl_cnt_MP_field_not_empty( $orderP4, $mp4 ) ) { $parts[4] = abcfsl_cnt_MP_field_array( $orderP4, $mp4, $sfixP4, 'MP4' ); }

    usort( $parts, 'abcfsl_cnt_MP_fields_fix_sort' );

    $partTxt = '';
    $span = '';
    $i = 0;
    $partNo = '';
    foreach ( $parts as $values ) {
        foreach ($values as $key => $value) {
            switch ( $key ){
                case 'mp':
                    $partTxt .= $value;
                    $i++;
                    break;
                case 'sfix':
                    $partTxt .= $value;
                    $i++;
                    break;
                case 'part':
                    $partNo = $value;
                    $i++;
                    break;
                default:
                    break;
            }
            if( $i == 3 ){
                //$span .= '<span class="abcfslSpan' . $partNo . '">' . $partTxt . ' </span>';
                if( $addSpan ){
                    $span .= '<span class="abcfslSpan' . $partNo . '">' . $partTxt . ' </span>';
                }
                else{
                    $span .= $partTxt . ' ';
                }
                $partTxt = '';
                $partNo = '';
                $i = 0;
            }
        }
    }
//<div class="abcfslMT15  abcfslF18_6 lstMP1">
//<span class="abcfslMP2">Ashworth, </span>
//<span class="abcfslMP1">Jessica </span>
//<span class="abcfslMP3">Title </span>
//<span class="abcfslMP4">Super </span>
//</div>

    return trim( $span );
}

function abcfsl_cnt_MP_field_not_empty( $order, $mp ){

    if( $order != 0 && !abcfl_html_isblank( $mp ) ){
        return true;
    }
    return false;
}

function abcfsl_cnt_MP_field_array( $order, $mp, $sfix, $part ){
    return array('order' => $order, 'mp' => $mp, 'sfix' => $sfix, 'part' => $part );
}

function abcfsl_cnt_MP_fields_fix_sort( $a, $b ){
    return $a['order'] - $b['order'];
}
//---MP builder END -----------------------------------------------------

//PRO --- Horizontal Line
function abcfsl_cnt_txt_field_HL($tagCls, $tagStyle, $clsPfix){

    //if(empty($tagCls)) { $tagCls = 'abcfslBB12 abcfsWidth100'; }
    if(empty($tagCls)) { $tagCls = $clsPfix . 'BB12 ' . $clsPfix . 'Width100'; }
    return abcfl_html_tag( 'div', '', $tagCls, $tagStyle ) . abcfl_html_tag_end( 'div');
}

//PRO --- Shortcode
function abcfsl_cnt_txt_field_SC( $par ){

    $scode = $par['lineTxt'];
    if(abcfl_html_isblank($scode)) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . do_shortcode($scode) . $cntrE;
}

//Text
function abcfsl_cnt_txt_field_T( $par ){

    $txt = $par['lineTxt'];
    if(abcfl_html_isblank($txt)) { return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . $txt . $cntrE;
}

//Label & Text (span)
function abcfsl_cnt_txt_field_LT( $par ){

    $lineTxt = $par['lineTxt'];
    if( abcfl_html_isblank( $lineTxt ) ) { return ''; }

    if(abcfl_html_isblank($par['lblTxt'])) { return abcfsl_cnt_txt_field_T($par); }

    $tagCls = abcfsl_util_pg_type_cls_bldr( $par['tagCls'], $par['isSingle'] );
    $lblCls = abcfsl_util_pg_type_cls_bldr( $par['lblCls'], $par['isSingle'] );
    $txtCls = abcfsl_util_pg_type_cls_bldr( $par['txtCls'], $par['isSingle'] );

    $cntrS = abcfl_html_tag( $par['tagType'], '', $tagCls, $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $spanLblS = abcfl_html_tag( 'span', '', $lblCls, $par['lblStyle']  );
    $spanTxtS = abcfl_html_tag( 'span', '', $txtCls, $par['txtStyle'] );

    $spanE = abcfl_html_tag_end('span');

    return $cntrS . $spanLblS . html_entity_decode( $par['lblTxt'] ) . '&nbsp;' . $spanE . $spanTxtS . html_entity_decode($lineTxt) . $spanE . $cntrE;
}

//Hyperlink
function abcfsl_cnt_txt_field_H( $par ){

    if( empty( $par['hrefUrl'] ) ){ return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    //abcfl_html_a_tag($href, $inputLinkLbl, $target='', $cls='', $style='', $spanStyle='', $blankTag=true, $onclickJS='', $args='')
    $link = abcfl_html_a_tag( $par['hrefUrl'], $par['hrefTxt'], $par['target'], $par['lnkCls'], $par['lnkStyle'], '', false);
    return $cntrS . $link . $cntrE;
}

//Static Text + Hyperlink
function abcfsl_cnt_txt_field_TH( $par ){

    if( empty( $par['hrefUrl'] ) ){ return ''; }

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    $link = abcfl_html_a_tag( $par['hrefUrl'], $par['lblTxt'], $par['target'], $par['lnkCls'], $par['lnkStyle'], '', false);
    return $cntrS . $link . $cntrE;
}

// Email
function abcfsl_cnt_txt_field_EM( $par ){

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);
    $url = $par['hrefUrl'];
    $urlTxt = $par['hrefTxt'];
    if(empty($url)){ return ''; }
    if(empty($urlTxt)){ return $urlTxt = $url; }
    $url = 'mailto:' . $url;

    $link = abcfl_html_a_tag($url, $urlTxt, '0', $par['lnkCls'], $par['lnkStyle'], '', false);
    return $cntrS . $link . $cntrE;
}

//Text editor
function abcfsl_cnt_txt_field_WPE($par){

    $editorCnt = $par['editorCnt'];
    if(abcfl_html_isblank($editorCnt)) { return ''; }
    $cnt = html_entity_decode($editorCnt);

    $cntrS = abcfl_html_tag( $par['tagType'], '', $par['tagCls'], $par['tagStyle'] );
    $cntrE = abcfl_html_tag_end( $par['tagType']);

    return $cntrS . apply_filters('the_content', $cnt) . $cntrE;
}
//== TEXT FIELDS END ===========================================================

//IMAGE container.
// 1. abcfsl_cnt_list_item_cntr; abcfsl_cnt_spage_img_cntr
// 3. abcfsl_cnt_grid_item
function abcfsl_cnt_image_cntr( $tplateOptns, $itemOptns, $par ){

    //print_r($par);

    $pgLayout = $par['pgLayout'];
    $itemID = $par['itemID'];
    $colL = $par['colL'];
    $clsPfix = $par['clsPfix'];
    $vAidCls = $par['vAidCls'];
    $sPageUrl = $par['sPageUrl'];
    $isSingle = $par['isSingle'];

    $imgUrl = isset( $itemOptns['_imgUrlL'] ) ? esc_attr( $itemOptns['_imgUrlL'][0] ) : '';
    if( empty( $imgUrl ) ){
        $placeholder = abcfsl_img_placeholder( $tplateOptns, $isSingle );
        $imgUrl = $placeholder['imgUrl'];
        if( empty( $imgUrl ) ){ return ''; }
    }

    //-- CENTER IMAGE CLASS ----------------------------------
    //Grid A (3) always has images centered.
    //Single Page (100) always has images centered.
    //Grid B (2) & List (1) have an option: _imgCenter
    $imgCenterCls = '';
    switch ( $pgLayout ) {
        case 1:
        case 2:
            $imgCenterCls = abcfsl_util_img_center_cls( isset( $tplateOptns['_imgCenter'] ) ? esc_attr( $tplateOptns['_imgCenter'][0] ) : 'Y', $clsPfix );
            break;
        case 3:
        case 100:
        case 200:
            $imgCenterCls = abcfsl_util_img_center_cls( 'Y', $clsPfix );
            break;
        default:
            break;
    }
    //$imgCenterCls = abcfsl_util_img_center_cls( 'Y', $clsPfix );


//    if ( $pgLayout != 3 ){
//        $imgCenterCls = abcfsl_util_img_center_cls( isset( $tplateOptns['_imgCenter'] ) ? esc_attr( $tplateOptns['_imgCenter'][0] ) : 'Y', $clsPfix );
//    }
    //------------------------------------------------------------
    $imgHover = isset( $tplateOptns['_imgHover'] ) ? $tplateOptns['_imgHover'][0]  : '';
    //Image Custom Class
    $lstImgCls = abcfsl_util_pg_type_cls_bldr( isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : '', $isSingle );

        //Get image border class
    $imgBorderCls = abcfsl_util_cls_name_nc_bldr( isset( $tplateOptns['_imgBorder'] ) ? esc_attr( $tplateOptns['_imgBorder'][0] ) : 'D', 'ImgBorder', $clsPfix );
    $imgDS =  abcfsl_util_cls_bldr( isset( $tplateOptns['_imgDS'] ) ? $tplateOptns['_imgDS'][0] : '', $clsPfix );

    //Custom classes and style are added to an image tag not an image container.
    $imgCircle = isset( $tplateOptns['_imgCircle'] ) ? $tplateOptns['_imgCircle'][0] : '';
    $clsCircle = abcfsl_cnt_circle( $imgCircle, $isSingle, $clsPfix );

    $fluid = '';
    if( $imgHover == 'overlay' && $pgLayout != 100 ){ $fluid = $clsPfix . 'ImgFluid '; }
    $imgClasses = trim( $fluid . $imgBorderCls . $imgCenterCls . ' ' . $imgDS. ' ' . $lstImgCls . $clsCircle );
    $lstImgStyle = isset( $tplateOptns['_lstImgStyle'] ) ? esc_attr( $tplateOptns['_lstImgStyle'][0] ) : '';

    //------------------------------------------------------
    //Img ID for ALT attribute. We always will use list image ID for ALT.
    $imgIDL = isset( $itemOptns['_imgIDL'] ) ? $itemOptns['_imgIDL'][0] : 0;
    $imgAlt = isset( $itemOptns['_imgAlt'] ) ? esc_attr( $itemOptns['_imgAlt'][0] ) : '';

    $alt = abcfsl_img_alt( $imgIDL, $imgUrl, $imgAlt );
    $imgTag = abcfl_html_img_tag( '', $imgUrl, $alt, '', '', '', $imgClasses, $lstImgStyle);

    //Get Single page Url or Url entered in text field.
    $imgLnkL = isset( $itemOptns['_imgLnkL'] ) ? esc_attr( $itemOptns['_imgLnkL'][0] ) : '';
    $pretty = isset( $itemOptns['_pretty'] ) ? esc_attr( $itemOptns['_pretty'][0] ) : '';

    //URL and target
    $imgHref = abcfsl_util_url_selector( $itemID, $imgLnkL, $sPageUrl, $pretty );

    $imgLayout = 'N';
    if( $imgHover == 'overlay' ) { $imgLayout = 'O'; }
    if( $pgLayout == 100 ) { $imgLayout = 'S'; }

    $out['imgHover'] = '';
    $out['imgATag'] = '';
    $out['overATag'] = '';

    switch ( $imgLayout ) {
        case 'N':
            $out = abcfsl_cnt_over_imgATag( $imgHover, $imgHref['hrefUrl'], $imgTag, $imgHref['target'], $clsPfix );
            break;
        case 'O':
            $out =  abcfsl_cnt_over_overATag( $tplateOptns, $itemOptns, $imgHover, $imgHref['hrefUrl'], $imgTag, $imgHref['target'], $clsPfix );
            break;
        case 'S':
            $out['imgATag'] = $imgTag;
            break;
        default:
            break;
    }
//==================================================
//<div class="abcfslGridImgCntr">
    //<a href="https://en.wikipedia.org/wiki/AA" class="img-hyperlink">
        //<img src="http://localhost:8080/blog/450x250.jpg" class="abcfslImgCenter" itemprop="image">
    //</a>
//</div>
//----------------------------------------------------------
//<div class="abcfslGridImgCntr view overlay hm-black-strong">
//  <img src="http://450x250.jpg" class="abcfslImgFluid  abcfslImgCenter abcfslDShadow5 abcfslImgCenter" itemprop="image">
//  <a href="https://en.wikipedia.org/wiki/AA">
//      <div class="mask abcfslFlexCenter abcfslWhiteText">
//          <div>Strong Głowa</div>
//          <div>Długa nóżka</div>
//      </div>
//  </a>
//</div>
//==================================================

    $div['cntrS'] = '';
    $div['cntrE'] = '';

    //PRO ---
    //Image container. Has all hover classes.
    switch ( $pgLayout ) {
        case 1:
        case 2:
            $div = abcfsl_cnt_list_img_cntr_div( $colL, $clsPfix, 'LstImg', $out['imgHover'], '', $vAidCls );
            break;
        case 100:
            $div = abcfsl_cnt_list_img_cntr_div( $colL, $clsPfix, 'SPgImg', '', '', $vAidCls );
            break;
        case 3:
            $div = abcfsl_cnt_generic_div( $clsPfix, 'GridImgCntr', $out['imgHover'], '', '', '', $itemID, 'N', $isSingle );
            break;
        default:
            break;
    }

    //Img container
    return $div['cntrS'] . $out['imgATag'] . $out['overATag'] . $div['cntrE'];
}

function abcfsl_cnt_circle( $imgCircle, $isSingle, $clsPfix ){

    $clsCircle = '';
    if( $isSingle ) {
        if( $imgCircle == 'S' || $imgCircle == 'Y' ) { $clsCircle = ' ' . $clsPfix . 'RoundedCircle'; }
    }
    else{
        if( $imgCircle == 'L' || $imgCircle == 'Y' ) { $clsCircle = ' ' . $clsPfix . 'RoundedCircle'; }
    }

    return $clsCircle;
}

//======================================================
function abcfsl_cnt_over_imgATag( $imgHover, $hrefUrl, $imgTag, $target, $clsPfix ){

    $out['imgHover'] = abcfsl_util_cls_bldr( $imgHover, $clsPfix );
    $out['imgATag'] = abcfl_html_a_tag( $hrefUrl, $imgTag, $target, '', '', '', false);
    $out['overATag'] = '';

    return $out;
}

function abcfsl_cnt_over_overATag( $tplateOptns, $itemOptns, $imgHover, $hrefUrl, $imgTag, $target, $clsPfix ){

    $anchorTxt = abcfsl_cnt_over_txt_cntr( $tplateOptns, $itemOptns, $clsPfix );

    if( empty( $anchorTxt ) || empty( $hrefUrl ) ) {
        return abcfsl_cnt_over_imgATag( $imgHover, $hrefUrl, $imgTag, $target, $clsPfix );
    }

    $out['imgHover'] = $clsPfix . 'Overlay ' . $clsPfix . 'HmBlackStrong';
    $out['overATag'] = abcfl_html_a_tag( $hrefUrl, $anchorTxt, $target, '', '', '', false);;
    $out['imgATag'] = $imgTag;
    return $out;
}

function abcfsl_cnt_over_txt_cntr( $tplateOptns, $itemOptns, $clsPfix ){

    $overTxtT1 = isset( $tplateOptns['_overTxtT1'] ) ? esc_attr( $tplateOptns['_overTxtT1'][0] ) : '';
    $overTxtT2 = isset( $tplateOptns['_overTxtT2'] ) ? esc_attr( $tplateOptns['_overTxtT2'][0] ) : '';
    $overTxtI1 = isset( $itemOptns['_overTxtI1'] ) ? esc_attr( $itemOptns['_overTxtI1'][0] ) : '';
    $overTxtI2 = isset( $itemOptns['_overTxtI2'] ) ? esc_attr( $itemOptns['_overTxtI2'][0] ) : '';

    $imgCircle = isset( $tplateOptns['_imgCircle'] ) ? $tplateOptns['_imgCircle'][0] : '';
    $clsCircle = abcfsl_cnt_circle( $imgCircle, false, $clsPfix );

    $overTxt1 = $overTxtI1;
    if( empty ( $overTxtI1 ) ) { $overTxt1 = $overTxtT1; }
    $overTxt2 = $overTxtI2;
    if( empty ( $overTxtI2 ) ) { $overTxt2 = $overTxtT2; }
    if( empty ( $overTxt1 ) && empty ( $overTxt2 ) ) { return ''; }

    //--Text Classes -------------------------
    $overFont1 = isset( $tplateOptns['_overFont1'] ) ? esc_attr( $tplateOptns['_overFont1'][0] ) : 'D';
    $overFont2 = isset( $tplateOptns['_overFont2'] ) ? esc_attr( $tplateOptns['_overFont2'][0] ) : 'D';
    $overTM = isset( $tplateOptns['_overTM'] ) ? esc_attr( $tplateOptns['_overTM'][0] ) : 'N';

    //Font Size. Class name or empty string if Default or Custom selected.
    $overTxt1Cls = abcfsl_util_cls_name_nc_bldr( $overFont1, 'F', $clsPfix );

    //Top margin. Class name or empty string if Default or Custom selected.
    $overTxt2Cls = ltrim ( abcfsl_util_cls_name_nc_bldr( $overTM, 'PadT', $clsPfix ) . ' ' . abcfsl_util_cls_name_nc_bldr( $overFont2, 'F', $clsPfix )  );
    $overWrapCls = $clsPfix . 'Mask ' . $clsPfix . 'FlexCenter ' . $clsPfix . 'WhiteText' . $clsCircle;
    //--------------------------------------

    $divE = abcfl_html_tag_end( 'div');
    $txt1Cntr = '';
    if( !empty( $overTxt1 )) {
        $txt1Cntr = abcfl_html_tag( 'div', '', $overTxt1Cls, '' ) . $overTxt1 . $divE;
    }

    $txt2Cntr = '';
    if( !empty( $overTxt2 )) {
        $txt2Cntr = abcfl_html_tag( 'div', '', $overTxt2Cls, '' ) . $overTxt2 . $divE;
    }

    //anchorTxt
    return abcfl_html_tag( 'div', '', $overWrapCls, '' ) . $txt1Cntr . $txt2Cntr . $divE;
}

//List, Grid B. Image container div.
function abcfsl_cnt_list_img_cntr_div( $colSize, $clsPfix, $colBaseCls, $customCls, $customStyle, $vAidCls ){

    $colCls = ' ' . $clsPfix . $colBaseCls . 'Col';

    if(!empty($customCls)){ $customCls = ' ' . $customCls; }

    //if( empty( $cls ) ) { $cls = 'LstCol'; }
    $cls = 'LstCol';
    $colCls = $clsPfix . $cls . ' ' . $clsPfix . $cls . '-' . $colSize . $colCls . $vAidCls;

    $colS = abcfl_html_tag( 'div', '', $colCls, '' );
    $cntrS = abcfl_html_tag( 'div', '', $clsPfix . $colBaseCls . 'Cntr' . $customCls, $customStyle );

    $div['cntrS'] = $colS . $cntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');

    return $div;
}

//=== Text section: List, Grid B, Single. START ====================================

// Text section container + text fields. Used by List and Grid B.
function abcfsl_cnt_list_txt_section( $itemID, $itemOptns, $tplateOptns, $sPageUrl, $colSize, $clsPfix, $vAid, $isSingle ){

    $txtFieldsHTML  = '';
    $vAidCls = '';
    if( $vAid == 'Y' ) { $vAidCls = ' ' . $clsPfix . 'VAidTxt'; }

    $lstTxtCntrCustomCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : $clsPfix . 'PadLPc5';
    $lstTxtCntrCustomStyle = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';

    $custCls = abcfsl_util_pg_type_cls_bldr( $lstTxtCntrCustomCls, $isSingle );

    $div = abcfsl_cnt_list_txt_cntr_div( $colSize, $clsPfix, 'Lst1Txt', $custCls, $lstTxtCntrCustomStyle, $vAidCls, $isSingle );

    //List of all fields in sort order. Get all text lines for a single record.
    $fieldOrder = abcfsl_util_field_order( $tplateOptns, $isSingle );

    foreach ( $fieldOrder as $F ) {
        $txtFieldsHTML .= abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $itemID, $sPageUrl, $F, $isSingle, $clsPfix );
    }
    return $div['cntrS'] . $txtFieldsHTML . $div['cntrE'];
}

//Text section div.
function abcfsl_cnt_list_txt_cntr_div( $colSize, $clsPfix, $colBaseCls, $customCls, $customStyle, $vAidCls, $isSingle ){

    $colCls = ' ' . $clsPfix . $colBaseCls . 'Col';

    $cls = $clsPfix . 'PadLRPc0767';
    if( !$isSingle ){ $cls = $clsPfix . 'TxtCenter767 ' . $clsPfix . 'PadLRPc0767'; }
    if( !empty( $customCls ) ){ $customCls = ' ' . $customCls; }
    $customCls = $customCls . ' ' . $cls;

    //if( empty( $cntrCls ) ) { $cntrCls = 'LstCol'; }
    $cntrCls = 'LstCol';
    $colCls = $clsPfix . $cntrCls . ' ' . $clsPfix . $cntrCls . '-' . $colSize . $colCls . $vAidCls;

    $colS = abcfl_html_tag( 'div', '', $colCls, '' );
    $cntrS = abcfl_html_tag( 'div', '', $clsPfix . $colBaseCls . 'Cntr' . $customCls, $customStyle );

    $div['cntrS'] = $colS . $cntrS;
    $div['cntrE'] = abcfl_html_tag_ends( 'div,div');

    return $div;
}
//=== Text section: List, Grid B, Single. END ====================================

function abcfsl_cnt_generic_div( $clsPfix, $baseCls, $customCls, $customStyle, $vAidCls, $divID, $itemID, $addItemCls, $isSingle ){

    $cntrCls = abcfsl_cnt_class_bldr( $clsPfix, $baseCls, $customCls, $isSingle, $vAidCls, $addItemCls, $itemID );

    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_generic_div_simple( $customCls, $customStyle, $divID='' ){

    return abcfsl_cnt_generic_div( '', '', $customCls, $customStyle, '', $divID, '', 'N', false );
}

//------------------------------------------------------------------------------------------
//Returns classes
function abcfsl_cnt_class_bldr( $clsPfix, $baseCls, $customCls, $isSingle=false, $vAidCls='', $addItemCls='N', $itemID='0' ){

    $cntrBaseCls = '';
    if( !empty( $baseCls ) ){ $cntrBaseCls = $clsPfix . $baseCls; }
    if( !empty( $vAidCls ) ){ $vAidCls = ' ' . $clsPfix . $vAidCls; }
    $custCls = abcfsl_util_pg_type_cls_bldr( $customCls, $isSingle );

    $itemCls = '';
    if($addItemCls == 'Y'){ $itemCls = ' ' . $cntrBaseCls . '_' . $itemID; }

    return  trim( $cntrBaseCls . ' ' . $custCls . $vAidCls . $itemCls );
}

function abcfsl_cnt_filters_empty( $filters ){
    $empty = true;
    for ($x = 1; $x <= 6; $x++) {

//print_r('*'. $x . '-');
        if( !empty( $filters[$x] ) ){
            $empty = false;
            break;
        }
    }

    return $empty;
}

