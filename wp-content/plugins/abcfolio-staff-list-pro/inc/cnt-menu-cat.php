<?php
/*
 * Called from a shortcode.
 * CATEGORIES menu builder. Items HTML & menu parameters for DB.
 */
function abcfsl_cnt_menu_cat_items( $qryFilter, $menuID, $menuOptns, $clsPfix, $pageURL ){

    $termCats = array();
    $category = '';
    $noSlugTxt = ' Slug doesn\'t exist: ';
    $noSlug = false;
    //----------------------------------
    $terms = get_terms( array(
        'taxonomy' => 'tax_staff_member_cat',
        'hide_empty' => false
    ) );

//echo"<pre>", print_r($terms), "</pre>";  die;

//[0] => WP_Term Object
//        (
//            [term_id] => 196
//            [name] => adam
//            [slug] => adam
//            [term_group] => 0
//            [term_taxonomy_id] => 197
//            [taxonomy] => tax_staff_member_cat
//            [description] =>
//            [parent] => 0
//            [count] => 1
//            [filter] => raw
//        )


//    $terms = get_terms( array(
//        'taxonomy' => 'tax_staff_member_cat',
//        'hide_empty' => true
//    ) );

    $menu = abcfsl_cnt_menu_default_optns_array();
    $menu['qryFilter'] = $qryFilter;
    $menu['menuType'] = 'CAT';
    $menu['noDataMsg'] = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';

    //From multidimensional array TERMS Create array: slug - category name
    foreach ($terms as $category) {
        $termCats[$category->slug] = $category->name; 
    }

    //----------------------------------
    $defaultFTxt = isset( $menuOptns['_defaultFTxt'] ) ? esc_attr( $menuOptns['_defaultFTxt'][0] ) : '';
    $menuCatSlugs = get_post_meta( $menuID, '_catSlugs', true );

    $clsFItemFont = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemFont'] ) ? esc_attr( $menuOptns['_fItemFont'][0] ) : 'D', 'F', $clsPfix );
    $clsFItemHligh = abcfsl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'D', 'FActive', $clsPfix );
    $upCase = isset( $menuOptns['_upCase'] ) ? esc_attr( $menuOptns['_upCase'][0] ) : 'N';

    //------------------------------------------------------------
    $hasShowAll = false;
    $showAllLast = false;
    $first = '';
    $menuItemsHTML  = '';
    $i = 1;

    if( !abcfl_html_isblank( $defaultFTxt ) ) { $hasShowAll = true; }
    if( isset( $menuOptns['_showAllLast'] ) ? esc_attr( $menuOptns['_showAllLast'][0] ) : '0' == 1 ) { $showAllLast = true; }

    //Menu item: Show all.
    $menuItemsHTML .= abcfsl_cnt_menu_cat_all( $hasShowAll, $showAllLast, $i, $pageURL, $qryFilter, $defaultFTxt, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix );

    if ( !$menuCatSlugs ){
        $menu['menuItemsHTML'] = $menuItemsHTML;
        return $menu;
    }
    //----------------------------------------------------------
    //$i = 1;
    foreach ( $menuCatSlugs as $field ) {
        $catSlug = esc_attr( $field['catSlug'] );

        if(isset( $termCats[$catSlug] ) ){
            $category = $termCats[$catSlug];
        }
        else {
            $category = $noSlugTxt . $catSlug;
            $noSlug = true;
        }

        if( !$hasShowAll && $i == 1 ) {
            $first = trim($catSlug);
            $menuItemsHTML .= abcfsl_cnt_menu_cat_item( $pageURL, $qryFilter, $catSlug, $category, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 2, $first );

        }
        else{
            $menuItemsHTML .= abcfsl_cnt_menu_cat_item( $pageURL, $qryFilter, $catSlug, $category, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 3 );
        }
        $i++;
    }

    //Menu item: Show all.
    $menuItemsHTML .= abcfsl_cnt_menu_cat_all( $hasShowAll, $showAllLast, $i, $pageURL, $qryFilter, $defaultFTxt, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix );

    $menu['first'] = $first;
    $menu['menuItemsHTML'] = $menuItemsHTML;
    return $menu;
}

function abcfsl_cnt_menu_cat_all( $hasShowAll, $showAllLast, $i, $pageURL, $qryFilter, $defaultFTxt, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix ){

    $out = '';
    $render = false;

    if( !$hasShowAll ) {  return ''; }
    if( !$showAllLast && $i == 1 ) {  $render = true;}
    if( $showAllLast && $i > 1 ) {  $render = true; }

    if( $render ) {
        $out = abcfsl_cnt_menu_cat_item( $pageURL, $qryFilter, '', $defaultFTxt, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, 1 );
    }

    return $out;
}


//Menu item. Single LI element with text hyperlink.
function abcfsl_cnt_menu_cat_item( $pageURL, $qryFilter, $filterBy, $category, $noSlug, $upCase, $clsFItemFont, $clsFItemHligh, $clsPfix, $itemType, $first='' ){

    if(empty( $pageURL )){ return '';}

    //Slug doesn't exist.
    if( $noSlug ) { return $category; }

    //$itemType
    //1 = All;
    //2 = First menu item - category;
    //3 = Second and next menu items - category;;

    $clsActive = '';
    switch ( $itemType ) {
        case 1:
            if( $qryFilter == '' ) { $clsActive = $clsFItemHligh; }
            break;
        case 2:
            if( $qryFilter == $filterBy || $qryFilter == '' ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-category' => $first ), $pageURL );
            //$pageURL = abcfl_html_url( array( 'category_name' => $first ), $pageURL );
            break;
        case 3:
            if( $qryFilter == $filterBy ) { $clsActive = $clsFItemHligh; }
            $pageURL = abcfl_html_url( array( 'staff-category' => $filterBy ), $pageURL );
            //$pageURL = abcfl_html_url( array( 'category_name' => $filterBy ), $pageURL );
            break;
        default:
            break;
    }

    $clsATag = trim( $clsActive . abcfsl_cnt_menu_cat_upper( $upCase, $clsPfix ) . ' ' . $clsFItemFont );
    //abcfl_html_a_tag($href, $inputLinkLbl, $target='', $cls='', $style='', $spanStyle='', $blankTag=true, $onclickJS='', $args='')
    $link = abcfl_html_a_tag( $pageURL, $category, '0', $clsATag, '', '', false);

    //-----------------------------------------------------
    return abcfl_html_tag_with_content( $link, 'li', '');
}