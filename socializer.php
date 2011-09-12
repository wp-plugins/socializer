<?php
/*
Plugin Name: Socializer!
Version: 4.0
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Socializer! is a free and light plugin that will let your posts and pages be shared at the top social networks, including Facebook (both share and like are supported), by eMail recommendations and Google plus suggestions. Check the <a href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Home Page of Socializer!</a> for details and/or technical support. If you like Socializer!, <a href="http://www.topfreeware.org/socializer.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages" target="_blank">share it with your friends</a>, and <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8LEU4AZ8DWET2" target="_blank">buy me a coffee!</a>
Author: TheFreeWindows
Author URI: http://www.thefreewindows.com
*/
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( !defined('WP_CONTENT_URL') )
    		define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
 
	$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

add_option('tfw_sposts', TRUE);	
add_option('tfw_spages', TRUE);	
add_option('tfw_spbe', TRUE);	
add_option('tfw_spaf', TRUE);	
add_option('tfw_stl', 'background:white;border:none;margin:8pt;');
add_option('tfw_stlw', 'background:white;border:none;margin:8pt;');
add_option('tfw_cimg', ''.$socpath.'scl.gif');
add_option('tfw_cimgw', ''.$socpath.'scl-sm.gif');

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
		update_option('tfw_spbe', (bool)$_POST["tfw_spbe"]);
		update_option('tfw_spaf', (bool)$_POST["tfw_spaf"]);
		update_option('tfw_stl', '' . (string)$_POST["tfw_stl"] . '');
		update_option('tfw_stlw', '' . (string)$_POST["tfw_stlw"] . '');
		update_option('tfw_cimg', '' . (string)$_POST["tfw_cimg"] . '');
		update_option('tfw_cimgw', '' . (string)$_POST["tfw_cimgw"] . '');
					
		echo "Configuration Updated!";

	    ?></strong></p></div><?php

	} ?>

	<div class="wrap" style="font-size:11pt;background:#fcfcfc;padding:0 10pt 10pt 20pt;-moz-box-shadow: 0px 0px 5px #c0c0c0;-webkit-box-shadow: 0px 0px 5px #c0c0c0;box-shadow: 0px 0px 5px #c0c0c0;-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=1, Direction=109, Color='#c0c0c0')";filter: progid:DXImageTransform.Microsoft.Shadow(Strength=1, Direction=109, Color='#c0c0c0');">

<h1 style="padding:30px 10px 1px 5px;font-size:25pt;font-weight:normal;"><span style="letter-spacing:5px;">Socializer! </span> &nbsp; <img src="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>" alt="Current Socializer! Button"></h1>

<p onmouseover="this.style.backgroundColor='#f4f4f4';return true;" onmouseout="this.style.backgroundColor='#fdfdfd';return true;" style="font-size:14pt;padding:10px;border:1px dotted silver;letter-spacing:2px;margin-right:200px;cursor:hand;cursor:pointer;" onClick="window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8LEU4AZ8DWET2');return false"><a style="color:#2b95ff;text-decoration:none;border:none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8LEU4AZ8DWET2" target="_blank"><img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>bmc.gif" style="padding:15px;border:none;" alt="Buy me a coffee!" align="middle"> Buy me a coffee (I won't say no!)</a></p>

<br>

	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
	<input type="hidden" name="info_update" id="info_update" value="true" />

	<fieldset class="options"> 
	<legend style="font-size:15pt;"> &nbsp; Options</legend>

	<div style="padding: 40px 0 0 30px">
		<input type="checkbox" name="tfw_sposts" value="checkbox" <?php if (get_option('tfw_sposts')) echo "checked='checked'"; ?>/> &nbsp; Display on posts
</div>

	<div style="padding: 20px 0 0 30px">
		<input type="checkbox" name="tfw_spages" value="checkbox" <?php if (get_option('tfw_spages')) echo "checked='checked'"; ?>/> &nbsp; Display on static pages
	</div>

	<div style="padding: 30px 0 0 30px;">
		<input type="checkbox" name="tfw_spbe" value="checkbox" <?php if (get_option('tfw_spbe')) echo "checked='checked'"; ?>/> &nbsp; Display at the top
</div>

	<div style="padding: 20px 0 0 30px">
		<input type="checkbox" name="tfw_spaf" value="checkbox" <?php if (get_option('tfw_spaf')) echo "checked='checked'"; ?>/> &nbsp; Display at the bottom
	</div>

<div style="padding: 40px 20px 0 30px">		

<div style="font-size:12pt;font-weight:bold;border-top:1px solid silver;padding:12px 0 0 0;width:422px;">
Customize the Buttons (if you need to)
</div>
<br>
Removal of the white background will give you a transparent button. This is <b>not</b> good if the background of your pages is dark.

<br>
<br>
<span style="letter-spacing:3px;">Style of the Content Button</span> &mdash; Default is <b>background:white;border:none;margin:8pt;</b>
<br>
<br>
<input type="text" style="margin-left:22px;font-size:11pt;width:80%;" name="tfw_stl" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stl'))) ?>">

<br>
<br>
<span style="letter-spacing:3px;">Style of the Widget Button</span> &mdash; Default is <b>background:white;border:none;margin:8pt;</b>
<br>
<br>
<input type="text" style="margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlw" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlw'))) ?>">
<br>
<br>
 &nbsp; &nbsp; You may prefer to include in your style sheet the <b>Socializer</b> and <b>SocializerW</b> ID css tags for the content and the widget buttons respectively, in which case take care to clear any style elements here that might cause a conflict with your style sheet definitions.
