<?php
/*
 *Called from cnt.php.
 * Returns menu HTML, menu options and qry parameters OR qry parameters.
 */
function abcfsl_cnt_menu_from_staff_shortcode( $menuNo, $scodeArgs, $filters ){

    $menu = abcfsl_cnt_menu_default_optns_array();

    if( $menuNo == '0' ||  empty( $menuNo ) ){ return $menu; }
    if( strlen( $menuNo ) < 5 ) { return $menu; }

    //Menu option selected: Menu or Shortcode.
    $menuPar['menuType'] = substr( $menuNo, 0, 3 );
    $menuPar['menuID'] = substr( $menuNo, 4 );

    //$parMenuType = $menuPar['menuType'];

    switch ( $menuPar['menuType'] ) {
        case 'MTF':
            // MULTIFILTERS
            $menu['menuType'] = 'MTF';
            $menu['menuID'] = $menuPar['menuID'];
            return abcfsl_cnt_filter_html( $menu, $filters, $scodeArgs );
        case 'MFP':
            // MULTIFILTERS PRO
            $menu['menuType'] = 'MFP';
            $menu['menuID'] = $menuPar['menuID'];
            if ( !function_exists( 'abcfsls_cnt_filter_html' ) ){ return $menu; }
            return abcfsls_cnt_filter_html( $menu, $filters, $scodeArgs['prefix'] );
//        case 'ICT':
//            // ISOTOPE
//            $menu['menuType'] = 'ICT';
//            $menu['menuID'] = $menuPar['menuID'];
//            if ( !function_exists( 'abcfsls_cnt_filter_html' ) ){  return $menu; }
//            return $menu;
        default:
            break;
    }

    // MULTIFILTERS -------------------------
//    if( $menuPar['menuType'] == 'MTF' ){
//        $menu['menuType'] = 'MTF';
//        $menu['menuID'] = $menuPar['menuID'];
//        return abcfsl_cnt_filter_html( $menu, $filters, $scodeArgs['prefix'] );
//    }
//
//    if( $menuPar['menuType'] == 'MFP' ){
//        $menu['menuType'] = 'MFP';
//        $menu['menuID'] = $menuPar['menuID'];
//
//        if ( !function_exists( 'abcfsls_cnt_filter_html' ) ){
//            return $menu;
//        }
//        return abcfsls_cnt_filter_html( $menu, $filters, $scodeArgs['prefix'] );
//    }

    //------------------------------------
    global $post;
    $postID  = $post->ID;
    $menuPar['pageURL'] = get_permalink( $postID );

    //Template has MenuID selected. Return menu HTML & DB parameters.
    if( $menuPar['menuType'] != 'SCD' ){ return abcfsl_cnt_menu_builder( $scodeArgs, $menuPar ); }

    //--- SHORTCODE used as a Menu. Return only DB parameters. ------------------------
    //
    //Check if URL has qry string. If so, get menu type and qry parameter.
    $menuQP = abcfsl_cnt_menu_from_staff_shortcode_qry_parameters( $scodeArgs, $menu );
    if( $menuQP['menuType']  != 'NONE' ) { return $menuQP; }

    //No qry string. Check if there is a menu shortcode.
    $menuCAT = abcfsl_cnt_menu_from_staff_shortcode_scode_cat( $scodeArgs, $menuPar['pageURL'], $menu );
    if( $menuCAT['menuType']  != 'NONE' ) {  return $menuCAT; }

    $menuAZ = abcfsl_cnt_menu_from_staff_shortcode_scode_az( $scodeArgs, $menuPar['pageURL'], $menu );
    if( $menuAZ['menuType']  != 'NONE' ) { return $menuAZ; }

    return $menu;
}

