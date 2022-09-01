<?php
/**
 * Plugin Name:       WPForms Campaign Monitor
 * Plugin URI:        https://wpforms.com
 * Description:       Campaign Monitor integration with WPForms.
 * Requires at least: 4.9
 * Requires PHP:      5.5
 * Author:            WPForms
 * Author URI:        https://wpforms.com
 * Version:           1.2.2
 * Text Domain:       wpforms-campaign-monitor
 * Domain Path:       languages
 *
 * WPForms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * WPForms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with WPForms. If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WPForms.Comments.PHPDocDefine.MissPHPDoc
// Plugin version.
define( 'WPFORMS_CAMPAIGN_MONITOR_VERSION', '1.2.2' );
// phpcs:enable WPForms.Comments.PHPDocDefine.MissPHPDoc

/**
 * Load the provider class.
 *
 * @since 1.0.0
 */
function wpforms_campaign_monitor() {

	// WPForms Pro is required.
	if (
		! function_exists( 'wpforms' ) ||
		! function_exists( 'wpforms_get_license_type' ) ||
		! wpforms()->pro ||
		! in_array( wpforms_get_license_type(), [ 'plus', 'pro', 'elite', 'agency', 'ultimate' ], true )
	) {
		return;
	}

	require_once plugin_dir_path( __FILE__ ) . 'class-campaign-monitor.php';
}

add_action( 'wpforms_loaded', 'wpforms_campaign_monitor' );

/**
 * Load the plugin updater.
 *
 * @since 1.0.0
 *
 * @param string $key
 */
function wpforms_campaign_monitor_updater( $key ) {

	new WPForms_Updater(
		array(
			'plugin_name' => 'WPForms Campaign Monitor',
			'plugin_slug' => 'wpforms-campaign-monitor',
			'plugin_path' => plugin_basename( __FILE__ ),
			'plugin_url'  => trailingslashit( plugin_dir_url( __FILE__ ) ),
			'remote_url'  => WPFORMS_UPDATER_API,
			'version'     => WPFORMS_CAMPAIGN_MONITOR_VERSION,
			'key'         => $key,
		)
	);
}

add_action( 'wpforms_updater', 'wpforms_campaign_monitor_updater' );
