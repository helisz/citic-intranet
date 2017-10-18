<?php
/*
Plugin Name: Staff List CSV
Plugin URI: http://abcfolio.com/staff-list-csv/
Description:
Author: abcFolio
Author URI: http://www.abcfolio.com
Text Domain: staff_list_csv
Domain Path: /languages
Version: 0.2.0
------------------------------------------------------------------------
Copyright 2009-2015 abcFolio.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'ABCFSLC_Main' ) ) {

final class ABCFSLC_Main {

    private static $instance;
    public $pluginSlug = 'abcfolio-staff-list-csv';
    public $prefix = 'abcfslc';
    public $pluginVersion = '0.2.0';

    /**
     * Main PLUGIN Instance
     * Insures that only one instance of plugin exists in memory at any one time. Also prevents needing to define globals all over the place.
     */
    public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ABCFSLC_Main ) ) {
                    self::$instance = new ABCFSLC_Main;
                    self::$instance->setup_constants();
                    self::$instance->includes();
                    self::$instance->tableNames();
                    self::$instance->setup_actions();
                    self::$instance->load_textdomain();
            }
            return self::$instance;
    }

    private function __construct (){}

    private function setup_constants() {

        // Plugin version pversion
        if ( ! defined( 'ABCFSLC_VERSION' ) ) { define( 'ABCFSLC_VERSION', $this->pluginVersion ); }
        if ( ! defined( 'ABCFSLC_ABSPATH' ) ) {  define('ABCFSLC_ABSPATH', ABSPATH); }
        // Plugin Folder QPath
        if( ! defined( 'ABCFSLC_PLUGIN_DIR' ) ){ define( 'ABCFSLC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }
        // Plugin Folder URL
        if ( ! defined( 'ABCFSLC_PLUGIN_URL' ) ) { define( 'ABCFSLC_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); }
        // Plugin folder name abcfolio-staff-list
        if( ! defined( 'ABCFSLC_PLUGIN_FOLDER' ) ){ define('ABCFSLC_PLUGIN_FOLDER', basename( dirname(__FILE__) ) ); }
        // Plugin Root File QPath
        if ( ! defined( 'ABCFSLC_PLUGIN_FILE' ) ){ define( 'ABCFSLC_PLUGIN_FILE', __FILE__ ); }

        if ( ! defined( 'ABCFSLC_ICONS_URL' ) ){ define( 'ABCFSLC_ICONS_URL', trailingslashit(trailingslashit(ABCFSLC_PLUGIN_URL) . 'images')); }
     }


    //Include required files
    private function includes() {

        if( is_admin() ) {

            require_once ABCFSLC_PLUGIN_DIR . 'import/class-csv-read.php';
            require_once ABCFSLC_PLUGIN_DIR . 'import/tplate-check.php';

            require_once ABCFSLC_PLUGIN_DIR . 'export/class-row-writer.php';
            require_once ABCFSLC_PLUGIN_DIR . 'export/class-writer.php';
            require_once ABCFSLC_PLUGIN_DIR . 'export/class-write-helpers.php';
            require_once ABCFSLC_PLUGIN_DIR . 'export/export-file.php';

            require_once ABCFSLC_PLUGIN_DIR . 'admin/admin-scripts.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/dba.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/install.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/autil.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/class-menu.php';

            require_once ABCFSLC_PLUGIN_DIR . 'admin/tbls.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/field-lbls.php';

            require_once ABCFSLC_PLUGIN_DIR . 'admin/cbos.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/txt-admin.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/ajax-handlers.php';
            require_once ABCFSLC_PLUGIN_DIR . 'admin/txt-aurl.php';

            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-export-tabs.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-export-preview.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-export-optns.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-export-file.php';

            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-import-tabs.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-import-optns.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-import-preview-file.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-import-preview-tbl.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-import-insert.php';
            require_once ABCFSLC_PLUGIN_DIR . 'tplate/tplate-import-status.php';

            require_once ABCFSLC_PLUGIN_DIR . 'library/abcfl-autil.php';
            require_once ABCFSLC_PLUGIN_DIR . 'plugin-updates/plugin-update-checker.php';

            //-- Library files are loaded from Staff List plugin --------
            //require_once ABCFSLC_PLUGIN_DIR . 'library/abcfl-input.php';
            //require_once ABCFSLC_PLUGIN_DIR . 'library/abcfl-css.php';
            //require_once ABCFSLC_PLUGIN_DIR . 'library/abcfl-html.php';
            //require_once ABCFSLC_PLUGIN_DIR . 'library/abcfl-attr.php';

            $this->update_checker();
        }
    }

    private function update_checker(){

       $check = Puc_v4_Factory::buildUpdateChecker('http://abcfolio.net/wp-update-server/?action=get_metadata&slug=' . $this->pluginSlug,
               __FILE__,
               $this->pluginSlug,
               24);
       $check->addQueryArgFilter('abcfslc_autil_filter_update_checks');
    }

    private function tableNames() {

        global $wpdb;
        $wpdb->abcfslc_import_csv = $wpdb->prefix . 'abcfslc_import_csv';
        $wpdb->abcfslc_export_csv = $wpdb->prefix . 'abcfslc_export_csv';
        $wpdb->abcfslc_import_cat = $wpdb->prefix . 'abcfslc_import_cat';
        $wpdb->abcfslc_export_tplate = $wpdb->prefix . 'abcfslc_export_tplate';
        $wpdb->abcfslc_import_tplate = $wpdb->prefix . 'abcfslc_import_tplate';
    }

    private function setup_actions() {
        add_action('admin_init', 'abcfslc_export_file_action');
        add_action('admin_init', 'abcfslc_tplate_export_file_action');
    }

    // TODO
    function load_textdomain() {

        $pslug = $this->pluginSlug;
        $langDir = plugin_basename( dirname( __FILE__ ) ) . '/languages';

        // Set filter for plugin's languages directory
        $langDir = apply_filters( 'abcfslc_languages_directory', $langDir );

        // Traditional WordPress plugin locale filter
        $locale  = apply_filters( 'plugin_locale',  get_locale(), $pslug );
        $mofile  = sprintf( '%1$s-%2$s.mo', $pslug, $locale );

        // Setup paths to current locale file
        $mofileLocal  = $langDir . $mofile;
        $mofileGlobal = WP_LANG_DIR . '/' . $pslug . '/' . $mofile;

        if ( file_exists( $mofileGlobal ) ) {
            load_textdomain( $pslug, $mofileGlobal );
        } elseif ( file_exists( $mofileLocal ) ) {
            load_textdomain( $pslug, $mofileLocal );
        } else {
            load_plugin_textdomain( $pslug, false, $langDir );
        }
    }
}
} // End class_exists check

function ABCFSLC_Main() {
    return ABCFSLC_Main::instance();
}
// Get plugin Running
ABCFSLC_Main();