function abcfsl_cnt_menu_default_optns_array(){

    $minLen[1] = '3';
    $minLen[2] = '3';
    $minLen[3] = '3';
    $minLen[4] = '3';
    $minLen[5] = '3';
    $minLen[6] = '3';

    $menu['menuID'] = '';
    $menu['pageURL'] = '';

    $menu['first'] = '';
    $menu['qryFilter'] = '';
    $menu['menuType'] = 'NONE';

    $menu['filterField'] = '';
    $menu['filterType'] = '';

    $menu['filter1Type'] = '';
    $menu['filter2Type'] = '';
    $menu['filter3Type'] = '';
    $menu['filter4Type'] = '';
    $menu['filter5Type'] = '';
    $menu['filter6Type'] = '';

    $menu['filter1Field'] = '';
    $menu['filter2Field'] = '';
    $menu['filter3Field'] = '';
    $menu['filter4Field'] = '';
    $menu['filter5Field'] = '';
    $menu['filter6Field'] = '';

    $menu['minLen'] = $minLen;

    $menu['menuItemsHTML'] = '';
    $menu['noDataMsg'] = '';

    return $menu;

}

//URL has qry string. Get menu type and qry parameter.
function abcfsl_cnt_menu_from_staff_shortcode_qry_parameters( $scodeArgs, $menu ){

    $menuType = 'NONE';

    $qryFilterCAT = $scodeArgs['staff-category'];
    //$qryFilterCAT = $scodeArgs['category_name'];
    if( !empty( $qryFilterCAT ) ) { $menuType = 'CAT'; }

    $qryFilterAZM = $scodeArgs['staff-az'];
    if( !empty( $qryFilterAZM ) ) { $menuType = 'AZM'; }

    switch ( $menuType ) {
        case 'CAT':
            $menu['menuType'] = 'CAT';
            $menu['qryFilter'] = $qryFilterCAT;
            break;
        case 'AZM':
            $menu['menuType'] = 'AZM';
            $menu['qryFilter'] = $qryFilterAZM;
            $menu['filterField'] = abcfsl_cnt_menu_from_staff_shortcode_filter_field_az();
            break;
        default:
            break;
        }
    return $menu;
}

function abcfsl_cnt_menu_from_staff_shortcode_filter_field_az( ){

    global $post;
    $content = $post->post_content;
    $shortcode = 'abcf-staff-az-menu';
    $ff = '';
    if( has_shortcode( $content, $shortcode) ) {

        preg_match('/\['. $shortcode . '.*id=.(.*).\]/', $content, $ids);

        $menuID = 0;
        if(array_key_exists(1, $ids)){ $menuID = $ids[1]; }
        if( $menuID > 0 ){
            $menuOptns = get_post_custom( $menuID );
            $azFieldType = isset( $menuOptns['_azFieldType'] ) ? $menuOptns['_azFieldType'][0] : '';
            $azFieldID = isset( $menuOptns['_azFieldID'] ) ?  $menuOptns['_azFieldID'][0] : '';
            if($azFieldType == '' ) { $azFieldID = ''; }
            $ff = $filterField = $azFieldType . $azFieldID;
        }
    }
    return $ff;
}

function abcfsl_cnt_menu_from_staff_shortcode_scode_cat( $scodeArgs, $pageURL, $menuDefault ){

    global $post;
    $content = $post->post_content;
    $shortcode = 'abcf-staff-cat-menu';
    if( has_shortcode( $content, $shortcode) ) {

        //preg_match('/\[abcf-rggcl-cat-menu.*id=.(.*).\]/', $content, $ids);
        preg_match('/\['. $shortcode . '.*id=.(.*).\]/', $content, $ids);

        $menuID = 0;
        if(array_key_exists(1, $ids)){
            $menuID = $ids[1];
        }
        if( $menuID > 0 ){
            $menuPar['pageURL'] = $pageURL;
            $menuPar['menuType'] = 'CAT';
            $menuPar['menuID'] = $menuID;

            $menu = abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );
            $menu['menuItemsHTML'] = '';
            return $menu;
        }
    }
    return $menuDefault;
}

function abcfsl_cnt_menu_from_staff_shortcode_scode_az( $scodeArgs, $pageURL, $menuDefault ){

    global $post;
    $content = $post->post_content;
    $shortcode = 'abcf-staff-az-menu';
    if( has_shortcode( $content, $shortcode) ) {

        preg_match('/\['. $shortcode . '.*id=.(.*).\]/', $content, $ids);

        $menuID = 0;
        if(array_key_exists(1, $ids)){
            $menuID = $ids[1];
        }
        if( $menuID > 0 ){
            $menuPar['pageURL'] = $pageURL;
            $menuPar['menuType'] = 'AZM';
            $menuPar['menuID'] = $menuID;

            $menu = abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );
            $menu['menuItemsHTML'] = '';
            return $menu;
        }
    }

    return $menuDefault;
}
//===============================================================
//Called from menu shortcode. Returns  menu HTML. Not linked to a page. Page has two shortcodes: menu and staff.

