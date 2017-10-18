<?php
function abcfsl_mbox_mfilter_az( $filterOptns, $filterNo ) {

     //abcfl_input_sec_title_hlp( $url, $txt, $hlpHref, $clsCust='', $target='_blank' )
    echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(67),  abcfsl_aurl(36));

    abcfsl_mbox_mfilter_az_items_all( $filterOptns, $filterNo );
    abcfsl_mbox_menu_az_items_search_fields( $filterOptns, $filterNo );

    abcfsl_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo );
    echo abcfl_html_tag_end('div');
}

function abcfsl_mbox_mfilter_az_items_all( $filterOptns, $filterNo ) {

        $azTxtAll = isset( $filterOptns['_azTxtAll' . $filterNo] ) ? esc_attr( $filterOptns['_azTxtAll' . $filterNo][0] ) : '';
        $azItems = isset( $filterOptns['_azItems' . $filterNo] ) ? esc_attr( $filterOptns['_azItems' . $filterNo][0] ) : '';

        //'mp1_F8'
        echo abcfl_input_txt('azTxtAll' . $filterNo, '', $azTxtAll, abcfsl_txta(95), abcfsl_txta(270) . ' ' . abcfsl_txta(111), '50%', '', '', 'abcflFldCntr', 'abcflFldLbl');
        echo abcfl_input_txt('azItems' . $filterNo, '', $azItems, abcfsl_txta_r(131), abcfsl_txta(117), '100%', '', '', 'abcflFldCntr', 'abcflFldLbl');
}

