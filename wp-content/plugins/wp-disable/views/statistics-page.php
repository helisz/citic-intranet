<?php

function addon_download_link( $plugin_slug ){

	$ret = false;

	if( ! function_exists('plugins_api') ){
		include_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
	}

	$plugin_info = plugins_api( 'plugin_information', array(
		'slug' => $plugin_slug,
		'fields' => array(
			'short_description' => false,
			'sections' => false,
			'requires' => false,
			'rating' => false,
			'ratings' => false,
			'downloaded' => false,
			'last_updated' => false,
			'added' => false,
			'tags' => false,
			'compatibility' => false,
			'homepage' => false,
			'donate_link' => false,
		),
	) );

	if ( ! is_wp_error( $plugin_info ) ) {
		$ret = isset( $plugin_info->download_link ) ? $plugin_info->download_link : false;
	}

	return $ret;
}

function echo_stats_size( $valid, $size ){
	$e = __( 'n/a', 'wpperformance' );
	if( $valid ){
		$size = size_format( $size );
		$e = $size ? $size : '0 B';
	}
	echo $e;
}

function echo_addon_state_color( $activated, $installed ){
	echo $installed ? ( $activated ? 'green' : 'orange' ) : 'red';
}

$str_i18n = array(
	'n/a'	=> __( 'n/a', 'wpperformance' ),
	'install' => __( 'Install', 'wpperformance' ),
	'activate' => __( 'Activate', 'wpperformance' ),
	'deactivate' => __( 'Deactivate', 'wpperformance' ),
	'page_title' => __( '%1$s Optimisation.io - Statistics %2$s', 'wpperformance' ),
);

$wp_disable_file = 'wp_disable/wpperformance.php';
$wp_cache_file = 'cache-performance/optimisationio.php';
$image_compress_file = 'wp-image-compression/wp-image-compression.php';

$wp_disable_installed = file_exists( WP_PLUGIN_DIR . '/' . $wp_disable_file );
$wp_cache_installed = file_exists( WP_PLUGIN_DIR . '/' . $wp_cache_file );
$image_compress_installed = file_exists( WP_PLUGIN_DIR . '/' . $image_compress_file );

$wp_disable_enabled = $wp_disable_installed && is_plugin_active( $wp_disable_file );
$wp_cache_enabled = $wp_cache_installed && is_plugin_active( $wp_cache_file );
$image_compress_enabled = $image_compress_installed && is_plugin_active( $image_compress_file );

$enabled_number = (int) $wp_disable_enabled + (int) $wp_cache_enabled + (int) $image_compress_enabled;

if ( $image_compress_enabled ) {
	global $wpdb;
	$image_compress_info = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "image_compression_settings", ARRAY_A);
}

if( $wp_cache_enabled ){
	$cache_info = Optimisationio_CacheEnabler::get_optimisation_info();
}

$addons = array(
	// @note: Disabled until add statistics/addons page into the rest of plugins.
	/*array(
		'slug'	=> 'wp-disable',
		'title' => 'WP Disable',
		'file' => $wp_disable_file,
		'thumb'	=> plugin_dir_url( dirname( __FILE__ ) ) . 'images/wp-disable.jpg',
		'homepage'	=> 'https://wordpress.org/plugins/wp-disable/',
		'download_link'	=> addon_download_link('wp-disable'),
		'installed' => $wp_disable_installed,
		'activated' => $wp_disable_enabled,
		'description' => __( 'Improve WordPress performance by disabling unused items.', 'wpperformance' ),
	),*/
	array(
		'slug'	=> 'cache-performance',
		'title' => 'Cache for WordPress Performance',
		'file' => $wp_cache_file,
		'thumb'	=> plugin_dir_url( dirname( __FILE__ ) ) . 'images/optimisation-1.jpg',
		'homepage'	=> esc_url('https://wordpress.org/plugins/cache-performance/'),
		'download_link'	=> addon_download_link('cache-performance'),
		'installed' => $wp_cache_installed,
		'activated' => $wp_cache_enabled,
		'description' => __( 'Simple efficient WordPress caching.', 'wpperformance' ),
	),
	array(
		'slug'	=> 'wp-image-compression',
		'title' => 'JPG, PNG Compression and Optimization',
		'file' => $image_compress_file,
		'thumb'	=> plugin_dir_url( dirname( __FILE__ ) ) . 'images/wp-image-compression.jpg',
		'homepage'	=> 'https://wordpress.org/plugins/wp-image-compression/',
		'download_link'	=> addon_download_link('wp-image-compression'),
		'installed' => $image_compress_installed,
		'activated' => $image_compress_enabled,
		'description' => __( 'Image Compression and resizing - Setup under the Tools menu', 'wpperformance' ),
	),
);

