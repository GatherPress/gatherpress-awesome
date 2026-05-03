<?php
/**
 * Uninstall GatherPress Awesome.
 *
 * WordPress runs this file when a user deletes the plugin from the Plugins
 * screen — not on deactivation, only on full uninstall. This is where any
 * data your companion plugin persisted should be cleaned up so deleting the
 * plugin truly removes its footprint from the database.
 *
 * Common things to delete here:
 *
 *   - `delete_option( 'your_option_key' );`
 *   - `delete_site_option( 'your_network_option_key' );` (multisite)
 *   - Custom post type entries via `wp_delete_post()` (use sparingly — many
 *     authors leave content alone on uninstall)
 *   - Custom tables via `$wpdb->query( "DROP TABLE …" )`
 *   - Scheduled cron events via `wp_clear_scheduled_hook()`
 *   - User meta via `delete_metadata( 'user', 0, 'your_meta_key', '', true )`
 *
 * On multisite, loop over every site with `get_sites()` /
 * `switch_to_blog()` / `restore_current_blog()` so per-site options get
 * cleaned across the network.
 *
 * The bare-minimum guard below ensures this file only ever runs from
 * WordPress's uninstall flow — never from a direct request.
 *
 * @package GatherPress_Awesome
 */

// Exit if accessed directly or not called from WordPress.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Add your cleanup here.
