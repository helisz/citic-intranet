<?php

function abcfsls_aurl( $id ) {
    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = 'http://abcfolio.com/staff-list-search-quick-start-table-a/';
            break;
        case 2:
            $out = 'http://abcfolio.com/staff-search-data-source/';
            break;
        case 3:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-search-print-and-export/';
            break;
        case 4:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-search/';
            break;
        case 5:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-search-multi-filter-plus/';
            break;
        case 6:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-search-add-multi-filter-to-page/';
            break;
        case 7:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-search-text-search-options/';
            break;
        case 8:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-customization/';
            break;
        case 9:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-form-action/';
            break;
        case 10:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-search-table-columns-ordering/';
            break;
        default:
            $out = '';
            break;
    }
    return $out;
}

