<?php
/*
Plugin Name: Socializer!
Version: 8.0
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Socializer! is a free, fast, flexible, easy and effective plugin that will help your visitors share your posts on top social networks, including Facebook, Twitter, Google Plus, by eMail, even translate them, get html links, and more! Check the <a href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Home of Socializer! for WordPress</a>.
Author: TheFreeWindows
Author URI: http://www.thefreewindows.com
*/

if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__file__) == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( !defined('WP_CONTENT_URL') )
    		define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
 
$wp_scripts = new WP_Scripts();
if (!is_admin()) {
	wp_enqueue_script("jquery");
	wp_deregister_script('facebooksdk');
	wp_register_script('facebooksdk', 'http://connect.facebook.net/en_US/all.js#xfbml=1');
	wp_enqueue_script("facebooksdk");
	wp_deregister_script('plusone');
	wp_register_script('plusone', 'https://apis.google.com/js/plusone.js');
	wp_enqueue_script("plusone");
	wp_deregister_script('twittersdk');
	wp_register_script('twittersdk', 'https://platform.twitter.com/widgets.js');
	wp_enqueue_script("twittersdk");
}


add_option('tfw_sposts', TRUE);	
add_option('tfw_spages', TRUE);	
add_option('tfw_spbe', FALSE);	
add_option('tfw_spaf', TRUE);	
add_option('tfw_sindarch', TRUE);	
add_option('tfw_stldiv', 'padding: 15px; border: none;');
add_option('tfw_stlwdiv', 'border: none; padding: 10px;');
add_option('tfw_stlfloatwdiv', 'top: 35%; left: 7px; border: 1px solid #5A75A9; border-radius: 10px; background: #E9EDFC;');

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
		update_option('tfw_stldiv', '' . (string)$_POST["tfw_stldiv"] . '');
		update_option('tfw_stlwdiv', '' . (string)$_POST["tfw_stlwdiv"] . '');
		update_option('tfw_stlfloatwdiv', '' . (string)$_POST["tfw_stlfloatwdiv"] . '');
					
		echo "Configuration Updated!";

	    ?></strong></p></div><?php

	} ?>


<div class="wrap" style="font-size:17px;padding:0 10pt 10pt 5pt;background:white;">

<h1 style="padding:15px;">

<a style="border:none;border:0;text-decoration:none;" href="http://www.socializer.info/" target="_blank"><img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>sclog.gif" style="border:none;border:0;" alt="Home of Socializer!"></a>

</h1>




<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">

	<input type="hidden" name="info_update" id="info_update" value="true" />

	<fieldset class="options"> 

	<legend style="font-size:22px;letter-spacing:7px;margin-left:5px;"> &nbsp; Options</legend>

	<div style="padding: 40px 0 10px 30px">
		
&raquo; When you finish, don't forget to save your settings (at the end of the page)



<br>&nbsp;<br>




<p style="font-size:20px;letter-spacing:4px;margin-left:5px;margin-top:32px;">Content buttons</p>

<br>&nbsp;<br>

<label><input type="checkbox" name="tfw_sposts" value="checkbox" <?php if (get_option('tfw_sposts')) echo "checked='checked'"; ?>/> &nbsp; Display on posts</label>

 &nbsp;  &nbsp;  &nbsp; 

<label><input type="checkbox" name="tfw_spages" value="checkbox" <?php if (get_option('tfw_spages')) echo "checked='checked'"; ?>/> &nbsp; Display on static pages</label>

</div>


	<div style="padding: 20px 0 0 30px">

<label><input type="checkbox" name="tfw_sindarch" value="checkbox" <?php if (get_option('tfw_sindarch')) echo "checked='checked'"; ?>/> &nbsp; Display on Archives &nbsp;<span style="color:grey;">( Home / Index, Categories, Tags, Dates )</span></label>

	</div>


<div style="line-height:160%;padding: 45px 0 0 30px;letter-spacing:2px;">


<b>Main position</b>


</div>


	<div style="padding: 30px 0 0 30px;">

<label><input type="checkbox" name="tfw_spbe" value="checkbox" <?php if (get_option('tfw_spbe')) echo "checked='checked'"; ?>/>
	 &nbsp; Display at the top of content</label>

 &nbsp;  &nbsp;  &nbsp; 

		<label><input type="checkbox" name="tfw_spaf" value="checkbox" <?php if (get_option('tfw_spaf')) echo "checked='checked'"; ?>/>
	 &nbsp; Display at the bottom of content</label>




<br>&nbsp;<br>






<p style="font-size:20px;letter-spacing:4px;margin-left:5px;margin-top:32px;">Widgets</p>

<br>&nbsp;<br>