<br>
<p align="center">* * *</p>
<br>
 &nbsp; &nbsp; Would you like to use completely different buttons of your own? Upload them to your server in whatever location, and paste here their addresses to replace the default. You can have the same or different buttons for sidebar and content. Since it is not unusual for Wordpress sidebars to be narrow, I thought it would make sense to offer an optional smaller button for the widget.
<br>
<br>
<span style="padding:3pt;letter-spacing:3px;">Content Button URL</span> &mdash; Default is<b> <?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl.gif </b>
<br>
<p><img src="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>" alt="Current Content Button"></p>

<input type="text" style="margin-left:22px;font-size:11pt;width:80%;" name="tfw_cimg" value="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>">

<br>
<br>

<span style="padding:3pt;letter-spacing:3px;">Widget Button URL</span> &mdash; Default is<b> <?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-sm.gif </b>
<br>
<p><img src="<?php echo htmlspecialchars(get_option('tfw_cimgw')) ?>" alt="Current Widget Button"></p>

<input type="text" style="margin-left:22px;font-size:11pt;width:80%;" name="tfw_cimgw" value="<?php echo htmlspecialchars(get_option('tfw_cimgw')) ?>">

	</div>

	</fieldset>

	<div class="submit" style="background:#ececec;padding:7pt;margin:32px 42px 32px 22px;-moz-border-radius: 17px;border-radius: 17px;">
		<input type="submit" name="info_update" value="<?php _e(' Update the Options '); ?>" />
	</div>
	</form>

<div style="padding: 10px 20px 0 45px">

 &nbsp;&nbsp;  &raquo; <strong><a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Instructions for Manual Use</a></strong> &mdash; to create occasional share-links
<br>
<br>
<br>
<div onmouseover="this.style.backgroundColor='#f4f4f4';return true;" onmouseout="this.style.backgroundColor='#fdfdfd';return true;" style="padding:10px;border:1px dotted silver;font-size:14pt;letter-spacing:2px;margin-right:250px;cursor:hand;cursor:pointer;" onClick="window.open('http://www.topfreeware.org/socializer.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages');return false">
  If you like Socializer! <strong><a style="color:#2b95ff;text-decoration:none;letter-spacing:7px;" href="http://www.topfreeware.org/socializer.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages" target="_blank">Share it!</a></strong></div>
<br>
<div style="padding:1px 0 0 0;letter-spacing:2px;"> &nbsp; &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Socializer! Home Page</a> at <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/" target="_blank">TheFreeWindows</a> &copy;</div>
<br>
<div style="padding:1px 0 0 0;letter-spacing:2px;"> &nbsp; &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/all-of-thefreewindows-own-utilities/" target="_blank">Check for more free stuff</a></div>
<br>
<br>
<br>
<p style="font-size:14pt;">&nbsp; &nbsp; &nbsp; &nbsp; Enjoy!</p>
<br>
	</div>	
	</div><?php
}

function tfw_generate($content) {	

	$tfw_sposts = get_option('tfw_sposts');
	$tfw_spages = get_option('tfw_spages');	
	$tfw_spbe = get_option('tfw_spbe');
	$tfw_spaf = get_option('tfw_spaf');	
	$tfw_stl = get_option('tfw_stl');
	$tfw_stlw = get_option('tfw_stlw');
	$tfw_cimg = get_option('tfw_cimg');
	$tfw_cimgw = get_option('tfw_cimgw');

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

 	$remsp = array("'","\"");  
	$trm = str_replace($remsp, " ", $tfw_stl);
	$the_social_stl = stripslashes($trm);
	$imad = str_replace($remsp, " ", $tfw_cimg);

	$the_social = $the_social."<a style='border:none;' href='http://www.topfreeware.org/socializer.asp?docurl=".get_permalink()."&doctitle=".get_the_title('')."' target='_blank'><img id='Socializer' src='".$imad."' alt='Share it!' style='padding:0;-moz-border-radius: 8px;border-radius: 8px;".$the_social_stl.";'></a>";

	if ($tfw_spaf && $show_socializer) 
		$content .= $the_social;

	if ($tfw_spbe && $show_socializer) 
		$content = $the_social.$content;

	return $content;

}

class SocializerWidget extends WP_Widget {

    function SocializerWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Socializer! Widget'));
        $this->WP_Widget('SocializerWidget', __('Socializer!'), $widget_ops);
    }

    function widget() {

	$tfw_stlw = get_option('tfw_stlw');
	$tfw_cimgw = get_option('tfw_cimgw');
 	$remspw = array("'","\"");  
	$trmw = str_replace($remspw, " ", $tfw_stlw);
	$imadw = str_replace($remspw, " ", $tfw_cimgw);
	$the_social_stlw = stripslashes($trmw);
?>

<a style='border:none;' href='http://www.topfreeware.org/socializer.asp?docurl=http://<?php echo $_SERVER["HTTP_HOST"] ?><?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); ?>&doctitle=<?php wp_title(''); ?> <?php if ( is_home() ) { bloginfo('name'); } ?>' target='_blank'><img id='SocializerW' src='<?=$imadw ?>' alt='Share it!' style='padding:0;-moz-border-radius: 8px;border-radius: 8px;<?=$the_social_stlw ?>;'></a>
        
<?php
    }
}

function SocializerWidgetInit() {
    register_widget('SocializerWidget');
}

add_filter('the_content', 'tfw_generate');
add_action('admin_menu', 'tfw_add_option_pages');
add_action('widgets_init', 'SocializerWidgetInit');

?>