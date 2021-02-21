<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.rajibkumar.com
 * @since      1.0.0
 *
 * @package    Any_Sms_Gateway_C71
 * @subpackage Any_Sms_Gateway_C71/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Any_Sms_Gateway_C71
 * @subpackage Any_Sms_Gateway_C71/includes
 * @author     Coder71 Ltd. <rajib@coder71.com>
 */
class Any_Sms_Gateway_C71_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'any-sms-gateway-c71',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