<span style="font-size:17px;">
	
 &raquo; Activate the SIDEBAR Widget and / or the global FLOATING Widget Buttons at <a href="widgets.php" target="_blank" style="text-decoration:none;color:#2b95ff;">Appearance &gt; Widgets</a>


<br>&nbsp;<br>


&nbsp; &nbsp;Widget settings can be customized below (keep reading).</span>

</div>
<div style="padding: 20px;">
	
	
<div style="padding: 1px 0 5px 1px;background:#F7F7F7;margin-top:42px;border-left:3px solid #008BBF;margin-bottom:30px;">

<h2>&nbsp; <a style="color:grey;text-decoration:none;border:none;letter-spacing:1px;" href="http://www.socializer.info/share.asp?docurl=http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/&doctitle=Socializer! for Wordpress" target="_blank">If you like the Socializer! Click Here to Share it!</a></h2>

</div>


<br>


<span style="letter-spacing:3px;font-size:18px;">Customize further</span>


<br>&nbsp;<br>







<div style="margin:10px 0;padding:45px;box-shadow: 5px 5px 9px #DFDFDF;line-height:155%;">

<img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>screenshot-1.gif" style="border:none;border:0;margin-bottom:5px;">

<br>


										<b>CONTENT buttons</b>


<br>

<div style="margin-left:22px;margin-top:22px;">


(Default is <span style="color:grey;">
	
	padding: 15px; border: none;
	
</span> &mdash; the buttons are aligned to the left, surrounded by 15 pixels of blank space. Add <span style="color:grey;">margin:auto;</span> to put them to the center, or <span style="color:grey;">float:right;</span> to align them at the right.)

<br>&nbsp;<br>

<input type="text" style="padding:7px;color:#5A75A9;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stldiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stldiv'))) ?>">



</div>
</div>



<br>







<div style="margin:10px 0;padding:45px;box-shadow: 5px 5px 9px #DFDFDF;line-height:155%;">

<img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>screenshot-2.gif" style="border:none;border:0;margin-bottom:5px;">

<br>


							<b>SIDEBAR Widget</b> &nbsp;<span style="color:grey;">( Activate the Widget at <a href="widgets.php" target="_blank" style="text-decoration:none;color:#2b95ff;">Appearance &gt; Widgets</a> )</span>

<br>

<div style="margin-left:22px;margin-top:22px;">
	
(Default is <span style="color:grey;">
	
	border: none; padding: 10px;
	
</span> &mdash; the buttons are aligned to the left, without a global border, surrounded by 22 pixels of blank space. Add <span style="color:grey;">margin:auto;</span> to have them aligned at the center, or <span style="color:grey;">float:right;</span> to align them at the right.)
	
<br>&nbsp;<br>

<input type="text" style="padding:7px;color:#5A75A9;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlwdiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlwdiv'))) ?>">


</div>
</div>

<br>





<div style="margin:10px 0;padding:45px;box-shadow: 5px 5px 9px #DFDFDF;line-height:155%;">

<table><tr><td>
<img src="<?=WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/'?>screenshot-3.gif" style="border:none;border:0;margin-bottom:5px;">
</td>
<td>
<div style="margin-left:22px;margin-top:22px;line-height:170%;">


							<b>FLOAT Widget</b> &nbsp;<span style="color:grey;">( Activate the Socializer! Float Widget at <a href="widgets.php" target="_blank" style="text-decoration:none;color:#2b95ff;">Appearance &gt; Widgets</a> )</span>


<br>&nbsp;<br>

(Default is <span style="color:grey;">
	
	top: 35%; left: 7px; border: 1px solid #5A75A9; border-radius: 10px; background: #E9EDFC;
	
	</span><br>&mdash; the buttons are aligned 7 pixels from the left side of the browser, in a 35% distance from the top of the browser, having a border and a slightly blue / purple background) 
	
<br>&nbsp;<br>

Change <span style="color:grey;">left</span> to <span style="color:grey;">right</span>, to put the widget to the right side of the browser, change <span style="color:grey;">35%</span> to a distance you may prefer better, etc. Deleting the background and border properties, will leave the social buttons floating above the global background of your pages. To activate the FLOATING widget, drop it anywhere in the Sidebar; its real position is configured right here.

<br>&nbsp;<br>

<input type="text" style="padding:7px;color:#5A75A9;margin-left:22px;font-size:11pt;width:80%;" name="tfw_stlfloatwdiv" value="<?php echo htmlspecialchars(stripslashes(get_option('tfw_stlfloatwdiv'))) ?>">

</div>

</td></tr></table>

</div>



