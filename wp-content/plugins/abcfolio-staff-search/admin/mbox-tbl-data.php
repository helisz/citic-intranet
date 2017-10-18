<?php
function abcfsls_mbox_tbl_data( $tplateOptns, $tbl ){

    echo  abcfl_html_tag( 'div', '', 'inside hidden' );

    $staffTplateID = isset( $tplateOptns['_staffTplateID'] ) ? $tplateOptns['_staffTplateID'][0] : '0';
    $catMenuID = isset( $tplateOptns['_catMenuID'] ) ? $tplateOptns['_catMenuID'][0] : '0';


    echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(9), abcfsls_aurl(2) );


    switch ($tbl){
        case 'A':
            echo abcfsls_mbox_tbl_data_staff_tplate( $staffTplateID );
            break;
        case 'C':
            echo abcfsls_mbox_tbl_data_staff_tplate( $staffTplateID );
            echo abcfsls_mbox_tbl_data_cat_menu( $catMenuID );
       default:
            break;
    }
    echo abcfl_html_tag_end('div');
}

function abcfsls_mbox_tbl_data_staff_tplate( $staffTplateID ) {

    $cboTpaltes = abcfsls_dba_cbo_staff_tplates();
    return abcfl_input_cbo('staffTplateID', '', $cboTpaltes, $staffTplateID, abcfsls_txta_r(39), abcfsls_txta(44), '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

}

function abcfsls_mbox_tbl_data_cat_menu( $catMenuID ) {

    $cboCatMenus = abcfsls_dba_cbo_category_menus();
    return abcfl_input_cbo('catMenuID', '', $cboCatMenus, $catMenuID, abcfsls_txta_r(122), '', '60%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

}