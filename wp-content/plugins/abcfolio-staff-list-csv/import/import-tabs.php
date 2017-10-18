<?php
/*
 * Admin tabs: Demos,  Help.
 */
function abcfslc_tabs_import() {

    $getParams = abcfslc_tabs_import_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabFile' => '1. ' . abcfslc_txta(53),
        'tabPreviewFile' => '2. ' . abcfslc_txta(25),
        'tabMapping' => '3. ' . abcfslc_txta(18),
        'tabPreviewTable' => '4. ' . abcfslc_txta(33),
        'tabCategories' => '5. ' . abcfslc_txta(114),
        'tabImport' => '6. ' . abcfslc_txta(46),
        'tabImportReview' => '7. ' . abcfslc_txta(54)
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
        case 'tabFile' :
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-optns.php');
            abcfslc_import_optns();
            break;
        case 'tabPreviewFile' :
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-preview-file.php');
            abcfslc_import_preview_file();
            break;
        case 'tabMapping' :
            include_once (ABCFSLC_PLUGIN_DIR . 'admin/map.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-map.php');
            abcfslc_import_map();
            break;
        case 'tabPreviewTable' :
            include_once (ABCFSLC_PLUGIN_DIR . 'admin/map.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-cat.php');
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-preview-tbl.php');
            abcfslc_import_preview_tbl();
            break;
        case 'tabCategories' :
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-cat.php');
            abcfslc_import_cat();
            break;
        case 'tabImport' :
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-insert.php');
            abcfslc_import_insert();
            break;
        case 'tabImportReview' :
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-status.php');
            abcfslc_import_status();
            break;
       default:
            include_once (ABCFSLC_PLUGIN_DIR . 'import/import-optns.php');
            abcfslc_import_optns();
            break;

   }
}
//--------------------------------------------------
function abcfslc_tabs_import_defaults( $get ) {

    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfslc_tabs_import',
        'tab' => 'tabFile'
     );

    return wp_parse_args( $get, $defaults );
}