<p style="font-size:17px;margin-top:53px;margin-left:8px;">
  // To fine tune and experiment with adjustments from your main style sheet, define a <b>Socializer</b>, <b>SocializerW</b>, and a <b>SocializerFloatW</b> css ID (#) tag for the content button, the sidebar widget, and float widget respectively //
</p>
 

	</div>

	</fieldset>

<br>





<div class="submit" style="background:#ececec;padding:7pt;margin:32px 42px 32px 22px;-moz-border-radius: 17px;border-radius: 17px;">

<input style="cursor:pointer;letter-spacing:7px;color:#2b95ff;-moz-border-radius: 17px;border-radius: 17px;border:1px solid white;background:white;padding:5px 19px;font-size:18px;" type="submit" name="info_update" value="<?php _e(' Save your settings '); ?>" />

</div>
</form>



<div style="padding: 10px 20px 0 45px">

 &nbsp;&nbsp;  &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/11487/incorporating-socializer-web-scripts-software-creating-manual-sharelinks/" target="_blank">Instructions for Manual Use</a> &mdash; to create occasional share-links or incorporate Socializer! in your own scripts or software.
<br>&nbsp;<br>
 &nbsp;&nbsp;  &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/6035/socializer-wordpress-frequent-questions-answers/" target="_blank">FQA</a> &mdash; read answers, ask questions

 &nbsp;&nbsp;  &raquo; <a style="color:#2b95ff;text-decoration:none;" href="http://www.socializer.info/" target="_blank">Socializer! Home</a> & <a style="color:#2b95ff;text-decoration:none;" href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Plugin Page</a>

<br>&nbsp;<br>
 &nbsp;&nbsp;  &raquo; Check the free <a style="color:#2b95ff;text-decoration:none;letter-spacing:1px;" href="http://www.thefreewindows.com/15816/reveal-posts-visitors-share-social-networks/" target="_blank">Social Share Motivator</a> plugin for a more &#900;aggresive&#900; promotion of your blog

<br>&nbsp;<br>
 &nbsp;&nbsp;  &raquo; Are you perhaps in a <a style="color:#2b95ff;text-decoration:none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8LEU4AZ8DWET2" target="_blank">donation</a> mood?



<br>&nbsp;<br>

<br>&nbsp;<br>


<div align="center" style="text-align:center;margin-top:30px;"> &nbsp;  &nbsp;  &nbsp; <a style="color:silver;text-decoration:none;font-weight:bold;font-size:20pt;letter-spacing:3px;" href="http://www.socializer.info/" target="_blank">www.socializer.info</a></div>

</div>	



</div>

<?php
}


function tfw_generate($content) {	

	$tfw_sposts = get_option('tfw_sposts');
	$tfw_spages = get_option('tfw_spages');	
	$tfw_spbe = get_option('tfw_spbe');
	$tfw_spaf = get_option('tfw_spaf');	
	$tfw_sindarch = get_option('tfw_sindarch');	
	$tfw_stldiv = get_option('tfw_stldiv');
	$tfw_stlwdiv = get_option('tfw_stlwdiv');
	$tfw_stlfloatwdiv = get_option('tfw_stlfloatwdiv');

 	$remsp = array("'","\"");  
	$trmdiv = str_replace($remsp, " ", $tfw_stldiv);
	$the_social_stldiv = stripslashes($trmdiv);
	$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';

	$the_social = $the_social.'<div id="Socializer">
	
	<div id="fb-root"></div><script type="text/javascript">
				FB.XFBML.parse();
			</script><table style="'.$the_social_stldiv.';"><tr style="border:none;background-color:transparent;background-image:none;">			
			<td align="left" style="padding-right:24px;border:none;vertical-align:middle;background-color:transparent;background-image:none;" valign="middle"><a class="twitter-share-button" data-count="horizontal">Tweet</a></td>
			<td align="left" style="padding-right:24px;border:none;vertical-align:middle;background-color:transparent;background-image:none;" valign="middle"><fb:like layout="button_count" action="like" show_faces="false" share="true"></fb:like></td>			
			<td align="left" style="padding-right:24px;border:none;vertical-align:middle;background-color:transparent;background-image:none;" valign="middle"><g:plusone size="medium"></g:plusone></td>			
			<td align="left" valign="middle" style="border:none;vertical-align:middle;background-color:transparent;background-image:none;"><a title="Share in more social networks, email, translate, and more!" style="border:none;" href="http://www.socializer.info/share.asp?docurl='.urlencode(get_permalink($id)).'&doctitle='.get_the_title("").'" target="_blank"><img  src="'.$socpath.'sharemore.gif" title="Share in more social networks, email, translate, and more!" style="border:none;"></a></td></tr></table></div>';

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

	$tfw_stlwdiv = get_option('tfw_stlwdiv');
 	$remspw = array("'","\"");  
	$trmwdiv = str_replace($remspw, " ", $tfw_stlwdiv);
	$the_social_stlwdiv = stripslashes($trmwdiv);
	$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';
?>

<div id="SocializerW">		
	<div id="fb-root"></div><script type="text/javascript">
				FB.XFBML.parse();
			</script><table style="border-collapse: separate;border-spacing:10px;<?=$the_social_stlwdiv ?>;"><tr style="border:none;background-color:transparent;background-image:none;">			
			<td align="left" style="padding-right:9px;border:none;vertical-align:top;background-color:transparent;background-image:none;" valign="top"><a class="twitter-share-button" data-count="vertical">Tweet</a></td>
			<td align="left" valign="top" style="border:none;vertical-align:top;background-color:transparent;background-image:none;"><fb:like layout="box_count" action="like" show_faces="false" share="true"></fb:like></td></tr><tr style="border:none;">
			<td align="left" style="padding-right:9px;border:none;vertical-align:bottom;background-color:transparent;background-image:none;" valign="bottom"><g:plusone size="tall"></g:plusone></td>			
			<td align="left" valign="bottom" style="border:none;vertical-align:bottom;background-color:transparent;background-image:none;"><a title="Share in top social networks, email, translate, and more!" style="border:none;" href='http://www.socializer.info/share.asp?docurl=http://<?php echo urlencode($_SERVER["HTTP_HOST"]) ?><?php echo urlencode($_SERVER["REQUEST_URI"]); ?>&doctitle=<?php wp_title(); ?> <?php if ( is_home() ) { bloginfo("name"); } ?>' target="_blank"><img src="<?=$socpath?>sharemorel.gif" title="Share in top social networks, email, translate, and more!" style="border:none;"></a></td></tr></table></div>        
<?php
    }
}

