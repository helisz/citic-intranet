<?php
function abcfsls_txta($id, $suffix='') {

    switch ($id){
        case 0:
            $out = '';
            break;
        case 1:
            $out = __('Help', 'staff-search');
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
            $out = __('No', 'staff-search');
            break;
        case 7:
            $out = __('Default', 'staff-search');
            break;
        case 8:
            $out = __('License', 'staff-search');
            break;
        case 9:
            $out = __('Data Source', 'staff-search');
            break;
        case 10:
            $out = __('Font Size', 'staff-search');
            break;
       case 11:
            $out = __('Documentation', 'staff-search');
            break;
       case 12:
            $out = __('Admin', 'staff-search');
            break;
       case 13:
            $out = __('Layout', 'staff-search');
            break;
        case 14:
            $out = __('Width', 'staff-search');
            break;
        case 15:
            $out = __('Top Margin', 'staff-search');
            break;
        case 16:
            $out = __('Optional. ', 'staff-search');
            break;
        case 17:
            $out = __('Custom Dropdown', 'staff-search');
            break;
        case 18:
            $out = __('Field Value', 'staff-search');
            break;
        case 19:
            $out = __('Options', 'staff-search');
            break;
        case 20:
            $out = __('Custom', 'staff-search');
            break;
//--------------------------------------------------
        case 21:
             $out = __('Activate Key', 'staff-search');
             break;
        case 22:
             $out = __('License Key', 'staff-search');
             break;
        case 23:
            $out = __('Add Defaults', 'staff-search');
            break;
       case 24:
            $out = __('Support', 'staff-search');
            break;
        case 25:
            $out = __('Caption', 'staff-search');
            break;
        case 26:
            $out = __('License & Help', 'staff-search');
            break;
        case 27:
            $out = __('Table Layout', 'staff-search');
            break;
        case 28:
            $out = __('Description', 'staff-search');
            break;
        case 29:
            $out = __('Title', 'staff-search');
            break;
//--------------------------------------------------
        case 30:
            $out = __('Columns', 'staff-search');
            break;
        case 31:
            $out = __('Table Columns', 'staff-search');
            break;
        case 32:
            $out = __('Column Header', 'staff-search');
            break;
        case 33:
            $out = __('Column Font', 'staff-search');
            break;
        case 34:
            $out = __('Default = Font used by your theme.', 'staff-search');
            break;
        case 35:
            $out = __('Custom Styles', 'staff-search');
            break;
        case 36:
            $out = __('Categories', 'staff-search');
            break;
        case 37:
            $out = __('Keep data, don\'t show the column on the front end.', 'staff-search');
            break;
        case 38:
            $out = __('Column Order', 'staff-search');
            break;
        case 39:
            $out = __('Staff Template', 'staff-search');
            break;
//--------------------------------------------------
        case 40:
            $out = __('Staff List Field', 'staff-search');
            break;
        case 41:
            $out = __('Staff List Help', 'staff-search');
            break;
        case 42:
            $out = __('Column Data Type', 'staff-search');
            break;
        case 43:
            $out = __('Text', 'staff-search');
            break;
        case 44:
            $out = __('Sorce of records for search table.', 'staff-search');
            break;
        case 45:
            $out = __('Multipart Field', 'staff-search');
            break;
        case 46:
            $out = __('Email', 'staff-search');
            break;
        case 47:
            $out = __('Hyperlink', 'staff-search');
            break;
        case 48:
            $out = __('Suffix', 'staff-search');
            break;
        case 49:
            $out = __('Table Container', 'staff-search');
            break;
//--------------------------------------------------
        case 50:
            $out = __('<a href="http://abcfolio.com/wordpress-plugin-staff-search-custom-styles-option/">Documentation</a>', 'staff-search');
             break;
        case 51:
            $out = abcfsls_txta(16) . __('Enter the CSS class name you would like to use in order to override the default styles for this field.', 'staff-search');
            break;
        case 52:
            $out = abcfsls_txta(16) . __('Enter the CSS style you would like to use in order to override the default styles for this field.', 'staff-search');
            break;
        case 53:
            $out = __('Custom CSS Class', 'staff-search');
            break;
        case 54:
            $out = __('Custom Inline Style', 'staff-search');
            break;
        case 55:
            $out = __('Display Order', 'staff-search');
            break;
        case 56:
            $out = __('Hide', 'staff-search');
            break;
        case 57:
            $out = __('Delete', 'staff-search');
            break;
        case 58:
            $out = __('Table Header', 'staff-search');
            break;
        case 59:
            $out = __('Table Content', 'staff-search');
            break;
//--------------------------------------------------
        case 60:
             $out = __('How to publish Staff Search', 'staff-search');
            break;
        case 61:
             $out = __('Create a new page.', 'staff-search');
            break;
        case 62:
            $out = __(' Copy <b>shortcode</b> (from above) and paste it into post or page content editor.', 'staff-search');
            break;
        case 63:
             $out = __('Save the page.', 'staff-search');
            break;
        case 64:
             $out = __('Open the newly created page.', 'staff-search');
            break;
        case 65:
             $out = __('Search', 'staff-search');
            break;
        case 66:
             $out = __('Default: Search:', 'staff-search');
            break;
        case 67:
             $out = __('No Records Found', 'staff-search');
            break;
        case 68:
             $out = __('Default: No matching records found.', 'staff-search');
            break;
        case 69:
            $out = __('Background Color', 'staff-search');
            break;
//--------------------------------------------------
        case 70:
            $out = __('Font Color', 'staff-search');
            break;
        case 71:
            $out = __('Wide', 'staff-search');
            break;
        case 72:
            $out = __('Standard', 'staff-search');
            break;
        case 73:
            $out = __('Compact', 'staff-search');
            break;
        case 74:
            $out = __('Table Style', 'staff-search');
            break;
        case 75:
            $out = __('Compact option makes a table smaller by cutting cell padding.', 'staff-search');
            break;
        case 76:
            $out = __('Add zebra-stripes to table rows.', 'staff-search');
            break;
        case 77:
            $out = __('Highlight the column that the table data is currently ordered on.', 'staff-search');
            break;
        case 78:
            $out = __('Text Direction', 'staff-search');
            break;
        case 79:
            $out = __('Left to Right (ltr)', 'staff-search');
            break;
//--------------------------------------------------
        case 80:
            $out = __('Right to Left (rtl)', 'staff-search');
            break;
        case 81:
            $out = __('Highlight search results.', 'staff-search');
            break;
        case 82:
            $out = __('Caption No Wrap.', 'staff-search');
            break;
        case 83:
            $out = __('Show table footer.', 'staff-search');
            break;
        case 84:
            $out = __('Paging', 'staff-search');
            break;
        case 85:
            $out = __('Page Length', 'staff-search');
            break;
        case 86:
            $out = __('Number of rows to display on a single page when using pagination.', 'staff-search');
            break;
        case 87:
            $out = __('Create link to a single page.', 'staff-search');
            break;
        case 88:
            $out = __('Labels', 'staff-search');
            break;
        case 89:
            $out = __('Paging: Previous', 'staff-search');
            break;
//--------------------------------------------------
        case 90:
            $out = __('Paging: Next', 'staff-search');
            break;
        case 91:
            $out = __('Default: Previous', 'staff-search');
            break;
        case 92:
            $out = __('Default: Next', 'staff-search');
            break;
        case 93:
            $out = abcfsls_txta(16) . __('Enter the CSS class name you would like to add to a table tag.', 'staff-search');
            break;
        case 94:
            $out = __('Field Parts Order for Sort', 'staff-search');
            break;
        case 95:
            $out = abcfsls_txta(16) . __('Create hidden field used for sorting.', 'staff-search');
            break;
        case 96:
            $out = __('Add hidden field for column sorting.', 'staff-search');
            break;
        case 97:
            $out = __('Which Staff List field to show in a column.', 'staff-search');
            break;
        case 98:
            $out = __('Field Parts Order for Display', 'staff-search');
            break;
        case 99:
            $out = __('Make table responsive.', 'staff-search');
            break;
//--------------------------------------------------
        case 100:
            $out = __('Staff Search', 'staff-search');
             break;
        case 101:
            $out = __('Custom Style', 'staff-search');
             break;
        case 102:
            $out = __('Set the order in which field parts are displayed.', 'staff-search');
            break;
        case 103:
            $out = __('Menu Container', 'staff-search');
            break ;
        case 104:
            $out = __('Menu Item', 'staff-search');
            break ;
        case 105:
            $out = __('Container Width', 'staff-search');
            break ;
        case 106:
            $out = __('Default: 100%. Valid data entry formats: px, %, em. Example: 15, 15px, 15%, 15em. Blank (no entry) = default value.', 'staff-search');
            break;
        case 107:
            $out = __('Center Items', 'staff-search');
            break ;
        case 108:
            $out = __('Bottom Margin', 'staff-search');
            break ;
        case 109:
            $out = __('Blank (no entry) = default value.', 'staff-search');
            break ;
//--------------------------------------------------
        case 110:
            $out = __('Valid formats: px, %. Example: 15px, 15%.', 'staff-search');
            break;
        case 111:
            $out = __('What type of content the column will contain: text, hyperlink, email etc.', 'staff-search');
            break;
        case 112:
            $out = __('Nowrap. Prevent the text from wrapping.', 'staff-search');
            break;
        case 113:
            $out = __('Open link in a new tab or window.', 'staff-search');
             break;
        case 114:
            $out = __('Show Link As', 'staff-search');
             break;
        case 115:
            $out = __('Display social link as...', 'staff-search');
             break;
        case 116:
            $out = __('Static Text', 'staff-search');
             break;
        case 117:
            $out = __('Enter text to show when Static Text selected', 'staff-search');
             break;
        case 118:
            $out = __('Icon', 'staff-search');
             break;
        case 119:
            $out = __('Exclude from search.', 'staff-search');
            break;
//--------------------------------------------------
        case 120:
            $out = __('Social Icons', 'staff-search');
             break;
        case 121:
            $out = __('What text to show in the column header.', 'staff-search');
             break;
        case 122:
            $out = __('Categories Menu', 'staff-search');
            break;
        case 123:
            $out = __('Print & Export', 'staff-search');
            break;
        case 124:
            $out = __('Loading', 'staff-search');
            break;
        case 125:
            $out = __('Print', 'staff-search');
            break;
        case 126:
            $out = __('Table Column', 'staff-search');
            break;
        case 127:
            $out = __('Column Options', 'staff-search');
            break;
        case 128:
            $out = __('Show label instead of hyperlink.', 'staff-search');
            break;
        case 129:
            $out = __('Landscape', 'staff-search');
            break;
//--------------------------------------------------
        case 130:
            $out = __('Portrait', 'staff-search');
            break;
        case 131:
            $out = __('Display the Print dialog box.', 'staff-search');
            break;
        case 132:
            $out = __('Orientation', 'staff-search');
            break;
        case 133:
            $out = __('Paper Size', 'staff-search');
            break;
        case 134:
            $out = __('Margins', 'staff-search');
            break;
        case 135:
            $out = __('Add Search Box.', 'staff-search');
            break;
        case 136:
            $out = __('Enable ordering of columns.', 'staff-search');
            break;
        case 137:
            $out = __('Show label instead of email address.', 'staff-search');
            break;
        case 138:
            $out = __('Exclude from print and export.', 'staff-search');
            break;
        case 139:
            $out = __('Filters Display Order', 'staff-search');
            break;
//--------------------------------------------------
        case 140:
            $out = __('Color', 'staff-search');
            break;
        case 141:
            $out = __('Search Button', 'staff-search');
            break;
        case 142:
            $out = __('Reset Button', 'staff-search');
            break;
        case 143:
            $out = __('Filters Order', 'staff-search');
            break;
        case 144:
            $out = __('Filter - Minimum Number of Characters', 'staff-search');
            break;
        case 145:
            $out = __('Search - Multi Fields', 'staff-search');
            break;
        case 146:
            $out = __('Search - Single Field', 'staff-search');
            break;
        case 147:
            $out = __('Items', 'staff-search');
            break;
        case 148:
            $out = __('Sort Text', 'staff-search');
            break;
        case 149:
            $out = __('Filter Type', 'staff-search');
            break;
//--------------------------------------------------
        case 150:
            $out = __('Shortcode Parameter', 'staff-search');
            break;
        case 151:
            $out = __('Filter', 'staff-search');
            break;
        case 152:
            $out = __('None', 'staff-search');
            break;
        case 153:
            $out = __('Menu Items Left/Right Margins', 'staff-search');
            break;
        case 154:
            $out = __('Active Item Decoration', 'staff-search');
            break;
        case 155:
            $out = __('Uppercase', 'staff-search');
            break;
        case 156:
            $out = __('Menu Items', 'staff-search');
            break;
        case 157:
            $out = __('Menu Label', 'staff-search');
            break;
        case 158:
            $out = __('Category Slug', 'staff-search');
            break;
        case 159:
            $out = __('', 'staff-search');
            break;
//--------------------------------------------------
        case 160:
            $out = __('Form Action', 'staff-search');
            break;
        case 161:
            $out = __('Ordering', 'staff-search');
            break;
        case 162:
            $out = __('Initial Order on Column', 'staff-search');
            break;
        case 163:
            $out = __('', 'staff-search');
            break;
        case 164:
            $out = __('', 'staff-search');
            break;
        case 165:
            $out = __('', 'staff-search');
            break;
//--------------------------------------------------
        case 214:
            $out = __('Template has no fields.', 'staff-search');
            break;
        case 255:
            $out = __('Simply drag the items up or down and they will be saved in that order.', 'staff-search');
            break;
        case 296:
            $out = __('Lock field to prevent accidental changes.', 'staff-search');
            break;
        case 297:
            $out = __('Field Locked. Editing disabled.', 'staff-search');
            break;

        default:
            $out = '';
            break;
    }
    return $out . $suffix;
}

function abcfsls_txta_r( $id, $suffix='' ) {
    $txt = abcfsls_txta( $id, $suffix );
    return $txt . '<b class="abcflRed abcflFontS14"> *</b>';
}