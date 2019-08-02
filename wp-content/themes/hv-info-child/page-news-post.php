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
			<h1 class="display-3 text-center">News Post</h1>
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
				<h2 style="text-transform: uppercase;" class="text-left">Create a new post</h2>
				<div class="news-line"></div>
			</div>
			<div class="container-fluid">
				<div class="row text-center">
					<!-- <?php 
					$posts = new WP_Query(array('post_type'=>'profiles', 'posts_per_page' => -1));
						if( $posts->have_posts() ) : while( $posts->have_posts() ) : $posts->the_post();
						echo '<style>.logo-image' . get_the_ID() . '{ background-image: url(' . get_field( 'logo' ) . '); background-position: center center; background-size: contain; background-repeat: no-repeat;}</style>';
						echo '<div class="col-md-6 col-lg-4 news-item">';
						echo '<div class="companies-logo--container mb-5 logo-image' . get_the_ID() . '"></div>';
						echo '<span class="news-heading--text">'. get_the_title() . '</span>';
						echo '<h1 class="companies-h1">' . get_field( service_type ) . '</h1>';
						$content = wp_strip_all_tags( get_field( 'description' ) );
						echo '<p class="news-body companies-body">' . substr( $content, 0, 150) . ' ...</p>';
						echo '<p class="news-keepreading text-left">Keep reading...</p>';
						echo '</div>';
						endwhile;  
					endif;
					?> -->
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