function abcfsl_cnt_menu_from_category_shortcode( $scodeArgs ){

    $menuID = $scodeArgs['id'];
    $menuOptns = get_post_custom( $menuID );
    $pageURL = isset( $menuOptns['_fPageUrl'] ) ? esc_attr( $menuOptns['_fPageUrl'][0] ) : '';

    if( empty( $pageURL ) ){
        global $post;
        $postID  = $post->ID;
        $pageURL = get_permalink($postID);
    }

    $menuPar['menuID'] = $menuID;
    $menuPar['pageURL'] = $pageURL;
    $menuPar['menuType'] = 'CAT';

    return abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );
}

function abcfsl_cnt_menu_from_shortcode( $scodeArgs, $menuType ){

    $menuID = $scodeArgs['id'];
    $menuOptns = get_post_custom( $menuID );
    $pageURL = isset( $menuOptns['_fPageUrl'] ) ? esc_attr( $menuOptns['_fPageUrl'][0] ) : '';

    if( empty( $pageURL ) ){
        global $post;
        $postID  = $post->ID;
        $pageURL = get_permalink($postID);
    }

    $menuPar['menuID'] = $menuID;
    $menuPar['pageURL'] = $pageURL;
    $menuPar['menuType'] = $menuType;

    return abcfsl_cnt_menu_builder( $scodeArgs, $menuPar );
}
//===============================================================

//Retuns array: Menu wrap with items + parameters
function abcfsl_cnt_menu_builder( $scodeArgs, $menuPar ){

    $clsPfix = $scodeArgs['prefix'];
    $menuID = $menuPar['menuID'];
    $menuType = $menuPar['menuType'];
    $pageURL = $menuPar['pageURL'];
    $qryFilter = '';

    switch ( $menuType ) {
        case 'CAT':
            $qryFilter = $scodeArgs['staff-category'];
            //$qryFilter = $scodeArgs['category_name'];
            break;
        case 'AZM':
            $qryFilter = $scodeArgs['staff-az'];
            break;
        default:
            break;
    }

    $menuOptns = get_post_custom( $menuID );
    $fCntrW = isset( $menuOptns['_fCntrW'] ) ? esc_attr( $menuOptns['_fCntrW'][0] ) : '';
    $fCntrCenter = isset( $menuOptns['_fCntrCenter'] ) ? esc_attr( $menuOptns['_fCntrCenter'][0] ) : 'Y';

    // TODO check if used?
    $fCntrCls = isset( $menuOptns['_fCntrCls'] ) ? esc_attr( $menuOptns['_fCntrCls'][0] ) : '';
    $fCntrStyle = isset( $menuOptns['_fCntrStyle'] ) ? esc_attr( $menuOptns['_fCntrStyle'][0] ) : '';

    //Plugin container CSS
    $cntrStyle = abcfl_css_w_responsive( $fCntrW, $fCntrW ) . $fCntrStyle;
    $centerCls = abcfsl_cnt_menu_center_cls( $fCntrCenter, $clsPfix );
    $clsFItemsCntrMT = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMT'] ) ? esc_attr( $menuOptns['_fItemsCntrMT'][0] ) : 'N', 'MT', $clsPfix );
    $clsFItemsCntrMB = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemsCntrMB'] ) ? esc_attr( $menuOptns['_fItemsCntrMB'][0] ) : 'N', 'MB', $clsPfix );
    $clsFtemMLR = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemMLR'] ) ? esc_attr( $menuOptns['_fItemMLR'][0] ) : '10', 'FItemMLR', $clsPfix );

    //Menu container -----------------
    $cntCntrCls = ltrim( trim( $centerCls . ' ' . $clsFtemMLR . ' ' . $clsFItemsCntrMB . ' ' . $clsFItemsCntrMT ) );
    $div = abcfsl_cnt_menu_generic_div($clsPfix, 'FiltersCntr', $cntCntrCls, $cntrStyle, '', '', $menuID, 'Y', false);

    $menu = abcfsl_cnt_menu_items_cntr( $menuType, $qryFilter, $menuID, $menuOptns, '', '', $clsPfix, $pageURL );
    $menu['menuItemsHTML'] = $div['cntrS'] . $menu['menuItemsHTML'] . $div['cntrE'];

    return $menu;
}

