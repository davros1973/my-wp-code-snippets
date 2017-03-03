function xpostcontent_shortcode( $atts ) {
   extract( shortcode_atts( array(
      'my_slug' => 'my_slug'
      ), $atts ) );
  
	$args = array( 
	  'name'           => $my_slug,
	  'post_type'      => 'post',
	  'post_status'    => 'publish',
	  'posts_per_page' => 1
	);
	$searchposts = get_posts( $args );
    $foundpost = get_post($searchposts[0]->ID);

	return apply_filters('the_content', $foundpost->post_content );
}
add_shortcode('xpostcontent', 'xpostcontent_shortcode');
