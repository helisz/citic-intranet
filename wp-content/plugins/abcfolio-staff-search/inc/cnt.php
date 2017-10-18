<?php
/*
 * Cell data. Added CE
 */

//Returns data array.
function abcfsls_cnt_staff_field( $staffFieldType, $searchFieldType, $tplateOptns, $F, $staffMOptns, $staffF, $staffTOptns ){

    $out['SHOW'] = '';
    $out['SORT'] = '';
    $out['SEARCH'] = '';
    $out['SEARCH_F'] = $F;

    $par['newTab'] = isset( $tplateOptns['_newTab_' . $F] ) ? esc_attr( $tplateOptns['_newTab_' . $F][0] ) : '0';;
    $par['showLbl'] = isset( $tplateOptns['_showLbl_' . $F] ) ? esc_attr( $tplateOptns['_showLbl_' . $F][0] ) : 0;
    $par['noSearch'] = isset( $tplateOptns['_noSearch_' . $F] ) ? esc_attr( $tplateOptns['_noSearch_' . $F][0] ) : '0';
    $par['lblTxt'] = isset( $staffTOptns['_lblTxt_' . $staffF] ) ? esc_attr( $staffTOptns['_lblTxt_' . $staffF][0] ) : '';

    //echo"<pre>", print_r($staffTOptns), "</pre>";

//print_r($staffFieldType);
    switch ( $staffFieldType ){
         case 'MP':
            $out = abcfsls_cnt_staff_field_MP( $tplateOptns, $F, $staffMOptns, $staffF, $searchFieldType, $staffTOptns, $par, '1', $out );
            break;
        case 'T':
        case 'PT':
        case 'LT':
            $out = abcfsls_cnt_staff_field_T( $staffMOptns, $staffF, $searchFieldType, $par, '1', $out );
            break;
        case 'CE':
            $out = abcfsls_cnt_staff_field_CE( $staffMOptns, $staffF, $searchFieldType, $par, '1', $out );
            break;
        case 'H':
        case 'TH':
            $out = abcfsls_cnt_staff_field_H( $staffMOptns, $staffF, $searchFieldType, $staffFieldType, $par, '1', $out );
            break;
        case 'EM':
            $out = abcfsls_cnt_staff_field_EM( $staffMOptns, $staffF, $searchFieldType, $par, '1', $out );
            break;
        case 'SL':
            $out = abcfsls_cnt_staff_field_SL( $staffMOptns, $staffTOptns, $staffF, $searchFieldType, $par, '1', $out );
            break;
       default:
            break;
    }
    return $out;
}

//== Staff Fields content. START ========================================================
//Staff Field: Text
function abcfsls_cnt_staff_field_T( $staffMOptns, $staffF, $searchFieldType, $par, $errNo, $out ){

    switch ( $searchFieldType ){
        case 'T':
        case 'PT':
        case 'LT':
            //$out['SHOW'] = isset( $staffMOptns['_txt_' . $staffF] ) ? esc_attr( $staffMOptns['_txt_' . $staffF][0] ) : '';
            //HTML tags allowed
            $out['SHOW'] = isset( $staffMOptns['_txt_' . $staffF] ) ?  $staffMOptns['_txt_' . $staffF][0] : '';
            $out['SORT'] = $out['SHOW'];
            $out['SEARCH'] = $out['SHOW'];
            break;
       default:
           $out['SHOW'] = ( abcfsls_txt_err( $errNo ) );
            break;
    }

    if( $par['noSearch'] == 1 ) { $out['SEARCH'] = ''; }
    return $out;
}

function abcfsls_cnt_staff_field_CE( $staffMOptns, $staffF, $searchFieldType, $par, $errNo, $out ){

    $editorCnt = isset( $staffMOptns['_editorCnt_' . $staffF] ) ? esc_attr( $staffMOptns['_editorCnt_' . $staffF][0] ) : '';
    if(abcfl_html_isblank($editorCnt)) { return $out; }

    switch ( $searchFieldType ){
        case 'T':
            $out['SHOW'] = html_entity_decode($editorCnt);
            break;
       default:
           $out['SHOW'] = (abcfsls_txt_err( $errNo ));
            break;
    }
    if( $par['noSearch'] == 1 ) { $out['SEARCH'] = ''; }
    return $out;
}

