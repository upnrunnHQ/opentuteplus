<?php
/**
 * Archive Template
 * This template is used when an archive page is shown.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage OpenTute+
 */
get_header(); ?>

<?php do_action( 'opentute_container_before' );

$default_src = get_theme_mod('opentute_addontag_archive_image');
$image_bg = '';

if($default_src != '') {
	$image_bg.= 'background-image:url(' . $default_src . ');';
}

$image_bg.= "background-color:#233B54;";
$image_bg.= 'background-repeat: no-repeat;';
$image_bg.= 'background-position: center center;';

?>

	<div class="header-post-featured archive-header-title" style="<?php echo $image_bg ?>">
		<section class="container">
			<div class="row">		
				<div class="col-md-12">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</div>
			</div>
		</section>		
	</div>

	<section class="container">
		<div class="row">

			<?php do_action( 'opentute_main_before' ); ?>
			
			<main id="main" class="site-main" role="main">
		
			<?php do_action( 'opentute_main_top' ); ?>
					
			<?php 

			if ( have_posts() ) : 

				// Start the Loop.
				while ( have_posts() ) : the_post();

					// Include the Post Format specific template for the content.
					get_template_part( 'content', get_post_format() );

				// End the loop.
				endwhile;
			
				// Previous/Next page navigation.
				opentute_posts_pagination();
			
			// If no posts found, include the content-none.php template.
			else : 
				get_template_part( 'content', 'none' );

			endif;
		
			do_action( 'opentute_main_bottom' ); ?>
				
			</main><!-- #main -->
			
			<?php do_action( 'opentute_main_after' ); ?>
		
			<?php get_sidebar(); ?>

		</div><!-- .row -->
	</section><!-- .container -->
	
	<?php do_action( 'opentute_container_after' ); ?>

<?php get_footer(); ?>
