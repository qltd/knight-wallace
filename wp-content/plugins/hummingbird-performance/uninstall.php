<?php
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	exit();

if ( ! function_exists( 'is_plugin_active' ) ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

if ( class_exists( 'WP_Hummingbird' ) ) {
	return;
}

global $wpdb;

delete_option( 'wphb_styles_collection' );
delete_option( 'wphb_scripts_collection' );

$option_names = $wpdb->get_col(
	$wpdb->prepare(
		"SELECT option_name FROM $wpdb->options
					WHERE option_name LIKE %s
					OR option_name LIKE %s
					OR option_name LIKE %s
					OR option_name LIKE %s",
		'%wphb-min-scripts%',
		'%wphb-scripts%',
		'%wphb-min-styles%',
		'%wphb-styles%'
	)
);

foreach ( $option_names as $name )
	delete_option( $name );

delete_option( 'wphb_process_queue' );
delete_transient( 'wphb-minification-errors' );
delete_option( 'wphb-minify-server-errors' );

delete_option( 'wphb_settings' );
delete_site_option( 'wphb_settings' );

delete_site_option( 'wphb_version' );

delete_site_option( 'wphb-is-cloudflare' );
delete_site_option( 'wphb-quick-setup' );