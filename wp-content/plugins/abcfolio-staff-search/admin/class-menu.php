<?php
if (!class_exists("ABCFSLS_Admin_Menu")) {

    class ABCFSLS_Admin_Menu {

    function __construct() {
        add_action( 'admin_menu', array (&$this, 'add_menu') );
    }

    function add_menu() {

//        $obj = ABCFSLS_Main();
//        $slug = $obj->pluginSlug;
        $slug = 'edit.php?post_type=cptsls_tbl_a';
        $capability = 'edit_pages';

        add_menu_page( abcfsls_txta(100), abcfsls_txta(100), $capability, $slug, '', 'dashicons-search', '81.552');

        add_submenu_page(
            $slug,
            abcfsls_txta(12),
            abcfsls_txta(12),
            $capability,
            'abcfsls_tabs_admin',
            array(&$this, 'load_page')
        );
    }

    function load_page() {

        switch ($_GET['page']){
            case 'abcfsls_tabs_admin' :
                abcfsls_admin_tabs();
                break;
            default:
                break;
        }
    }
}
}

$abcfsls = new ABCFSLS_Admin_Menu();


