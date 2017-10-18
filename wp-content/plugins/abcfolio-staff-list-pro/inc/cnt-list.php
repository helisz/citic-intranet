<?php

//List Items builder.
function abcfsl_cnt_list( $tplateOptns, $optns, $clsPfix ){

    $lstItemDefaultCls = $clsPfix . 'PadBMB30';

    $colL = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $colR = (12 - $colL);
    $vAid = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';

    $lstItemCustomCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : $lstItemDefaultCls;
    $lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';

    $sPageUrl = isset( $tplateOptns['_sPageUrl'] ) ? esc_attr( $tplateOptns['_sPageUrl'][0] ) : '';

    //== PG ==============================================
    $items['itemsHTML'] = '';
    $items['totalQty'] = 0;
    $items['itemsSD'] = '';
    $itemsHTML  = '';
    $itemsSD  = array(); //SDATA
    $out = abcfsl_util_post_ids( $optns );
    $totalQty = $out['totalQty'];
    if( $totalQty == 0 ) { return $items; }
    $postIDs = $out['postIDs'];
    //================================================

    //$outItems['itemCntr'] = '';
    //$outItems['sdProperties'] = array();

    //1.Image left, text right; 2.Image top, text bottom;
    if ( $postIDs ) {
        foreach ( $postIDs as $itemID ) {
            //$itemsHTML .= abcfsl_cnt_list_item_cntr($itemID, $tplateOptns, $colL, $colR, $vAid, $lstItemCustomCls, $lstItemStyle, $sPageUrl, $clsPfix, '' );
            $outItems = abcfsl_cnt_list_item_cntr($itemID, $tplateOptns, $colL, $colR, $vAid, $lstItemCustomCls, $lstItemStyle, $sPageUrl, $clsPfix, '' );
            $itemsHTML .= $outItems['itemCntr'];
            $itemsSD[] = $outItems['sdProperties']; //SDATA
        }
   }

   //SDATA
   $items['itemsHTML'] = $itemsHTML;
   $items['totalQty'] = $totalQty;
   $items['itemsSD'] = $itemsSD;
   return $items;
}

//-- LIST ITEM ---------------------------------------------------------------------------------------
//List Item container: image left, text right.
function abcfsl_cnt_list_item_cntr( $itemID, $tplateOptns, $colL, $colR, $vAid, $lstItemCustomCls, $lstItemStyle, $sPageUrl, $clsPfix ){

    $vAidCls = '';
    $vAidClsImgCntr = '';
    if( $vAid == 'Y' ) {
        $vAidCls = ' ' . $clsPfix . 'VAidBorder';
        $vAidClsImgCntr = ' ' . $clsPfix . 'VAidBorderR';
    }

    $div = abcfsl_cnt_list_item_cntr_div( $lstItemCustomCls . $vAidCls, $lstItemStyle, $clsPfix );
    $itemOptns = get_post_custom( $itemID );

    ////Remove excluded. EXCLUDED
    //$hideSMember = isset( $itemOptns['_hideSMember'] ) ? esc_attr( $itemOptns['_hideSMember'][0] ) : '0';
    //if($hideSMember == 1) { return '';}

    //------------------------------------------------------
    $par['pgLayout'] = 1;
    $par['itemID'] = $itemID;
    $par['colL'] = $colL;
    $par['clsPfix'] = $clsPfix;
    $par['vAidCls'] = $vAidClsImgCntr;
    $par['sPageUrl'] = $sPageUrl;
    $par['isSingle'] = false;
    //abcfsl_cnt_image_cntr( $lstLayout, $itemID, $tplateOptns, $itemOptns, $colL, $clsPfix, $vAidCls, $sPageUrl, $isSingle )
    //$imgCntr = abcfsl_cnt_image_cntr( 1, $itemID, $tplateOptns, $itemOptns, $colL, $clsPfix, $vAidClsImgCntr, $sPageUrl, false );
    $imgCntr = abcfsl_cnt_image_cntr( $tplateOptns, $itemOptns, $par );

    $txtSection = abcfsl_cnt_list_txt_section( $itemID, $itemOptns, $tplateOptns, $sPageUrl, $colR, $clsPfix, $vAid, false );

    //return $div['itemCntrS'] . $imgCntr . $txtSection . $div['itemCntrE'];

    //SDATA
    $out['itemCntr'] = $div['itemCntrS'] . $imgCntr . $txtSection . $div['itemCntrE'];
    $out['sdProperties'] = abcfsl_struct_data_item_grid( $tplateOptns, $itemOptns );

    return $out;
}

function abcfsl_cnt_list_item_cntr_div( $customCls, $lstItemStyle, $clsPfix ){

    $itemCls = '';
    if(!empty($customCls)){ $customCls = ' ' . $customCls; }

    //Item container DIV
    $div['itemCntrS'] = abcfl_html_tag( 'div', '', $clsPfix . 'LstRowCntr' . $customCls . ' abcfClrFix' . $itemCls, $lstItemStyle );
    $div['itemCntrE'] = abcfl_html_tag_end( 'div');

    return $div;
}
