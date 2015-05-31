<?php
/**
 * Header Template
 *
 * @package     Shades
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        https://wordpress.org/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 *
 * @version     2.1
 * Refactored to a cleaner HTML5 format
 *
 * @version     2.4
 * @date        May 31, 2015
 * Add support for `title` tag
 */ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<?php /** Check for WordPress 4.1.x compatibility */
	if ( ! function_exists( '_wp_render_title_tag' ) ) { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="mainwrap">

	<div id="header-container">

		<div id="header">

			<div id="header-left"></div>

			<div id="header-center">

				<h2>
					<a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
				</h2>

				<p><?php bloginfo( 'description' ); ?></p>

			</div>
			<!-- #header-center -->

			<div id="header-right"></div>

		</div>
		<!-- #header -->

		<div class="clear"></div>

		<div id="top-navigation-menu">
			<?php shades_nav_menu(); ?>
		</div>
		<!-- top-navigation-menu -->

	</div>
	<!-- #header-container -->