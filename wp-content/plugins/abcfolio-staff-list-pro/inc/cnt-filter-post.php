<?php
function abcfsl_cnt_filter_post( $menuNo ){

    $filters[1] = '';
    $filters[2] = '';
    $filters[3] = '';
    $filters[4] = '';
    $filters[5] = '';
    $filters[6] = '';
    //-------------------------
    if ( isset($_POST['mfSearchBtn']) ){
        $filters = abcfsl_cnt_filter_post_search( $filters );
    }
    else {
        $filters = abcfsl_cnt_filter_post_new( $menuNo, $filters );
    }
    return $filters;
}

function abcfsl_cnt_filter_post_search( $filters ){

    if ( isset( $_POST['mFilterNonceField'] ) && wp_verify_nonce( $_POST['mFilterNonceField'], 'mFilterNonce' ) ) {

        $filters[1] = (isset( $_POST['staffFilter1'] ) ? $_POST['staffFilter1'] : '');
        $filters[2] = (isset( $_POST['staffFilter2'] ) ? $_POST['staffFilter2'] : '');
        $filters[3] = (isset( $_POST['staffFilter3'] ) ? $_POST['staffFilter3'] : '');
        $filters[4] = (isset( $_POST['staffFilter4'] ) ? $_POST['staffFilter4'] : '');
        $filters[5] = (isset( $_POST['staffFilter5'] ) ? $_POST['staffFilter5'] : '');
        $filters[6] = (isset( $_POST['staffFilter6'] ) ? $_POST['staffFilter6'] : '');

        $filters[1] = $value = strtolower( stripslashes( sanitize_text_field( $filters[1] ) ) );
        $filters[2] = $value = strtolower( stripslashes( sanitize_text_field( $filters[2] ) ) );
        $filters[3] = $value = strtolower( stripslashes( sanitize_text_field( $filters[3] ) ) );
        $filters[4] = $value = strtolower( stripslashes( sanitize_text_field( $filters[4] ) ) );
        $filters[5] = $value = strtolower( stripslashes( sanitize_text_field( $filters[5] ) ) );
        $filters[6] = $value = strtolower( stripslashes( sanitize_text_field( $filters[6] ) ) );
    }

    return $filters;
}

function abcfsl_cnt_filter_post_new( $menuNo, $filters ){

//Initial page load. Get default values.
          //$menuNo = CAT-6374
          $menuType = substr( $menuNo, 0, 3 );
          if( $menuType == 'MTF' ){

            $menuID = substr( $menuNo, 4 );
            $filterOptns = get_post_custom( $menuID );

            $filterType1 = isset( $filterOptns['_mFilterType1'] ) ? $filterOptns['_mFilterType1'][0]  : '';
            $filterType2 = isset( $filterOptns['_mFilterType2'] ) ? $filterOptns['_mFilterType2'][0]  : '';
            $filterType3 = isset( $filterOptns['_mFilterType3'] ) ? $filterOptns['_mFilterType3'][0]  : '';

            $hasAll1 = abcfsl_cnt_filter_has_all( $filterOptns, $filterType1, '1' );
            $hasAll2 = abcfsl_cnt_filter_has_all( $filterOptns, $filterType2, '2' );
            $hasAll3 = abcfsl_cnt_filter_has_all( $filterOptns, $filterType3, '3' );

            //all records option set for both filters.
            if( $hasAll1 & $hasAll2 & $hasAll3 ) { return $filters; }

            //-- ALL not used for both filters. Get first option. -----------------------
            if( !$hasAll1 ){
                $initialFilter1 = abcfsl_cnt_filter_initial_value( $filterOptns, $filterType1, '1' );
                if( !empty( $initialFilter1 ) ) { $filters[1] = $initialFilter1; }
            }

            if( !$hasAll2 ){
                $initialFilter2 = abcfsl_cnt_filter_initial_value( $filterOptns, $filterType2, '2' );
                if( !empty( $initialFilter2 ) ) { $filters[2] = $initialFilter2; }
            }

            if( !$hasAll3 ){
                $initialFilter3 = abcfsl_cnt_filter_initial_value( $filterOptns, $filterType3, '3' );
                if( !empty( $initialFilter3 ) ) { $filters[3] = $initialFilter3; }
            }
          }

    return $filters;
}

//Check if ALL records option is selected
function abcfsl_cnt_filter_has_all( $filterOptns, $filterType, $filterNo ){

    $out = false;
    switch ( $filterType ){
        case 'C':
            $out = abcfsl_cnt_filter_all_check( $filterOptns, '_catTxtAll', $filterNo );
            break;
        case 'AZ':
            $out = abcfsl_cnt_filter_all_check( $filterOptns, '_azTxtAll', $filterNo );
            break;
        case 'TXT':
            $out = true;
            break;
       default:
            break;
    }
    return $out;
}

