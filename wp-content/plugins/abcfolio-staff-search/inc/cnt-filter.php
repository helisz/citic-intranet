<?php

//== FILTERS HTML START ======================================
function abcfsls_cnt_filter_html( $menu, $filters, $pfix ){

    $menuID = $menu['menuID'];
    $filterOptns = get_post_custom( $menu['menuID'] );

    $obj = ABCFSLS_Main();
    $ver = $obj->pluginVersion;
    $slsPfix = $obj->prefix;

//echo"<pre>", print_r($filterOptns), "</pre>";

    $filterType1 = isset( $filterOptns['_mFilterType1'] ) ? $filterOptns['_mFilterType1'][0]  : '';
    $filterType2 = isset( $filterOptns['_mFilterType2'] ) ? $filterOptns['_mFilterType2'][0]  : '';
    $filterType3 = isset( $filterOptns['_mFilterType3'] ) ? $filterOptns['_mFilterType3'][0]  : '';
    $filterType4 = isset( $filterOptns['_mFilterType4'] ) ? $filterOptns['_mFilterType4'][0]  : '';
    $filterType5 = isset( $filterOptns['_mFilterType5'] ) ? $filterOptns['_mFilterType5'][0]  : '';
    $filterType6 = isset( $filterOptns['_mFilterType6'] ) ? $filterOptns['_mFilterType6'][0]  : '';

    $mfCntrJustify = isset( $filterOptns['_mfCntrJustify'] ) ? esc_attr( $filterOptns['_mfCntrJustify'][0] ) : 'E';
    $mfCntrMT = isset( $filterOptns['_mfCntrMT'] ) ? esc_attr( $filterOptns['_mfCntrMT'][0] ) : '';
    $mfCntrMB = isset( $filterOptns['_mfCntrMB'] ) ? esc_attr( $filterOptns['_mfCntrMB'][0] ) : '';

    $mfCntrCustCls = isset( $filterOptns['_mfCntrCustCls'] ) ? esc_attr( $filterOptns['_mfCntrCustCls'][0] ) : '';
    $mfCntrCustStyle = isset( $filterOptns['_mfCntrCusStyle'] ) ? esc_attr( $filterOptns['_mfCntrCusStyle'][0] ) : '';
    $mfFrmGrpCustCls = isset( $filterOptns['_mfFrmGroupCustCls'] ) ? esc_attr( $filterOptns['_mfFrmGroupCustCls'][0] ) : '';
    $mfFrmGrpStyle = isset( $filterOptns['_mfFrmGroupStyle'] ) ? esc_attr( $filterOptns['_mfCntrCusStyle'][0] ) : '';

    $mfCboLbl1 = abcfsls_cnt_filter_field_data( $filterOptns, $filters, '1' );
    $mfCboLbl2 = abcfsls_cnt_filter_field_data( $filterOptns, $filters, '2' );
    $mfCboLbl3 = abcfsls_cnt_filter_field_data( $filterOptns, $filters, '3' );
    $mfCboLbl4 = abcfsls_cnt_filter_field_data( $filterOptns, $filters, '4' );
    $mfCboLbl5 = abcfsls_cnt_filter_field_data( $filterOptns, $filters, '5' );
    $mfCboLbl6 = abcfsls_cnt_filter_field_data( $filterOptns, $filters, '6' );

    $mfSBtnTxt = isset( $filterOptns['_mfSBtnTxt'] ) ? esc_attr( $filterOptns['_mfSBtnTxt'][0] ) : 'Search';
    $mfRBtnTxt = isset( $filterOptns['_mfRBtnTxt'] ) ? esc_attr( $filterOptns['_mfRBtnTxt'][0] ) : '';

    //Control Size: Default, SM, MD, LG
    $mfCboSize = isset( $filterOptns['_mfCboSize'] ) ? esc_attr( $filterOptns['_mfCboSize'][0] ) : '';
    $mfSBtnColor = isset( $filterOptns['_mfSBtnColor'] ) ? $filterOptns['_mfSBtnColor'][0] : '';
    $mfRBtnColor = isset( $filterOptns['_mfRBtnColor'] ) ? $filterOptns['_mfRBtnColor'][0] : '';
    //---------------------------------------------------
    $inputOptns['menuID'] = $menuID;
    $inputOptns['controlID'] = 'staffFilter';
    $inputOptns['lblCls'] = '';
    $inputOptns['selectCls'] = $pfix . 'FrmControl_Default';
    $inputOptns['inputTxtCls'] = $pfix . 'FrmControl_Default';
    $inputOptns['selectClsFG'] = '';
    $inputOptns['clsFrmGroup'] = $pfix . 'FrmGroup '. $pfix . 'FG_Select ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
    $inputOptns['clsFrmGroupTxt'] = $pfix . 'FrmGroup '. $pfix . 'FG_Input ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;

    $inputOptns['clsBtnFrmGroup'] = $pfix . 'FrmGroup ' . $pfix . 'FG_Btn ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
    $inputOptns['clsBtnGroup'] = $pfix . 'BtnGroup ' . $pfix . 'BG_Btn ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
    $inputOptns['clsSBtn'] = '';
    $inputOptns['clsRBtn'] = '';

    //Control Size: Default(empty), SM, MD, LG
    if( !empty( $mfCboSize ) ){
        $inputOptns['lblCls'] = $pfix . 'Lbl ';
        $inputOptns['selectCls'] = $pfix . 'FrmControl';
        $inputOptns['inputTxtCls'] = $pfix . 'FrmControl';

$inputOptns['clsFrmGroup'] = $pfix . 'FrmGroup ' . $pfix . 'Select_' .  $mfCboSize . ' ' . $pfix . 'Lbl_' .  $mfCboSize . ' ' . $pfix . 'FG_Select ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
        $inputOptns['clsFrmGroupTxt'] = $pfix . 'FrmGroup ' . $pfix . 'Select_' .  $mfCboSize . ' ' . $pfix . 'FG_Input ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
        $inputOptns['clsBtnFrmGroup'] = $pfix . 'FrmGroup' . ' ' . $pfix . 'Btn_' .  $mfCboSize . ' ' . $pfix . 'FG_Btn ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
        $inputOptns['clsBtnGroup'] = $pfix . 'BtnGroup' . ' ' . $pfix . 'Btn_' .  $mfCboSize . ' ' . $pfix . 'BG_Btn ' . $mfFrmGrpCustCls . ' ' . $mfFrmGrpStyle;
        $inputOptns['clsSBtn'] = $pfix . 'Btn ' . $pfix . 'Btn_'. $mfSBtnColor;
        $inputOptns['clsRBtn'] = $pfix . 'Btn ' . $pfix . 'Btn_'. $mfRBtnColor;
    }

    $inputOptns['clsFrmGroup'] = trim( $inputOptns['clsFrmGroup'] );
    $inputOptns['clsFrmGroupTxt'] = trim( $inputOptns['clsFrmGroupTxt'] );
    $inputOptns['clsBtnFrmGroup'] = trim( $inputOptns['clsBtnFrmGroup'] );
    $inputOptns['clsBtnGroup'] = trim( $inputOptns['clsBtnGroup'] );

    //-------------------------------------------------
    $parFrm['formID'] = 'staffFilter';

    // ACTION
    //$parFrm['action'] = 'action="http://localhost:8080/blog/sl-multi-filtersx/#multifilter-header"';
    $parFrm['action'] = abcfsls_cnt_filter_frm_action( isset( $filterOptns['_mfFrmAction'] ) ? esc_attr( $filterOptns['_mfFrmAction'][0] ) : '' );
    $parFrm['searchBtnName'] = 'mfSearchBtn';
    $parFrm['resetBtnName'] = 'mfResetBtn';
    $parFrm['justify'] = $mfCntrJustify;
    $parFrm['searchBtnTxt'] = $mfSBtnTxt;
    $parFrm['resetBtnTxt'] = $mfRBtnTxt;

    $parFrm['HTML1'] = abcfsls_cnt_filter_input_HTML( $filterType1, $filterOptns, $inputOptns, $mfCboLbl1, '1' );
    $parFrm['HTML2'] = abcfsls_cnt_filter_input_HTML( $filterType2, $filterOptns, $inputOptns, $mfCboLbl2, '2' );
    $parFrm['HTML3'] = abcfsls_cnt_filter_input_HTML( $filterType3, $filterOptns, $inputOptns, $mfCboLbl3, '3' );
    $parFrm['HTML4'] = abcfsls_cnt_filter_input_HTML( $filterType4, $filterOptns, $inputOptns, $mfCboLbl4, '4' );
    $parFrm['HTML5'] = abcfsls_cnt_filter_input_HTML( $filterType5, $filterOptns, $inputOptns, $mfCboLbl5, '5' );
    $parFrm['HTML6'] = abcfsls_cnt_filter_input_HTML( $filterType6, $filterOptns, $inputOptns, $mfCboLbl6, '6' );

    $parFrm['hideDelete1'] = isset( $filterOptns['_mfHideDelete1'] ) ?  $filterOptns['_mfHideDelete1'][0] : 'N';
    $parFrm['hideDelete2'] = isset( $filterOptns['_mfHideDelete2'] ) ?  $filterOptns['_mfHideDelete2'][0] : 'N';
    $parFrm['hideDelete3'] = isset( $filterOptns['_mfHideDelete3'] ) ?  $filterOptns['_mfHideDelete3'][0] : 'N';
    $parFrm['hideDelete4'] = isset( $filterOptns['_mfHideDelete4'] ) ?  $filterOptns['_mfHideDelete4'][0] : 'N';
    $parFrm['hideDelete5'] = isset( $filterOptns['_mfHideDelete5'] ) ?  $filterOptns['_mfHideDelete5'][0] : 'N';
    $parFrm['hideDelete6'] = isset( $filterOptns['_mfHideDelete6'] ) ?  $filterOptns['_mfHideDelete6'][0] : 'N';

    $parFrm['clsFrm'] = $pfix . 'FrmInline ' . $pfix . 'Justify_' . $mfCntrJustify;
    $parFrm['clsBtnFrmGroup'] = $inputOptns['clsBtnFrmGroup'];
    $parFrm['clsBtnGroup'] = $inputOptns['clsBtnGroup'];
    $parFrm['clsSBtn'] =  $inputOptns['clsSBtn'];
    $parFrm['clsRBtn'] =  $inputOptns['clsRBtn'];

    $parFrm['mfOrder'] = abcfsls_cnt_filter_field_order( $filterOptns );

    $hlp = abcfsls_cnt_filter_hlp( $filterOptns, $pfix );
    $filterForm = abcfsls_cnt_filter_form( $parFrm );

    //----------------------------------------------
    $menu['filter1Type'] = $filterType1;
    $menu['filter2Type'] = $filterType2;
    $menu['filter3Type'] = $filterType3;
    $menu['filter4Type'] = $filterType4;
    $menu['filter5Type'] = $filterType5;
    $menu['filter6Type'] = $filterType6;

    $menu['filter1Field'] = abcfsls_cnt_filter_search_field( $filterOptns, '1' );
    $menu['filter2Field'] = abcfsls_cnt_filter_search_field( $filterOptns, '2' );
    $menu['filter3Field'] = abcfsls_cnt_filter_search_field( $filterOptns, '3' );
    $menu['filter4Field'] = abcfsls_cnt_filter_search_field( $filterOptns, '4' );
    $menu['filter5Field'] = abcfsls_cnt_filter_search_field( $filterOptns, '5' );
    $menu['filter6Field'] = abcfsls_cnt_filter_search_field( $filterOptns, '6' );

    //-----------------------------------------------------
    $minLen[1] = abcfsls_cnt_filter_min_len( $filterOptns, '1' );
    $minLen[2] = abcfsls_cnt_filter_min_len( $filterOptns, '2' );
    $minLen[3] = abcfsls_cnt_filter_min_len( $filterOptns, '3' );
    $minLen[4] = abcfsls_cnt_filter_min_len( $filterOptns, '4' );
    $minLen[5] = abcfsls_cnt_filter_min_len( $filterOptns, '5' );
    $minLen[6] = abcfsls_cnt_filter_min_len( $filterOptns, '6' );

    $menu['minLen'] = $minLen;

    $menu['noDataMsg'] = isset( $filterOptns['_mfNoDataMsg'] ) ? esc_attr( $filterOptns['_mfNoDataMsg'][0] ) : '';

    //Multiselect form.
    $menu['menuItemsHTML'] = abcfsls_cnt_filter_wrap( $filterForm, $hlp, $mfCntrMT, $mfCntrMB, $mfCntrCustCls, $mfCntrCustStyle, $pfix, $ver, $slsPfix, $menuID );
    return $menu;
}

