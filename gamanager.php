<?php
/*
Plugin Name: Manager for Google Analytics
Plugin URI: http://wordpress.org/extend/plugins/simplegamanager/
Description: Enables <a href="http://www.google.com/analytics/" target="_blank">GA</a> on all pages.
Version: 1.0.3
Author: Justin Rains
Author URI: https://portalplanet.net/google-analytics-wordpress-plugin/
*/

if (!defined('WP_CONTENT_URL'))
      define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
if (!defined('WP_CONTENT_DIR'))
      define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('WP_PLUGIN_URL'))
      define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
if (!defined('WP_PLUGIN_DIR'))
      define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');

function activate_gamanager() {
  add_option('analytics_id', 'UA-xxxxxxxxx');
}

function deactive_gamanager() {
  delete_option('analytics_id');
}

function admin_init_gamanager() {
  register_setting('gamanager', 'analytics_id');
}

function admin_menu_gamanager() {
  add_options_page('Manager for Google Analytics', 'Manager for Google Analytics', 'manage_options', 'gamanager', 'options_page_gamanager');
}

function options_page_gamanager() {
  include(WP_PLUGIN_DIR.'/simple-google-analytics-manager/options.php');  
}

function gamanager() {
  $tag_id = get_option('analytics_id');
?>
<!-- Simple Manager for Google Analytics by Justin Rains-->
<!-- Global site tag (gtag.js) - GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tag_id ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $tag_id ?>');
</script>
<?php
}

register_activation_hook(__FILE__, 'activate_gamanager');
register_deactivation_hook(__FILE__, 'deactive_gamanager');

if (is_admin()) {
  add_action('admin_init', 'admin_init_gamanager');
  add_action('admin_menu', 'admin_menu_gamanager');
}

add_action('wp_head', 'gamanager');
?>
