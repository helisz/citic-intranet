<?php
function abcfsl_mbox_tplate_staff_pg_layout( $tplateOptns ){

    echo  abcfl_html_tag('div','','inside');
    $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
    $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;

    $lstCntrW = isset( $tplateOptns['_lstCntrW'] ) ? esc_attr( $tplateOptns['_lstCntrW'][0] ) : '';
    $lstACenter = isset( $tplateOptns['_lstACenter'] ) ? esc_attr( $tplateOptns['_lstACenter'][0] ) : 'Y';
    $lstCntrTM = isset( $tplateOptns['_lstCntrTM'] ) ? esc_attr( $tplateOptns['_lstCntrTM'][0] ) : '';
    $lstCntrCls = isset( $tplateOptns['_lstCntrCls'] ) ? esc_attr( $tplateOptns['_lstCntrCls'][0] ) : '';
    $lstCntrStyle = isset( $tplateOptns['_lstCntrStyle'] ) ? esc_attr( $tplateOptns['_lstCntrStyle'][0] ) : '';

    //-- ADD NEW Record Screen. Display only Add New Field cbo --------------------
    if($lstLayoutH == '0'){
        abcfsl_mbox_tplate_staff_pg_layout_list_layout( $lstLayout );
        echo abcfl_html_tag_end('div');
        return;
    }

    $lstCols = isset( $tplateOptns['_lstCols'] ) ? esc_attr( $tplateOptns['_lstCols'][0] ) : '6';
    $gridCols = isset( $tplateOptns['_gridCols'] ) ? esc_attr( $tplateOptns['_gridCols'][0] ) : '2';
    $gridColsLG = isset( $tplateOptns['_gridColsLG'] ) ? esc_attr( $tplateOptns['_gridColsLG'][0] ) : '0';
    $gridColsMD = isset( $tplateOptns['_gridColsMD'] ) ? esc_attr( $tplateOptns['_gridColsMD'][0] ) : '0';

    $vAid = isset( $tplateOptns['_vAid'] ) ? esc_attr( $tplateOptns['_vAid'][0] ) : 'N';

    //---------------------------
    echo abcfl_input_hidden( '', 'lstLayoutH', $lstLayoutH );

    switch ( $lstLayoutH ) {
        case 1:
            abcfsl_mbox_tplate_staff_pg_layout_list( $lstCols, $lstCntrW, $lstCntrCls, $lstCntrStyle, 'layout-list.png', $lstACenter, $vAid );
            break;
        case 2:
            abcfsl_mbox_tplate_staff_pg_layout_grid_b( $gridCols, $gridColsLG, $gridColsMD,  $lstCntrW, $lstCntrCls, $lstCntrStyle, 'layout-grid-b.png', $lstACenter, $vAid );
            break;
        case 3:
            abcfsl_mbox_tplate_staff_pg_layout_grid_a( $gridCols, $lstCntrW, $lstCntrCls, $lstCntrStyle, 'layout-grid-a.png', $lstACenter, $vAid );
            break;
        case 200: // ISOTOPE
            abcfsl_mbox_tplate_staff_pg_layout_pg_layout_isotope_a( $tplateOptns, $lstCntrW, $lstCntrCls, $lstCntrStyle, 'layout-grid-a.png', $lstACenter, $vAid );
            break;
        default:
            break;
    }
    echo abcfl_html_tag_end('div');
}

