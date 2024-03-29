<?php
/**
 * Template name: Announcements
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
				<h3>Announcements</h3> 
				<p>Announcements from CITIC Telecom</p>
			</div>			
		</div>
	</div>
</div>
 -->

<!-- breadcrumb -->
<div class="breadcrumb">
	<div class="container ">	
		<?php echo do_shortcode( '[breadcrumb]' ); ?>
	</div>
</div>


<div class="container">	
	<div class="row">
	<div id="primary" class="content-area col-sm-8">
		<main id="main" class="site-main" role="main">

<?php
    $categories = get_the_category();
    $catID = $categories[0]->cat_ID;
?>
<?php $subcats = get_categories('child_of=' . $catID);
    foreach($subcats as $subcat) {
    echo '<h3>' . $subcat->cat_name . '</h3>';
    echo '<ul>';
    $subcat_posts = get_posts('cat=' . $subcat->cat_ID);
    foreach($subcat_posts as $subcat_post) {
        $postID = $subcat_post->ID;
    echo '<li>';
    echo '<a href="' . get_permalink($postID) . '">';
    echo get_the_title($postID);
    echo '</a></li>';
    }
    echo '</ul>';
    } ?>








			
			<?php 
			$portcat = 'announcements';
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 'category_name' =>$portcat, 'post_type' => 'post', 'posts_per_page' => 10, 'paged' => $paged );
			$wp_query = new WP_Query($args);
			while ( have_posts() ) : the_post(); ?>
			    <div class="col-sm-12 col-6 portbox m-b">	
				    <div class="row">
				    	<div class="col-sm-4 col-md-3 p-s">
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
				    	</div>
				    	<div class="col-sm-8 col-md-9">
				    		<div class="text-left text-lg p-t-md">
				    			<a href="<?php the_permalink(); ?>" style="color: #6f7779;"> <?php the_title(); ?></a>
				    		</div>		
				    	</div>
				    </div>	
			 	</div>	
			<?php endwhile; ?>

			<!-- then the pagination links -->
			<?php next_posts_link( '&larr; Older posts', $wp_query ->max_num_pages); ?>
			<?php previous_posts_link( 'Newer posts &rarr;' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
