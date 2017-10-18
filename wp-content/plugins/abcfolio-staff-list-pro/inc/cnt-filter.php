<?php
function abcfsl_cnt_filter_html( $menu, $filters, $scodeArgs ){

    $filterOptns = get_post_custom( $menu['menuID'] );

    $pfix =  $scodeArgs['prefix'];
    $ver = $scodeArgs['pversion'];

//echo"<pre>", print_r($filterOptns), "</pre>";

    $filterType1 = isset( $filterOptns['_mFilterType1'] ) ? $filterOptns['_mFilterType1'][0]  : '';
    $filterType2 = isset( $filterOptns['_mFilterType2'] ) ? $filterOptns['_mFilterType2'][0]  : '';

    $mfCntrJustify = isset( $filterOptns['_mfCntrJustify'] ) ? esc_attr( $filterOptns['_mfCntrJustify'][0] ) : 'E';
    $mfCntrMT = isset( $filterOptns['_mfCntrMT'] ) ? esc_attr( $filterOptns['_mfCntrMT'][0] ) : '';
    $mfCntrMB = isset( $filterOptns['_mfCntrMB'] ) ? esc_attr( $filterOptns['_mfCntrMB'][0] ) : '';
    $customCls = '';
    $customStyle = '';

    $mfCboLbl1 = abcfsl_cnt_filter_cbo_lbl( $filterOptns, $filters, '1' );
    $mfCboLbl2 = abcfsl_cnt_filter_cbo_lbl( $filterOptns, $filters, '2' );

    $btnTxt = isset( $filterOptns['_mfBtnTxt'] ) ? esc_attr( $filterOptns['_mfBtnTxt'][0] ) : 'Search';
    $btnResetTxt = isset( $filterOptns['_mfBtnRTxt'] ) ? esc_attr( $filterOptns['_mfBtnRTxt'][0] ) : 'Reset1';

    //Control Size: Default, SM, MD, LG
    $mfCboSize = isset( $filterOptns['_mfCboSize'] ) ? esc_attr( $filterOptns['_mfCboSize'][0] ) : '';
    $mfBtnColor = isset( $filterOptns['_mfBtnColor'] ) ? $filterOptns['_mfBtnColor'][0] : '';

    //---------------------------------------------------
    $inputOptns['controlID'] = 'staffFilter';
    $inputOptns['lblCls'] = '';
    $inputOptns['selectCls'] = $pfix . 'FrmControl_Default';
    $inputOptns['inputTxtCls'] = $pfix . 'FrmControl_Default';
    $inputOptns['selectClsFG'] = '';
    $inputOptns['clsFrmGroup'] = $pfix . 'FrmGroup';
    $inputOptns['clsFrmGroupTxt'] = $pfix . 'FrmGroup';
    $inputOptns['clsBtnFrmGroup'] = $pfix . 'FrmGroup';

    $inputOptns['clsBtn'] = $pfix . 'Btn_Default';

    //Control Size: Default(empty), SM, MD, LG
    if( !empty( $mfCboSize ) ){
        $inputOptns['lblCls'] = $pfix . 'Lbl ';
        $inputOptns['selectCls'] = $pfix . 'FrmControl';
        $inputOptns['inputTxtCls'] = $pfix . 'FrmControl';
        $inputOptns['clsFrmGroup'] = $pfix . 'FrmGroup ' . $pfix . 'Select_' .  $mfCboSize . ' ' . $pfix . 'Lbl_' .  $mfCboSize;
        $inputOptns['clsFrmGroupTxt'] = $pfix . 'FrmGroup ' . $pfix . 'Select_' .  $mfCboSize;
        $inputOptns['clsBtnFrmGroup'] = $inputOptns['clsBtnFrmGroup'] . ' ' . $pfix . 'Btn_' .  $mfCboSize;

        $inputOptns['clsBtn'] = $pfix . 'Btn ' . $pfix . 'Btn_'. $mfBtnColor;
    }

    $filter1HTML = abcfsl_cnt_filter_input_HTML( $filterType1, $filterOptns, $inputOptns, $mfCboLbl1, '1' );
    $filter2HTML = abcfsl_cnt_filter_input_HTML( $filterType2, $filterOptns, $inputOptns, $mfCboLbl2, '2' );

    $parFrm['formID'] = 'staffFilter';
    // ACTION
    $parFrm['action'] = abcfsl_cnt_filter_frm_action( isset( $filterOptns['_mfFrmAction'] ) ? esc_attr( $filterOptns['_mfFrmAction'][0] ) : '' );
    $parFrm['searchBtnName'] = 'mfSearchBtn';
    $parFrm['resetBtnName'] = 'mfResetBtn';
    $parFrm['justify'] = $mfCntrJustify;
    $parFrm['btnTxt'] = $btnTxt;
    $parFrm['btnResetTxt'] = $btnResetTxt;
    $parFrm['HTML1'] = $filter1HTML;
    $parFrm['HTML2'] = $filter2HTML;
    $parFrm['hideDelete1'] = isset( $filterOptns['_mfHideDelete' . '1'] ) ?  $filterOptns['_mfHideDelete' . '1'][0] : 'N';
    $parFrm['hideDelete2'] = isset( $filterOptns['_mfHideDelete' . '2'] ) ?  $filterOptns['_mfHideDelete' . '2'][0] : 'N';

    $parFrm['clsFrm'] = $pfix . 'FrmInline ' . $pfix . 'Justify_' . $mfCntrJustify;
    $parFrm['clsBtnFrmGroup'] = $inputOptns['clsBtnFrmGroup'];
    //$parFrm['clsBtnGroup'] = $inputOptns['clsBtnGroup'];
    $parFrm['clsBtn'] =  $inputOptns['clsBtn'];

    $hlp = abcfsl_cnt_filter_hlp( $filterOptns, $pfix );
    $filterForm = abcfsl_cnt_filter_form( $parFrm );

    //----------------------------------------------
    $menu['filter1Type'] = $filterType1;
    $menu['filter2Type'] = $filterType2;
    $menu['filter1Field'] = abcfsl_cnt_filter_search_field( $filterOptns, '1' );
    $menu['filter2Field'] = abcfsl_cnt_filter_search_field( $filterOptns, '2' );

    $menu['noDataMsg'] = isset( $filterOptns['_mfNoDataMsg'] ) ? esc_attr( $filterOptns['_mfNoDataMsg'][0] ) : '';

    //Multiselect form.
    $menu['menuItemsHTML'] = abcfsl_cnt_filter_wrap( $filterForm, $hlp, $mfCntrMT, $mfCntrMB, $customCls, $customStyle, $pfix, $ver, $menu['menuID'] );
    return $menu;
}
//=============================================
// ACTION
function abcfsl_cnt_filter_frm_action( $mfFrmAction ){
    $action = '';
    if( !empty( $mfFrmAction ) ) { $action = 'action="' . $mfFrmAction . '"'; }
    return $action;
}

