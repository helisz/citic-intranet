<?php
/**
 * @package web2feel
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<!-- custom format -->
	<div class="row">

		<div class="col-md-3">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php
			$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'medium' ); //get full URL to image (use "large" or "medium" if the images too big)
					$image = aq_resize( $img_url, 300, 200, true ); //resize & crop the image
					?>
					
					<?php if($image) : ?>
						<img class="img-responsive" src="<?php echo $image ?>"/>
					<?php endif; ?>					
			</a>			
					
		</div>		

		<div class="col-md-9">
			<header class="entry-header">
				<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta m-b">
						<?php web2feel_posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
				<div class="entry-title h3 text-bold"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			</header><!-- .entry-header -->


			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->


		</div>
	</div>

</article><!-- #post-## -->

