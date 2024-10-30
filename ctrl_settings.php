<?php

/**
 * settings
*/

add_action( 'admin_menu', 'ctrl_login_add_options_menu' );
add_action( 'admin_init', 'ctrl_login_settings_init' );


function ctrl_login_add_options_menu() { 

	add_options_page( 
		'[Ctrl] Login', /** Wesbite title */ 
		'[Ctrl] Login', /** setting submenu title */
		'manage_options',  /** required user privealges*/
		'ctrl_login',  /**slug name for menu */
		'ctrl_login_options_page' ); /** page to hold options for calling back*/

}


function ctrl_login_settings_init() { 

	register_setting( 'ctrl_login_plugin_page', 'ctrl_login_settings' );
	
	add_settings_section(
		'ctrl_login_setting_section',    /*** $id (string) (Required) Slug-name to identify the section.**/
		'Logo URL Input',      /*** $title (string) (Required) Formatted title of the section.**/
		'ctrl_login_settings_section_callback',/**$callback (callable) (Required) Function that echos out any content**/
		'ctrl_login_plugin_page'   /*** $page (string) (Required) The slug-name of the settings page on which to show the section**/
	);


	add_settings_field( 
		'ctrl_login_text_field_0', /*** $id (string) (Required) Slug-name to identify the field.**/
		'Upload Media Link:',   /*** $title (string) (Required) Formatted title of the field.**/
		'ctrl_login_text_field_0_render',/**$callback (callable) (Required) Function that fills the field with the desired form inputs. The function should echo its output. **/
		'ctrl_login_plugin_page',/*** $page (string) (Required) The slug-name of the settings page on which to show the section**/
		'ctrl_login_setting_section' /** $section (string) (Optional) The slug-name of the section this setting belongs to*/
		 
	);

}


function ctrl_login_text_field_0_render() { 
	$options = get_option( 'ctrl_login_settings' );
		echo "<input type='text' size='90' name='ctrl_login_settings[ctrl_login_text_field_0]'value=" . esc_html($options['ctrl_login_text_field_0']) . ">";
}


function ctrl_login_settings_section_callback() {
	echo esc_attr("Example: https://ctrlsync.com/wp-content/uploads/2022/05/CS_LogoFiles-e1653305277811.png");
}

function ctrl_login_options_page() { 
	echo "<form action='options.php' method='post'>";
	echo "<h2>Ctrl Login</h2>";
		settings_fields( 'ctrl_login_plugin_page' );
		do_settings_sections( 'ctrl_login_plugin_page' );
		submit_button();
	echo "</form>";

}

/**
 * settings
*/

