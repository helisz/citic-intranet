<?php
function abcfsl_mbox_tplate_staff_pg_cntrs( $tplateOptns, $clsPfix ){

  echo  abcfl_html_tag('div','','inside hidden');

    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
    $vAid = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';

    $lstCols = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';

    //Grid
    $itemMarginL = isset( $tplateOptns['_itemMarginL'] ) ? esc_attr( $tplateOptns['_itemMarginL'][0] ) : '';
    $itemMarginB = isset( $tplateOptns['_itemMarginB'] ) ? esc_attr( $tplateOptns['_itemMarginB'][0] ) : '';

    $itemPadLR = isset( $tplateOptns['_itemPadLR'] ) ? esc_attr( $tplateOptns['_itemPadLR'][0] ) : 'Pc1';
    $itemMarginBN = isset( $tplateOptns['_itemMarginBN'] ) ? esc_attr( $tplateOptns['_itemMarginBN'][0] ) : '40';

    $lstItemCls = isset( $tplateOptns['_lstItemCls'] ) ? esc_attr( $tplateOptns['_lstItemCls'][0] ) : '';
    $lstItemStyle = isset( $tplateOptns['_lstItemStyle'] ) ? esc_attr( $tplateOptns['_lstItemStyle'][0] ) : '';
    $innerCntrCls = isset( $tplateOptns['_innerCntrCls'] ) ? esc_attr( $tplateOptns['_innerCntrCls'][0] ) : '';
    $innerCntrStyle = isset( $tplateOptns['_innerCntrStyle'] ) ? esc_attr( $tplateOptns['_innerCntrStyle'][0] ) : '';

    $lstTxtCntrStyle = isset( $tplateOptns['_lstTxtCntrStyle'] ) ? esc_attr( $tplateOptns['_lstTxtCntrStyle'][0] ) : '';
    $addMaxW = isset( $tplateOptns['_addMaxW'] ) ? esc_attr( $tplateOptns['_addMaxW'][0] ) : 'N';

    $defaultTCC = $clsPfix . 'PadLPc5';
    if( $lstLayoutH == 3 ) { $defaultTCC = '';}
    $lstTxtCntrCls = isset( $tplateOptns['_lstTxtCntrCls'] ) ? esc_attr( $tplateOptns['_lstTxtCntrCls'][0] ) : $defaultTCC;


    switch ($lstLayoutH) {
        case 1:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_list( $lstItemCls, $lstItemStyle );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $lstTxtCntrCls, $lstTxtCntrStyle );
            break;
        case 2:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_b( $lstCols, $itemPadLR, $itemMarginBN, $lstItemCls, $lstItemStyle );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $lstTxtCntrCls, $lstTxtCntrStyle );
            break;
        case 3:
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_a( $itemPadLR, $itemMarginBN, $itemMarginL,  $itemMarginB, $lstItemCls, $lstItemStyle, $vAid );
            abcfsl_mbox_tplate_staff_pg_cntrs_inner_cntr( $innerCntrCls, $innerCntrStyle );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_grid_a( $lstTxtCntrCls, $lstTxtCntrStyle, $addMaxW );
            break;
        case 200: // ISOTOPE
            $itemPadLR = isset( $tplateOptns['_itemPadLR'] ) ? esc_attr( $tplateOptns['_itemPadLR'][0] ) : '';
            abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_ia( $itemPadLR, $itemMarginBN, $itemMarginL,  $itemMarginB, $lstItemCls, $lstItemStyle, $vAid );
            abcfsl_mbox_tplate_staff_pg_cntrs_inner_cntr( $innerCntrCls, $innerCntrStyle );
            abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_grid_a( $lstTxtCntrCls, $lstTxtCntrStyle, $addMaxW );
            break;
        default:
            break;
    }
    echo abcfl_html_tag_end('div');
}

//== LIST ===========================================================================
//LIST Item Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_list( $lstItemCls, $lstItemStyle ){
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'list-item-container.png', abcfsl_txta(301), '', '' );
    abcfsl_autil_class_and_style( 'lstItemCls', $lstItemCls, 'lstItemStyle', $lstItemStyle, '', false );
}

//== GRID B ===================================================================
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_b( $lstCols, $itemPadLR, $itemMarginBN, $lstItemCls, $lstItemStyle ){

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-b-item-container.png', abcfsl_txta(301), '', abcfsl_aurl(30) );

    echo abcfl_input_cbo('lstCols', '', abcfsl_cbo_list_columns(), $lstCols, abcfsl_txta_r(253), abcfsl_txta(308), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemPadLR', '', abcfsl_cbo_list_grid_pad_lr(), $itemPadLR, abcfsl_txta_r(119), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemMarginBN', '', abcfsl_cbo_list_grid_item_bottom_margin(), $itemMarginBN, abcfsl_txta_r(120), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    abcfsl_autil_class_and_style( 'gridItemCls', $lstItemCls, 'gridItemStyle', $lstItemStyle, '', false );

}

//LIST - Text Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_list( $txtCntrCls, $txtCntrStyle ){
    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-b-text-container.png', abcfsl_txta(251), '', '' );

    abcfsl_autil_class_and_style( 'lstTxtCntrCls', $txtCntrCls, 'lstTxtCntrStyle', $txtCntrStyle, '', false, '', '', '', 252);
}

