<?php
/** 
 * Template Name: No Sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
 *
 * @package WordPress
 * @subpackage OpenTute+
 */

get_header(); ?>

	<?php do_action('opentute_container_before'); ?>
	
	<div class="container">
		<div class="row">

		<?php do_action('opentute_main_before'); ?>

		<?php if(! is_front_page()): ?>

		<div class="page-breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">HOME</a>
			<span class="breadcrumb-arrow">&#x2192;</span>
			<span class="current-title"><?php the_title(); ?></span>
		</div>

		<?php endif ?>

		<main id="main" class="site-main page-no-sidebar" role="main">

			<?php do_action('opentute_main_top'); ?>
		
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<header class="entry-header">
						<?php opentute_title(); ?>
					</header><!-- .entry-header -->

					<?php 
						$subtitle = get_post_meta($post->ID, 'post_subtitle', true);

						if($subtitle && $subtitle != ''):
					?>

					<div class="single-page-summary">
						<?php echo $subtitle ?>
					</div>

					<?php endif; ?>
					
					<div class="entry-content">
					<?php 
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-prep">' . __( 'Pages:', 'opentute' ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-numbers">', 'link_after'  => '</span>' ) );
					?>
					</div><!-- .entry-content -->
					
					<?php edit_post_link( __( 'Edit', 'opentute' ) . ' <span class="screen-reader-text sr-only">' . get_the_title() . '</span>', '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

				</article><!-- #post-## -->
				
				<?php
					// Load the comment template if comments are open or there is at least one comment.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>
			
			<?php endwhile; ?>
		
			<?php do_action('opentute_main_bottom'); ?>
			
		</main><!-- #main -->
		
		<?php do_action('opentute_main_after'); ?>		

		</div><!-- .row -->
	</div><!-- .container -->
	
	<?php do_action('opentute_container_after'); ?>
	
<?php get_footer(); ?>
