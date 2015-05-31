<?php
/**
 * Search
 * Search results output template
 *
 * @package     Shades
 * @since       2.1
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        https://wordpress.org/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
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
 */

get_header(); ?>

	<div id="maintop"></div>

	<div id="wrapper">

		<div id="content">

			<div id="the-loop">

				<?php
				if ( have_posts() ) {

					printf(
						sprintf(
							'<h2 class="search-found-pre-text">%1$s <span class="search-query">%2$s</span></h2>',
							apply_filters( 'shades_search_found_pre_text',
								__( 'We found it!', 'shades' )
								. '<br />'
								. __( 'It looks like you searched for ...', 'shades' )
							),
							get_search_query()
						)
					);

					_e(
						apply_filters(
							'shades_search_found_post_text',
							'<div class="shades-search-found-post-text">' . __( 'Here are the results:', 'shades' ) . '</div>'
						)
					);

					while ( have_posts() ) {

						the_post();
						get_template_part( 'content', get_post_format() );

					}

					get_template_part( 'shades-navigation' );

				} else {

					get_template_part( 'shades-no-posts' );

				} ?>

			</div>
			<!-- #the-loop -->

			<?php get_sidebar(); ?>

		</div>
		<!--end content-->

	</div><!--end wrapper-->

<?php get_footer();