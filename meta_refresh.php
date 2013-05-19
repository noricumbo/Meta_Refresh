<?php
/**
 * @package Meta_Refresh
 * @version 1.0
 */
/*
Plugin Name: Meta Refresh
Plugin URI: https://github.com/noricumbo/Meta_Refresh
Description: Adds a refresh meta tag with a date function for refresh faster on weekends, if you need. <strong>Hecho por Los Maquiladores.</strong>
Author: Jorge Noricumbo (Hacemos Código)
Version: 1.0
Author URI: http://jorge.noricumbo.com
*/
add_action('wp_head', 'meta_refresh');
function meta_refresh() {
	$day = date('N');

	if( $day > 5) : 
		$seconds = '300'; 
	else: 
		$seconds = '120'; 
	endif;

	echo "<meta http-equiv=\"refresh\" content=\"$seconds\" day=\"$day\" />\r\n";
}
?>