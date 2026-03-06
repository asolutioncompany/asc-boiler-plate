<?php
/**
 * Admin Class
 *
 * Enqueues admin assets. Add your own settings page or admin UI as needed.
 *
 * @package asc-boiler-plate
 * @since 1.0.0
 */

declare( strict_types = 1 );

namespace ASC\BoilerPlate\Admin;

/**
 * Admin Class
 */
class Admin {

	/**
	 * Initialize the Admin class.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
	}

	/**
	 * Get the plugin URL.
	 *
	 * @return string
	 */
	private function get_plugin_url(): string {
		return plugin_dir_url( \ASC_BOILER_PLATE_PLUGIN_FILE );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	private function get_plugin_path(): string {
		return plugin_dir_path( \ASC_BOILER_PLATE_PLUGIN_FILE );
	}

	/**
	 * Enqueue admin assets (CSS and JavaScript).
	 *
	 * @return void
	 */
	public function enqueue_admin_assets(): void {
		$plugin_url = $this->get_plugin_url();
		$plugin_path = $this->get_plugin_path();
		$css_file = 'assets/admin/admin.css';
		$js_file = 'assets/admin/admin.js';

		wp_enqueue_style(
			'asc_boiler_plate_admin',
			$plugin_url . $css_file,
			array(),
			filemtime( $plugin_path . $css_file )
		);

		wp_enqueue_script(
			'asc_boiler_plate_admin',
			$plugin_url . $js_file,
			array( 'jquery' ),
			filemtime( $plugin_path . $js_file ),
			true
		);

		wp_localize_script(
			'asc_boiler_plate_admin',
			'asc_boiler_plate_admin',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'asc-boiler-plate-admin-ajax-nonce' ),
			)
		);
	}
}
