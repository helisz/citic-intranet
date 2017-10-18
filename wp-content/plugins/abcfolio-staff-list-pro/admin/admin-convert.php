<?php
/*
 * Admin tab: Convert Template.
 *
 */
//echo"<pre>", print_r($_POST), "</pre>"; die;
function abcfsl_admin_convert() {

    $obj = ABCFSL_Main();
    $slug = $obj->pluginSlug;

    $tplateID = 0;
    $newLayout = 0;

    //========================================
    if ( isset($_POST['btnConvert']) ){
        check_admin_referer( $slug . '_nonce' );

        $tplateID = (isset( $_POST['tplateID'] ) ? esc_attr($_POST['tplateID']) : 0);
        $newLayout = (isset( $_POST['newLayout'] ) ? esc_attr($_POST['newLayout']) : 0);

        abcfsl_admin_convert_save( $tplateID, $newLayout );
    }

    //========================================
    $cboTplates = abcfsl_dba_cbo_tplates( abcfsl_txta(244) );
    $cboPgLayout = abcfsl_cbo_staff_pg_layout();
    $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta_r(18), abcfsl_aurl(0), 'abcflFontWP abcflFontS12 abcflFontW400' );
    //--Form Start ------------------------
    echo abcfl_html_form( 'frm-tplate-convert', '');
    wp_nonce_field($slug . '_nonce');
    //-- Main Cntr DIV Start --------------
    echo abcfl_html_tag_cls('div', 'abcflMTop20 abcflMLeft30');

        echo abcfl_input_cbo('tplateID', '', $cboTplates, $tplateID, $lbl, '', '30%', true, '', '', 'abcflFldCntr abcflMTop40', 'abcflFldLbl');
        echo abcfl_input_cbo('newLayout', '', $cboPgLayout, $newLayout, abcfsl_txta_r(359), abcfsl_txta(361), '30%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');
        //Layout images
        echo abcfl_icon_cntr( ABCFSL_ICONS_URL, 'staff-list-layouts-pro.png', 'abcflMTop40 abcflMLeft10' );

        echo abcfl_input_hline('2', '30', '50P');
        //-- Button DIV Start --------------------------
        echo abcfl_html_tag('div','', 'submit' );
        echo abcfl_input_btn( 'btnConvert', 'btnConvert', 'submit', abcfsl_txta(362), 'button-primary abcficBtnWide' );

    //-- ENDs: Button, Form, Main Cntr ------------------------------------------------
    echo abcfl_html_tag_ends('div,form,div');
}

function abcfsl_admin_convert_save( $tplateID, $newLayout ) {

    $cptTtplate = 'cpt_staff_lst';
    $cptItem = 'cpt_staff_lst_item';

        $out['status'] = 'KO';
        $out['errorMsg'] = '';

        //All options selected.
        $out = abcfsl_admin_convert_check_optns( $tplateID, $newLayout );
        if( $out['status'] == 'KO' ){
            abcfl_autil_msg_err( $out['errorMsg'], false );
            return;
        }

        $out = abcfsl_admin_convert_check_post_types( $cptTtplate );
        if( $out['status'] == 'KO' ){
            abcfl_autil_msg_err( $out['errorMsg'], false );
        }

        $out = abcfsl_admin_convert_check_post_types( $cptItem );
        if( $out['status'] == 'KO' ){
            abcfl_autil_msg_err( $out['errorMsg'], false );
        }

        $out = abcfsl_admin_convert_tplate( $tplateID, $newLayout );
        if( $out['status'] == 'KO' ){
            abcfl_autil_msg_err( $out['errorMsg'], false );
        }

        $out['status'] = 'OK';

        if( $out['status'] == 'OK' ){
            abcfl_autil_msg_ok( 'OK' );
        }

        return ;
}

//Check convert options.
function abcfsl_admin_convert_check_optns( $tplateID, $newLayout ) {

   $out['status'] = 'KO';
   $out['errorMsg'] = abcfsl_txta(32) . '. ' . abcfsl_txta(360);

   if( $tplateID == 0 ){  return $out; }
   if( empty( $newLayout )){ return $out; }

   // Get source layout
   $tplateOptns = get_post_custom( $tplateID );
   $oldLayout = isset( $tplateOptns['_lstLayout'] ) ? $tplateOptns['_lstLayout'][0] : '0';

   if( $oldLayout == $newLayout ){
        $out['errorMsg'] = 'Error: Source and destination template types are the same.';
        return $out;
   }

   $out['status'] = 'OK';
   $out['errorMsg'] = '';
   return $out;
}

//Check if custom post type exist
function abcfsl_admin_convert_check_post_types( $cpt ) {

   if ( !post_type_exists( $cpt ) ) {
        $out['status'] = 'KO';
        $out['errorMsg'] = 'Error: Custom post type doesn\'t exist: ' . $cpt;
        return $out;
    }

    $out['status'] = 'OK';
    $out['errorMsg'] = '';

    return $out;
}

function abcfsl_admin_convert_tplate( $tplateID, $newLayout ) {

    //$lstLayoutH = isset( $_POST['lstLayoutH'] ) ? $_POST['lstLayoutH']  : '';
    //$lstLayout = isset( $_POST['lstLayout' ] ) ? $_POST['lstLayout' ]  : $lstLayoutH ;

    update_post_meta($tplateID, '_lstLayout', $newLayout);
    update_post_meta($tplateID, '_lstLayoutH', $newLayout);

    //Check updated layout
   $tplateOptns = get_post_custom( $tplateID );
   $tplateLayout = isset( $tplateOptns['_lstLayout'] ) ? $tplateOptns['_lstLayout'][0] : '0';

    if ( $tplateLayout != $newLayout ) {
        $out['status'] = 'KO';
        $out['errorMsg'] = 'Error: Layout not converted';
        return $out;
    }

    $out['status'] = 'OK';
    $out['errorMsg'] = '';

    return $out;

}
