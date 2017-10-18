<?php
//== Single Page START =====================================================
//Single Page base URL
function abcfsls_util_single_pg_base_url( $staffTOptns ){
    $sPageUrl = isset( $staffTOptns['_sPageUrl'] ) ? esc_attr( $staffTOptns['_sPageUrl'][0] ) : '';
    $sPgBaseUrl = '';
    if(!empty($sPageUrl)) { $sPgBaseUrl = $sPageUrl; }
    return $sPgBaseUrl;
}

//Link to a single page;
function abcfsls_util_spg_cell_cnt( $staffID, $linkToSingle, $cellCnt, $staffMOptns, $sPgBaseUrl, $searchFieldType, $staffTOptns ){

    if($linkToSingle != '1') { return $cellCnt; }

    $spgSPTL = abcfsls_util_single_pg_SPTL( $staffTOptns );

    $optnsSPg = abcfsls_util_sp_link_to_single_pg( $staffMOptns, $sPgBaseUrl, $staffID, $spgSPTL );

    switch ( $searchFieldType ){
        case 'T':
        case 'MP':
            $cellCnt = abcfsls_util_single_pg_a_tag( $optnsSPg, $cellCnt, $searchFieldType );
            break;
       default:
            break;
    }
    return $cellCnt;
}

//Get Single page Url if 'SP' used as url. Otherwise return URL as entered. $imgLnkL ?????
function abcfsls_util_sp_link_to_single_pg( $staffMOptns, $sPgBaseUrl, $staffID, $spgSPTL ){

    $out['hrefUrl'] = '';
    $out['target'] = '';
    $out['linkToSingle'] = false;

    // ---- Link to Single Page. --------------------------
    $imgLnkL = isset( $staffMOptns['_imgLnkL'] ) ? esc_attr( $staffMOptns['_imgLnkL'][0] ) : '0';
    $pretty = isset( $staffMOptns['_pretty'] ) ? esc_attr( $staffMOptns['_pretty'][0] ) : '';
    if( empty( $imgLnkL ) ) {
        $imgLnkL = $spgSPTL;
        if( empty( $imgLnkL ) ) {  return $out; }
    }

    if( $imgLnkL == 'SP' || $imgLnkL == 'NT SP') {

        if( abcfl_html_isblank( $sPgBaseUrl ) ) { return $out; }
        if($imgLnkL == 'NT SP') { $out['target'] = '_blank'; }

        if( abcfsl_util_is_single_pretty( $sPgBaseUrl, $pretty ) ) {
            $out['hrefUrl'] = trailingslashit( trailingslashit( $sPgBaseUrl ) . $pretty ) ;
        }
        else {
            //Add staff member ID single page url.
            $out['hrefUrl'] = abcfl_html_url( array('smid' => $staffID ), $sPgBaseUrl );
        }
        $out['linkToSingle'] = true;
        return $out;
    }

    //Full URL is used
    $out['linkToSingle'] = true;
    return abcfsls_util_get_target( $imgLnkL, $out );
}

//Check for NT prefix. ????????????????????????????
function abcfsls_util_get_target( $imgLnkL, $out ){

    $targetNT = substr($imgLnkL, 0, 2);
    if( $targetNT == 'NT' ) {
        $out['hrefUrl'] = trim( substr( $imgLnkL, 2 ) );
        $out['target'] = '_blank';
        return $out;
    }

    $out['hrefUrl'] = $imgLnkL;
    return $out;
}

//$out['SHOW'] = '';
//$out['SORT'] = '';
//$out['SEARCH'] = '';
function abcfsls_util_single_pg_a_tag( $optnsSPg, $cellCnt, $searchFieldType ){

    //No need for data-search if no Create link to a single page.
    if( !$optnsSPg['linkToSingle'] ) {

        $cellCnt['SEARCH'] = '';
        if( $searchFieldType == 'T' ) { $cellCnt['SORT'] = ''; }
        return $cellCnt;
    }
    if( empty($optnsSPg['hrefUrl'])) { return $cellCnt; }

    $cellCnt['SEARCH'] = $cellCnt['SHOW'];
    $cellCnt['SHOW'] = abcfl_html_a_tag( $optnsSPg['hrefUrl'], $cellCnt['SHOW'], $optnsSPg['target'],'', '', '', false);
    return $cellCnt;
}

