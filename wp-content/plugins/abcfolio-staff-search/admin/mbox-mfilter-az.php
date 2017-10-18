<?php
//== AZ START = == Search field name changed from az sl ===================
function abcfsls_mbox_mfilter_az( $filterOptns, $filterNo ) {

     //abcfl_input_sec_title_hlp( $url, $txt, $hlpHref, $clsCust='', $target='_blank' )
    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsl_txta(67),  abcfsl_aurl(0));

    abcfsls_mbox_mfilter_az_all( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_az_field( $filterOptns, $filterNo );
    abcfsls_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_az_all( $filterOptns, $filterNo ) {

    $azTxtAll = isset( $filterOptns['_azTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_azTxtAll' . $filterNo][0] ) : '';
    $azItems = isset( $filterOptns['_azItems' . $filterNo] ) ? esc_attr( $filterOptns['_azItems' . $filterNo][0] ) : '';

    //'mp1_F8'
    echo abcfl_input_txt('azTxtAll' . $filterNo, '', $azTxtAll, abcfsl_txta(95), abcfsl_txta(270) . ' ' . abcfsl_txta(111), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('azItems' . $filterNo, '', $azItems, abcfsl_txta_r(131), abcfsl_txta(117), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

function abcfsls_mbox_mfilter_az_field( $filterOptns, $filterNo='' ) {

    $slFieldNo = isset( $filterOptns['_slFieldNo' . $filterNo] ) ?  $filterOptns['_slFieldNo' . $filterNo][0] : '';
    $slFieldType = isset( $filterOptns['_slFieldType' . $filterNo] ) ? $filterOptns['_slFieldType' . $filterNo][0] : '';

    $cboFieldNo = abcfsl_cbo_field_id();
    $cboFieldType = abcfsl_cbo_az_filed_type();

    //'mp1_F8'
    echo abcfl_input_hline('2', 10);
    echo abcfl_input_info_lbl( abcfsl_txta(129), 'abcflMTop10', 16, 'SB');
    echo abcfl_input_info_lbl( abcfsl_txta(133) . ' ' . abcfsl_txta(176), 'abcflMTop5', 13, 'N');
    echo abcfl_input_cbo_strings( 'slFieldNo' . $filterNo, '', $cboFieldNo, $slFieldNo, abcfsl_txta_r(291), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_cbo_strings( 'slFieldType' . $filterNo, '', $cboFieldType, $slFieldType, abcfsl_txta_r(222), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}
//== AZ END ==================================