function abcfsls_cnt_filter_min_len( $filterOptns, $filterNo ){
    return isset( $filterOptns['_minLen' . $filterNo] ) ?  $filterOptns['_minLen' . $filterNo][0] : '3';
}

function abcfsls_cnt_filter_frm_action( $mfFrmAction ){
    $action = '';
    if( !empty( $mfFrmAction ) ) { $action = 'action="' . $mfFrmAction . '"'; }
    return $action;
}

function abcfsls_cnt_filter_search_field( $filterOptns, $filterNo ){

    $filterType = isset( $filterOptns['_mFilterType' . $filterNo] ) ? $filterOptns['_mFilterType' . $filterNo][0]  : '';
    if(empty( $filterType ) ) { return ''; }

    if( $filterType == 'TXTM' ) {
        return abcfsls_cnt_filter_search_fields( $filterOptns, $filterNo );
    }

    //print_r('*'. $filterType . '-');

    $slFieldNo = isset( $filterOptns['_slFieldNo' . $filterNo] ) ?  $filterOptns['_slFieldNo' . $filterNo][0] : '';
    $slFieldType = isset( $filterOptns['_slFieldType' . $filterNo] ) ? $filterOptns['_slFieldType' . $filterNo][0] : '';
    if( empty( $slFieldType ) ) { $slFieldNo = ''; }

    return $slFieldType . $slFieldNo;
}

