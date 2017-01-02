<?php
/**
 * Post Featured
 * Get featured post for front-page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#page
 * @package WordPress
 */

$post_id = get_theme_mod('opentute_addontag_featured_post_select');

if($post_id != ''):

/* by ID */
$args = array(
    'p' => $post_id, // id of a page, post, or custom type
    'post_type' => 'any'
);

$the_query = new WP_Query($args);

if($the_query->have_posts()) : while( $the_query->have_posts() ) : $the_query->the_post();

$thumb_src = opentute_addontag_post_thumbnail_src(get_the_ID());
$default_src = get_theme_mod('opentute_addontag_featured_post_default_image');
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

<div class="header-post-featured" style="<?php echo $image_bg ?>">
	<section class="container">
		<div class="row">		
			<div class="col-md-9">
				<span class="featured-label">FEATURED</span>

				<a href="<?php the_permalink() ?>">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</a>

				<div class="meta-header">
					<?php 
						$separator = '<span class="meta-title-sparator color-white">by</span>';

						opentute_addontag_entry_date(); 
						opentute_addontag_entry_author($separator,$post->post_author);
					?>
				</div>
			</div>	
			<div class="col-md-3">
				&nbsp;
			</div>		
		</div>
	</section>		
</div>

<?php endwhile; wp_reset_query(); endif; endif; ?>
