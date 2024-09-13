<?php
/**
 * Class responsible for managing calendar-related endpoints in GatherPress.
 *
 * This file defines the `Calendar_Endpoints` class, which is responsible for
 * registering and managing custom endpoints related to calendar functionality,
 * such as export to third-party calendars and iCal download.
 *
 * It utilizes the `Posttype_Single_Endpoint` class to create endpoints
 * for single calendar events and provides logic for the external redirect.
 *
 * @package GatherPress_Awesome
 * @since 1.0.0
 */

namespace GatherPress_Awesome;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit; // @codeCoverageIgnore

use GatherPress\Core\Endpoints\Posttype_Single_Endpoint;
use GatherPress\Core\Endpoints\Endpoint_Redirect;
use GatherPress\Core\Traits\Singleton;
use GatherPress\Core\Event;

/**
 * Manages Custom Calendar Endpoints for GatherPress.
 *
 * The `Awesome_Endpoints` class handles the registration and management of
 * custom endpoints for calendar-related functionality in GatherPress, such as:
 * - Adding LinkedIn- and Office-365-Calendar export links for events.
 * - eRSS template, endpoint and head-links for events.
 *
 * @since 1.0.0
 */
class Awesome_Endpoints {
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
	 * Set up hooks for registering custom calendar endpoints.
	 *
	 * This method hooks into the `registered_post_type_{post_type}` action to ensure that
	 * the custom endpoints for the `gatherpress_event` post type are registered after the
	 * post type is initialized.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function setup_hooks(): void {
		add_action(
			sprintf(
				'registered_post_type_%s',
				'gatherpress_event'
			),
			array( $this, 'init_events' ),
		);
	}

	/**
	 * Initializes the custom calendar endpoints for single events.
	 *
	 * This method sets up a `Posttype_Single_Endpoint` for the `gatherpress_event` post type
	 * (because this is this class' default post type),and adding custom endpoints
	 * for external calendar services (Office 365 Calendar).
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init_events(): void {
		new Posttype_Single_Endpoint(
			array(
				new Endpoint_Redirect(
					'office365-calendar',
					array( $this, 'get_redirect_to' )
				),
			),
			'gatherpress_awesome_calendar',
		);
	}

	/**
	 * Returns the external calendar URL for the current event.
	 *
	 * This method generates the appropriate URL for Office365,
	 * depending on the value of the `gatherpress_awesome_calendar` query variable. It uses the
	 * `Event` class to retrieve the necessary data for the event.
	 *
	 * @since 1.0.0
	 *
	 * @return string The URL to redirect the user to the appropriate calendar service.
	 */
	public function get_redirect_to(): string {
		$event = new Event( get_queried_object_id() );
		// Determine which calendar service to redirect to based on the query var.
		switch ( get_query_var( 'gatherpress_awesome_calendar' ) ) {
			case 'office365-calendar':
				return $this->get_office365_calendar_link( $event );
		}
	}

	public function get_office365_calendar_link( Event $event ): string {
		$date_start  = $event->get_formatted_datetime( 'Ymd', 'start', false );
		$time_start  = $event->get_formatted_datetime( 'His', 'start', false );
		$date_end    = $event->get_formatted_datetime( 'Ymd', 'end', false );
		$time_end    = $event->get_formatted_datetime( 'His', 'end', false );
		
		// Format the start and end datetime in the required format
		$startdt = sprintf( '%sT%sZ', $date_start, $time_start );
		$enddt   = sprintf( '%sT%sZ', $date_end, $time_end );
		
		$venue       = $event->get_venue_information();
		$location    = $venue['name'];
		$description = $event->get_calendar_description();
	
		if ( ! empty( $venue['full_address'] ) ) {
			$location .= sprintf( ', %s', $venue['full_address'] );
		}
	
		$params = array(
			'subject'   => sanitize_text_field( $event->event->post_title ),
			'body'      => sanitize_text_field( $description ),
			'startdt'   => $startdt,
			'enddt'     => $enddt,
			'location'  => sanitize_text_field( $location ),
			'path'      => '/calendar/action/compose',
			'rru'       => 'addevent',
		);
	
		return add_query_arg(
			rawurlencode_deep( $params ),
			'https://outlook.office.com/calendar/0/deeplink/compose'
		);
	}
}
