<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/crypto-prices/
 * @since      1.0.0
 *
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/admin
 * @author     lerougeliet
 */
class Crypto_Prices_Admin {
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
	public function __construct($plugin_name, $version) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook_suffix) {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Crypto_Prices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Crypto_Prices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ($hook_suffix === 'settings_page_crypto-prices') {
			wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'main.css', array(), $this->version, 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook_suffix) {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Crypto_Prices_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Crypto_Prices_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name . 'main', plugin_dir_url(__FILE__) . 'main.js', array('jquery'), $this->version, true);
	}

	public function add_plugin_menu() {
		add_options_page('Crypto Prices Options', 'Crypto Prices', 'manage_options', 'crypto-prices', array(&$this, 'crypto_prices_options'));
	}

	public function crypto_prices_options() {
		if (!current_user_can('manage_options'))  {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/admin-display.php';
	}

	function add_action_links($links) {
		$links[] = '<a href="' . admin_url('options-general.php?page=crypto-prices') . '">Options</a>';
		$links[] = '<a href="https://wordpress.org/support/plugin/crypto-prices/reviews/#new-post">Review</a>';
		return $links;
	}

	function check_json_extension() {
		global $pagenow;
		if ($pagenow === '/options-general.php' && $_GET['page'] === 'crypto-prices'
			&& !function_exists('json_decode')) {
    	echo '<div class="notice notice-error"><p>Crypto Prices needs the PHP JSON extension to work.</p></div>';
		}
  }
}
