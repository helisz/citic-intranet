<?php
//------------------------------------------------------------------
//Get list of staff fields based on selected Staff template. If no template return generic list.
function abcfsls_staff_social_cbo( $staffTplateOptns ){

    //if( $staffTplateID == 0 ){ return abcfsls_cbo_social_no_tplate(); }

    $social1 = isset( $staffTplateOptns['_social1'] ) ? esc_attr( $staffTplateOptns['_social1'][0] ) : abcfsls_txta(20,' 1');
    $social2 = isset( $staffTplateOptns['_social2'] ) ? esc_attr( $staffTplateOptns['_social2'][0] ) : abcfsls_txta(20,' 2');
    $social3 = isset( $staffTplateOptns['_social3'] ) ? esc_attr( $staffTplateOptns['_social3'][0] ) : abcfsls_txta(20,' 3');

    $first = abcfsls_cbo_social();
    $c1 = array( '_social1' => $social1);
    $c2 = array( '_social2' => $social2);
    $c3 = array( '_social3' => $social3);

    return $first + $c1 + $c2 + $c3;
}

function abcfsls_cbo_social() {
    return array( '_fbook'  => 'Facebook',
    '_googlePlus'  => 'Google+',
    '_twit'  => 'Twitter',
    '_liked'  => 'LinkedIn',
    '_email'  => 'Email'
    );
}

function abcfsls_cbo_social_custom() {
    return array(
        '_social1'  => abcfsls_txta(20,' 1'),
        '_social2'  => abcfsls_txta(20,' 2'),
        '_social3'  => abcfsls_txta(20,' 3')
    );
}

function abcfsls_cbo_social_no_tplate() {
    return abcfsls_cbo_social() + abcfsls_cbo_social_custom();
}

//========================================================
//Get list of staff fields based on selected Staff template. If no template return generic list.
function abcfsls_staff_fields_cbo( $staffTplateID, $staffTplateOptns ){

    if( $staffTplateID == 0 ){
        return abcfsls_staff_fields_no_tplate() + abcfsls_cbo_social_no_tplate();
    }

    $fields = abcfsls_staff_fields_tplate( $staffTplateOptns );
    $social = abcfsls_staff_social_cbo( $staffTplateOptns );

    return $fields + $social;
}

function abcfsls_staff_fields_no_tplate(){

    $row = array();
    $fields['F0'] = '- - -';
    for ( $i = 1; $i <= 40; $i++ ) {
        $row = abcfsls_staff_fields_cbo_item( 'F' . $i, 'F' . $i . '. ' );
        $fields[$row[0]] = $row[1];
    }
    return $fields;
}

function abcfsls_staff_fields_tplate( $tplateOptns ){

    $row = array();
    $cbo['F0'] = '- - -';
    for ( $i = 1; $i <= 40; $i++ ) {
        $row =  abcfsls_staff_fields_field_type_cbo_item( $tplateOptns, 'F' . $i   );
        $cbo[$row[0]] = $row[1];
    }
    return $cbo;
}

//Get field ID and field label: F1. Name
function abcfsls_staff_fields_field_type_cbo_item( $tplateOptns, $F  ){

    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0]  :'N';

    if( $fieldType == 'N' ) {
        return abcfsls_staff_fields_cbo_item( $F, $F . '.' );
    }

    $cboItem = abcfsls_staff_fields_cbo_item( 'F0', 'F0' );
    //-----------------------------------------------------
    switch ($fieldType){
        case 'T':
        case 'PT':
        case 'LT':
        case 'CE':
        case 'MP':
        case 'EM':
        case 'H':
        case 'TH':
        case 'HL':
        case 'SC':
            $cboItem = abcfslcs_staff_fields_lbl( $tplateOptns, $F );
            break;
       default:
           $cboItem = abcfsls_staff_fields_cbo_item( $F, $F . '.' );
            break;
    }
    return $cboItem;
}

