<?php
/**
 * 404 Template
 * This template is used when a 404 page is shown.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#404-not-found
 *
 * @package WordPress
 * @subpackage OpenTute+
 */
get_header(); ?>

	<?php do_action( 'opentute_container_before' ); ?>

	<div id="front-page-container">

	<div class="container">
		<div class="row">

			<?php do_action( 'opentute_main_before' ); ?>
			
			<main id="main" class="site-main" role="main">
			<div class="container404">
			
			<?php do_action( 'opentute_main_top' ); ?>
				
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php _e( "Oops! That page can't be found.", 'opentute' ); ?></h1>
					</header><!-- .page-header -->
					
					<div class="page-content">
						<p><?php _e( 'It looks like nothing was found at this location. Maybe try search?', 'opentute' ); ?></p>
						
						<?php get_template_part('searchform') ?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			
			<?php do_action( 'opentute_main_bottom' ); ?>
				
			</div>
			</main><!-- #main -->
			
			<?php do_action( 'opentute_main_after' ); ?>
		
		</div><!-- .row -->
	</div><!-- .container -->
	
	</div>
	
	<?php do_action( 'opentute_container_after' ); ?>

<?php get_footer(); ?>
