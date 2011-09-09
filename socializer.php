<?php

/*
Plugin Name: Socializer!
Version: 2.5
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Socializer! is a Wordpress plugin that submits posts and pages to the top social networks, including Facebook (both share and like are supported), sends them by eMail and promotes them with Google plus. Check the <a href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Home Page of Socializer!</a> for more details and information on manual use.
Author: TheFreeWindows
Author URI: http://www.thefreewindows.com
*/

add_option('tfw_sposts', TRUE);	
add_option('tfw_spages', TRUE);	

function tfw_add_option_pages() {
	if (function_exists('add_options_page')) {
		add_options_page('Socializer!', 'Socializer!', 8, socializer.php, 'tfw_options_page');
	}		
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

	<h2 style="color:green;">Socializer! Nice and Easy Sharing</h2>

<img src="">

<p>To get detailed information visit <a href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Socializer's home page at TheFreeWindows</a></p>
<p>You may also like to <a href="http://www.thefreewindows.com/all-of-thefreewindows-own-utilities/" target="_blank">check for more free stuff and perhaps buy me a coffee!</a></p>

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
	</fieldset>

	<div class="submit">
		<input type="submit" name="info_update" value="<?php _e('Update options'); ?> &raquo;" />
	</div>
	</form>

<br>

<div style="padding: 30px 20px 0 25px">

<strong>Manual Use</strong>
<br><br>
When you write a page or post and make references to some other post or page, you can also create manually share-links. Just copy the address of the Socializer's Control Panel:
<br><br><span style="color:green;">
 &nbsp; http://www.topfreeware.org/socializer.asp?docurl=<b>URL</b>&doctitle=<b>TITLE</b>&nbsp; 
<br><br></span>
replacing URL with the address of the page you'd like to share, and TITLE with its title. 
<hr size="1">
Here is, for example, how your html code would be, if you were to manually create in some page a <b><a href="http://www.topfreeware.org/socializer.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your Wordpress posts and pages" target="_blank">Share Socializer!</a></b> link, to submit with Socializer the home page of Socializer itself:
<br><br>

<span style="font-family:courier;">&lt;a href=&quot;http://www.topfreeware.org/socializer.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&amp;doctitle=Download Socializer! to share easily your Wordpress posts and pages&quot; target=&quot;_blank&quot;&gt;Share Socializer!&lt;/a&gt;</span>

<br><br>
	</div>	

	</div><?php
}

function tfw_generate($content) {	

	$tfw_sposts = get_option('tfw_sposts');
	$tfw_spages = get_option('tfw_spages');	

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
	
if ( !defined('WP_CONTENT_URL') )
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
 
$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

	$the_social = $the_social."<a style='border:none;' href='http://www.topfreeware.org/socializer.asp?docurl=".get_permalink()."&doctitle=".get_the_title('')."' target='_blank'><img src='".$socpath."scl.gif' alt='Share it!' style='background:white;border:none;padding:0;margin:8pt;-moz-border-radius: 8px;border-radius: 8px;'></a>";

		$content .= $the_social;

	return $content;

}

add_filter('the_content', 'tfw_generate');
add_action('admin_menu', 'tfw_add_option_pages');

?>