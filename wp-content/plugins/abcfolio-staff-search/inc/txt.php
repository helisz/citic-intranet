<?php

function abcfsls_txt($id, $suffix='') {

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = __('Field type mismatch.', 'staff-search');
            break;
        case 2:
            $out = __('Images', 'staff-search');
            break;
        case 3:
            $out = __('Shortcode', 'staff-search');
            break;
        case 4:
            $out = __('Uninstall', 'staff-search');
            break;
        case 5:
            $out = __('Yes', 'staff-search');
            break;
        case 6:
            $out = __('Search:', 'staff-search');
            break;
        case 7:
            $out = __('No matching records found.', 'staff-search');
            break;
        case 8:
            $out = __('Previous', 'staff-search');
            break;
        case 9:
            $out = __('Next', 'staff-search');
            break;
        case 10:
            $out = __('Staff List Pro is required for this plugin to work.', 'staff-search');
            break;
        case 11:
            $out = __('Categories menu not selected', 'staff-search');
            break;
        case 12:
            $out = __('Loading...', 'staff-search');
            break;


        default:
            $out = '';
            break;
    }
    return $out . $suffix;
}
function abcfsls_txt_err ($id, $suffix='', $bold=false) {

    $txt = abcfsls_txt($id, $suffix='');

    return '<div class="abcflRed">' . $txt . '</div>';


    //if($required){ $star = '<b class="abcflRed abcflFontS14"> *</b>'; }
    //return $txt . $star;

}