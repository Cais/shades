<?php
/**
 * Single Template
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
 * Last revised April 18, 2012
 * @version     1.8
 * Replaced output if no posts are returned by the_Loop with a call to get_template_part( 'shades-no-posts' )
 *
 * @version     2.1
 * @date        March 6, 2013
 * Refactored code, formatting, and code block termination comments
 *
 * @version     2.4
 * @date        May 31, 2015
 * Added `shades_loop` function for DRY reasons
 */

get_header(); ?>

	<div id="maintop"></div>

	<div id="wrapper">

		<div id="content">

			<div id="the-loop">

				<?php shades_loop(); ?>

			</div>
			<!-- #the-loop -->

			<?php get_sidebar(); ?>

		</div>
		<!--end content-->

	</div><!--end wrapper-->

<?php get_footer();