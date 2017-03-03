function github_shortcode( $atts ) {
    extract( shortcode_atts( array(
    'raw' => 'raw'
     ), $atts ) );
     $raw = "https://raw.githubusercontent.com/davros1973/$raw";
     return fix_reference_issue(file_get_contents($raw));
 }
 add_shortcode('github', 'github_shortcode');
 function fix_reference_issue($input) {
     if (strpos($input,'/// <reference',0)===0) {
     return preg_replace('/^\/\/\/ <reference.+" \/>/', "/* Dave has auto-removed visual studio code typings reference \n   as it upsets syntax highlighter evolved */ ", $input); }
     else {
     return $input; } 
 }
