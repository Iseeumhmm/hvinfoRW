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
				<h1 class="display-3 text-center">My Profile</h1>
				<div class="Modal Modal-register">
					<?php echo do_shortcode( '[register_form]' ); ?>
				</div>
				<div class="Modal Modal-login">
					<?php echo do_shortcode( '[login_form]' ); ?>
			</div>
			</div>

			<div class="news-container">
				<div class="news-header">
					<h2 style="text-transform: uppercase;" class="text-left">Public Profile</h2>
					<div class="news-line"></div>
				</div>
				<div class="my_profile-container text-center mx-auto">
					<?php
					global $current_user;                     

					$args = array(
					'post_type'		=>	'profiles',
					'author'        =>  $current_user->ID, 
					'orderby'       =>  'post_date',
					'order'         =>  'DESC',
					'posts_per_page' => 1 // no limit
					);

					$posts = new WP_Query( $args );

					if( $posts->have_posts() ) : while( $posts->have_posts() ) : $posts->the_post();
						
						echo '<style>.logo-image' . get_the_ID() . '{ background-image: url(' . get_field( 'logo' ) . '); background-position: center center; background-size: contain; background-repeat: no-repeat;}</style>';
						echo '<div class="companies-logo--container mb-5 logo-image' . get_the_ID() . '"></div>';
						echo '<span class="news-heading--text">'. get_the_title() . '</span>';
						echo '<h1 class="companies-h1">' . get_field( 'service_type' ) . '</h1>';
						$content = wp_strip_all_tags( get_field( 'description' ) );
						echo '<p class="news-body companies-body">' . $content . '</p>';
						endwhile;  
					endif;
					?>
					<button onclick="location.href='<?php echo get_site_url() ?>/profile';" class="rcp-form_button w-100 mt-3 medium-font-size">Edit Profile</button>

				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
