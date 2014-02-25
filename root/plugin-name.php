<?php
/*
Plugin Name: {%= title %}
Plugin URI: {%= homepage %}
Description: {%= description %}
Version: 0.1-alpha
Author: {%= dev_long %}
Author URI: {%= github_repo %}/graphs/contributors
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: {%= slug %}
Domain Path: /languages
GitHub Plugin URI: {%= github_repo %}

	{%= title %}
	Copyright (C) 2014 {%= dev %} Team ({%= github_repo %}/graphs/contributors)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
/**
 * @author {%= dev_long %}
 * @copyright Copyright (c) 2014, {%= dev_long %}
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package {%= dev %}\{%= title_camel_uppercase %}
 * @version 0.1-alpha
 */

// avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/** Register autoloader */
spl_autoload_register( '{%= dev %}_{%= title_camel_uppercase %}::autoload' );

/**
 * Main class to run the plugin
 *
 * @since 1.0.0
 */
class {%= dev %}_{%= title_camel_uppercase %} {

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 1.0.0
	 * @static
	 * @access private
	 * @var object $instance
	 */
	private static $instance;

	/**
	 * Current version of the plugin.
	 *
	 * @since 1.0.0
	 * @static
	 * @access public
	 * @var string $version
	 */
	public static $version = '0.1-alpha';

	/**
	 * Holds a copy of the main plugin filepath.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $file
	 */
	private static $file = __FILE__;

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see	add_action()
	 * @see	register_activation_hook()
	 * @see	register_deactivation_hook()
	 *
	 * @return void
	 */
	public function __construct() {

		self::$instance = $this;

		if ( is_admin() ) {

			new {%= dev %}_{%= title_camel_uppercase %}_Admin();

		} elseif ( !is_admin() ) {

			new {%= dev %}_{%= title_camel_uppercase %}_Frontend();

		}

		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

		register_activation_hook( __FILE__, array( '{%= dev %}_{%= title_camel_uppercase %}', 'activate_plugin' ) );
		register_deactivation_hook( __FILE__, array( '{%= dev %}_{%= title_camel_uppercase %}', 'deactivate_plugin' ) );

	} // END __construct()

	/**
	 * @todo
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see apply_filters()
	 *
	 * @return array
	 */
	public function get_defaults() {

		$defaults = array();

		$options = apply_filters( '{%= dev_lowercase %}_{%= title_underscores %}_defaults', $defaults );

		return $options;
	}

	/**
	 * PSR-0 compliant autoloader to load classes as needed.
	 *
	 * @since 1.0.0
	 * @static
	 * @access public
	 *
	 * @param string $classname The name of the class
	 * @return null Return early if the class name does not start with the correct prefix
	 */
	public static function autoload( $classname ) {

		if ( '@todo' !== mb_substr( $classname, 0, 3 ) ) {
			return;
		}

		$filename = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . str_replace( '_', DIRECTORY_SEPARATOR, $classname ) . '.php';

		if ( file_exists( $filename ) ) {
			require $filename;
		}

	} // END autoload()

	/**
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 * @static
	 * @access public
	 *
	 * @return object {%= dev %}_{%= title_camel_uppercase %}::$instance
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

	/**
	 * Getter method for retrieving the main plugin filepath.
	 *
	 * @since 1.0.0
	 * @static
	 * @access public
	 *
	 * @return string self::$file
	 */
	public static function get_file() {

		return self::$file;

	} // END get_file()

	/**
	 * Load the plugin's textdomain hooked to 'plugins_loaded'.
	 *
	 * @since	1.0.0
	 * @access	public
	 *
	 * @see load_plugin_textdomain()
	 * @see plugin_basename()
	 * @action plugins_loaded
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'{%= slug %}',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);

	} // END load_plugin_textdomain()

	/**
	 * Fired when plugin is activated
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @action register_activation_hook
	 *
	 * @param bool $network_wide TRUE if WPMU 'super admin' uses Network Activate option
	 * @return void
	 */
	public function activate_plugin( $network_wide ) {

		$defaults = self::get_defaults();

		if ( is_multisite() && ( true == $network_wide ) ) {

			global $wpdb;
			$blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );

			if ( $blogs ) {
				foreach( $blogs as $blog ) {
					switch_to_blog( $blog['blog_id'] );
					add_option( '{%= dev_lowercase %}_{%= title_underscores %}_settings', $defaults );
				}
				restore_current_blog();
			}

		} else {

			add_option( '{%= dev_lowercase %}_{%= title_underscores %}_settings', $defaults );

		}

	} // END activate_plugin()

	/**
	 * Fired when plugin is adectivated
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @action register_deactivation_hook
	 *
	 * @param bool $network_wide TRUE if WPMU 'super admin' uses Network Activate option
	 * @return void
	 */
	public function deactivate_plugin( $network_wide ) {

	} // END deactivate_plugin()

} // END class {%= dev %}_{%= title_camel_uppercase %}

/**
 * Instantiate the main class
 *
 * @since 1.0.0
 * @access public
 *
 * @global object ${%= dev_lowercase %}_{%= title_camel_lowercase %}
 * @var object ${%= dev_lowercase %}_%= title_camel_lowercase %} holds the instantiated class {@uses {%= dev %}_{%= title_camel_uppercase %}}
 */
global ${%= dev_lowercase %}_{%= title_camel_lowercase %};
${%= dev_lowercase %}_{%= title_camel_lowercase %} = new {%= dev %}_{%= title_camel_uppercase %}();
