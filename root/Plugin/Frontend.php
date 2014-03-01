<?php
/**
 * @author {%= dev_long %}
 * @copyright Copyright (c) 2014, {%= dev_long %}
 * @license	 http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @package {%= dev %}\{%= title_camel_capital %}\Frontend
 */

// avoid direct calls to this file
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

/**
 * @todo Description
 *
 * @since 1.0.0
 */
class {%= dev %}_{%= title_camel_capital %}_Frontend {

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
	 * @return object {%= dev %}_{%= title_camel_capital %}_Frontend::$instance
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

	} // END __construct()

} // END class {%= dev %}_{%= title_camel_capital %}_Frontend
