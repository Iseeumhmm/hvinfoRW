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
				<h1 class="display-3 text-center">Create a news post</h1>
				<div class="Modal Modal-register">
					<?php echo do_shortcode( '[register_form]' ); ?>
				</div>
				<div class="Modal Modal-login">
					<?php echo do_shortcode( '[login_form]' ); ?>
			</div>
			</div>

			<div class="news-container">
				<div class="news-header">
					<h2 style="text-transform: uppercase;" class="text-left">New Post</h2>
					<div class="news-line"></div>
					<div class="pt-5 rcp_form-profile_container">

					<form class="rcp_form" id="featured_upload" method="post" action="#" enctype="multipart/form-data">
						<p><label for="title">Title</label><br />
						<input required type="text" id="title" value="" tabindex="1" size="50" name="title" />
						</p>

						<p><label for="service_type">Service Type</label><br />
							<select required id="service_type" name="service_type"">
								<option value="">--Select One--</option>
								<option value="Plumbin">Plumbing</option>
								<option value="Web Design">Web Design</option>
								<option value="Electrical">Electrical</option>
								<option value="HVAC">HVAC</option>
							</select>
						</p>

						<p><label for="description">Content</label><br />
						<textarea required id="description" tabindex="3" name="description" cols="50" rows="6"></textarea>
						</p>

						<?php wp_nonce_field( 'newsfeed_nonce' ); ?>
						<p class="rcp-form_button--container text-left">
						<input class="rcp-form_button medium-font-size" id="submit_newsfeed" name="submit_newsfeed" type="submit" value="Submit" />
						</p>
						
					</form>

					<?php

						// Check that the nonce is valid, and the user can edit this post.
						if ( true
							// isset( $_POST['newsfeed_nonce'] ) 
							// && wp_verify_nonce( $_POST['newsfeed_nonce'] )
						) {
							// The nonce was valid and the user has the capabilities, it is safe to continue.
							
							
							// Create post
							$new_post = array(
								'post_title'    => $_POST['title'],
								'post_content'  => $_POST['description'],
								'post_status'   => 'publish',  
								'post_type' => 'Post'
							);
							//save the new post
							$pid = wp_insert_post($new_post); 
							
							// Update ACF fields
							update_field('field_5d4426112001b', $_POST['service_type'], $pid);
						}
					?>	
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
