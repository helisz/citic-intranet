<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSLS_MBox_MFilter {

    public function __construct() {
        add_action( 'add_meta_boxes_cptsls_mfilter', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_cptsls_mfilter', array( $this, 'save_post' ) );
    }

    public function add_meta_box() {
        add_meta_box(
            'abcfsls_mbox_cptsls_mfilter',
            abcfsls_txta(19),
            array( $this, 'display_mbox' ),
            'cptsls_mfilter',
            'normal',
            'high'
        );
    }

    public function display_mbox() {
        abcfsls_mbox_mfilter_tabs();
    }

    public function save_post( $postID ) {

        $obj = ABCFSLS_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {  return; }

//echo"<pre>", print_r($_POST), "</pre>";  die;

        //-- New record ? ------------------------------
        $mFilterType1 = isset( $_POST['mFilterType1'] ) ? $_POST['mFilterType1'] : '';
        $mFilterType2 = isset( $_POST['mFilterType2'] ) ? $_POST['mFilterType2'] : '';
        $mFilterType3 = isset( $_POST['mFilterType3'] ) ? $_POST['mFilterType3'] : '';
        $mFilterType4 = isset( $_POST['mFilterType4'] ) ? $_POST['mFilterType4'] : '';
        $mFilterType5 = isset( $_POST['mFilterType5'] ) ? $_POST['mFilterType5'] : '';
        $mFilterType6 = isset( $_POST['mFilterType6'] ) ? $_POST['mFilterType6'] : '';

        if ( empty( $mFilterType1 ) ){ return; }

        $tplateOptns = get_post_custom( $postID );
        $mFilterSaved1 = isset( $tplateOptns['_mFilterType1'] ) ? $tplateOptns['_mFilterType1'][0]  : '';

        //New record.
        if ( empty( $mFilterSaved1 ) ) {
            abcfl_mbsave_save_cbo( $postID, 'mFilterType1', '_mFilterType1', '');
            return;
        }

        $this->add_filter( $postID, $tplateOptns, $mFilterType2, '2' );
        $this->add_filter( $postID, $tplateOptns, $mFilterType3, '3' );
        $this->add_filter( $postID, $tplateOptns, $mFilterType4, '4' );
        $this->add_filter( $postID, $tplateOptns, $mFilterType5, '5' );
        $this->add_filter( $postID, $tplateOptns, $mFilterType6, '6' );

        //----------------------------
        $this->save_filter_optns( $postID, $mFilterType1, '1' );
        $this->save_filter_optns( $postID, $mFilterType2, '2' );
        $this->save_filter_optns( $postID, $mFilterType3, '3' );
        $this->save_filter_optns( $postID, $mFilterType4, '4' );
        $this->save_filter_optns( $postID, $mFilterType5, '5' );
        $this->save_filter_optns( $postID, $mFilterType6, '6' );

        //----------------------------------
        //abcfl_mbsave_save_txt($postID, 'mfFieldOrder', '_mfFieldOrder');
        //abcfl_mbsave_save_txt($postID, 'mfCboLbl1', '_mfCboLbl1');

        abcfl_mbsave_save_cbo( $postID, 'mfCntrJustify', '_mfCntrJustify', 'E');
        abcfl_mbsave_save_cbo( $postID, 'mfCntrMT', '_mfCntrMT', '');
        abcfl_mbsave_save_cbo( $postID, 'mfCntrMB', '_mfCntrMB', '');

        abcfl_mbsave_save_txt($postID, 'mfCntrCustCls', '_mfCntrCustCls');
        abcfl_mbsave_save_txt($postID, 'mfCntrCusStyle', '_mfCntrCusStyle');
        abcfl_mbsave_save_txt($postID, 'mfFrmGroupCustCls', '_mfFrmGroupCustCls');
        abcfl_mbsave_save_txt($postID, 'mfFrmGroupStyle', '_mfFrmGroupStyle');

        abcfl_mbsave_save_cbo( $postID, 'mfCboSize', '_mfCboSize' , '');
        abcfl_mbsave_save_cbo( $postID, 'mfSBtnColor', '_mfSBtnColor' , '');
        abcfl_mbsave_save_cbo( $postID, 'mfRBtnColor', '_mfRBtnColor' , '');

        abcfl_mbsave_save_txt($postID, 'mfLbl1', '_mfLbl1');
        abcfl_mbsave_save_txt($postID, 'mfLbl2', '_mfLbl2');
        abcfl_mbsave_save_txt($postID, 'mfLbl3', '_mfLbl3');
        abcfl_mbsave_save_txt($postID, 'mfLbl4', '_mfLbl4');
        abcfl_mbsave_save_txt($postID, 'mfLbl5', '_mfLbl5');
        abcfl_mbsave_save_txt($postID, 'mfLbl6', '_mfLbl6');

        abcfl_mbsave_save_txt($postID, 'mfSBtnTxt', '_mfSBtnTxt');
        abcfl_mbsave_save_txt($postID, 'mfRBtnTxt', '_mfRBtnTxt');

        abcfl_mbsave_save_txt($postID, 'mfNoDataMsg', '_mfNoDataMsg');
        abcfl_mbsave_save_txt($postID, 'mfHelpTxt', '_mfHelpTxt');
        abcfl_mbsave_save_cbo( $postID, 'mfHelpTxtF', '_mfHelpTxtF' , '');
        abcfl_mbsave_save_cbo( $postID, 'mfHelpTxtMT', '_mfHelpTxtMT' , '');

        abcfl_mbsave_save_txt( $postID, 'mfFrmAction', '_mfFrmAction');
    }
    //======================================================

    //Save filter if a new one, otherwise exit.
    private function add_filter( $postID, $tplateOptns, $mFilterType, $filterNo ) {

        if ( !empty( $mFilterType ) ){
            $isSaved = isset( $tplateOptns['_mFilterType' . $filterNo] ) ? $tplateOptns['_mFilterType' . $filterNo][0]  : '';

            if ( empty( $isSaved ) ) {
                abcfl_mbsave_save_cbo( $postID, 'mFilterType' . $filterNo, '_mFilterType' . $filterNo, '');
            }
        }
    }

    //Save filter options OR delete filter.
    private function save_filter_optns( $postID, $mFilterType, $filterNo ) {

        $hideDelete = ( isset( $_POST['mfHideDelete' . $filterNo]) ? $_POST['mfHideDelete' . $filterNo] : 'N' );
        if($hideDelete == 'D' && $filterNo != '1' ){
            $this->delete_filter( $postID, $filterNo );
            return;
        }

       switch ( $mFilterType ) {
                case 'C':
                    $this->save_cat( $postID, $filterNo );
                    break;
                case 'AZ':
                    $this->save_az( $postID, $filterNo );
                    break;
                case 'TXT':
                    $this->save_txt( $postID, $filterNo );
                    break;
                case 'TXTM':
                    $this->save_txt_m( $postID, $filterNo );
                    break;
                case 'DROP':
                    $this->save_custom_drop( $postID, $filterNo );
                    break;
                default:
                    break;
        }
    }

    private function save_cat( $postID, $filterNo ) {

        $old = get_post_meta( $postID, '_catSlugs' . $filterNo, true );
        $new = array();

        $slugs = $_POST['catSlug' . $filterNo];
        $count = count( $slugs );

        for ( $i = 0; $i < $count; $i++ ) {
            if ( $slugs[$i] != '' ) {
                $new[$i]['catSlug' . $filterNo] = sanitize_title( $slugs[$i] ); }
        }

        if ( !empty( $new ) && $new != $old ){
                update_post_meta( $postID, '_catSlugs' . $filterNo, $new );
        }

        if ( empty($new) && $old ){
                delete_post_meta( $postID, '_catSlugs' . $filterNo, $old );
        }

        abcfl_mbsave_save_txt($postID, 'catTxtAll' . $filterNo, '_catTxtAll' . $filterNo );
        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');
    }

    private function save_custom_drop( $postID, $filterNo ) {

        $items = ( isset( $_POST['dropItem' . $filterNo]) ? $_POST['dropItem' . $filterNo] : array() );

        //$items = $_POST['dropItem' . $filterNo];
        $items = array_filter($items);
        $count = count( $items );

        if( $count == 0 ) {
            delete_post_meta( $postID, '_dropItems' . $filterNo );
        }
        else {

            foreach ( $items as $key => $value  ) {
                 $items[$key] = sanitize_text_field( $value );
            }

            update_post_meta( $postID, '_dropItems' . $filterNo, $items );
        }

        abcfl_mbsave_save_txt($postID, 'dropTxtAll' . $filterNo, '_dropTxtAll' . $filterNo );
        abcfl_mbsave_save_cbo( $postID, 'slFieldNo' . $filterNo, '_slFieldNo' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slFieldType' . $filterNo, '_slFieldType' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');
    }

    private function save_az( $postID, $filterNo ) {

        abcfl_mbsave_save_txt($postID, 'azTxtAll' . $filterNo, '_azTxtAll' . $filterNo );
        abcfl_mbsave_save_txt($postID, 'azItems' . $filterNo, '_azItems' . $filterNo );
        abcfl_mbsave_save_cbo( $postID, 'slFieldNo' . $filterNo, '_slFieldNo' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slFieldType' . $filterNo, '_slFieldType' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');
    }

    private function save_txt( $postID, $filterNo ) {

        abcfl_mbsave_save_cbo( $postID, 'minLen' . $filterNo, '_minLen' . $filterNo, 3);
        abcfl_mbsave_save_cbo( $postID, 'slFieldNo' . $filterNo, '_slFieldNo' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slFieldType' . $filterNo, '_slFieldType' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');
    }

    private function save_txt_m( $postID, $filterNo ) {

        abcfl_mbsave_save_cbo( $postID, 'minLen' . $filterNo, '_minLen' . $filterNo, 3);

        abcfl_mbsave_save_cbo( $postID, 'slMField1No' . $filterNo, '_slMField1No' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slMField1Type' . $filterNo, '_slMField1Type' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'slMField2No' . $filterNo, '_slMField2No' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slMField2Type' . $filterNo, '_slMField2Type' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'slMField3No' . $filterNo, '_slMField3No' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slMField3Type' . $filterNo, '_slMField3Type' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'slMField4No' . $filterNo, '_slMField4No' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slMField4Type' . $filterNo, '_slMField4Type' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'slMField5No' . $filterNo, '_slMField5No' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slMField5Type' . $filterNo, '_slMField5Type' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'slMField6No' . $filterNo, '_slMField6No' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'slMField6Type' . $filterNo, '_slMField6Type' . $filterNo, '');

        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');
    }

    private function delete_filter( $postID, $filterNo ) {

        delete_post_meta( $postID, '_mFilterType' . $filterNo );
        delete_post_meta( $postID, '_mfHideDelete' . $filterNo );

        delete_post_meta( $postID, '_azTxtAll' . $filterNo );
        delete_post_meta( $postID, '_azItems' . $filterNo );
        delete_post_meta( $postID, '_azFieldID' . $filterNo );
        delete_post_meta( $postID, '_azFieldType' . $filterNo );

        delete_post_meta( $postID, '_catSlugs' . $filterNo );
        delete_post_meta( $postID, '_catTxtAll' . $filterNo );

        delete_post_meta( $postID, '_minLen' . $filterNo );
        delete_post_meta( $postID, '_slFieldNo' . $filterNo );
        delete_post_meta( $postID, '_slFieldType' . $filterNo );

        delete_post_meta( $postID, '_slMField1No' . $filterNo );
        delete_post_meta( $postID, '_slMField1Type' . $filterNo );
        delete_post_meta( $postID, '_slMField2No' . $filterNo );
        delete_post_meta( $postID, '_slMField2Type' . $filterNo );
        delete_post_meta( $postID, '_slMField3No' . $filterNo );
        delete_post_meta( $postID, '_slMField3Type' . $filterNo );
        delete_post_meta( $postID, '_slMField4No' . $filterNo );
        delete_post_meta( $postID, '_slMField4Type' . $filterNo );
        delete_post_meta( $postID, '_slMField5No' . $filterNo );
        delete_post_meta( $postID, '_slMField5Type' . $filterNo );
        delete_post_meta( $postID, '_slMField6No' . $filterNo );
        delete_post_meta( $postID, '_slMField6Type' . $filterNo );

        delete_post_meta( $postID, '_dropTxtAll' . $filterNo );
        delete_post_meta( $postID, '_dropItems' . $filterNo );
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        if ( !current_user_can('edit_pages', $postID) ) { return false; };

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }

}


//private function save_custom_drop_OLD( $postID, $filterNo ) {
//
//        $old = get_post_meta( $postID, '_dropItems' . $filterNo, true );
//        $new = array();
//
//        $items = $_POST['dropItem' . $filterNo];
//        $count = count( $items );
//
//        for ( $i = 0; $i < $count; $i++ ) {
//            if ( $items[$i] != '' ) {
//                $new[$i]['dropItem' . $filterNo] = sanitize_text_field( $items[$i] ); }
//        }
//$items = array_filter($items);
//
//
//update_post_meta( $postID, '_dropItems' . $filterNo, $items );
//$old = get_post_meta( $postID, '_dropItems' . $filterNo, true );
//
//echo"<pre>", print_r($old), "</pre>";  die;
//
//
//
//
//
//        if ( !empty( $new ) && $new != $old ){
//                update_post_meta( $postID, '_dropItems' . $filterNo, $new );
//        }
//
//        if ( empty($new) && $old ){
//                delete_post_meta( $postID, '_dropItems' . $filterNo, $old );
//        }
//
//        abcfl_mbsave_save_txt($postID, 'dropTxtAll' . $filterNo, '_dropTxtAll' . $filterNo );
//        abcfl_mbsave_save_cbo( $postID, 'dropFieldNo' . $filterNo, '_dropFieldNo' . $filterNo, '');
//        abcfl_mbsave_save_cbo( $postID, 'dropFieldType' . $filterNo, '_dropFieldType' . $filterNo, '');
//        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');;
//    }