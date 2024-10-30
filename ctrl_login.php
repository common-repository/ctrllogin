<?php
/**
 * [Ctrl]Login
 *
 * @package       [Ctrl]Login
 * @author        [Ctrl]Sync
 * @version       1.0
 *
 * @wordpress-plugin
 * Plugin Name:   [Ctrl]Login
 * Plugin URI:    https://ctrlsync.com
 * Description:   This plugin changes the login logo for wordpress, removes admin corner logo, removes wordpress footer text, and disables admin widgets on the dashboard.
 * Version:       1.0
 * Author:        [Ctrl]Sync
 * Author URI:    https://ctrlsync.com
 */
 

include( plugin_dir_path( __FILE__ ) . 'ctrl_settings.php');



/***
  * Change login logo
*/
	
function ctrl_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php 
			$url_value = get_option('ctrl_login_settings');
			echo esc_url($url_value['ctrl_login_text_field_0']);?>);
        height:100px;
        width:200px;
        background-size: 200px 100px;
        background-repeat: no-repeat;
        padding-bottom: 10px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'ctrl_login_logo' );

function ctrl_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'ctrl_login_logo_url' );
  



/***
  * Remove admin corner logo
*/
function ctrl_login_remove_admin_logo() {
   global $wp_admin_bar;
   $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action('wp_before_admin_bar_render','ctrl_login_remove_admin_logo', 0 );



/***
 * Alters the bottom left admin text

 */
add_filter( 'admin_footer_text', '__return_false' );


/***
 * Remove all the dashboard widgets
 */

function ctrl_login_remove_dashboard_widgets() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget
}
add_action('admin_init', 'ctrl_login_remove_dashboard_widgets');

