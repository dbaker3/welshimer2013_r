<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0" />
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
		echo ' | ' . sprintf( __( 'Page %s', 'welshimer2013' ), max( $paged, $page ) );

	?></title>
<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
<link rel="apple-touch-icon" href="/wp-content/uploads/images/icon.png" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.min.js" type="text/javascript"></script>
	<link href="<?php echo get_template_directory_uri(); ?>/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 7]>
	<link href="<?php echo get_template_directory_uri(); ?>/ie6.css" media="screen, projection" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body <?php body_class(); ?>>
	<div id="mobile-menu-wrapper">
		<button id="menu-toggle">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div id="primary-menu" class="menu-text">
		<nav role="navigation" class="main-navigation">
		<h1 class="assistive-text"><?php _e( 'Menu', 'welshimer2013' ); ?></h1>
		<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'welshimer2013' ); ?>"><?php _e( 'Skip to content', 'welshimer2013' ); ?></a></div>

		<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			<div class="social-menu">
				<ul>
					<li><a href="http://milliganlibrary.wordpress.com/" target="_blank"></a></li><!--Library Blog-->
					<li><a href="https://twitter.com/intent/user?screen_name=MilliganLibrary" target="_blank"></a></li><!--Twitter-->
					<li><a href="http://www.facebook.com/milligancollegelibrary" target="_blank"></a></li><!--Facebook-->
				</ul>
			</div>
		</nav>
	</div><!-- #primary-navigation-->
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<nav class="secondary-menu menu-text"><div class="secondary-menu-main"><?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?></div><div class="secondary-menu-select"><select><option>Go to...</option></select></div></nav>
		<hgroup>
			<h4 class="milligan-logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/milligan-logo.png" /></a></h4>
			<h4 class="welshimer-logo"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo( 'template_url' ); ?>/images/welshimer-logo.png" /></a></h4>
		</hgroup>
	</header><!-- #masthead .site-header -->

	<div id="main">