<?php

declare( strict_types = 1 );

/**
 * aS.c Boiler Plate
 *
 * WordPress plugin boilerplate with autoloader, Core, Admin, and Front structure.
 *
 * @wordpress-plugin
 * Plugin Name: aS.c Boiler Plate
 * Plugin URI: https://github.com/asolutioncompany/asc-boiler-plate
 * Description: WordPress plugin boilerplate
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 8.1
 * Author: aSolution.company
 * Author URI: https://asolution.company
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: asc-boiler-plate
 * Domain Path: /languages
 */

namespace ASC\BoilerPlate;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	exit;
}

define( 'ASC_BOILER_PLATE_PLUGIN_FILE', __FILE__ );

// Load Composer autoloader
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

register_activation_hook( __FILE__, array( __NAMESPACE__ . '\\Core\\Core', 'activate' ) );
register_deactivation_hook( __FILE__, array( __NAMESPACE__ . '\\Core\\Core', 'deactivate' ) );
register_uninstall_hook( __FILE__, array( __NAMESPACE__ . '\\Core\\Core', 'uninstall' ) );

// Initialize main class object
$asc_boiler_plate = Core\Core::get_instance();
