<?php
if ( ! defined( 'ABSPATH' ) ) {exit;}
class ABCFSLS_MBox_Tbl {

    public function __construct() {
        add_action( 'add_meta_boxes_cptsls_tbl_a', array( $this, 'add_meta_box_a' ) );
        add_action( 'save_post_cptsls_tbl_a', array( $this, 'save_post' ) );

        add_action( 'add_meta_boxes_cptsls_tbl_c', array( $this, 'add_meta_box_c' ) );
        add_action( 'save_post_cptsls_tbl_c', array( $this, 'save_post' ) );
    }

    public function add_meta_box_c() {

        add_meta_box(
            'abcfsls_mbox_tbl_c',
            abcfsls_txta(19),
            array( $this, 'render_mbox_tbl_optns_c' ),
            'cptsls_tbl_c',
            'normal',
            'high'
        );
        add_meta_box(
            'abcfsls_mbox_tbl_c_fields',
            abcfsls_txta(31),
            array( $this, 'render_mbox_fields' ),
            'cptsls_tbl_c',
            'normal',
            'default'
        );
    }

    public function add_meta_box_a() {

        add_meta_box(
            'abcfsls_mbox_tbl_all',
            abcfsls_txta(19),
            array( $this, 'render_mbox_tbl_optns_a' ),
            'cptsls_tbl_a',
            'normal',
            'high'
        );
        add_meta_box(
            'abcfsls_mbox_tbl_all_fields',
            abcfsls_txta(31),
            array( $this, 'render_mbox_fields' ),
            'cptsls_tbl_a',
            'normal',
            'default'
        );
    }

    //===========================================================

    public function render_mbox_tbl_optns_a() {
        abcfsls_mbox_tbl_a_tabs();
    }

    public function render_mbox_tbl_optns_c() {
        abcfsls_mbox_tbl_c_tabs();
    }

    public function render_mbox_fields() {
        abcfsls_mbox_field_tabs();
    }

    public function save_post( $postID ) {

        $obj = ABCFSLS_Main();
        $slug = $obj->pluginSlug;

        //Exit if user doesn't have permission to save
        if (!$this->user_can_save( $postID, $slug . '_nonce', $slug ) ) {
            return;
        }

        //Save data.---------------------------------------------
//echo"<pre>", print_r($_POST), "</pre>";  die;

        abcfl_mbsave_save_cbo( $postID, 'staffTplateID', '_staffTplateID', '0');
        abcfl_mbsave_save_cbo( $postID, 'catMenuID', '_catMenuID', '0');

        abcfl_mbsave_save_txt($postID, 'lblSearch', '_lblSearch');
        abcfl_mbsave_save_txt($postID, 'lblNoRecords', '_lblNoRecords');
        abcfl_mbsave_save_txt($postID, 'lblPrevious', '_lblPrevious');
        abcfl_mbsave_save_txt($postID, 'lblNext', '_lblNext');
        abcfl_mbsave_save_txt($postID, 'lblLoad', '_lblLoad');

        abcfl_mbsave_save_cbo( $postID, 'tblBaseStyle', '_tblBaseStyle', 'N');
        abcfl_mbsave_save_cbo( $postID, 'txtDir', '_txtDir', 'L');


        abcfl_mbsave_save_chekbox($postID, 'tblResponsive', '_tblResponsive');
        abcfl_mbsave_save_chekbox($postID, 'tblNoWrap', '_tblNoWrap');

        abcfl_mbsave_save_chekbox($postID, 'tblSearching', '_tblSearching');
        abcfl_mbsave_save_chekbox($postID, 'searchHlight', '_searchHlight');

        //$unchecked = true; if (isset( $_POST[ 'tblSearching' ])){ $unchecked = false; }

        abcfl_mbsave_save_chekbox($postID, 'tblOrdering', '_tblOrdering');
        abcfl_mbsave_save_chekbox($postID, 'tblOrderCol', '_tblOrderCol');
        //Intial sort order (column number)
        abcfl_mbsave_save_cbo( $postID, 'initOrder', '_initOrder', '0');

        abcfl_mbsave_save_chekbox($postID, 'tblStripe', '_tblStripe');
        //abcfl_mbsave_save_chekbox($postID, 'hasFooter', '_hasFooter');

        abcfl_mbsave_save_txt($postID, 'tblCustCls', '_tblCustCls');

        abcfl_mbsave_save_cbo( $postID, 'tblHdrBkgColor', '_tblHdrBkgColor', 'D');
        abcfl_mbsave_save_cbo( $postID, 'tblHdrFSize', '_tblHdrFSize', 'D');
        abcfl_mbsave_save_cbo( $postID, 'tblHdrFColor', '_tblHdrFColor', 'D');

        abcfl_mbsave_save_cbo( $postID, 'tblBdyFSize', '_tblBdyFSize', 'D');
        abcfl_mbsave_save_cbo( $postID, 'tblBdyFColor', '_tblBdyFColor', 'D');

        abcfl_mbsave_save_chekbox($postID, 'paging', '_paging');
        abcfl_mbsave_save_int($postID, 'pgLength', '_pgLength');

        abcfl_mbsave_save_chekbox($postID, 'btnPrint', '_btnPrint');
        abcfl_mbsave_save_chekbox($postID, 'printAuto', '_printAuto');
        abcfl_mbsave_save_cbo( $postID, 'printFS', '_printFS', '12');

        abcfl_mbsave_save_chekbox($postID, 'btnPdf', '_btnPdf');
        abcfl_mbsave_save_cbo( $postID, 'pdfOrient', '_pdfOrient', 'landscape');
        abcfl_mbsave_save_cbo( $postID, 'pdfFS', '_pdfFS', '10');
        abcfl_mbsave_save_cbo( $postID, 'pdfPgSize', '_pdfPgSize', 'LETTER');
        abcfl_mbsave_save_cbo( $postID, 'pdfPgMargin', '_pdfPgMargin', '40');

        abcfl_mbsave_save_chekbox($postID, 'btnExcel', '_btnExcel');
        abcfl_mbsave_save_chekbox($postID, 'btnCsv', '_btnCsv');

        abcfl_mbsave_save_txt($postID, 'tblCntrW', '_tblCntrW');
        abcfl_mbsave_save_txt($postID, 'tblCntrTM', '_tblCntrTM');

        for ( $i = 1; $i <= 10; $i++ ) {
            $this->save_line_option( $postID, 'F' . $i );
        }
    }

