<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.rajibkumar.com
 * @since             1.0.0
 * @package           Any_Sms_Gateway_C71
 *
 * @wordpress-plugin
 * Plugin Name:       Any SMS Gateway | C71
 * Plugin URI:        http://any-sms-gateway-c71.coder71.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Coder71 Ltd.
 * Author URI:        http://www.rajibkumar.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       any-sms-gateway-c71
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ANY_SMS_GATEWAY_C71_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-any-sms-gateway-c71-activator.php
 */
function activate_any_sms_gateway_c71() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-any-sms-gateway-c71-activator.php';
	Any_Sms_Gateway_C71_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-any-sms-gateway-c71-deactivator.php
 */
function deactivate_any_sms_gateway_c71() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-any-sms-gateway-c71-deactivator.php';
	Any_Sms_Gateway_C71_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_any_sms_gateway_c71' );
register_deactivation_hook( __FILE__, 'deactivate_any_sms_gateway_c71' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-any-sms-gateway-c71.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_any_sms_gateway_c71() {

	$plugin = new Any_Sms_Gateway_C71();
	$plugin->run();

}
run_any_sms_gateway_c71();