function abcfsls_cnt_filter_search_fields( $filterOptns, $filterNo ){

    $searchFields = array();
    for ($x = 1; $x <= 6; $x++) {
        $searchFields[$x] = abcfsls_cnt_filter_search_field_m( $filterOptns, $filterNo, $x );
    }
    return $searchFields;
}

function abcfsls_cnt_filter_search_field_m( $filterOptns, $filterNo, $fieldNo ){

    $slFieldNo = isset( $filterOptns['_slMField' . $fieldNo . 'No' . $filterNo] ) ?  $filterOptns['_slMField' . $fieldNo . 'No' . $filterNo][0] : '';
    $slFieldType = isset( $filterOptns['_slMField' . $fieldNo . 'Type' . $filterNo] ) ? $filterOptns['_slMField' . $fieldNo . 'Type' . $filterNo][0] : '';
    if( empty( $slFieldType ) ) { return ''; }

    return $slFieldType . $slFieldNo;
}
//------------------------------------------------

function abcfsls_cnt_filter_field_data( $filterOptns, $filters, $filterNo ){

    $mfCboLbl['filterLbl'] = isset( $filterOptns['_mfLbl' . $filterNo] ) ? esc_attr( $filterOptns['_mfLbl' . $filterNo][0] ) : '';
    $mfCboLbl['selected'] = $filters[$filterNo];

    return $mfCboLbl;
}