    private function save_line_option( $postID, $F ) {

    //New field type not selected.
    $fieldTypeH = ( isset( $_POST['fieldTypeH_' . $F ]) ? esc_attr( $_POST['fieldTypeH_' . $F ] ) : 'N' );
    $fieldType = ( isset( $_POST['fieldType_' . $F ]) ? esc_attr( $_POST['fieldType_' . $F ] ) : $fieldTypeH );

    if ( $fieldType == 'N' ){ return 0; }

    //Add new field. Hidden field type not set. Field type is selected.
    if ($fieldTypeH == 'N'){
        //Add new field.
        abcfl_mbsave_save_cbo( $postID, 'fieldType_' . $F, '_fieldType_' . $F, 'N');
        abcfl_mbsave_save_field( $postID, '_fieldTypeH_' . $F, $fieldType);
        return 0;
    }

    //Checkbox Locked
    if (isset( $_POST['lineLocked_' . $F ])){
        abcfl_mbsave_save_chekbox($postID, 'lineLocked_' . $F, '_fieldLocked_' . $F);
    }

    //Delete field
    $hideDelete = ( isset( $_POST['hideDelete_' . $F ]) ? esc_attr( $_POST['hideDelete_' . $F ] ) : 'L' );
    if($hideDelete == 'D'){
        $this->delete_fields( $postID, $F );
        return 0;
    }

    //For new record when ajax sort not yet used. $tplatID, $hideDelete, $F
    abcfsls_autil_update_column_order( $postID, $hideDelete, $F );

    abcfl_mbsave_save_cbo( $postID, 'hideDelete_' . $F, '_hideDelete_' . $F, 'N');
    abcfl_mbsave_save_chekbox($postID, 'lineLocked_' . $F, '_fieldLocked_' . $F);

    abcfl_mbsave_save_txt( $postID, 'colHdr_' . $F, '_colHdr_' . $F );
    abcfl_mbsave_save_cbo( $postID, 'staffF_' . $F, '_staffF_' . $F, 'F0');

    abcfl_mbsave_save_chekbox($postID, 'linkToSingle_' . $F, '_linkToSingle_' . $F);
    abcfl_mbsave_save_chekbox($postID, 'newTab_' . $F, '_newTab_' . $F);
    abcfl_mbsave_save_chekbox($postID, 'showLbl_' . $F, '_showLbl_' . $F);

    abcfl_mbsave_save_chekbox($postID, 'noSearch_' . $F, '_noSearch_' . $F);
    abcfl_mbsave_save_chekbox($postID, 'noPrint_' . $F, '_noPrint_' . $F);

    abcfl_mbsave_save_txt($postID, 'cellCls_' . $F, '_cellCls_' . $F);
    abcfl_mbsave_save_txt($postID, 'cellStyle_' . $F, '_cellStyle_' . $F);

    //-----------------------------------------------------
    abcfl_mbsave_save_cbo( $postID,'orderP1_' . $F, '_orderP1_' . $F, '0');
    abcfl_mbsave_save_txt($postID, 'sfixP1_' . $F, '_sfixP1_' . $F);
    abcfl_mbsave_save_cbo( $postID,'orderP2_' . $F, '_orderP2_' . $F, '0');
    abcfl_mbsave_save_txt($postID, 'sfixP2_' . $F, '_sfixP2_' . $F);
    abcfl_mbsave_save_cbo( $postID,'orderP3_' . $F, '_orderP3_' . $F, '0');
    abcfl_mbsave_save_txt($postID, 'sfixP3_' . $F, '_sfixP3_' . $F);
    abcfl_mbsave_save_cbo( $postID,'orderP4_' . $F, '_orderP4_' . $F, '0');
    abcfl_mbsave_save_txt($postID, 'sfixP4_' . $F, '_sfixP4_' . $F);

    abcfl_mbsave_save_chekbox($postID, 'forSort_' . $F, '_forSort_' . $F);
    abcfl_mbsave_save_cbo( $postID,'orderPS1_' . $F, '_orderPS1_' . $F, '0');
    abcfl_mbsave_save_cbo( $postID,'orderPS2_' . $F, '_orderPS2_' . $F, '0');
    abcfl_mbsave_save_cbo( $postID,'orderPS3_' . $F, '_orderPS3_' . $F, '0');
    abcfl_mbsave_save_cbo( $postID,'orderPS4_' . $F, '_orderPS4_' . $F, '0');
    //-----------------------------------------------------
}