function SocializerWidgetInit() {
    register_widget('SocializerWidget');
}

class SocializerFloatWidget extends WP_Widget {

    function SocializerFloatWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Socializer! Float'));
        $this->WP_Widget('SocializerFloatWidget', __('Socializer! Float'), $widget_ops);
    }

    function widget() {

	$tfw_stlfloatwdiv = get_option('tfw_stlfloatwdiv');
	$trmfloatwdiv = str_replace($remspfloatw, " ", $tfw_stlfloatwdiv);
	$the_social_stlfloatwdiv = stripslashes($trmfloatwdiv);
	$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';
?>

<div id="SocializerFloatW" style="max-width:133px;position:fixed;float:left; z-index:10000;<?=$the_social_stlfloatwdiv ?>;">	<div id="fb-root"></div><script type="text/javascript">
				FB.XFBML.parse();
			</script><table border="0" style="border:none;border-collapse: separate;border-spacing:10px;">
<tr style="border:none;background-color:transparent;background-image:none;">
			<td align="center" valign="top" style="border:none;background-color:transparent;background-image:none;"><fb:like layout="box_count" action="like" show_faces="false" share="true"></fb:like></td></tr>
<tr style="border:none;background-color:transparent;background-image:none;">
			<td align="center" valign="top" style="border:none;background-color:transparent;background-image:none;"><a class="twitter-share-button" data-count="vertical">Tweet</a></td></tr>
		<tr style="border:none;background-color:transparent;background-image:none;">
			<td align="center" valign="top" style="border:none;background-color:transparent;background-image:none;"><g:plusone size="tall"></g:plusone></td></tr><tr style="border:none;background-color:transparent;background-image:none;">
			<td align="center" valign="top" style="border:none;background-color:transparent;background-image:none;"><a title="Share in top social networks, email, translate, and more!" style="border:none;" href='http://www.socializer.info/share.asp?docurl=http://<?php echo urlencode($_SERVER["HTTP_HOST"]) ?><?php echo urlencode($_SERVER["REQUEST_URI"]); ?>&doctitle=<?php wp_title(); ?> <?php if ( is_home() ) { bloginfo("name"); } ?>' target="_blank"><img src="<?=$socpath?>sharemorel.gif" title="Share in top social networks, email, translate, and more!" style="border:none;"></a></td></tr></table></div>        
<?php
    }
}

function SocializerFloatWidgetInit() {
    register_widget('SocializerFloatWidget');
}

function socializer_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=socializerphp">Settings</a> | <a href="http://www.thefreewindows.com/6035/socializer-wordpress-frequent-questions-answers/">FQA</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
} 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'socializer_settings_link' );

add_filter('the_content', 'tfw_generate', 10000);
add_action('admin_menu', 'tfw_add_option_pages');
add_action('widgets_init', 'SocializerWidgetInit');
add_action('widgets_init', 'SocializerFloatWidgetInit');

?>