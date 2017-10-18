<?php
/*
 * Admin tabs: Defaults, Lisense and Help.
 */
function abcfsls_admin_tabs() {

    $getParams = abcfsls_admin_tabs_defaults( $_GET );
    $basePg = 'admin.php?page=' . $getParams['page'];
    $currentTab = $getParams['tab'];

    $tabs = array(
        'tabLicense' => abcfsls_txta(8),
        'tabHelp' => abcfsls_txta(1)
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
            //abcfl_util_pg_license('abcfsls_optns');
            abcfl_autil_pg_license('abcfsls_optns', ' - Staff Search');
            break;
        case 'tabHelp' :
            include_once (ABCFSLS_PLUGIN_DIR . 'admin/admin-help.php');
            abcfsls_admin_tab_help();
            break;
   }
}
//--------------------------------------------------
function abcfsls_admin_tabs_defaults( $get ) {

    //$optns = $_GET;
    if(!$get){ $get = array();}
    $defaults = array(
        'page' => 'abcfsls-admin-tabs',
        'tab' => 'tabLicense'
     );

    return wp_parse_args( $get, $defaults );
}

//Check for plugin updates
function abcfsls_admin_tabs_update_checker($queryArgs) {

    $key = abcfl_autil_get_licence_key('abcfsls_optns');
    if ( !empty($key) ) { $queryArgs['license_key'] = $key; }
    return $queryArgs;
}
