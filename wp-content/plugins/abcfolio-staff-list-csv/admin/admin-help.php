<?php
function abcfslc_admin_tab_help() {

     echo abcfl_input_info_lbl('Plugin Documentation', 'abcflMTop30 abcflPLeft20', 20, 'SB');

     $cnt = abcfl_html_a_tag('http://abcfolio.com/staff-list-csv/', 'http://abcfolio.com/staff-list-csv/',
             '', 'abcflFontS16 abcflFontW600');

echo abcfl_html_tag_with_content( $cnt, 'div', '', 'abcflMTop40 abcflPLeft20' );





}