?>

<div class="wrap">
	
	<h2><?php echo sprintf( $str_i18n['page_title'], '<strong>', '</strong>' ); ?></h2>
	
	<br/>

	<div class="wrap-main">
		
		<div class="wrap-stats">

			<div class="wrap-inner">

				<div class="stats-section">

					<div class="header"><h3>WP Disable</h3></div>
					
					<div class="main">
						<div class="inner">
							<ul>
								<li><?php esc_html_e( 'External requests saved', '' ); ?></li>
								<li><?php echo $wp_disable_enabled ? WpPerformance::saved_external_requests() : $str_i18n['n/a']; ?></li>
							</ul>
						</div>
					</div>

				</div>

				<div class="stats-section">

					<div class="header"><h3>Cache for WordPress Performance</h3></div>
					
					<div class="main">

						<div class="inner">
							<ul>
								<li><?php esc_html_e( 'Cache size', 'wpperformance' ); ?></li>
								<li><?php echo_stats_size( $wp_cache_enabled, $wp_cache_enabled ? Optimisationio_CacheEnabler::get_cache_size() : 0 ); ?></li>
							</ul>
							<ul>
								<li><?php esc_html_e( 'Database size', 'wpperformance' ); ?></li>
								<li><?php echo_stats_size( $wp_cache_enabled, $wp_cache_enabled ? $cache_info->optimised_size : 0 ); ?></li>
							</ul>
							<ul>
								<li><?php esc_html_e( 'Database before cleanups', 'wpperformance' ); ?></li>
								<li><?php echo_stats_size( $wp_cache_enabled, $wp_cache_enabled ? $cache_info->size : 0 ); ?></li>
							</ul>
							<ul>
								<li><?php esc_html_e( 'Database size saved', 'wpperformance' ); ?></li>
								<li><?php echo_stats_size( $wp_cache_enabled, $wp_cache_enabled ? $cache_info->saving : 0 ); ?></li>
							</ul>
						</div>

					</div>

				</div>

				<div class="stats-section">

					<div class="header"><h3>JPG, PNG Compression and Optimization</h3></span></div>
					
					<div class="main">

						<div class="inner">
							<ul>
								<li><?php esc_html_e( 'Compressed images', 'wpperformance' ); ?></li>
							    <li><?php echo $image_compress_enabled ? $image_compress_info['total_image_optimized'] : $str_i18n['n/a']; ?></li>
							</ul>
							<ul>
								<li><?php esc_html_e( 'Size saved', 'wpperformance' ); ?></li>
							    <li><?php echo_stats_size( $image_compress_enabled, $image_compress_enabled ? 1000 * $image_compress_info['total_size_optimized'] : 0 ); ?></li>
							</ul>
						</div>

					</div>

				</div>

			</div>

		</div>
		
		<div class="wrap-addons">

			<div class="wrap-inner">
				<?php
				foreach( $addons as $k => $v ){
					?>
					<div class="stats-section">

						<div class="header"><span class="state <?php echo_addon_state_color( $v['activated'], $v['installed'] ); ?>"></span><h3><?php echo $v['title']; ?></h3><span class="on-process"></span></div>
						
						<div class="main">

							<div class="inner addon-inner">
								<a href="<?php echo esc_url( $v['homepage'] ); ?>" target="_blank" style="background-image:url(<?php echo esc_url( $v['thumb'] ); ?>);"></a>
								<p><?php echo $v['description']; ?></p>
								<div class="addon-buttons" 
									 data-slug="<?php echo esc_attr($v['slug']); ?>" 
									 data-file="<?php echo esc_attr($v['file']); ?>"
									 data-link="<?php echo esc_attr($v['download_link']); ?>">

									<button class="button button-primary install-addon <?php echo ! $v['installed'] ? '' : 'hidden'; ?>">
										<?php echo $str_i18n['install'] ?>
									</button>
									
									<button class="button button-primary activate-addon <?php echo $v['installed'] && ! $v['activated'] ? '' : 'hidden'; ?>"><?php echo $str_i18n['activate'] ?></button>
									
									<?php
									if( $v['installed'] && $v['activated'] ){
										if( 1 === $enabled_number ){
											$cn = "disabled";
											$cn = "";
										}
										else{
											$cn = "";
										}
									}
									else{
										$cn = "hidden";
									}
									?>
									<button class="button deactivate-addon <?php echo $cn; ?>"><?php echo $str_i18n['deactivate'] ?></button>

								</div>
							</div>

						</div>

					</div>

					<?php
				} ?>
			</div>

		</div>

	</div>

	<?php wp_nonce_field( 'optimisationio-addons-nonce', 'optimisationio_addons_nonce' ); ?>

