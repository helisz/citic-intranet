<?php
function abcfsl_mbox_mfilter_items( $tplateID, $filterOptns, $filterNo ) {

 //echo"<pre>", print_r($filterOptns), "</pre>";

    $mFilterType = isset( $filterOptns['_mFilterType' . $filterNo]  ) ? $filterOptns['_mFilterType' . $filterNo][0]  : '';

    $cntrS = abcfl_html_tag('div','','inside hidden');
    if( $filterNo == 1 ){ $cntrS = abcfl_html_tag('div','','inside'); }
    echo $cntrS;

    echo abcfl_input_hidden( '', 'mFilterType' . $filterNo, $mFilterType );

    //-- --------------------
    switch ( $mFilterType ) {
        case 'C' :
            abcfsl_mbox_mfilter_cat( $tplateID, $filterOptns, $filterNo );
            break;
        case 'AZ' :
            abcfsl_mbox_mfilter_az( $filterOptns, $filterNo );
            break;
        default:
            //ADD NEW Record Screen. Show only Add New cbo
            abcfsl_mbox_mfilter_items_add_filter( $mFilterType, $filterNo );
   }
}

function abcfsl_mbox_mfilter_items_filter_hide_delete( $filterOptns, $filterNo ){

    if( $filterNo == '1' ) { return '';}
    $hideDelete = isset( $filterOptns['_mfHideDelete' . $filterNo] ) ?  $filterOptns['_mfHideDelete' . $filterNo][0] : '';
    $cboHideDelete = abcfsl_cbo_mfilter_cbo_hide_delete();

    echo abcfl_input_hline('2');
    echo abcfl_input_cbo('mfHideDelete' . $filterNo, '', $cboHideDelete, $hideDelete, abcfsl_txta_r(71), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
}

//== FILTER NOT SELECTED =================================
function abcfsl_mbox_mfilter_items_add_filter( $mFilterType, $filterNo ){

    $cbo = abcfsl_cbo_mfilter_type();
    echo abcfl_input_cbo('mFilterType' . $filterNo, '',$cbo, $mFilterType, abcfsl_txta(66), '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

    //echo abcfl_icon_cntr( ABCFSL_ICONS_URL, 'staff-list-layouts-pro.png', 'abcflMTop20 abcflMLeft10' );
    echo abcfl_input_hlp_url( abcfsl_txta(11), abcfsl_aurl(36), 'abcflFontFVS14 abcflFontW400 abcflMTop20' );

    echo abcfl_html_tag_end('div');
}





