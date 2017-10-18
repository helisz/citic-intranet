<?php
//== CUSTOM DROPDOWN START =========================
function abcfsls_mbox_mfilter_drop( $tplateID, $filterOptns, $filterNo ) {

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(17), abcfsl_aurl(0));

    abcfsls_mbox_mfilter_drop_all( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_drop_items_hdr();
    abcfsls_mbox_mfilter_drop_items( $tplateID, $filterNo  );
    abcfsls_mbox_mfilter_drop_field( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_drop_all( $filterOptns, $filterNo ) {

    $dropTxtAll = isset( $filterOptns['_dropTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_dropTxtAll' . $filterNo][0] ) : '';
    echo abcfl_input_txt('dropTxtAll' . $filterNo, '', $dropTxtAll, abcfsl_txta(95), abcfsl_txta(111), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsls_mbox_mfilter_drop_items_hdr() {
    echo abcfl_input_hline('1');
    echo abcfl_input_info_lbl( abcfsls_txta(147), 'abcflMTop10', 16, 'SB');
    //echo abcfl_input_info_lbl( abcfsl_txta(114), 'abcflMTop5 abcflMBottom20', 14, 'SB');
}

function abcfsls_mbox_mfilter_drop_items( $tplateID, $filterNo ) {

    $tbl = abcfl_html_tag( 'table', 'slsTblDropItems' . $filterNo, 'slsTblDropItems', 'width:50%;' );
    $tbl .= abcfl_html_tag_blank('thead');
    $tbl .= abcfl_html_tag_blank('tr');
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_end( 'th' );
    $tbl .= abcfl_html_tag_with_content( abcfsls_txta_r(18), 'th', '', 'abcflFontW400 abcflTxtLeft', 'width:80%;' );
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_ends( 'th,tr,thead' );

    echo $tbl;

    $items = get_post_meta( $tplateID, '_dropItems' . $filterNo, true );
    if ( $items ) {
        foreach ( $items as $value  ) {
            echo abcfsls_mbox_mfilter_drop_items_row( $value, $filterNo );
        }
    }
	else {
            // show a blank one
            echo abcfsls_mbox_mfilter_drop_items_row( '', $filterNo );
    }

    // empty hidden one for jQuery
    echo abcfsls_mbox_mfilter_drop_items_row( '', $filterNo, 'screen-reader-text slsTrEmptyDropItem' . $filterNo );
    echo abcfl_html_tag_ends( 'tbody,table' );
    echo abcfl_html_tag_with_content('<a id="slsBtnAddRowDrop' . $filterNo . '" class="button slsBtnAddRowDrop" data-id="' . $filterNo .
        '" href="#"><span class="abcflFontW700 abcflFontS20">+</span></a>', 'p', '', '', '' );

}

function abcfsls_mbox_mfilter_drop_items_row( $fieldValue, $filterNo, $cls='' ){

    $row = abcfl_html_tag( 'tr', '', $cls);
    $row .= abcfl_html_tag_with_content('<a class="button slsBtnRemoveRowDrop" href="#">X</a>', 'td', '', '', '' );
    $row .= abcfl_html_tag( 'td', '', '');
    $row .= abcfl_html_input_text( 'dropItem'. $filterNo . '[]', $fieldValue, $size='100%');
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag( 'td', '', 'slsTdSortHandleDropItem' );
    $row .= abcfl_html_img_tag('', ABCFSLS_PLUGIN_URL . 'images/move-icon.png', 'Move Icon', '', 24, 24);
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag_end( 'tr' );

    return $row;
}

function abcfsls_mbox_mfilter_drop_field( $filterOptns, $filterNo ) {

    $slFieldNo = isset( $filterOptns['_slFieldNo' . $filterNo] ) ?  $filterOptns['_slFieldNo' . $filterNo][0] : '';
    $slFieldType = isset( $filterOptns['_slFieldType' . $filterNo] ) ? $filterOptns['_slFieldType' . $filterNo][0] : '';

    $cboFieldNo = abcfsls_cbo_field_id();
    $cboFieldType = abcfsl_cbo_az_filed_type();

    //'mp1_F8'
    echo abcfl_input_hline('2', 10);
    echo abcfl_input_info_lbl( abcfsl_txta(129), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_cbo_strings( 'slFieldNo' . $filterNo, '', $cboFieldNo, $slFieldNo, abcfsl_txta_r(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'slFieldType' . $filterNo, '', $cboFieldType, $slFieldType, abcfsl_txta_r(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//== CUSTOM DROPDOWN END =========================

