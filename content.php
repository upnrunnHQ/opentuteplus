<?php
/**
 * Content Template
 * This template is used for displaying content for 
 * both single and index/archive/search pages.
 *
 * @link https://developer.wordpress.org/themes/basics/linking-theme-files-directories/
 *
 * @package WordPress
 * @subpackage OpenTute+
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		if(is_sticky()) {
			echo '<span class="featured-label">STICKY POST</span>';
		}

		opentute_post_thumbnail(); 
		opentute_entry_header();
	?>
		
	<?php if ( is_single() || is_page() ) : ?>
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array( 
				'before' => '<div class="page-links"><span class="page-links-prep">' . __( 'Pages:', 'opentute' ) . '</span>',
				'after' => '</div>',
				'link_before' => '<span class="page-numbers">',
				'link_after'  => '</span>'
			) );
		?>
	</div><!-- .entry-content -->
	
	<?php else : ?>
	
	<div class="entry-summary">
		<?php
			the_excerpt(); 
		?>
	</div><!-- .entry-summary -->
	
	<?php endif; ?>
	
	<?php opentute_entry_footer(); ?>
	
</article><!-- #post-## -->
