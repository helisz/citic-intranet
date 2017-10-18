<?php
//GRID A Item container
//<div class="abcfslGridCol abcfslGridCol_2  abcfslPadLRPc1  abcfslMB40 kamMBottom100">

//GRID A ISOTOPE Item container
//<div class="rggclIItemCntr rggclIC_xl_4 rggclIC_lg_3 rggclIC_md_2 rggclIC_sm_2 rggclIC_xs_1 rggclPadLRPc1 rggclMBPc3 birds"
//        style="position: absolute; left: 0%; top: 0px;">

//GRID items builder.
function abcfsl_cnt_grid_ia( $tplateOptns, $optns, $pfix ){

//echo"<pre>", print_r($tplateOptns), "</pre>";  die;


    //== PG ==========================================
    $items['itemsHTML'] = '';
    $items['itemsSD'] = '';
    $items['totalQty'] = 0;

    //Get staff members IDs.
    $out = abcfsl_util_post_ids( $optns );
    $totalQty = $out['totalQty'];
    if( $totalQty == 0 ) { return $items; }
    $postIDs = $out['postIDs'];
    //================================================

    $items = abcfsl_cnt_grid_ia_items( $tplateOptns, $postIDs, $pfix );
    $items['totalQty'] = $totalQty;

   //SDATA
//   $items['itemsHTML'] = $itemsHTML;
//   $items['totalQty'] = $totalQty;
//   $items['itemsSD'] = $itemsSD;
   //return $items;

   //return $itemsHTML;


//    //-- Grid Items. Items container + items.------------------------------------------
//    $par['tplateID'] = $tplateID;
//    $par['parentID'] = $parentID;
//    $par['scodeCat'] = $scodeCat;
//    $par['clsPfix'] = $clsPfix;
//
//    $gridItems = abcfrggcl_grid_i_items( $tplateOptns, $par );

    //-- JS ----------------------------------------------
    $firstSlug = '';

    $parM['menuID'] = 0;
    $parM['clsPfix'] = $pfix;
    $parM['clsFItemHligh'] = 'N';
    $parM['menuItems'] = '';
    $parM['customCls'] = '';
    $parM['baseCls'] = '';

    $parM['tplateID'] = $optns['parentID'];
    $parM['firstSlug'] = $firstSlug;
    $parM['imgsLoaded'] = isset( $tplateOptns['_imgsLoaded'] ) ? $tplateOptns['_imgsLoaded'][0] : 1;
    $parM['windowLoad'] = 0;

    $jsIsotope = abcfsl_cnt_js_isotope( $parM );
    $items['js'] = $jsIsotope;

//echo"<pre>", print_r($jsIsotope), "</pre>";  die;
    //----------------------------------------------------

    //Menu if selected + Grid Items.
    //return $jsIsotope . $isotopeMenu . $gridCntr['cntrS'] . $gridItems . $gridCntr['cntrE'];

    return $items;
}


