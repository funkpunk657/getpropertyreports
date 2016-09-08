<?php
/*
This file handles the admin area and functions.
*/

/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //
	// remove plugin dashboard boxes
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget
}


// Dashboard Widget
function launch_dashboard_widget() {
	include 'dashboard-widget.php';
}

// calling all custom dashboard widgets
function launch_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'launch_dashboard_widget', __( 'Welcome.', 'launchtheme' ), 'launch_dashboard_widget' );
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}


// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );
// adding any custom widgets
add_action( 'wp_dashboard_setup', 'launch_custom_dashboard_widgets' );


/************* CUSTOM LOGIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function launch_login_css() {
	wp_enqueue_style( 'launch_login_css', get_template_directory_uri() . '/library/css/login.css', false );
}

// changing the logo link from wordpress.org to your site
function launch_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function launch_login_title() { return get_option( 'blogname' ); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'launch_login_css', 10 );
add_filter( 'login_headerurl', 'launch_login_url' );
add_filter( 'login_headertitle', 'launch_login_title' );


/************* CUSTOMIZE ADMIN *******************/

/*
I don't really recommend editing the admin too much
as things may get funky if WordPress updates. Here
are a few funtions which you can choose to use if
you like.
*/

// Custom Backend Footer
function launch_custom_admin_footer() {
	_e( '<span id="footer-thankyou">Designed &amp; Developed by <a href="http://launchboom.com" target="_blank">LaunchBoom</a></span>.', 'launchtheme' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'launch_custom_admin_footer' );


// 
// add last edited columns to all pages, posts, and cpts
// 

// last edited info
add_action ( 'manage_posts_custom_column', 'rkv_post_columns_data',	10,	2	);
add_filter ( 'manage_edit-success_story_columns', 'rkv_post_columns_display'	);
add_filter ( 'manage_edit-litter_columns', 'rkv_post_columns_display'	);
add_filter ( 'manage_edit-post_columns', 'rkv_post_columns_display'	);

// last edited info -- post function
function rkv_post_columns_data( $column, $post_id ) {
	switch ( $column ) {
	case 'modified':
		$m_orig		= get_post_field( 'post_modified', $post_id, 'raw' );
		$m_stamp	= strtotime( $m_orig );
		$modified	= date('n/j/y @ g:i a', $m_stamp );
	       	$modr_id	= get_post_meta( $post_id, '_edit_last', true );
	       	$auth_id	= get_post_field( 'post_author', $post_id, 'raw' );
	       	$user_id	= !empty( $modr_id ) ? $modr_id : $auth_id;
	       	$user_info	= get_userdata( $user_id );
	
	       	echo '<p class="mod-date">';
	       	echo '<em>'.$modified.'</em><br />';
	       	echo 'by <strong>'.$user_info->display_name.'<strong>';
	       	echo '</p>';
		break;
	// end all case breaks
	}
}
function rkv_post_columns_display( $columns ) {
	$columns['modified']	= 'Last Modified';
	return $columns;
}

// last edited info -- page function
add_action ( 'manage_pages_custom_column',	'rkv_heirch_columns',	10,	2	);
add_filter ( 'manage_edit-page_columns',	'rkv_page_columns'				);
function rkv_heirch_columns( $column, $post_id ) {
	switch ( $column ) {
	case 'modified':
		$m_orig		= get_post_field( 'post_modified', $post_id, 'raw' );
		$m_stamp	= strtotime( $m_orig );
		$modified	= date('n/j/y @ g:i a', $m_stamp );
	       	$modr_id	= get_post_meta( $post_id, '_edit_last', true );
	       	$auth_id	= get_post_field( 'post_author', $post_id, 'raw' );
	       	$user_id	= !empty( $modr_id ) ? $modr_id : $auth_id;
	       	$user_info	= get_userdata( $user_id );
	
	       	echo '<p class="mod-date">';
	       	echo '<em>'.$modified.'</em><br />';
	       	echo 'by <strong>'.$user_info->display_name.'<strong>';
	       	echo '</p>';
		break;
	// end all case breaks
	}
}
function rkv_page_columns( $columns ) {
	$columns['modified']	= 'Last Modified';
	return $columns;
}



// predefined custom colors in wysiwyg editor
function my_mce4_options( $init ) {
$default_colours = '
 "172023", "Black",
 "333333", "Dark Grey",
 "0163a9", "Dark Blue",
 "00a5cd", "Light Blue",
 "f68c27", "Orange",
 ';
$custom_colours = '';
$init['textcolor_map'] = '['.$default_colours.']';
return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');


// button shortcoe
function button_shortcode($params = array()) {
	extract(shortcode_atts(array(
 		'text' => 'Button Text',
 		'url' => '#'
 	), $params));
	
	return '<a href="'.$url.'" class="button">' . $text . '</a>';
}
add_shortcode('button', 'button_shortcode');


?>
