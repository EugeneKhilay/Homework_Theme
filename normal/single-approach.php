<?php
/**
 * The Template for displaying all single posts.
 *
 * @package _tk
 */

get_header(); ?>
<div class="content-zone">
	<div class="content-zone-post">
	<?php while ( have_posts() ) : the_post(); ?>

		<div class="col-md-4">
			<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
		</div>
		<div class="col-md-8">
			<h3 class="entry-title">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); // display product name?>
				</a>
			</h3>

			<?php
		
			echo '<div class="entry-content">';
			the_content();
			echo '</div>'; ?>
		</div>

		<?php _tk_content_nav( 'nav-below' ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>

	<?php endwhile; // end of the loop. ?>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>