//------------------------------------------------------------------------------------------------------
function abcfsl_cnt_grid_ia_items( $tplateOptns, $postIDs, $pfix ){

    $layoutOptns['itemMarginLR'] = isset( $tplateOptns['_itemPadLR'] ) ? esc_attr( $tplateOptns['_itemPadLR'][0] ) : 'N';
    $layoutOptns['itemMarginB'] = isset( $tplateOptns['_itemMarginB'] ) ? esc_attr( $tplateOptns['_itemMarginB'][0] ) : 'N';
    $layoutOptns['itemCls'] = isset( $tplateOptns['_itemCls'] ) ? esc_attr( $tplateOptns['_itemCls'][0] ) : '';
    $layoutOptns['itemStyle'] = isset( $tplateOptns['_itemStyle'] ) ? esc_attr( $tplateOptns['_itemStyle'][0] ) : '';
    $layoutOptns['addMaxW'] = isset( $tplateOptns['_addMaxW'] ) ? esc_attr( $tplateOptns['_addMaxW'][0] ) : 'N';

    $layoutOptns['addMaxW'] = isset( $tplateOptns['_addMaxW'] ) ? esc_attr( $tplateOptns['_addMaxW'][0] ) : 'N';
    //$layoutOptns['innerCntrCls'] = isset( $tplateOptns['_innerCntrCls'] ) ? esc_attr( $tplateOptns['_innerCntrCls'][0] ) : '';
    //$layoutOptns['innerCntrStyle'] = isset( $tplateOptns['_innerCntrStyle'] ) ? esc_attr( $tplateOptns['_innerCntrStyle'][0] ) : '';

    $layoutOptns['sPageUrl'] = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $layoutOptns['pfix'] = $pfix;

    $layoutOptns['colsQty'] = isset( $tplateOptns['_gridCols'] ) ? esc_attr( $tplateOptns['_gridCols'][0] ) : '2';

    //????????????????????????????
    $layoutOptns['lstItemStyle'] = isset( $tplateOptns['_itemStyle'] ) ? esc_attr( $tplateOptns['_itemStyle'][0] ) : '';

    //????????????????????????????????
    //$layoutOptns['tplateID'] = $tplateOptns['tplateID'];

    $itemsHTML  = '';
    $itemsSD  = array(); //SDATA

    //ISOTOPE items container
    $itemsCntrS = abcfl_html_tag( 'div', $pfix . 'IItemsCntr_' . $tplateOptns['tplateID'], $pfix . 'IItemsCntr', '' );
    $mediaCls = abcfsl_cnt_grid_ia_item_media_classes( $tplateOptns, 'IItemCntr', 'IC_', $pfix );
    //$mediaCls = '';
    $itemCntrClasses = abcfrggcl_util_grid_item_cntr_classes( $mediaCls, $layoutOptns, $pfix, '' );

    $layoutOptns['itemCntrClasses'] = $itemCntrClasses;


    foreach ( $postIDs as $itemID ) {
        $outItems = abcfsl_cnt_grid_ia_item( $itemID, $tplateOptns, $layoutOptns );
        $itemsHTML .= $outItems['itemCntr'];
        $itemsSD[] = $outItems['sdProperties']; //SDATA
    }

   //SDATA

//    $gridSizer = '<div class="slGridSr_3_2"></div>';
//    $gutterSizer = '<div class="slGutterSr_2"></div>';
//    $items['itemsHTML'] = $itemsCntrS . $gridSizer . $gutterSizer . $itemsHTML. '</div>';

   $items['itemsHTML'] = $itemsCntrS . $itemsHTML. '</div>';
   $items['itemsSD'] = $itemsSD;
   return $items;

   //return $itemsHTML;

//    $itemsHTML  = '';
//
//    //ISOTOPE items container
//    $itemsCntrS = abcfl_html_tag( 'div', $clsPfix . 'IItemsCntr_' . $par['tplateID'], $clsPfix . 'IItemsCntr', '' );
//
//    //$mediaCls = abcfrggcl_grid_i_item_media_classes( $tplateOptns, $clsPfix );
//    $mediaCls = abcfrggcl_util_item_media_classes( $tplateOptns, 'IItemCntr', 'IC_', $clsPfix );
//
//
//    $itemCntrClasses = abcfrggcl_util_grid_item_cntr_classes( $mediaCls, $optns, $clsPfix, '' );
//
//    foreach ( $postIDs as $itemID ) {
//            $itemsHTML .= abcfrggcl_grid_i_item( $itemID, $itemCntrClasses, $tplateOptns, $optns, $clsPfix );
//    }
//
//    $itemsHTML = $itemsCntrS . $itemsHTML. '</div>';
//    return $itemsHTML;

}

//GRID item container + content
function abcfsl_cnt_grid_ia_item( $itemID, $tplateOptns, $item ){

    $pfix =  $item['pfix'];

    //DIV - Item container.
    $itemCntr = abcfsl_cnt_grid_ia_item_cntr_div( $item );
    $itemOptns = get_post_custom( $itemID );
    //$itemSlugs = Xabcfrggcl_grid_i_cat_slugs( $itemID );
    $itemSlugs = '';

    //$innerCntr = abcfsl_cnt_grid_ia_item_inner_cntr(  $item['innerCntrCls'], $item['innerCntrStyle'] );

    $par['pgLayout'] = 200;
    $par['itemID'] = $itemID;
    $par['colL'] = '';
    $par['clsPfix'] = $pfix;
    $par['sPageUrl'] = $item['sPageUrl'];
    $par['isSingle'] = false;
    $par['vAidCls'] = 'N';
//    $par[''] = ;
//    $par[''] = ;

    $imgCntr = abcfsl_cnt_image_cntr( $tplateOptns, $itemOptns, $par );
    $txtCntr = abcfsl_cnt_grid_a_item_txt_cntr( $itemID, $itemOptns, $tplateOptns, $item['sPageUrl'], $pfix, '', $item['addMaxW'] );

    //return $itemCntr['itemCntrS'] . $innerCntr['cntrS'] . $imgCntr . $txtCntr . $innerCntr['cntrE']  . $itemCntr['itemCntrE'];

    $divItem = abcfl_html_tag( 'div', '', trim( $item['itemCntrClasses'] . $itemSlugs ), $item['itemStyle'] ) .
            $imgCntr .
            $txtCntr .
            abcfl_html_tag_end( 'div');

    //SDATA
    //$out['itemCntr'] = $itemCntr['itemCntrS'] . $innerCntr['cntrS'] . $imgCntr . $txtCntr . $innerCntr['cntrE']  . $itemCntr['itemCntrE'];
    $out['itemCntr'] = $divItem;
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns );

    return $out;
}

