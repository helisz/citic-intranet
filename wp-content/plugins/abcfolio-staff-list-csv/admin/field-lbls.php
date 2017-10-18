<?php
//Returns SL field label and field order. Used for preview.
function abcfslc_field_lbls_lbl( $metaKey, $tplateOptns, $fieldOrder ){

    $out['lbl'] = '-';
    $out['order'] = '0';

    switch ( $metaKey ){
        case 'postID':
            $out['lbl'] = abcfslc_txta(45);
            $out['order'] = '0';
            break;
        case 'postTitle':
            $out['lbl'] = abcfslc_txta(100);
            $out['order'] = '1';
            break;
        case '_sortTxt':
            $out['lbl'] = abcfslc_txta(101);
            $out['order'] = '130';
            break;
        case '_pretty':
            $out['lbl'] = abcfslc_txta(76);
            $out['order'] = '132';
            break;
        case '_sPgTitle':
            $out['lbl'] = abcfslc_txta(113);
            $out['order'] = '134';
            break;
        case '_categories':
            $out['lbl'] = abcfslc_txta(114);
            $out['order'] = '500';
            break;
        case '_imgUrlL':
            $out['lbl'] = abcfslc_txta(102);
            $out['order'] = '200';
            break;
        case '_imgUrlS':
            $out['lbl'] = abcfslc_txta(103);
            $out['order'] = '210';
            break;
        case '_imgLnkL':
            $out['lbl'] = abcfslc_txta(104);
            $out['order'] = '220';
            break;
        case '_overTxtI1':
            $out['lbl'] = abcfslc_txta(82) . ' 1';
            $out['order'] = '225';
            break;
        case '_overTxtI2':
            $out['lbl'] = abcfslc_txta(82) . ' 2';
            $out['order'] = '226';
            break;
        //------------------------------------
        case '_fbookUrl':
            $out['lbl'] = abcfslc_txta(105);
            $out['order'] = '230';
            break;
        case '_googlePlusUrl':
            $out['lbl'] = abcfslc_txta(106);
            $out['order'] = '240';
            break;
        case '_twitUrl':
            $out['lbl'] = abcfslc_txta(107);
            $out['order'] = '250';
            break;
        case '_likedUrl':
            $out['lbl'] = abcfslc_txta(108);
            $out['order'] = '260';
            break;
        case '_emailUrl':
            $out['lbl'] = abcfslc_txta(109);
            $out['order'] = '270';
            break;
        case '_socialC1Url':
            $out['lbl'] = abcfslc_txta(110);
            $out['order'] = '280';
            break;
        case '_socialC2Url':
            $out['lbl'] = abcfslc_txta(111);
            $out['order'] = '290';
            break;
        case '_socialC3Url':
            $out['lbl'] = abcfslc_txta(112);
            $out['order'] = '300';
            break;
       default:
            break;
    }

    if( $out['lbl'] != '-' ) { return $out; }


    //Works for multifields.
    if ( strpos( $metaKey, '_F' ) > 0) {
        $F = substr($metaKey, ( strpos( $metaKey, '_F' )+1) );
        $out['lbl'] = $F . ' ' . abcfslc_field_lbls_F_lbl( $tplateOptns, $F, $metaKey );
        $out['order'] = $fieldOrder;
    }

    //Doesn't work for mutifields. Order Number will have dups.
//    if ( strpos( $metaKey, '_F' ) > 0) {
//        $F = substr($metaKey, ( strpos( $metaKey, '_F' )+1) );
//        $out['lbl'] = $F . ' ' . abcfslc_field_lbls_F_lbl( $tplateOptns, $F, $metaKey );
//        $out['order'] = (substr($F, 1) + 1);
//    }
    return $out;
}

//Field label
function abcfslc_field_lbls_F_lbl( $tplateOptns, $F, $metaKey ){

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? esc_attr( $tplateOptns['_fieldType_' . $F][0] ) :'N';
    if( $fieldType == 'N' ) { return ''; }

    $row = '';
    //-----------------------------------------------------
    switch ($fieldType){
        case 'T':
        case 'CE':
        case 'PT':
        case 'LT':
            $row = abcfslc_field_lbls_field_lbl_T( $tplateOptns, $F );
            break;
        case 'MP':
            $row = abcfslc_field_lbls_field_lbl_MP( $tplateOptns, $F, $metaKey );
            break;
        case 'EM':
        case 'H':
            $row = abcfslc_field_lbls_field_lbl_H( $tplateOptns, $F, $metaKey );
            break;
        case 'TH':
            $row = abcfslc_field_lbls_field_lbl_TH( $tplateOptns, $F );
            break;
       default:
            break;
    }
    return $row;
}

function abcfslc_field_lbls_field_lbl_T( $tplateOptns, $F ){
    return isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '-';
}

function abcfslc_field_lbls_field_lbl_TH( $tplateOptns, $F ){
    return isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '-';
}

function abcfslc_field_lbls_field_lbl_H( $tplateOptns, $F, $metaKey ){

    //_urlTxt_F6 9 _url_F20
    $len = strlen ($metaKey);
    $lbl = '-';

    //Get Link Text or Link URL field labels. Meta key is longer for link text labels.
    if( $len >= 10 ) {
          $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '-';
    }
    else { $lbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '-'; }

//    if( $len >= 10 ) {
//        $lbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '-';
//    }
//    else { $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '-'; }

    return $lbl;
}

function abcfslc_field_lbls_field_lbl_MP( $tplateOptns, $F, $metaKey ){

    $part = substr($metaKey, 0, 4);
    $lbl = '-';
    switch ($part){
        case '_mp1':
            $lbl = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : '-';
            break;
        case '_mp2':
            $lbl = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : '-';
            break;
        case '_mp3':
            $lbl = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : '-';
            break;
        case '_mp4':
            $lbl = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : '-';
            break;
       default:
            break;
    }
    return $lbl;
}