function abcfsl_cnt_filter_search_field( $filterOptns, $filterNo ){
    $azFieldID = isset( $filterOptns['_azFieldID' . $filterNo] ) ?  $filterOptns['_azFieldID' . $filterNo][0] : '';
    $azFieldType = isset( $filterOptns['_azFieldType' . $filterNo] ) ? $filterOptns['_azFieldType' . $filterNo][0] : '';
    if( empty( $azFieldType ) ) { $azFieldID = ''; }
    return $azFieldType . $azFieldID;
}

function abcfsl_cnt_filter_cbo_lbl( $filterOptns, $filters, $filterNo ){
    $mfCboLbl['filterLbl'] = isset( $filterOptns['_mfCboLbl' . $filterNo] ) ? esc_attr( $filterOptns['_mfCboLbl' . $filterNo][0] ) : '';
    $mfCboLbl['selected'] = $filters[$filterNo];
    return $mfCboLbl;
}

//== CONTAINERS =========================================
//Main wrap div. Contains all items.
function abcfsl_cnt_filter_wrap( $filterForm, $hlp, $mfCntrMT, $mfCntrMB, $customCls, $customStyle, $pfix, $ver, $menuID ){

    $style = abcfl_css_mtrbl( $mfCntrMT, '', $mfCntrMB, '' );
    $style = trim( $style . ' ' . $customStyle );

    //$cls = trim ( $pfix . 'MFilterCntr_' . $menuID . ' ' . $pfix . 'MFilterCntr' . ' ' . $customCls);
    $cls = trim ( $pfix . 'MFilterCntr '  . $pfix . '_v_' . $ver . ' ' . $customCls);
    $id = ( $pfix . 'MFilterCntr_' . $menuID );

    $div = abcfsl_cnt_generic_div_simple( $cls, $style, $id );
    return $div['cntrS'] .  $filterForm . $hlp . $div['cntrE'];
}

//Form. Contains all form items.
function abcfsl_cnt_filter_form( $parFrm ){

    $controls = abcfsl_cnt_filter_controls( $parFrm );
    if( empty( $controls ) ) { return '';}

    // ACTION
    //abcfl_html_form( $id, $name, $cls='', $style='', $microdata='' )
    $out = abcfl_html_form( $parFrm['formID'], $parFrm['formID'], $parFrm['clsFrm'], '', $parFrm['action'] );
    $out .=  $controls;
    $out .= abcfsl_cnt_filter_search_btn( $parFrm );
    $out .= wp_nonce_field( 'mFilterNonce', 'mFilterNonceField' );
    $out .= abcfl_html_tag_end( 'form' );
    return $out;
}

