<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/crypto-prices/
 * @since             1.0.0
 * @package           Crypto_Prices
 *
 * @wordpress-plugin
 * Plugin Name:       Crypto Prices
 * Plugin URI:        https://wordpress.org/plugins/crypto-prices/
 * Description:				Add inline cryptocurrency prices to your blog posts.
 * Version:           1.0.0
 * Author:            lerougeliet
 * Author URI:				https://profiles.wordpress.org/lerougeliet/#content-plugins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       crypto-prices
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * The class responsible for defining all helper functions used by the plugin.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-functions.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function activate_crypto_prices() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-activator.php';
	Crypto_Prices_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function deactivate_crypto_prices() {
	require_once plugin_dir_path(__FILE__) . 'includes/class-deactivator.php';
	Crypto_Prices_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_crypto_prices');
register_deactivation_hook(__FILE__, 'deactivate_crypto_prices');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-main.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_crypto_prices() {
	$plugin = new Crypto_Prices();
	$plugin->run();
}
run_crypto_prices();
