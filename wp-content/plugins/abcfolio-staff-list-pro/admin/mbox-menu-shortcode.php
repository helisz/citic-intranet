<?php
function abcfsl_mbox_menu_shortcode_par( $menuID, $menuType ) {

    echo  abcfl_html_tag('div','','inside  hidden');
        $scode = abcfsl_scode_build_scode_menu_par( $menuID, $menuType );

        echo abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(3), abcfsl_aurl(0) );

        $lbl = abcfl_input_sec_title_hlp( ABCFSL_ICONS_URL, abcfsl_txta(115), abcfsl_aurl(37), 'abcflFontWP abcflFontS13 abcflFontW400' );
        echo abcfl_input_txt_readonly('scode', '', $scode, $lbl,'', '50%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode', 'abcflFldLbl');

    echo abcfl_html_tag_end('div');
}
