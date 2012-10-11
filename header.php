<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Peace 107
 * @since Peace 107 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'peace107' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>

<![endif]-->

<?php wp_head(); ?>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	
	<!-- http://t.co/dKP3o1e -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width">
	

	
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="wp-content/themes/peace107/style/ie-fix.css" media="screen">
	<![endif]-->
		
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script src="wp-content/themes/peace107/js/selectivizr-1.0.3.min.js"></script>
	<![endif]-->
	
	<meta http-equiv="cleartype" content="on">
</head>

<body <?php body_class('cf'); ?>>
<div id="page" class="hfeed site cf">
	<?php do_action( 'before' ); ?>
        <div class="ad leaderboard"><a href="http://www.st-joseph.org/body.cfm?id=361" target="_blank"><img class="phantom" src="http://peace107.com/wp-content/themes/peace107/style/images/phantom.gif"></a></div>
	<header id="masthead" class="site-header" role="banner">
        <span id="branding"><a href="<?php echo site_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></a></span>
		<hgroup>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav role="navigation" class="site-navigation main-navigation">
			<h1 class="assistive-text"><?php _e( 'Menu', 'peace107' ); ?></h1>
			<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'peace107' ); ?>"><?php _e( 'Skip to content', 'peace107' ); ?></a></div>
            
            <a class="btn btn-navbar" data-toggle="collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
			<?php $args = array(
                'theme_location' => 'primary',
                'menu_id'         => 'overthrow',
                'menu_id'         => 'menu',
            );
            wp_nav_menu( $args ); ?>
		</nav><!-- .site-navigation .main-navigation -->
	</header><!-- #masthead .site-header -->

	<div id="main" class="cf">