<?php
/*
Plugin Name: Staff Search
Plugin URI: http://abcfolio.com/wordpress-plugin-bootstrap/
Description:
Author: abcFolio
Author URI: http://www.abcfolio.com
Text Domain: bootstrap
Domain Path: /languages
Version: 0.5.2
------------------------------------------------------------------------
Copyright 2009-2016 abcFolio.

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

if ( ! class_exists( 'ABCFSLS_Main' ) ) {

final class ABCFSLS_Main {

    private static $instance;
    public $pluginSlug = 'abcfolio-staff-search';
    public $prefix = 'sls';
    public $pluginVersion = '0.5.2';

    public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ABCFSLS_Main ) ) {
                    self::$instance = new ABCFSLS_Main;
                    self::$instance->setup_constants();
                    self::$instance->includes();
                    self::$instance->setup_actions();
                    self::$instance->load_textdomain();
            }
            return self::$instance;
    }

    private function __construct (){}

    private function setup_constants() {

        // Plugin version pversion
        if ( ! defined( 'ABCFSLS_VERSION' ) ) { define( 'ABCFSLS_VERSION', $this->pluginVersion ); }
        if ( ! defined( 'ABCFSLS_ABSPATH' ) ) {  define('ABCFSLS_ABSPATH', ABSPATH); }
        // Plugin Folder QPath
        if( ! defined( 'ABCFSLS_PLUGIN_DIR' ) ){ define( 'ABCFSLS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }
        // Plugin Folder URL
        if ( ! defined( 'ABCFSLS_PLUGIN_URL' ) ) { define( 'ABCFSLS_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); }
        // Plugin folder name abcfolio-staff-list
        if( ! defined( 'ABCFSLS_PLUGIN_FOLDER' ) ){ define('ABCFSLS_PLUGIN_FOLDER', basename( dirname(__FILE__) ) ); }
        // Plugin Root File QPath
        if ( ! defined( 'ABCFSLS_PLUGIN_FILE' ) ){ define( 'ABCFSLS_PLUGIN_FILE', __FILE__ ); }
        if ( ! defined( 'ABCFSLS_ICONS_URL' ) ){ define( 'ABCFSLS_ICONS_URL', trailingslashit(trailingslashit(ABCFSLS_PLUGIN_URL) . 'images')); }
     }

    //Include required files
    private function includes() {
        require_once ABCFSLS_PLUGIN_DIR . 'inc/db.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/post-types.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/scripts.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/shortcode.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/util.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/txt.php';

        require_once ABCFSLS_PLUGIN_DIR . 'inc/cnt.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/tbl-parts.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/cnt-js.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/tbl-a.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/tbl-c.php';
        require_once ABCFSLS_PLUGIN_DIR . 'inc/cnt-filter.php';

        require_once ABCFSLS_PLUGIN_DIR . 'library/abcfl-attr.php';
        require_once ABCFSLS_PLUGIN_DIR . 'library/abcfl-css.php';
        require_once ABCFSLS_PLUGIN_DIR . 'library/abcfl-html.php';

        require_once ABCFSLS_PLUGIN_DIR . 'inc/ajax-tbl.php';

        if( is_admin() ) {
            require_once ABCFSLS_PLUGIN_DIR . 'admin/class-mbox-tbl.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-a-tabs.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-c-tabs.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-field-tabs.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/staff-fields.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-layout.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-lbls.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-data.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-paging.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-print.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-col-order.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tbl-shortcode.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-tplate-field.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/cbos.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/ajax-handlers.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/txt-admin.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/txt-aurl.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/admin-scripts.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/dba.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/autil.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/admin-tabs.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/class-menu.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/v-tabs.php';

            require_once ABCFSLS_PLUGIN_DIR . 'admin/class-mbox-mfilter.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-tabs.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-labels.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-layout.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-cat.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-az.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-txt.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-drop.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-filters.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-order.php';
            require_once ABCFSLS_PLUGIN_DIR . 'admin/mbox-mfilter-shortcode.php';

            //--ISOTOPE
//            require_once ABCFSLS_PLUGIN_DIR . 'isotope/class-mbox-i-cat.php';
//            require_once ABCFSLS_PLUGIN_DIR . 'isotope/mbox-i-cat-tabs.php';
//            require_once ABCFSLS_PLUGIN_DIR . 'isotope/mbox-i-menu-layout.php';
//            require_once ABCFSLS_PLUGIN_DIR . 'isotope/mbox-i-cat-items.php';
//            require_once ABCFSLS_PLUGIN_DIR . 'isotope/mbox-i-shortcode.php';


            require_once ABCFSLS_PLUGIN_DIR . 'library/abcfl-autil.php';
            require_once ABCFSLS_PLUGIN_DIR . 'plugin-updates/plugin-update-checker.php';

            //-- Temp. Remove after Staff List has been updated with newest version of the library --------
            require_once ABCFSLS_PLUGIN_DIR . 'library/abcfl-input.php';

            $mboxTblA = new ABCFSLS_MBox_Tbl();
            $cptslsMFilter = new ABCFSLS_MBox_MFilter();

            // ISOTOPE
            //$cptslsICat = new ABCFSLS_MBox_I_Cat();

            $this->update_checker();
        }
    }

    private function update_checker(){

        $check = Puc_v4_Factory::buildUpdateChecker('http://abcfolio.net/wp-update-server/?action=get_metadata&slug=' . $this->pluginSlug,
            __FILE__,
            $this->pluginSlug,
            24);

       $check->addQueryArgFilter('abcfsls_admin_tabs_update_checker');
    }

    private function setup_actions() {
        add_action( 'load-edit.php', array( $this, 'add_custom_columns' ), 10, 2 );
    }

    //===CUSTOM COLUMNS=========================================================================================
   function add_custom_columns() {
       add_filter( 'post_row_actions', array( $this, 'duplicate_post_link'), 10, 2);
   }

    //== duplicate ==
    //Add the duplicate link to action list for post_row_actions
   function duplicate_post_link( $actions, $post ) {

        if ($post->post_type=='cptsls_tbl_a' && current_user_can('edit_posts')) {
            $actions['duplicate'] = '<a href="admin.php?action=dupslsatplate&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
        }
        return $actions;
   }


    //Add custom columns to post list admin colums
    function add_staff_columns($defaults) {
    }

    function add_template_columns($defaults) {
    }

    function render_template_columns($column_name, $postID) {
    }

    function render_staff_columns($column_name, $postID) {
       if($column_name === 'post-id'){ echo $postID; }
}

    function add_sortable_columns( $columns ) {
//       $columns[ 'menu-order' ] = 'menu-order';
//       return $columns;
    }

    function lst_items_order( $query ) {
    }
    //Add query variables to wordpress's query vars array
    function query_vars_filter( $vars ){
//        $vars[] = 'staff-category';
//      return $vars;
    }

//################################################################

    //Remove permalink and preview buttons from custom post screen.
    function remove_permalink() {
//        global $post_type;
//        if ( abcfsls_autil_post_type( $post_type ) > 0 ) {
//            echo '<style type="text/css">#edit-slug-box,#view-post-btn,#post-preview,.updated p a{display: none;}</style>';
//        }
    }

    //Remove view and quick edit from custom posts list.
    function remove_post_edit_links( $actions ){

//        $postType = get_post_type();
//        if ( abcfsls_autil_post_type( $postType ) > 0 ) {
//            unset( $actions['view'] );
//            unset( $actions['inline hide-if-no-js'] );
//        }
//        return $actions;
    }

    // TODO
    function load_textdomain() {

        $pslug = $this->pluginSlug;
        $langDir = plugin_basename( dirname( __FILE__ ) ) . '/languages';

        // Set filter for plugin's languages directory
        $langDir = apply_filters( 'abcfsls_languages_directory', $langDir );

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
/**
 * The main function responsible for returning the one true ABCFSLS_Main instance to functions everywhere.
 * Use this function like you would a global variable, except without needing to declare the global.
 *  * Example: $object = ABCFSLS_Main();
 */
function ABCFSLS_Main() {
    return ABCFSLS_Main::instance();
}
// Get plugin Running
ABCFSLS_Main();