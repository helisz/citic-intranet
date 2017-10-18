<?php
function abcfsl_txta_reqired( $id, $suffix='' ) {
    $txt = abcfsl_txta( $id, $suffix );
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}

//No new but we got legacy.
function abcfsl_autil_add_meta_field_order_from_legacy( $postID, $metaFieldName, $fieldOrderL, $F ){

    //------------------------------------------------------------
    //If we are still not done it means that legacy field order exists and no new field order has been created.
    //Copy legacy to new meta
    //Update new meta.

    $metaDataArray = unserialize( $fieldOrderL );

    //Copy legacy to new meta
    update_post_meta( $postID, $metaFieldName, $metaDataArray );

    abcfsl_autil_update_meta_field_order( $postID, $metaFieldName, $fieldOrderL, $F );
}

function abcfsl_autil_mbox_menu_shortcode_help() {

    echo abcfl_input_hline('1');
    $out = abcfl_input_info_lbl(abcfsl_txta(113), 'abcflMTop20', 16, 'SB');
    $out .= abcfl_input_info_lbl(abcfsl_txta(115), 'abcflMTop10', 14, 'V');

    return $out;
}

function abcfsl_mbox_menu_shortcode( $menuID, $menuOptns ) {

    echo  abcfl_html_tag('div','','inside  hidden');
        $scode = abcfsl_scode_build_scode_cat_menu( $menuID );
        //$fPageUrl = isset( $tplateOptns['_fPageUrl'] ) ? esc_attr( $tplateOptns['_fPageUrl'][0] ) : '';

        echo abcfl_input_txt_readonly('scode', '', $scode, abcfsl_txta(3),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');
        //echo abcfl_input_txt('fPageUrl', '', $fPageUrl, abcfsl_txta(94), abcfsl_txta(110), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}


//??????????????????????????????
function abcfsl_mbox_mfilter_layout_field_order( $filterOptns ) {

    //[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,1,2],[3,2,1]
    $fieldOrder =  isset( $filterOptns['_mfFieldOrder'] ) ?  $filterOptns['_mfFieldOrder'][0] : '1,2,3';
    $cboOrder = abcfsl_cbo_mfilter_cbo_field_order();

    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(177), abcfsl_aurl(0) );
    echo abcfl_input_cbo_strings('mfFieldOrder', '', $cboOrder, $fieldOrder, '', '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
}

//????????????????????????????????
 //[1,2,3],[1,3,2],[2,1,3],[2,3,1],[3,1,2],[3,2,1]
function abcfsl_cbo_mfilter_cbo_field_order() {
    return array('1,2,3' => '1,2,3',
        '1,3,2' => '1,3,2',
        '2,1,3' => '2,1,3',
        '2,3,1' => '2,3,1',
        '3,1,2' => '3,1,2',
        '3,2,1' => '3,2,1',
        );
}

//MFTextBox ????????????????????
function abcfsl_mbox_mfilter_items_filter_txt( $filterOptns, $filterNo ) {

     //abcfl_input_sec_title_hlp( $url, $txt, $hlpHref, $clsCust='', $target='_blank' )
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(172),  abcfsl_aurl(36));

    abcfsl_mbox_mfilter_items_txt_search_fields( $filterOptns, $filterNo );
    abcfsl_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );

    echo abcfl_html_tag_end('div');
}

//?????????????????????????????????????
function abcfsl_mbox_mfilter_items_txt_search_fields( $tplateOptns, $filterNo='' ) {

        $azFieldID = isset( $tplateOptns['_azFieldID' . $filterNo] ) ? $tplateOptns['_azFieldID' . $filterNo][0] : '';
        $azFieldType = isset( $tplateOptns['_azFieldType' . $filterNo] ) ? $tplateOptns['_azFieldType' . $filterNo][0] : '_sortTxt';

        $cboFieldID = abcfsl_cbo_field_id();
        $cboFieldType = abcfsl_cbo_mfilter_cbo_txt_filed_type();


        //'mp1_F8'
        echo abcfl_input_hline('2', 10);
        echo abcfl_input_info_lbl( abcfsl_txta(129), 'abcflMTop10', 16, 'SB');
        echo abcfl_input_info_lbl( abcfsl_txta(133), 'abcflMTop5', 13, 'N');
        echo abcfl_input_cbo_strings( 'azFieldID' . $filterNo, '', $cboFieldID, $azFieldID, abcfsl_txta_r(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_cbo_strings( 'azFieldType' . $filterNo, '', $cboFieldType, $azFieldType, abcfsl_txta_r(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsl_cbo_mfilter_cbo_txt_filed_type() {
    return array(''  => '- - -',
        '_txt_'  => abcfsl_txta(38) . ', ' . abcfsl_txta(86),
        '_mp1_'  => abcfsl_txta(128, ' 1'),
        '_mp2_'  => abcfsl_txta(128, ' 2'),
        '_mp3_'  => abcfsl_txta(128, ' 3'),
        '_mp4_'  => abcfsl_txta(128, ' 4'),
        '_url_'  => abcfsl_txta(82) . ', ' . abcfsl_txta(290),
        '_sortTxt'  => abcfsl_txta(61)
        );
}

function abcfsl_aurl_tab_help( ) {

    $getParams = abcfsl_admin_tabs_defaults( '' );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $hrefHelp =  $basePg . '&amp;tab=' . 'tabHelp';
    return $hrefHelp;
}