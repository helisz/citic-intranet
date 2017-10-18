<?php
/*
 * Admin tabs: Demos,  Help.
 */

//add_action('admin_menu', 'my_page_export_menu');
//add_action('admin_init', 'abcfslc_export_file_action');
//include_once ABCFSLC_PLUGIN_DIR . 'admin/export-file.php';
function abcfslc_tabs_export() {

    $getParams = abcfslc_tabs_export_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabExportOptns' => '1. ' . abcfslc_txta(51),
        'tabExportMap' => '2. ' . abcfslc_txta(18),
        'tabExportPreview' => '3. ' . abcfslc_txta(68),
        'tabExport' => '4. ' . abcfslc_txta(52)
        );
    $links = array();


   //Tab links
   foreach( $tabs as $tab => $name ) {

        $href =  $basePg . '&amp;tab=' . $tab;
        if ( $tab == $currentTab ) {
            $links[] = abcfl_html_a_tag($href, $name, '', 'nav-tab abcfkapNavTab nav-tab-active abcfkapNavTabActive');
        }
        else {
            $links[] = abcfl_html_a_tag($href, $name, '', 'nav-tab abcfkapNavTab');
        }
    }

    echo  abcfl_html_tag('div', '', 'wrap' );
    echo abcfl_html_tag( 'h2', '', 'nav-tab-wrapper' );

    foreach ( $links as $link ){ echo $link; }
    echo abcfl_html_tag_ends('h2,div');

    switch ( $currentTab ) {
        case 'tabExportOptns' :
            include_once (ABCFSLC_PLUGIN_DIR . 'export/export-optns.php');
            abcfslc_export_optns();
            break;
        case 'tabExportMap' :
            include_once (ABCFSLC_PLUGIN_DIR . 'admin/map.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'export/export-map.php');
            abcfslc_export_map();
            break;
        case 'tabExportPreview' :
            include_once (ABCFSLC_PLUGIN_DIR . 'export/export-preview.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'admin/map.php');
            abcfslc_export_preview();
            break;
        case 'tabExport' :
            include_once (ABCFSLC_PLUGIN_DIR . 'export/export-file.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'export/export-preview.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'admin/map.php');
            abcfslc_export_file();
            break;
       default:
            include_once (ABCFSLC_PLUGIN_DIR . 'export/export-optns.php');
            abcfslc_export_optns();
            break;

   }
}
//--------------------------------------------------
function abcfslc_tabs_export_defaults( $get ) {

    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfslc_tabs_export',
        'tab' => 'tabExportOptns'
     );

    return wp_parse_args( $get, $defaults );
}


