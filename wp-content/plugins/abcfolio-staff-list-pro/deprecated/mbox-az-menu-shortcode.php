<?php
function abcfsl_mbox_az_menu_shortcode( $tplateID ) {

    echo  abcfl_html_tag('div','','inside  hidden');
        $scode = abcfsl_scode_build_scode_az_menu( $tplateID );

        echo abcfl_input_txt_readonly('scode', '', $scode, abcfsl_txta(3),'', '100%', 'regular-text code abcflFontW700', '', 'abcflFldCntr abcflShortcode');

    echo abcfl_html_tag_end('div');
}

