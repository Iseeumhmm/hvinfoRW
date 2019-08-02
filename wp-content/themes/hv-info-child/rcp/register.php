<?php
/**
 * Registration Form
 *
 * This template is used to display the registration form with [register_form] If the `id` attribute
 * is passed into the shortcode then register-single.php is used instead.
 * @link http://docs.restrictcontentpro.com/article/1597-registerform
 *
 * For modifying this template, please see: http://docs.restrictcontentpro.com/article/1738-template-files
 *
 * @package     Restrict Content Pro
 * @subpackage  Templates/Register
 * @copyright   Copyright (c) 2017, Restrict Content Pro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

global $rcp_options, $post, $rcp_levels_db, $rcp_register_form_atts;
$discount = ! empty( $_REQUEST['discount'] ) ? sanitize_text_field( $_REQUEST['discount'] ) : '';
?>

<?php if( ! is_user_logged_in() ) { ?>
	<h3 class="rcp_header mt-3 text-center">
		<?php echo apply_filters( 'rcp_registration_header_logged_out', $rcp_register_form_atts['logged_out_header'] ); ?>
	</h3>
<?php } else { ?>
	<h3 class="rcp_header mt-3 text-center">
		You're already registered and Ready to go!
		<!-- <?php echo apply_filters( 'rcp_registration_header_logged_in', $rcp_register_form_atts['logged_in_header'] ); ?> -->
	</h3>
<?php }

// show any error messages after form submission
rcp_show_error_messages( 'register' ); ?>
<form id="rcp_registration_form" class="rcp_form" method="POST" action="<?php echo esc_url( rcp_get_current_url() ); ?>">

	<?php if( ! is_user_logged_in() ) { ?>

	<div class="rcp_login_link text-center">
		<p>Please choose the type of membership</p>
		<!-- <p><?php printf( __( '<a href="%s">Log in</a> to renew or change an existing membership.', 'rcp' ), esc_url( rcp_get_login_url( rcp_get_current_url() ) ) ); ?></p> -->
	</div>

	<?php do_action( 'rcp_before_register_form_fields' ); ?>

	<!-- Choose Subscription Type -->
	<fieldset class="rcp_subscription_fieldset">
	<?php
	$levels = rcp_get_subscription_levels( 'active' );
	$i      = 0;
	if( $levels ) : ?>
		<?php if ( count( $levels ) > 1 ) : ?>
			
		<?php endif; ?>
		<ul id="rcp_subscription_levels">
			<div class="container">
				<div class="row rcp-form_row">
					<?php 
						$justification="text-left";
						foreach( $levels as $key => $level ) : ?>
						<?php if( rcp_show_subscription_level( $level->id ) ) :
							$has_trial = $rcp_levels_db->has_trial( $level->id );
						?>
						<div class="col-6 <?php echo $justification; ?>">
							<li class="rcp_subscription_level rcp_subscription_level_<?php echo $level->id; ?>">
								<input type="radio" id="rcp_subscription_level_<?php echo $level->id; ?>" class="required rcp_level" <?php if ( $i == 0 || ( isset( $_GET['level'] ) && $_GET['level'] == $level->id ) ) { echo 'checked="checked"'; } ?> name="rcp_level" rel="<?php echo esc_attr( $level->price ); ?>" value="<?php echo esc_attr( absint( $level->id ) ); ?>" <?php if( $level->duration == 0 ) { echo 'data-duration="forever"'; } if ( ! empty( $has_trial ) ) { echo 'data-has-trial="true"'; } ?>/>
								<label for="rcp_subscription_level_<?php echo $level->id; ?>">
									<!-- Selection Labels -->
									<span class="rcp_subscription_level_name"><?php echo rcp_get_subscription_name( $level->id ); ?></span><span class="rcp_separator">&nbsp;-&nbsp;</span><span class="rcp_price" rel="<?php echo esc_attr( $level->price ); ?>"><?php echo $level->price > 0 ? rcp_currency_filter( $level->price ) : __( 'free', 'rcp' ); ?></span>
									<!-- Selection Prices Label -->
									<?php if ( ! empty( $level->maximum_renewals ) ) : ?>
										<span class="rcp_separator">&nbsp;-&nbsp;</span>
										<span class="rcp_level_bill_times"><?php printf( __( '%d total payments', 'rcp' ), $level->maximum_renewals + 1 ); ?></span>
									<?php endif; ?>
									<!-- Selection sub title -->
									<!-- <div class="rcp_level_description"> <?php echo rcp_get_subscription_description( $level->id ); ?></div> -->
								</label>
							</li>
						</div>
						<?php $i++; 
							if ( $justification === "text-left" ) {
								$justification="text-right";
							} else {
								$justification="text-left";
							}
							endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		</ul>
	<?php else : ?>
		<p><strong><?php _e( 'You have not created any membership levels yet', 'rcp' ); ?></strong></p>
	<?php endif; ?>
	</fieldset>

	<fieldset class="rcp_user_fieldset">
		<p id="rcp_user_login_wrap">
			<label for="rcp_user_login"><?php echo apply_filters ( 'rcp_registration_username_label', __( 'Username', 'rcp' ) ); ?></label>
			<input name="rcp_user_login" id="rcp_user_login" class="required" type="text" <?php if( isset( $_POST['rcp_user_login'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_login'] ) . '"'; } ?>>&nbsp&nbsp<span class="asterisk">*</span></input>
		</p>
		<p id="rcp_user_email_wrap">
			<label for="rcp_user_email"><?php echo apply_filters ( 'rcp_registration_email_label', __( 'Email', 'rcp' ) ); ?></label>
			<input name="rcp_user_email" id="rcp_user_email" class="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" type="email" <?php if( isset( $_POST['rcp_user_email'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_email'] ) . '"'; } ?>/>&nbsp&nbsp<span class="asterisk">*</span>
		</p>
		<p id="rcp_user_first_wrap">
			<label for="rcp_user_first"><?php echo apply_filters ( 'rcp_registration_firstname_label', __( 'First Name', 'rcp' ) ); ?></label>
			<input name="rcp_user_first" id="rcp_user_first" type="text" <?php if( isset( $_POST['rcp_user_first'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_first'] ) . '"'; } ?>>&nbsp&nbsp<span class="asterisk">*</span></input>
		</p>
		<p id="rcp_user_last_wrap">
			<label for="rcp_user_last"><?php echo apply_filters ( 'rcp_registration_lastname_label', __( 'Last Name', 'rcp' ) ); ?></label>
			<input name="rcp_user_last" id="rcp_user_last" type="text" <?php if( isset( $_POST['rcp_user_last'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_last'] ) . '"'; } ?>>&nbsp&nbsp<span class="asterisk">*</span></input>
		</p>
		<p id="rcp_password_wrap">
			<label for="rcp_password"><?php echo apply_filters ( 'rcp_registration_password_label', __( 'Password', 'rcp' ) ); ?></label>
			<input name="rcp_user_pass" id="rcp_password" class="required" type="password">&nbsp&nbsp<span class="asterisk">*</span></input>
		</p>
		<p id="rcp_password_again_wrap">
			<label for="rcp_password_again"><?php echo apply_filters ( 'rcp_registration_password_again_label', __( 'Password Again', 'rcp' ) ); ?></label>
			<input name="rcp_user_pass_confirm" id="rcp_password_again" class="required" type="password">&nbsp&nbsp<span class="asterisk">*</span></input>
		</p>

		<?php do_action( 'rcp_after_password_registration_field' ); ?>

	</fieldset>
	<?php } ?> 

	<!-- <?php do_action( 'rcp_before_subscription_form_fields' ); ?>  -->

	

	
	<!-- Current Selection Display -->
	<!-- <?php do_action( 'rcp_after_register_form_fields', $levels ); ?> -->
	<?php if( ! is_user_logged_in() ) { ?>
	<p class="rcp-form_button--container" id="rcp_submit_wrap">
		<input type="hidden" name="rcp_register_nonce" value="<?php echo wp_create_nonce('rcp-register-nonce' ); ?>"/>
		<input type="submit"  name="rcp_submit_registration" id="rcp_submit" onClick="checkValidation();" class="rcp-button rcp-form_button" value="<?php esc_attr_e( apply_filters ( 'rcp_registration_register_button', __( 'Register', 'rcp' ) ) ); ?>"/>
	</p>
	<?php } else { ?>
		<div class="cp-form_button--container w-100 text-center">
			<button class="rcp-button rcp-form_button text-center">Go Back</button>
		</div>
	<?php } ?>
</form>
