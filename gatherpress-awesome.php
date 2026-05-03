<?php
/**
 * Plugin Name:      GatherPress Awesome
 * Plugin URI:       https://gatherpress.org/
 * Description:      Powering Communities with WordPress.
 * Author:           The GatherPress Community
 * Author URI:       https://gatherpress.org/
 * Version:          1.0.0
 * Requires PHP:     7.4
 * Requires Plugins: gatherpress
 * Text Domain:      gatherpress-awesome
 * Domain Path:      /languages
 * License:          GNU General Public License v2.0 or later
 * License URI:      https://www.gnu.org/licenses/gpl-2.0.html
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
 * Initializes the GatherPress Awesome setup.
 *
 * Boots the runtime once all plugins have loaded, but only when GatherPress
 * itself is present. Surfaces an admin notice when it isn't, so the failure
 * mode is visible instead of silent.
 *
 * @return void
 */
function gatherpress_awesome_setup(): void {
	if ( ! defined( 'GATHERPRESS_VERSION' ) ) {
		add_action(
			'admin_notices',
			static function (): void {
				?>
				<div class="notice notice-error">
					<p><?php esc_html_e( 'GatherPress is not installed.', 'gatherpress-awesome' ); ?></p>
				</div>
				<?php
			}
		);

		return;
	}

	GatherPress_Awesome\Setup::get_instance();
}
add_action( 'plugins_loaded', 'gatherpress_awesome_setup' );

/**
 * Announce this plugin to GatherPress's coexistence guard.
 *
 * Fired on `plugins_loaded` so the registration runs after every active
 * plugin has loaded — GatherPress's listener is then guaranteed to be in
 * place regardless of plugin order in the `active_plugins` option. When
 * GatherPress is not active, the action fires into the void — no fatal,
 * no side effect.
 *
 * @return void
 */
function gatherpress_awesome_register_coexistence_guard(): void {
	do_action( 'gatherpress_register_coexistence_guard', 'gatherpress-awesome', 'GatherPress Awesome', __FILE__ );
}
add_action( 'plugins_loaded', 'gatherpress_awesome_register_coexistence_guard' );
