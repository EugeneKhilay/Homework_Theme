<?php
/**
 * Template Name: Products Template
 *
 * @package _tk
 * @subpackage _tk-master
 */

get_header(); ?>

	<?php $args = array( 'post_type' => 'products_tk', 'posts_per_page' => 5 );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			//get_template_part( 'content', 'page' ); 
			?>
			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<?php the_title(); // display product name?>
				</a>
			</h2>

			<?php
		
			echo '<div class="entry-content">';
			the_content();
			echo '</div>';
		
			/* ------------------ Taxonomy ----------------------------*/
			$terms = wp_get_post_terms( $post->ID, 'product_cat' );
				/*
				echo '<pre>';
				var_dump($terms); 
				echo '</pre>';
				*/
				foreach ($terms as $term) {
					echo $term->name; 
				}
			/* ------------------ close Taxonomy ----------------------*/

			endwhile;
	?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
