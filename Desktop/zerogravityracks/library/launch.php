<?php
/* Welcome to the launch framework :)
This is the core file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.
*/

/*********************
LAUNCH launch
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'launch_ahoy', 16 );

function launch_ahoy() {

    // launching operation cleanup
    add_action( 'init', 'launch_head_cleanup' );
    // remove WP version from RSS
    add_filter( 'the_generator', 'launch_rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'launch_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'launch_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'launch_gallery_style' );

    // enqueue base scripts and styles
    add_action( 'wp_enqueue_scripts', 'launch_scripts_and_styles', 999 );
    // ie conditional wrapper

    // launching this stuff after theme setup
    launch_theme_support();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'launch_register_sidebars' );
    // adding the launch search form (created in functions.php)
    //add_filter( 'get_search_form', 'launch_wpsearch' );

    // cleaning up random code around images
    add_filter( 'the_content', 'launch_filter_ptags_on_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'launch_excerpt_more' );

} /* end launch ahoy */

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function launch_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'launch_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'launch_remove_wp_ver_css_js', 9999 );

} /* end launch head cleanup */

// remove WP version from RSS
function launch_rss_version() { return ''; }

// remove WP version from scripts
function launch_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function launch_remove_wp_widget_recent_comments_style() {
   if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
      remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function launch_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function launch_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
SCRIPTS & ENQUEUEING
*********************/


// loading modernizr and jquery, and reply script
function launch_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {

    // modernizr (without media query polyfill)
    wp_register_script( 'launch-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

    // register main stylesheet
    wp_register_style( 'launch-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', false, filemtime(get_stylesheet_directory() . '/library/css/style.css') /*array(), '', 'all'*/ );



    // ie-only style sheet
    //wp_register_style( 'launch-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		// wp_enqueue_script( 'comment-reply' );
    }

    //adding scripts file in the footer
    wp_register_script( 'launch-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_script( 'launch-modernizr' );
    wp_enqueue_style( 'launch-stylesheet' );
    //wp_enqueue_style( 'launch-ie-only' );

    //$wp_styles->add_data( 'launch-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

    //wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'launch-js' );

    // Remove comment-reply.min.js from footer
    wp_deregister_script( 'comment-reply' );

  }
}
/**
* Dequeue jQuery migrate script in WordPress.
*/
function isa_remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.1' );
    }
}
add_filter( 'wp_default_scripts', 'isa_remove_jquery_migrate' );

// remove emojis scripts
function pw_remove_emojicons() {
    // Remove from comment feed and RSS
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // Remove from emails
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Remove from head tag
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

    // Remove from print related styling
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    // Remove from admin area
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'pw_remove_emojicons' );

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function launch_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'launchtheme' ),   // main nav in header
			'side-nav' => __( 'The Side Menu', 'launchtheme' ),   // side nav
			'footer-links-1' => __( 'Footer Links', 'launchtheme' ),
		)
	);
} /* end launch theme support */


/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function launch_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'launchtheme' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	//'walker' => new WPSE_78121_Sublevel_Walker
	));
} /* end launch main nav */

// the side nav
function launch_side_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'side-menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'The Side Menu', 'launchtheme' ),  // nav name
    	'menu_class' => 'nav side-nav clearfix',         // adding custom nav class
    	'theme_location' => 'side-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	//'walker' => new WPSE_78121_Sublevel_Walker
	));
} /* end launch main nav */

// the footer menu (should you choose to use one)
function launch_footer_links_1() {
    // display the wp3 menu if available
    wp_nav_menu(array(
        'container' => '',                              // remove nav container
        'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
        'menu' => __( 'Footer Links', 'launchtheme' ),   // nav name
        'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
        'theme_location' => 'footer-links',             // where it's located in the theme
        'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    ));
} /* end launch footer link */



/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function launch_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
	return;
	
	echo '<nav class="pagination">';
	
		echo paginate_links( array(
			'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) );
	
	echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function launch_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function launch_excerpt_more($more) {
	global $post;
	// edit here if you like
return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'launchtheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'launchtheme' ) .'</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function launch_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

?>
