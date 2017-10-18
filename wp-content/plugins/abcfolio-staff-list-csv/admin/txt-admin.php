<?php
function abcfslc_txta($id, $suffix='') {

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = __('Help', 'staff_list_csv');
            break;
        case 2:
            $out = __('Images', 'staff_list_csv');
            break;
        case 3:
            $out = __('Shortcode', 'staff_list_csv');
            break;
        case 4:
            $out = __('Uninstall', 'staff_list_csv');
            break;
        case 5:
            $out = __('Yes', 'staff_list_csv');
            break;
        case 6:
            $out = __('No', 'staff_list_csv');
            break;
        case 7:
            $out = __('Default', 'staff_list_csv');
            break;
        case 8:
            $out = __('License', 'staff_list_csv');
            break;
        case 9:
            $out = __('Options', 'staff_list_csv');
            break;
        case 10:
            $out = __('CSV File', 'staff_list_csv');
            break;
       case 11:
            $out = __('Documentation', 'staff_list_csv');
            break;
       case 12:
            $out = __('Admin', 'staff_list_csv');
            break;
       case 13:
            $out = __('Filename', 'staff_list_csv');
            break;
        case 14:
            $out = __('CSV File URL', 'staff_list_csv');
            break;
        case 15:
            $out = __('CSV File Location', 'staff_list_csv');
            break;
        case 16:
            $out = __('Select CSV File', 'staff_list_csv');
            break;
        case 17:
            $out = __('Staff Template', 'staff_list_csv');
            break;
        case 18:
            $out = __('Field Mapping', 'staff_list_csv');
            break;
        case 19:
            $out = __('File Format', 'staff_list_csv');
            break;
        case 20:
            $out = __('CSV Row', 'staff_list_csv');
            break;
//--------------------------------------------------
        case 21:
             $out = __('Activate Key', 'staff_list_csv');
             break;
        case 22:
             $out = __('License Key', 'staff_list_csv');
             break;
        case 23:
            $out = __('Save Changes');
            break;
       case 24:
            $out = __('Support', 'staff_list_csv');
            break;
        case 25:
            $out = __('CSV Preview ', 'staff_list_csv');
            break;
        case 26:
            $out = __('License & Help', 'staff_list_csv');
            break;
        case 27:
            $out = __('Settings saved.', 'staff_list_csv');
            break;
        case 28:
            $out = __('Description', 'staff_list_csv');
            break;
        case 29:
            $out = __('Error.', 'staff_list_csv');
            break;
//--------------------------------------------------
        case 30:
            $out = __('File', 'staff_list_csv');
            break;
        case 31:
            $out = __('Template', 'staff_list_csv');
            break;
        case 32:
            $out = __('Reset Form', 'staff_list_csv');
            break;
        case 33:
            $out = __('Import Preview', 'staff_list_csv');
            break;
        case 34:
            $out = __('Refresh Import Table', 'staff_list_csv');
            break;
        case 35:
            $out = __('Column Delimiter', 'staff_list_csv');
            break;
        case 36:
            $out = __('Field Enclosure', 'staff_list_csv');
            break;
        case 37:
            $out = __('Escape Character', 'staff_list_csv');
            break;
        case 38:
            $out = __('Comma ,' , 'staff_list_csv');
            break;
        case 39:
            $out = __('Pipe |', 'staff_list_csv');
            break;
//--------------------------------------------------
        case 40:
            $out = __('Tab', 'staff_list_csv');
            break;
        case 41:
            $out = __('Semicolon ;', 'staff_list_csv');
            break;
        case 42:
            $out = __('CSV Column', 'staff_list_csv');
            break;
        case 43:
            $out = __('Data', 'staff_list_csv');
            break;
        case 44:
            $out = __('Meta Key', 'staff_list_csv');
            break;
        case 45:
            $out = __('Post ID', 'staff_list_csv');
            break;
        case 46:
            $out = __('Import', 'staff_list_csv');
            break;
        case 47:
            $out = __('Import Records', 'staff_list_csv');
            break;
        case 48:
            $out = __(' Staff Mebers added.', 'staff_list_csv');
            break;
        case 49:
            $out = __('Error: Import failed.', 'staff_list_csv');
            break;
//--------------------------------------------------
        case 50:
            $out = __('Staff List CSV', 'staff_list_csv');
             break;
        case 51:
            $out = __('Export Options', 'staff_list_csv');
             break;
        case 52:
            $out = __('Export', 'staff_list_csv');
             break;
        case 53:
            $out = __('Import Options', 'staff_list_csv');
             break;
        case 54:
            $out = __('Import Status', 'staff_list_csv');
             break;
        case 55:
            $out = __('Records imported.', 'staff_list_csv');
             break;
        case 56:
            $out = __('Reset the Workspace', 'staff_list_csv');
             break;
        case 57:
            $out = __('There are no records to import. Go to <span class="abcflFontS16 abcflFontW600">Import Prewiew</span> and refresh the import table.', 'staff_list_csv');
             break;
        case 58:
            $out = __('Import failed. Some of the records have not been imported.', 'staff_list_csv');
             break;
        case 59:
            $out = __('To start over, go to <span class="abcflFontS16 abcflFontW600">Import Status</span> and reset the workspace.', 'staff_list_csv');
             break;
//--------------------------------------------------
        case 60:
            $out = __('To start over, reset the workspace.', 'staff_list_csv');
             break;
        case 61:
            $out = __('Do not delete records from the import table until you check documentation for all avialable options.', 'staff_list_csv');
             break;
        case 62:
            $out = __('Error. Staff Template is not selected.', 'staff_list_csv');
             break;
        case 63:
            $out = __('Download File', 'staff_list_csv');
             break;
        case 64:
            $out = __('CSV file is ready for import.', 'staff_list_csv');
             break;
        case 65:
            $out = __('Error. CSV File is not selected.', 'staff_list_csv');
            break;
        case 66:
            $out = __('Import table. Always refresh the table and check records before going to the next step > Import.', 'staff_list_csv');
            break;
        case 67:
            $out = __('Select fields to export.', 'staff_list_csv');
            break;
        case 68:
            $out = __('Export Preview', 'staff_list_csv');
             break;
        case 69:
            $out = __('Error. CSV File is not readable: ', 'staff_list_csv');
            break;
//--------------------------------------------------
        case 70:
            $out = __('Default: Tab', 'staff_list_csv');
             break;
        case 71:
            $out = __('"" Double Quotes', 'staff_list_csv');
             break;
        case 72:
            $out = __('Default: Double Quotes', 'staff_list_csv');
             break;
        case 73:
            $out = __('None', 'staff_list_csv');
             break;
        case 74:
            $out = __('Error. Selected template has no Staff Members.', 'staff_list_csv');
             break;
        case 75:
            $out = __(' records are ready for export to CSV file.', 'staff_list_csv');
             break;
        case 76:
            $out = __('Pretty Permalink', 'staff_list_csv');
             break;
        case 77:
            $out = __('Staff List Field', 'staff_list_csv');
             break;
        case 78:
            $out = __('Validation Status', 'staff_list_csv');
             break;
        case 79:
            $out = __('All categories are valid.', 'staff_list_csv');
             break;
//--------------------------------------------------
        case 80:
            $out = __('Some of the categories are  not valid and won\'t be imported.', 'staff_list_csv');
             break;
        case 81:
            $out = __('All categories are invalid.', 'staff_list_csv');
             break;
        case 82:
            $out = __('Overlay Text', 'staff_list_csv');
             break;
        case 83:
            $out = __('Encoding', 'staff_list_csv');
            break;
        case 84:
            $out = __('Absolute URL', 'staff_list_csv');
            break;
        case 85:
            $out = __('', 'staff_list_csv');
            break;
        case 86:
            $out = __('Images Directory', 'staff_list_csv');
            break;
        case 87:
            $out = __('CSV file for spreadsheet.', 'staff_list_csv');
            break;
        case 87:
            $out = __('Meta Value', 'staff_list_csv');
            break;
        case 88:
            $out = __('Template Name', 'staff_list_csv');
            break;
        case 89:
            $out = __('Import failed.', 'staff_list_csv');
             break;
//--------------------------------------------------
        case 90:
            $out = __('CSV columns do not match specification.', 'staff_list_csv');
             break;
        case 91:
            $out = __('Staff Import', 'staff_list_csv');
            break;
        case 92:
            $out = __('Staff Export', 'staff_list_csv');
            break;
        case 93:
            $out = __('Template Import', 'staff_list_csv');
            break;
        case 94:
            $out = __('Template Export', 'staff_list_csv');
            break;
        case 95:
            $out = __('Data Source', 'staff_list_csv');
            break;
//--------------------------------------------------
        case 100:
            $out = __('Post Title', 'staff_list_csv');
             break;
        case 101:
            $out = __('Sort Txt', 'staff_list_csv');
             break;
        case 102:
            $out = __('Staff Page Image URL', 'staff_list_csv');
             break;
        case 103:
            $out = __('Single Page Image URL', 'staff_list_csv');
             break;
        case 104:
            $out = __('Image Link', 'staff_list_csv');
             break;
        case 105:
            $out = __('Facebook Icon - URL', 'staff_list_csv');
             break;
        case 106:
            $out = __('Google+ Icon - URL', 'staff_list_csv');
             break;
        case 107:
            $out = __('Twitter Icon - URL', 'staff_list_csv');
             break;
        case 108:
            $out = __('LinkedIn Icon - URL', 'staff_list_csv');
             break;
        case 109:
            $out = __('Email Icon - URL', 'staff_list_csv');
             break;
//--------------------------------------------------
        case 110:
            $out = __('Custom Icon 1 - URL', 'staff_list_csv');
             break;
        case 111:
            $out = __('Custom Icon 2 - URL', 'staff_list_csv');
             break;
        case 112:
            $out = __('Custom Icon 3 - URL', 'staff_list_csv');
             break;
        case 113:
            $out = __('Single Page Title', 'staff_list_csv');
             break;
        case 114:
            $out = __('Categories', 'staff_list_csv');
             break;
        case 115:
            $out = __('Disregard this section. You have no categories to import.', 'staff_list_csv');
             break;
        default:
            $out = '';
            break;
    }
    return $out . $suffix;
}

function abcfslc_txta_r( $id, $suffix='' ) {
    $txt = abcfslc_txta( $id, $suffix );
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}

//function abcfslc_txta_reqired($id, $suffix='', $required=false) {
//
//    $txt = abcfslc_txta( $id, $suffix );
//    $star = '';
//    if($required){ $star = '<b class="abcflRed abcflFontS14"> *</b>'; }
//    return $txt . $star;
//
//}