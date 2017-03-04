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
	$syntax = apply_filters('the_content', "[$lang title=$raw classname=\"xarta-big-code\" light=$light ] $github [/$lang]" );
	$wrap = '<div class="xarta-code-style xarta-code-width xarta-code-buttons"><div id="wp_colorbox_'.$colorboxID.'">'.$syntax.'</div>&nbsp;</div>';
	$start = '<p style="clear:both;">...</p><p><span style="float:right;"> ';
	$colorbox = do_shortcode($start . ' [wp_colorbox_media url="#wp_colorbox_'.$colorboxID.'" type="inline" hyperlink="" alt="CODE ZOOM"] ' . "</span><p>$wrap");
  
 	return x_htmlentities_to_squarebrackets($colorbox);
}
add_shortcode('xgithub', 'xgithub_shortcode');

// square bracket functions to prevent other shortcodes in the source file from being evaluated!
function x_squarebrackets_to_htmlentities( $input)
{
	$guid1 = 'f4cd1bfaa3fa49b28'.'984c326ab9b36d9';
  	$guid2 = '984c326ab9b36d9'.'f4cd1bfaa3fa49b28';
	$step1 = str_replace('[',$guid1, $input);
	$step2 = str_replace(']',$guid2, $step1);
						   
	return $step2;
}

function x_htmlentities_to_squarebrackets( $step2)
{
  	$guid1 = 'f4cd1bfaa3fa49b28'.'984c326ab9b36d9';
	$guid2 = '984c326ab9b36d9'.'f4cd1bfaa3fa49b28';
 	$step3 = str_replace($guid1,'[', $step2);
	$step4 = str_replace($guid2,']', $step3);
  
	return $step4;
}
