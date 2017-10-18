<?php
//== Table START =====================================================

function abcfsls_tbl_parts_table( $parTbl ){

    $tplateOptns =  $parTbl['tplateOptns'];
    $fieldOrder = $parTbl['fieldOrder'];
    $staffTplateID = $parTbl['staffTplateID'];
    $staffTOptns = $parTbl['staffTOptns'];
    $tblID = $parTbl['tblID'];
    $txtLR = $parTbl['txtLR'];
    $clsPfix = $parTbl['clsPfix'];
    $pversion = $parTbl['pversion'];

//echo"<pre>", print_r($parTbl), "</pre>";

    $tblHdrBkgColor = isset( $tplateOptns['_tblHdrBkgColor'] ) ? $tplateOptns['_tblHdrBkgColor'][0] : 'D';
    $tblHdrFSize = isset( $tplateOptns['_tblHdrFSize'] ) ?  $tplateOptns['_tblHdrFSize'][0] : '';
    $tblHdrFColor = isset( $tplateOptns['_tblHdrFColor'] ) ? $tplateOptns['_tblHdrFColor'][0] : '';
    //$hasFooter = isset( $tplateOptns['_hasFooter'] ) ? $tplateOptns['_hasFooter'][0] : '0';
    $hasFooter = '0';
    $tblBdyFSize = isset( $tplateOptns['_tblBdyFSize'] ) ? $tplateOptns['_tblBdyFSize'][0] : '';
    $tblBdyFColor = isset( $tplateOptns['_tblBdyFColor'] ) ?  $tplateOptns['_tblBdyFColor'][0] : '';
    $tblCustCls = isset( $tplateOptns['_tblCustCls'] ) ? $tplateOptns['_tblCustCls'][0] : '';
    $tblBaseStyle = abcfsls_util_tbl_base_style( isset( $tplateOptns['_tblBaseStyle'] ) ? $tplateOptns['_tblBaseStyle'][0] : 'N' );
    $tblStripe = abcfsls_util_checkbox_value( isset( $tplateOptns['_tblStripe'] ) ? $tplateOptns['_tblStripe'][0] : '0', 'stripe', '');
    $tblNoWrap = abcfsls_util_checkbox_value( isset( $tplateOptns['_tblNoWrap'] ) ? $tplateOptns['_tblNoWrap'][0] : '0', 'nowrap', '');
    $tblResponsive = abcfsls_util_checkbox_value( isset( $tplateOptns['_tblResponsive'] ) ? $tplateOptns['_tblResponsive'][0] : '0', 'responsive', '');
    $tblOrderCol = abcfsls_util_checkbox_value( isset( $tplateOptns['_tblOrderCol'] ) ? $tplateOptns['_tblOrderCol'][0] : '0', 'order-column', '');
    $searchHlight = abcfsls_util_checkbox_value( isset( $tplateOptns['_searchHlight'] ) ? $tplateOptns['_searchHlight'][0] : '0', 'searchHighlight', '');

    $tblSearching = isset( $tplateOptns['_tblSearching'] ) ? $tplateOptns['_tblSearching'][0] : '0';
    $tblOrdering = isset( $tplateOptns['_tblOrdering'] ) ? $tplateOptns['_tblOrdering'][0] : '0';
    if( $tblSearching  == '0' ) { $searchHlight = ''; }
    if( $tblOrdering  == '0' ) { $tblOrderCol = ''; }

    //class="dataTable slsDtTbl hover responsive base nowrap stripe order-column searchHighlight ltr slsHdrBkgBlue slsHdrColor100
    //slsHdrFS14 slsHdrFW400 slsBdyFS14 slsBdyColor25  sls_046 no-footer dtr-column"

//    class="dataTable slsDtTbl hover responsive compact nowrap stripe order-column searchHighlight ltr slsHdrBkg85 slsHdrColor25
//        slsHdrFS14 slsHdrFW400 slsBdyFS13 slsBdyColor25  sls_046 no-footer dtr-column collapsed"

    $clsTbl = 'dataTable slsDtTbl hover' .
            $tblResponsive .
            $tblBaseStyle .
            $tblNoWrap .
            $tblStripe .
            $tblOrderCol .
            $searchHlight .
            ' ' . $txtLR .
            abcfsls_util_cls_generic( $tblHdrBkgColor, 'slsHdrBkg' ) .
            abcfsls_util_cls_generic( $tblHdrFColor, 'slsHdrColor' ) .
            abcfsls_util_cls_font_s_w( $tblHdrFSize, 'slsHdrF' ) .
            abcfsls_util_cls_generic( $tblBdyFSize, 'slsBdyF' ) .
            abcfsls_util_cls_generic( $tblBdyFColor, 'slsBdyColor' ) .
            ' ' . $tblCustCls . $pversion;

    //Header & Footer
    $head = abcfsls_tbl_parts_header( $tplateOptns, $fieldOrder, $hasFooter);

    if( $parTbl['headerOnly'] ){
        return abcfl_html_tag( 'table', $tblID, $clsTbl, '' ,' width="100%"' ) . $head['hdr'] . $head['footer'] . '</table>';
    }

    $dtOptns['tplateOptns'] = $tplateOptns;
    $dtOptns['fieldOrder'] = $fieldOrder;
    $dtOptns['staffTplateID'] = $staffTplateID;
    $dtOptns['staffTOptns'] = $staffTOptns;
    $dtOptns['sPgBaseUrl'] = abcfsls_util_single_pg_base_url( $staffTOptns );
    $dtOptns['clsPfix'] = $clsPfix;

    $dataRows = abcfsls_tbl_parts_body_rows( $dtOptns );

    return abcfl_html_tag( 'table', $tblID, $clsTbl, '' ,' width="100%"' ) . $head['hdr'] . $head['footer'] . $dataRows . '</table>';
}
//== Table END =======================================================

