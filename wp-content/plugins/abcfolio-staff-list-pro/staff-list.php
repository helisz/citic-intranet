<?php
/*
Plugin Name: Staff List Pro
Plugin URI: http://abcfolio.com/wordpress-plugin-staff-list/
Description:  Easily create list of staff and other type of list or grid galleries with custom links.
Author: abcFolio
Author URI: http://www.abcfolio.com
Text Domain: staff-list
Domain Path: /languages
Version: 2.0.1
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

if ( ! class_exists( 'ABCF_Staff_List' ) ) {

final class ABCF_Staff_List {

    private static $instance;
    public $pluginSlug = 'abcfolio-staff-list-pro';
    public $prefix = 'abcfsl';
    public $pluginVersion = '2.0.1';

    public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof ABCF_Staff_List ) ) {
                    self::$instance = new ABCF_Staff_List;
                    self::$instance->setup_constants();
                    self::$instance->includes();
                    self::$instance->setup_actions();
                    //add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
                    //self::$instance->load_textdomain();
            }
            return self::$instance;
    }

    private function __construct (){}

     //Throw error on object clone. We don't want the object to be cloned.
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'staff-list' ), '1.5' );
    }

    //Disable unserializing of the class
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'staff-list' ), '1.5' );
    }

    private function setup_constants() {

        // Plugin version pversion
        if ( ! defined( 'ABCFSL_VERSION' ) ) { define( 'ABCFSL_VERSION', $this->pluginVersion ); }
        if ( ! defined( 'ABCFSL_ABSPATH' ) ) {  define('ABCFSL_ABSPATH', ABSPATH); }
        // Plugin Folder QPath
        if( ! defined( 'ABCFSL_PLUGIN_DIR' ) ){ define( 'ABCFSL_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }
        // Plugin Folder URL
        if ( ! defined( '' ) ) { define( 'ABCFSL_PLUGIN_URL', plugin_dir_url( __FILE__ ) ); }
        // Plugin folder name abcfolio-staff-list
        if( ! defined( 'ABCFSL_PLUGIN_FOLDER' ) ){ define('ABCFSL_PLUGIN_FOLDER', basename( dirname(__FILE__) ) ); }
        // Plugin Root File QPath
        if ( ! defined( 'ABCFSL_PLUGIN_FILE' ) ){ define( 'ABCFSL_PLUGIN_FILE', __FILE__ ); }
        if ( ! defined( 'ABCFSL_ICONS_URL' ) ){ define( 'ABCFSL_ICONS_URL', trailingslashit(trailingslashit(ABCFSL_PLUGIN_URL) . 'images')); }
     }

    //Include required files
    private function includes() {
        require_once ABCFSL_PLUGIN_DIR . 'inc/db.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/post-types.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/scripts.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-list.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-grid-a.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-grid-b.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-social.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-spage.php';

        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-menu.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-menu-cat.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-menu-az.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-filter.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/cnt-filter-post.php';

        require_once ABCFSL_PLUGIN_DIR . 'inc/txt.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/shortcode.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/util.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/img.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/class-paginator.php';
        require_once ABCFSL_PLUGIN_DIR . 'inc/struct-data.php';

        require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-css.php';
        require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-html.php';
        require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-attr.php';
        require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-util.php';

        // ISOTOPE
        require_once ABCFSL_PLUGIN_DIR . 'isotope/cnt-js.php';
        require_once ABCFSL_PLUGIN_DIR . 'isotope/cnt-grid-ia.php';

        require_once ABCFSL_PLUGIN_DIR . 'deprecated/inc.php';

//        require_once ABCFSL_PLUGIN_DIR . 'vcard/Exception.php';
//        require_once ABCFSL_PLUGIN_DIR . 'vcard/VCard.php';
//        require_once ABCFSL_PLUGIN_DIR . 'vcard/VCardMediaException.php';
//        require_once ABCFSL_PLUGIN_DIR . 'vcard/VCardParser.php';
//        require_once ABCFSL_PLUGIN_DIR . 'vcard/Transliterator.php';

        //require_once ABCFSL_PLUGIN_DIR . 'autoloader.php';
//        require_once ABCFSL_PLUGIN_DIR . 'vcard/.php';
//        require_once ABCFSL_PLUGIN_DIR . 'vcard/.php';


        if( is_admin() ) {
            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-scripts.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/dba.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/autil.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/class-menu.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/cbos.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/class-mbox-tplate.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/class-mbox-item.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/class-mbox-cat-menu.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/class-mbox-az-menu.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/ajax-handlers.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-staff-pg-layout.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-staff-pg-cntrs.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-img.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-field-order.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-field.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-fields.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-menu.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-shortcode.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-social.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-spg-layout.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-spg-optns.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-staff-order.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-structured-data.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-tabs.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/txt-admin.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/txt-aurl.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/v-tabs.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-item-tabs.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-item-text.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-item-img.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-item-optns.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-item-social.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-cat-tabs.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-layout.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-cat-items.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-shortcode.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-no-data.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-az-tabs.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-menu-az-items.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/class-mbox-mfilter.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-mfilter-tabs.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-mfilter-labels.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-mfilter-layout.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-mfilter-cat.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-mfilter-az.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-mfilter-items.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-tabs.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-demos.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-help.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-convert.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-default-tplate.php';
            require_once ABCFSL_PLUGIN_DIR . 'admin/admin-quick-start.php';

            require_once ABCFSL_PLUGIN_DIR . 'admin/mbox-tplate-pg.php';

            require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-input.php';
            require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-mbox-save.php';
            require_once ABCFSL_PLUGIN_DIR . 'library/abcfl-autil.php';

            require_once ABCFSL_PLUGIN_DIR . 'deprecated/admin.php';
            require_once ABCFSL_PLUGIN_DIR . 'plugin-updates/plugin-update-checker.php';

            $mboxLst = new ABCFSL_MBox_List();
            $mboxLstItem = new ABCFSL_MBox_Item();
            $mboxCATMenu = new ABCFSL_MBox_CAT_Menu();
            $mboxAZMenu = new ABCFSL_MBox_AZ_Menu();
            $mboxMFilter = new ABCFSL_MBox_MFilter();

            $this->update_checker();
        }
    }

    private function update_checker(){

        $check = Puc_v4_Factory::buildUpdateChecker( 'http://abcfolio.net/wp-update-server/?action=get_metadata&slug=' . $this->pluginSlug,
                   __FILE__,
                   $this->pluginSlug,
                   24);

        $check->addQueryArgFilter('abcfsl_autil_filter_update_checks');
    }

    //===================================================================
    private function setup_actions() {

	add_action( 'plugins_loaded', array( $this, 'load_textdomain' ), 2 );
        add_action( 'admin_print_styles-post-new.php', array( $this, 'action_remove_permalink' ), 1 );
        add_action( 'admin_print_styles-post.php', array( $this, 'action_remove_permalink' ), 1000 );
        add_action( 'load-edit.php', array( $this, 'action_add_custom_columns' ), 10, 2 );

        add_action( 'restrict_manage_posts', array( $this, 'add_filter_parent_tplate' ) );
        add_filter( 'parse_query', array( $this,'filter_by_parent_tplate') );

        add_action( 'restrict_manage_posts', array( $this, 'add_filter_category' ) );

        add_filter( 'post_row_actions', array( $this, 'filter_remove_post_edit_links' ), 10, 1 );
        add_filter('query_vars', array( $this,'filter_query_vars'), 1 );
        add_filter('rewrite_rules_array', array( $this,'filter_rewrite_rules'), 1 );

        // Priority 20 sice WordPress SEO by Yoast uses priority 15. This filter should run after.
        add_filter( 'pre_get_document_title', array( $this,'filter_spage_wp_title'), 20, 3 );

        register_activation_hook( __FILE__, array( $this, 'activation' ) );
    }

    //-------------------------------------------------
    public function activation() {
        $this->add_caps( 'administrator' );
        $this->add_caps( 'editor' );
    }

    public function add_caps( $toRole ) {

        $role = get_role( $toRole );

        if ( ! is_null( $role ) ) {

            //Categories Menu
            $role->add_cap( 'staff_categories_editor' );

            // Taxonomy caps.
            $role->add_cap( 'manage_staff_categories' );
            $role->add_cap( 'assign_staff_categories' );

            //-Staff Members ---------------------------
            $role->add_cap( 'edit_staff_member');
            $role->add_cap( 'read_staff_member');
            $role->add_cap( 'read_staff_members');

            $role->add_cap( 'delete_staff_member' );
            $role->add_cap( 'edit_staff_members' );
            $role->add_cap( 'edit_others_staff_members' );

            $role->add_cap( 'publish_staff_members' );
            $role->add_cap( 'read_private_staff_members' );
            $role->add_cap( 'delete_staff_members' );

            $role->add_cap( 'delete_private_staff_members' );
            $role->add_cap( 'delete_published_staff_members' );
            $role->add_cap( 'delete_others_staff_members' );

            $role->add_cap( 'edit_private_staff_members' );
            $role->add_cap( 'edit_published_staff_members' );
        }
    }

    //== REWRITE ===========================================================
    function filter_query_vars( $vars ){
        $vars[] = 'smid';
        $vars[] = 'staff-name';
        //$vars[] = 'slpcat';
        $vars[] = 'staff-az';
        $vars[] = 'staff-category';
      return $vars;
    }

    function filter_rewrite_rules( $rules ) {

        //'(.+?)(/[0-9]+)?/?$' => 'index.php?pagename=$matches[1]&staff-category=$matches[2]&page=$matches[3]'

        $newRules = array(
            'bio/([^/]+)/?$' => 'index.php?pagename=bio&staff-name=$matches[1]',
            'profile/([^/]+)/?$' => 'index.php?pagename=profile&staff-name=$matches[1]',
            'profil/([^/]+)/?$' => 'index.php?pagename=profil&staff-name=$matches[1]',
            'perfil/([^/]+)/?$' => 'index.php?pagename=perfil&staff-name=$matches[1]',
            'profilo/([^/]+)/?$' => 'index.php?pagename=profilo&staff-name=$matches[1]'
        );
        return $newRules + $rules;
    }

    //Filter the meta title staff-bio, biografie profilo perfil
    function filter_spage_wp_title() {

        $ppPages = array( 'bio', 'profile', 'profil', 'perfil', 'profilo' );

        $ppCustomPages = array();
        if( function_exists( 'abcfslcp_custom_page_names' )){
           $ppCustomPages = abcfslcp_custom_page_names();
           $ppPages = wp_parse_args( $ppCustomPages, $ppPages );
        }

        if( is_page( $ppPages ) ){
            global $wp;
            $currentURL = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
            $nameStart = strpos($currentURL, '&staff-name=');

            if( $nameStart === false ){ return ''; }
            $staffName = substr( $currentURL, $nameStart + 12 );

            $sPgTitle = abcfsl_db_spg_title_by_pretty( $staffName );
            if( !empty( $sPgTitle ) ){ return $sPgTitle;}
        }
        return '';
    }

//if( is_page( array( 'about-us', 'contact', 'management' ) )
//     //either in about us, or contact, or management page is in view
//else
//     //none of the page about us, contact or management is in view

//    function filter_spage_wp_title() {
//
//        $ppPages = array( 'bio', 'profile', 'profil', 'perfil', 'profilo' );
//
//        if(is_page('profile') || is_page('bio') || is_page('profil') || is_page('profilo') || is_page('perfil')){
//            global $wp;
//            $currentURL = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
//            $nameStart = strpos($currentURL, '&staff-name=');
//
//            if( $nameStart === false ){ return ''; }
//            $staffName = substr( $currentURL, $nameStart + 12 );
//
//            $sPgTitle = abcfsl_db_spg_title_by_pretty( $staffName );
//            if( !empty( $sPgTitle ) ){ return $sPgTitle;}
//        }
//        return '';
//    }


    //== Staff Members - Admin Screen - Add template filter  =================
    function add_filter_parent_tplate() {

        global $typenow;
	$postType = 'cpt_staff_lst_item';

	if ($typenow == $postType) {

            $pTplateID = intval(isset( $_GET['pTplateID'] ) ? esc_attr( $_GET['pTplateID'] ) : 0);

            $cboTplates = abcfsl_dba_cbo_tplates( abcfsl_txta(204) );
            $items = abcfl_input_cbo_get_options_strings( $cboTplates, $pTplateID );
            echo  '<select type="text" id="pTplateID" name="pTplateID" >' . $items . '</select>';
        }
    }

    function filter_by_parent_tplate( $query ) {

        if ( strpos($_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php') !== false ) {

            if( is_admin() AND $query->query['post_type'] == 'cpt_staff_lst_item' ) {
                $pTplateID = isset( $_GET['pTplateID'] ) ? esc_attr( $_GET['pTplateID'] ) : 0;
                if( $pTplateID > 0 ){
                    $qv = &$query->query_vars;
                    $qv['post_parent'] = $pTplateID;
                }
            }
        }
    }

    function add_filter_category() {

            global $typenow;
            $postType = 'cpt_staff_lst_item';

            if ($typenow == $postType) {

                //get taxonomy associated with current post type
                //$taxonomies = get_object_taxonomies( $postType );
                $taxonomies = array('tax_staff_member_cat');

                foreach ( $taxonomies as $taxSlug) {
                        $taxObj = get_taxonomy( $taxSlug );
                        //$taxName = $taxObj->labels->name;
                        $terms = get_terms( $taxSlug );
                        echo "<select name='$taxSlug' id='$taxSlug' class='postform'>";
                        echo "<option value=''>All Categories</option>";
                        foreach ($terms as $term) {
                                $label = (isset($_GET[$taxSlug])) ? $_GET[$taxSlug] : ''; // Fix
                                echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' .
                                        $term->name .' (' . $term->count .')</option>';
                        }
                        echo "</select>";
                }
            }
    }

    //=== CUSTOM COLUMNS ========================================================
   function action_add_custom_columns() {

        add_filter( 'manage_cpt_staff_lst_item_posts_columns', array( $this,'add_staff_columns'), 10 );
        add_action( 'manage_cpt_staff_lst_item_posts_custom_column', array( $this, 'render_staff_columns' ), 10, 2 );
        add_filter( 'manage_edit-cpt_staff_lst_item_sortable_columns', array( $this, 'add_sortable_columns' ));
        add_filter( 'post_row_actions', array( $this, 'duplicate_post_link'), 10, 2);

        add_filter( 'manage_cpt_staff_lst_posts_columns', array( $this,'add_template_columns'), 10 );
        add_action( 'manage_cpt_staff_lst_posts_custom_column', array( $this, 'render_template_columns' ), 10, 2 );

        add_action( 'pre_get_posts', array( $this, 'lst_items_order'));
    }

    //== duplicate ==
    //Add the duplicate link to action list for post_row_actions
   function duplicate_post_link( $actions, $post ) {
        if ($post->post_type=='cpt_staff_lst' && current_user_can('edit_posts')) {
            $actions['duplicate'] = '<a href="admin.php?action=dupsltplate&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
        }
        return $actions;
   }

    //Add custom columns to post list admin colums
    function add_staff_columns($defaults) {

        $defaults['menu-order'] = 'Order';
        $defaults['tplate'] = 'Template';
        $defaults['item-img'] = 'Image';
        $defaults['post-id'] = 'ID';
        return $defaults;
    }

    function add_template_columns($defaults) {

        $defaults['post-id'] = 'ID';
        return $defaults;
    }

    function render_template_columns($column_name, $postID) {
        if($column_name === 'post-id'){ echo $postID; }
    }

    function render_staff_columns($column_name, $postID) {

        $lstName = '';
        if ($column_name == 'tplate') {

            $parentID = wp_get_post_parent_id( $postID );
            if($parentID){
                $parent = get_post($parentID);
                if($parent){$lstName = $parent->post_title;}
            }
            echo $lstName;
        }

        if ($column_name == 'item-img') {
            //$optns = get_post_custom($postID);
            //$imgUrl = isset( $optns['_imgUrlL'] ) ? esc_attr( $optns['_imgUrlL'][0] ) : '';
            $imgUrl = get_post_meta( $postID, '_imgUrlL', true );
            echo abcfl_html_img_tag('', $imgUrl, '', '', 60);
        }

        if ($column_name == 'menu-order') { echo get_post_field( 'menu_order', $postID ); }
        if ($column_name == 'lst-id') {  echo get_post_field( 'post_parent', $postID ); }
        if($column_name === 'post-id'){ echo $postID; }
}

    function add_sortable_columns( $columns ) {
       //$columns[ 'lst-id' ] = 'lst-id';
       $columns[ 'menu-order' ] = 'menu-order';
       return $columns;
    }

    function lst_items_order( $query ) {

//        if ( ! is_admin ) {
//            return;
//        }

       $postType = $query->get('post_type');

        if ( $postType == 'cpt_staff_lst_item') {
            if ( $query->get( 'orderby' ) == '' ) {
                $query->set( 'orderby', array( 'post_parent' => 'ASC', 'menu_order' => 'ASC',  ));
            }
            /* Post Order: ASC / DESC */
            if( $query->get( 'order' ) == '' ){
                $query->set( 'order', 'ASC' );
            }
        }
    }

