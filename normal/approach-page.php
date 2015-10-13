<?php
/**
 * Template Name: Approach Template
 *
 * @package _tk
 * @subpackage _tk-master
 */

get_header(); ?>
<div class="content-zone">	
		<h2 class="approach-icon">APPROACH</h2>

		<?php $args = array( 'post_type' => 'approach', 'posts_per_page' => 4 );
			$loop = new WP_Query( $args );
			$ps = 0;
			while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div class="both">	
				
				<?php if ($ps == 1) { ?>
				
						<div class='col-md-4 right-pic'>
							<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
						</div>
						<div class='col-md-8 right-text'>
							<h3 class='entry-title'>
								<a href='<?php the_permalink() ?>' rel='bookmark'>
									<?php the_title(); // display product name ?>
								</a>
							</h3>
						
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</div>

					<?php } else { ?>
						<div class='col-md-4'>
							<?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
						</div>
						<div class='col-md-8'>
							<h3 class='entry-title'>
								<a href='<?php the_permalink() ?>' rel='bookmark'>
									<?php the_title(); // display product name ?>
								</a>
							</h3>
						
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</div>
					<?php }; $ps++; ?>
					</div>
			<?php endwhile; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>