//== Header START =====================================================
function abcfsls_tbl_parts_header( $tplateOptns, $fieldOrder, $hasFooter ){

    $head['hdr'] = '';
    $head['footer'] = '';
    $cells['hdr'] = '';
    $cells['footer'] = '';
    $cell = '';

    $tblResponsive = isset( $tplateOptns['_tblResponsive'] ) ? $tplateOptns['_tblResponsive'][0] : '0';

    //Add first column to hold +- buttons
    if( $tblResponsive == '1' ) {
        $cells['hdr'] = abcfl_html_tag_cls( 'th', 'slsMW32', true );
        $cells['footer'] = $cells['hdr'];
    }

    foreach ( $fieldOrder as $F ) {
        $cell = abcfsls_cnt_tbl_header_cell( $tplateOptns, $F, $hasFooter );
        $cells['hdr'] .= $cell['hdr'];
        $cells['footer'] .= $cell['footer'];
    }

    $cntrS = abcfl_html_tag('tr', '', '');

    //Header and footer sections
    $head['hdr'] = abcfl_html_tag_blank('thead') . $cntrS . $cells['hdr'] . '</tr></thead>';

    if( $hasFooter ) {
        $head['footer'] = abcfl_html_tag_blank('tfoot') . $cntrS . $cells['footer'] . '</tr></tfoot>';
    }

    return $head;
}

function abcfsls_cnt_tbl_header_cell( $tplateOptns, $F, $hasFooter ){

    $cell['hdr'] = '';
    $cell['footer'] = '';

    $colHdr = isset( $tplateOptns['_colHdr_' . $F] ) ? esc_attr( $tplateOptns['_colHdr_' . $F][0] ) : '';
    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0]  :'N';
    $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? $tplateOptns['_hideDelete_' . $F][0]  : 'N';
    if( $fieldType == 'N' || $hideField != 'N' ) { return $cell;}

    $searchable = isset( $tplateOptns['_noSearch_' . $F] ) ? $tplateOptns['_noSearch_' . $F][0] : '0';
    $noSortable = isset( $tplateOptns['_noSortable_' . $F] ) ? $tplateOptns['_noSortable_' . $F][0] : '0';

    $noSearch = '';
    $noSort = '';
    if( $searchable == '1' ) { $noSearch =  ' data-searchable="false"'; }
    if( $noSortable == '1' ) { $noSort =  ' data-orderable="false"'; }

    //Change below section when Sortable option is added.
    $dataAttr = $noSearch . $noSort;

    if( $hasFooter ) {
        $cell['footer'] = abcfsls_cnt_tbl_parts_hdr_cell_bldr( $colHdr, 'td', $noSearch );
    }

    $cell['hdr'] = abcfsls_cnt_tbl_parts_hdr_cell_bldr( $colHdr, 'th', $dataAttr );
    return $cell;
}

function abcfsls_cnt_tbl_parts_hdr_cell_bldr( $colHdr, $tag, $data ){
    return abcfl_html_tag( $tag, '', '', '', $data ) . $colHdr . '</' . $tag . '>';
}
//== Header END =======================================================

//== Table rows START =================================================
function abcfsls_tbl_parts_body_rows( $dtOptns ){

    $tplateOptns = $dtOptns['tplateOptns'];
    $fieldOrder = $dtOptns['fieldOrder'];
    $staffTplateID = $dtOptns['staffTplateID'];
    $staffTOptns = $dtOptns['staffTOptns'];
    $sPgBaseUrl = $dtOptns['sPgBaseUrl'];
    $clsPfix = $dtOptns['clsPfix'];

    $staffIDs = abcfsls_db_staff_tplate_member_ids( $staffTplateID );

    $i = 1;
    $bodyRows = '';
    if ( $staffIDs ) {
        foreach ( $staffIDs as $staffID ) {
            $bodyRows .= abcfsls_tbl_parts_body_row( $tplateOptns, $fieldOrder, $staffTOptns, $staffID, $sPgBaseUrl, $clsPfix);
            $i++;
        }
    }

    return '<tbody id="slsTBody">' . $bodyRows . '</tbody>';
}