//== CONTAINERS =========================================
//Main wrap div. Contains all items.
function abcfsls_cnt_filter_wrap( $filterForm, $hlp, $mfCntrMT, $mfCntrMB, $customCls, $customStyle, $pfix, $ver, $slsPfix, $menuID ){

    $style = abcfl_css_mtrbl( $mfCntrMT, '', $mfCntrMB, '' );
    $style = trim( $style . ' ' . $customStyle );

    //$cls = trim( $pfix . 'MFilterCntr' . ' ' . $customCls . ' slsMobileFrmCntr_MLR20');
    //$cls = trim ( $pfix . 'MFilterCntr_' . $menuID . ' ' . $pfix . 'MFilterCntr' . ' ' . $customCls . ' ' . $slsPfix . '_v_' . $ver);
    //$cls = trim ( $pfix . 'MFilterCntr' . ' ' . $customCls . ' ' . $slsPfix . '_v_' . $ver);
    $cls = trim ( $pfix . 'MFilterCntr '  . $slsPfix . '_v_' . $ver . ' ' . $customCls);
    $id = ( $pfix . 'MFilterCntr_' . $menuID );

    $div = abcfsl_cnt_generic_div_simple( $cls, $style, $id );
    return $div['cntrS'] .  $filterForm . $hlp . $div['cntrE'];
}

//Form. Contains all form items.
function abcfsls_cnt_filter_form( $parFrm ){

    $controls = abcfsls_cnt_filter_controls( $parFrm );
    if( empty( $controls ) ) { return '';}

    //abcfl_html_form( $id, $name, $cls='', $style='', $microdata='' )
    $out = abcfl_html_form( $parFrm['formID'], $parFrm['formID'], $parFrm['clsFrm'], '', $parFrm['action'] );
    $out .=  $controls;
    $out .= abcfsls_cnt_filter_btns( $parFrm );
    $out .= wp_nonce_field( 'mFilterNonce', 'mFilterNonceField' );
    $out .= abcfl_html_tag_end( 'form' );
    return $out;
}

