<?php
/**
 * Template name: Knowledge Base
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package web2feel
 */

get_header(); ?>

<!-- <div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3> News</h3> 
				<p> News from CITIC Telecom</p>
			</div>			
		</div>
	</div>
</div> -->

<!-- breadcrumb -->
<div class="breadcrumb">
	<div class="container ">	
		<?php echo do_shortcode( '[breadcrumb]' ); ?>
	</div>
</div>


<div class="container">	
	<div class="row">
		<div id="primary" class="content-area col-sm-12">
			<main id="main" class="site-main post-list" role="main">
				<?php add_filter( 'the_title', function ($title) { return "";}); ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() )
							comments_template();
					?>

				<?php endwhile; // end of the loop. ?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</div>
<?php get_footer(); ?>