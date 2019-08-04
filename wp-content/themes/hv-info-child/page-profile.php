<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HV_INFO
 */

get_header(); ?>


	<style>
		.Jumbotron {
			background-image: url('<?php echo get_template_directory_uri() ?>/images/main-banner.jpg');
		}
	</style>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="Jumbotron Jumbotron-directory">
				<h1 class="display-3 text-center">Company Profile</h1>
				<div class="Modal Modal-register">
					<?php echo do_shortcode( '[register_form]' ); ?>
				</div>
				<div class="Modal Modal-login">
					<?php echo do_shortcode( '[login_form]' ); ?>
			</div>
			</div>

			<div class="news-container">
				<div class="news-header">
					<h2 style="text-transform: uppercase;" class="text-left">Your Company info</h2>
					<div class="news-line"></div>
					<div class="pt-5 rcp_form-profile_container">

					<form class="rcp_form" id="featured_upload" method="post" action="<?php echo get_site_url() ?>/my-profile" enctype="multipart/form-data">
						<p><label for="company_name">Company Name</label><br />
						<input required type="text" id="company_name" value="" tabindex="1" size="50" name="company_name" />
						</p>
						<p><label class="rcp_form-logo_container-top color-black" for="my_image_upload">Company Logo</label><br/>
						<input class="rcp-form_button color-black rcp_form-logo_container-bottom" type="file" name="my_image_upload" id="my_image_upload" multiple="false" />
						</p>
						<input type="hidden" name="post_id" id="post_id" value="55" />

						<p><label for="service_type">Service Type</label><br />
							<select required id="service_type" name="service_type"">
								<option value="">--Select One--</option>
								<option value="Plumbin">Plumbing</option>
								<option value="Web Design">Web Design</option>
								<option value="Electrical">Electrical</option>
								<option value="HVAC">HVAC</option>
							</select>
						</p>

						<p><label for="address">Address</label><br />
						<input required type="text" id="address" value="" tabindex="1" size="50" name="address" />
						</p>

						<p><label for="city">City</label><br />
						<input required type="text" id="city" value="" tabindex="1" size="50" name="city" />
						</p>

						<p><label for="province">Province</label><br />
						<input required type="text" id="province" value="" tabindex="1" size="50" name="province" />
						</p>

						<p><label for="website">Website</label><br />
						<input required type="text" id="website" value="" tabindex="1" size="50" name="website" />
						</p>

						<p><label for="business_number">Business Number</label><br />
						<input required type="text" id="business_number" value="" tabindex="1" size="50" name="business_number" />
						</p>

						<p><label for="description">Content</label><br />
						<textarea required id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
						</p>
						<?php wp_nonce_field( 'my_image_upload', 'my_profile_upload_nonce' ); ?>
						<p class="rcp-form_button--container text-left">
						<input class="rcp-form_button medium-font-size" id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Submit" />
						</p>
						
					</form>

					<?php

						// Check that the nonce is valid, and the user can edit this post.
						if ( 
							isset( $_POST['my_profile_upload_nonce'], $_POST['post_id'] ) 
							&& wp_verify_nonce( $_POST['my_profile_upload_nonce'], 'my_image_upload' )
						) {
							// The nonce was valid and the user has the capabilities, it is safe to continue.
							if (isset ($_POST['company_name'])) {
								$title =  $_POST['company_name'];
							} else {
								echo 'Please enter a  Company Name';
							}
							if (isset ($_POST['description'])) {
								$description = $_POST['description'];
							} else {
								echo 'Please enter a Description';
							}
							// Create post
							$new_post = array(
								'post_title'    => $title,
								'post_content'  => $description,
								'post_status'   => 'publish',  
								'post_type' => 'profiles'
							);
							//save the new post
							$pid = wp_insert_post($new_post); 
							// Required for saving image
							require_once( ABSPATH . 'wp-admin/includes/image.php' );
							require_once( ABSPATH . 'wp-admin/includes/file.php' );
							require_once( ABSPATH . 'wp-admin/includes/media.php' );
							// Save image to media library
							$attachment_id = media_handle_upload( 'my_image_upload', $_POST['post_id'] );
							// Update ACF fields
							update_field('field_5d430d33408ff', $_POST['service_type'], $pid);
							update_field('field_5d430d21408fe', $attachment_id, $pid);
							update_field('field_5d430d3d40900', $_POST['address'], $pid);
							update_field('field_5d430d4340901', $_POST['city'], $pid);
							update_field('field_5d430d6940902', $_POST['province'], $pid);
							update_field('field_5d430d7d40903', $_POST['company_website'], $pid);
							update_field('field_5d430d8b40904', $_POST['business_number'], $pid);
							update_field('field_5d430da15f81b', $_POST['description'], $pid);

							if ( is_wp_error( $attachment_id ) ) {
								echo "<script>alert('There was an error uploading the Image')</script>";
							} 
							 
						}
					?>	
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
