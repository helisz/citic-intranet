<?php
/**
 * Template name: Tools Template
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package web2feel
 */

get_header(); ?>
<div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>Tools</h3> 
				<p>tools</p>
			</div>			
		</div>
	</div>
</div>

<div class="container">	
	<div class="row">
		<div id="primary" class="content-area col-sm-12">
			<main id="main" class="site-main" role="main">

			<h2>我的工具</h2>

		    <div class="row m-t-xl tool-list">
				<?php if( have_rows('tool_list') ): ?>
 			    	<?php while( have_rows('tool_list') ): the_row(); ?>
			 
			        <a class="col-sm-4 col-md-3 col-lg-2 tool" href="<?php the_sub_field('tool_url'); ?>">
			        	<div class="p-md">
			        		<div class="text-center">
			        			<img class="img-responsive" src="<?php the_sub_field('tool_image'); ?>" style="max-width: 80px;">
			        		</div>
		        			<div class="m-t-md text-lighter text-center">
		        				<?php the_sub_field('tool_name'); ?>
		        			</div>
			        	</div>			        	
			   		</a>
			     
					<?php endwhile; ?> 
				</div>

				<?php endif; ?>


			</main><!-- #main -->
		</div><!-- #primary -->

	</div>
</div>
<?php get_footer(); ?>
