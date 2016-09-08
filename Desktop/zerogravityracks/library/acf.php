<?php 

// add options page for acf
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}



// acf image getter
// ex: acf_image('top_image');
function acf_image($field, $class = "") {
   $img = get_field($field);
   $title = get_the_title();
   echo '<img src="'. $img['url'] .'" title="'. $title .'" class="'. $class .'">';
}
function acf_sub_image($field, $class = "") {
   $img = get_sub_field($field);
   $title = get_the_title();
   echo '<img src="'. $img['url'] .'" title="'. $title .'" class="'. $class .'">';
}
function svg_embed($field, $class_name){
	if ( get_field($field) ) :
	  $svg = get_field($field);
	  if ( strpos( $svg, '.svg' ) !== false ) :
	    $svg = str_replace( site_url(), '', $svg);
	    print '<div class="wrap-svg '. $class_name .'">';
	    	echo file_get_contents(ABSPATH . $svg);
	    print '</div>';
	   endif;
	endif; 
}
function svg_options_embed($field){
	if ( get_field($field, 'options') ) :
	  $svg = get_field($field, 'options');
	  if ( strpos( $svg, '.svg' ) !== false ) :
	    $svg = str_replace( site_url(), '', $svg);
	    	echo file_get_contents(ABSPATH . $svg);
	   endif;
	endif; 
}
function svg_sub_embed($field, $class_name){
	if ( get_sub_field($field) ) :
	  $svg = get_sub_field($field);
	  if ( strpos( $svg, '.svg' ) !== false ) :
	    $svg = str_replace( site_url(), '', $svg);
	    print '<div class="wrap-svg '. $class_name .'">';
	    	echo file_get_contents(ABSPATH . $svg);
	    print '</div>';
	   endif;
	endif; 
}
function tf($value){
	the_field($value);
}
function tfo($value){
	the_field($value, 'options');
}
function tsf($value){
	the_sub_field($value);
}

// sanitize input, used for making title into a string for the roller ids inside acf
function clean($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = str_replace(' ', '', $z);
    return trim($z, '');
}

// add svgs to media uploader
function svg_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'svg_mime_types' ); 

// control svg size in image acf
function svg_size() { 
  echo '<style> 
    svg, img[src*=".svg"] { 
      max-width: 150px !important; 
      max-height: 150px !important; 
    }
  </style>'; 
}
add_action('admin_head', 'svg_size');


?>