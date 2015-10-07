<?php
/**
 * The Template for displaying all single posts.
 *
 * @package _tk
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single' ); ?>

		<p>
			<?php echo get_post_meta($post->ID, 'mytextinput', true); ?>
		</p>
		<p>
			<?php echo get_post_meta($post->ID, 'mytextinput2', true); ?>
		</p>
		<p>
			<?php echo get_post_meta($post->ID, 'mytextarea', true); ?>
		</p>
		<?php
		/* ------------------ Taxonomy ----------------------------*/
			$terms = wp_get_post_terms( $post->ID, 'person_tax' );
				/*
				echo '<pre>';
				var_dump($terms); 
				echo '</pre>';
				*/
				foreach ($terms as $term) {
					echo $term->name; 
				}
		/* ------------------ close Taxonomy ----------------------*/
		?>
		<?php _tk_content_nav( 'nav-below' ); ?>

	<?php endwhile; // end of the loop. ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>