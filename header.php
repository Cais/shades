<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
/**
 * Header Template
 *
 * @package     Shades
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @internal    REQUIRES WordPress version 3.1.0
 * @internal    Tested up to WordPress version 3.4
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <title>
        <?php
        /** ... as influenced by Twenty Ten and Twenty Eleven */
        global $page, $paged;
        wp_title( '|', true, 'right' ); bloginfo( 'name' );
        /** Add the blog description (tagline) for the home/front page. */
        $site_tagline = get_bloginfo( 'description', 'display' );
        if ( $site_tagline && ( is_home() || is_front_page() ) )
            echo " | $site_tagline";
        /** Add a page number if necessary: */
        if ( $paged >= 2 || $page >= 2 )
            echo ' | ' . sprintf( __( 'Page %s', 'shades' ), max( $paged, $page ) ); ?>
    </title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="mainwrap">
    <div id="header-container">
        <div id="header">
            <div id="header-left"></div>
            <div id="header-center">
                <h2><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h2><!-- added URL code -->
                <p><?php bloginfo( 'description' ); ?></p>
            </div><!-- #header-center -->
            <div id="header-right"></div>
        </div><!-- #header -->
        <div class="clear"></div>
        <div id="top-navigation-menu">
            <?php shades_nav_menu(); ?>
        </div>
    </div><!-- #header-container -->