function abcfsls_util_single_pg_SPTL( $staffTOptns ){

    $sPgLnkShow = isset( $staffTOptns['_sPgLnkShow'] ) ? $staffTOptns['_sPgLnkShow'][0] : 'N';
    $sPgLnkNT = isset( $staffTOptns['_sPgLnkNT'] ) ? $staffTOptns['_sPgLnkNT'][0] : '0';

    if( $sPgLnkShow == 'N') { return ''; }
    if( $sPgLnkShow == 'Y' && $sPgLnkNT == '1') { return 'NT SP'; }
    if( $sPgLnkShow == 'Y') { return 'SP'; }

    return '';
}
//== Single Page END =======================================================
//
//Returns classes
function abcfsls_util_cls_bldr( $clsPfix, $baseCls, $custCls ){

    if( !empty( $baseCls ) ){ $baseCls = $clsPfix . $baseCls; }
    return  trim( $baseCls . ' ' . $custCls );
}

//Get fieldOrder meta. Convert saved meta to array.
function abcfsls_util_field_order( $tplateOptns ){

    $fieldOrder = isset( $tplateOptns['_fieldOrder'] ) ? $tplateOptns['_fieldOrder'][0] : '';

    if( empty($fieldOrder) ){
        $outA = array();
        for ( $i = 1; $i <= 10; $i++ ) { $outA[$i] = 'F' . $i; }
        return $outA;
    }

    //Get array.
    $outA = unserialize($fieldOrder);

    // Array has duplicates
    if(count(array_unique( $outA ))<count( $outA )){
        $fieldOrderU = array_unique( $outA );
        $outA = array_combine(range(1, count( $fieldOrderU )), array_values( $fieldOrderU ));
    }
    return $outA;
    //[1] => F1 [2] => F4 [3] => F5
}
//==================================================
//If checked return string ($out1)
function abcfsls_util_checkbox_value( $in, $out1, $out0 ){
    if( $in == 1 ) { return ' ' . $out1; }
    return $out0;
}

function abcfsls_util_tbl_base_style( $style ){

    //if( abcfl_html_isblank( $style ) ) {return ''; }
    $out = '';
    switch ( $style ){
        case 'D':
            $out = '';
            break;
        case 'W':
            $out = ' wide';
            break;
        case 'N':
            $out = ' base';
            break;
        case 'C':
            $out = ' compact';
            break;
       default:
           break;
    }
    return $out;
}

function abcfsls_util_cls_generic( $cls, $baseName ){

    if( abcfl_html_isblank( $cls ) ) {return ''; }
    $out = '';

    switch ( $cls ){
        case 'D':
        case 'C':
            $out = '';
            break;
       default:
           $out = ' ' . $baseName . $cls;
           break;
    }
    return $out;
}

function abcfsls_util_cls_font_s_w( $cls, $baseName ){

    if( abcfl_html_isblank( $cls ) ) {return ''; }
    $out = '';

    switch ( $cls ){
        case 'D':
        case 'C':
            $out = '';
            break;
        case 'S12_W400':
        case 'S13_W400':
        case 'S14_W400':
        case 'S15_W400':
        case 'S16_W400':
        case 'S18_W400':
            $out = ' ' . $baseName . substr($cls, 0, 3)  . ' ' . $baseName . 'W400';
            break;
        case 'S12_W600':
        case 'S13_W600':
        case 'S14_W600':
        case 'S15_W600':
        case 'S16_W600':
        case 'S18_W600':
            $out = ' ' . $baseName . substr($cls, 0, 3)  . ' ' . $baseName . 'W600';
            break;
        case 'S12_W700':
        case 'S13_W700':
        case 'S14_W700':
        case 'S15_W700':
        case 'S16_W700':
        case 'S18_W700':
            $out = ' ' . $baseName . substr($cls, 0, 3)  . ' ' . $baseName . 'W700';
            break;
       default:
           break;
    }
    return $out;
}

//Get fieldOrder meta. Convert saved meta to array. Not used.
function abcfsls_util_no_search_fields( $tplateOptns ){

    $noSearchFields = array();

    //[1] => F1 [2] => F4 [3] => F5
    $fieldOrder = abcfsls_util_field_order( $tplateOptns );

    for ( $i = 1; $i <= 10; $i++ ) {
        $noSearch = isset( $tplateOptns['_noSearch_F' . $i] ) ? esc_attr( $tplateOptns['_noSearch_F' . $i][0] ) : 0;
        if( $noSearch == 1 ){
            //$noSearchFields[] = $i -1;
            $key = array_search('F' . $i, $fieldOrder);
            if( $key > 0 ) { $noSearchFields[] = $key; }
        }
    }

    return implode(',', $noSearchFields);
}

function abcfsls_util_class_name_bldr( $optnValue, $clsBaseName, $clsPfix, $default='' ){

    if( empty( $optnValue ) ) { return $default; }
    if( empty( $clsBaseName ) ) { return $default; }
    if( $optnValue == 'C' ) { return $default; }

    return $clsPfix . $clsBaseName . $optnValue;
}