function abcfsl_cnt_filter_all_check( $filterOptns, $field, $filterNo ){

    $out = isset( $filterOptns[$field . $filterNo] ) ? esc_attr( $filterOptns[$field . $filterNo][0] ) : false;
    if(!empty( $out )) { $out = true; }
    return $out;
}

function abcfsl_cnt_filter_initial_value( $filterOptns, $filterType, $filterNo ){

    $out = '';
    switch ( $filterType ){
        case 'C':
            $out = abcfsl_cnt_filter_initial_value_c( $filterOptns, $filterNo );
            break;
        case 'AZ':
            $out = abcfsl_cnt_filter_initial_value_az( $filterOptns, $filterNo );
            break;
       default:
            break;
    }
    return $out;}

function abcfsl_cnt_filter_initial_value_c( $filterOptns, $filterNo ){

    $catSlugs = isset( $filterOptns['_catSlugs' . $filterNo] ) ? $filterOptns['_catSlugs' . $filterNo][0]  : '';
    $filterSlugs = unserialize( $catSlugs );
    if ( empty( $filterSlugs ) ){ return ''; }

    $filterSlug = '';

    foreach ( $filterSlugs as $slug ) {
        $filterSlug = $slug['catSlug' . $filterNo];
        break;
    }
    return $filterSlug;
}

function abcfsl_cnt_filter_initial_value_az( $filterOptns, $filterNo ){

    $azItems = isset( $filterOptns['_azItems' . $filterNo] ) ? esc_attr( $filterOptns['_azItems' . $filterNo][0] ) : '';

    $azItemsArray = explode(',', $azItems);
    if ( empty( $azItemsArray ) ){ return ''; }

    return $azItemsArray[0];
}

function abcfsl_cnt_filter_post_search_OLD( $filters ){

    if ( isset( $_POST['mFilterNonceField'] ) && wp_verify_nonce( $_POST['mFilterNonceField'], 'mFilterNonce' ) ) {
//        $filters[1] = (isset( $_POST['staffFilter1'] ) ? esc_attr($_POST['staffFilter1']) : '');
//        $filters[2] = (isset( $_POST['staffFilter2'] ) ? esc_attr($_POST['staffFilter2']) : '');
//        //$filters[3] = (isset( $_POST['staffFilter3'] ) ? esc_attr($_POST['staffFilter3']) : '');
//        $filters[3] = (isset( $_POST['staffFilter3'] ) ? $_POST['staffFilter3'] : '');
//        $filters[4] = (isset( $_POST['staffFilter4'] ) ? esc_attr($_POST['staffFilter4']) : '');
//        $filters[5] = (isset( $_POST['staffFilter5'] ) ? esc_attr($_POST['staffFilter5']) : '');
//        $filters[6] = (isset( $_POST['staffFilter6'] ) ? esc_attr($_POST['staffFilter6']) : '');

        //$filters[3] = stripslashes_deep( $filters[3] );

        $filters[1] = stripslashes( isset( $_POST['staffFilter1'] ) ? $_POST['staffFilter1'] : '' );
        $filters[2] = stripslashes( isset( $_POST['staffFilter2'] ) ? $_POST['staffFilter2'] : '');
        $filters[3] = stripslashes( isset( $_POST['staffFilter3'] ) ? $_POST['staffFilter3'] : '');
        $filters[4] = stripslashes( isset( $_POST['staffFilter4'] ) ? $_POST['staffFilter4'] : '');
        $filters[5] = stripslashes( isset( $_POST['staffFilter5'] ) ? $_POST['staffFilter5'] : '');
        $filters[6] = stripslashes( isset( $_POST['staffFilter6'] ) ? $_POST['staffFilter6'] : '');

//        $filters[1] = (isset( $_POST['staffFilter1'] ) ? $_POST['staffFilter1'] : '');
//        $filters[2] = (isset( $_POST['staffFilter2'] ) ? $_POST['staffFilter2'] : '');
//        $filters[3] = (isset( $_POST['staffFilter3'] ) ? $_POST['staffFilter3'] : '');
//        $filters[4] = (isset( $_POST['staffFilter4'] ) ? $_POST['staffFilter4'] : '');
//        $filters[5] = (isset( $_POST['staffFilter5'] ) ? $_POST['staffFilter5'] : '');
//        $filters[6] = (isset( $_POST['staffFilter6'] ) ? $_POST['staffFilter6'] : '');

    }
    return $filters;
}