function abcfsls_cnt_filter_controls( $parFrm ){

    $mfOrder = $parFrm['mfOrder'];
    $out = '';

    foreach( $mfOrder as $key => $value ) {
        if( $parFrm['hideDelete' . $value]  == 'N' ) {
            $out .= $parFrm['HTML' . $value];
        }
    }
    return $out;
}

//Help text.
function abcfsls_cnt_filter_hlp( $filterOptns, $pfix ){

    $mfHelpTxt = isset( $filterOptns['_mfHelpTxt'] ) ? esc_attr( $filterOptns['_mfHelpTxt'][0] ) : '';
    $mfHelpTxtF = isset( $filterOptns['_mfHelpTxtF'] ) ? $filterOptns['_mfHelpTxtF'][0] : '';
    $mfHelpTxtMT = isset( $filterOptns['_mfHelpTxtMT'] ) ? $filterOptns['_mfHelpTxtMT'][0] : '';
    $mfCntrJustify = isset( $filterOptns['_mfCntrJustify'] ) ? esc_attr( $filterOptns['_mfCntrJustify'][0] ) : 'E';

    $txtAlign = 'TxtLeft';
    switch ( $mfCntrJustify ){
        case 'C':
            $txtAlign = 'TxtCenter';
            break;
        case 'E':
            $txtAlign = 'TxtRight';
            break;
       default:
            break;
    }

    if( empty( $mfHelpTxt ) ) { return ''; }

    $style = abcfl_css_mt( $mfHelpTxtMT );
    $clsFItemFont = abcfsls_util_class_name_bldr( $mfHelpTxtF, 'FS', $pfix );
    $clsTxtAlign = $pfix . $txtAlign;
    $cls = trim( $clsFItemFont . ' ' . $clsTxtAlign );

    return abcfl_html_tag_with_content( $mfHelpTxt, 'div', '', $cls, $style );

}
//=================================================

//== CONTAINER ELEMENTS =========================================
function abcfsls_cnt_filter_input_HTML( $filterType, $filterOptns, $inputOptns, $cbo, $no ){

    $filterHTML = '';
    $cls = $inputOptns['clsFrmGroup'];
    switch ( $filterType ){
        case 'C':
            $filterHTML = abcfsl_cnt_filter_cbo_cat( $filterOptns, $inputOptns, $cbo, $no );
            break;
        case 'AZ':
            $filterHTML = abcfsl_cnt_filter_cbo_az( $filterOptns, $inputOptns, $cbo, $no );
            break;
        case 'TXT':
            $filterHTML = abcfsls_cnt_filter_txt_HTML( $inputOptns, $cbo, $no );
            $cls = $inputOptns['clsFrmGroupTxt'];
            break;
        case 'TXTM':
            $filterHTML = abcfsls_cnt_filter_txt_HTML( $inputOptns, $cbo, $no );
            $cls = $inputOptns['clsFrmGroupTxt'];
            break;
        case 'DROP':
            $filterHTML = abcfsls_cnt_filter_drop_HTML( $filterOptns, $inputOptns, $cbo, $no );
            break;
       default:
            break;
    }

    return abcfsls_cnt_filter_frm_group( $filterHTML, $cls );
}

//== BUTTONS ===========================================
function abcfsls_cnt_filter_btns( $parFrm ){

    $sBtnHTML = abcfsls_cnt_filter_search_btn( $parFrm );
    $rBtnHTML = abcfsls_cnt_filter_reset_btn( $parFrm );

    return abcfsls_cnt_filter_frm_group( $sBtnHTML . $rBtnHTML, abcfsls_cnt_filter_btn_cntr_cls( $parFrm ) );
}

function abcfsls_cnt_filter_search_btn( $parFrm ){

    $par['tag'] = 'button';
    $par['type'] = 'submit';
    $par['txt'] = $parFrm['searchBtnTxt'];
    $par['name'] = $parFrm['searchBtnName'];
    $par['cls'] = $parFrm['clsSBtn'];

    return abcfl_html_input_btn( $par );

}

function abcfsls_cnt_filter_reset_btn( $parFrm ){

    if( empty( $parFrm['resetBtnTxt'] ) ) { return ''; }

    $par['tag'] = 'button';
    $par['type'] = 'submit';
    $par['txt'] = $parFrm['resetBtnTxt'];
    $par['name'] = $parFrm['resetBtnName'];
    $par['cls'] = $parFrm['clsRBtn'];

    return abcfl_html_input_btn( $par );
}

function abcfsls_cnt_filter_btn_cntr_cls( $parFrm ){

    if( empty( $parFrm['resetBtnTxt'] ) ) { return $parFrm['clsBtnFrmGroup']; }
    return $parFrm['clsBtnGroup'];

}