// Staff Field: Hyperlink
function abcfsls_cnt_staff_field_H( $staffMOptns, $staffF, $searchFieldType, $staffFieldType, $par, $errNo, $out ){

    $url = isset( $staffMOptns['_url_' . $staffF] ) ? esc_attr( $staffMOptns['_url_' . $staffF][0] ) : '';
    if(empty($url)) { return $out;}

    $href = abcfsls_cnt_href_bldr( $url, $par['newTab'] );

    $urlTxt =  $href['url'];
    if( $par['showLbl'] == 1 ){
        $urlTxt = isset( $staffMOptns['_urlTxt_' . $staffF] ) ? esc_attr( $staffMOptns['_urlTxt_' . $staffF][0] ) : '';
        if( $staffFieldType == 'TH'  ){
            if( !empty( $par['lblTxt'] ) ) { $urlTxt = $par['lblTxt']; }
            //print_r( $staffFieldType . ' - ' . $urlTxt . ' . ' );
        }
    }

    switch ( $searchFieldType ){
        case 'T':
            $out['SHOW'] = $url;
            break;
        case 'H':
            $out['SHOW'] = abcfl_html_a_tag( $href['url'], $urlTxt, $href['target'], '', '', '', false );
            $out['SORT'] = $urlTxt;
            $out['SEARCH'] = $urlTxt;
            break;
       default:
             $out['SHOW'] = ( abcfsls_txt_err( $errNo ) );
            break;
    }

    if( $par['noSearch'] == 1 ) { $out['SEARCH'] = ''; }
    return $out;
}

//Get href parts: url + link text.
function abcfsls_cnt_href_bldr( $url, $newTab ){

    $out['url'] = $url;
    $out['target'] = '';

    if( $newTab == 1 ) { $out['target'] = '_blank'; }

    $targetNT = substr($url, 0, 2);
    if( $targetNT == 'NT' ) {
        $out['url'] = trim( substr( $url, 2 ) );
        $out['target'] = '_blank';
    }
    return $out;
}

// Staff Field: Email
function abcfsls_cnt_staff_field_EM( $staffMOptns, $staffF, $searchFieldType, $par, $errNo, $out ){

    $url = isset( $staffMOptns['_url_' . $staffF] ) ? esc_attr( $staffMOptns['_url_' . $staffF][0] ) : '';
    if(empty($url)) { return $out;}

    $urlTxt = $url;
    if( $par['showLbl'] == 1 ){
        $urlTxt = isset( $staffMOptns['_urlTxt_' . $staffF] ) ? esc_attr( $staffMOptns['_urlTxt_' . $staffF][0] ) : '';
    }

    switch ( $searchFieldType ){
        case 'T':
            $out['SHOW'] = $url;
            break;
        case 'EM':
            $out['SHOW'] = abcfsls_cnt_staff_field_txt_EM_helper( $url, $urlTxt );
            $out['SORT'] = $urlTxt;
            $out['SEARCH'] = $urlTxt;
           break;
       default:
            $out = (abcfsls_txt_err( $errNo ));
            break;
    }
    if( $par['noSearch'] == 1 ) { $out['SEARCH'] = ''; }

    return $out;
}

function abcfsls_cnt_staff_field_txt_EM_helper( $url, $urlTxt ){

    if( empty( $url ) ){ return ''; }
    $url = 'mailto:' . $url;
    return abcfl_html_a_tag($url, $urlTxt, '0', '', '', '', false);
}


