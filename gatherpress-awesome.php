<?php
/**
 * Plugin Name:  GatherPress Awesome
 * Plugin URI:   https://gatherpress.org/
 * Description:  Powering Communities with WordPress.
 * Author:       The GatherPress Community
 * Author URI:   https://gatherpress.org/
 * Version:      1.0.0
 * Requires PHP: 7.4
 * Text Domain:  gatherpress-awesome
 * Domain Path:  /languages
 * License:      GPLv2 or later (license.txt)
 *
 * @package GatherPress_Awesome
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

// Constants.
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
 * This function hooks into the 'plugins_loaded' action to ensure that
 * the GatherPress_Awesome\Setup instance is created once all plugins are loaded,
 * only if the GatherPress plugin is active.
 *
 * @return void
 */
function gatherpress_awesome_setup(): void {
	if ( defined( 'GATHERPRESS_VERSION' ) ) {
		GatherPress_Awesome\Setup::get_instance();
	}

}
add_action( 'plugins_loaded', 'gatherpress_awesome_setup' );
