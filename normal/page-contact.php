<?php
/**
 * Template Name: Contact Page
 */

get_header(); ?>
<div class="content-zone">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h2 class="contact-icon">Contacts us</h2>
		<?php while ( have_posts() ) : the_post(); 

			the_content();

		endwhile; // end of the loop. ?>
		<form>
			<input type="submit" value="Contact us" class="btn btn-primary">
		</form>
	</article><!-- #post-## -->
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>