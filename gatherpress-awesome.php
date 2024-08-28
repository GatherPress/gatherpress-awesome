<?php
/**
 * Plugin Name:  GatherPress project_name
 * Plugin URI:   https://gatherpress.org/
 * Description:  Powering Communities with WordPress.
 * Author:       The GatherPress Community
 * Author URI:   https://gatherpress.org/
 * Version:      1.0.0
 * Requires PHP: 7.4
 * Text Domain:  project_urlname
 * License:      GPLv2 or later (license.txt)
 *
 * @package GatherPress_project_urlname
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

// Constants.
define( 'GATHERPRESS_AWESOME_VERSION', current( get_file_data( __FILE__, array( 'Version' ), 'plugin' ) ) );
define( 'GATHERPRESS_AWESOME_CORE_PATH', __DIR__ );

/**
 * Adds the GatherPress_project_urlname namespace to the autoloader.
 *
 * This function hooks into the 'gatherpress_autoloader' filter and adds the
 * GatherPress_project_urlname namespace to the list of namespaces with its core path.
 *
 * @param array $namespace An associative array of namespaces and their paths.
 * @return array Modified array of namespaces and their paths.
 */
function gatherpress_project_urlname_autoloader( array $namespace ): array {
	$namespace['GatherPress_project_urlname'] = GATHERPRESS_AWESOME_CORE_PATH;

	return $namespace;
}
add_filter( 'gatherpress_autoloader', 'gatherpress_project_urlname_autoloader' );

/**
 * Initializes the GatherPress project_name setup.
 *
 * This function hooks into the 'plugins_loaded' action to ensure that
 * the GatherPress_project_urlname\Setup instance is created once all plugins are loaded,
 * only if the GatherPress plugin is active.
 *
 * @return void
 */
function gatherpress_project_urlname_setup(): void {
	if ( defined( 'GATHERPRESS_VERSION' ) ) {
		GatherPress_project_urlname\Setup::get_instance();
	}

}
add_action( 'plugins_loaded', 'gatherpress_project_urlname_setup' );
