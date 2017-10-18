<?php
function abcfsls_mbox_mfilter_cat( $tplateID, $filterOptns, $filterNo ) {

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(240), abcfsl_aurl(36));

    abcfsls_mbox_mfilter_cat_all( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_cat_slugs_hdr();

    $slugs = get_post_meta($tplateID, '_catSlugs' . $filterNo, true);
    abcfsls_mbox_mfilter_cat_slugs( $slugs, $filterNo );

    abcfsls_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_cat_all( $filterOptns, $filterNo ) {

    $catTxtAll = isset( $filterOptns['_catTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_catTxtAll' . $filterNo][0] ) : '';
    echo abcfl_input_txt('catTxtAll' . $filterNo, '', $catTxtAll, abcfsl_txta(95), abcfsl_txta(111), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsls_mbox_mfilter_cat_slugs_hdr() {
    echo abcfl_input_hline('1');
    echo abcfl_input_info_lbl(abcfsl_txta(45), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_info_lbl(abcfsl_txta(114), 'abcflMTop5 abcflMBottom20', 14, 'SB');
}

function abcfsls_mbox_mfilter_cat_slugs( $slugs, $filterNo ) {

    $tbl = abcfl_html_tag( 'table', 'slsTblCatSlugs' . $filterNo, 'slsTblCatSlugs', 'width:50%;');
    $tbl .= abcfl_html_tag_blank('thead');
    $tbl .= abcfl_html_tag_blank('tr');
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_end( 'th' );
    $tbl .= abcfl_html_tag_with_content( abcfsl_txta_r(96), 'th', '', 'abcflFontW400 abcflTxtLeft', 'width:80%;' );
    $tbl .= abcfl_html_tag( 'th', '', '', '' );
    $tbl .=  abcfl_html_tag_ends( 'th,tr,thead' );

    echo $tbl;

    if ( $slugs ) {
        foreach ( $slugs as $field ) {
            $fieldValue = '';
            if($field['catSlug' . $filterNo] != '') { $fieldValue = esc_attr( $field['catSlug' . $filterNo] ); }
            echo abcfsls_mbox_mfilter_cat_slug_row( $fieldValue, $filterNo );
        }
    }
	else {
            // show a blank one
            echo abcfsls_mbox_mfilter_cat_slug_row( '', $filterNo );
    }
    // empty hidden one for jQuery
    echo abcfsls_mbox_mfilter_cat_slug_row( '', $filterNo, 'screen-reader-text slsTrEmptyRowSlug' . $filterNo );
    echo abcfl_html_tag_ends( 'tbody,table' );
    echo abcfl_html_tag_with_content('<a id="slBtnAddRowSlug' . $filterNo . '" class="button slsBtnAddRowSlug" data-id="' . $filterNo .
            '" href="#"><span class="abcflFontW700 abcflFontS20">+</span></a>', 'p', '', '', '');
}

function abcfsls_mbox_mfilter_cat_slug_row( $fieldValue, $filterNo, $cls='' ){

    $row = abcfl_html_tag( 'tr', '', $cls);
    $row .= abcfl_html_tag_with_content('<a class="button slsBtnRemoveRowSlug" href="#">X</a>', 'td', '', '', '' );
    $row .= abcfl_html_tag( 'td', '', '');
    $row .= abcfl_html_input_text( 'catSlug'. $filterNo . '[]', $fieldValue, $size='100%');
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag( 'td', '', 'slsTdSortHandleSlug' );
    $row .= abcfl_html_img_tag('', ABCFSLS_PLUGIN_URL . 'images/move-icon.png', 'Move Icon', '', 24, 24);
    $row .= abcfl_html_tag_end( 'td' );
    $row .= abcfl_html_tag_end( 'tr' );

    return $row;
}