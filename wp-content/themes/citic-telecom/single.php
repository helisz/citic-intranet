<?php
/**
 * The Template for displaying all single posts.
 *
 * @package web2feel
 */

get_header(); ?>

<!-- <div class="page-head">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php 
				$port_cat =ft_of_get_option('fabthemes_portfolio');
				if (in_category($port_cat)) { ?>
				<h3> Portfolio item </h3> 
				<p> Project item from your portfolio</p>
				<?php } else { ?>
				<h3> Blog post </h3> 
				<p> Article from your blog</p>
				<?php } ?>
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

<!-- custom thumbnail -->
<?php if(get_the_post_thumbnail_url()){ ?>
	<div class="custom-post-featured-image image-bg" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>)"></div>
<?php } ?>

<div class="container">	
	<div class="row">
	<div id="primary" class="content-area col-sm-8">
		<main id="main" class="site-main remove-featured-image" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>