//Retuns array: Menu container DIV + UL + Items AND parameters.
function abcfsl_cnt_menu_items_cntr( $menuType, $qryFilter, $menuID, $menuOptns, $baseCls, $customCls, $clsPfix, $pageURL ){

    $ulID = $clsPfix . 'Filters';
    $ulCls = '';

    $clsFItemColor = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemColor'] ) ? esc_attr( $menuOptns['_fItemColor'][0] ) : 'D', 'FItemColor', $clsPfix );
    $clsFiltersCntr = trim ( $clsPfix . 'FItemsCntr_' . $menuID . ' ' . $clsPfix . 'FItemsCntr ' . $clsFItemColor . ' ' . $customCls );
    $fItemsCenter = isset( $menuOptns['_fItemsCenter'] ) ? esc_attr( $menuOptns['_fItemsCenter'][0] ) : 'Y';
    if($fItemsCenter == 'Y') { $ulCls = $clsPfix . 'TxtCenter'; }

    //Div, filters container.
    $divFiltersCntr = abcfsl_cnt_menu_generic_div( $clsPfix, $baseCls, $clsFiltersCntr, '' );

    $menu = '';
    switch ( $menuType ) {
        case 'CAT':
            $menu = abcfsl_cnt_menu_cat_items( $qryFilter, $menuID, $menuOptns, $clsPfix, $pageURL );
            break;
        case 'AZM':
            $menu = abcfsl_cnt_menu_az_items( $qryFilter, $menuOptns, $clsPfix, $pageURL );
            break;
        default:
            break;
    }

    $menu['menuItemsHTML'] = $divFiltersCntr['cntrS'] . abcfl_html_tag( 'ul', $ulID, $ulCls ) . $menu['menuItemsHTML'] . abcfl_html_tag_end( 'ul'). $divFiltersCntr['cntrE'];
    return $menu;
}

//==============================================================
//Concatinate class name from prefix + BaseName + Value  Return empty if N or C. Othewise return $clsPfix + BaseName + Value
function abcfsl_cnt_menu_cls_name_nc_bldr( $optnValue, $clsBaseName, $clsPfix, $default='' ){

    if( $optnValue == 'N' || $optnValue == 'C' ){ return ''; }
    if( $optnValue == 'D' ) { $optnValue = $default; }
    if( empty( $optnValue ) ) { $optnValue = $default; }
    if( empty( $optnValue) ) { return ''; }
    return ' ' . $clsPfix . $clsBaseName . $optnValue;
}

// generic DIV
function abcfsl_cnt_menu_generic_div( $clsPfix, $baseCls, $customCls, $customStyle ){

    $cntrCls = abcfsl_cnt_menu_class_bldr( $clsPfix, $baseCls, $customCls );

    $div['cntrS'] = abcfl_html_tag( 'div', '', $cntrCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_menu_class_bldr( $clsPfix, $baseCls, $customCls ){

    $cntrBaseCls = '';
    if( !empty( $baseCls ) ){ $cntrBaseCls = $clsPfix . $baseCls; }

    return  trim( $cntrBaseCls . ' ' . $customCls );
}

function abcfsl_cnt_menu_center_cls( $centerYN, $clsPfix ){
    $out = '';
    if( $centerYN == 'Y' ) { $out = ' ' . $clsPfix . 'MLRAuto'; }
    return $out;
}

function abcfsl_cnt_menu_cat_upper( $upCase, $clsPfix ){

    $clsUpper = '';
    if( $upCase == 'Y' ) { $clsUpper = ' ' . $clsPfix . 'Upper' ; }
    return $clsUpper;

}