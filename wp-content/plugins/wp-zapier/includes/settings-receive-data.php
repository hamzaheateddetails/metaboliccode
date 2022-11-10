<?php 
	global $wp;

	$settings = get_option( 'wp_zapier_settings' ); 

	$api_key = $settings['api_key'];

	$webhook_url = add_query_arg( array( 'wpz_webhook' => '1', 'api_key' => $api_key ), home_url( '/' ) );

	// Force HTTPS:// when generating URL.
	if ( is_ssl() ) {
		$webhook_url = apply_filters( 'wp_zapier_webhook_url',  str_replace( 'http://', 'https://', $webhook_url ) );
	}

?>
<?php require_once( 'settings-header.php' ); ?>


<div class="wrap">
	<h2><?php _e( 'Settings for Receiving Data', 'wp-zapier' ); ?></h2>
	<table class="form-table">
		<tbody>

			<tr>
				<th>
					<label for="wp_zapier_webhook_url"><?php _e( 'Webhook URL', 'wp-zapier'); ?></label>
				</th>
				<td>
					<input type='text' size='77' name='wp_zapier_webhook_url' value="<?php echo $webhook_url; ?>" readonly /><br/>
					<small><?php _e( 'Please copy entire URL when adding this to Zapier.', 'wp-zapier' ); ?></small>

				</td>
			</tr>

			<tr>
				<th>
					<label for="wp_zapier_webhook_api_key"><?php _e( 'API Key', 'wp-zapier'); ?></label>
				</th>
				<td>
					<input type='text' name='wp_zapier_webhook_api_key' size='40' value='<?php echo $api_key; ?>' readonly />
					<a href="<?php echo esc_url( add_query_arg( array( 'wpz_new_api_key' => 1, '_wpz_new_api_key' => wp_create_nonce( 'wpz_new_api_key' ) ), admin_url( 'admin.php?page=wp-zapier-settings' ) ) ); ?>"><button class="button-primary"><?php _e( 'Generate new API key', 'wp-zapier' ); ?></button></a>
					<br/><small><?php _e( 'Generating a new API key will require you to update any existing ZAPS.' , 'wp-zapier' ); ?></small>
				</td>
			</tr>

			<tr>
				<th colspan="2">
					<h2><?php _e( 'Available Actions', 'wp-zapier' ); ?></h2>
					<p style="font-weight:normal;"><?php _e( 'Below is a list of available actions when sending data from Zapier to WordPress.', 'wp-zapier' ); ?></p>
				</th>
			</tr>

			<tr>
				<th>

					<p><?php _e( 'create_user', 'wp-zapier'); ?></p>
				</th>
				<td>
					<p><strong><?php _e( 'Accepts', 'wp-zapier'); ?>: email*, username*, first_name, last_name, role, usermeta**</strong></p>
					<p><?php _e( 'Create a new user and send an email notification to both the user and site administrator.', 'wp-zapier' ); ?></p>
					<p><?php _e( "This will not create the user if the user's email exists inside WordPress and will be skipped.", "wp-zapier" ); ?></p>
				</td>
			</tr>

			<tr>
				<th>
					<p><?php _e( 'update_user', 'wp-zapier'); ?></p>
				</th>
				<td>
					<p><strong><?php _e( 'Accepts', 'wp-zapier'); ?>: email*, new_email, username, first_name, last_name, role, usermeta**</strong></p>
					<p><?php _e( 'Update existing user data via email.', 'wp-zapier' ); ?></p>
					<p><?php _e( "This will create a new user if the user's email does not exist.", "wp-zapier" ); ?></p>
				</td>
			</tr>

			<tr>
				<th>
					<p><?php _e( 'delete_user', 'wp-zapier'); ?></p>
				</th>
				<td>
					<p><strong><?php _e( 'Accepts', 'wp-zapier'); ?>: email*, username</strong></p>
					<p><?php _e( 'Delete an existing user from WordPress which will delete all their usermeta.', 'wp-zapier' ); ?></p>
				</td>
			</tr>

			<tr>
				<th>
					<p><?php _e( 'custom', 'wp-zapier'); ?></p>
				</th>
				<td>
					<p><strong><?php _e( 'Used for custom integrations', 'wp-zapier'); ?></strong></p>
					<p><?php _e( sprintf( 'This is used for developers to integrate custom functions. %s', "<a href='" . esc_url( 'https://yoohooplugins.com/documentation/using-wp-zapier-custom-webhook' ) . "' target='_blank'>See this guide.</a>" ), 'wp-zapier' ); ?></p>
				</td>
			</tr>

		</tbody>
	</table>
</div>

<p><small>* <?php _e( 'Required fields.', 'wp-zapier' ); ?></small></p>
<p><small>** <?php _e( sprintf( 'Please see %s for the layout needed for usermeta fields.', '<a href="https://yoohooplugins.com/documentation/add-user-meta-wp-zapier/?utm-source=plugin" target="_blank" rel="noopener nofollow">documentation</a>' ), 'wp-zapier' );?></small></p>
