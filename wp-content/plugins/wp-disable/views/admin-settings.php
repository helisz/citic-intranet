<?php

$public_post_types = get_post_types( array(
	'public' => true,
) );

?>
<div class="wrap wp-disable">
	<h2><!-- Wordpress messages will display here automatically --></h2>
	<div id="icon-options-general" class="icon32"><br /></div>
	<header>
		<div class="col-left">
			<h2>WordPress Disable - Improve Performances</h2>
			<small>Improve performance and reduce HTTP requests.</small>
		</div>
		<div class="col-right"><strong>Help us build a better product</strong>
			<p><a target="blank" href="https://wordpress.org/plugins/wp-disable/">Rate us on WordPress.org</a></p>
			<?php /* ?><div class="stars"></div><?php */ ?>
		</div>
	</header>
	<div class="container">
		<form method="post" action="<?php echo admin_url( 'tools.php?page=updatewpperformance-settings' ); ?>" style="display:inline-block;width:100%;">
			<div class="tab-wrap">

				<ul class="tabs">
					<li class="tab-link current" data-tab="tab-1"><?php esc_html_e( 'Requests', 'wpperformance' ); ?></li>
					<li class="tab-link" data-tab="tab-2"><?php esc_html_e( 'WooCommerce', 'wpperformance' ); ?></li>
					<li class="tab-link" data-tab="tab-3"><?php esc_html_e( 'Tags', 'wpperformance' ); ?></li>
					<li class="tab-link" data-tab="tab-4"><?php esc_html_e( 'Admin', 'wpperformance' ); ?></li>
					<li class="tab-link" data-tab="tab-5"><?php esc_html_e( 'Others', 'wpperformance' ); ?></li>
				</ul>

				<div id="tab-1" class="tab-content current">
					<div class="form">
						<div class="disable-form disable_settings">
							<div class="form-group">
								<span><?php esc_html_e( 'Disable Emojis', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_emoji" type="checkbox" id="disable_emoji" <?php if ( isset( $settings['disable_emoji'] ) && 1 === $settings['disable_emoji'] ) { echo 'checked="checked"'; } ?> value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Remove Querystrings', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_querystrings" <?php if ( isset( $settings['remove_querystrings'] ) && 1 === $settings['remove_querystrings'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_querystrings" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable Embeds', 'wpperformance' ); ?></span>
								<label class="switch">
									<td style="width:300px; text-align:left;"><input name="disable_embeds" type="checkbox" id="disable_embeds" <?php if ( isset( $settings['disable_embeds'] ) && 1 === $settings['disable_embeds'] ) { echo 'checked="checked"'; } ?> value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable Google Maps', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_google_maps" <?php if ( isset( $settings['disable_google_maps'] ) && 1 === $settings['disable_google_maps'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_google_maps" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>

							<div class="form-group">
								<span><?php printf( __( 'Minimize requests and load %1$sGoogle Fonts%2$s asynchronous', 'wpperformance' ), '<strong>', '</strong>' ); ?></span>
								<label class="switch">
									<input name="lazy_load_google_fonts" <?php if ( isset( $settings['lazy_load_google_fonts'] ) && 1 === $settings['lazy_load_google_fonts'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="lazy_load_google_fonts" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>

							<div class="form-group">	
								<span><?php printf( __( 'Minimize requests and load %1$sFont Awesome%2$s asynchronous', 'wpperformance' ), '<strong>', '</strong>' ); ?></span>
								<label class="switch">
									<input name="lazy_load_font_awesome" <?php if ( isset( $settings['lazy_load_font_awesome'] ) && 1 === $settings['lazy_load_font_awesome'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="lazy_load_font_awesome" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>


							<div class="form-group">
								<span><?php esc_html_e( 'Disable WordPress password strength meter js on non related pages', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_wordpress_password_meter" <?php if ( isset( $settings['disable_wordpress_password_meter'] ) && 1 === $settings['disable_wordpress_password_meter'] ) { echo 'checked="checked"'; } ?>  type="checkbox" id="disable_wordpress_password_meter" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>

						</div>
					</div>
				</div>

				<div id="tab-2" class="tab-content">
					<div class="form">
						<div class="disable-form disable_settings">
							<div class="form-group">
								<span><?php esc_html_e( 'Disable WooCommerce scripts and CSS on non WooCommerce pages', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_woocommerce_non_pages" <?php if ( isset( $settings['disable_woocommerce_non_pages'] ) && 1 === $settings['disable_woocommerce_non_pages'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_woocommerce_non_pages" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable WooCommerce Reviews', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_woocommerce_reviews" <?php if ( isset( $settings['disable_woocommerce_reviews'] ) && 1 === $settings['disable_woocommerce_reviews'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_woocommerce_reviews" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Defer WooCommerce Cart Fragments', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_woocommerce_cart_fragments" <?php if ( isset( $settings['disable_woocommerce_cart_fragments'] ) && 1 === $settings['disable_woocommerce_cart_fragments'] ) { echo 'checked="checked"'; } ?>  type="checkbox" id="disable_woocommerce_cart_fragments" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable WooCommerce password strength meter js on non related pages', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_woocommerce_password_meter" <?php if ( isset( $settings['disable_woocommerce_password_meter'] ) && 1 === $settings['disable_woocommerce_password_meter'] ) { echo 'checked="checked"'; } ?>  type="checkbox" id="disable_woocommerce_password_meter" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div id="tab-3" class="tab-content">
					<div class="form">
						<div class="disable-form disable_settings">
							<div class="form-group">
								<span><?php esc_html_e( 'Remove RSD (Really Simple Discovery) tag', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_rsd" <?php if ( isset( $settings['remove_rsd'] ) && 1 === $settings['remove_rsd'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_rsd" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Remove Shortlink Tag', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_shortlink_tag" <?php if ( isset( $settings['remove_shortlink_tag'] ) && 1 === $settings['remove_shortlink_tag'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_shortlink_tag" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Remove Wordpress API from header', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_wordpress_api_from_header" <?php if ( isset( $settings['remove_wordpress_api_from_header'] ) && 1 === $settings['remove_wordpress_api_from_header'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_wordpress_api_from_header" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Remove Windows Live Writer tag', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_windows_live_writer" <?php if ( isset( $settings['remove_windows_live_writer'] ) && 1 === $settings['remove_windows_live_writer'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_windows_live_writer" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Remove Wordpress Generator Tag', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_wordpress_generator_tag" <?php if ( isset( $settings['remove_wordpress_generator_tag'] ) && 1 === $settings['remove_wordpress_generator_tag'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_wordpress_generator_tag" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div id="tab-4" class="tab-content">
					<div class="form">
						<div class="disable-form disable_settings">
							<div class="form-group">
								<span><?php esc_html_e( 'Posts revisions number', 'wpperformance' ); ?></span>
								<label class="switch" style="width:auto;">
									<?php
									$revisions_num = array(
										'default' => __( 'WordPress default', 'wpperformance' ),
										'0' => 0,
										'3' => 3,
										'5' => 5,
										'10' => 10,
									);
									$selected_val = 'default';
									if ( isset( $settings['disable_revisions'] ) ) {

										if ( 0 === $settings['disable_revisions'] ) {
											$selected_val = 'default';	// @note: Cover older plugin's version possible value.
										} elseif ( 1 === $settings['disable_revisions'] ) {
											$selected_val = 0;	// @note: Cover older plugin's version possible value.
										} else {
											$selected_val = isset( $revisions_num[ $settings['disable_revisions'] ] ) ? $settings['disable_revisions'] : 'default';
										}
									}
									?>
									<select name="disable_revisions" style="height:100%;border-color:#dedede;border-radius:2px;">
										<?php
										foreach ( $revisions_num as $key => $val ) {
											if ( 'default' === $selected_val ) {
												$is_selected = $selected_val === $key;
											} else {
												$is_selected = (int) $selected_val === (int) $key;
											}
											echo '<option value="' . esc_attr( $key ) . '" ' . ( $is_selected ? ' selected' : '' ) . '>' . $val . '</option>';
										}
										?>
									</select>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable Autosave', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_autosave" <?php if ( isset( $settings['disable_autosave'] ) && 1 === $settings['disable_autosave'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_autosave" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable all comments', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_all_comments" <?php if ( isset( $settings['disable_all_comments'] ) && 1 === $settings['disable_all_comments'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_all_comments" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group comments-group">
								<span><?php esc_html_e( 'Disable comments on certain post types', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_comments_on_certain_post_types" <?php if ( isset( $settings['disable_comments_on_certain_post_types'] ) && 1 === $settings['disable_comments_on_certain_post_types'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_comments_on_certain_post_types" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<?php
							foreach ( $public_post_types as $key => $value ) { ?>
								<div class="form-group comments-group certain-posts-comments-group">
									<span><?php printf( __( 'Disable comments on post type "%1$s%2$s%3$s"', 'wpperformance' ), '<strong>', $value, '</strong>' ); ?></span>
									<label class="switch">
										<input name="disable_comments_on_post_types[<?php echo $value; ?>]" type="checkbox" value="1" <?php echo isset( $settings['disable_comments_on_post_types'][ $value ] ) && 1 === (int) $settings['disable_comments_on_post_types'][ $value ] ? 'checked="checked"': ''; ?> />
										<div class="slider round"></div>
									</label>
								</div> <?php
							} ?>
							<div class="form-group comments-group">
								<span><?php esc_html_e( 'Close comments after 28 days', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="close_comments" <?php if ( isset( $settings['close_comments'] ) && 1 === $settings['close_comments'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="close_comments" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group comments-group">
								<span><?php esc_html_e( 'Paginate comments at 20', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="paginate_comments" <?php if ( isset( $settings['paginate_comments'] ) && 1 === $settings['paginate_comments'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="paginate_comments" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group comments-group">
								<span><?php esc_html_e( 'Remove links from comments', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="remove_comments_links" <?php if ( isset( $settings['remove_comments_links'] ) && 1 === $settings['remove_comments_links'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="remove_comments_links" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Heartbeat frequency', 'wpperformance' ); ?></span>
								<label class="switch" style="width:auto">
									<?php
									$seconds = ' ' . __( 'seconds', 'wpperformance' );
									$heartbeat_frequencies = array(
										'default' => __( 'WordPress default', 'wpperformance' ),
										'15' => 15 . $seconds,
										'20' => 20 . $seconds,
										'25' => 25 . $seconds,
										'30' => 30 . $seconds,
										'35' => 35 . $seconds,
										'40' => 40 . $seconds,
										'45' => 45 . $seconds,
										'50' => 50 . $seconds,
										'55' => 55 . $seconds,
										'60' => 60 . $seconds,
									);
									$selected_val = 'default';
									if ( isset( $settings['heartbeat_frequency'] ) ) {
										$selected_val = isset( $heartbeat_frequencies[ $settings['heartbeat_frequency'] ] ) ? $settings['heartbeat_frequency'] : 'default';
									}
									?>
									<select name="heartbeat_frequency" style="height:100%;border-color:#dedede;border-radius:2px;">
										<?php
										foreach ( $heartbeat_frequencies as $key => $val ) {
											if ( 'default' === $selected_val ) {
												$is_selected = $selected_val === $key;
											} else {
												$is_selected = (int) $selected_val === (int) $key;
											}
											echo '<option value="' . esc_attr( $key ) . '" ' . ( $is_selected ? ' selected' : '' ) . '>' . $val . '</option>';
										}
										?>
									</select>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Heartbeat locations', 'wpperformance' ); ?></span>
								<label class="switch" style="width:auto">
									<?php
									$heartbeat_location = array(
										'default' => __( 'WordPress default', 'wpperformance' ),
										'disable_everywhere' => __( 'Disable everywhere', 'wpperformance' ),
										'disable_on_dashboard_page' => __( 'Disable on dashboard page', 'wpperformance' ),
										'allow_only_on_post_edit_pages' => __( 'Allow only on post edit pages', 'wpperformance' ),
									);
									$selected_val = 'default';
									if ( isset( $settings['heartbeat_location'] ) ) {
										$selected_val = isset( $heartbeat_location[ $settings['heartbeat_location'] ] ) ? $settings['heartbeat_location'] : 'default';
									}
									?>
									<select name="heartbeat_location" style="height:100%;border-color:#dedede;border-radius:2px;">
										<?php
										foreach ( $heartbeat_location as $key => $val ) {
											$is_selected = $selected_val === $key;
											echo '<option value="' . esc_attr( $key ) . '" ' . ( $is_selected ? ' selected' : '' ) . '>' . $val . '</option>';
										}
										?>
									</select>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div id="tab-5" class="tab-content">
					<div class="form">
						<div class="disable-form disable_settings">
							<div class="form-group">
								<span><?php esc_html_e( 'Disable Gravatars', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_gravatars" <?php if ( isset( $settings['disable_gravatars'] ) && 1 === $settings['disable_gravatars'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_gravatars" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable pingbacks and trackbacks', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="default_ping_status" <?php if ( isset( $settings['default_ping_status'] ) && 1 === $settings['default_ping_status'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="default_ping_status" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>							
							<div class="form-group">
								<span><?php esc_html_e( 'Disable feeds', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_rss" <?php if ( isset( $settings['disable_rss'] ) && 1 === $settings['disable_rss'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_rss" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group feeds-group">
								<label>
									<input type="radio" name="disabled_feed_behaviour" value="redirect" <?php echo isset( $settings['disabled_feed_behaviour'] ) && '404_error' !== $settings['disabled_feed_behaviour'] ? 'checked="checked"' : ''; ?> /> <span><?php esc_html_e( 'Redirect feed requests to corresponding HTML content', 'wpperformance' ); ?></span>
								</label>
								<br/>
								<label>
									<input type="radio" name="disabled_feed_behaviour" value="404_error" <?php echo isset( $settings['disabled_feed_behaviour'] ) && '404_error' === $settings['disabled_feed_behaviour'] ? 'checked="checked"' : ''; ?> /> <span><?php esc_html_e( 'Issue a Page Not Found (404) error for feed requests', 'wpperformance' ); ?></span>
								</label>
							</div>
							<div class="form-group feeds-group">
								<span><?php printf( __( 'Do not disable the %1$sglobal post feed%2$s and %3$sglobal comment feed%4$s', 'wpperformance' ), '<strong>', '</strong>', '<strong>', '</strong>' ); ?></span>
								<label class="switch">
									<input name="not_disable_global_feeds" <?php if ( isset( $settings['not_disable_global_feeds'] ) && 1 === $settings['not_disable_global_feeds'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="not_disable_global_feeds" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>
							<div class="form-group">
								<span><?php esc_html_e( 'Disable XML-RPC', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="disable_xmlrpc" <?php if ( isset( $settings['disable_xmlrpc'] ) && 1 === $settings['disable_xmlrpc'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="disable_xmlrpc" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>

							<div class="form-group">
								<span><?php esc_html_e( 'Enable spam comments cleaner', 'wpperformance' ); ?></span>
								<label class="switch">
									<input name="spam_comments_cleaner" <?php if ( isset( $settings['spam_comments_cleaner'] ) && 1 === $settings['spam_comments_cleaner'] ) { echo 'checked="checked"'; } ?> type="checkbox" id="spam_comments_cleaner" value="1"/>
									<div class="slider round"></div>
								</label>
							</div>

							<div class="form-group delete-spam-comments-group">
								<span><?php esc_html_e( 'Delete spam comments', 'wpperformance' ); ?></span>
								<label class="switch" style="width:auto;">
									<?php

									$options = array(
										'hourly' => __( 'Once Hourly', 'wpperformance' ),
										'daily' => __( 'Once Daily', 'wpperformance' ),
										'twicedaily' => __( 'Twice Daily', 'wpperformance' ),
										'weekly' => __( 'Once Weekly', 'wpperformance' ),
										'twicemonthly' => __( 'Twice Monthly', 'wpperformance' ),
										'monthly' => __( 'Once Monthly', 'wpperformance' ),
									);
									$selected_val = 'daily';
									if ( isset( $settings['delete_spam_comments'] ) && isset( $options[ $settings['delete_spam_comments'] ] ) ) {
										$selected_val = $settings['delete_spam_comments'];
									}
									?>
									<select name="delete_spam_comments" style="height:100%;border-color:#dedede;border-radius:2px;">
										<?php
										foreach ( $options as $key => $val ) {
											echo '<option value="' . esc_attr( $key ) . '" ' . ($selected_val === $key ? ' selected' : '') . '>' . $val . '</option>';
										}
										?>
									</select>
								</label>
							</div>

							<div class="form-group delete-spam-comments-group">
								<span>
								<?php
									$next_scheduled = wp_next_scheduled( 'delete_spam_comments' );
								if ( $next_scheduled ) {
									echo '<small>';
									printf( __( 'Next spam delete: %s', 'wpperformance' ), '<strong>' . date( 'l, F j, Y @ h:i a',( $next_scheduled ) ) . '</strong>' );
									echo '</small>';
								}
								?>	
								</span>	
								<span style="float:right;">
									<?php echo submit_button( __( 'Delete spam comments Now', 'wpperformance' ) , 'large submit', 'delete_spam_comments_now', false ); ?>
								</span>
								
							</div>

						</div>
					</div>
				</div>

				<div><?php echo submit_button( __( 'Update', 'wpperformance' ) , 'btn-submit', 'submit', false ); ?></div>

				<div class="panel">
					<div class="pane-head">
						<?php /* ?><a target="blank" href="https://optimisation.io"><img src="<?php echo plugins_url( 'images/optimisation-4.jpg', __FILE__ . '/../../../' ) ?>" alt="" /></a><?php */ ?>
						<a target="blank" href="https://optimisation.io"><img src="https://res.cloudinary.com/wp-images/image/upload/v1495092337/banner-772x250_o1dmrc.png" alt="" /></a>
						<a target="blank" href="https://optimisation.io" class="just-link"><?php esc_html_e( 'Still Need Help ? We also do manual optimisations.', 'wpperformance' ); ?></a>
					</div>
				</div>

			</div>
			<div class="side-bar">
				<h3><?php esc_html_e( 'Offload Google Analytics to local', 'wpperformance' ); ?></h3>
				<div class="offload-form">
					<div class="form-group">
						<label><?php esc_html_e( 'GA Code', 'wpperformance' ); ?></label>
						<input type="text" name="ds_tracking_id" value="<?php echo (isset( $settings['ds_tracking_id'] ))?$settings['ds_tracking_id']:''; ?>" />
					</div>
					<div class="form-group">
						<label><?php esc_html_e( 'Save GA in (please ensure you remove any other GA tracking)', 'wpperformance' ); ?></label>
						<?php
						$sgal_script_position = array( 'header', 'footer' );
						if ( ! isset( $settings['ds_script_position'] ) || ( 'header' !== $settings['ds_script_position'] && 'footer' !== $settings['ds_script_position'] ) ) {
							$settings['ds_script_position'] = 'header';
						}
						foreach ( $sgal_script_position as $option ) {
							echo "<input type='radio' name='ds_script_position' value='" . $option . "' " . ( $option === $settings['ds_script_position'] ? ' checked="checked"' : '' ) . ' /><span>' . esc_html( ucfirst( $option ) ) . '</span>';
						} ?>
					</div>
					<div class="form-group">
						<label><?php esc_html_e( 'Use adjusted bounce rate?', 'wpperformance' ); ?></label>
						<input type="number" name="ds_adjusted_bounce_rate" min="0" max="60" value="<?php echo isset( $settings['ds_adjusted_bounce_rate'] )?$settings['ds_adjusted_bounce_rate']:0; ?>" />
					</div>
					<div class="form-group">
						<label><?php esc_html_e( 'Change enqueue order? (Default = 0)', 'wpperformance' ); ?></label>
						<input type="number" name="ds_enqueue_order" min="0" value="<?php echo isset( $settings['ds_enqueue_order'] )?$settings['ds_enqueue_order']:0; ?>" />
					</div>
					<div class="form-group">
						<input type="checkbox" name="caos_disable_display_features" <?php if ( isset( $settings['caos_disable_display_features'] ) && 'on' === $settings['caos_disable_display_features'] ) { echo 'checked = "checked"';} ?> />  Disable all <a href="https://developers.google.com/analytics/devguides/collection/analyticsjs/display-features" target="_blank">display features functionality</a>?
					</div>
					<div class="form-group">
						<input type="checkbox" name="ds_anonymize_ip" <?php if ( isset( $settings['ds_anonymize_ip'] ) && 'on' === $settings['ds_anonymize_ip'] ) { echo 'checked = "checked"';} ?> />  Use <a href="https://support.google.com/analytics/answer/2763052?hl=en" target="_blank">Anomymize IP</a>? (Required by law for some countries)
					</div>
					<div class="form-group">
						<input type="checkbox" name="ds_track_admin" <?php if ( isset( $settings['ds_track_admin'] ) && 'on' === $settings['ds_track_admin'] ) { echo 'checked = "checked"';} ?> /> <?php esc_html_e( 'Track logged in Administrators?', 'wpperformance' ); ?>
					</div>
					<div class="form-group">
						<input type="checkbox" name="caos_remove_wp_cron" <?php if ( isset( $settings['caos_remove_wp_cron'] ) && 'on' === $settings['caos_remove_wp_cron'] ) { echo 'checked="checked"'; } ?> /> <?php esc_html_e( 'Remove script from wp-cron?', 'wpperformance' ); ?>
					</div>
				</div>
				<div class="panel">
					<div class="pane-head">
						<?php /* ?> <a target="blank" href="https://wordpress.org/plugins/wp-image-compression/">  <img src="<?php echo plugins_url( 'images/wp-image-compression.jpg', __FILE__ . '/../../../' ) ?>" alt="" /> </a> <?php */ ?>
						<a target="blank" href="https://wordpress.org/plugins/wp-image-compression/">  <img src="https://res.cloudinary.com/wp-images/image/upload/q_auto/v1495091469/banner-wp-image_nl8uzd.jpg" alt="" /> </a>
					</div>
				</div>
			</div>

			<?php wp_nonce_field( 'wpperformance-admin-nonce', 'wpperformance_admin_settings_nonce' ); ?>

		</form>
	</div>
</div>
<script type="text/javascript">
	(function ($) {

		"use strict";

		var $disableCommentsInput = $('input[name="disable_all_comments"]'),
			$disableCertainPostsCommentsInput = $('input[name="disable_comments_on_certain_post_types"]'),
			$disableFeedsInput = $('input[name="disable_rss"]'),
			$spamCommentsCleaner = $('input[name="spam_comments_cleaner"]');

		function on_tab_click( $tab ){
			$('ul.tabs li, .tab-content').removeClass('current');
			$tab.addClass('current');
			$("#" + $tab.attr('data-tab') ).addClass('current');
		}
		
		function on_change_disable_all_comments(){
			var isChecked = $disableCommentsInput.is(":checked");
			$('.comments-group').css('display', isChecked ? 'none' : '');
			on_change_disable_certain_post_types_comments();
		}

		function on_change_disable_certain_post_types_comments(){
			$('.certain-posts-comments-group').css('display', ! $disableCertainPostsCommentsInput.is(":checked") ? 'none' : ( $disableCommentsInput.is(":checked") ? 'none' : '' ) );
		}

		function on_change_disable_feeds(){
			$('.feeds-group').css('display', $disableFeedsInput.is(":checked") ? '' : 'none');
		}

		function on_change_spam_comments_cleaner(){
			var isChecked = $spamCommentsCleaner.is(":checked");
			$('.delete-spam-comments-group').css('display', isChecked ? '' : 'none');
		}

		$(function () {

			// Bind events.
			$('ul.tabs li').on('click', function(){ on_tab_click( $(this) ); });
			$disableCommentsInput.on('change', function(){ on_change_disable_all_comments(); });
			$disableCertainPostsCommentsInput.on('change', function(){ on_change_disable_certain_post_types_comments(); });
			$disableFeedsInput.on('change', function(){ on_change_disable_feeds(); });
			$spamCommentsCleaner.on('change', function(){ on_change_spam_comments_cleaner(); });

			// Run initial checks.
			on_change_disable_all_comments();
			on_change_disable_certain_post_types_comments();
			on_change_disable_feeds();
			on_change_spam_comments_cleaner();
		});
	}(jQuery));
</script>
