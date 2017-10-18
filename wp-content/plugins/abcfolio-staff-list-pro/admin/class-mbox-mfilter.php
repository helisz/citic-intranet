<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSL_MBox_MFilter {

    public function __construct() {
        add_action( 'add_meta_boxes_cpt_staff_mfilter', array( $this, 'add_meta_box' ) );
        add_action( 'save_post_cpt_staff_mfilter', array( $this, 'save_post' ) );
    }

    public function add_meta_box() {
        add_meta_box(
            'abcfsl_mbox_staff_mfilter',
            abcfsl_txta(100),
            array( $this, 'display_mbox' ),
            'cpt_staff_mfilter',
            'normal',
            'high'
        );
    }

    public function display_mbox() {
        abcfsl_mbox_mfilter_tabs();
    }

    public function save_post( $postID ) {

        $obj = ABCFSL_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {  return; }

//echo"<pre>", print_r($_POST), "</pre>";  die;

        //-- New record ? ------------------------------
        $mFilterType1 =  isset( $_POST['mFilterType1'] ) ? $_POST['mFilterType1'] : '';
        $mFilterType2 = isset( $_POST['mFilterType2'] ) ? $_POST['mFilterType2']  : '';
        //$mFilterType3 = isset( $_POST['mFilterType3'] ) ? $_POST['mFilterType3']  : '';

        if ( empty( $mFilterType1 ) ){ return; }

        $tplateOptns = get_post_custom( $postID );
        $mFilterSaved1 = isset( $tplateOptns['_mFilterType1'] ) ? $tplateOptns['_mFilterType1'][0]  : '';

        //New record.
        if ( empty( $mFilterSaved1 ) ) {
            abcfl_mbsave_save_cbo( $postID, 'mFilterType1', '_mFilterType1', '');
            return;
        }

        if ( !empty( $mFilterType2 ) ){
            $mFilterSaved2 = isset( $tplateOptns['_mFilterType2'] ) ? $tplateOptns['_mFilterType2'][0]  : '';
            if ( empty( $mFilterSaved2 ) ) {
                abcfl_mbsave_save_cbo( $postID, 'mFilterType2', '_mFilterType2', '');
            }
        }

        //----------------------------
        $this->save_filter_optns( $postID, $mFilterType1, '1' );
        $this->save_filter_optns( $postID, $mFilterType2, '2' );
        //----------------------------------
        abcfl_mbsave_save_txt($postID, 'mfCboLbl1', '_mfCboLbl1');

        abcfl_mbsave_save_cbo( $postID, 'mfCntrJustify', '_mfCntrJustify', 'E');
        abcfl_mbsave_save_cbo( $postID, 'mfCntrMT', '_mfCntrMT', '');
        abcfl_mbsave_save_cbo( $postID, 'mfCntrMB', '_mfCntrMB', '');

        abcfl_mbsave_save_cbo( $postID, 'mfCboSize', '_mfCboSize' , '');
        abcfl_mbsave_save_cbo( $postID, 'mfBtnColor', '_mfBtnColor' , '');

        abcfl_mbsave_save_txt($postID, 'mfCboLbl1', '_mfCboLbl1');
        abcfl_mbsave_save_txt($postID, 'mfCboLbl2', '_mfCboLbl2');
        abcfl_mbsave_save_txt($postID, 'mfBtnTxt', '_mfBtnTxt');

        abcfl_mbsave_save_txt($postID, 'mfNoDataMsg', '_mfNoDataMsg');
        abcfl_mbsave_save_txt($postID, 'mfHelpTxt', '_mfHelpTxt');
        abcfl_mbsave_save_cbo( $postID, 'mfHelpTxtF', '_mfHelpTxtF' , '');
        abcfl_mbsave_save_cbo( $postID, 'mfHelpTxtMT', '_mfHelpTxtMT' , '');

        // ACTION
        abcfl_mbsave_save_txt( $postID, 'mfFrmAction', '_mfFrmAction');
    }

    //======================================================
    private function save_filter_optns( $postID, $mFilterType, $filterNo ) {

        $hideDelete = ( isset( $_POST['mfHideDelete' . $filterNo]) ? $_POST['mfHideDelete' . $filterNo] : 'N' );
        if($hideDelete == 'D' && $filterNo != '1' ){
            $this->delete_fields( $postID, $filterNo );
            return;
        }

       switch ( $mFilterType ) {
                case 'C':
                    $this->save_cat( $postID, $filterNo );
                    break;
                case 'AZ':
                    $this->save_az( $postID, $filterNo );
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

    private function save_az( $postID, $filterNo ) {

        abcfl_mbsave_save_txt($postID, 'azTxtAll' . $filterNo, '_azTxtAll' . $filterNo );
        abcfl_mbsave_save_txt($postID, 'azItems' . $filterNo, '_azItems' . $filterNo );
        abcfl_mbsave_save_cbo( $postID, 'azFieldID' . $filterNo, '_azFieldID' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'azFieldType' . $filterNo, '_azFieldType' . $filterNo, '');
        abcfl_mbsave_save_cbo( $postID, 'mfHideDelete' . $filterNo, '_mfHideDelete' . $filterNo, 'N');
    }

    private function delete_fields( $postID, $filterNo ) {

        delete_post_meta( $postID, '_mFilterType' . $filterNo );
        delete_post_meta( $postID, '_mfHideDelete' . $filterNo );

        delete_post_meta( $postID, '_azTxtAll' . $filterNo );
        delete_post_meta( $postID, '_azItems' . $filterNo );
        delete_post_meta( $postID, '_azFieldID' . $filterNo );
        delete_post_meta( $postID, '_azFieldType' . $filterNo );

        delete_post_meta( $postID, '_catSlugs' . $filterNo );
        delete_post_meta( $postID, '_catTxtAll' . $filterNo );
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        if ( !current_user_can('edit_pages', $postID) ) { return false; };

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }

}
