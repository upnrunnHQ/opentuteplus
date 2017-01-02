<?php
/**
 * Single Post Template
 * This template is used when a single post page is shown.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage OpenTute+
 */

get_header();
do_action('opentute_container_before'); 

// Start the Loop.
while ( have_posts() ) : the_post();

$thumb_src = opentute_addontag_post_thumbnail_src(get_the_ID());
$default_src = get_theme_mod('opentute_addontag_single_post_default_image');
$image_bg = '';

if($thumb_src) {
	$image_bg.= 'background-image:url(' . $thumb_src . ');';
} 
else if($default_src != '') {
	$image_bg.= 'background-image:url(' . $default_src . ');';
}

$image_bg.= "background-color:#233B54;";
$image_bg.= 'background-repeat: no-repeat;';
$image_bg.= 'background-position: center center;';

?>
	
	<div class="header-title-space" style="<?php echo $image_bg ?>">
		<div class="container">
			<div class="row">
			<div class="col-md-1">
				&nbsp;
			</div>
			<div class="col-md-11">
				<div class="row">
					<div class="col-md-8">
						<?php opentute_title(); ?>
					</div>
					<div class="col-md-4">
						&nbsp;
					</div>
				</div>

				<div class="meta-header">
					<?php 
						opentute_addontag_entry_date(); 
						opentute_addontag_entry_author();
					?>
				</div>
			</div>			
			</div>
		</div>		
	</div>

	<div class="container">
		<div class="row">

		<?php do_action('opentute_main_before'); ?>
		
		<main id="main" class="site-main" role="main">
		
		<?php do_action('opentute_main_top'); ?>
	
		<?php
			// Include the Post Format specific template for the content.
			get_template_part('content-single', get_post_format());
		
			// Load the comment template if comments are open or there is at least one comment.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;		
		?>
	
		<?php do_action('opentute_main_bottom'); ?>
		
		</main><!-- #main -->
		
		<?php do_action('opentute_main_after'); ?>
		
		<?php get_sidebar(); ?>

		</div><!-- .row -->
	</div><!-- .container -->
	
	<?php 		
		endwhile; // End the loop.

		do_action('opentute_container_after'); 
	?>

<?php get_footer(); ?>
