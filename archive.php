<?php
/**
 * Archive Template
 *
 * @package        Shades
 * @since          1.0
 *
 * @link           http://buynowshop.com/themes/shades/
 * @link           https://github.com/Cais/shades/
 * @link           https://wordpress.org/themes/shades/
 *
 * @author         Edward Caissie <edward.caissie@gmail.com>
 * @copyright      Copyright (c) 2009-2015, Edward Caissie
 *
 * Last revised April 18, 2012
 * @version        1.8
 * Replace navigation with call to `get_template_part( 'shades-navigation' )`
 * Replaced output if no posts are returned by the_Loop with a call to get_template_part( 'shades-no-posts' )
 *
 * @version        2.1
 * @date           March 4, 2013
 * Refactored code formatting and code block termination comments
 * Refactored post meta to be more i18n compatible
 *
 * @version        2.1.2
 * @date           December 28, 2013
 * i18n update for `Permalink to: ` phrase
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

						if ( get_post_format() !== ( 'aside' || 'quote' || 'status' ) ) {

							get_template_part( 'content', get_post_format() );

						} else { ?>

							<div <?php post_class(); ?>

								id="post-<?php the_ID(); ?>">

								<h1>
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(
										   array(
											   'before' => __( 'Permalink to:', 'shades' ) . ' ',
											   'after'  => ''
										   )
									   ); ?>"><?php the_title(); ?></a>
								</h1>

								<div class="post-comments">
									<?php comments_popup_link(); ?>
								</div>
								<!-- post-comments -->

								<div class="postdata">

									<?php
									printf(
										__( '%1$s by %2$s on %3$s in %4$s', 'shades' ) . ' ',
										shades_use_posted(),
										get_the_author(),
										get_the_time( get_option( 'date_format' ) ),
										get_the_category_list( ', ' )
									);
									edit_post_link( __( 'Edit', 'shades' ), ' &#124; ', '' ); ?>

								</div>
								<!-- .postdata -->

								<?php the_excerpt(); ?>

								<div class="clear"></div>
								<!-- For inserted media at the end of the post -->

								<p class="tags"><?php the_tags(); ?></p>

							</div><!-- .post #post-ID -->

						<?php }

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