//---MP builder START -------------------------------------------------------------
function abcfsls_cnt_staff_field_MP( $tplateOptns, $F, $staffMOptns, $staffF, $searchFieldType, $staffTOptns, $par, $errNo, $out ){

    //Data source: Staff List MP field
    //Output cell: T. Get parts and part order from MP settigs, staff template, list (L). orderLP1_F
    //Output cell: MP. Get parts and part order from MP settigs, search template. orderP1_F

//    $out['SHOW'] = '';
//    $out['SORT'] = '';
//    $out['SEARCH'] = '';
    switch ( $searchFieldType ){
        case 'T':
            $out['SHOW'] = abcfsls_cnt_staff_field_MP_txt( $staffMOptns, $staffF, $staffTOptns, $staffF, 'L' );
            $out['SEARCH'] = $out['SHOW'];
            $out['SORT'] = $out['SHOW'];
            break;
        case 'MP':
            $out['SHOW'] = abcfsls_cnt_staff_field_MP_txt( $staffMOptns, $staffF, $tplateOptns, $F, '' );
            $out['SEARCH'] = $out['SHOW'];
            $out['SORT'] = abcfsls_cnt_staff_field_MP_txt_sort( $staffMOptns, $staffF, $tplateOptns, $F );
            break;
       default:
            $out['SHOW'] = ( abcfsls_txt_err( $errNo ) );
            break;
    }
    if( $par['noSearch'] == 1 ) { $out['SEARCH'] = ''; }
    return $out;
}

function abcfsls_cnt_staff_field_MP_txt( $staffMOptns, $dataF, $optnsOrder, $orderF, $L ){

    $mp1 = isset( $staffMOptns['_mp1_' . $dataF] ) ? esc_attr( $staffMOptns['_mp1_' . $dataF][0] ) : '';
    $mp2 = isset( $staffMOptns['_mp2_' . $dataF] ) ? esc_attr( $staffMOptns['_mp2_' . $dataF][0] ) : '';
    $mp3 = isset( $staffMOptns['_mp3_' . $dataF] ) ? esc_attr( $staffMOptns['_mp3_' . $dataF][0] ) : '';
    $mp4 = isset( $staffMOptns['_mp4_' . $dataF] ) ? esc_attr( $staffMOptns['_mp4_' . $dataF][0] ) : '';

    if( abcfl_html_isblank( $mp1 ) && abcfl_html_isblank( $mp2 ) && abcfl_html_isblank( $mp3 ) && abcfl_html_isblank( $mp4 ) ) { return ''; }

    $parts = array();
    $par = abcfsls_cnt_MP_order( $optnsOrder, $orderF, $L );

    if( abcfsls_cnt_MP_field_not_empty( $par['orderP1'], $mp1 ) ) { $parts[1] = abcfsls_cnt_MP_field_array( $par['orderP1'], $mp1, $par['sfixP1'] ); }
    if( abcfsls_cnt_MP_field_not_empty( $par['orderP2'], $mp2 ) ) { $parts[2] = abcfsls_cnt_MP_field_array( $par['orderP2'], $mp2, $par['sfixP2'] ); }
    if( abcfsls_cnt_MP_field_not_empty( $par['orderP3'], $mp3 ) ) { $parts[3] = abcfsls_cnt_MP_field_array( $par['orderP3'], $mp3, $par['sfixP3'] ); }
    if( abcfsls_cnt_MP_field_not_empty( $par['orderP4'], $mp4 ) ) { $parts[4] = abcfsls_cnt_MP_field_array( $par['orderP4'], $mp4, $par['sfixP4'] ); }

    usort( $parts, 'abcfsls_cnt_MP_fields_fix_sort' );

    $name = '';
    foreach ($parts as $values) {
        foreach ($values as $key => $value) {
            switch ( $key ){
                case 'mp':
                    $name .= $value;
                    break;
                case 'sfix':
                    $name .= $value . ' ';
                    break;
                default:
                    break;
            }
        }
    }
    return trim($name);
}

