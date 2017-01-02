<?php
/**
 * Adds post layout options on posts and pages.
 *
 * @package WordPress
 * @subpackage OpenTute+
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Adds a box to the side column on the Page and Post edit screens.
 */
function opentute_post_layout_add_meta_box() {
	$post_types = array( 'page', 'post' );
	
	foreach ( $post_types as $post_type ) {
		add_meta_box( 
			'opentute_post_layout', 
			__( 'Post layout', 'opentute' ), 
			'opentute_post_layout_callback', 
			$post_type, 
			'side', 
			'default' 
		);
    }
}
add_action( 'add_meta_boxes', 'opentute_post_layout_add_meta_box' );

/**
 * Prints the box content.
 */
function opentute_post_layout_callback() {
	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'opentute_post_layout', 'opentute_post_layout_nonce' );
	
	global $post;
	$custom        = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$post_layout        = ( isset( $custom['_opentute_post_layout'][0] ) ? $custom['_opentute_post_layout'][0] : 'default' );
	$valid_post_layouts = opentute_valid_post_layouts();
	?>
	<p>
		<label><input type="radio" name="_opentute_post_layout" <?php checked( 'default' == $post_layout ); ?> value="default" />
		<?php esc_html_e( 'Default', 'opentute' ); ?></label><br />
		<?php foreach( $valid_post_layouts as $slug => $name ) { ?>
			<label><input type="radio" name="_opentute_post_layout" <?php checked( $slug == $post_layout ); ?> value="<?php echo esc_attr( $slug ); ?>" />
			<?php echo esc_html( $name ); ?></label><br />
		<?php } ?>
	</p>
<?php
}

/**
 * When the post is saved, saves our custom data.
 */
function opentute_post_layout_save_meta_box_data() {
	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! isset( $_POST['opentute_post_layout_nonce'] ) && ! wp_verify_nonce( $_POST['opentute_post_layout_nonce'] ) ) {
		return;
	}

	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	global $post;
	if( !isset( $post ) || !is_object( $post ) ) {
		return;
	}
	$valid_post_layouts = opentute_valid_post_layouts();
	$post_layout        = ( isset( $_POST['_opentute_post_layout'] ) && array_key_exists( $_POST['_opentute_post_layout'], $valid_post_layouts ) ? $_POST['_opentute_post_layout'] : 'default' );

	update_post_meta( $post->ID, '_opentute_post_layout', $post_layout );
}

// Hook the save post layout post custom meta data into
// publish_{post-type}, draft_{post-type}, and future_{post-type}
add_action( 'publish_post', 'opentute_post_layout_save_meta_box_data' );
add_action( 'publish_page', 'opentute_post_layout_save_meta_box_data' );
add_action( 'draft_post', 'opentute_post_layout_save_meta_box_data' );
add_action( 'draft_page', 'opentute_post_layout_save_meta_box_data' );
add_action( 'future_post', 'opentute_post_layout_save_meta_box_data' );
add_action( 'future_page', 'opentute_post_layout_save_meta_box_data' );


/**
 * Get valid post layouts.
 */
function opentute_valid_post_layouts() {
	$post_layouts = array(
		'one-column'			=> __( 'One column', 'opentute' ),
		'two-columns-right-sidebar'	=> __( 'Two columns, right sidebar', 'opentute' ),
		'two-columns-left-sidebar'	=> __( 'Two columns, left sidebar', 'opentute' )
	);

	return apply_filters( 'opentute_valid_post_layouts', $post_layouts );
}

/**
 * Get current post layout.
 */
function opentute_get_post_layout() {
	// 404 pages
	if( is_404() ) {
		return 'default';
	}
	$post_layout = '';
	
	$valid_post_layouts = opentute_valid_post_layouts();

	global $post;
	$post_layout_meta_value = ( false != get_post_meta( get_the_ID(), '_opentute_post_layout', true ) ? get_post_meta( get_the_ID(), '_opentute_post_layout', true ) : 'default' );
	$post_layout_meta       = ( array_key_exists( $post_layout_meta_value, $valid_post_layouts ) ? $post_layout_meta_value : 'default' );	
	
	if( 'default' != $post_layout_meta ) {
		$post_layout = $post_layout_meta;
	} else {
		$post_layout = 'default';	
	}

	return apply_filters( 'opentute_get_post_layout', $post_layout );
}

/**
 * Get content classes.
 */
function opentute_post_layout_content_classes() {
	$content_classes = array();
	$post_layout          = opentute_get_post_layout();
	
	if( 'default' == $post_layout ) {
		$content_classes[] = get_theme_mod( 'opentute_post_layout', 'two-columns-right-sidebar' );
	}
	else {
		if( 'one-column' == $post_layout ) {
			$content_classes[] = 'one-column';
		}
		else {
			if( 'two-columns-right-sidebar' == $post_layout ) {
				$content_classes[] = 'two-columns-right-sidebar';
			}
			else {
				if( 'two-columns-left-sidebar' == $post_layout ) {
					$content_classes[] = 'two-columns-left-sidebar';
				}
			}
		}
	}

	return apply_filters( 'opentute_post_layout_content_classes', $content_classes );
}

/**
 * opentute_post_layout_body_class
 */
function opentute_post_layout_body_class( $classes ) {

	// add 'class-name' to the $classes array
	$content_class = implode( ' ', opentute_post_layout_content_classes() );
	$classes[] = $content_class;
	
	// return the $classes array
	return $classes;
}
add_filter( 'body_class', 'opentute_post_layout_body_class', 20 );

/**
 * opentute_post_layout
 */
function opentute_post_layout() {
	$post_layout = '';
	
	$post_layout = implode( ' ', opentute_post_layout_content_classes() );
	
	return $post_layout;
}
