<?php
function abcfsl_mbox_tplate_menu( $tplateOptns ){

    echo  abcfl_html_tag('div','','inside hidden');

        $lstLayout = isset( $tplateOptns['_lstLayout'] ) ? esc_attr( $tplateOptns['_lstLayout'][0] ) : '0';
        $lstLayoutH = isset( $tplateOptns['_lstLayoutH'] ) ? esc_attr( $tplateOptns['_lstLayoutH'][0] ) : $lstLayout;
        if($lstLayoutH == '0'){
            echo abcfl_html_tag_end('div');
            return;
        }

        $tplateMenuID = isset( $tplateOptns['_tplateMenuID'] ) ? esc_attr( $tplateOptns['_tplateMenuID'][0] ) : '0';
        $noDataMsg = isset( $tplateOptns['_noDataMsg'] ) ? esc_attr( $tplateOptns['_noDataMsg'][0] ) : '';

        $cboMenus = abcfsl_dba_cbo_menus();


        echo abcfl_input_sec_title( abcfsl_txta(333), 'abcflFontWP abcflFontS16 abcflRed abcflMTop10' );
        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(334), abcfsl_aurl(45), 'abcflFontWP abcflFontS14 abcflMTop5' );

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(100), abcfsl_aurl(39), 'abcflFontWP abcflFontS16 abcflFontW600 abcflMTop20' );
        echo abcfl_input_cbo('tplateMenuID', '',$cboMenus, $tplateMenuID, '', '', '50%', true, '', '', 'abcflFldCntr', 'abcflFldLbl');

        echo abcfl_input_txt( 'noDataMsg', '', $noDataMsg, abcfsl_txta(168), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );
    echo abcfl_html_tag_end('div');
}