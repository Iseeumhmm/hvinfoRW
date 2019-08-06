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
		<div class="Jumbotron">
			<h1 class="display-3 text-center">Grow your business network with others and share your work</h1>
			<p class="lead">Help build our community</p>
			<?php 
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
			?>
			<!-- <Button onClick="showRegister();" class="Button">Register Today</Button> -->
			<div class="Modal Modal-register">
				<?php echo do_shortcode( '[register_form]' ); ?>
			</div>
			<div class="Modal Modal-login">
				<?php echo do_shortcode( '[login_form]' ); ?>
		</div>
		</div>

		<div class="news-container">
			<div class="news-header">
				<h2 class="text-left">LATEST NEWS & INFO</h2> 
				<div class="news-line"></div>
			</div>
			<div class="container-fluid">
				<div class="row news-row">
					<?php 
					$posts = new WP_Query(array('post_type'=>'Post', 'posts_per_page' => -1));
						if( $posts->have_posts() ) : while( $posts->have_posts() ) : $posts->the_post();
						$color="#F8BA15";
						if ( get_field( 'service_type' ) === "Web Design") {
							$color="#5D4D97";
						} else if ( get_field( 'service_type' ) === "Electrical") {
							$color="#89C43F";
						} else if ( get_field( 'service_type' ) === "HVAC") {
							$color="#29A9E0";
						}
						echo '<div class="col-md-6 col-lg-4 news-item">';
						echo '<div class="news-circle" style="background-color: ' . $color . '; display: inline-block;"></div>';
						echo '<span class="news-heading--text">'. get_the_title() . '</span>';
						$content = wp_strip_all_tags( get_the_content() );
						echo '<p class="news-body">' . substr( $content, 0, 185) . ' ...</p>';
						echo '<p class="news-keepreading">Keep reading...</p>';
						echo '</div>';
						endwhile;  
					endif;
					?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
