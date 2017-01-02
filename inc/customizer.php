<?php
/*
 * OpenTute+ customizer functionality.
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package WordPress
 * @subpackage OpenTute+
 */

/**
 * opentute_customize_register
 */
function opentute_customize_register( $wp_customize ) {
	$theme_name = wp_get_theme();
	
	/**
	 * Header logo
	 */
	$wp_customize->add_section( 'opentute_addontag_header_logo', array(
		'title'			=> esc_html__( 'Header Logo', 'opentute' ),
		'priority'		=> 50,
		'description'   => 'This will replace the header text/title.',
	) );
	
    $wp_customize->add_setting( 'opentute_addontag_header_logo_image', array(
		'default' 			=> '',
		'sanitize_callback' => 'sanitize_text_field',
    ));

	$wp_customize->add_control( 
		new WP_Customize_Upload_Control( 
		$wp_customize, 
		'opentute_addontag_header_logo_image', 
		array(
			'label'      => __( 'Header Logo', 'opentute' ),
			'section'    => 'opentute_addontag_header_logo',
			'settings'   => 'opentute_addontag_header_logo_image',
		) ) 
	);


	/**
	 * Featured Post
	 */
	$wp_customize->add_section( 'opentute_addontag_featured_post', array(
		'title'			=> esc_html__( 'Featured Post', 'opentute' ),
		'priority'		=> 40,
		'description'   => 'Featured post on the blog.',
	) );
	
    // select post
    $select_posts = array('' => esc_html__( 'Dont use featured post', 'opentute' ));
    $array_posts = get_posts(
    	array(
    		'post_type'=> 'post', 
    		'post_status'=> 'publish',
    		'suppress_filters' => false, 
    		'posts_per_page'=> -1
    	)
    );
    foreach ($array_posts as $post) {
    	$select_posts[$post->ID] = $post->post_title;
    }
	$wp_customize->add_setting( 'opentute_addontag_featured_post_select', array(
		'default' 			=> '',
		'sanitize_callback' => 'sanitize_text_field',
    ));
	$wp_customize->add_control(
		'opentute_addontag_featured_post_select',
		array(
			'type' => 'select',
			'label' => esc_html__( 'Featured Post', 'opentute' ),
			'description' => esc_html__( 'The post to use as featured post.', 'opentute' ),
			'section' => 'opentute_addontag_featured_post',
			'choices' => $select_posts
		)
	);	

	// default background
	$wp_customize->add_setting( 'opentute_addontag_featured_post_default_image', array(
		'default' 			=> '',
		'sanitize_callback' => 'sanitize_text_field',
    ));
	$wp_customize->add_control( 
		new WP_Customize_Upload_Control( 
		$wp_customize, 
		'opentute_addontag_featured_post_default_image', 
		array(
			'label' => __( 'Default Background', 'opentute' ),
			'description' => __( 'Use this image as featured post background if selected post featured image is not available.', 'opentute' ),
			'section' => 'opentute_addontag_featured_post',
			'settings' => 'opentute_addontag_featured_post_default_image',
		) ) 
	);


	/**
	 * Others background
	 */	
	// single post default background
	$wp_customize->add_setting( 'opentute_addontag_single_post_default_image', array(
		'default' 			=> '',
		'sanitize_callback' => 'sanitize_text_field',
    ));
	$wp_customize->add_control( 
		new WP_Customize_Upload_Control( 
		$wp_customize, 
		'opentute_addontag_single_post_default_image', 
		array(
			'label' => __( 'Single Post Title Background', 'opentute' ),
			'description' => __( 'Use this image as title post background if selected post featured image is not available.', 'opentute' ),
			'section' => 'background_image',
			'settings' => 'opentute_addontag_single_post_default_image',
		) ) 
	);

	// archive background
	$wp_customize->add_setting( 'opentute_addontag_archive_image', array(
		'default' 			=> '',
		'sanitize_callback' => 'sanitize_text_field',
    ));
	$wp_customize->add_control( 
		new WP_Customize_Upload_Control( 
		$wp_customize, 
		'opentute_addontag_archive_image', 
		array(
			'label' => __( 'Archive Title Background', 'opentute' ),
			'description' => __( 'Background image for archive (posts by author, category or tag) and search result header title.', 'opentute' ),
			'section' => 'background_image',
			'settings' => 'opentute_addontag_archive_image',
		) ) 
	);


	/**
	 * Google Font
	 */
	$wp_customize->add_section( 'opentute_google_font', array(
		'title'			=> esc_html__( 'Google Font', 'opentute' ),
		'priority'		=> 130,
		'description'   => 'Integrate the fonts into your CSS. All you need to do is add the font name to your CSS styles. For example: "font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif; If You want to add more than one font just separate them with pipe "|", for example: "Open Sans:400|Inconsolata:400,700". Default subset is "latin,latin-ext"',
	) );
	
    $wp_customize->add_setting( 'opentute_google_font_family', array(
		'default' 			=> 'Open Sans:400',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	
   $wp_customize->add_control( 'opentute_google_font_family', array(
		'label'		=> esc_html__( 'Google Font family', 'opentute' ),
        'section' => 'opentute_google_font',
        'type'    => 'text',
    ) );
	
    $wp_customize->add_setting( 'opentute_google_font_subset', array(
		'default' 			=> 'latin,latin-ext',
		'sanitize_callback' => 'sanitize_text_field',
    ) );
	
    $wp_customize->add_control( 'opentute_google_font_subset', array(
		'label'	  => esc_html__( 'Google Font subset', 'opentute' ),
        'section' => 'opentute_google_font',
        'type'    => 'text',
    ) );
	

	/**
	 * Layout
	 */
	$wp_customize->add_section( 'opentute_layout', array(
		'title'			=> esc_html__( 'Layout', 'opentute' ),
		'priority'		=> 140,
	) );
	
	// Site layout
	$wp_customize->add_setting( 'opentute_site_layout', array(
		'default' 			=> 'layout-boxed',
		'sanitize_callback' => 'opentute_sanitize_site_layout',
	) );
	 
	$wp_customize->add_control(
		'opentute_site_layout',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Site layout', 'opentute' ),
			'section' => 'opentute_layout',
			'choices' => array(
				'layout-boxed' => esc_html__( 'Boxed', 'opentute' ),
				'layout-wide'  => esc_html__( 'Wide', 'opentute' ),
			),
		)
	);	
	
	// Post layout
	$wp_customize->add_setting( 'opentute_post_layout', array(
		'default' 			=> 'two-columns-right-sidebar',
		'sanitize_callback' => 'opentute_sanitize_post_layout',
	) );
	 
	$wp_customize->add_control(
		'opentute_post_layout',
		array(
			'type' => 'radio',
			'label' => esc_html__( 'Post layout', 'opentute' ),
			'section' => 'opentute_layout',
			'choices' => array(
				'one-column' => esc_html__( 'One column', 'opentute' ),
				'two-columns-right-sidebar' => esc_html__( 'Two columns, right sidebar', 'opentute' ),
				'two-columns-left-sidebar'=> esc_html__( 'Two columns, left sidebar', 'opentute' ),
			),
		)
	);
}
add_action( 'customize_register', 'opentute_customize_register' );

if ( ! function_exists( 'opentute_sanitize_post_layout' ) ) :
/**
 * Sanitize post layout.
 */
function opentute_sanitize_post_layout( $post_layout ) {
	if ( ! in_array( $post_layout, array( 'one-column', 'two-columns-right-sidebar', 'two-columns-left-sidebar' ), true ) ) {
		$post_layout = 'two-columns-right-sidebar';
	}

	return $post_layout;
}
endif; // opentute_sanitize_post_layout

if ( ! function_exists( 'opentute_sanitize_site_layout' ) ) :
/**
 * Sanitize site layout.
 */
function opentute_sanitize_site_layout( $site_layout ) {
	if ( ! in_array( $site_layout, array( 'layout-boxed', 'layout-wide' ), true ) ) {
		$site_layout = 'layout-boxed';
	}

	return $site_layout;
}
endif; // opentute_sanitize_site_layout

if ( !function_exists( 'opentute_customizer_google_fonts_url' ) ) :
/**
 * Google Font URL.
 */
function opentute_customizer_google_fonts_url() {
	$fonts_url = '';
	$fonts = get_theme_mod( 'opentute_google_font_family' );
	$subsets = get_theme_mod( 'opentute_google_font_subset' );
		
	if (! empty ( $subsets ) ) {
		$query_args = array(
			'family' => urlencode( $fonts  ),
			'subset' => urlencode( $subsets ),
		);
	} else {
		$query_args = array(
			'family' => urlencode( $fonts  ),
		);		
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
endif; // opentute_customizer_google_fonts_url

/**
 * Enqueue Google Font style.
 */
function opentute_enqueue_style_google_font_url() {
    wp_enqueue_style( 'opentute-google-font', opentute_customizer_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'opentute_enqueue_style_google_font_url' );

/**
 * Adding Google Font to the editor.
 */
function opentute_add_editor_style_customizer_google_fonts_url() {
    add_editor_style( opentute_customizer_google_fonts_url() );
}
add_action( 'after_setup_theme', 'opentute_add_editor_style_customizer_google_fonts_url' );

/**
 * Adding Google font to the Custom Header screen.
 */
function opentute_enqueue_style_google_font_custom_header() {
    wp_enqueue_style( 'opentute-google-font', opentute_customizer_google_fonts_url(), array(), null );
}
add_action( 'admin_print_styles-appearance_page_custom-header', 'opentute_enqueue_style_google_font_custom_header' );
