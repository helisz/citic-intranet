<?php
/**
 * Admin menu
*/
if (!class_exists("ABCFSLC_Admin_Menu")) {

    class ABCFSLC_Admin_Menu {

    function __construct() {
        add_action( 'admin_menu', array (&$this, 'add_menu') );
    }

    function add_menu() {

        $obj = ABCFSLC_Main();
        $slug = $obj->pluginSlug;

        $capability = 'edit_pages';
        add_menu_page(abcfslc_txta(50), abcfslc_txta(50), $capability, $slug, '', 'dashicons-groups', '81.551');
        add_submenu_page( $slug,
                abcfslc_txta(91),
                abcfslc_txta(91),
                $capability,
                'abcfslc_tabs_import',
                array(&$this, 'load_page'));
        add_submenu_page( $slug,
                abcfslc_txta(92),
                abcfslc_txta(92),
                $capability,
                'abcfslc_tabs_export',
                array(&$this, 'load_page'));
        add_submenu_page( $slug,
                abcfslc_txta(93),
                abcfslc_txta(93),
                $capability,
                'abcfslc_tplate_import_tabs',
                array(&$this, 'load_page'));
        add_submenu_page( $slug,
                abcfslc_txta(94),
                abcfslc_txta(94),
                $capability,
                'abcfslc_tplate_export_tabs',
                array(&$this, 'load_page'));
        add_submenu_page( $slug,
                abcfslc_txta(12),
                abcfslc_txta(12),
                $capability,
                'abcfslc_tabs_admin',
                array(&$this, 'load_page'));

        remove_submenu_page($slug,$slug);
    }

    function load_page() {

        switch ($_GET['page']){
            case 'abcfslc_tabs_import' :
                include_once ( ABCFSLC_PLUGIN_DIR . 'import/import-tabs.php' );
                abcfslc_tabs_import();
                break;
            case 'abcfslc_tabs_export' :
                include_once ( ABCFSLC_PLUGIN_DIR . 'export/export-tabs.php' );
                abcfslc_tabs_export();
                break;
            case 'abcfslc_tplate_export_tabs' :
                abcfslc_tplate_export_tabs();
                break;
            case 'abcfslc_tplate_import_tabs' :
                abcfslc_tplate_import_tabs();
                break;
            case 'abcfslc_tabs_admin' :
                include_once ( ABCFSLC_PLUGIN_DIR . 'admin/admin-tabs.php' );
                abcfslc_admin_tabs();
                break;
            default:
                break;
        }
    }
}
}

$abcfpb = new ABCFSLC_Admin_Menu();
