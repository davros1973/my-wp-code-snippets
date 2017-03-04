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
  
	$github = x_squarebrackets_to_htmlentities(do_shortcode(" [github raw=$raw] "));
	$syntax = apply_filters('the_content', "[$lang title=$raw classname=\"BigCode\" light=$light ] $github [/$lang]" );
	$wrap = '<div class="MyCodeStyle MyCodeWidth MyCodeButtons"><div id="wp_colorbox_'.$colorboxID.'">'.$syntax.'</div>&nbsp;</div>';
	$start = '<p style="clear:both;">...</p><p><span style="float:right;"> ';
	$colorbox = do_shortcode($start . ' [wp_colorbox_media url="#wp_colorbox_'.$colorboxID.'" type="inline" hyperlink="" alt="CODE ZOOM"] ' . "</span><p>$wrap");
  
 	return x_htmlentities_to_squarebrackets($colorbox);
}
add_shortcode('xgithub', 'xgithub_shortcode');

// square bracket functions to prevent other shortcodes in the source file from being evaluated!
function x_squarebrackets_to_htmlentities( $input)
{
 	 $output = str_replace('[','&#091;', $input);
     $output = str_replace(']','&#093;', $output);
						   
	return $output;
}

function x_htmlentities_to_squarebrackets( $input)
{
 	 $output = str_replace('&amp;#091;','[', $input);
     $output = str_replace('&amp;#093;',']', $output);
						   
	return $output;
}
