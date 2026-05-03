<?php
/**
 * Uninstall GatherPress Awesome.
 *
 * Removes all plugin data from the database when the plugin is uninstalled.
 * Replace the placeholder option name(s) below with whatever your companion
 * plugin actually persists, or remove this file if you never write options.
 *
 * @package GatherPress_Awesome
 */

// Exit if accessed directly or not called from WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete plugin options.
 */
delete_option( 'gatherpress_awesome_example' );

/**
 * For multisite installations, delete the option from all sites.
 */
if ( is_multisite() ) {
	global $wpdb;

	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );

	foreach ( $blog_ids as $blog_id ) {
		switch_to_blog( $blog_id );
		delete_option( 'gatherpress_awesome_example' );
		restore_current_blog();
	}
}
