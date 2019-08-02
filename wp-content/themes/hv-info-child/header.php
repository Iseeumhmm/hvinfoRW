<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package HV_INFO
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div id="content" class="site-content">
		<div class="nav-container">
			<nav class="navbar navbar-expand-xl navbar-dark">
				<div class="logo">
				<a href="<?php echo get_site_url() ?>/"><img class="logo-image" src="<?php echo get_template_directory_uri()?>/images/logo.jpg" alt="Logo"></a>
				</div>
				<button class="navbar-toggler mr-md-7" data-toggle="collapse" data-target="#navbarMenu">
					<!-- <span class="navbar-toggler-icon"></span> -->
					<span class="navbar-menu-text">Menu</span>
				</button>
				<div class="collapse navbar-collapse" id="navbarMenu">
					<div class="navbar-nav ml-auto navbar-mobile-center">
						<ul class="navbar-nav ml-auto">
							<?php if( is_user_logged_in() ) { ?>
							<li class="nav-item">
								<a href="<?php echo get_site_url() ?>/news-post" class="nav-link">News Post</a>
							</li>
							<?php  } ?>
							<li class="nav-item">
								<a href="<?php echo get_site_url() ?>/directory" class="nav-link">Company Directory</a>
							</li>
							<li class="nav-item">
								<a onClick="showRegister();" class="nav-link">Register</a>
							</li>
							<li class="nav-item">
								<a onClick="showLogin();" class="nav-link">Sign In</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>