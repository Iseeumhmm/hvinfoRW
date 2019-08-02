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
					<div class="pt-5">
						<!-- New Profile Form -->
						<div>
						<form id="new_profile" name="new_profile" method="post" action="">
							<p><label for="company_name">Company Name</label><br />
							<input required type="text" id="company_name" value="" tabindex="1" size="50" name="company_name" />
							</p>

							<p><label for="logo">Company Logo</label><br />
							<input type="file" id="logo" tabindex="1" size="50" name="logo">
							</p>

							<p><label for="service_type">Service Type</label><br />
							<input required type="text" id="service_type" value="" tabindex="1" size="50" name="service_type" />
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

							<!-- Description -->
							<p><label for="description">Content</label><br />
							<textarea required id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
							</p>

							<?php wp_nonce_field( 'new-post' ); ?>
							<input type="submit" name="action" value="new_post" />
							<?php
								if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

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
								$new_post = array(
									'post_title'    => $title,
									'post_content'  => $description,
									'post_status'   => 'publish',  
									'post_type' => 'profiles'
								);
								//save the new post
								$pid = wp_insert_post($new_post); 
								echo var_dump( $POST['logo']);
								update_field('field_5d430d33408ff', $_POST['service_type'], $pid);
								update_field('field_5d430d21408fe', $_POST['logo'], $pid);
								update_field('field_5d430d3d40900', $_POST['address'], $pid);
								update_field('field_5d430d4340901', $_POST['city'], $pid);
								update_field('field_5d430d6940902', $_POST['province'], $pid);
								update_field('field_5d430d7d40903', $_POST['company_website'], $pid);
								update_field('field_5d430d8b40904', $_POST['business_number'], $pid);
								update_field('field_5d430da15f81b', $_POST['description'], $pid);
								}
							?>
						</form>
						</div>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