function abcfsls_cnt_MP_order( $optns, $F, $L ){

    $out = array(
        'orderP1' => isset( $optns['_order' . $L . 'P1_' . $F] ) ? $optns['_order' . $L . 'P1_' . $F][0] : '0',
        'orderP2' => isset( $optns['_order' . $L . 'P2_' . $F] ) ? $optns['_order' . $L . 'P2_' . $F][0] : '0',
        'orderP3' => isset( $optns['_order' . $L . 'P3_' . $F] ) ? $optns['_order' . $L . 'P3_' . $F][0] : '0',
        'orderP4' => isset( $optns['_order' . $L . 'P4_' . $F] ) ? $optns['_order' . $L . 'P4_' . $F][0] : '0',
        'sfixP1' => isset( $optns['_sfix' . $L . 'P1_' . $F] ) ? esc_attr( $optns['_sfix' . $L . 'P1_' . $F][0] ) : '',
        'sfixP2' => isset( $optns['_sfix' . $L . 'P2_' . $F] ) ? esc_attr( $optns['_sfix' . $L . 'P2_' . $F][0] ) : '',
        'sfixP3' => isset( $optns['_sfix' . $L . 'P3_' . $F] ) ? esc_attr( $optns['_sfix' . $L . 'P3_' . $F][0] ) : '',
        'sfixP4' => isset( $optns['_sfix' . $L . 'P4_' . $F] ) ? esc_attr( $optns['_sfix' . $L . 'P4_' . $F][0] ) : ''
    );

    return $out;
}

function abcfsls_cnt_MP_field_not_empty( $order, $mp ){
    if( $order != 0 && !abcfl_html_isblank( $mp ) ){ return true; }
    return false;
}

function abcfsls_cnt_MP_field_array( $order, $mp, $sfix ){
    return array('order' => $order, 'mp' => $mp, 'sfix' => $sfix);
}

function abcfsls_cnt_MP_fields_fix_sort( $a, $b ){
    return $a['order'] - $b['order'];
}

//For sort column, data-sort
function abcfsls_cnt_staff_field_MP_txt_sort( $staffMOptns, $staffF, $tplateOptns, $F ){

    $forSort = isset( $tplateOptns['_forSort_' . $F] ) ? esc_attr( $tplateOptns['_forSort_' . $F][0] ) : '0';
    if($forSort == '0'){ return '';}

    $mp1 = isset( $staffMOptns['_mp1_' . $staffF] ) ? esc_attr( $staffMOptns['_mp1_' . $staffF][0] ) : '';
    $mp2 = isset( $staffMOptns['_mp2_' . $staffF] ) ? esc_attr( $staffMOptns['_mp2_' . $staffF][0] ) : '';
    $mp3 = isset( $staffMOptns['_mp3_' . $staffF] ) ? esc_attr( $staffMOptns['_mp3_' . $staffF][0] ) : '';
    $mp4 = isset( $staffMOptns['_mp4_' . $staffF] ) ? esc_attr( $staffMOptns['_mp4_' . $staffF][0] ) : '';

    if( abcfl_html_isblank( $mp1 ) && abcfl_html_isblank( $mp2 ) && abcfl_html_isblank( $mp3 ) && abcfl_html_isblank( $mp4 ) ) { return ''; }

    $parts = array();
    $par = abcfsls_cnt_MP_order_sort( $tplateOptns, $F );

    if( abcfsls_cnt_MP_field_not_empty( $par['orderP1'], $mp1 ) ) { $parts[1] = abcfsls_cnt_MP_field_array_sort( $par['orderP1'], $mp1 ); }
    if( abcfsls_cnt_MP_field_not_empty( $par['orderP2'], $mp2 ) ) { $parts[2] = abcfsls_cnt_MP_field_array_sort( $par['orderP2'], $mp2 ); }
    if( abcfsls_cnt_MP_field_not_empty( $par['orderP3'], $mp3 ) ) { $parts[3] = abcfsls_cnt_MP_field_array_sort( $par['orderP3'], $mp3 ); }
    if( abcfsls_cnt_MP_field_not_empty( $par['orderP4'], $mp4 ) ) { $parts[4] = abcfsls_cnt_MP_field_array_sort( $par['orderP4'], $mp4 ); }

    usort( $parts, 'abcfsls_cnt_MP_fields_fix_sort' );

    $name = '';
    foreach ($parts as $values) {
        foreach ($values as $key => $value) {
            switch ( $key ){
                case 'mp':
                    $name .= $value . ' ';
                    break;
                default:
                    break;
            }
        }
    }
    return trim($name);
}

