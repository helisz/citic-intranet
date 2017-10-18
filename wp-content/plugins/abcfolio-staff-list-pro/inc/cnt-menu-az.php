<?php
/*
 * Called from a shortcode
 */

//Categories menu. Items HTML & menu parameters for DB.
function abcfsl_cnt_menu_az_items( $qryFilter, $menuOptns, $clsPfix, $pageURL ){

    $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
    $azItems = isset( $menuOptns['_azItems'] ) ? esc_attr( $menuOptns['_azItems'][0] ) : '';
    $azFieldType = isset( $menuOptns['_azFieldType'] ) ? $menuOptns['_azFieldType'][0] : '';
    $azFieldID = isset( $menuOptns['_azFieldID'] ) ?  $menuOptns['_azFieldID'][0] : '';
    if($azFieldType == '' ) { $azFieldID = ''; }

    $clsFItemFont = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemFont'] ) ? esc_attr( $menuOptns['_fItemFont'][0] ) : 'D', 'F', $clsPfix );
    $clsFItemHligh = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'D', 'FActive', $clsPfix );
    $upCase = isset( $menuOptns['_upCase'] ) ? esc_attr( $menuOptns['_upCase'][0] ) : 'N';

    //$fItemCls = isset( $menuOptns['_fItemCls'] ) ? esc_attr( $menuOptns['_fItemCls'][0] ) : '';
    //$fItemStyle = isset( $menuOptns['_fItemStyle'] ) ? esc_attr( $menuOptns['_fItemStyle'][0] ) : '';

    $menu = abcfsl_cnt_menu_default_optns_array();
    $menu['qryFilter'] = $qryFilter;
    $menu['menuType'] = 'AZM';
    $menu['filterField'] = $azFieldType . $azFieldID;
    $menu['noDataMsg'] = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';
    //------------------------------------------------------------
    $hasShowAll = false;
    $showAllLast = false;
    $first = '';
    $menuItemsHTML  = '';
    $i = 1;

    if( !abcfl_html_isblank( $defaultFTxt ) ) { $hasShowAll = true; }
    if( isset( $menuOptns['_showAllLast'] ) ? esc_attr( $menuOptns['_showAllLast'][0] ) : '0' == 1 ) { $showAllLast = true; }

    //Menu item: Show all.
//    if( $hasShowAll ) {
//        $menuItemsHTML .= abcfsl_cnt_menu_az_item( $pageURL, $qryFilter, $defaultFTxt, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 1 );
//    }

    $menuItemsHTML .=  abcfsl_cnt_menu_az_all( $hasShowAll, $showAllLast, $i, $pageURL, $qryFilter, $defaultFTxt, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix );

    //if ( empty( $azItems ) ){ return $menuItemsHTML; }
    if ( empty( $azItems ) ){
        $menu['menuItemsHTML'] = $menuItemsHTML;
        return $menu;
    }

    $azItemsArray = explode(',', $azItems);
    //----------------------------------------------------------
    //$i = 1;
    foreach ( $azItemsArray as $value ) {

        if( !$hasShowAll && $i == 1 ) {
            $menuItemsHTML .= abcfsl_cnt_menu_az_item( $pageURL, $qryFilter, trim($value), $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 2 );
            $first = trim($value);
        }
        else{
            $menuItemsHTML .= abcfsl_cnt_menu_az_item( $pageURL, $qryFilter, trim($value), $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 3 );
        }
        $i++;
    }

    $menuItemsHTML .=  abcfsl_cnt_menu_az_all( $hasShowAll, $showAllLast, $i, $pageURL, $qryFilter, $defaultFTxt, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix );

    $menu['first'] = $first;
    $menu['menuItemsHTML'] = $menuItemsHTML;

    return $menu;
}

function abcfsl_cnt_menu_az_all( $hasShowAll, $showAllLast, $i, $pageURL, $qryFilter, $defaultFTxt, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix ){

    $out = '';
    $render = false;

    if( !$hasShowAll ) {  return ''; }
    if( !$showAllLast && $i == 1 ) {  $render = true;}
    if( $showAllLast && $i > 1 ) {  $render = true; }

    if( $render ) {
        $out = abcfsl_cnt_menu_az_item( $pageURL, $qryFilter, $defaultFTxt, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 1 );
    }

    return $out;
}

//Menu item. Single LI element with text hyperlink.
function abcfsl_cnt_menu_az_item( $pageURL, $qryFilter, $filterBy, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, $itemType, $first='' ){

    if(empty( $pageURL )){ return '';}

    $clsActive = '';
    switch ( $itemType ) {
        case 1:
            if( $qryFilter == '' ) { $clsActive = $clsFItemHligh; }
            break;
        case 2:
            if( $qryFilter == $filterBy || $qryFilter == '' ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-az' => $first ), $pageURL );
            break;
        case 3:
            if( $qryFilter == $filterBy ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-az' => $filterBy ), $pageURL );
            break;
        default:
            break;
    }

    $clsATag = trim( $clsActive . abcfsl_cnt_menu_cat_upper( $upCase, $clsPfix ) . ' ' . $clsFItemFont );
    $link = abcfl_html_a_tag( $pageURL, $filterBy, '0', $clsATag, '', '', false);

    return abcfl_html_tag_with_content( $link, 'li', '');
}

