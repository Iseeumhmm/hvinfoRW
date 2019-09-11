<?php
/**
 * Template Name: Custom Template
 * Template Post Type: post, page
 *
 * 
 * @package HV_INFO
 */

get_header();
?>

<style>
		.Jumbotron {
			background-image: url('<?php echo get_template_directory_uri() ?>/images/main-banner.jpg');
		}
	</style>
	
	<div id="primary" class="content-area">
		<main id="main" class="site-main posts_page">
			<div class="Jumbotron">
				<h1 class="display-3 text-center">Grow your business network with others and share your work</h1>
				<p class="lead">Help build our community</p>
				<!-- <?php 
					$user = get_current_user_id();
					echo $user;
					if (rcp_user_has_access( $user_id = $user, 2)) {
						?> <Button onclick='location.href="<?php echo get_site_url() ?>/profile;"' class="Button">Create Profile</Button>';
						<?php
					} else if (rcp_user_has_access( $user_id = $user, 1)) {
						?> <Button onclick='location.href="<?php echo get_site_url() ?>/directory;"' class="Button">Company Directory</Button>';
						<?php
					} else {
						echo '<Button onClick="showRegister();" class="Button">Register Today</Button>';
					}
				?> -->
				<!-- <Button onClick="showRegister();" class="Button">Register Today</Button> -->
				<div class="Modal Modal-register">
					<?php echo do_shortcode( '[register_form]' ); ?>
				</div>
				<div class="Modal Modal-login">
					<?php echo do_shortcode( '[login_form]' ); ?>
				</div>
			</div>
			<div class="posts">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php

get_footer();
