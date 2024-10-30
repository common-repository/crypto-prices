<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://wordpress.org/plugins/crypto-prices/
 * @since      1.0.0
 *
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/includes
 * @author     lerougeliet
 */
class Crypto_Prices_Deactivator {
	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook('crypto_prices_fetch_prices');
	}
}
