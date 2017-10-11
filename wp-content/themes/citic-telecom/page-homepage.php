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

	<div class="section-wide">
		<div class="row">

			<!-- LEFT CONTENT -->
			<div class="col-md-2">
				<div class="section">
					<div class="section-title">
						<div class="bg-gray p-sm">
							<div class="text-bold text-lg m-b text-primary">
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
									    $current_user = wp_get_current_user(); 
								    	echo ', ' . $current_user->user_login ;
								    }
							    ?>

							</div>							

							<?php $date = new DateTime("now", new DateTimeZone('Asia/Hong_Kong') ); ?>
							<div class="text-xs text-primary"><?php echo $date->format('Y'); ?> </div>
							<div class="text-lg m-t-n-sm text-primary">
								<span class="text-lighter"><?php echo $date->format('F'); ?></span>&nbsp;
								<span class="text-bold"><?php echo $date->format('d'); ?></span>
							</div>	
						</div>
					</div>	
				</div>
				<div class="section">
					<div class="section-title">
						<h2>通訊錄</h2>
					</div>	
					<div>
						test					
					</div>	
				</div>
			</div>



			<!-- CENTER AREA -->
			<div class="col-md-6">
				<!-- <div class="section-title">
					<h2>最新消息</h2>
				</div>	 -->
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
										<div class="newsblock-date">
											<div class="month">
												<?php echo get_the_date('M'); ?>									
											</div>
											<div class="date tilt">
												<?php echo get_the_date('d'); ?>	
											</div>
										</div>
										<div class="newsblock-title text-md">
											<?php echo mb_strimwidth(get_the_title(), 0, 100, '...'); ?>
										</div>
									</div>
								</div>
							</div>
						</a>
					<?php endforeach; ?><?php wp_reset_postdata(); ?><?php endif;?>
				</div>
				<hr>


				<div class="section-wide row">
					<?php 	
					$portcat = 3;
	 // $portcat =ft_of_get_option('fabthemes_portfolio');
					$query = new WP_Query( array( 'category_id' =>$portcat,'posts_per_page' =>4 ) );
					if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>
					<div class="col-sm-6 m-b">					
						<a href="<?php echo get_the_permalink(); ?>" >
							<div class="slider-container">
								<div class="newsblock slider-content">								
									<div class="newsblock-content">
										<div class="newsblock-date">
											<div class="month">
												<?php echo get_the_date('M'); ?>									
											</div>
											<div class="date tilt">
												<?php echo get_the_date('d'); ?>	
											</div>
										</div>
										<div class="newsblock-title text-sm">
											<?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>	<?php endwhile; endif; wp_reset_postdata(); ?>	 <!-- RESET GLOBAL $post VARIABLE -->
				</div>



				<div class="p-md text-center">
					<a href="news" class="btn btn-primary">
						瀏覽所有最新消息
					</a>
				</div>

			</div>


			<!-- RIGHT CONTENT -->
			<div class="col-md-3">
				<div class="section">
					<div class="section-title">
						<h2>重點新聞</h2>
					</div>		
					<div class="home-slider home-highlight">
						<?php $post_objects = get_field('home_page_highlight_news');
						if( $post_objects ): ?>
						<?php foreach( $post_objects as $post):  ?>
							<?php setup_postdata($post); ?>
							<a href="<?php echo get_the_permalink(); ?>" >
								<div class="slider-container">
									<div class="newsblock slider-content">
										<div class="newsblock-thumbnail-container">
											<div class="newsblock-thumbnail image-bg" style="background-image: url(<?php echo get_the_post_thumbnail_url( $thumb,'full' ); ?>) ">
											</div>
										</div>
										<div class="newsblock-content m-t">
											<div class="newsblock-date">
												<div class="month">
													<?php echo get_the_date('M'); ?>									
												</div>
												<div class="date tilt">
													<?php echo get_the_date('d'); ?>	
												</div>
											</div>
											<div class="newsblock-title text-sm">
												<?php echo mb_strimwidth(get_the_title(), 0, 50, '...'); ?>
											</div>
										</div>
									</div>
								</div>

							</a>
						<?php endforeach; ?><?php wp_reset_postdata(); ?><?php endif;?>
					</div>
				</div>



				<div class="section">
					<div class="section-title">
						<h2>小工具</h2>
					</div>
					<div class="row tool-list">
						<?php if( have_rows('tool_list', 172) ): ?>
							<?php while( have_rows('tool_list', 172) ): the_row(); ?>

								<a class="col-6 col-sm-4 col-md-6 col-lg-4 tool" href="<?php the_sub_field('tool_url'); ?>">
									<div class="m-b">
										<div class="text-center m-t">
											<img class="img-responsive" src="<?php the_sub_field('tool_image'); ?>" style="max-width: 50px;">
										</div>
										<div class="m-t-md text-lighter text-center">
											<?php the_sub_field('tool_name'); ?>
										</div>
									</div>			        	
								</a>

							<?php endwhile; ?> 
						</div>
					<?php endif; ?>
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
