<?php
/**
 * Front Class
 *
 * Handles front-end initialization and enqueues front assets.
 *
 * @package asc-boiler-plate
 * @since 1.0.0
 */

declare( strict_types = 1 );

namespace ASC\BoilerPlate\Front;

use ASC\BoilerPlate\Core\Core;

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
		$this->init();
	}

	/**
	 * Initialize front components.
	 *
	 * @return void
	 */
	private function init(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_assets' ) );
	}

	/**
	 * Enqueue front assets (front-end CSS and JavaScript).
	 *
	 * @return void
	 */
	public function enqueue_front_assets(): void {
		$core = Core::get_instance();
		$plugin_url = $core->get_plugin_url();
		$plugin_path = $core->get_plugin_path();

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