//=====================================================================
//Layout selection: Rows or Grid
function abcfsl_mbox_tplate_staff_pg_layout_list_layout( $lstLayout ){

    $cboLstLayout = abcfsl_cbo_staff_pg_layout();
    echo abcfl_input_cbo('lstLayout', '',$cboLstLayout, $lstLayout, abcfsl_txta(213), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_icon_cntr( ABCFSL_ICONS_URL, 'staff-list-layouts-pro.png', 'abcflMTop20 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(25), 'abcflFontFVS14 abcflFontW400 abcflMTop20' );
}

//=====================================================================
//LIST Content Container Style. Stacked Layout, rows
function abcfsl_mbox_tplate_staff_pg_layout_list( $lstCols, $lstCntrW, $lstCntrCls, $lstCntrStyle, $icon, $lstACenter, $vAid ){

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL,  $icon, abcfsl_txta(215), abcfsl_txta(116), abcfsl_aurl(26) );

    $cboCols = abcfsl_cbo_list_columns();
    echo abcfl_input_cbo('lstCols', '', $cboCols, $lstCols, abcfsl_txta_r(253), abcfsl_txta(308), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    abcfsl_autil_class_and_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', false, '1' );
    abcfsl_mbox_tplate_staff_pg_layout_pg_layout_vaid( $vAid );
}

//GRID A Content Container Style
function abcfsl_mbox_tplate_staff_pg_layout_grid_a( $gridCols, $lstCntrW, $lstCntrCls, $lstCntrStyle, $icon, $lstACenter, $vAid ){

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, $icon, abcfsl_txta(201), abcfsl_txta(220), abcfsl_aurl(27) );

    $cboCols = abcfsl_cbo_grid_columns();
    echo abcfl_input_cbo('gridCols', '',$cboCols, $gridCols, abcfsl_txta_r(51), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    abcfsl_autil_class_and_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', false, '1' );
    abcfsl_mbox_tplate_staff_pg_layout_pg_layout_vaid( $vAid );
}

//GRID B Content Container Style
function abcfsl_mbox_tplate_staff_pg_layout_grid_b( $gridCols, $gridColsLG, $gridColsMD, $lstCntrW, $lstCntrCls, $lstCntrStyle, $icon, $lstACenter, $vAid ){

    $cboLstGridCols = abcfsl_cbo_list_grid_columns();
    $cboColsBreaks = abcfsl_cbo_list_grid_column_breaks();
    //abcfsl_mbox_tplate_css_section_hdr( $icon, 146, 116, false );
    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, $icon, abcfsl_txta(146), abcfsl_txta(116), abcfsl_aurl(28) );

    echo abcfl_input_hline('2');
    echo abcfl_input_info_lbl( abcfsl_txta(51), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_cbo('gridCols', '',$cboLstGridCols, $gridCols, abcfsl_txta_r(350), abcfsl_txta(353), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('gridColsLG', '',$cboColsBreaks, $gridColsLG, abcfsl_txta(351), abcfsl_txta(355), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings('gridColsMD', '',$cboColsBreaks, $gridColsMD, abcfsl_txta(352), abcfsl_txta(356), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_info_lbl( abcfsl_txta(354), 'abcflMTop5', 12 );

    echo abcfl_input_hline('2');
    echo abcfl_input_info_lbl( abcfsl_txta(118), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    abcfsl_autil_class_and_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', false, '1' );
    abcfsl_mbox_tplate_staff_pg_layout_pg_layout_vaid( $vAid );

}

// ISOTOPE
function abcfsl_mbox_tplate_staff_pg_layout_pg_layout_isotope_a( $tplateOptns, $lstCntrW, $lstCntrCls, $lstCntrStyle, $icon, $lstACenter, $vAid ){

    abcfl_input_sec_icon_hdr_hlp( ABCFSL_ICONS_URL, $icon, abcfsl_txta(192) . ' ' . abcfsl_txta(201), '', abcfsl_aurl(27) );

    //$cboCols = abcfsl_cbo_grid_columns();
    //echo abcfl_input_cbo('gridCols', '',$cboCols, $gridCols, abcfsl_txta_r(51), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    abcfsl_mbox_tplate_staff_pg_layout_columns_sec( $tplateOptns );
    echo abcfl_input_hline('1');
    echo abcfl_input_txt('lstCntrW', '', $lstCntrW, abcfsl_txta(48), abcfsl_txta(260), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    abcfsl_util_center_yn( 'lstACenter', $lstACenter );

    abcfsl_autil_class_and_style( 'lstCntrCls', $lstCntrCls, 'lstCntrStyle', $lstCntrStyle, '', false, '1' );
    abcfsl_mbox_tplate_staff_pg_layout_pg_layout_vaid( $vAid );
}

// ISOTOPE Number of columns
function abcfsl_mbox_tplate_staff_pg_layout_columns_sec( $tplateOptns ){

    $gridCols = isset( $tplateOptns['_gridCols'] ) ?  $tplateOptns['_gridCols'][0] : 2;
    $gridColsLG = isset( $tplateOptns['_gridColsLG'] ) ? $tplateOptns['_gridColsLG'][0] : 0;
    $gridColsMD = isset( $tplateOptns['_gridColsMD'] ) ? $tplateOptns['_gridColsMD'][0] : 0;
    $gridColsSM = isset( $tplateOptns['_gridColsSM'] ) ? $tplateOptns['_gridColsSM'][0] : 0;
    $gridColsXS = isset( $tplateOptns['_gridColsXS'] ) ? $tplateOptns['_gridColsXS'][0] : 0;

    //$gLayoutH = isset( $tplateOptns['_gridLayoutH'] ) ? $tplateOptns['_gridLayoutH'][0] : '';
    //$gT = abcfrggcl_mbox_gallery_layout_gallery_type( $gLayoutH );

    $cboCols = abcfsl_cbo_grid_columns_isotope();

    echo abcfl_input_hline('1');
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(51), abcfsl_aurl(0) );

    echo abcfl_input_cbo('gridCols', '', $cboCols, $gridCols, abcfrggcl_txta_r(351, ' 1200px.'), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('gridColsLG', '', $cboCols, $gridColsLG, abcfsl_txta(351, ' 992px.') , '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('gridColsMD', '', $cboCols, $gridColsMD, abcfsl_txta(351, ' 768px.'), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('gridColsSM', '', $cboCols, $gridColsSM, abcfsl_txta(351, ' 480px.'), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo('gridColsXS', '', $cboCols, $gridColsXS, abcfsl_txta(351, ' 320px.'), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//----------------------------------------------

function abcfsl_mbox_tplate_staff_pg_layout_pg_layout_vaid( $vAid ){

    $cboYN = abcfsl_cbo_yn();
    echo abcfl_input_cbo('lstVAid', '', $cboYN, $vAid, abcfsl_txta(248), abcfsl_txta(249), '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}












