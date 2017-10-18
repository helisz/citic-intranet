<?php
function abcfslc_import_insert(  ){

    $fileOpts = abcfslc_autil_import_file_optns();
    $tplateID =  $fileOpts['tplateID'];
    $fileName = $fileOpts['csvFilename'];

    //--WRAP START --------------------------------------------
    echo  abcfl_html_tag('div', '', 'wrap' );
    echo abcfl_input_hidden( 'tplateID', 'tplateID', $tplateID, $renderIfBlank=true );

    $importStatus = abcfslc_autil_import_status( $tplateID, $fileName  );
    switch ($importStatus){
        case 'FAILED':
            abcfslc_import_insert_failed( $tplateID, $fileName );
            break;
        case 'IMPORTED':
            abcfslc_import_insert_imported();
            break;
        case 'READY':
            abcfslc_import_insert_ready( $tplateID, $fileName);
            break;
        case 'EMPTY':
            abcfslc_import_insert_empty( $tplateID, $fileName);
            break;
        case 'NOTEMPLATE':
            abcfslc_autil_err_no_template();
            break;
        case 'NOFILE':
            abcfslc_autil_err_no_file();
            break;
       default:
            break;
    }
    //-- WRAP END --------------------------------------------
    echo abcfl_html_tag_end( 'div' );
}

function abcfslc_import_insert_ready( $tplateID, $fileName ){
    abcfslc_autil_msg_info( abcfslc_txta(64) );
    abcfslc_import_insert_ajax_btn();
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_tbls_render_import_tbl();
}

function abcfslc_import_insert_empty( $tplateID, $fileName ){
    abcfslc_autil_msg_info( abcfslc_txta(57) );
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
}

function abcfslc_import_insert_imported(){
    abcfslc_autil_lbls_import_ok_go_to();
}

function abcfslc_import_insert_failed( $tplateID, $fileName ){
    abcfslc_autil_import_failed_lbls();
    abcfslc_autil_lbls_file_tplate( $tplateID, $fileName );
    abcfslc_import_insert_ajax_btn();
    abcfslc_tbls_render_import_tbl();
}
//----------------------------------------------------------

function abcfslc_import_insert_ajax_btn(){

    //echo '<div id="progressbar" class="abcflWidth50Pc"></div>';
    echo '<div class="abcflWidth50Pc abcflPTop10"><div id="pBarImport"><div class="progress-label"></div></div></div>';

    echo abcfl_html_tag('div','btnImportCSV', 'submit' );
        echo abcfl_html_button( abcfslc_txta(47), 'btnAjaxImportCSV', 'button-primary abcficBtnWide' );
    echo abcfl_html_tag_end( 'div' );

    echo abcfl_html_tag( 'div', 'dialog', 'ui-helper-hidden', '', 'title="Import CSV"' );
        echo abcfl_html_tag_with_content( 'Import CSV file to Staff Members?', 'p', '' );
    echo abcfl_html_tag_end( 'div' );

}