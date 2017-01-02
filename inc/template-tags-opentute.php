<?php
/**
 * Custom template tags for OpenTute+.
 *
 * @package WordPress
 * @subpackage OpenTute+
 */

if ( ! function_exists( 'opentute_addontag_post_thumbnail_src' ) ) :
/**
 * Custom post thumbnail.
 */
function opentute_addontag_post_thumbnail_src($post_id, $size = 'full') {
	if ( ! has_post_thumbnail() || is_attachment() || post_password_required() || ! $post_id ) {
		return false;
	}

	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $size);

	if($thumb) {
		return $thumb['0'];
	} else {
		return false;	
	}
}
endif; // opentute_addontag_post_thumbnail_src

if ( ! function_exists( 'opentute_addontag_entry_date' ) ) :
/**
 * Prints HTML with entry date.
 */
function opentute_addontag_entry_date() {
	printf('<span class="meta-date"><span class="meta-date-prep"></span> %1$s',
		sprintf( '<time datetime="%1$s">%2$s</time></span> ',
			esc_attr( get_the_date( 'c' ) ),
			get_the_date()
		)
	);
}
endif; // opentute_addontag_entry_date

if ( ! function_exists( 'opentute_addontag_entry_author' ) ) :
/**
 * Prints HTML with entry footer.
 */
function opentute_addontag_entry_author($string = ' by ', $userID = false) 
{
	$author = '';

	if($userID) {
		$author = get_the_author_meta('display_name',$userID);
	}
	else {
		$author = get_the_author();
		$userID = get_the_author_meta('ID');
	}

	if($author != '') {
		printf( '<span class="meta-author"><span class="author vcard"><span class="meta-author-prep">%1$s </span><a href="%2$s" class="url fn n" title="%3$s">%4$s</a></span></span>',
			$string,
			esc_url( get_author_posts_url($userID) ),
			sprintf( esc_attr__( 'View all posts by %s', 'opentuteplus' ), $author ),
			$author
		);
	}
}
endif; // opentute_addontag_entry_author

if ( ! function_exists( 'opentute_addontag_entry_footer' ) ) :
/**
 * Prints HTML with entry footer.
 */
function opentute_addontag_entry_footer() {
	if ( is_single() ) { ?>
	
	<footer class="entry-footer">
	
	<div class="footer-first-line">

	<?php	
		// entry categories
		opentute_addontag_entry_categories();

		// entry tags
		opentute_addontag_entry_tags();
	?>

	</div>

	<?php
		// opentute entry author info
		opentute_addontag_entry_author_info();
	?>
	
	</footer><!-- .entry-footer -->
	
	<?php
	} // is_single
}
endif; // opentute_addontag_entry_footer

if ( ! function_exists( 'opentute_addontag_entry_categories' ) ) :
/**
 * Prints HTML with entry categories.
 */
function opentute_addontag_entry_categories() {
	$categories_list = get_the_category_list( ' ' );
	if ( $categories_list ) {
		printf( '<span class="meta-categories"><span class="meta-categories-prep">%1$s </span>%2$s</span>',
			__( 'Categories', 'opentuteplus' ),
			$categories_list
		);
	}
}
endif; // opentute_addontag_entry_categories

if ( ! function_exists( 'opentute_addontag_entry_tags' ) ) :
/**
 * Prints HTML with entry tags.
 */
function opentute_addontag_entry_tags() {
	$tags_list = get_the_tag_list( '', ' ' );
	if ( $tags_list ) {
		printf( '<span class="meta-tags"><span class="meta-tags-prep">%1$s </span>%2$s</span>',
			__( 'Tags', 'opentuteplus' ),
			$tags_list
		);
	}
}
endif; // opentute_addontag_entry_tags

if ( ! function_exists( 'opentute_addontag_entry_author_info' ) ) :
/**
 * Prints HTML with entry author info.
 */
function opentute_addontag_entry_author_info() {
	if ( is_single() && get_the_author_meta( 'description' ) ) { ?>
	
	<div class="author-info">
		<span>Published By</span>
		<div class="row">
			<div class="col-md-2 author-avatar">
				<?php
					echo get_avatar(get_the_author_meta('user_email'),96,'','Author',array(
						'class' => 'img-circle'
					));
				?>
			</div><!-- .author-avatar -->
			<div class="col-md-10 author-description">
				<h3 class="author-title"><?php the_author(); ?></h3>
				<p class="author-bio">
					<?php the_author_meta( 'description' ); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-link" rel="author">
						<?php printf( __( 'View all posts by %s', 'opentuteplus' ), get_the_author() ); ?>
					</a>
				</p>
			</div><!-- .author-description -->
		</div>		
	</div><!-- .meta-author-info -->
	
	<?php 
	}
}
endif; // opentute_addontag_entry_author_info

if ( ! function_exists( 'opentute_addontag_thumbnail_src' ) ) :
/**
 * Custom post thumbnail.
 */
function opentute_addontag_thumbnail_src($image_id = false, $size = 'full')
{	
	if(! $image_id) return false;

	$thumb = wp_get_attachment_image_src($image_id,$size);

	if($thumb) {
		return $thumb['0'];
	} else {
		return false;	
	}
}
endif; // opentute_addontag_thumbnail_src