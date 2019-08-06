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
			<h1 class="display-3 text-center">Your email is confirmed</h1>
			<?php if( !is_user_logged_in() ) { ?>
				<Button onclick='showLogin();' class="Button email_confirmation">Login</Button>
			<?php  } ?>
		</div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
