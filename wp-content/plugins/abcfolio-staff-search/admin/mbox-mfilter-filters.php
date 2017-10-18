<?php
function abcfsls_mbox_mfilter_filters( $tplateID, $filterOptns, $filterNo ) {

 //echo"<pre>", print_r($filterOptns), "</pre>";

    $mFilterType = isset( $filterOptns['_mFilterType' . $filterNo]  ) ? $filterOptns['_mFilterType' . $filterNo][0]  : '';

    $cntrS = abcfl_html_tag('div','','inside hidden');
    if( $filterNo == 1 ){ $cntrS = abcfl_html_tag('div','','inside'); }
    echo $cntrS;

    echo abcfl_input_hidden( '', 'mFilterType' . $filterNo, $mFilterType );

    //-- --------------------
    switch ( $mFilterType ) {
        case 'C' :
            //abcfsl_mbox_mfilter_items_filter_cat( $tplateID, $filterOptns, $filterNo );
            abcfsls_mbox_mfilter_cat( $tplateID, $filterOptns, $filterNo );
            break;
        case 'AZ' :
            abcfsls_mbox_mfilter_az( $filterOptns, $filterNo );
            break;
        case 'TXT' :
            abcfsls_mbox_mfilter_txt_single( $filterOptns, $filterNo );
            break;
        case 'TXTM' :
            abcfsls_mbox_mfilter_txt_multi( $filterOptns, $filterNo );
            break;
        case 'DROP' :
            abcfsls_mbox_mfilter_drop( $tplateID, $filterOptns, $filterNo );
            break;
        default:
            //ADD NEW Record Screen. Display only Add New cbo
            abcfsls_mbox_mfilter_filters_add_filter( $mFilterType, $filterNo );
   }
}

//== FILTER NOT SELECTED =================================
function abcfsls_mbox_mfilter_filters_add_filter( $mFilterType, $filterNo ){

    $cbo = abcfsls_cbo_mfilter_type();
    echo abcfl_input_cbo('mFilterType' . $filterNo, '',$cbo, $mFilterType, abcfsls_txta(149), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    //echo abcfl_icon_cntr( ABCFSLS_ICONS_URL, 'staff-list-layouts-pro.png', 'abcflMTop20 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsls_txta(11), abcfsls_aurl(5), 'abcflFontFVS14 abcflFontW400 abcflMTop20' );

    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo ){

    if( $filterNo == '1' ) { return '';}
    $hideDelete = isset( $filterOptns['_mfHideDelete' . $filterNo] ) ?  $filterOptns['_mfHideDelete' . $filterNo][0] : '';
    $cboHD = abcfsls_cbo_hide_delete();

    $lblHD = abcfsls_txta(56) . '/'. abcfsls_txta_r(57);

    echo abcfl_input_hline('2');
    echo abcfl_input_cbo('mfHideDelete' . $filterNo, '', $cboHD, $hideDelete, $lblHD, '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}


function abcfsls_mbox_mfilter_filters_min_len( $filterOptns, $filterNo ) {

    $minLen = isset( $filterOptns['_minLen' . $filterNo] ) ?  $filterOptns['_minLen' . $filterNo][0] : '3';

    $cboMinLen= abcfsls_cbo_min_len();
    echo abcfl_input_cbo('minLen' . $filterNo, '', $cboMinLen, $minLen, abcfsls_txta_r(144), abcfsls_txta(7). ': 3.', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}
