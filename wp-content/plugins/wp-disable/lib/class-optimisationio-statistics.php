<?php
class Optimisationio_Statistics {

	private static $instance = null;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'statistics_menu' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'statistics_page_styles' ) );
		add_action( 'wp_ajax_optimisationio_install_addon', array( $this, 'ajax_install_addon' ) );
		add_action( 'wp_ajax_optimisationio_deactivate_addon', array( $this, 'ajax_deactivate_addon' ) );
		add_action( 'wp_ajax_optimisationio_activate_addon', array( $this, 'ajax_activate_addon' ) );
	}

	public static function init(){
		if( null === self::$instance ){
			self::$instance = new self();
		}
	}

	public function statistics_menu() {

		global $admin_page_hooks;

		if( isset( $admin_page_hooks['optimisationio-wp-disable'] ) ){
			$parent_item_id = 'optimisationio-wp-disable';
		}
		else if( isset( $admin_page_hooks['wp-convertor'] ) ){
			$parent_item_id = 'wp-convertor';
		}
		else if( isset( $admin_page_hooks['optimisationio-performance-cache'] ) ) {
			$parent_item_id = 'optimisationio-performance-cache';
		}

		add_submenu_page( $parent_item_id, __( 'Statistics', 'wpperformance' ), __( 'Statistics', 'wpperformance' ), 'manage_options', 'optimisationio-stats', array( $this, 'statistics_page' ) );
	}

	public function statistics_page() {
		require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'views/statistics-page.php' );
	}

	public function statistics_page_styles($hook){
		if ( 'optimisation-io_page_optimisationio-stats' === $hook ) {
			wp_enqueue_style( 'optimisationio-stats-page', plugin_dir_url( dirname( __FILE__ ) ) . 'css/optimisationio-statistics.css' );
		}
	}

	private function wp_verify_nonce($nonce){
		return wp_verify_nonce( $nonce, 'optimisationio-addons-nonce' );
	}

	public function ajax_install_addon(){
		
		$post_req = $_POST;	// Input var okay.
		
		$ret = array( 'error'	=> 1 );

		if( $this->wp_verify_nonce( $post_req['nonce'] ) ){

			if( isset( $post_req['link'] ) && $post_req['link'] ){
			
				global $wp_filesystem;

				if ( ! $wp_filesystem ) {
					if ( ! function_exists( 'WP_Filesystem' ) ) {
						require_once( ABSPATH . 'wp-admin/includes/file.php' );
					}
					WP_Filesystem();
				}

				// @note: Check if plugins root folder is writable.
				if ( ! WP_Filesystem( false, WP_PLUGIN_DIR ) || 'direct' !== $wp_filesystem->method ) {
					$ret['msg'] = 'You are not allowed to edt folders/files on this site';
				}
				else {
					
					ob_start();
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
					require_once( ABSPATH . 'wp-admin/includes/misc.php' );
					require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
					require_once( 'class-optimisationio-upgrader-skin.php' );
					$upgrader = new Plugin_Upgrader( new Optimisationio_Upgrader_Skin() );
					$install = $upgrader->install( $post_req['link'] );
					ob_end_clean();

					if( null === $install ){
						$ret['msg'] = 'Could not complete add-on installation';
					}
					else{
						$ret['error'] = 0;
					}

				}

			}
			else{
				$ret['msg'] = "Invalid addon";
			}
		}
		else{
			$ret['msg'] = "Invalid user";
		}

		wp_send_json( $ret );
	}

	public function ajax_activate_addon(){
		
		$post_req = $_POST;	// Input var okay.
		
		$ret = array( 'error'	=> 1 );

		if( $this->wp_verify_nonce( $post_req['nonce'] ) ){

			if( isset( $post_req['file'] ) && $post_req['file'] ){
			
				$result = activate_plugin( $post_req['file'] );

				if ( ! is_wp_error( $result ) ) {
					$ret['error'] = 0;
					$ret['msg'] = "Successful activation";
				}
				else{
					$ret['msg'] = "Activation error";
				}
			}
			else{
				$ret['msg'] = "Invalid addon";
			}
		}
		else{
			$ret['msg'] = "Invalid user";
		}

		wp_send_json( $ret );
	}

	public function ajax_deactivate_addon(){
		
		$post_req = $_POST;	// Input var okay.
		
		$ret = array( 'error'	=> 1 );

		if( $this->wp_verify_nonce( $post_req['nonce'] ) ){

			if( isset( $post_req['file'] ) && $post_req['file'] ){
			
				$result = deactivate_plugins( $post_req['file'] );

				if ( ! is_wp_error( $result ) ) {
					$ret['error'] = 0;
					$ret['msg'] = "Successful deactivation";
				}
				else{
					$ret['msg'] = "Dectivation error";
				}
			}
			else{
				$ret['msg'] = "Invalid addon";
			}
		}
		else{
			$ret['msg'] = "Invalid user";
		}

		wp_send_json( $ret );
	}
}