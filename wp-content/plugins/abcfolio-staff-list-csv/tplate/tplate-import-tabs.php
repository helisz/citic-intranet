<?php
/*
 * Admin tabs: Demos,  Help.
 */
function abcfslc_tplate_import_tabs() {

    $getParams = abcfslc_tplate_import_tabs_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabFile' => '1. ' . abcfslc_txta(53),
        'tabPreviewFile' => '2. ' . abcfslc_txta(25),

        'tabPreviewTable' => '4. ' . abcfslc_txta(33),

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
            abcfslc_tplate_import_optns();
            break;
        case 'tabPreviewFile' :
            abcfslc_tplate_import_preview_file();
            break;
        case 'tabPreviewTable' :;
            abcfslc_tplate_import_preview_tbl();
            break;
        case 'tabImport' :
            abcfslc_tplate_import_insert();
            break;
        case 'tabImportReview' :
            abcfslc_tplate_import_status();
            break;
       default:
            abcfslc_tplate_import_optns();
            break;

   }
}
//--------------------------------------------------
function abcfslc_tplate_import_tabs_defaults( $get ) {

    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfslc_tplate_import_tabs',
        'tab' => 'tabFile'
     );

    return wp_parse_args( $get, $defaults );
}


