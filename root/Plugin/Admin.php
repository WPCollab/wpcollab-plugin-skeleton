<?php
/**
 * @author {%= dev_long %}
 * @copyright Copyright (c) 2014, {%= dev_long %}
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package {%= dev %}\{%= title_camel_uppercase %}\Admin
 */

// avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * @todo Description
 *
 * @since 1.0.0
 */
class {%= dev %}_{%= title_camel_uppercase %}_Admin {

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
	 * Getter method for retrieving the object instance.
	 *
	 * @since 1.0.0
	 * @static
	 * @access public
	 *
	 * @return object {%= dev %}_{%= title_camel_uppercase %}_Admin::$instance
	 */
	public static function get_instance() {

		return self::$instance;

	} // END get_instance()

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {

		self::$instance = $this;

		/** Load admin assets. */
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		/** Add an action link pointing to the options page. */
		$plugin_basename = plugin_basename( plugin_dir_path( {%= dev %}_{%= title_camel_uppercase %}::get_file() ) . '{%= slug %}.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

	} // END __construct()

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see apply_filters()
	 * @see WP_DEBUG
	 * @see wp_enqueue_script()
	 * @see wp_enqueue_style()
	 * @see plugins_url()
	 *
	 * @param string $hook
	 * @return void
	 */
	public function enqueue_admin_scripts( $hook ) {

		$dev = apply_filters( 'wpcollab_{%= title_underscores %}_debug_mode', WP_DEBUG ) ? '' : '.min';

		wp_enqueue_script( '{%= slug %}-admin-script', plugins_url( "js/admin{$dev}.js", {%= dev %}_{%= title_camel_uppercase %}::get_file() ), array(), {%= dev %}_{%= title_camel_uppercase %}::$version, true );

		wp_enqueue_style( '{%= slug %}-admin-style', plugins_url( "css/admin{$dev}.css", {%= dev %}_{%= title_camel_uppercase %}::get_file() ), array(), {%= dev %}_{%= title_camel_uppercase %}::$version );

	} // END enqueue_admin_scripts()

	/**
	 * @todo
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $links
	 * @return array
	 */
	public function add_action_links( $links ) {

		array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page={%= slug %}' ) . '">' . __( 'Settings' ) . '</a>',
			),
			$links
		);

		return $links;

	} // END add_action_links()

} // END class {%= dev %}_{%= title_camel_uppercase %}_Admin
