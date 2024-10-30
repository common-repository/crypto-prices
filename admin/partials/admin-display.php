<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wordpress.org/plugins/crypto-prices/
 * @since      1.0.0
 *
 * @package    Crypto_Prices
 * @subpackage Crypto_Prices/admin/partials
 */

$options = get_option('crypto_prices_options');
if (!$options || !is_array($options)) {
 $options = array(
   'auto_insert' => true,
   'currency' => 'usd',
 );
}

if (!empty($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'crypto_prices_update_options')) {
  if (!empty($_POST['currency']) && array_key_exists($_POST['currency'], Crypto_Prices::$currencies)) {
    $options['currency'] = sanitize_key($_POST['currency']);
  }

  update_option('crypto_prices_options', $options);
  Crypto_Prices_Functions::fetch_prices();
}

$prices = get_option('crypto_prices_prices');

?>

<h1>Crypto Prices Options</h1>

<form method="post" action="" novalidate="novalidate" id="crypto-prices-form">
  <input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('crypto_prices_update_options'); ?>">

  <table class="form-table">
    <tbody>
      <tr>
        <th scope="row">Currency</th>
        <td>
          <fieldset>
            <select name="currency">
              <?php
              foreach (Crypto_Prices::$currencies as $code => $name) {
                echo '<option name="' . esc_attr($code) . '"' . ($code === $options['currency'] ? ' selected' : '') . ' value="' . esc_attr($code) . '">' . esc_html($name . ' (' . strtoupper($code) . ')') . '</option>';
              }
              ?>
            </select>
          </fieldset>
        </td>
      </tr>
    </tbody>
  </table>

  <p class="submit">
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
  </p>

  <h2>Cached Prices</h2>
  <table class="widefat">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Symbol</th>
        <th>Price</th>
        <th>24H Change</th>
      </tr>
    </thead>
    <?php foreach ($prices as $id => $row) { ?>
      <tr>
        <td><?php echo esc_html($id) ?></td>
        <td><?php echo esc_html($row['name']) ?></td>
        <td><?php echo esc_html($row['symbol']) ?></td>
        <td><?php echo esc_html($row['price']) ?></td>
        <td><?php echo esc_html($row['change']) ?>%</td>
      </tr>
    <?php } ?>
  </table>
  <p class="submit">
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Fetch Updates">
  </p>
</form>
