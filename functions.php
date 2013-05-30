<?php
/**
 * welshimer2013 functions and definitions
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since welshimer2013 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'welshimer2013_setup' ) ):

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since welshimer2013 1.0
 */
function welshimer2013_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on welshimer2013, use a find and replace
	 * to change 'welshimer2013' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'welshimer2013', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'welshimer2013' ),
		'secondary' => __( 'Secondary Menu', 'welshimer2013' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );

	/**
	 * Add Plugins
	 */
	require( get_template_directory() . '/inc/theme-plugins/twitter-cache-plugin-wordpress/twitter-cache-plugin.php' );
	require( get_template_directory() . '/inc/theme-plugins/library-thing-plugin-wordpress/library-thing-plugin.php' );
	require( get_template_directory() . '/inc/theme-plugins/ref-count/ref-count.php' );
	require( get_template_directory() . '/inc/theme-plugins/ga-wordpress/ga.php' );

	/**
	 * Add Widgets
	 */
	require( get_template_directory() . '/inc/theme-widgets/contact-widget.php' );
	require( get_template_directory() . '/inc/theme-widgets/libhelp-widget.php' );
	require( get_template_directory() . '/inc/theme-widgets/twitter-widget.php' );
}
endif; // welshimer2013_setup
add_action( 'after_setup_theme', 'welshimer2013_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since welshimer2013 1.0
 */
function welshimer2013_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'welshimer2013' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'welshimer2013_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function welshimer2013_scripts() {
	global $post;

	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_script( 'js-min', get_template_directory_uri() . '/js/js-min.js', array( 'jquery' ), '20120906', true );

// These are included in js-min.js but are retained for testing purposes
	//wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120626', true );
	//wp_enqueue_script( 'timeago', get_template_directory_uri() . '/js/timeago.js', array( 'jquery' ), '20120904', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'welshimer2013_scripts' );

function welshimer2013_before_sidebar() {
	echo '<a class="side-expand"></a>';
}
add_action('before_sidebar', 'welshimer2013_before_sidebar');


////////////////////////////////
// Shortcodes For Awesomeness //
////////////////////////////////

// MCSearch Box [mcsearchbox] //

	function mcsearchbox_make( $atts ){ // Makes shortcode for MCSearchbox
		// Script from EBSCO
		wp_enqueue_script( 'ebsco', 'http://supportforms.epnet.com/eit/scripts/ebscohostsearch.js' , false , '20120626', true );

		ob_start(); ?>
		<div id="eds">
			<form action="" onsubmit="return ebscoHostSearchGo(this);" method="post">
				<div id="eds-search">
					<img src="http://library.milligan.edu/wp-content/uploads/images/mcsearch_150px.png" alt="MCSearch" /><!--

					--><input id="ebscohostwindow" name="ebscohostwindow" type="hidden" value="1" /><!--
					--><input id="ebscohosturl" name="ebscohosturl" type="hidden" value="http://search.ebscohost.com/login.aspx?direct=true&site=eds-live&scope=site&type=0&custid=s8886565&groupid=main&profid=edsmain&mode=and&lang=en&authtype=ip,guest" /><!--
					--><input id="ebscohostsearchsrc" name="ebscohostsearchsrc" type="hidden" value="db" /><!--
					--><input id="ebscohostsearchmode" name="ebscohostsearchmode" type="hidden" value="+AND+" /><!--
					--><input id="ebscohostkeywords" name="ebscohostkeywords" type="hidden" value="" /><!--
					--><input id="ebscohostsearchtext" name="ebscohostsearchtext" type="text" size="23"/><!--
					--><input type="submit" value="&#xe00f;" id="ebscohostsubmit" />
				</div>
				<div id="eds-more">
				<input type="checkbox" id="chkCatalogOnly" name="chkCatalogOnly" />
				<label for="chkCatalogOnly">Limit to Items in Milligan's Catalog</label></div>
				<div id="eds-more-toggle">&nbsp;</div>
			</form>
		</div><!-- #eds --><?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
	add_shortcode( 'mcsearchbox', 'mcsearchbox_make' );