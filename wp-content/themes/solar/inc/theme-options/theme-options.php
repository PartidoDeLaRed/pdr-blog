<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

function theme_options_init(){
	register_setting( 'sample_options', 'solar_options' );
}

function theme_options_add_page() {
	add_theme_page( __( 'solar Options', 'wordpress-solar' ), __( 'Solar Options', 'wordpress-solar' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#color_picker_color1').farbtastic('#color1');            
		});
	</script>
	
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . wp_get_theme() .' ' . __( 'Options', 'wordpress-solar' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'wordpress-solar' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'sample_options' ); ?>
			<?php $options = get_option( 'solar_options' ); 
				  if( ! is_null( $options['color'] ) && '' != $options['color'] )
				  	$color = esc_attr( $options['color'] );
				  else
				  	$color = '#ff0000';
			?>

			<table class="form-table">
					<tr>
						<th><?php _e( 'Your name', 'wordpress-solar' ); ?></th>
						<td>
							<input class="regular-text" type="text" name="solar_options[theme_username]" value="<?php esc_attr_e( $options['theme_username'] ); ?>" />
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Twitter Username', 'wordpress-solar' ); ?></th>
						<td>
							@<input class="regular-text" type="text" name="solar_options[twitter_username]" value="<?php esc_attr_e( $options['twitter_username'] ); ?>" />
						</td>
					</tr>
					<tr>
						<th><?php _e( 'Github Username', 'wordpress-solar' ); ?></th>
						<td>
							<input class="regular-text" type="text" name="solar_options[github_username]" value="<?php esc_attr_e( $options['github_username'] ); ?>" />
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Contact Email', 'wordpress-solar' ); ?></th>
						<td>
							<input class="regular-text" type="text" name="solar_options[contact_email]" value="<?php esc_attr_e( $options['contact_email'] ); ?>" />
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Biography', 'wordpress-solar' ); ?></th>
						<td>
		<textarea id="solar_options[biography]" class="small-text" cols="50" rows="10" style="height: 100px;" name="solar_options[biography]"><?php echo esc_textarea( $options['biography'] ); ?></textarea>
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Location', 'wordpress-solar' ); ?></th>
						<td><input class="regular-text" type="text" name="solar_options[location]" value="<?php esc_attr_e( $options['location'] ); ?>" /></td>
					</tr>

					<tr>
						<th><?php _e( 'Theme color', 'wordpress-solar' ); ?></th>
						<td>
							<input id="color1" class="regular-text" type="text" name="solar_options[color]" value="<?php echo $color; ?>" />
							<div id="color_picker_color1"></div>
						</td>
					</tr>

					<tr>
						<th><?php _e( 'Google Analytics // Typekit', 'wordpress-solar' ); ?></th>
						<td><textarea id="solar_options[google_analytics]" class="small-text" cols="50" rows="10" name="solar_options[google_analytics]"><?php echo esc_textarea( $options['google_analytics'] ); ?></textarea></td>
					</tr>
				</tbody>
			</table>
				
			
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'wordpress-solar' ); ?>" />
			</p>

		</form>
	</div>
	<?php
}

function theme_options_validate( $input ) {

	global $select_options, $radio_options;

	$input['color'] = wp_filter_nohtml_kses( $input['color'] );

	$input['google_analytics'] = $input['google_analytics'] ;

	return $input;
}

?>