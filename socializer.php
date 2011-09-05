<?php

/*
Plugin Name: Socializer!
Version: 1.0.1
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Socializer is a plugin for  Wordpress that takes advantage of TheFreeWindows' sharing facility to submit posts and pages to the top social bookmarking sites including Facebook (both share and like), even to send them by email and promote them with Google plus.
Author: TheFreeWindows
Author URI: http://www.thefreewindows.com
*/

add_option('tfw_sposts', TRUE);	// Show on posts
add_option('tfw_spages', TRUE);	// Show on pages



function tfw_add_option_pages() {
	if (function_exists('add_options_page')) {
		add_options_page('Socializer', 'Socializer!', 8, __FILE__, 'tfw_options_page');
	}		
}

function tfw_trim_sig($socializer) {
	return trim($socializer, "*");
}


function tfw_options_page() {

	if (isset($_POST['info_update'])) {

		?><div id="message" class="updated fade"><p><strong><?php 

		update_option('tfw_sposts', (bool)$_POST["tfw_sposts"]);
		update_option('tfw_spages', (bool)$_POST["tfw_spages"]);

			
		echo "Configuration Updated!";

	    ?></strong></p></div><?php

	} ?>

	<div class=wrap>

	<h2>Socializer! - The Easy Plugin to Share your Posts</h2>

	<p>To check for new versions or get more information, visit <a href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">the plugin's page at TheFreeWindows</a><br>You may also like to <a href="http://www.thefreewindows.com/all-of-thefreewindows-own-utilities/" target="_blank">check for more free stuff and buy me a coffee!</a></p>

<br><br>

	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
	<input type="hidden" name="info_update" id="info_update" value="true" />



	<fieldset class="options"> 
	<legend>Options</legend>

	<div style="padding: 20px 0 0 30px">
		<input type="checkbox" name="tfw_sposts" value="checkbox" <?php if (get_option('tfw_sposts')) echo "checked='checked'"; ?>/>&nbsp;&nbsp;
		<strong>Display on posts</strong>
	</div>

	<div style="padding: 20px 0 0 30px">
		<input type="checkbox" name="tfw_spages" value="checkbox" <?php if (get_option('tfw_spages')) echo "checked='checked'"; ?>/>&nbsp;&nbsp;
		<strong>Display on static pages</strong>
	</div>

<br>

<div style="padding: 30px 0 0 50px">

<strong>Manual Use</strong>
<br><br>
You can also manually add share-links for other posts or pages while you write a post.<br>Just copy and paste the address of the Socializer's Control Panel 
<br><br>
 &nbsp; http://www.topfreeware.org/socializer.asp?docurl=<b>URL</b>&doctitle=<b>TITLE</b>&nbsp; 
<br><br>
replacing URL with the address of the page you'd like to share, and TITLE with its title.
<br><br>
	</div>	

	</fieldset>

	<div class="submit">
		<input type="submit" name="info_update" value="<?php _e('Update options'); ?> &raquo;" />
	</div>
	</form>
	</div><?php
}



function tfw_generate($content) {

	// Load options

	$tfw_sposts = get_option('tfw_sposts');
	$tfw_spages = get_option('tfw_spages');

	// Check page type

	$show_socializer = FALSE;


	if (is_single() && $tfw_sposts) {
		$show_socializer = TRUE;
	}

	if (is_page() && $tfw_spages) {
		$show_socializer = TRUE;
	}
	
	
	if (!$show_socializer) {
		return $content;
	}


	// Process button
if ( !defined('WP_CONTENT_URL') )
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
 
$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

	$the_social = $the_social."<a style='border:none;' href='http://www.topfreeware.org/socializer.asp?docurl=".get_permalink()."&doctitle=".get_the_title('')."' target='_blank'><img src='".$socpath."/shenjoy.gif' alt='Share it!' style='background:white;border:none;padding:0;margin:8pt;-moz-border-radius: 8px;border-radius: 8px;'></a>";



	// Look for trigger


		$content .= $the_social;

	return $content;

}


add_filter('the_content', 'tfw_generate');
add_action('admin_menu', 'tfw_add_option_pages');

?>