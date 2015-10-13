<?php
/**
 * The sidebar containing the main widget area
 *
 * @package _tk
 */
?>

	</div><!-- close .main-content-inner -->

	<div class="sidebar col-sm-12 col-md-4">

		<?php // add the class "panel" below here to wrap the sidebar in Bootstrap style ;) ?>
		<div class="sidebar-padder">
			<h2 class="sidebar-icon">Let's get started</h2>
			<span class="contacts-head">Contact us via:</span>
			<ul class="contacts">
				<li><span class="mail"><?php echo get_theme_mod('mail_setting', 'Error'); ?></span></li>
				<li><span class="skype"><?php echo get_theme_mod('skype_setting', 'Error'); ?></span></li>
			</ul>
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>

				<aside id="archives" class="widget widget_archive">
					<h3 class="widget-title"><?php _e( 'Archives', '_tk' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget widget_meta">
					<h3 class="widget-title"><?php _e( 'Meta', '_tk' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>


			<?php endif; ?>
			
			<?php echo do_shortcode("[contact-form-7 id='157' title='Contact form 1']"); ?>
		</div><!-- close .sidebar-padder -->
