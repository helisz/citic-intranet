<?php

//GRID items builder.
function abcfsl_cnt_grid_a( $tplateOptns, $optns, $clsPfix ){

    //Added inner container. Replaced options with options array

    //$itemMarginL = isset( $tplateOptns['_itemMarginL'] ) ? esc_attr( $tplateOptns['_itemMarginL'][0] ) : $clsPfix . 'PadLRPc1';
    //$itemMarginB = isset( $tplateOptns['_itemMarginB'] ) ? esc_attr( $tplateOptns['_itemMarginB'][0] ) : $clsPfix . 'MB40';

    //Legacy classes
    $itemMarginL = isset( $tplateOptns['_itemMarginL'] ) ? esc_attr( $tplateOptns['_itemMarginL'][0] ) : '';
    $itemMarginB = isset( $tplateOptns['_itemMarginB'] ) ? esc_attr( $tplateOptns['_itemMarginB'][0] ) : '';
    $itemPadLR = isset( $tplateOptns['_itemPadLR'] ) ? esc_attr( $tplateOptns['_itemPadLR'][0] ) : 'Pc1';
    $itemMarginBN = isset( $tplateOptns['_itemMarginBN'] ) ? esc_attr( $tplateOptns['_itemMarginBN'][0] ) : '40';
    $lstItemCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : '';
    $lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';

    $innerCntrCls = isset( $tplateOptns['_innerCntrCls'] ) ? esc_attr( $tplateOptns['_innerCntrCls'][0] ) : '';
    $innerCntrStyle = isset( $tplateOptns['_innerCntrStyle'] ) ? esc_attr( $tplateOptns['_innerCntrStyle'][0] ) : '';

    $addMaxW = isset( $tplateOptns['_addMaxW'] ) ? esc_attr( $tplateOptns['_addMaxW'][0] ) : 'N';

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

    //GRID row container
    $rowDivS = abcfl_html_tag( 'div', '', $clsPfix . 'GridRow ' . 'abcfClrFix', '' );
    $colsQty = isset( $tplateOptns['_gridCols'] ) ? esc_attr( $tplateOptns['_gridCols'][0] ) : '2';
    $itemsHTML  = '';
    $itemsSD  = array(); //SDATA
    $i = 1;
    $rowClosed = false;

    //$item['itemID'] = $itemID;
    $item['colsQty'] = $colsQty;
    $item['itemPadLR'] = $itemPadLR;
    $item['itemMarginBN'] = $itemMarginBN;
    $item['itemMarginL'] = $itemMarginL;
    $item['itemMarginB'] = $itemMarginB;
    $item['lstItemCls'] = $lstItemCls;
    $item['lstItemStyle'] = $lstItemStyle;
    $item['sPageUrl'] = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';
    $item['clsPfix'] = $clsPfix;
    $item['addMaxW'] = $addMaxW;
    $item['vAid'] = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';
    $item['innerCntrCls'] = $innerCntrCls;
    $item['innerCntrStyle'] = $innerCntrStyle;

    //$outItems['itemCntr'] = '';
    //$outItems['sdProperties'] = array();

    if ( $postIDs ) {
        foreach ( $postIDs as $itemID ) {
            if( $i == 1 ) { $itemsHTML .= $rowDivS; }
            $outItems = abcfsl_cnt_grid_a_item( $itemID, $tplateOptns, $item );
            $itemsHTML .= $outItems['itemCntr'];
            $itemsSD[] = $outItems['sdProperties']; //SDATA

            //Row closing tag.
            $rowClosed = false;
            if( $i == $colsQty ) {
                $i=0;
                $itemsHTML .= '</div>';
                $rowClosed = true;
            }
            $i++;
        }
   }

   //$itemsHTML = $itemsHTML . abcfl_html_tag( 'div', '', 'abcfClr') . abcfl_html_tag_end( 'div');
   if( !$rowClosed ) {  $itemsHTML .= '</div>'; }

   //SDATA
   $items['itemsHTML'] = $itemsHTML;
   $items['totalQty'] = $totalQty;
   $items['itemsSD'] = $itemsSD;
   return $items;

   //return $itemsHTML;
}

