<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.rajibkumar.com
 * @since      1.0.0
 *
 * @package    Any_Sms_Gateway_C71
 * @subpackage Any_Sms_Gateway_C71/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Any_Sms_Gateway_C71
 * @subpackage Any_Sms_Gateway_C71/admin
 * @author     Coder71 Ltd. <rajib@coder71.com>
 */
class Any_Sms_Gateway_C71_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('admin_menu', array($this, 'settings_page'));

		add_action('woocommerce_order_status_on-hold', array($this, 'mysite_hold'));
		add_action('woocommerce_order_status_processing', array($this, 'mysite_processing'));
	}

	public function getOrderInfo($order_id){
		return wc_get_order( $order_id );
	}

	public function mysite_hold($order_id) {
		if (class_exists('WooCommerce')) {
			$order = $this->getOrderInfo($order_id);
			$file_handle = fopen('D:\xampp\htdocs\wordpress\tmp.txt', 'a+');
			fwrite($file_handle, "$order_id set to ON HOLD - ".$order->get_billing_first_name());
			fwrite($file_handle, "\n");
			fclose($file_handle);
		}
	}

	public function mysite_processing($order_id) {
		if (class_exists('WooCommerce')) {
			$order = $this->getOrderInfo($order_id);
			$file_handle = fopen('D:\xampp\htdocs\wordpress\tmp.txt', 'a+');
			fwrite($file_handle, "$order_id set to PROCESSING - ".$order->get_billing_first_name());
			fwrite($file_handle, "\n");
			fclose($file_handle);
		}
	}

	public function settings_page() {
		// Add the menu item and page
		$page_title = 'Settings - ' . $this->plugin_name;
		$menu_title = 'Any SMS C71';
		$capability = 'manage_options';
		$slug = 'any-sms-gateway-c71';
		$callback = array( $this, 'settings_page_content' );
		$icon = 'dashicons-admin-plugins';
		$position = 100;
	
		add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
	}

	public function settings_page_content() {

		if( @$_POST['updated'] === 'true' ){
			$this->handle_form();
		}
		?>
		<div class="wrap">
			<h2>Setup your API</h2>
			<form method="POST">
			<input type="hidden" name="updated" value="true" />
    		<?php wp_nonce_field( 'any_sms_gateway_c71_update', 'any_sms_gateway_c71_form' ); ?>
				<table class="form-table">
					<tbody>
						<tr>
							<th><label for="api_endpoint">API Endpoint</label></th>
							<td><input name="api_endpoint" id="api_endpoint" type="text" value="<?php echo get_option('any_sms_gateway_c71_api_endpoint'); ?>" class="regular-text" /></td>
						</tr>
						<tr>
							<th><label for="api_user">API User</label></th>
							<td><input name="api_user" id="api_user" type="text" value="<?php echo get_option('any_sms_gateway_c71_api_user'); ?>" class="regular-text" /></td>
						</tr>
						<tr>
							<th><label for="api_password">API Password</label></th>
							<td><input name="api_password" id="api_password" type="text" value="<?php echo get_option('any_sms_gateway_c71_api_password'); ?>" class="regular-text" /></td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="button button-primary" value="Update">
				</p>
			</form>
		</div>
		<?php
	}

	public function handle_form() {
		if(!isset( $_POST['any_sms_gateway_c71_form'] ) || !wp_verify_nonce( $_POST['any_sms_gateway_c71_form'], 'any_sms_gateway_c71_update' )){ ?>
			<div class="error">
			   <p>Sorry, your nonce was not correct. Please try again.</p>
			</div> <?php
			exit;
		} else {
			$endpoint = esc_url($_POST['api_endpoint']);
			$user = sanitize_text_field($_POST['api_user']);
			$password = sanitize_text_field($_POST['api_password']);
			
			update_option( 'any_sms_gateway_c71_api_endpoint', $endpoint);
			update_option( 'any_sms_gateway_c71_api_user', $user);
			update_option( 'any_sms_gateway_c71_api_password', $password);
			?>
			<div class="updated">
				<p>Your fields were saved!</p>
			</div>
			<?php
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Any_Sms_Gateway_C71_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Any_Sms_Gateway_C71_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/any-sms-gateway-c71-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Any_Sms_Gateway_C71_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Any_Sms_Gateway_C71_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/any-sms-gateway-c71-admin.js', array( 'jquery' ), $this->version, false );

	}

}
