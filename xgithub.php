function xgithub_shortcode( $atts ) 
{
    // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	
    extract( shortcode_atts( array(
		'raw' => 'my-wp-code-snippets/master/default.php',
	    	'lang' => 'code',
		'light' => '1'
	), $atts ) );
	$raw = "https://raw.githubusercontent.com/davros1973/$raw";
	$colorboxID = trim(strval(uniqid()));
  
	$github = do_shortcode(" [github raw=$raw] ");
	$syntax = apply_filters('the_content', "[$lang title=$raw classname=\"BigCode\" light=\"1\"] $github [/$lang]" );
	$wrap = '<div class="MyCodeStyle MyCodeWidth MyCodeButtons"><div id="wp_colorbox_'.$colorboxID.'">'.$syntax.'</div>&nbsp;</div>';
	$start = '<p style="clear:both;">...</p><p><span style="float:right;"> ';
	$colorbox = do_shortcode($start . ' [wp_colorbox_media url="#wp_colorbox_'.$colorboxID.'" type="inline" hyperlink="" alt="CODE ZOOM"] ' . "</span><p>$wrap");
  
 	return $colorbox;
}
add_shortcode('xgithub', 'xgithub_shortcode');
