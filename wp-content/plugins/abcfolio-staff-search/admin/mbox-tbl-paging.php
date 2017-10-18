<?php

function abcfsls_mbox_tbl_paging( $tplateOptns ){

    echo  abcfl_html_tag( 'div', '', 'inside hidden' );

    $paging = isset( $tplateOptns['_paging'] ) ? $tplateOptns['_paging'][0] : '0';
    $pgLength = isset( $tplateOptns['_pgLength'] ) ? $tplateOptns['_pgLength'][0] : '0';

    //echo abcfl_input_info_lbl( abcfsls_txta(84), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_checkbox('paging',  '', $paging, abcfsls_txta(84, '.'), '', '', '', 'abcflFldCntr', '', '', '' );
    echo abcfl_input_txt('pgLength', '', $pgLength, abcfsls_txta(85), abcfsls_txta(86), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}



