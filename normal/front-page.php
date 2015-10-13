<?php
/**
 * The main template file.
 * Template Name: Front Page
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _tk
 */

get_header(); ?>
	

	<?php if ( is_active_sidebar( 'home_left_1' ) ) : ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area col-md-6" role="complementary">
			<h2 class="sidebar-icon">Small teams change the world</h2>
			<?php dynamic_sidebar( 'home_left_1' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'home_central_1' ) ) : ?>
	<div id="secondary-sidebar" class="primary-sidebar widget-area col-md-6" role="complementary">
		<h2 class="sidebar-icon">What sets us apart</h2>
		<?php dynamic_sidebar( 'home_central_1' ); ?>
	</div><!-- #primary-sidebar -->
<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>