//<div class="abcfslFrmGroup abcfslFG_Btn">
//<button type="submit" name="mfSearchBtn">SE</button>
//</div>

//<div class="abcfslBtnGroup abcfslBG_Btn">
//<button type="submit" name="mfSearchBtn">SE</button>
//<button type="submit" name="mfResetBtn">RE</button>
//</div>


//===============================================
//-- TXT INPUT HTML -----------------------------------------------
function abcfsls_cnt_filter_txt_HTML( $inputOptns, $cbo, $filterNo ){

    $placeholder = $cbo['filterLbl'];
    $id = $inputOptns['controlID'] . $filterNo;
    //$inputValue = stripslashes_deep( $cbo['selected'] );

    $inputValue = $cbo['selected'] ;

    return abcfl_html_frm_txt_input(
            $id,
            '',
            $inputValue,
            $placeholder,
            $inputOptns['inputTxtCls'],
            '' );
}

function abcfsls_cnt_filter_txt_optns_items( $catSlugs, $catTxtAll, $filterNo ){

    if ( empty($catSlugs) ){ return ''; }

    $cats = array();
    $cboItems = array();
    //----------------------------------
    $terms = get_terms( array(
        'taxonomy' => 'tax_staff_member_cat',
        'hide_empty' => false
    ) );

    if ( empty( $terms ) ){ return $cboItems; }
    if ( empty( $catSlugs ) ){ return $catSlugs; }

    //Create array: slug - category name
    foreach ( $terms as $slugCat ) {
        $cats[$slugCat->slug] = $slugCat->name;
    }
    //----------------------------------
    $filterSlugs = unserialize( $catSlugs );

    //All
    if( !empty( $catTxtAll ) ) {  $cboItems[''] = $catTxtAll; }

    foreach ( $filterSlugs as $key => $slug ) {

        $filterSlug = $slug['catSlug' . $filterNo];
        //Is there a category with a matching slug?
        if( isset( $cats[$filterSlug] ) ){
            $cboItems[$filterSlug] = $cats[$filterSlug];
        }
    }
    return $cboItems;
}

//-- CUSTOM DROPDOWN START ------------------------------------------
function abcfsls_cnt_filter_drop_HTML( $filterOptns, $inputOptns, $cbo, $filterNo ){

    $dropTxtAll = isset( $filterOptns['_dropTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_dropTxtAll' . $filterNo][0] ) : '';

    $items = abcfsls_cnt_filter_drop_items( $inputOptns['menuID'], $dropTxtAll, $filterNo );

    //$inputOptns['controlID'] . '2',
    return abcfl_html_cbo(
        $inputOptns['controlID'] . $filterNo,
        '',
        $items,
        $cbo['selected'],
        $cbo['filterLbl'],
        $inputOptns['selectCls'],
        $inputOptns['lblCls']
    );
}

function abcfsls_cnt_filter_drop_items( $tplateID, $dropTxtAll, $filterNo ){

    $items = get_post_meta( $tplateID, '_dropItems' . $filterNo, true );

    $cboItems = array();
    //All
    if( !empty( $dropTxtAll ) ) {  $cboItems[''] = $dropTxtAll; }
    if( empty( $items ) ) { return $cboItems; }

    foreach ( $items as $key => $value ) {
        $cboItems[strtolower($value)] = $value;
    }

    return $cboItems;
}
//-- CUSTOM DROPDOWN END ------------------------------------------

//====================================================
//Generic group container
function abcfsls_cnt_filter_frm_group( $content, $cls ){

    //<div class="btn-group" role="group" aria-label="Basic example">

    if( !empty($content) ){
        return abcfl_html_tag_with_content( $content, 'div', '', $cls );
    }
    return '';
}

//Generic button group container
function abcfsls_cnt_filter_btn_group( $content, $cls ){

    if( !empty($content) ){
        return abcfl_html_tag_with_content( $content, 'div', '', $cls );
    }
    return '';
}

function abcfsls_cnt_filter_field_order( $filterOptns ){

    $mfOrder = isset( $filterOptns['_mfOrder'] ) ? $filterOptns['_mfOrder'][0] : '';

    if(empty($mfOrder)){
        for ( $i = 1; $i <= 6; $i++ ) { $mfOrder[$i] = $i; }
    }
    else{
        $mfOrder = unserialize( $mfOrder );
    }

    return $mfOrder;
}
