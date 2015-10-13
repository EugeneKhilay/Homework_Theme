<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _tk
 */
?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
		</div><!-- close .row -->
	</div><!-- close .container -->
</div><!-- close .main-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">
				<div class="col-md-8">
					<?php wp_nav_menu( array(
						'theme_location' => 'footer-menu',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'menu_class' 		=> 'nav navbar-nav',
						'menu_id'			=> 'footer-menu',
						
						)
					);?>
				</div>
				<div class="col-md-4">
					<ul class="socials">
						<li><a href="<?php echo get_theme_mod('twitter_setting', 'Error'); ?>" class="twitter">Twitter</a></li>
						<li><a href="<?php echo get_theme_mod('facebook_setting', 'Error'); ?>" class="facebook">Facebook</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div><!-- close .container -->
</footer><!-- close #colophon -->

<?php wp_footer(); ?>
</div>
</body>
</html>
