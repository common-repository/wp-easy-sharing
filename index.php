<?php if ( ! defined( 'ABSPATH' ) ) exit; 
/*
Plugin Name: WP Easy Sharing
Version: 1.1.5
Plugin URI: http://wordpress.org/plugins/wp-easy-sharing/
Description: Social sharing buttons for Facebook, Twitter, Linkedin, Pinterest, Google+ and Tutorsloop to wordpress posts, pages or media. 
Author: Fahad Mahmood
Author URI: http://shop.androidbubbles.com
Text Domain: wpe-sharing
Domain Path: /languages/
License: GPL2

This WordPress Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
This free software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this software. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

	

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	

	

	

	if ( ! defined( 'ABSPATH' ) ) {

		header( 'Status: 403 Forbidden' );

		header( 'HTTP/1.1 403 Forbidden' );

		exit;

	}

	

	global $wpe_pro, $wpe_premium_link, $wpe_data;

	

	$wpe_data = get_plugin_data(__FILE__);

	define('ES_VERSION', $wpe_data['Version']);

	define( "ES_DIR", plugin_dir_path( __FILE__ ) ); 

	define( "ES_PLUGIN_URL", plugins_url( '/' , __FILE__ ) );

	define('WPES_DEFAULT_ORDER', 'f,t,g,l,p,y,tl');

	define('WPES_DEFAULT_ICONS', 'facebook,twitter,googleplus,linkedin,pinterest,youtube,tutorsloop');

	$wpe_pro = file_exists(ES_DIR.'pro/wpes_wall.php');

	$wpe_premium_link = 'http://shop.androidbubbles.com/product/wp-easy-sharing-pro';

	

	if($wpe_pro)

	include(ES_DIR.'pro/wpes_wall.php');

	

	require_once ES_DIR . 'core.php';

	

	if( ! is_admin() ) {

		require_once ES_DIR . 'classes/class-public.php';

		new ES_Public();

	} elseif( ! defined("DOING_AJAX") || ! DOING_AJAX ) {

		require ES_DIR . 'classes/class-admin.php';

		new ES_Admin();

		

		$plugin = plugin_basename(__FILE__); 

		add_filter("plugin_action_links_$plugin", 'wpe_plugin_links' );			

	}

	

	register_activation_hook(__FILE__, array('ES_Admin','wes_plugin_activation_action'));

	

	add_action( 'plugins_loaded', 'wes_update_db_check_while_plugin_upgrade' );

	

	function wes_update_db_check_while_plugin_upgrade(){
		//update_option('wes_wpe_sharing', WPES_DEFAULT_ORDER);
		$default = get_option('wpe_sharing');
		//pree($defaults);exit;
		update_option('wpe_sharing',$default);
	}