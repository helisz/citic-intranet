<?php

function abcfslc_aurl( $id ) {

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = 'http://abcfolio.com/staff-list-csv/';
            break;
        case 2:
            $out = 'http://abcfolio.com/wordpress-plugin-csv-import-categories/';
            break;
        case 3:
            $out = 'http://abcfolio.com/csv-import-file-format/';
            break;
        case 4:
            $out = 'http://abcfolio.com/staff-list-csv-import-quick-start/';
            break;
        case 5:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-csv-import-export-images/';
            break;
        case 6:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-csv-encoding/';
            break;
        case 7:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-csv-staff-template-export/';
            break;
        case 8:
            $out = 'http://abcfolio.com/wordpress-plugin-staff-list-csv-staff-template-import/';
            break;
        case 9:
            $out = '';
            break;
        case 10:
            $out = '';
            break;
        default:
            $out = '';
            break;
    }
    return $out;
}


