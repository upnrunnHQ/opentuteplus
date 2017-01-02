<?php
/**
 * Header Template
 * The area of the page that contains the header.
 *
 * @link https://codex.wordpress.org/Designing_Headers
 *
 * @package WordPress
 * @subpackage OpenTute+
 */
?><!DOCTYPE html>
<?php do_action( 'opentute_html_before' ); ?>
<html <?php language_attributes(); ?>>
<head>
	<?php do_action('opentute_head_top'); ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv/html5shiv.min.js?ver=3.7.3" type="text/javascript"></script>
	<![endif]-->
	<!-- Krusze v0.9.7 - http://wordpress.org/themes/krusze -->

	<?php do_action('opentute_head_bottom'); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">
	<a class="skip-link screen-reader-text sr-only" href="#content" title="<?php esc_attr_e( 'Skip to content', 'opentuteplus' ); ?>"><?php _e( 'Skip to content', 'opentuteplus' ); ?></a>
		
	<?php do_action( 'opentute_header_before' ); ?>
	
	<header id="header" <?php opentute_header_class(); ?> role="banner">
	
		<?php do_action( 'opentute_header_top' ); ?>
	
		<div class="container">
			<div class="row">
			
				<div class="site-brand">

				<?php $logo = get_theme_mod('opentute_addontag_header_logo_image'); if($logo != ''): ?>
				
				<a id="site-header-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<span style="background-image:url(<?php echo $logo ?>)"></span>
				</a>

				<?php 
				else: 

				$description = get_bloginfo( 'description', 'display' );
				$site_title_class = 'site-title';

				if($description == '') {
					$site_title_class = 'site-title site-title-no-description';
				}
				?>

				<?php if ( is_home() || is_front_page() ) { ?>
					<h1 class="<?php echo $site_title_class ?>">
				<?php } else { ?>
					<p class="<?php echo $site_title_class ?>">
				<?php } ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php if ( is_home() || is_front_page() ) { ?>
					</h1>
				<?php } else { ?>
					</p>
				<?php }
				
				if ( $description || is_customize_preview() ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<p class="site-description"><?php echo $description; ?></p>
					</a>
				<?php endif; ?>

				<?php endif; ?>
					
				</div><!-- .site-brand -->
		
				<?php if ( is_active_sidebar( 'header' ) ) : ?>
				
					<div class="sidebar sidebar-header" role="complementary">
						<?php dynamic_sidebar( 'header' ); ?>
					</div>
					
				<?php else : 
				
					if ( has_nav_menu( 'site-navigation' ) ) : ?>
					<input type="checkbox" id="navbar-navigation-toggle" />
					<label for="navbar-navigation-toggle" class="navigation-toggle">
						<span class="screen-reader-text sr-only"><?php _e( 'Navigation', 'opentuteplus' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</label>	
					<nav id="navbar-navigation" class="navigation navbar-navigation navbar-collapse" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'site-navigation', 'container' => false, 'menu_class' => 'menu site-navigation nav navbar-nav navbar-right', 'fallback_cb' => false ) ); ?>
					</nav>
					<?php 
					endif; // end has_nav_menu( 'site-navigation' ) )
					
				endif; // end is_active_sidebar( 'header' )
				?>
			
			</div><!-- .row -->
		</div><!-- .container -->
		
		<?php do_action( 'opentute_header_bottom' ); ?>
		
	</header><!-- #header -->
	
	<?php do_action( 'opentute_header_after' ); ?>

	<?php do_action( 'opentute_content_before' ); ?>
	
	<div id="content" class="site-content">
		
		<?php do_action( 'opentute_content_top' ); ?>
		