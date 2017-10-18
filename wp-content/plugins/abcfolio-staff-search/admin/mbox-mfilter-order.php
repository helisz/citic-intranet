<?php
function abcfsls_mbox_mfilter_order( $filterID, $filterOptns ){

    echo  abcfl_html_tag('div','','inside  hidden');

        echo abcfl_input_info_lbl( abcfsls_txta(255), 'abcflMTop15 abcflMBottom15', 14, 'SB' );

        //Sort fields container
        echo abcfsls_mbox_mfilter_sort_cntr( $filterID, $filterOptns );

    echo abcfl_html_tag_end('div');
}

//Render sort fields container
function abcfsls_mbox_mfilter_sort_cntr( $filterID, $filterOptns ){

    $items = '';
    $mfOrder = abcfsls_mbox_mfilter_field_order( $filterOptns );

    foreach ( $mfOrder as $order => $filterName ) {
        $items .= abcfsls_mbox_mfilter_li( $order, $filterName );
    }
    return abcfsls_mbox_mfilter_cntr( $filterID, $items );
}

//LI buider.
function abcfsls_mbox_mfilter_li( $order, $filterName ){

        $clsLi = 'sortable-item';
        $clsName = 'abcflPLeft15 abcflFontFVS12';
        $idLi = $order;

        $liS = abcfl_html_tag('li', $idLi, $clsLi );
        $spanFilterName = abcfl_html_tag( 'span', '', $clsName) . $filterName . '</span>';

        return $liS . $spanFilterName . '</li>';
}

function abcfsls_mbox_mfilter_cntr( $filterID, $items ){

    $divID = 'mfOrderCntr';
    $divCls = 'abcflWidth60Pc';
    $divS = abcfl_html_tag( 'div', $divID, $divCls );
    $divE = '</div>';

    $ulCls = 'sortable-list ui-sortable';
    $ulID = 'ul' . '_' . $filterID;
    $ulS = abcfl_html_tag( 'ul', $ulID, $ulCls );

    return $divS . $ulS . $items . '</ul>' . $divE;
}

function abcfsls_mbox_mfilter_field_order( $filterOptns ){

    $mfOrder = isset( $filterOptns['_mfOrder'] ) ? $filterOptns['_mfOrder'][0] : array();

    $out = array();

    if( empty($mfOrder) ){
        for ( $i = 1; $i <= 6; $i++ ) {
            $mfOrder[$i] = 'Filter ' . $i;
        }
        $out = $mfOrder;
    }
    else{
        $mfOrder = unserialize( $mfOrder );
        //$out = '';
        foreach( $mfOrder as $key => $value ) {
            $out[$value] = 'Filter ' . $value;
        }
    }
    return $out;
}

