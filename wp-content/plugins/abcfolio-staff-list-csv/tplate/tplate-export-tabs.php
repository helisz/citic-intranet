<?php
function abcfslc_tplate_export_tabs() {

    $getParams = abcfslc_tplate_export_tabs_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabTplateExportOptns' => '1. ' . abcfslc_txta(51),
        'tabTplateExportPreview' => '2. ' . abcfslc_txta(68),
        'tabTplateExport' => '3. ' . abcfslc_txta(52)
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
        case 'tabTplateExportOptns' :
            abcfslc_tplate_export_optns();
            break;
        case 'tabTplateExportPreview' :
            abcfslc_tplate_export_preview();
            break;
        case 'tabTplateExport' :
            abcfslc_tplate_export_file();
            break;
       default:
            abcfslc_tplate_export_optns();
            break;

   }
}
//--------------------------------------------------
function abcfslc_tplate_export_tabs_defaults( $get ) {

    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfslc_tplate_export_tabs',
        'tab' => 'tabTplateExportOptns'
     );

    return wp_parse_args( $get, $defaults );
}


