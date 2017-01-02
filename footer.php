<?php
/**
 * Footer Template
 * The area of the page that contains the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage OpenTute+
 */
?>

	<?php do_action( 'opentute_content_bottom' ); ?>
		
	</div><!-- #content -->
	
	<?php do_action( 'opentute_content_after' ); ?>

	<?php do_action( 'opentute_footer_before' ); ?>
	
	<footer id="footer" class="site-footer" role="contentinfo">
		
	<?php do_action( 'opentute_footer_top' ); ?>
	
	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
	
		<div class="container">
			<div class="row">
			
				<?php get_sidebar('footer'); ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	
	<?php endif; ?>
	
	<?php if ( is_active_sidebar( 'colophon' ) ) : ?>
	
		<div id="colophon" class="colophon">
		
			<div class="container">
				<div class="row">
				
					<div id="sidebar-colophon" class="sidebar sidebar-colophon">
						<?php dynamic_sidebar( 'colophon' ); ?>
					</div><!-- #sidebar-colophon -->
					
				</div><!-- .row -->
			</div><!-- .container -->
			
		</div><!-- #colophon -->
	
	<?php else: ?>
	
	<div id="colophon" class="colophon">
	
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="textwidget">
					<p>&copy; <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-info" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>. <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'opentute' ) ); ?>" class="site-generator" title="<?php esc_attr_e( 'Powered by WordPress', 'opentute' ); ?>"><?php esc_attr_e( 'Powered by WordPress', 'opentute' ); ?></a> &amp; <a href="<?php echo esc_url( 'http://opentuteplus.com/' ); ?>" class="site-webdesign" title="OpenTute+ Theme">OpenTute+ Theme</a>.</p>	

					</div>
				</div>
				<div class="col-md-7">
					<?php

					if ( has_nav_menu( 'footer-navigation' )) : ?>
					<nav id="navbar-navigation" class="navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'footer-navigation', 'container' => false, 'menu_class' => 'menu site-navigation nav navbar-nav navbar-right', 'fallback_cb' => false ) ); ?>
					</nav>
					<?php 
					endif; // end has_nav_menu( 'site-navigation' ) || has_nav_menu( 'menu-navigation' )

					?>
				</div>
			</div><!-- .row -->
		</div><!-- .container -->
		
	</div><!-- #colophon -->
	<?php endif; ?>

	<?php do_action( 'opentute_footer_bottom' ); ?>
		
	</footer><!-- #footer -->
	
	<?php do_action( 'opentute_footer_after' ); ?>

</div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
