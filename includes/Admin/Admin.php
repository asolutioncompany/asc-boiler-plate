<?php
/**
 * Admin Class
 *
 * Core admin class that maintains constants and initializes admin components.
 *
 * @package asc-boiler-plate
 * @since 1.0.0
 */

declare( strict_types = 1 );

namespace ASC\BoilerPlate\Admin;

use ASC\BoilerPlate\Core\Core;

/**
 * Admin Class
 */
class Admin {

	/**
	 * Settings page slug.
	 *
	 * @var string
	 */
	const PAGE_SLUG = 'asc-boiler-plate';

	/**
	 * Initialize the Admin class.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialize admin components.
	 *
	 * @return void
	 */
	private function init(): void {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		add_action( 'admin_menu', array( $this, 'register_settings_page' ) );
	}

	/**
	 * Enqueue admin assets (CSS and JavaScript) only on the plugin settings page.
	 *
	 * @return void
	 */
	public function enqueue_admin_assets(): void {
		$screen = get_current_screen();
		if ( $screen === null || $screen->id !== 'settings_page_' . self::PAGE_SLUG ) {
			return;
		}

		$core = Core::get_instance();
		$plugin_url = $core->get_plugin_url();
		$plugin_path = $core->get_plugin_path();
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

	/**
	 * Register the settings page under the Settings menu.
	 *
	 * @return void
	 */
	public function register_settings_page(): void {
		add_options_page(
			__( 'aS.c Boiler Plate', 'asc-boiler-plate' ),
			__( 'aS.c Boiler Plate', 'asc-boiler-plate' ),
			'manage_options',
			self::PAGE_SLUG,
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Render the settings page.
	 *
	 * @return void
	 */
	public function render_settings_page(): void {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<p><?php esc_html_e( 'Add your settings here.', 'asc-boiler-plate' ); ?></p>
		</div>
		<?php
	}
}
