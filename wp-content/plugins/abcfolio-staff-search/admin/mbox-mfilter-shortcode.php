<?php
function abcfsls_mbox_mfilter_shortcode( $menuID, $menuType ) {

    echo  abcfl_html_tag('div','','inside  hidden');
        $scode = abcfsls_scode_build_scode_menu_par( $menuID, $menuType );

        echo abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(3), abcfsl_aurl(0) );

        $lbl = abcfl_input_sec_title_hlp( ABCFSLS_ICONS_URL, abcfsls_txta(150), abcfsls_aurl(6), 'abcflFontWP abcflFontS13 abcflFontW400' );
        echo abcfl_input_txt_readonly('scode', '', $scode, $lbl,'', '50%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}
