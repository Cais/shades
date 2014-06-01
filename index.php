<?php
/**
 * Shades
 * A simple clean theme framework to work from, designed ideally for light
 * colored backgrounds and easily adapted to darker layouts. Now with Threaded
 * Comments and sticky post support!<em>Please read the included changelog.txt
 * file for the latest change details.
 *
 * @package        Shades
 * @since          1.0
 *
 * @link           http://buynowshop.com/themes/shades/
 * @link           https://github.com/Cais/shades/
 * @link           http://wordpress.org/themes/shades/
 *
 * @internal       REQUIRES WordPress version 3.4
 * @internal       Tested up to WordPress version 3.8.1
 *
 * @version        2.2.1
 * @author         Edward Caissie <edward.caissie@gmail.com>
 * @copyright      Copyright (c) 2009-2014, Edward Caissie
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
 * @version        2.1.1
 * @date           May 5, 2013
 *
 * @version        2.2
 * @date           December 2013
 *
 * @version        2.2.1
 * @date           June 2014
 */

get_header(); ?>

	<div id="maintop"></div>

	<div id="wrapper">

		<div id="content">

			<div id="the-loop">

				<?php
				if ( have_posts() ) {

					while ( have_posts() ) {
						the_post();
						get_template_part( 'shades', get_post_format() );
					}
					/** End while - have posts */

					get_template_part( 'shades-navigation' );

				} else {

					get_template_part( 'shades-no-posts' );

				} /** End if - have posts */
				?>

			</div>
			<!-- #the-loop -->

			<?php get_sidebar(); ?>

		</div>
		<!--end content-->

	</div><!--end wrapper-->

<?php get_footer();