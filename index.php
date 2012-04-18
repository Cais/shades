<?php
/**
 * Shades
 *
 * Theme Description: A simple clean theme framework to work from, designed
 * ideally for light colored backgrounds and easily adapted to darker layouts.
 * Now with Threaded Comments and sticky post support!<em>Please read the
 * included changelog.txt file for the latest change details.
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
 * @version     1.8-alpha
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @todo Replace navigation with a function
 */

get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
    <div id="content">
        <div id="the-loop">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                get_template_part( 'shades', get_post_format() );
            endwhile; ?>
                <div id="nav-global" class="navigation">
                    <div class="left">
                        <?php next_posts_link( __( '&laquo; Previous entries ', 'shades' ) ); ?>
                    </div>
                    <div class="right">
                        <?php previous_posts_link( __( ' Next entries &raquo;', 'shades' ) ); ?>
                    </div>
                </div>
            <?php else : ?>
                <h2><?php printf( __( 'Search Results for: %s', 'shades' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
                <p class="center"><?php _e( 'Sorry, but you are looking for something that is not here.', 'shades' ); ?></p>
                <?php get_search_form();
            endif; ?>
        </div><!-- #the-loop -->
        <?php get_sidebar(); ?>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer(); ?>