//== GRID A===========================================================================
//GRID Item Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_a( $itemPadLR, $itemMarginBN, $itemMarginL, $itemMarginB, $lstItemCls, $lstItemStyle, $vAid ){

    $cboItemMB = abcfsl_cbo_margin_bottom_margin();
    $cboItemPadLR = abcfsl_cbo_pad_lr();

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-item-container.png', abcfsl_txta(301), '', '' );
    echo abcfl_input_cbo_strings('itemPadLR', '', $cboItemPadLR, $itemPadLR, abcfsl_txta_r(75), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemMarginBN', '', $cboItemMB, $itemMarginBN, abcfsl_txta_r(89), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //Add legacy classes to custom class
    if( !empty( $itemMarginL ) ) { $lstItemCls = $lstItemCls . ' ' . $itemMarginL; }
    if( !empty( $itemMarginB ) ) { $lstItemCls = $lstItemCls . ' ' . $itemMarginB; }
    //$lstItemCls = trim($lstItemCls);

    // TODO Input removed defaults to 40px
    abcfsl_autil_class_and_style( 'lstItemCls', trim($lstItemCls), 'lstItemStyle', $lstItemStyle, '', false );
}

//GRID - Text Container
function abcfsl_mbox_tplate_staff_pg_cntrs_txt_cntr_grid_a( $txtCntrCls, $txtCntrStyle, $addMaxW ){

    $cboYN = abcfsl_cbo_yn();

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-text-container.png', abcfsl_txta(251), '', '' );
    echo abcfl_input_cbo_strings('addMaxW', '',$cboYN, $addMaxW, abcfsl_txta(278), abcfsl_txta(309), '50%',  '', '', 'abcflFldCntr', 'abcflFldLbl');

    abcfsl_autil_class_and_style( 'lstTxtCntrCls', $txtCntrCls, 'lstTxtCntrStyle', $txtCntrStyle, '', false);
}

//== GENERIC ==============================================================
//Image Style.
function abcfsl_mbox_tplate_staff_pg_cntrs_img_cntr( $imgBorder, $imgCenter, $lstImgCls, $lstImgStyle, $icon, $hasImgCenter, $imgHover, $imgDS ){

    $cboImgBorder = abcfsl_cbo_img_border();

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL , $icon, abcfsl_txta(43), '', '' );
    echo abcfl_input_cbo_strings('imgBorder', '', $cboImgBorder, $imgBorder, abcfsl_txta(40), abcfsl_txta(228), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    if( $hasImgCenter ) {
        abcfsl_util_center_yn( 'imgCenter', $imgCenter, 84, 0 );
    }

    // HOVER
    echo abcfsl_mbox_tplate_staff_pg_cntrs_img_hover( $imgHover, $imgDS );

    abcfsl_autil_class_and_style( 'lstImgCls', $lstImgCls, 'lstImgStyle', $lstImgStyle, '', false, '1' );
}

function abcfsl_mbox_tplate_staff_pg_cntrs_img_hover( $imgHover, $imgDS ){

    $cboDS = abcfsl_cbo_drop_shadow();
    $cboHover = abcfsl_cbo_hover();
    echo abcfl_input_cbo('imgDS', '', $cboDS, $imgDS, abcfsl_txta(246), abcfsl_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('imgHover', '', $cboHover, $imgHover, abcfsl_txta(265), abcfsl_txta(0), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//Inner Container.
function abcfsl_mbox_tplate_staff_pg_cntrs_inner_cntr( $cls, $style ){

    echo abcfl_input_hline('2');
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-item-inner-container.png', abcfsl_txta(31), '', '' );

    abcfsl_autil_class_and_style( 'innerCntrCls', $cls, 'innerCntrStyle', $style, '', false, '', '', '', '');
}

// ISOTOPE ===================================
function abcfsl_mbox_tplate_staff_pg_cntrs_item_cntr_grid_ia( $itemPadLR, $itemMarginBN, $itemMarginL, $itemMarginB, $lstItemCls, $lstItemStyle ){

    $cboItemMB = abcfsl_cbo_margin_bottom_margin();
    $cboItemPadLR = abcfsl_cbo_pad_lr_isotope();

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, 'grid-a-item-container.png', abcfsl_txta(301), '', '' );
    echo abcfl_input_cbo_strings('itemPadLR', '', $cboItemPadLR, $itemPadLR, abcfsl_txta_r(75), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('itemMarginBN', '', $cboItemMB, $itemMarginBN, abcfsl_txta_r(89), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    //Add legacy classes to custom class
    if( !empty( $itemMarginL ) ) { $lstItemCls = $lstItemCls . ' ' . $itemMarginL; }
    if( !empty( $itemMarginB ) ) { $lstItemCls = $lstItemCls . ' ' . $itemMarginB; }
    //$lstItemCls = trim($lstItemCls);

    // TODO Input removed defaults to 40px
    abcfsl_autil_class_and_style( 'lstItemCls', trim($lstItemCls), 'lstItemStyle', $lstItemStyle, '', false );
}
