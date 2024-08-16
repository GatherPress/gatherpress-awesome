<?php
/**
 * Manages plugin setup for GatherPress Awesome.
 *
 * @package GatherPress_Awesome
 */

namespace GatherPress_Awesome;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

use GatherPress\Core\Traits\Singleton;

/**
 * Class Setup.
 *
 * Manages plugin setup and initialization.
 */
class Setup {
	/**
	 * Enforces a single instance of this class.
	 */
	use Singleton;

	/**
	 * Constructor for the Setup class.
	 *
	 * Initializes and sets up various components of the plugin.
	 */
	protected function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Set up hooks for various purposes.
	 *
	 * This method adds hooks for different purposes as needed.
	 *
	 * @return void
	 */
	protected function setup_hooks(): void {
		add_action( 'gatherpress_sub_pages', array( $this, 'setup_sub_page' ) );
	}

	/**
	 * Adds a sub-page for GatherPress Alpha to the existing sub-pages array.
	 *
	 * This function modifies the provided sub-pages array to include a new sub-page
	 * for GatherPress Alpha with specified details such as name, priority, and sections.
	 *
	 * @param array $sub_pages An associative array of existing sub-pages.
	 * @return array Modified array of sub-pages including the GatherPress Alpha sub-page.
	 */
	public function setup_sub_page( array $sub_pages ): array {
		$sub_pages['awesome'] = array(
			'name'     => __( 'Awesome', 'gatherpress-awesome' ),
			'priority' => 10,
			'sections' => array(
				'awesome_it_works' => array(
					'name'        => __( 'Awesome', 'gatherpress-awesome' ),
					'description' => __( 'GatherPress Awesome works!', 'gatherpress-awesome' ),
				),
			),
		);

		return $sub_pages;
	}
}
