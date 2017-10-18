<?php
/*
 * Admin tabs: Defaults, Lisense and Help.
 */
function abcfslc_admin_tabs() {

    $getParams = abcfslc_admin_tabs_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabLicense' => abcfslc_txta(8),
        'tabHelp' => abcfslc_txta(1)
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
        case 'tabLicense' :
            abcfl_autil_pg_license('abcfslc_optns', ' - Staff List CSV');
            break;
        case 'tabHelp' :
            include_once (ABCFSLC_PLUGIN_DIR . 'admin/admin-help.php');
            abcfslc_admin_tab_help();
            break;
   }
}
//--------------------------------------------------
function abcfslc_admin_tabs_defaults( $get ) {

    //$optns = $_GET;
    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfsl-admin-tabs',
        'tab' => 'tabLicense'
     );

    return wp_parse_args( $get, $defaults );
}