function abcfsls_cnt_MP_order_sort( $tplateOptns, $F ){

    $out = array(
        'orderP1' => isset( $tplateOptns['_orderPS1_' . $F] ) ? $tplateOptns['_orderPS1_' . $F][0] : '0',
        'orderP2' => isset( $tplateOptns['_orderPS2_' . $F] ) ? $tplateOptns['_orderPS2_' . $F][0] : '0',
        'orderP3' => isset( $tplateOptns['_orderPS3_' . $F] ) ? $tplateOptns['_orderPS3_' . $F][0] : '0',
        'orderP4' => isset( $tplateOptns['_orderPS4_' . $F] ) ? $tplateOptns['_orderPS4_' . $F][0] : '0'
    );

    return $out;
}

function abcfsls_cnt_MP_field_array_sort( $order, $mp){
    return array('order' => $order, 'mp' => $mp);
}
//---MP builder END -----------------------------------------------------
//== Staff Fields content END ========================================================

//== Social START ========================================================
function abcfsls_cnt_staff_field_SL( $staffMOptns, $staffTOptns, $staffF, $searchFieldType, $par,  $errNo, $out ){

//    $par['newTab'] =
//    $par['showLbl'] =
//    $par['noSearch']

    $social = abcfsls_cnt_social_url_field_name( $staffTOptns, $staffF );

    //Get social link URL
    $url = isset( $staffMOptns[ $social['urlField'] ][0] ) ? $staffMOptns[ $social['urlField'] ][0]  : '';
    if( empty( $url ) ) { return $out; }

    $urlTxt = $url;
    if( $par['showLbl'] == 1 ){ $urlTxt = $social['hrefTxt']; }
    if( abcfl_html_isblank( $urlTxt ) ) { $urlTxt = $url; }


    $target = '';
    if( $par['newTab'] == 1 ) { $target = '_blank'; }

    switch ( $searchFieldType ){
        case 'T':
            $out['SHOW'] = $url;
            break;
        case 'H':
            $out['SHOW'] = abcfl_html_a_tag( $url, $urlTxt, $target, '', '', '', false);
            $out['SORT'] = $urlTxt;
            $out['SEARCH'] = $urlTxt;
            break;
        case 'EM':
           $out['SHOW'] = abcfsls_cnt_staff_field_txt_EM_helper( $url, $urlTxt );
           $out['SORT'] = $url;
           $out['SEARCH'] = $url;
           break;
        default:
            $out['SHOW'] = (abcfsls_txt_err( $errNo ));
            break;
    }

    if( $par['noSearch'] == 1 ) { $out['SEARCH'] = ''; }

    return $out;
}

function abcfsls_cnt_social_url_field_name( $staffTOptns, $staffF ){
//social2
    //$out = '';
    $out['urlField'] = '';
    $out['hrefTxt'] = '';

    switch ( $staffF ){
        case '_fbook':
            $out['urlField'] = '_fbookUrl';
            $out['hrefTxt'] = 'Facebook';
            break;
        case '_liked':
            $out['urlField'] = '_likedUrl';
            $out['hrefTxt'] = 'LinkedIn';
            break;
        case '_email':
            $out['urlField'] = '_emailUrl';
            $out['hrefTxt'] = 'Email';
            break;
        case '_twit':
            $out['urlField'] = '_twitUrl';
            $out['hrefTxt'] = 'Twitter';
            break;
        case '_googlePlus':
            $out['urlField'] = '_googlePlusUrl';
            $out['hrefTxt'] = 'Google+';
            break;
        case '_social1':
            $out['urlField'] = '_socialC1Url';
            $out['hrefTxt'] = isset( $staffTOptns['_social1'] ) ? esc_attr( $staffTOptns['_social1'][0] ) : '';
            break;
        case '_social2':
            $out['urlField'] = '_socialC2Url';
            $out['hrefTxt'] = isset( $staffTOptns['_social2'] ) ? esc_attr( $staffTOptns['_social2'][0] ) : '';
            break;
        case '_social3':
            $out['urlField'] = '_socialC3Url';
            $out['hrefTxt'] = isset( $staffTOptns['_social3'] ) ? esc_attr( $staffTOptns['_social3'][0] ) : '';
            break;
       default:
            break;
    }
    return $out;
}
//== Social END ========================================================
