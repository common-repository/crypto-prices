<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wordpress.org/plugins/crypto-prices/
 * @since      1.0.0
 *
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/includes
 * @author     lerougeliet
 */
class Crypto_Prices_Activator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('crypto_prices_install_date', time());
		add_option('crypto_prices_options', array(
			'currency' => 'usd',
			'ticker_style' => 'after_name' // after_name, name_tooltip
		));

		Crypto_Prices_Functions::fetch_prices();

		if (!wp_next_scheduled('crypto_prices_fetch_prices')) {
			wp_schedule_event(time(), 'hourly', 'crypto_prices_fetch_prices');
		}
	}
}
