<?php
/**
 * Core Class
 *
 * Main plugin class: activation, Admin and Front instances.
 *
 * @package asc-boiler-plate
 * @since 1.0.0
 */

declare( strict_types = 1 );

namespace ASC\BoilerPlate\Core;

use ASC\BoilerPlate\Front\Front;

/**
 * Core Class
 */
class Core {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * Plugin instance.
	 *
	 * @var Core|null
	 */
	private static ?Core $instance = null;

	/**
	 * Get plugin instance.
	 *
	 * @return Core
	 */
	public static function get_instance(): Core {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	private function init(): void {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		new Front();
		if ( is_admin() ) {
			$this->init_admin();
		}
	}

	/**
	 * Initialize admin functionality.
	 *
	 * @return void
	 */
	private function init_admin(): void {
		new Admin();
	}

	/**
	 * Load plugin text domain.
	 *
	 * @return void
	 */
	public function load_textdomain(): void {
		load_plugin_textdomain(
			'asc-boiler-plate',
			false,
			dirname( plugin_basename( __FILE__ ), 2 ) . '/languages'
		);
	}

	/**
	 * Activation hook callback.
	 *
	 * @return void
	 */
	public static function activate(): void {
		add_option( 'asc_boiler_plate_version', self::VERSION );
	}

	/**
	 * Deactivation hook callback.
	 *
	 * @return void
	 */
	public static function deactivate(): void {
	}

	/**
	 * Uninstall hook callback.
	 *
	 * @return void
	 */
	public static function uninstall(): void {
		delete_option( 'asc_boiler_plate_version' );
	}
}
