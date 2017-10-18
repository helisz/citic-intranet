<?php

//Grid items builder.
function abcfsl_cnt_grid_b( $tplateOptns, $optns, $clsPfix ){

    $colL = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $colR = (12 - $colL);

    //????????? TODO Options not used yet
    $lstItemCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : '';
    $lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';

    $gridColsXL = isset( $tplateOptns['_gridCols'] ) ? esc_attr( $tplateOptns['_gridCols'][0] ) : '2';
    $gridColsLG = isset( $tplateOptns['_gridColsLG'] ) ? esc_attr( $tplateOptns['_gridColsLG'][0] ) : '0';
    $gridColsMD = isset( $tplateOptns['_gridColsMD'] ) ? esc_attr( $tplateOptns['_gridColsMD'][0] ) : '0';
    $gridColsQty = abcfsl_util_grid_cols_qty( $gridColsXL , $gridColsLG, $gridColsMD );

    //$lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : $clsPfix . 'ImgCenter';
    $lstImgCls = isset( $tplateOptns['_lstImgCls'] ) ? esc_attr( $tplateOptns['_lstImgCls'][0] ) : '';
    $tplateOptns['_lstImgCls'] = array($lstImgCls);

    $par = array(
    'colL' => $colL,
    'colR' => $colR,
    'clsPfix' => $clsPfix,
    'vAid' => isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N',
    'sPageUrl' => isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '',
    'colsQty' => isset( $tplateOptns['_gridCols'] ) ? esc_attr( $tplateOptns['_gridCols'][0] ) : '2',
    'itemPadLR' => isset( $tplateOptns['_itemPadLR'] ) ? esc_attr( $tplateOptns['_itemPadLR'][0] ) : 'Pc1',
    'itemMarginBN' => isset( $tplateOptns['_itemMarginBN'] ) ? esc_attr( $tplateOptns['_itemMarginBN'][0] ) : '40',
    'gridItemCls' => isset( $tplateOptns['_gridItemCls'] ) ? esc_attr( $tplateOptns['_gridItemCls'][0] ) : '',
    'gridItemStyle'  => isset( $tplateOptns['_gridItemStyle'] ) ? esc_attr( $tplateOptns['_gridItemStyle'][0] ) : '',
    'cptn1'  => '',
    'cptn2'  => '',
    'cptn3'  => ''
    );

    //== PG ===========================================
    $items['itemsHTML'] = '';
    $items['itemsSD'] = ''; //SDATA
    $items['totalQty'] = 0;
    $itemsOut  = '';
    $itemsSD  = ''; //SDATA
    $out = abcfsl_util_post_ids( $optns );
    $totalQty = $out['totalQty'];
    if( $totalQty == 0 ) { return $items; }
    $postIDs = $out['postIDs'];
    //================================================

    //SDATA
    if( $gridColsQty['oneBreak'] ) {
        $itemsOut = abcfsl_cnt_grid_b_items_one_break( $postIDs, $gridColsXL, $tplateOptns, $par);
    }
    else {
        $itemsOut = abcfsl_cnt_grid_b_items_multi_break( $postIDs, $gridColsQty, $tplateOptns, $par );
    }

    //SDATA
    $items['itemsHTML'] = $itemsOut['itemsHTML'];
    $items['itemsSD'] = $itemsOut['itemsSD'];
    $items['totalQty'] = $totalQty;
    return $items;

}

function abcfsl_cnt_grid_b_items_one_break( $postIDs, $gridColsXL, $tplateOptns, $par ){
    $clsPfix = $par['clsPfix'];
    $gridColCls = $clsPfix . 'GridCol ' . $clsPfix . 'GridCol_' . $gridColsXL;
    $i = 1;
    $itemsHTML = '';
    $itemsSD  = array(); //SDATA
    $rowClosed = false;

    //GRID row container
    $rowDivS = abcfl_html_tag( 'div', '', $clsPfix . 'GridRow ' . 'abcfClrFix', '' );
    foreach ( $postIDs as $itemID ) {
        if( $i == 1 ) { $itemsHTML .= $rowDivS; }
        //$gridItem = abcfsl_cnt_grid_b_cell( $itemID, $gridColCls, $tplateOptns, $par );

        $out = abcfsl_cnt_grid_b_cell( $itemID, $gridColCls, $tplateOptns, $par );
        $itemsHTML .= $out['itemCntr'];
        $itemsSD[] = $out['sdProperties']; //SDATA
        //Row closing tag.
        $rowClosed = false;
        if( $i == $gridColsXL ) {
            $i = 0;
            $rowClosed = true;
            $itemsHTML .= '</div>';
        }
        $i++;
    }
    if( !$rowClosed ) {  $itemsHTML .= '</div>'; }
    //return $itemsHTML;

    //SDATA
    $items['itemsHTML'] = $itemsHTML;
    $items['itemsSD'] = $itemsSD;
    return $items;
}

