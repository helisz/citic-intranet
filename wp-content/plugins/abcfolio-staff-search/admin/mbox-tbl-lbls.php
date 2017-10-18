<?php

function abcfsls_mbox_tbl_lbls($tplateOptns){

    echo  abcfl_html_tag( 'div', '', 'inside hidden' );

    echo abcfl_input_info_lbl( abcfsls_txta(88), 'abcflMTop15', 16, 'SB');
    echo abcfl_input_info_lbl( abcfsls_txta(109), 'abcflMTop5', 13);
    $lblSearch = isset( $tplateOptns['_lblSearch'] ) ? esc_attr( $tplateOptns['_lblSearch'][0] ) : '';
    $lblNoRecords = isset( $tplateOptns['_lblNoRecords'] ) ? esc_attr( $tplateOptns['_lblNoRecords'][0] ) : '';
    $lblPrevious = isset( $tplateOptns['_lblPrevious'] ) ? esc_attr( $tplateOptns['_lblPrevious'][0] ) : '';
    $lblNext = isset( $tplateOptns['_lblNext'] ) ? esc_attr( $tplateOptns['_lblNext'][0] ) : '';
    $lblLoad = isset( $tplateOptns['_lblLoad'] ) ? esc_attr( $tplateOptns['_lblLoad'][0] ) : '';

    echo abcfl_input_txt('lblSearch', '', $lblSearch, abcfsls_txta(65), abcfsls_txta(66), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lblLoad', '', $lblLoad, abcfsls_txta(124), abcfsls_txta(7) . ': ' . abcfsls_txta(124) . '...', '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lblNoRecords', '', $lblNoRecords, abcfsls_txta(67), abcfsls_txta(68), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lblPrevious', '', $lblPrevious, abcfsls_txta(89), abcfsls_txta(91), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');
    echo abcfl_input_txt('lblNext', '', $lblNext, abcfsls_txta(90), abcfsls_txta(92), '60%', '', '', 'abcflFldCntr', 'abcflFldLbl');


    echo abcfl_html_tag_end('div');
}
