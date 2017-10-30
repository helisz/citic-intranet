<?php
/**
 * Template name:Homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package web2feel
 */

get_header(); ?>

<div class="container">

	<div class="section-wide m-t-md">
		<div class="row">

			<!-- LEFT CONTENT -->
			<div class="col-lg-2">
				<div class="section">
					<!-- <div class="section-title">
						
					</div> -->
					<div class="section-content">
						<div class="bg-white p-sm">										
							<?php $date = new DateTime("now", new DateTimeZone('Asia/Hong_Kong') ); ?>
							<div class="text-primary"><?php echo $date->format('Y'); ?> </div>
							<div class="text-primary">
								<span class="text-lighter"><?php echo $date->format('F'); ?></span>&nbsp;
								<span class="text-bold"><?php echo $date->format('d'); ?></span>
							</div>	

							<div class="">
								<hr>
								<div class="text-bold text-primary">
								<?php
									if ( is_user_logged_in() ) {
									    $time = date("H");
									    $timezone = date("e");
									    if ($time < "12") {
									        echo "Good morning";
									    } else
									    if ($time >= "12" && $time < "17") {
									        echo "Good afternoon";
									    } else
									    if ($time >= "17" && $time < "19") {
									        echo "Good evening";
									    } else							   
									    if ($time >= "19") {
									        echo "Good night";
									    }	
									    echo ", <br>";
									    $current_user = wp_get_current_user(); 
								    	echo  $current_user->user_login ;
								    } else {
						    	?>
								    	<a class="btn btn-primary" href="<?php echo get_page_link("117"); ?>">LOG IN</a>
								<?php

								    }
							    ?>
							    </div>	
							   
									   

							</div>				
						</div>
					</div>	
				</div>
				
				<!-- CONTACTS -->
				<div class="section">
					<div class="section-title">
						通讯录 CONTACTS
					</div>
					<div class="section-content p-sm">
						<!-- <?php echo do_shortcode('[abcf-staff-list id="195"]'); ?> -->
					</div>
				</div>

				<!-- USEFUL LINKS -->
				<div class="section">
					<div class="section-title">
						常用链接 USEFUL LINKS
					</div>
					<div class="section-content">
						<div class="link-list">
							<?php if( have_rows('useful_links', 43) ): ?>
								<?php while( have_rows('useful_links', 43) ): the_row(); ?>
									 <?php if( get_sub_field('link_home_display') == true ): ?>
										<a class="m-b-xs" href="<?php the_sub_field('link_url'); ?>" target="_blank">
											<img class="image img-responsive" src="<?php the_sub_field('link_icon'); ?>" style="max-height: 18px;">
											<div class="name">
												<?php the_sub_field('link_name'); ?>
											</div>	        	
										</a>
									 <?php endif; ?> 
								<?php endwhile; ?> 
							<?php endif; ?>
						</div>
						<div class="p-md text-center">
							<a href="tools" class="btn btn-primary">
								MORE
							</a>
						</div>
					</div>
				</div>


			</div>



			<!-- CENTER AREA -->
			<div class="col-lg-7">
				<div class="section">
					<div class="section-title">
						最新消息 LATEST NEWS
					</div>	
					<div class="section-content">
						<div class="home-slider home-news m-b-lg">
							<?php $post_objects = get_field('home_page_latest_news');
							if( $post_objects ): ?>
							<?php foreach( $post_objects as $post):  ?>
								<?php setup_postdata($post); ?>
								<a href="<?php the_permalink(); ?>" >
									<div class="slider-container">
										<div class="newsblock slider-content">
											<div class="newsblock-thumbnail-container">
												<div class="newsblock-thumbnail image-bg" style="background-image: url(<?php the_post_thumbnail_url( $thumb,'full' ); ?>) ">
												</div>
											</div>
											<div class="newsblock-content m-t">
												<div class="newsblock-date m-b-xs">
													<div class="date">
														<?php echo get_the_date('Y-m-d'); ?>	
													</div>
												</div>
												<div class="newsblock-title text-xxl text-bold">
													<?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?>
												</div>
												<!-- <div class="newsblock-text text-lighter text-sm m-t-sm">
													<?php 
														$content = get_the_content();
														echo mb_strimwidth(wp_strip_all_tags( get_the_content() ), 0, 200, '...'); 
													?>
												</div> -->
											</div>
										</div>
									</div>
								</a>
							<?php endforeach; ?><?php wp_reset_postdata(); ?><?php endif;?>
						</div>
					</div>
					
				</div>	
				<!-- <hr> -->

				<div class="section">
					<div class="section-title">
						 集團活動 ACTIVITIES
					</div>
					<div class="section-content row">
						<div class="col-md-12">
								<div class="m-t home-news-list">
									<?php 	
									$portcat = 3;
					 				// $portcat =ft_of_get_option('fabthemes_portfolio');
									$query = new WP_Query( array( 'category_id' =>$portcat,'posts_per_page' =>6 ) );
									if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
									<div class="m-b">					
										<a class="bg-white p-sm" style="display: block" href="<?php echo get_the_permalink(); ?>" >
											<div class="newsblock slider-content">
												<div class="newsblock-thumbnail-container">
													<div class="newsblock-thumbnail image-bg" style="background-image: url(<?php the_post_thumbnail_url( $thumb,'full' ); ?>) ">
													</div>
												</div>
												<div class="m-t-md m-b-xs">
													<div class="text-xs text-gray">
														<?php echo get_the_date('Y-m-d'); ?>	
													</div>
												</div>
												<div class="text-md text-bold">
													<?php echo mb_strimwidth(get_the_title(), 0, 80, '...'); ?>
												</div>
											</div>
													
										</a>
									</div>	<?php endwhile; endif; wp_reset_postdata(); ?>	 <!-- RESET GLOBAL $post VARIABLE -->
								</div>
							</div>				
					</div>
				</div>
				<div class="text-center">
					<a href="news" class="btn btn-primary">
						瀏覽所有最新消息
					</a>
				</div>

			</div>


			<!-- RIGHT CONTENT -->
			<div class="col-lg-3">
				<div class="section">
					<div class="section-title">
						重點新聞 Sparks
					</div>
					<div class="section-content">
						<div class="home-slider home-highlight bg-white">
							<?php $post_objects = get_field('home_page_highlight_news');
							if( $post_objects ): ?>
							<?php foreach( $post_objects as $post):  ?>
								<?php setup_postdata($post); ?>
								<a href="<?php echo get_the_permalink(); ?>" >
									<div class="slider-container">
										<div class="newsblock outside slider-content">
											<div class="newsblock-thumbnail-container">
												<div class="newsblock-thumbnail image-bg" style="background-image: url(<?php echo get_the_post_thumbnail_url( $thumb,'full' ); ?>) ">
												</div>
												<!-- <div class="newsblock-date text-xs">
													<?php echo get_the_date('Y-m-d'); ?>	
												</div> -->
											</div>
											<div class="newsblock-content-outside">
												<div class="div m-b-xs text-sm">
													<span class="text-xs text-gray"><?php echo get_the_date('Y-m-d'); ?></span>
												</div>												
												<div class="newsblock-title text-md text-bold">
													<?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?>
												</div>
											</div>
										</div>
									</div>

								</a>
							<?php endforeach; ?><?php wp_reset_postdata(); ?><?php endif;?>
						</div>
					</div>
					
				</div>

				<div class="section section-home-bk">
					<!-- <div class="section-title">
						知識庫 CITIC Knowledge Base
					</div> -->
					<div class="section-content">
						<img src="wp-content/uploads/kb-home-bg.png">
						<a href="citic-pedia" class="bk-button btn btn-primary">
							ENTER
						</a>
					</div>
				</div>


				<div class="section">
					<div class="section-title">
						小工具 TOOLS
					</div>
					<div class="section-content tool-list">
						<div class="row" style="padding: 20px 30px 0 30px;">
							<?php if( have_rows('tool_list', 172) ): ?>
								<?php while( have_rows('tool_list', 172) ): the_row(); ?>

									<a class="col-sm-4 col-md-6 col-lg-6 col-xl-4 tool hometools-equalizer m-b-xs" href="<?php the_sub_field('tool_url'); ?>">
										<div class="m-b">
											<div class="text-center m-t">
												<img class="img-responsive" src="<?php the_sub_field('tool_image'); ?>" style="max-width: 50px;">
											</div>
											<div class="m-t-sm text-center">
												<?php the_sub_field('tool_name'); ?>
											</div>
										</div>			        	
									</a>

								<?php endwhile; ?> 
							</div>
						<?php endif; ?>

						<div class="p-md text-center">
							<a href="tools" class="btn btn-primary">
								MORE TOOLS
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<div class="section-wide">
	<div class="row">


	</div>
</div>



<?php get_footer(); ?>