    private function delete_fields( $postID, $F ) {

        delete_post_meta( $postID, '_fieldType_' . $F );
        delete_post_meta( $postID, '_fieldTypeH_' . $F );
        delete_post_meta( $postID, '_hideDelete_' . $F );
        delete_post_meta( $postID, '_lineLocked_' . $F );

        delete_post_meta( $postID, '_colHdr_' . $F );
        delete_post_meta( $postID, '_staffF_' . $F );

        delete_post_meta( $postID, '_linkToSingle_' . $F );
        delete_post_meta( $postID, '_newTab_' . $F );
        delete_post_meta( $postID, '_showLbl_' . $F );

        delete_post_meta( $postID, '_noSearch_' . $F );
        delete_post_meta( $postID, '_noPrint_' . $F );

        delete_post_meta( $postID, '_cellCls_' . $F );
        delete_post_meta( $postID, '_cellStyle_' . $F );

        delete_post_meta( $postID, '_orderP1_' . $F );
        delete_post_meta( $postID, '_sfixP1_' . $F );
        delete_post_meta( $postID, '_orderP2_' . $F );
        delete_post_meta( $postID, '_sfixP2_' . $F );
        delete_post_meta( $postID, '_orderP3_' . $F );
        delete_post_meta( $postID, '_sfixP3_' . $F );
        delete_post_meta( $postID, '_orderP4_' . $F );
        delete_post_meta( $postID, '_sfixP4_' . $F );

        delete_post_meta( $postID, '_forSort_' . $F );
        delete_post_meta( $postID, '_orderPS1_' . $F );
        delete_post_meta( $postID, '_orderPS2_' . $F );
        delete_post_meta( $postID, '_orderPS3_' . $F );
        delete_post_meta( $postID, '_orderPS4_' . $F );
    }

    private function user_can_save( $postID, $nonceAction, $nonceID ) {

        $is_autosave = wp_is_post_autosave( $postID );
        $is_revision = wp_is_post_revision( $postID );
        $is_valid_nonce = ( isset( $_POST[ $nonceAction ] ) && wp_verify_nonce( $_POST[ $nonceAction ], $nonceID ) );

        return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;
    }

}