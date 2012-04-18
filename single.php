<?php
/**
 * Single Template
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

get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
    <div id="content">
        <div id="the-loop">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                get_template_part( 'shades', get_post_format() );
                comments_template();
            endwhile; else : ?>
                <h2><?php printf( __( 'Search Results for: %s', 'shades' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
                <p class="center"><?php _e( 'Sorry, but you are looking for something that is not here.', 'shades' ); ?></p>
                <?php
                get_search_form();
            endif; ?>
        </div><!-- #the-loop -->
        <?php get_sidebar(); ?>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer(); ?>