//GRID item container + content
function abcfsl_cnt_grid_a_item( $itemID, $tplateOptns, $item ){

    $clsPfix =  $item['clsPfix'];
    //DIV - Item container.
    $itemCntr = abcfsl_cnt_grid_a_item_cntr_div( $item );
    $itemOptns = get_post_custom( $itemID );

    //Remove excluded. EXCLUDED
    //$hideSMember = isset( $itemOptns['_hideSMember'] ) ? esc_attr( $itemOptns['_hideSMember'][0] ) : '0';
    //if($hideSMember == 1) { return '';}

    $innerCntr = abcfsl_cnt_grid_a_item_inner_cntr(  $item['innerCntrCls'], $item['innerCntrStyle'] );

    $par['pgLayout'] = 3;
    $par['itemID'] = $itemID;
    $par['colL'] = '';
    $par['clsPfix'] = $clsPfix;
    $par['vAidCls'] = 'N';
    $par['sPageUrl'] = $item['sPageUrl'];
    $par['isSingle'] = false;
//    $par[''] = ;
//    $par[''] = ;
    //abcfsl_cnt_image_cntr( $lstLayout, $itemID, $tplateOptns, $itemOptns, $colL, $clsPfix, $vAidCls, $sPageUrl, $isSingle )
    //$imgCntr = abcfsl_cnt_image_cntr( 3, $itemID, $tplateOptns, $itemOptns, '',  $clsPfix, 'N', $item['sPageUrl'], false );
    $imgCntr = abcfsl_cnt_image_cntr( $tplateOptns, $itemOptns, $par );
    $txtCntr = abcfsl_cnt_grid_a_item_txt_cntr( $itemID, $itemOptns, $tplateOptns, $item['sPageUrl'], $clsPfix, $item['vAid'], $item['addMaxW'] );

    //return $itemCntr['itemCntrS'] . $innerCntr['cntrS'] . $imgCntr . $txtCntr . $innerCntr['cntrE']  . $itemCntr['itemCntrE'];

    //SDATA
    $out['itemCntr'] = $itemCntr['itemCntrS'] . $innerCntr['cntrS'] . $imgCntr . $txtCntr . $innerCntr['cntrE']  . $itemCntr['itemCntrE'];
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns );

    return $out;
}


