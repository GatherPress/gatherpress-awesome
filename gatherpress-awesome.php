<?php
/**
 * Plugin Name:       GatherPress Awesome
 * Plugin URI:        https://gatherpress.org/
 * Description:       Powering Communities with WordPress.
 * Author:            The GatherPress Community
 * Author URI:        https://gatherpress.org/
 * Version:           1.0.0
 * Requires PHP:      7.4
 * Requires at least: 6.7
 * Requires Plugins:  gatherpress
 * Text Domain:       gatherpress-awesome
 * Domain Path:       /languages
 * License:           GNU General Public License v2.0 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package GatherPress_Awesome
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

// Bail when a sibling copy is already loaded (e.g., when WordPress includes a
// duplicate folder during activation).
if ( defined( 'GATHERPRESS_AWESOME_VERSION' ) ) {
	return;
}

define( 'GATHERPRESS_AWESOME_VERSION', current( get_file_data( __FILE__, array( 'Version' ), 'plugin' ) ) );
define( 'GATHERPRESS_AWESOME_CORE_PATH', __DIR__ );

/**
 * Adds the GatherPress_Awesome namespace to the autoloader.
 *
 * This function hooks into the 'gatherpress_autoloader' filter and adds the
 * GatherPress_Awesome namespace to the list of namespaces with its core path.
 *
 * @param array $namespace An associative array of namespaces and their paths.
 * @return array Modified array of namespaces and their paths.
 */
function gatherpress_awesome_autoloader( array $namespace ): array {
	$namespace['GatherPress_Awesome'] = GATHERPRESS_AWESOME_CORE_PATH;

	return $namespace;
}
add_filter( 'gatherpress_autoloader', 'gatherpress_awesome_autoloader' );

/**
 * Boots the GatherPress Awesome runtime.
 *
 * Hooked on `gatherpress_loaded`, which GatherPress fires only after its own
 * requirements check passes. That is deliberate: the GATHERPRESS_* constants
 * are defined *before* that check, so `defined( 'GATHERPRESS_VERSION' )` means
 * "GatherPress began loading", not "GatherPress loaded successfully". Booting on
 * the constant called into classes whose autoloader was never registered when
 * GatherPress bailed, fataling the whole site (issue #9).
 *
 * Registered at file-load time rather than inside a `plugins_loaded` callback:
 * GatherPress fires `gatherpress_loaded` from within its own `plugins_loaded`
 * callback, which is registered first, so a listener added inside ours would be
 * added after the action had already fired.
 *
 * @return void
 */
function gatherpress_awesome_setup(): void {
	GatherPress_Awesome\Setup::get_instance();
}
add_action( 'gatherpress_loaded', 'gatherpress_awesome_setup' );

/**
 * Surfaces why GatherPress Awesome is inert when GatherPress is absent.
 *
 * Stays on `plugins_loaded` because it must run in exactly the case where
 * `gatherpress_loaded` never fires.
 *
 * @return void
 */
function gatherpress_awesome_maybe_notify_missing_gatherpress(): void {
	if ( defined( 'GATHERPRESS_VERSION' ) ) {
		return;
	}

	add_action(
		'admin_notices',
		static function (): void {
			wp_admin_notice(
				esc_html__( 'GatherPress is not installed.', 'gatherpress-awesome' ),
				array( 'type' => 'error' )
			);
		}
	);
}
add_action( 'plugins_loaded', 'gatherpress_awesome_maybe_notify_missing_gatherpress' );

/**
 * Announce this plugin to GatherPress's coexistence guard.
 *
 * On `gatherpress_loaded` rather than `plugins_loaded`: the guard's listener is
 * registered by GatherPress during its own bootstrap, so the action is only
 * ever heard once GatherPress finished loading. Firing it on `plugins_loaded`
 * meant shouting into the void whenever GatherPress was absent or had bailed.
 *
 * @return void
 */
function gatherpress_awesome_register_coexistence_guard(): void {
	do_action( 'gatherpress_register_coexistence_guard', 'gatherpress-awesome', 'GatherPress Awesome', __FILE__ );
}
add_action( 'gatherpress_loaded', 'gatherpress_awesome_register_coexistence_guard' );