function abcfsls_tbl_parts_body_row( $tplateOptns, $fieldOrder, $staffTOptns, $staffID, $sPgBaseUrl, $clsPfix ){

    $staffMOptns = get_post_custom( $staffID );
    //$hideSMember = isset( $staffMOptns['_hideSMember'] ) ? esc_attr( $staffMOptns['_hideSMember'][0] ) : '0';
    //if($hideSMember == 1) { return '';}

    $cells = '';

    //Add empty cell to hold responsive icon
    $tblResponsive = isset( $tplateOptns['_tblResponsive'] ) ? $tplateOptns['_tblResponsive'][0] : '0';
    //abcfl_html_tag( $element, $id, $cls='', $style='', $microdata='' )
    if( $tblResponsive == '1' ) {
        $cells = abcfl_html_tag( 'td', '', 'control', 'display: none;' , 'tabindex="0"' ) . abcfl_html_tag_end( 'td' );
    }

    foreach ( $fieldOrder as $F ) {
        $cells .= abcfsls_tbl_parts_body_cell( $tplateOptns, $staffTOptns, $staffMOptns, $F, $sPgBaseUrl, $staffID, $clsPfix );
    }

    //Return table row
    return abcfl_html_tag( 'tr', '', '' ) . $cells . '</tr>';
}

//Table CELL. Renders single table cell, container + content.
function abcfsls_tbl_parts_body_cell( $tplateOptns, $staffTOptns, $staffMOptns, $F, $sPgBaseUrl, $staffID, $clsPfix ){

//echo"<pre>", print_r($staffMOptns['_showField_' . $F]), "</pre>";
//echo"<pre>", print_r($staffTOptns), "</pre>";

    //Search and Staff field typs. Quit if Search field is not used or hidden.
    $out = abcfsls_tbl_parts_field_properties( $tplateOptns, $F, $staffTOptns );

    $fieldType = $out['fieldType'];
    $staffF = $out['staffF'];
    $staffFieldType = $out['staffFieldType'];
    $baseCls = '';

    $types = trim( $fieldType . $staffF . $staffFieldType );
    if ( empty ( $types ) ) { return ''; }
    //---------------------------------------------------

    $tagCls = isset( $tplateOptns['_cellCls_' . $F] ) ? esc_attr( $tplateOptns['_cellCls_' . $F][0] ) : '';
    $tagStyle = isset( $tplateOptns['_cellStyle_' . $F] ) ? esc_attr( $tplateOptns['_cellStyle_' . $F][0] ) : '';
    $cls = abcfsls_util_cls_bldr( $clsPfix, $baseCls, $tagCls );

    //$cellCnt['SHOW'] = '';
    //$cellCnt['SORT'] = '';
    //$cellCnt['SEARCH'] = '';
    //$cellCnt['SEARCH_F'] = $F;
    //Cell data
    $cellCnt = abcfsls_cnt_staff_field( $staffFieldType, $fieldType, $tplateOptns, $F, $staffMOptns, $staffF, $staffTOptns );

    //-- SINGLE PAGE. Modify $cellCnt to create link to a single page ---
    $linkToSingle = isset( $tplateOptns['_linkToSingle_' . $F] ) ? esc_attr( $tplateOptns['_linkToSingle_' . $F][0] ) : '0';
    $cellCnt = abcfsls_util_spg_cell_cnt( $staffID, $linkToSingle, $cellCnt, $staffMOptns, $sPgBaseUrl, $fieldType, $staffTOptns );


    //-------------------------------------
    $dataSort = '';
    $dataSearch = '';
    $txt = '';

    if( !abcfl_html_isblank($cellCnt['SHOW'] ) ){
        //Wrap text in div.
        $txt = abcfl_html_tag_with_content( $cellCnt['SHOW'], 'div', '', $cls, $tagStyle );
        if(!empty($cellCnt['SORT'])){ $dataSort = ' data-sort= "' . esc_attr($cellCnt['SORT']) . '"'; }
        //if(!empty($cellCnt['SEARCH'])){  $dataSearch = ' data-search= "' . esc_attr($cellCnt['SEARCH']) . '"';  }
        $dataSearch = ' data-search= "' . esc_attr($cellCnt['SEARCH']) . '"';
    }

    return abcfl_html_tag( 'td', '', '', '', $dataSort . $dataSearch ) . $txt . abcfl_html_tag_end( 'td');
}
//== Table row END =======================================================

