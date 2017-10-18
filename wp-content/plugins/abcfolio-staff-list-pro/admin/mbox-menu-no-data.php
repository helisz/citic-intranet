<?php
function abcfsl_mbox_menu_no_data( $menuOptns ){


        $noDataMsg = isset( $menuOptns['_noDataMsg'] ) ? esc_attr( $menuOptns['_noDataMsg'][0] ) : '';

        echo abcfl_input_hline('1', 10);
        echo abcfl_input_txt( 'noDataMsg', '', $noDataMsg, abcfsl_txta(168), '', '50%', '', '', 'abcflFldCntr', 'abcflFldLbl' );

}