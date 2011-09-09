<?php
/*
Plugin Name: Socializer! Widget
Plugin URI: http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/
Description: Share your posts, pages, categories and everything on Facebook and other Social Networking sites, Google Plus, even by eMail, from the Socializer's sidebar widget. Check the <a href="http://www.thefreewindows.com/5598/socializer-share-wordpress-posts-pages/" target="_blank">Home Page of Socializer!</a> for more details and information on manual use.
Version: 2.5
Author: TheFreeWindows
Author URI: http://www.thefreewindows.com
*/

class SocializerWidget extends WP_Widget {

    function SocializerWidget() {
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Socializer! Widget'));
        $this->WP_Widget('SocializerWidget', __('Socializer!'), $widget_ops);
    }

    function widget() {
if ( !defined('WP_CONTENT_URL') )
    define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
 
$socpath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';
?>

<a style='border:none;' href='http://www.topfreeware.org/socializer.asp?docurl=http://<?php echo $_SERVER["HTTP_HOST"] ?><?php echo parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH); ?>&doctitle=<?php wp_title(''); ?> <?php if ( is_home() ) { bloginfo('name'); } ?>' target='_blank'><img src='<?php echo $socpath; ?>scl-sm.gif' alt='Share it!' style='background:white;border:none;padding:0;margin:8pt;-moz-border-radius: 8px;border-radius: 8px;'></a>
        
<?php
    }
}
function SocializerWidgetInit() {
    register_widget('SocializerWidget');
}

add_action('widgets_init', 'SocializerWidgetInit');
?>