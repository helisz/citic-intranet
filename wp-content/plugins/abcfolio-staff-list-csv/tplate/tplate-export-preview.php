<?php
function abcfslc_tplate_export_preview(){

    $fileOpts = abcfslc_autil_tplate_export_file_optns();
    $tplateID = $fileOpts['tplateID'];

    abcfslc_tplate_export_preview_tbl_refresh( $tplateID );
    //--WRAP START --------------------------------------------
    echo  abcfl_html_tag('div', '', 'wrap' );

    switch ( abcfslc_autil_export_status( $tplateID ) ){
        case 'NOTEMPLATE':
            abcfslc_autil_err_no_template();
            break;
        case 'EMPTY':
            abcfslc_autil_err_export_tbl_empty();
            break;
       default:
            abcfslc_tplate_export_preview_qty();
            abcfslc_tbls_tplate_export_render_tbl();
            break;
    }

   //--WRAP END --------------------------------------------
    echo abcfl_html_tag_end('div');
}

function abcfslc_tplate_export_preview_qty(){
    $qty = abcfslc_dba_export_tplate_qty();
    abcfslc_autil_msg_info( $qty . abcfslc_txta(75) );
}

//== DB TABLE - TRUNCATE AND LOAD - START =================
function abcfslc_tplate_export_preview_tbl_refresh( $tplateID ){

    //abcfslc_dba_export_tplate_drop_tbl(); //??????????????

    abcfslc_dba_export_tplate_create_tbl();
    abcfslc_dba_export_tplate_truncate_tbl();
    abcfslc_dba_export_add_posts_to_tbl( $tplateID );
    abcfslc_dba_export_tplate_add_meta( $tplateID );
    abcfslc_dba_export_tplate_delete_meta_keys();


}
