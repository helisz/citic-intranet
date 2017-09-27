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
			<div class="col-md-3">
				<div class="section">
					<div class="section-title">
						<div class="bg-gray p-sm">
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
				<div class="section-title">
					<h2>最新消息</h2>
				</div>	
				<div class="home-slider home-news">
					<?php $post_objects = get_field('home_page_latest_news');
					if( $post_objects ): ?>
					<?php foreach( $post_objects as $post):  ?>
						<?php setup_postdata($post); ?>
						<a href="<?php the_permalink(); ?>" >
							<div class="slider-container">
								<div class="slider-content image-bg" style="background-image: url(<?php the_post_thumbnail_url( $thumb,'full' ); ?>) ">
									<div class="text p-m">
										<div class="title text-md"><?php the_title(); ?></div>
										<div class="meta m-t-xs"><?php the_author(); ?>, <?php the_date(); ?></div>

									</div>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif;?>
			</div>
		</div>


		<!-- RIGHT CONTENT -->
		<div class="col-md-3">
			<div class="section">
				<div class="section-title">
					<h2>重點新聞</h2>
				</div>		
					<div class="home-slider home-highlight">
						<?php  $post_objects = get_field('home_page_highlight_news');
						if( $post_objects ): ?>
						<?php foreach( $post_objects as $post):  ?>
							<?php setup_postdata($post); ?>
							<a href="<?php the_permalink(); ?>" >
								<div class="slider-container">
									<div class="slider-content image-bg" style="background-image: url(<?php the_post_thumbnail_url( $thumb,'full' ); ?>) ">									
									</div>
								</div>
								<div class="text m-t">
									<div class="title"><?php the_title(); ?></div>
								</div>
							</a>
						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif;?>
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


<!-- <div class="section-wide">
	<div class="row">
		<div class="section-title col-12">
			<h2>Announcements</h2>
			<p>Few of the latest portfolio items </p>
		</div>	
		<div class="boxitems">		
			<?php 	
			$portcat = 'announcements';
		 // $portcat =ft_of_get_option('fabthemes_portfolio');
			$query = new WP_Query( array( 'category_name' =>$portcat,'posts_per_page' =>4 ) );
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>

			<div class="col-sm-3 col-6 portbox">					
				<?php
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 750, 500, true ); //resize & crop the image
				?>					
				<?php if($image) : ?>
					<div class="hthumb">

						<a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo $image ?>"/></a>
					</div>
				<?php endif; ?>
				<h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>		 
			</div>		
		<?php endwhile; endif; ?>			 
	</div>
	
</div>
</div>

<div class="section-wide sec">
	<div class="row">
		<div class="section-title col-12">
			<h2> Latest Articles</h2>
			<p>Latest posts from the blog </p>
		</div>

		<div class="boxitems">
			<?php 	
			$port_cat =ft_of_get_option('fabthemes_portfolio');
			$query = new WP_Query( array( 'cat' => -$port_cat,'posts_per_page' =>4 ) );
			if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();	?>

			<div class="col-sm-3 col-6 postbox">

				<?php
				$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 750, 500, true ); //resize & crop the image
			?>

			<?php if($image) : ?>
				<div class="hthumb">		 	
					<a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo $image ?>"/></a>
				</div>			
			<?php endif; ?>

			<h3><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
			<div class="hometa"> <?php web2feel_posted_on(); ?> </div>	 

			<?php the_excerpt(); ?>
		</div>		
	<?php endwhile; endif; ?>		 
</div>	
</div>
</div>

</div> -->

<?php get_footer(); ?>
