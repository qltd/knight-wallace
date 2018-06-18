<?php
/**
 * Campaign Monitor integration.
 *
 * @since 1.0.0
 * @package WPFormsCampaignMonitor
 */
class WPForms_Campaign_Monitor extends WPForms_Provider {

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		$this->version  = WPFORMS_CAMPAIGN_MONITOR_VERSION;
		$this->name     = 'Campaign Monitor';
		$this->slug     = 'campaign-monitor';
		$this->priority = 14;
		$this->icon     = plugins_url( 'assets/images/addon-icon-campaign-monitor.png', __FILE__ );
	}

	/**
	 * Process and submit entry to provider.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields
	 * @param array $entry
	 * @param array $form_data
	 * @param int $entry_id
	 */
	public function process_entry( $fields, $entry, $form_data, $entry_id = 0 ) {

		// Only run if this form has a connections for this provider.
		if ( empty( $form_data['providers'][ $this->slug ] ) ) {
			return;
		}

		// Fire for each connection.
		foreach ( $form_data['providers'][ $this->slug ] as $connection ) :

			// Setup basic data.
			$account_id = $connection['account_id'];
			$list_id    = $connection['list_id'];
			$name_data  = explode( '.', $connection['fields']['fullname'] );
			$email_data = explode( '.', $connection['fields']['email'] );
			$data       = array(
				'Name'         => $fields[ $name_data[0] ]['value'],
				'EmailAddress' => $fields[ $email_data[0] ]['value'],
				'CustomFields' => array(),
				'Resubscribe'  => true, // Set to false, won't subscribe even new email addresses to CM?
			);
			$api        = $this->api_connect( $account_id );

			// Bail if there is any sort of issues with the API connection.
			if ( is_wp_error( $api ) ) {
				continue;
			}

			// Email is required.
			if ( empty( $data['EmailAddress'] ) ) {
				continue;
			}

			// Check for conditionals.
			$pass = $this->process_conditionals( $fields, $entry, $form_data, $connection );
			if ( ! $pass ) {
				wpforms_log(
					'Campaign Monitor Subscription stopped by conditional logic',
					$fields,
					array(
						'type'    => array( 'provider', 'conditional_logic' ),
						'parent'  => $entry_id,
						'form_id' => $form_data['id'],
					)
				);
				continue;
			}

			// Setup the custom fields.
			foreach ( $connection['fields'] as $name => $custom_field ) {

				// Skip fullname and email fields, as these aren't custom fields.
				if ( $name === 'fullname' || $name === 'email' ) {
					continue;
				}

				// If the custom field isn't map, skip it.
				if ( empty( $custom_field ) ) {
					continue;
				}

				$custom_field = explode( '.', $custom_field );
				$id           = $custom_field[0];
				$key          = ! empty( $custom_field[1] ) ? $custom_field[1] : 'value';

				// Check if mapped form field has a value.
				if ( empty( $fields[ $id ] [ $key ] ) ) {
					continue;
				}

				$value = $fields[ $id ][ $key ];

				// Add the custom field to the array.
				// Square brackets are stripped from our custom field keys somewhere in WPForms.
				// As [] are used for all Campaign Monitor custom fields, so we reinstate them on the key here.
				$data['CustomFields'][] = array(
					'Key'   => '[' . $name . ']',
					'Value' => $value,
				);
			}

			// Submit to API.
			try {
				$this->api[ $account_id ]->subscribe( $list_id, $data );
			} catch ( Exception $e ) {
				wpforms_log(
					'Campaign Monitor Subscription error',
					$e->getMessage(),
					array(
						'type'    => array( 'provider', 'error' ),
						'parent'  => $entry_id,
						'form_id' => $form_data['id'],
					)
				);
			}

		endforeach;
	}

	/************************************************************************
	 * API methods - these methods interact directly with the provider API. *
	 ************************************************************************/

	/**
	 * Authenticate with the API.
	 *
	 * @param array $data
	 * @param string $form_id
	 *
	 * @return mixed id or WP_Error object.
	 */
	public function api_auth( $data = array(), $form_id = '' ) {

		if ( ! class_exists( 'Campaign_Monitor' ) ) {
			require_once plugin_dir_path( __FILE__ ) . '/vendor/campaign-monitor.php';
		}

		// Connect via API.
		$api = new Campaign_Monitor( $data['apikey'], $data['client_id'] );

		// Test the API Key by getting lists for the given API Key and Client.
		try {
			$api->get_lists();
		} catch ( Exception $e ) {
			wpforms_log(
				'Campaign Monitor API error',
				$e->getMessage(),
				array(
					'type'    => array( 'provider', 'error' ),
					'form_id' => $form_id['id'],
				)
			);

			return $this->error( 'API authorization error: ' . $e->getMessage() );
		}

		$id                              = uniqid();
		$providers                       = get_option( 'wpforms_providers', array() );
		$providers[ $this->slug ][ $id ] = array(
			'api'       => trim( $data['apikey'] ),
			'label'     => sanitize_text_field( $data['label'] ),
			'client_id' => sanitize_text_field( $data['client_id'] ),
			'date'      => time(),
		);
		update_option( 'wpforms_providers', $providers );

		return $id;
	}

	/**
	 * Establish connection object to API.
	 *
	 * @since 1.0.0
	 *
	 * @param string $account_id
	 *
	 * @return mixed array or WP_Error object.
	 */
	public function api_connect( $account_id ) {

		if ( ! class_exists( 'Campaign_Monitor' ) ) {
			require_once plugin_dir_path( __FILE__ ) . '/vendor/campaign-monitor.php';
		}

		if ( ! empty( $this->api[ $account_id ] ) ) {
			return $this->api[ $account_id ];
		} else {
			$providers = get_option( 'wpforms_providers' );
			if ( ! empty( $providers[ $this->slug ][ $account_id ]['api'] ) ) {
				$this->api[ $account_id ] = new Campaign_Monitor( $providers[ $this->slug ][ $account_id ]['api'], $providers[ $this->slug ][ $account_id ]['client_id'] );
				return $this->api[ $account_id ];
			} else {
				return $this->error( 'API error' );
			}
		}
	}

	/**
	 * Retrieve provider account lists.
	 *
	 * @since 1.0.0
	 *
	 * @param string $connection_id
	 * @param string $account_id
	 *
	 * @return mixed array or WP_Error object.
	 */
	public function api_lists( $connection_id = '', $account_id = '' ) {

		$this->api_connect( $account_id );

		try {
			$lists = $this->api[ $account_id ]->get_lists();

			return $lists;
		} catch ( Exception $e ) {
			wpforms_log(
				'Campaign Monitor API error',
				$e->getMessage(),
				array(
					'type' => array( 'provider', 'error' ),
				)
			);

			return $this->error( 'API list error: ' . $e->getMessage() );
		}
	}

	/**
	 * Retrieve provider account list groups.
	 *
	 * @since 1.0.0
	 *
	 * @param string $connection_id
	 * @param string $account_id
	 * @param string $list_id
	 *
	 * @return mixed array or error object.
	 */
	public function api_groups( $connection_id = '', $account_id = '', $list_id = '' ) {

		// Need to return an error otherwise all hell breaks loose.
		// CM doesn't have a concept of 'groups'.
		return new WP_Error( esc_html__( 'Groups do not exist.', 'wpforms-campaign-monitor' ) );
	}

	/**
	 * Retrieve provider account list fields.
	 *
	 * @since 1.0.0
	 *
	 * @param string $connection_id
	 * @param string $account_id
	 * @param string $list_id
	 *
	 * @return mixed array or WP_Error object.
	 */
	public function api_fields( $connection_id = '', $account_id = '', $list_id = '' ) {

		$this->api_connect( $account_id );

		try {
			// Get Custom Fields for the List from the API.
			$fields = $this->api[ $account_id ]->get_list_custom_fields( $list_id );

			// Prepend the Name and Email Fields to the list, as these aren't included in the custom fields API call.
			$default_fields = array(
				array(
					'name'       => 'Full Name',
					'req'        => false,
					'tag'        => 'fullname',
					'field_type' => 'text',
				),
				array(
					'name'       => 'Email',
					'req'        => true,
					'tag'        => 'email',
					'field_type' => 'email',
				),
			);

			return array_merge( $default_fields, $fields );
		} catch ( Exception $e ) {
			wpforms_log(
				'Campaign Monitor API error',
				$e->getMessage(),
				array(
					'type' => array( 'provider', 'error' ),
				)
			);

			return $this->error(
				sprintf(
					/* translators: %s - API error message. */
					esc_html__( 'API fields error: %s', 'wpforms-campaign-monitor' ),
					$e->getMessage()
				)
			);
		}
	}

	/*************************************************************************
	 * Output methods - these methods generally return HTML for the builder. *
	 *************************************************************************/

	/**
	 * Provider account authorize fields HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function output_auth() {

		$providers = get_option( 'wpforms_providers' );
		$class     = ! empty( $providers[ $this->slug ] ) ? 'hidden' : '';

		$output = '<div class="wpforms-provider-account-add ' . $class . ' wpforms-connection-block">';

		$output .= '<h4>' . esc_html__( 'Add New Account', 'wpforms-campaign-monitor' ) . '</h4>';

		$output .= sprintf(
			'<input type="text" data-name="apikey" placeholder="%s" class="wpforms-required">',
			sprintf(
				/* translators: %s - current provider name. */
				esc_html__( '%s API Key', 'wpforms-campaign-monitor' ),
				$this->name
			)
		);

		$output .= sprintf(
			'<input type="text" data-name="client_id" placeholder="%s" class="wpforms-required">',
			sprintf(
				/* translators: %s - current provider name. */
				esc_html__( '%s Client ID', 'wpforms-campaign-monitor' ),
				$this->name
			)
		);

		$output .= sprintf(
			'<input type="text" data-name="label" placeholder="%s" class="wpforms-required">',
			sprintf(
				/* translators: %s - current provider name. */
				esc_html__( '%s Account Nickname', 'wpforms-campaign-monitor' ),
				$this->name
			)
		);

		$output .= sprintf( '<button data-provider="%s">%s</button>', esc_attr( $this->slug ), esc_html__( 'Connect', 'wpforms-campaign-monitor' ) );

		$output .= '</div>';

		return $output;
	}

	/**
	 * Provider account list options HTML.
	 *
	 * @since 1.0.0
	 *
	 * @param string $connection_id
	 * @param array $connection
	 *
	 * @return string
	 */
	public function output_options( $connection_id = '', $connection = array() ) {

		// Double opt in and a welcome email are defined in the List options on Campaign Monitor.
		// They can't be controlled via the API.
		return '';
	}

	/*************************************************************************
	 * Integrations tab methods - these methods relate to the settings page. *
	 *************************************************************************/

	/**
	 * Form fields to add a new provider account.
	 *
	 * @since 1.0.0
	 */
	public function integrations_tab_new_form() {

		printf(
			'<input type="text" name="apikey" placeholder="%s">',
			sprintf(
				/* translators: %s - current provider name. */
				esc_html__( '%s API Key', 'wpforms-campaign-monitor' ),
				$this->name
			)
		);

		printf(
			'<input type="text" name="client_id" placeholder="%s">',
			sprintf(
				/* translators: %s - current provider name. */
				esc_html__( '%s Client ID', 'wpforms-campaign-monitor' ),
				$this->name
			)
		);

		printf(
			'<input type="text" name="label" placeholder="%s">',
			sprintf(
				/* translators: %s - current provider name. */
				esc_html__( '%s Account Nickname', 'wpforms-campaign-monitor' ),
				$this->name
			)
		);
	}
}

new WPForms_Campaign_Monitor;