function abcfsl_cnt_grid_b_items_multi_break( $postIDs, $gridColsQty, $tplateOptns, $par ){

    $clsPfix = $par['clsPfix'];
    //GRID items container for multiple breakpoints
    $itemsDivS = abcfl_html_tag( 'div', '', $clsPfix . 'GridItemsCntr', '' );
    $gridColClsXL =  $clsPfix . 'GCol_xl_' . $gridColsQty['XL'];
    $gridColClsLG = ' ' . $clsPfix . 'GCol_lg_' . $gridColsQty['LG'];
    $gridColClsMD = ' ' . $clsPfix . 'GCol_md_' . $gridColsQty['MD'];

    $gridColCls = $clsPfix . 'GCol ' . $gridColClsXL . $gridColClsLG . $gridColClsMD;
    $itemsHTML = '';
    $itemsSD  = array(); //SDATA

    foreach ( $postIDs as $itemID ) {
        //$itemsHTML .= abcfsl_cnt_grid_b_cell( $itemID, $gridColCls, $tplateOptns, $par );
        $out = abcfsl_cnt_grid_b_cell( $itemID, $gridColCls, $tplateOptns, $par );
        $itemsHTML .= $out['itemCntr'];
        $itemsSD[] = $out['sdProperties']; //SDATA

    }

    $itemsHTML = $itemsDivS . $itemsHTML. '</div>';
    //return $itemsHTML;

    //SDATA
    $items['itemsHTML'] = $itemsHTML;
    $items['itemsSD'] = $itemsSD;
    return $items;

}

//GRID cell + List item container & content
function abcfsl_cnt_grid_b_cell( $itemID, $gridColCls, $tplateOptns, $par ){

    $clsPfix = $par['clsPfix'];
    $vAid = $par['vAid'];

    $divCell = abcfsl_cnt_grid_b_cell_div( $gridColCls, $par, $clsPfix, $vAid );
    //$gridItem = abcfsl_cnt_grid_b_item( $itemID, $tplateOptns, $par['colL'], $par['colR'], $vAid, '', '', $par['sPageUrl'], $clsPfix );

    //SDATA
    $out = abcfsl_cnt_grid_b_item( $itemID, $tplateOptns, $par['colL'], $par['colR'], $vAid, '', '', $par['sPageUrl'], $clsPfix );

    //if( empty ( $gridItem ) ) { return ''; }
    //return $divCell['itemCntrS'] . $gridItem . $divCell['itemCntrE'];

    //SDATA
    $out['itemCntr'] = $divCell['itemCntrS'] . $out['itemCntr'] . $divCell['itemCntrE'];
    return $out;
}

//List Item container: List, image left, text right. Goes into a grid cell
function abcfsl_cnt_grid_b_item( $itemID, $tplateOptns, $colL, $colR, $vAid, $lstItemCustomCls, $lstItemStyle, $sPageUrl, $clsPfix ){

    $vAidCls = '';
    $vAidClsImgCntr = '';
    if( $vAid == 'Y' ) {
        $vAidCls = ' ' . $clsPfix . 'VAidBorder';
        $vAidClsImgCntr = ' ' . $clsPfix . 'VAidBorderR';
    }

    $div = abcfsl_cnt_list_item_cntr_div( $lstItemCustomCls . $vAidCls, $lstItemStyle, $clsPfix );
    $itemOptns = get_post_custom( $itemID );

    //Remove excluded. EXCLUDED
    //$hideSMember = isset( $itemOptns['_hideSMember'] ) ? esc_attr( $itemOptns['_hideSMember'][0] ) : '0';
    //if($hideSMember == 1) { return '';}

    $par['pgLayout'] = 2;
    $par['itemID'] = $itemID;
    $par['colL'] = $colL;
    $par['clsPfix'] = $clsPfix;
    $par['vAidCls'] = $vAidClsImgCntr;
    $par['sPageUrl'] = $sPageUrl;
    $par['isSingle'] = false;
    //abcfsl_cnt_image_cntr( $lstLayout, $itemID, $tplateOptns, $itemOptns, $colL, $clsPfix, $vAidCls, $sPageUrl, $isSingle )
    //$imgCntr = abcfsl_cnt_image_cntr( 2, $itemID, $tplateOptns, $itemOptns, $colL, $clsPfix, $vAidClsImgCntr, $sPageUrl, false );
    $imgCntr = abcfsl_cnt_image_cntr( $tplateOptns, $itemOptns, $par );

    $txtSection = abcfsl_cnt_list_txt_section( $itemID, $itemOptns, $tplateOptns, $sPageUrl, $colR, $clsPfix, $vAid, false );

    //return $div['itemCntrS'] . $imgCntr . $txtSection . $div['itemCntrE'];

    //SDATA
    $out['itemCntr'] = $div['itemCntrS'] . $imgCntr . $txtSection . $div['itemCntrE'];
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns );

 //echo"<pre>", print_r($out), "</pre>"; die;

    return $out;
}

function abcfsl_cnt_grid_b_cell_div( $gridColCls, $optns, $clsPfix, $vAid ){

    $vAidCls = '';
    $customCls = '';

    if( !empty( $optns['gridItemCls'] ) ){ $customCls = ' ' . $optns['gridItemCls']; }
    if( $vAid == 'Y' ) { $vAidCls = ' ' . $clsPfix . 'VAidBorderGreen'; }

    //LR and Bottom margins.
    $marginsCls = rtrim(abcfsl_util_cls_name_nc_bldr( $optns['itemPadLR'], 'PadLR', $clsPfix ) . abcfsl_util_cls_name_nc_bldr( $optns['itemMarginBN'], 'MB', $clsPfix ));

    //Item container DIV
    $div['itemCntrS'] = abcfl_html_tag( 'div', '', $gridColCls . $marginsCls . $customCls . $vAidCls, $optns['gridItemStyle'] );
    $div['itemCntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}
