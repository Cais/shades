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
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * Last revised April 18, 2012
 * @version     1.8
 * Replaced output if no posts are returned by the_Loop with a call to get_template_part( 'shades-no-posts' )
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
            endwhile;
            else :
                get_template_part( 'shades-no-posts' );
            endif; ?>
        </div><!-- #the-loop -->
        <?php get_sidebar(); ?>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer(); ?>