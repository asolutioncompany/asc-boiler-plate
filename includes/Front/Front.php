<?php
/**
 * Front Class
 *
 * Handles front-end asset loading (front CSS and JavaScript).
 *
 * @package asc-boiler-plate
 * @since 1.0.0
 */

declare( strict_types = 1 );

namespace ASC\BoilerPlate\Front;

/**
 * Front Class
 */
class Front {

	/**
	 * Initialize the Front class.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_assets' ) );
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
	 * Enqueue front assets (front-end CSS and JavaScript).
	 *
	 * @return void
	 */
	public function enqueue_front_assets(): void {
		$plugin_url = $this->get_plugin_url();
		$plugin_path = $this->get_plugin_path();
		$css_file = 'assets/front/front.css';
		$js_file = 'assets/front/front.js';

		wp_enqueue_style(
			'asc_boiler_plate_front',
			$plugin_url . $css_file,
			array(),
			filemtime( $plugin_path . $css_file )
		);

		wp_enqueue_script(
			'asc_boiler_plate_front',
			$plugin_url . $js_file,
			array( 'jquery' ),
			filemtime( $plugin_path . $js_file ),
			true
		);

		wp_localize_script(
			'asc_boiler_plate_front',
			'asc_boiler_plate_front',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'asc-boiler-plate-front-ajax-nonce' ),
			)
		);
	}
}
