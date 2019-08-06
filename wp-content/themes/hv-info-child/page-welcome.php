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
		
		<div class="Jumbotron confirming">
			<div class="Modal Modal-register">
				<?php echo do_shortcode( '[register_form]' ); ?>
			</div>
			<div class="Modal Modal-login">
				<?php echo do_shortcode( '[login_form]' ); ?>
			</div>
			<?php 
				$user = get_current_user_id();
				echo $user;
				if (rcp_user_has_access( $user_id = $user, 2)) {
					echo '<h1 class="display-3 text-center">Thank you for Registering!</h1>';
					echo '<p class="lead text-center">You can now create a company profile</p>';
					?> <Button onclick='location.href="<?php echo get_site_url() ?>/profile;"' class="Button">Create Profile</Button>';
					<?php
				} else if (rcp_user_has_access( $user_id = $user, 1)) {
					echo '<h1 class="display-3 text-center">Thank you for Registering!</h1>';
					echo "<p class='lead text-center'>Please check you're inbox to confirm you're email</p>";
					?> <Button onclick='location.href="<?php echo get_site_url() ?>/profile;"' class="Button">Company Directory</Button>';
					<?php
				} else {
					echo '<h1 class="display-3 text-center pb-5">Please register to view content</h1>';
					echo '<Button id="thebutton" onClick="showRegister();" class="Button">Register</Button>';
				}
			?>
		</div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
