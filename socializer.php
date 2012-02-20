<?php
/*
Plugin Name: Socializer!
Version: 5.0
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Socializer! is a free and light plugin to have your posts shared on more than 30 top social networks, including Facebook ("share", "like" and "send" are supported) and Twitter, have them promoted in Google Plus, recommended by eMail, even let your visitors translate them to a different language. Check the <a href="http://www.socializer.info/" target="_blank">Home Page of Socializer!</a> for more information and technical support.
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
add_option('tfw_spbe', FALSE);	
add_option('tfw_spaf', TRUE);	
add_option('tfw_sindarch', TRUE);	
add_option('tfw_stl', 'background:white;border:none;margin:8pt;');
add_option('tfw_stlw', 'background:white;border:none;margin:8pt;');
add_option('tfw_stldiv', 'text-align:left;');
add_option('tfw_stlwdiv', 'text-align:left;');
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
		update_option('tfw_sindarch', (bool)$_POST["tfw_sindarch"]);
		update_option('tfw_stl', '' . (string)$_POST["tfw_stl"] . '');
		update_option('tfw_stlw', '' . (string)$_POST["tfw_stlw"] . '');
		update_option('tfw_stldiv', '' . (string)$_POST["tfw_stldiv"] . '');
		update_option('tfw_stlwdiv', '' . (string)$_POST["tfw_stlwdiv"] . '');
		update_option('tfw_cimg', '' . (string)$_POST["tfw_cimg"] . '');
		update_option('tfw_cimgw', '' . (string)$_POST["tfw_cimgw"] . '');
					
		echo "Configuration Updated!";

	    ?></strong></p></div><?php

	} ?>

	<div class="wrap" style="font-size:11pt;padding:0 10pt 10pt 5pt;background:white;">

<h1 style="padding:1px 0 5px 0;">
<a style="border:none;border:0;text-decoration:none;" href="http://www.socializer.info/" target="_blank"><img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>sclog.gif" style="border:none;border:0;" alt="Home of Socializer!"></a>
<br>
  &nbsp;  <a style="text-decoration:none;border:none;border:0;" href="http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages" target="_blank"><img style="padding:10px 0 0 150px;border:none;border:0;" src="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>" alt="Socialize the Socializer!"></a></h1>


<hr style="width:700px;color:#dfdfdf;margin-bottom:25px;" size="1" align="left">

	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
	<input type="hidden" name="info_update" id="info_update" value="true" />


	<fieldset class="options"> 
	<legend style="font-size:14pt;letter-spacing:3px;"> &nbsp; Options</legend>

	<div style="padding: 40px 0 10px 30px">
		<label><input type="checkbox" name="tfw_sposts" value="checkbox" <?php if (get_option('tfw_sposts')) echo "checked='checked'"; ?>/> &nbsp; Display on posts</label>

 &nbsp;  &nbsp;  &nbsp; 

		<label><input type="checkbox" name="tfw_spages" value="checkbox" <?php if (get_option('tfw_spages')) echo "checked='checked'"; ?>/> &nbsp; Display on static pages</label>

</div>


	<div style="padding: 20px 0 0 30px">
		<label><input type="checkbox" name="tfw_sindarch" value="checkbox" <?php if (get_option('tfw_sindarch')) echo "checked='checked'"; ?>/> &nbsp; Display on Archives &nbsp;<span style="color:grey;">( Home / Index, Categories, Tags, Dates )</span></label>
	</div>


<div style="line-height:160%;padding: 45px 0 0 30px">
<b>Main position</b> - valid in single Post / Page <b>and</b> in Archive / Index view

</div>




	<div style="padding: 30px 0 0 30px;">
		<label><input type="checkbox" name="tfw_spbe" value="checkbox" <?php if (get_option('tfw_spbe')) echo "checked='checked'"; ?>/> &nbsp; Display at the top of content</label>

 &nbsp;  &nbsp;  &nbsp; 

		<label><input type="checkbox" name="tfw_spaf" value="checkbox" <?php if (get_option('tfw_spaf')) echo "checked='checked'"; ?>/> &nbsp; Display at the bottom of content</label>

</div>



<div class="submit" style="padding:7pt;margin:32px 42px 30px 22px;-moz-border-radius: 17px;border-radius: 17px;">
		<input type="submit" name="info_update" value="<?php _e(' Update the options now'); ?>" /> &nbsp; <span style="color:grey;">or configure more options below</span>
	</div>


<div onmouseover="this.style.backgroundColor='#f4f4f4';return true;" onmouseout="this.style.backgroundColor='#fdfdfd';return true;" style="padding:10px;border:1px dotted silver;font-size:14pt;letter-spacing:2px;margin-right:250px;cursor:hand;cursor:pointer;" onClick="window.open('http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages');return false">
  If you like Socializer! <strong><a style="color:#2b95ff;text-decoration:none;letter-spacing:7px;" href="http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages" target="_blank">Share it!</a></strong></div>


<div style="padding: 30px 20px 0 30px">		

<div style="font-weight:bold;padding:12px 0 0 0;width:422px;">
Customize the Buttons &nbsp;<span style="color:grey;font-weight:normal;">( if you need to )</span>
</div>
<br>
Removal of the white background will give you a transparent button. This is <b>not</b> good if the background of your pages is dark.
<br>
<br>
<br>
<b>Content Button</b>
<br>
<br>
<span style="letter-spacing:3px;">Style</span> ( default is <span style="color:grey;">background:white;border:none;margin:8pt;</span> )
<br>
<br>
<input type="text" style="color:grey;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stl" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stl'))) ?>">

<br>
<br>

<span style="letter-spacing:3px;">Div Style</span> ( default is <span style="color:grey;">text-align:left;</span> &mdash; the button is aligned to the left )
<br>
<br>
<input type="text" style="color:grey;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stldiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stldiv'))) ?>">

<br>
<br>
<br>

<b>Widget Button</b> &nbsp;<span style="color:grey;">( To activate the Widget go to <a href="widgets.php" target="_blank" style="text-decoration:none;">Appearance / Widgets</a> )</span>
<br><br>
<span style="letter-spacing:3px;">Style</span> ( default is <span style="color:grey;">background:white;border:none;margin:8pt;</span> )
<br>
<br>
<input type="text" style="color:grey;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlw" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlw'))) ?>">
<br>
<br>
<span style="letter-spacing:3px;">Div Style</span> ( default is <span style="color:grey;">text-align:left;</span> &mdash; the button is aligned to the left )
<br>
<br>
<input type="text" style="color:grey;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlwdiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlwdiv'))) ?>">
<br>
<br>
<br>
 &nbsp; &nbsp; You may prefer to include in your style sheet the <b>Socializer</b> and <b>SocializerW</b> css ID tags for the content and the widget buttons respectively, in which case take care to clear any style elements here that might cause a conflict with your style sheet definitions.
<br><br>
<p align="center">* * *</p>
<br>
 &nbsp; &nbsp; Would you like to use completely different buttons of your own? Upload them to your server in whatever location, and paste here their addresses to replace the default ones. You can have the same or different buttons for sidebar and content. Since it is not unusual for Wordpress sidebars to be narrow, I thought it would make sense to offer an optional smaller button for the widget.
<br>
<br>



<span style="padding:3pt;letter-spacing:3px;">Replace the Content Button</span> ( default is <span style="color:grey;"><?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl.gif</span> )
<br>
<p><img src="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>" alt="Current Content Button"></p>

<input type="text" style="color:grey;margin-left:22px;font-size:11pt;width:80%;" name="tfw_cimg" value="<?php echo htmlspecialchars(get_option('tfw_cimg')) ?>">

<br>
<br>

<span style="padding:3pt;letter-spacing:3px;">Replace the Widget Button</span> ( default is <span style="color:grey;"> <?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>scl-sm.gif </span>)
<br>
<p><img src="<?php echo htmlspecialchars(get_option('tfw_cimgw')) ?>" alt="Current Widget Button"></p>

<input type="text" style="color:grey;margin-left:22px;font-size:11pt;width:80%;" name="tfw_cimgw" value="<?php echo htmlspecialchars(get_option('tfw_cimgw')) ?>">

	</div>

	</fieldset>

	<div class="submit" style="background:#ececec;padding:7pt;margin:32px 42px 32px 22px;-moz-border-radius: 17px;border-radius: 17px;">
		<input type="submit" name="info_update" value="<?php _e(' Update the Options '); ?>" />
	</div>
	</form>

<div style="padding: 10px 20px 0 45px">

 &nbsp;&nbsp;  &raquo; <strong><a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Instructions for Manual Use</a></strong> &mdash; to create occasional share-links

 &nbsp; &nbsp; &raquo; <strong><a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/6035/socializer-wordpress-frequent-questions-answers/" target="_blank">FQA</a></strong> &mdash; read answers, ask questions
<br>
<br>

<div onmouseover="this.style.backgroundColor='#f4f4f4';return true;" onmouseout="this.style.backgroundColor='#fdfdfd';return true;" style="padding:10px;border:1px dotted silver;font-size:14pt;letter-spacing:2px;margin-right:250px;cursor:hand;cursor:pointer;" onClick="window.open('http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages');return false">
  If you like Socializer! <strong><a style="color:#2b95ff;text-decoration:none;letter-spacing:7px;" href="http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Download Socializer! to share easily your web pages" target="_blank">Share it!</a></strong></div>
<br>

<div style="padding:1px 0 0 0;letter-spacing:2px;"> &nbsp; &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.socializer.info/" target="_blank">Socializer! Home</a> & <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Plugin Page at TheFreeWindows</a> &copy;</div>
<br>

<div style="padding:1px 0 0 20px;letter-spacing:2px;"> &nbsp; &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/all-of-thefreewindows-own-utilities/" target="_blank">Check for more free stuff</a> 
 &nbsp; &raquo; 
<a style="color:#2b95ff;text-decoration:none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8LEU4AZ8DWET2" target="_blank">Buy me a coffee!</a>
</div>

<br>

<p style="font-size:14pt;letter-spacing:3px;margin-left:180px;">Enjoy!</p>
<hr style="width:700px;color:#dfdfdf;margin-bottom:25px;" size="1" align="left">
<br>

<div align="center" style="text-align:center;"> &nbsp;  &nbsp;  &nbsp; <a style="color:#dfdfdf;text-decoration:none;font-weight:bold;font-size:20pt;letter-spacing:3px;" href="http://www.socializer.info/" target="_blank">www.socializer.info</a></div>
	</div>	



	</div><?php
}

function tfw_generate($content) {	

	$tfw_sposts = get_option('tfw_sposts');
	$tfw_spages = get_option('tfw_spages');	
	$tfw_spbe = get_option('tfw_spbe');
	$tfw_spaf = get_option('tfw_spaf');	
	$tfw_sindarch = get_option('tfw_sindarch');	
	$tfw_stl = get_option('tfw_stl');
	$tfw_stlw = get_option('tfw_stlw');
	$tfw_stldiv = get_option('tfw_stldiv');
	$tfw_stlwdiv = get_option('tfw_stlwdiv');
	$tfw_cimg = get_option('tfw_cimg');
	$tfw_cimgw = get_option('tfw_cimgw');

 	$remsp = array("'","\"");  
	$trm = str_replace($remsp, " ", $tfw_stl);
	$trmdiv = str_replace($remsp, " ", $tfw_stldiv);
	$the_social_stl = stripslashes($trm);
	$the_social_stldiv = stripslashes($trmdiv);
	$imad = str_replace($remsp, " ", $tfw_cimg);

	$the_social = $the_social.'<div id="Socializer" style="'.$the_social_stldiv.';"><a style="border:none;" href="http://www.socializer.info/share.asp?docurl='.get_permalink($id).'&doctitle='.get_the_title("").'" target="_blank"><img  src="'.$imad.'" alt="Share in top social networks!" style="padding:0;-moz-border-radius: 8px;border-radius: 8px;'.$the_social_stl.';"></a></div>';

	$show_socializer = FALSE;

	if (is_single() && $tfw_sposts) {
		$show_socializer = TRUE;
	}

	if (is_page() && $tfw_spages) {
		$show_socializer = TRUE;
	}	

	if (is_category() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (is_tag() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (is_date() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (is_home() && $tfw_sindarch) {
		$show_socializer = TRUE;
	}	

	if (!$show_socializer) {
		return $content;
	}

	if (is_single() && $tfw_spaf && $show_socializer) 
		$content .= $the_social;

	if (is_single() && $tfw_spbe && $show_socializer) 
		$content = $the_social.$content;

	if (is_page() && $tfw_spaf && $show_socializer) 
		$content .= $the_social;

	if (is_page() && $tfw_spbe && $show_socializer) 
		$content = $the_social.$content;

	if  ( ( is_home() || is_category() || is_tag() || is_date() ) && $tfw_spbe && $show_socializer )  
		$content = $the_social.$content;

	if ( (is_home() || is_category() || is_tag() || is_date() ) && $tfw_spaf && $show_socializer )
		$content .= $the_social;

	return $content;

}

class SocializerWidget extends WP_Widget {

    function SocializerWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Socializer! Widget'));
        $this->WP_Widget('SocializerWidget', __('Socializer!'), $widget_ops);
    }

    function widget() {

	$tfw_stlw = get_option('tfw_stlw');
	$tfw_stlwdiv = get_option('tfw_stlwdiv');
	$tfw_cimgw = get_option('tfw_cimgw');
 	$remspw = array("'","\"");  
	$trmw = str_replace($remspw, " ", $tfw_stlw);
	$trmwdiv = str_replace($remspw, " ", $tfw_stlwdiv);
	$imadw = str_replace($remspw, " ", $tfw_cimgw);
	$the_social_stlw = stripslashes($trmw);
	$the_social_stlwdiv = stripslashes($trmwdiv);
?>

<div id="SocializerW" style="<?=$the_social_stlwdiv ?>;"><a style="border:none;" href='http://www.socializer.info/share.asp?docurl=http://<?php echo $_SERVER["HTTP_HOST"] ?><?php echo parse_url($_SERVER["REQUEST_URI"],PHP_URL_PATH); ?>&doctitle=<?php wp_title(''); ?> <?php if ( is_home() ) { bloginfo("name"); } ?>' target="_blank"><img src="<?=$imadw ?>" alt="Share in top social networks!" style="padding:0;-moz-border-radius: 8px;border-radius: 8px;<?=$the_social_stlw ?>;"></a></div>
        
<?php
    }
}

function SocializerWidgetInit() {
    register_widget('SocializerWidget');
}

add_filter('the_content', 'tfw_generate', 1000);
add_action('admin_menu', 'tfw_add_option_pages');
add_action('widgets_init', 'SocializerWidgetInit');

?>