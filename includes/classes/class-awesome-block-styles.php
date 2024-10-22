<?php
/**
 * Class responsible for managing...
 *
 * @package GatherPress_Awesome
 * @since 1.0.0
 */

namespace GatherPress_Awesome;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

use GatherPress\Core\Traits\Singleton;

/**
 * 
 *
 * @since 1.0.0
 */
class Awesome_Block_Styles {
	/**
	 * Enforces a single instance of this class.
	 */
	use Singleton;

	/**
	 * Class constructor.
	 *
	 * This method initializes the object and sets up necessary hooks.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->setup_hooks();
	}

	/**
	 * 
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function setup_hooks(): void {
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * 
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init(): void {

        /**
         * Variant 1 - using JSON partials
         */
        register_block_style(
            'core/details',
            array(
                'name'       => 'variant-colored',
                'label'      => __( 'Colored', 'themeslug' ),
                'style_data' => array(
                    'color' => array(
                        'background' => 'var:preset|color|contrast',
                        'text'       => 'var:preset|color|primary'
                    )
                )
            )
        );

        /**
         * Variant 2 - using inline CSS
         */
        register_block_style(
            'core/details',
            array(
                'name'         => 'variant-inline',
                'label'        => __( 'Inline', 'textdomain' ),
                'inline_style' => '.wp-block-details.is-style-variant-inline {
                    max-width: fit-content;
                }',
            )
        );

        /**
         * Variant 2.2 - Changing the marker color using inline CSS
         */
        register_block_style(
            'core/details',
            array(
                'name'         => 'variant-marker',
                'label'        => __( 'Marker', 'textdomain' ),
                'inline_style' => '.wp-block-details.is-style-variant-marker summary::marker{
                    color: var(--wp--preset--color--contrast,#e162bf);
                    font-size: 1.2em;
                }',
            )
        );

        /**
         * Variant 2.3 - using inline CSS
     
        register_block_style(
            'core/details',
            array(
                'name'         => 'variant-marker',
                'label'        => __( 'Marker', 'textdomain' ),
                'inline_style' => '.wp-block-details.is-style-variant-marker summary::marker{
                    color: var(--wp--preset--color--contrast,#e162bf);
                    font-size: 1.2em;
                }',
            )
        );    */







        /**
         * Variant 3.1 - Changing the marker icon using a block-specific stylesheet
         */
        register_block_style(
            'core/details',
            array(
                'name'  => 'variant-change-marker',
                'label' => __( 'Changing Marker', 'themeslug' )
            )
        );
        wp_enqueue_block_style( 'core/details', array(
            'handle' => 'gatherpress-awesome-details',
            'src'    => plugins_url( 'assets/blocks/core-details.css', GATHERPRESS_AWESOME_CORE_FILE ),
            'path'   => GATHERPRESS_AWESOME_CORE_PATH . 'assets/blocks/core-details.css'
        ) );


        register_block_style(
            'core/details',
            array(
                'name'  => 'variant-animate',
                'label' => __( 'Animate', 'themeslug' )
            )
        );







        /**
         * Variant ....  using a block-specific stylesheet
         */
        register_block_style(
            'core/buttons',
            array(
                'name'  => 'group',
                'label' => __( 'Group', 'themeslug' )
            )
        );
        wp_enqueue_block_style( 'core/buttons', array(
            'handle' => 'gatherpress-awesome-buttons',
            'src'    => plugins_url( 'assets/blocks/core-buttons.css', GATHERPRESS_AWESOME_CORE_FILE ),
            'path'   => GATHERPRESS_AWESOME_CORE_PATH . 'assets/blocks/core-buttons.css'
        ) );
    }

}