//################################################################

    //Remove permalink and preview buttons from custom post screen.
    function action_remove_permalink() {
        global $post_type;
        if ( abcfsl_autil_post_type( $post_type ) > 0 ) {
            echo '<style type="text/css">#edit-slug-box,#view-post-btn,#post-preview,.updated p a{display: none;}</style>';
        }
    }

    //Remove view and quick edit from custom posts list.
    function filter_remove_post_edit_links( $actions ){

        $postType = get_post_type();
        if ( abcfsl_autil_post_type( $postType ) > 0 ) {
            unset( $actions['view'] );
        }

        if ( abcfsl_autil_post_type( $postType ) !=2 ) {
            unset( $actions['inline hide-if-no-js'] );
        }
        return $actions;
    }

    // TODO
    function load_textdomain() {

        $pslug = $this->pluginSlug;
        $langDir = plugin_basename( dirname( __FILE__ ) ) . '/languages';

        // Set filter for plugin's languages directory
        $langDir = apply_filters( 'abcfsl_languages_directory', $langDir );

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
 * The main function responsible for returning the one true ABCFSL_Main instance to functions everywhere.
 * Use this function like you would a global variable, except without needing to declare the global.
 *  * Example: $object = ABCFSL_Main();
 */
function ABCFSL_Main() {
    return ABCF_Staff_List::instance();
}
// Get plugin Running
ABCFSL_Main();