//GRID item container ( empty DIV )
function abcfsl_cnt_grid_a_item_cntr_div( $item ){

    $clsPfix =  $item['clsPfix'];
    // class="abcfslGridCol abcfslGridCol_2 abcfslPadLRPc1 abcfslMB40 abcfslPadLRPc1"
    $vAidCls = '';
    $customCls = '';
    if( !empty( $item['lstItemCls'] ) ){ $customCls = ' ' . $item['lstItemCls']; }

    //Add legacy classes to custom class
    if( !empty( $item['itemMarginL'] ) ) { $customCls = $customCls . ' ' . $item['itemMarginL']; }
    if( !empty( $item['itemMarginB'] ) ) { $customCls = $customCls . ' ' . $item['itemMarginB']; }
    if( $item['vAid'] == 'Y' ) { $vAidCls = ' ' . $clsPfix . 'VAidBorder'; }

    $columnsCls =  $clsPfix . 'GridCol ' . $clsPfix . 'GridCol_' . $item['colsQty'];
    //LR and Bottom margins. Default 1%

    $marginsCls = rtrim(' ' . abcfsl_util_cls_name_nc_bldr(  $item['itemPadLR'], 'PadLR', $clsPfix, '' ) . ' ' . abcfsl_util_cls_name_nc_bldr( $item['itemMarginBN'], 'MB', $clsPfix, '40' ));

    //Item container DIV
    $div['itemCntrS'] = abcfl_html_tag( 'div', '', $columnsCls . $marginsCls . $customCls . $vAidCls, $item['lstItemStyle'] );
    $div['itemCntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

function abcfsl_cnt_grid_a_item_inner_cntr( $customCls, $customStyle ){

    $div['cntrS'] = '';
    $div['cntrE'] = '';
    if( empty( $customCls ) && empty( $customStyle ) ) { return $div; }

    $div['cntrS'] = abcfl_html_tag( 'div', '', $customCls, $customStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}

// GRID A - TEXT container.
function abcfsl_cnt_grid_a_item_txt_cntr( $itemID, $itemOptns, $tplateOptns, $sPageUrl, $clsPfix, $vAid, $addMaxW ){

    $lstTxtCntrCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : '';
    $lstTxtCntrStyle = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';

    $maxWCntr['cntrS'] = '';
    $maxWCntr['cntrE'] = '';
    if($addMaxW == 'Y'){
        $imgUrl = isset( $itemOptns['_imgUrlL'] ) ? esc_attr( $itemOptns['_imgUrlL'][0] ) : '';
        $imgIDL = isset( $itemOptns['_imgIDL'] ) ? esc_attr( $itemOptns['_imgIDL'][0] ) : 0;
        $maxWCntr = abcfsl_cnt_grid_a_item_txt_cntr_max_w_wrap( $tplateOptns, $imgIDL, $imgUrl, $addMaxW );
    }
    $itemLinesHTML  = '';
    $vAidCls = '';
    if( $vAid == 'Y' ) { $vAidCls = ' ' . $clsPfix . 'VAidTxt'; }

    $div = abcfsl_cnt_generic_div($clsPfix, 'GridTxtCntr', $lstTxtCntrCls, $lstTxtCntrStyle, $vAidCls, '', '', 'N', false);

    $isSingle = false;
    $fieldOrder = abcfsl_util_field_order( $tplateOptns, $isSingle );

    foreach ( $fieldOrder as $F ) {
        $itemLinesHTML .= abcfsl_cnt_txt_field( $itemOptns, $tplateOptns, $itemID, $sPageUrl, $F, false, $clsPfix );
    }

    return $maxWCntr['cntrS'] . $div['cntrS'] . $itemLinesHTML . $div['cntrE'] . $maxWCntr['cntrE'];
}

//<div style="width:450px; max-width:450px;">
//        <div class="abcfslGridTxtCntr">
//            <h2 class="abcfslHXSmall6  abcfslPadT10">Caption</h2>
//            <div>Caption</div>
//            <div>
//            </div>
//        </div>
//</div>
//</div>

// Grid A text container. Set max-width to width of the image.
function abcfsl_cnt_grid_a_item_txt_cntr_max_w_wrap( $tplateOptns, $imgIDL, $imgUrl, $addMaxW ){

    $maxWCntr['cntrS'] = '';
    $maxWCntr['cntrE'] = '';

    if($addMaxW != 'Y') { return $maxWCntr; }

    //No image selected.  Check placeholder options.
    if( empty( $imgUrl )){
        $placeholder = abcfsl_img_placeholder( $tplateOptns, false );
        $imgUrl = $placeholder['imgUrl'];
        $imgIDL = $placeholder['imgID'];
        if( empty( $imgUrl )){ return $maxWCntr; }
    }

    //---------------------------------
    //Create image container by Img ID. If image not found, return empty container
    if( $imgIDL > 0 ){
        $imgWH = abcfsl_img_wh( $imgIDL, $imgUrl );
        if( $imgWH['ok'] ){ return abcfsl_cnt_grid_a_item_txt_cntr_max_w_cntr( $imgWH['w'] ); }
        return $maxWCntr;
    }

    //Quick start image.
    $imgW = abcfsl_cnt_grid_a_qs_img_w( $imgUrl );
    if( $imgW > 0 ){ return abcfsl_cnt_grid_a_item_txt_cntr_max_w_cntr( $imgW ); }

    //Placeholder default image
    $imgW = abcfsl_cnt_grid_a_placeholder_img_w( $imgUrl );
    if( $imgW > 0 ){ return abcfsl_cnt_grid_a_item_txt_cntr_max_w_cntr( $imgW ); }

    //--- User image. Missing Img ID. ------------------
    $imgIDL = abcfsl_img_id_by_url( $imgUrl );

    if( $imgIDL == 0 ){ return $maxWCntr; }

    $imgWH = abcfsl_img_wh( $imgIDL, $imgUrl );
    if( $imgWH['ok'] ){ return abcfsl_cnt_grid_a_item_txt_cntr_max_w_cntr( $imgWH['w'] ); }

    return $maxWCntr;
}

function abcfsl_cnt_grid_a_item_txt_cntr_max_w_cntr( $imgW ){

    $cssMaxW = abcfl_css_w( $imgW, true );
    $maxWCntr['cntrS'] = abcfl_html_tag( 'div', '', 'abcfslMLRAuto', $cssMaxW );
    $maxWCntr['cntrE'] = abcfl_html_tag_end( 'div' );

    return $maxWCntr;
}

function abcfsl_cnt_grid_a_qs_img_w( $imgUrl ){
    $imgW = 0;
    //Quck Start image.
    if ( strpos( $imgUrl, 'staff-list-pro/images/staff-member') !== false) { $imgW = 220; }
    return $imgW;
}

function abcfsl_cnt_grid_a_placeholder_img_w( $imgUrl ){
    $imgW = 0;
    if ( strpos( $imgUrl, 'staff-list-pro/images/placeholder') !== false) { $imgW = 250; }
    return $imgW;
}