function abcfslcs_staff_fields_lbl( $tplateOptns, $F ){

    $lbl = isset( $tplateOptns['_lblTxt_' . $F] ) ? esc_attr( $tplateOptns['_lblTxt_' . $F][0]  ) : '';
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : ''; }
    if(empty( $lbl )){ $lbl = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : ''; }

    return abcfsls_staff_fields_cbo_item( $F, $F . '. ' . $lbl );
}

function abcfsls_staff_fields_cbo_item( $F, $lbl ){

    $out[0] = $F;
    $out[1] = $lbl;
    return $out;
}

//#############################################################################
//Get field ID and field label: F1. Name
//function abcfsls_staff_fields_field_type_cbo_item_OLD( $tplateOptns, $F  ){
//
//    $fieldType = isset( $tplateOptns['_fieldType_' . $F] ) ? $tplateOptns['_fieldType_' . $F][0]  :'N';
//
//    if( $fieldType == 'N' ) {
//        return abcfsls_staff_fields_cbo_item( $F, $F . '.' );
//    }
//
//    $cboItem = abcfsls_staff_fields_cbo_item( 'F0', 'F0' );
//    //-----------------------------------------------------
//    switch ($fieldType){
//        case 'T':
//        case 'PT':
//        case 'LT':
//        case 'CE':
//            $cboItem = abcfslcs_staff_fields_lbl_field_T( $tplateOptns, $F );
//            break;
//        case 'MP':
//            $cboItem = abcfslcs_staff_fields_lbl_field_MP( $tplateOptns, $F );
//            break;
//        case 'EM':
//        case 'H':
//            $cboItem = abcfslcs_staff_fields_lbl_field_H( $tplateOptns, $F );
//            break;
//        case 'TH':
//            $cboItem = abcfslcs_staff_fields_lbl( $tplateOptns, $F );
//            break;
//       default:
//           $cboItem = abcfsls_staff_fields_cbo_item( $F, $F . '.' );
//            break;
//    }
//    return $cboItem;
//}
//function abcfslcs_staff_fields_lbl_field_MP( $tplateOptns, $F ){
//
//    $lblP1 = isset( $tplateOptns['_inputLblP1_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP1_' . $F][0] ) : '';
//    $lblP2 = isset( $tplateOptns['_inputLblP2_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP2_' . $F][0] ) : '';
//    $lblP3 = isset( $tplateOptns['_inputLblP3_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP3_' . $F][0] ) : '';
//    $lblP4 = isset( $tplateOptns['_inputLblP4_' . $F] ) ? esc_attr( $tplateOptns['_inputLblP4_' . $F][0] ) : '';
//
//    $lbl = $lblP1;
//    if( empty( $lbl ) ) { $lbl = $lblP2; }
//    if( empty( $lbl ) ) { $lbl = $lblP3; }
//    if( empty( $lbl ) ) { $lbl = $lblP4; }
//
//    return abcfsls_staff_fields_cbo_item( $F, $F . '. ' . $lbl );
//}
//
//function abcfslcs_staff_fields_lbl_field_T( $tplateOptns, $F ){
//
//    $lbl = isset( $tplateOptns['_inputLbl_' . $F] ) ? esc_attr( $tplateOptns['_inputLbl_' . $F][0] ) : '';
//    //$fieldID = '_txt_' . $F;
//    return abcfsls_staff_fields_cbo_item( $F, $F . '. ' . $lbl );
//}
//
//function abcfslcs_staff_fields_lbl_field_H( $tplateOptns, $F ){
//
//    $lblLbl = isset( $tplateOptns['_lnkLblLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkLblLbl_' . $F][0] ) : '';
//    $urlLbl = isset( $tplateOptns['_lnkUrlLbl_' . $F] ) ? esc_attr( $tplateOptns['_lnkUrlLbl_' . $F][0] ) : '';
//
//    $lbl = $lblLbl;
//    if( empty( $lbl ) ) { $lbl = $urlLbl; }
//
//    return abcfsls_staff_fields_cbo_item( $F, $F . '. ' . $lbl );
//}