<?php
/**
 * @package Meta_Refresh
 * @version 1.0
 */
/*
Plugin Name: Meta Refresh
Plugin URI: https://github.com/noricumbo/Meta_Refresh
Description: Adds a refresh meta tag with a date function for refresh faster on weekends, if you need. <strong>Hecho por Los Maquiladores.</strong>
Author: Jorge Noricumbo (Hacemos Código)
Version: 1.0
Author URI: http://jorge.noricumbo.com
*/

$title_meta_refresh = __('Meta Refresh Settings');

function register_meta_refresh_settings() {

	register_setting( 'meta-refresh-settings-group', 'meta_refresh_weekdays', 'intval' );
	register_setting( 'meta-refresh-settings-group', 'meta_refresh_weekend', 'intval' ); 

} 

add_action( 'admin_init', 'register_meta_refresh_settings' );

function meta_refresh_menu() {
	
	global $title_meta_refresh;
	add_options_page( $title_meta_refresh, 'Meta Refresh', 'manage_options', 'meta-refresh.php', 'meta_refresh_settings');

}

add_action('admin_menu', 'meta_refresh_menu');

function meta_refresh_settings() {
	
	global $title_meta_refresh;
 	
 	if ( !current_user_can( 'manage_options' ) )  
 	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
	<div class="wrap">
		<?php screen_icon(); ?>

		<h2><?php echo esc_html( $title_meta_refresh ); ?></h2>
		
		<p><?php _e('Modify the number of seconds for each option:'); ?></p>
	
		<form method="post" action="options.php">
			<?php settings_fields( 'meta-refresh-settings-group' ); ?>

			<table class="form-table">
			
				<tr valign="top">
					<th scope="row">
						<label for="weekdays"><?php _e('Monday to Friday') ?></label>
					</th>
					<td>
						<input name="meta_refresh_weekdays" type="text" id="meta_refresh_weekdays" value="<?php form_option('meta_refresh_weekdays'); ?>" class="regular-text ltr" />
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="weekends"><?php _e('Weekend') ?></label>
					</th>
					<td>
						<input name="meta_refresh_weekend" type="text" id="meta_refresh_weekend" value="<?php form_option('meta_refresh_weekend'); ?>" class="regular-text ltr" />
					</td>
				</tr>
			
			</table>
			<?php do_settings_sections('meta-refresh'); ?>
			<?php submit_button(); ?>
		</form>

	</div>
<?php
 }

function meta_refresh() {

	$day = date('N');

	if( $day > 5)
	{
		$seconds = get_option('meta_refresh_weekend');
	}
	else
	{
		$seconds = get_option('meta_refresh_weekdays'); 
	}

	echo "<meta http-equiv=\"refresh\" content=\"$seconds\" day=\"$day\" />\r\n";

}

add_action('wp_head', 'meta_refresh');