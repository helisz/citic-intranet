<?php
//== MULTI FIELD SEARCH START==============================================
//MFTextBox
function abcfsls_mbox_mfilter_txt_multi( $filterOptns, $filterNo ) {

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(145),  abcfsls_aurl(7));

    abcfsls_mbox_mfilter_filters_min_len( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_txt_multi_fields( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_txt_multi_fields( $filterOptns, $filterNo ) {

    $cboFieldNo = abcfsls_cbo_field_id();
    $cboFieldType = abcfsls_cbo_mfilter_filed_type();

    //'mp1_F8'
    echo abcfl_input_hline('2', 10);
    echo abcfl_input_info_lbl( abcfsl_txta(129), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_info_lbl( abcfsl_txta(133), 'abcflMTop5', 13, 'N');

    for ($x = 1; $x <= 6; $x++) {
        abcfsls_mbox_mfilter_txt_multi_field(  $filterOptns, $cboFieldNo, $cboFieldType, $filterNo, $x );
    }
}

function abcfsls_mbox_mfilter_txt_multi_field( $filterOptns, $cboFieldNo, $cboFieldType, $filterNo, $fieldNo ) {

    $slMFieldNo = isset( $filterOptns['_slMField' . $fieldNo . 'No' . $filterNo] ) ?  $filterOptns['_slMField' . $fieldNo . 'No' . $filterNo][0] : '';
    $slMFieldType = isset( $filterOptns['_slMField' . $fieldNo . 'Type' . $filterNo] ) ? $filterOptns['_slMField' . $fieldNo . 'Type' . $filterNo][0] : '';

    if( $fieldNo != 1 ) { echo abcfl_input_hline('1', 10); }

    //echo abcfl_input_sec_title( $fieldNo );

    echo abcfl_input_cbo_strings( 'slMField' . $fieldNo . 'No' . $filterNo, '', $cboFieldNo, $slMFieldNo, $fieldNo . '. ' . abcfsl_txta(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'slMField' . $fieldNo . 'Type' . $filterNo, '', $cboFieldType, $slMFieldType, $fieldNo . '. ' . abcfsl_txta(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//== MULTI FIELD SEARCH  END==============================================

//== FIELD SEARCH START==============================================
function abcfsls_mbox_mfilter_txt_single( $filterOptns, $filterNo ) {

    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(146),  abcfsls_aurl(7));

    abcfsls_mbox_mfilter_filters_min_len( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_txt_single_field( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_txt_single_field( $filterOptns, $filterNo ) {

    $slFieldNo = isset( $filterOptns['_slFieldNo' . $filterNo] ) ?  $filterOptns['_slFieldNo' . $filterNo][0] : '';
    $slFieldType = isset( $filterOptns['_slFieldType' . $filterNo] ) ? $filterOptns['_slFieldType' . $filterNo][0] : '';

    $cboFieldNo = abcfsl_cbo_field_id();
    $cboFieldType = abcfsls_cbo_mfilter_filed_type();

    //'mp1_F8'
    echo abcfl_input_hline('2', 10);
    echo abcfl_input_info_lbl( abcfsl_txta(129), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_info_lbl( abcfsl_txta(133), 'abcflMTop5', 13, 'N');
    echo abcfl_input_cbo_strings( 'slFieldNo' . $filterNo, '', $cboFieldNo, $slFieldNo, abcfsl_txta_r(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'slFieldType' . $filterNo, '', $cboFieldType, $slFieldType, abcfsl_txta_r(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}
//== FIELD SEARCH  END==============================================