function abcfsl_cnt_filter_controls( $parFrm ){

    $out = $parFrm['HTML1'];
    if( $parFrm['hideDelete2']  == 'N' ) { $out .= $parFrm['HTML2']; }
    return $out;
}

//Help text.
function abcfsl_cnt_filter_hlp( $filterOptns, $pfix ){

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
    //abcfsl_util_class_name_bldr( $optnValue, $clsBaseName, $pfix, $default='' )
    $clsFItemFont = abcfsl_util_class_name_bldr( $mfHelpTxtF, 'FS', $pfix );
    $clsTxtAlign = $pfix . $txtAlign;
    $cls = trim( $clsFItemFont . ' ' . $clsTxtAlign );

    return abcfl_html_tag_with_content( $mfHelpTxt, 'div', '', $cls, $style );

}
//=================================================

//== CONTAINER ELEMENTS =========================================
function abcfsl_cnt_filter_input_HTML( $filterType, $filterOptns, $inputOptns, $cbo, $no ){

    $filterHTML = '';
    $cls = $inputOptns['clsFrmGroup'];
    switch ( $filterType ){
        case 'C':
            $filterHTML = abcfsl_cnt_filter_cbo_cat( $filterOptns, $inputOptns, $cbo, $no );
            break;
        case 'AZ':
            $filterHTML = abcfsl_cnt_filter_cbo_az( $filterOptns, $inputOptns, $cbo, $no );
            break;
       default:
            break;
    }

    return abcfsl_cnt_filter_frm_group( $filterHTML, $cls );
}

function abcfsl_cnt_filter_search_btn( $parFrm ){

    $par['tag'] = 'button';
    $par['type'] = 'submit';
    $par['txt'] = $parFrm['btnTxt'];
    $par['name'] = $parFrm['searchBtnName'];
    $par['cls'] = $parFrm['clsBtn'];

    $btnHTML = abcfl_html_input_btn( $par );

    return abcfsl_cnt_filter_frm_group( $btnHTML, $parFrm['clsBtnFrmGroup'] );
}

//-- CATEGORY INPUT HTML -----------------------------------------------
function abcfsl_cnt_filter_cbo_cat( $filterOptns, $inputOptns, $cbo, $filterNo ){

    $catTxtAll = isset( $filterOptns['_catTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_catTxtAll' . $filterNo][0] ) : '';
    $catSlugs = isset( $filterOptns['_catSlugs' . $filterNo] ) ? $filterOptns['_catSlugs' . $filterNo][0]  : '';

    if( empty( $catTxtAll ) && empty( $catSlugs ) ) { return ''; }

    $items = abcfsl_cnt_filter_cat_items( $catSlugs, $catTxtAll, $filterNo );

    //$inputOptns['controlID'] . '1',
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

function abcfsl_cnt_filter_cat_items( $catSlugs, $catTxtAll, $filterNo ){

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

//-- AZ INPUT HTML ------------------------------------------------------
function abcfsl_cnt_filter_cbo_az( $filterOptns, $inputOptns, $cbo, $filterNo ){

    $azItems = isset( $filterOptns['_azItems' . $filterNo] ) ? esc_attr( $filterOptns['_azItems' . $filterNo][0] ) : '';
    $azTxtAll = isset( $filterOptns['_azTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_azTxtAll' . $filterNo][0] ) : '';

    if( empty( $azTxtAll ) && empty( $azItems ) ) { return ''; }

    $items = abcfsl_cnt_filter_az_items( $azItems, $azTxtAll );
    $items = array_change_key_case( $items, CASE_LOWER);

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

function abcfsl_cnt_filter_az_items( $azItems, $azTxtAll ){

    $cboItems = array();
    //All
    if( !empty( $azTxtAll ) ) {  $cboItems[''] = $azTxtAll; }

    if( empty( $azItems ) ) { return $cboItems; }
    $azItemsA = explode(',', $azItems);

    $i = 1;
    foreach ( $azItemsA as $key => $value ) {
        $cboItems[$value] = $value;
        $i++;
    }

    return $cboItems;
}

//====================================================
//Generic group container
function abcfsl_cnt_filter_frm_group( $content, $cls ){

    //<div class="btn-group" role="group" aria-label="Basic example">

    if( !empty($content) ){
        return abcfl_html_tag_with_content( $content, 'div', '', $cls );
    }
    return '';
}