</div>

<script type="text/javascript">
	(function ($) {

		"use strict";

		function on_action_click( $btn, action ){
			
			var slug, file, link, $parent;

			if( ! $btn.hasClass("disabled") ){
				
				$btn.addClass("disabled");

				$parent = $btn.parent('.addon-buttons');

				slug = $parent.data('slug');
				file = $parent.data('file');
				link = $parent.data('link');

				/*switch( action ){
					case 'install':
						console.log("INSTALL ", slug);
						break;
					case 'activate':
						console.log("ACTIVATE ", slug);
						break;
					case 'deactivate':
						console.log("DEACTIVATE ", slug);
						break;
				}*/

				ajax_request( action, slug, file, link, $btn );
			}
		}

		function ajax_request(action, slug, file, link, $btn){

			$.ajax({
                type: 'post',
                url: ajaxurl,
                data:{
                	action: 'optimisationio_' + action + '_addon',
                	slug: slug,
                	file: file,
                	link: link,
                	nonce: $('#optimisationio_addons_nonce').val(),
                },
                dataType: 'json',
                success: function (data, textStatus, XMLHttpRequest) {
                	
                	var to_activate, $state_light;

                	if( 0 !== data.error ){
                		console.error(data.msg);
                		$btn.removeClass("disabled");
                	}
                	else{
                		$state_light = $btn.parents('.stats-section').find('.header .state');
                		switch(action){
                			case 'install':
                				to_activate = 'activate';
                				$state_light.removeClass('red').addClass('orange');
                				break;
							case 'activate':
								to_activate = 'deactivate';
								$state_light.removeClass('orange').addClass('green');
								break;
							case 'deactivate':
								to_activate = 'activate';
								$state_light.removeClass('green').addClass('orange');
								break;
                		}

                		if( to_activate ){
	                		$btn.parent('.addon-buttons').find('.' + to_activate + '-addon').removeClass('hidden').removeClass("disabled");
	                		$btn.addClass("hidden");
	                	}
                	}
                },
                error: function (data, textStatus, XMLHttpRequest) {
                	console.error("ERROR: ", slug, action);
                	console.log(data);
                }
            });
		}

		$(function () {
			$('.install-addon').on('click', function(){ on_action_click( $(this), 'install' ); });
			$('.activate-addon').on('click', function(){ on_action_click( $(this), 'activate' ); });
			$('.deactivate-addon').on('click', function(){ on_action_click( $(this), 'deactivate' ); });
		});
	}(jQuery));
</script>