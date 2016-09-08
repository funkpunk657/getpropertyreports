<?php

/*
Author: Launchboom
URL: htp://launchboom.com/

*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/launch.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/launch.php' ); // if you remove this, launch will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
// require_once( 'library/news-post-type.php' ); 
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/acf.php
	- adding custom acf functions to make things a little easier
*/
require_once( 'library/acf.php' ); 

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'launch-thumb-600', 600, 150, true );
add_image_size( 'launch-thumb-300', 300, 100, true );
add_image_size( 'medium-bg', 1000, 500, true );
add_image_size( 'mobile-bg', 600, 400, true );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function launch_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'launchtheme' ),
		'description' => __( 'The first (primary) sidebar.', 'launchtheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

}

/************* COMMENT LAYOUT *********************/

////a custom excerpt length 

// TRUNCK STRING TO SHORT THE STRINGS
function trunck_string($str = "", $len = 150, $more = 'true') {

    if ($str == "") return $str;
    if (is_array($str)) return $str;
    $str = strip_tags($str);    
    $str = trim($str);
    // if it's les than the size given, then return it

    if (strlen($str) <= $len) return $str;

    // else get that size of text
    $str = substr($str, 0, $len);
    // backtrack to the end of a word
    if ($str != "") {
      // check to see if there are any spaces left
      if (!substr_count($str , " ")) {
        if ($more == 'true') $str .= "...";
        return $str;
      }
      // backtrack
      while(strlen($str) && ($str[strlen($str)-1] != " ")) {
        $str = substr($str, 0, -1);
      }
      $str = substr($str, 0, -1);
      if ($more == 'true') $str;
      if ($more != 'true' and $more != 'false') $str .= $more;
    }
    return $str;
}
// the_content() WITHOUT IMAGES
// GET the_content() BUT EXCLUDE <img> OR <img/> TAGS THEN ECHO the_content()
function custom_excerpt( $Trunckvalue = null ) {
    ob_start();
    the_content();
    $postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
    ob_end_clean();
    echo trunck_string( $postOutput, $Trunckvalue, true ); ?>
    <?php
}

//// if is a parent of a specific page

// usage
/*
if (is_tree(2)) {
   // stuff
}
*/
function is_tree($pid) {
  global $post;

  $ancestors = get_post_ancestors($post->$pid);
  $root = count($ancestors) - 1;
  $parent = $ancestors[$root];

  if(is_page() && (is_page($pid) || $post->post_parent == $pid || in_array($pid, $ancestors))) {
    return true;
  } else {
    return false;
  }
};

// turn off page comments
// function default_comments_off( $data ) {
//     if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
//         $data['comment_status'] = 0;
//     } 
//     return $data;
// }
// add_filter( 'wp_insert_post_data', 'default_comments_off' );

// change search form
function html5_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="cf searchform" action="' . home_url( '/blog/' ) . '" >
    <input type="search" placeholder="'.__("Search our blog").'" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="Search" />
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'html5_search_form' );


// fancy button
function button($link, $text = "Watch Video", $class = ""){
	echo '<a href="'.$link.'" class="cf button play-button video-player '.$class.'">';
		echo '<span>'.$text.'</span>';
		echo '<svg class="play-button-arrow" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			width="44px" height="40px" viewBox="0 0 44 40" enable-background="new 0 0 44 40" xml:space="preserve">
			<polygon fill="none" stroke="#FFFFFF" stroke-miterlimit="10" points="14.637,12.633 29.52,21.225 14.637,29.818 "/>
			</svg>';
		
	echo '</a>';
}

function background( $image, $class ) {

  $img = get_field($image);

  echo '<style>';
    echo $class. '{background-image: url('. $img['sizes']['mobile-bg'] .');}';
    echo '@media screen and (min-width: 600px){' .$class. '{background-image: url('. $img['medium-bg'] .');}}';
    echo '@media screen and (min-width: 1000px){' .$class. '{background-image: url('. $img['url'] .');}}';
  echo '</style>';
  
}

function backgroundsub( $subimage, $class ) {

  $subimg = get_sub_field($subimage);

  echo '<style>';
    echo $class. '{background-image: url('. $subimg['sizes']['mobile-bg'] .');}';
    echo '@media screen and (min-width: 600px){' .$class. '{background-image: url('. $subimg['sizes']['medium-bg'] .');}}';
    echo '@media screen and (min-width: 1000px){' .$class. '{background-image: url('. $subimg['url'] .');}}';
  echo '</style>';
  
}



















