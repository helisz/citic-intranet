<?php

function mbox_col_order( $postID, $tplateOptns ){

    echo  abcfl_html_tag('div','','inside  hidden');
        $out = mbox_col_order_sort_cntr( $postID, $tplateOptns );
        echo $out['msg'];
        echo $out['sortCntr'];
    echo abcfl_html_tag_end('div');
}
//-------------------------------------------------------------------------------------

//Render sort fields container
function mbox_col_order_sort_cntr( $postID, $tplateOptns ){

    $items = '';
    $fieldsQty = 0;

    //[1] => F1 [2] => F4 [3] => F5
    $fieldOrder = abcfsls_tplate_col_order( $tplateOptns );

    foreach ( $fieldOrder as $order => $F ) {

        $colHdr = isset( $tplateOptns['_colHdr_' . $F] ) ? esc_attr( $tplateOptns['_colHdr_' . $F][0] ) : '';
        $fieldTypeH = isset( $tplateOptns['_fieldTypeH_' . $F] ) ? esc_attr( $tplateOptns['_fieldTypeH_' . $F][0] ) : 'N';


        $showField = true;
        if($fieldTypeH == 'N'){ $showField = false; }

        if( $showField ){
            //$lineName = $inputLbl;
            $items .= mbox_col_order_li( $F, $order, $fieldTypeH,  $colHdr );
            $fieldsQty++;
        }
    }

    $out['msg'] = abcfl_input_info_lbl(abcfsls_txta(214), 'abcflMTop15 abcflMBottom15', 16, 'SB');
    $out['sortCntr'] = '';

    if( $fieldsQty > 0 ){
        $out['msg'] = abcfl_input_info_lbl(abcfsls_txta(255), 'abcflMTop15 abcflMBottom15', 14, 'SB');
        $out['sortCntr'] = mbox_col_order_cntr($postID, $items);
    }
    return $out;
}

//LI buider.
function mbox_col_order_li($F, $order, $fieldTypeH, $lineName ){

        $clsLi = 'sortable-item';
        $idLi = $F;
        $clsLineNumber = 'abcflFontFVS12 abcflFontW700';
        $clsLineName = 'abcflPLeft15 abcflFontFVS12';

        $lineNumber = $order . ' - '. $idLi . '&nbsp;';
        $fieldType = mbox_col_order_col_type( $fieldTypeH );

        $liS = abcfl_html_tag('li',  $idLi, $clsLi );
        $spanSort = abcfl_html_tag( 'span', '', $clsLineNumber) .$lineNumber . '</span>';
        $spanName = abcfl_html_tag( 'span', '', $clsLineName) . $lineName . '</span>';
        $spanFieldType = abcfl_html_tag( 'span', '', 'abcflPLeft10') . $fieldType . '</span>';

        return $liS . $spanSort . $spanName . $spanFieldType. '</li>';
}

function mbox_col_order_cntr( $postID, $items ){

    $divID = 'fieldsSortCntr';
    $divCls = 'abcflWidth60Pc';
    $divS = abcfl_html_tag( 'div', $divID, $divCls );
    $divE = '</div>';

    $ulCls = 'sortable-list ui-sortable';
    $ulID = 'ul_' . $postID;
    $ulS = abcfl_html_tag( 'ul', $ulID, $ulCls );

    return $divS . $ulS . $items . '</ul>' . $divE;
}

//Labels displayed next to field names on sort screen
function mbox_col_order_col_type( $fieldTypeH ){

    $out = '';
    $fieldType = '';

    switch ($fieldTypeH) {
        case 'T':
            $fieldType = 'Txt';
            break;
        case 'MP':
            $fieldType = 'Multipart';
            break;
        case 'H':
            $fieldType = 'Link';
            break;
        case 'EM':
            $fieldType = 'Email';
            break;
        case 'PT':
            $fieldType = 'Paragraph';
            break;
        default:
            break;
    }
    $out = '[ ' . $fieldType . ' ]';
    return $out;
}

function abcfsls_tplate_col_order( $tplateOptns ){

    $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';

    if(empty($fieldOrder)){
        for ( $i = 1; $i <= 10; $i++ ) { $fieldOrder[$i] = 'F' . $i; }
    }
    else{
        $fieldOrder = unserialize($fieldOrder);

        // Array has duplicates
        if(count(array_unique($fieldOrder))<count($fieldOrder)){
            $fieldOrderU = array_unique($fieldOrder);
            $fieldOrder = array_combine(range(1, count($fieldOrderU)), array_values($fieldOrderU));
        }
    }

    //[1] => F1 [2] => F4 [3] => F5
    return $fieldOrder;
}