//Table DIV wrapper. Nedded only when top margin or container width is used.
function abcfsls_tbl_parts_wrap( $tplateOptns, $clsPfix ){

    $tblCntrW = isset( $tplateOptns['_tblCntrW'] ) ? esc_attr( $tplateOptns['_tblCntrW'][0] ) : '';
    $tblCntrTM = isset( $tplateOptns['_tblCntrTM'] ) ? esc_attr( $tplateOptns['_tblCntrTM'][0] ) : '';

    if(empty($tblCntrW) && empty($tblCntrTM)){
        $div['cntrS'] = '';
        $div['cntrE'] = '';
        return $div;
    }

    $tblCntrCls = '';
    $tblCntrStyle = '';
    $cntrStyle = abcfl_css_w_responsive($tblCntrW, $tblCntrW) . abcfl_css_mt($tblCntrTM) . $tblCntrStyle;

    $centerCls = '';
    if(!empty($tblCntrW)) { $centerCls = ' ' . $clsPfix . 'MLRAuto'; }
    $tblCntrCustCls = $tblCntrCls . $centerCls;

    $baseCls = '';
    $divID = '';
    $tblCntr = abcfsls_tbl_parts_generic_div( $clsPfix, $baseCls, $tblCntrCustCls, $cntrStyle, $divID );

    return $tblCntr;
}

//========================================
function abcfsls_tbl_parts_generic_div( $clsPfix, $baseCls, $custCls, $custStyle, $divID ){
    $cntrCls = abcfsls_util_cls_bldr( $clsPfix, $baseCls, $custCls );
    $div['cntrS'] = abcfl_html_tag( 'div', $divID, $cntrCls, $custStyle );
    $div['cntrE'] = abcfl_html_tag_end( 'div');
    return $div;
}

function abcfsls_tbl_parts_field_properties( $tplateOptns, $F, $staffTOptns ){

    //$staffF: [0] => F2, [0] => F6, [0] => _fbook, [0] => _social1
    $out['fieldType'] = '';
    $out['staffF'] = '';
    $out['staffFieldType'] = '';

    //Search field type. Quit if field is not used or hidden.
    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0]  :'N';
    $hideField = isset( $tplateOptns['_hideDelete_' . $F] ) ? $tplateOptns['_hideDelete_' . $F][0]  : 'N';
    if( $fieldType == 'N' || $hideField != 'N' ) { return $out; }

    $out['fieldType'] = $fieldType;
    //-------------------------------------

    $staffF = isset( $tplateOptns['_staffF_' . $F] ) ?  $tplateOptns['_staffF_' . $F][0] : '';
    if( empty( $staffF ) ) { return $out; }
    $out['staffF'] = $staffF;

    //Field type selected in Staff template.
    $staffFieldType = '';

    //$staffTOptns: [_fieldType_F1] => MP; [_social1] => Website
    if( substr( $staffF, 0, 1 ) == 'F') {
        $staffFieldType = isset( $staffTOptns['_fieldType_' . $staffF] ) ? $staffTOptns['_fieldType_' . $staffF][0]  :'N';
    }

    if ( $staffFieldType == '' ) {
        switch ( $staffF ){
            case '_social1':
            case '_social2':
            case '_social3':
            case '_fbook':
            case '_liked':
            case '_email':
            case '_twit':
            case '_googlePlus':
                $staffFieldType = 'SL';
                break;
           default:
                break;
        }
    }

    $out['staffFieldType'] = $staffFieldType;
    return $out;
}

function abcfsls_tbl_parts_tbl_id( $txtDir ){

    $txtLR = 'ltr';
    if($txtDir == 'R') { $txtLR = 'rtl'; }

    $out['txtLR'] = $txtLR;
    $out['tblID'] = 'slsTbl_' . $txtLR;

    return $out;
}

function abcfsls_tbl_parts_tbl_params( $tblID, $tplateOptns, $txtLR, $clsPfix, $pversion, $headerOnly ){

    $staffTplateID = isset( $tplateOptns['_staffTplateID'] ) ? $tplateOptns['_staffTplateID'][0]  : '0';
    $staffTplt = get_post_custom( $staffTplateID );

    $parTbl['tplateOptns'] = $tplateOptns;
    $parTbl['fieldOrder'] = abcfsls_util_field_order( $tplateOptns ); //fieldOrder: Array. Order of Search fields. F1, F2, F3...
    $parTbl['staffTplateID'] = $staffTplateID;
    $parTbl['staffTOptns'] = $staffTplt;
    $parTbl['tblID'] = $tblID;
    $parTbl['txtLR'] = $txtLR;
    $parTbl['clsPfix'] = $clsPfix;
    $parTbl['pversion'] = $pversion;
    $parTbl['headerOnly'] = $headerOnly;

    return $parTbl;
}
