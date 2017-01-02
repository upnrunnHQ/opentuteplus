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

	<div class="entry-content">
		<?php 
			$subtitle = get_post_meta($post->ID, 'post_subtitle', true);

			if($subtitle && $subtitle != ''):
		?>

		<div class="single-summary">
			<?php echo $subtitle ?><span class="single-summary-line"></span>
		</div>

		<?php
			endif; 

			the_content(); 

			wp_link_pages(array(
				'before' => '<div class="pagelink clearfix"><span class="pages">Pages: </span>',
				'pagelink' => '<span>%</span>',
				'after' => '</div>'
			)); 
		?>

	</div><!-- .entry-content -->
	
	<?php opentute_addontag_entry_footer(); ?>
	
</article><!-- #post-## -->
