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
			background-image: url('<?php get_template_directory_uri() ?>/mages/main-banner.jpg')
		}
	</style>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div className="Jumbotron">
                <h1 className="display-3">Header</h1>
                    <p className="lead">HV Info</p>
                    <Button className={jumboText.buttonShow} onClick={jumboText.buttonLink}>Sign Up</Button>
			<div class="Modal Modal-profile">
				<?php echo do_shortcode( '[register_form]' ); ?>

			</div>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