//GRID A Image container
//<div class="abcfslGridImgCntr">
//        <a href="http://abcfolio.com/bio/stephanie-moorea/" class="img-hyperlink">
//        <img src="http://abcfolio.com/uploads/staff-member-1-250x300.jpg" class="abcfslImgCenter  abcfslImgBorder1 abcfslImgCenter" alt="Staff" itemprop="image">
//        </a>
//</div>

//GRID A ISOTOPE Image container
//<div id="4540" class="rggclGridImgCntr">
//        <a href="http://abcfolio.com/wordpress-with-custom-links-live-previews/" class="img-hyperlink">
//        <img src="http://abcfolio.com/ uploads/live-preview-12-300x200.jpg" class="rggclImgBorder3  rggclImgCenter" itemprop="image">
//        </a>
//</div>

//GRID item container ( empty DIV )
function abcfsl_cnt_grid_ia_item_cntr_div( $item ){

    $pfix =  $item['pfix'];
    // class="abcfslGridCol abcfslGridCol_2 abcfslPadLRPc1 abcfslMB40 abcfslPadLRPc1"
    $customCls = '';
    if( !empty( $item['lstItemCls'] ) ){ $customCls = ' ' . $item['lstItemCls']; }

    //Add legacy classes to custom class
    if( !empty( $item['itemMarginL'] ) ) { $customCls = $customCls . ' ' . $item['itemMarginL']; }
    if( !empty( $item['itemMarginB'] ) ) { $customCls = $customCls . ' ' . $item['itemMarginB']; }

    $columnsCls =  $pfix . 'GridCol ' . $pfix . 'GridCol_' . $item['colsQty'];
    //LR and Bottom margins. Default 1%

    $marginsCls = '';
    //$marginsCls = rtrim(' ' . abcfsl_util_cls_name_nc_bldr(  $item['itemPadLR'], 'PadLR', $pfix, '' ) . ' ' . abcfsl_util_cls_name_nc_bldr( $item['itemMarginBN'], 'MB', $pfix, '40' ));

    //Item container DIV
    $div['itemCntrS'] = abcfl_html_tag( 'div', '', $columnsCls . $marginsCls . $customCls, $item['lstItemStyle'] );
    $div['itemCntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}




//Grid item container
//abcfrggcl_util_grid_item_cntr_classes
function abcfsl_cnt_grid_ia_item_cntr_classes( $tplateOptns, $optns, $pfix ){

    //ISOTOPE items container
    //$itemsCntrS = abcfl_html_tag( 'div', $pfix . 'IItemsCntr_' . $par['tplateID'], $pfix . 'IItemsCntr', '' );

    //$mediaCls = abcfrggcl_grid_i_item_media_classes( $tplateOptns, $pfix );
    $mediaCls = abcfsl_cnt_grid_ia_item_media_classes( $tplateOptns, 'IItemCntr', 'IC_', $pfix );

    $customCls = '';

    if( !empty( $optns['itemCls'] ) ){ $customCls = ' ' . $optns['itemCls']; }


    //LR and Bottom margins. TODO check default values. check $itemMarginLR 1% as default
    $marginsCls = rtrim(' ' . abcfrggcl_util_cls_name_nc_bldr( $optns['itemMarginLR'], 'PadLR', $pfix, '1' ) . ' ' .
                              abcfrggcl_util_cls_name_nc_bldr( $optns['itemMarginB'], 'MB', $pfix, '40' ));

    //$out['cls'] = $mediaCls . $marginsCls . $customCls . $vAidCls;
    //$out['styel'] = $optns['itemStyle'];

    return $mediaCls . $marginsCls . $customCls;
}

//Item container. Front-end media classes.
//abcfrggcl_util_item_media_classes
function abcfsl_cnt_grid_ia_item_media_classes( $tplateOptns, $cls100, $mediaBase, $pfix ){

    $gridCols = isset( $tplateOptns['_gridCols'] ) ? $tplateOptns['_gridCols'][0] : '2';
    $gridColsLG = isset( $tplateOptns['_gridColsLG'] ) ? $tplateOptns['_gridColsLG'][0] : '';
    $gridColsMD = isset( $tplateOptns['_gridColsMD'] ) ? $tplateOptns['_gridColsMD'][0] : '';
    $gridColsSM = isset( $tplateOptns['_gridColsSM'] ) ? $tplateOptns['_gridColsSM'][0] : '';
    $gridColsXS = isset( $tplateOptns['_gridColsXS'] ) ? $tplateOptns['_gridColsXS'][0] : '';

    //Fix missing values if any (
    $colsQty = abcfsl_cnt_grid_ia_breakpoints_qty( $gridCols , $gridColsLG, $gridColsMD, $gridColsSM, $gridColsXS );

    //$base = $pfix . 'IC_';
    //$out = $pfix . 'IItemCntr ';
    $base = $pfix . $mediaBase;

    $out = $pfix . $cls100;
    $out .= ' ' . $base . 'xl_' . $colsQty['XL'];
    $out .= ' ' . $base . 'lg_' . $colsQty['LG'];
    $out .= ' ' . $base . 'md_' . $colsQty['MD'];
    $out .= ' ' . $base . 'sm_' . $colsQty['SM'];
    $out .= ' ' . $base . 'xs_' . $colsQty['XS'];

    return $out;
}

//Check media breakpoints. Change if necessary. Add the missing ones.,
//abcfrggcl_util_breakpoints_qty
function abcfsl_cnt_grid_ia_breakpoints_qty( $colsXL , $colsLG, $colsMD, $colsSM, $colsXS ){

    $colsQty['XL'] = $colsXL;
    $colsQty['LG'] = $colsLG;
    $colsQty['MD'] = $colsMD;
    $colsQty['SM'] = $colsSM;
    $colsQty['XS'] = $colsXS;
    $colsQty['oneBreak'] = false;

    $qtyFixed = $colsXL;
    if( $colsLG > $qtyFixed ){ $colsLG = $qtyFixed; }
    if( $colsLG == 0 ){ $colsLG = $qtyFixed; }

    $qtyFixed = $colsLG;
    if( $colsMD > $qtyFixed ){ $colsMD = $qtyFixed; }
    if( $colsMD == 0 ){ $colsMD = $qtyFixed; }

    $qtyFixed = $colsMD;
    if( $colsSM > $qtyFixed ){ $colsSM = $qtyFixed; }
    if( $colsSM == 0 ){ $colsSM = $qtyFixed; }

    $qtyFixed = $colsSM;
    if( $colsXS > $qtyFixed ){ $colsXS = $qtyFixed; }
    if( $colsXS == 0 ){ $colsXS = $qtyFixed; }

    $colsQty['LG'] = $colsLG;
    $colsQty['MD'] = $colsMD;
    $colsQty['SM'] = $colsSM;
    $colsQty['XS'] = $colsXS;

    return $colsQty;
}

function abcfsl_cnt_grid_ia_menu( $tplateOptns, $postIDs, $pfix ){

    $isotopeMenu = '';
    if( !empty( $iMenuItems ) ) {

        foreach ( $iMenuItems as $key => $menuValue ) {
            $firstSlug = trim($menuValue[1]);
            break;
         }

        $parM['menuID'] = $tplateMenuID;
        $parM['clsPfix'] = $clsPfix;
        $parM['clsFItemHligh'] = abcfrggcl_cnt_menu_cls_name_nc_bldr( isset( $menuOptns['_fItemHlight'] ) ? esc_attr( $menuOptns['_fItemHlight'][0] ) : 'N', 'FActive', $clsPfix );
        $parM['menuItems'] = $iMenuItems;
        $parM['customCls'] = '';
        $parM['baseCls'] = '';

        $isotopeMenu = abcfrggcl_cnt_menu_i( $menuOptns, $parM );
    }
}

