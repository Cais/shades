<?php
/**
 * Shades loop
 *
 * Standard loop for all non-supported post-formats
 *
 * @package        Shades
 * @since          1.7
 *
 * @link           http://buynowshop.com/themes/shades/
 * @link           https://github.com/Cais/shades/
 * @link           https://wordpress.org/themes/shades/
 *
 * @author         Edward Caissie <edward.caissie@gmail.com>
 * @copyright      Copyright (c) 2009-2015, Edward Caissie
 *
 * @version        2.1
 * @date           March 6, 2013
 * Refactored code, formatting, and code block termination comments
 *
 * @version        2.1.1
 * @date           July 18, 2013
 * Changed Featured Image code to use `shades_show_featured_image( 'full' )`
 *
 * @version        2.1.2
 * @date           December 28, 2013
 * i18n update for `Permalink to: ` phrase
 *
 * @version        2.4
 * @date           June 7, 2015
 * Moved `post-comments` message location to below other post meta data
 */

/** Check if the content is being displayed on a "page" */
if ( is_page() ) { ?>

	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<h1>
			<a href="<?php the_permalink(); ?>"
			   title="<?php the_title_attribute(
				   array(
					   'before' => __( 'Permalink to:', 'shades' ) . ' ',
					   'after'  => ''
				   )
			   ); ?>"><?php the_title(); ?></a>
		</h1>

		<div class="postdata">

			<?php printf(
				__( 'Posted by %1$s on %2$s', 'shades' ),
				get_the_author(),
				get_the_time( get_option( 'date_format' ) )
			);
			comments_popup_link();
			the_shortlink( __( 'Short Link', 'shades' ), '', ' &#124; ', '' );
			edit_post_link( __( 'Edit', 'shades' ), ' &#124; ', '' ); ?>

		</div>
		<!-- .postdata -->

		<?php the_content( __( 'Read more...', 'shades' ) ); ?>

		<div class="clear"></div>
		<!-- For inserted media at the end of the post -->

		<?php wp_link_pages(
			array(
				'before'         => '<p><strong>' . __( 'Pages:', 'shades' ) . '</strong> ',
				'after'          => '</p>',
				'next_or_number' => 'number'
			)
		); ?>

	</div><!-- .post #post-ID -->

<?php } else {
	/** Otherwise show the "post" content */ ?>

	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<h1>

			<a href="<?php the_permalink(); ?>"
			   title="<?php the_title_attribute(
				   array(
					   'before' => __( 'Permalink to:', 'shades' ) . ' ',
					   'after'  => ''
				   )
			   ); ?>"><?php the_title(); ?></a>

		</h1>

		<div class="postdata">

			<?php if ( is_page() ) {

				printf(
					__( 'Posted by %1$s on %2$s', 'shades' ),
					get_the_author(),
					get_the_time( get_option( 'date_format' ) )
				);

			} else {

				printf(
					__( '%1$s by %2$s on %3$s in %4$s', 'shades' ),
					shades_use_posted(),
					get_the_author(),
					get_the_time( get_option( 'date_format' ) ),
					get_the_category_list( ', ' )
				);

			}

			the_shortlink( __( 'Short Link', 'shades' ), '', ' &#124; ', '' );
			edit_post_link( __( 'Edit', 'shades' ), ' &#124; ', '' );

			if ( ! is_single() ) { ?>

				<div class="post-comments">
					<?php comments_popup_link(); ?>
				</div>

			<?php } ?>

		</div>
		<!-- .postdata -->

		<?php shades_show_featured_image( 'full' );

		if ( is_home() || is_front_page() || is_single() ) { ?>

			<div class="clear"></div>
			<!-- Force clear before rendering content -->

			<?php the_content( __( 'Read more...', 'shades' ) ); ?>

			<div class="clear"></div><!-- For inserted media at the end of the post -->

			<?php wp_link_pages(
				array(
					'before'         => '<p><strong>' . __( 'Pages:', 'shades' ) . '</strong> ',
					'after'          => '</p>',
					'next_or_number' => 'number'
				)
			);

		} else {

			the_excerpt();

		}

		if ( is_single() ) { ?>

			<div id="author_link">
				<?php printf( '%1$s %2$s', __( '... other posts by', 'shades' ), shades_get_the_author_posts_link() ); ?>
			</div>

		<?php } ?>

		<p class="tags"><?php the_tags(); ?></p>

	</div> <!-- .post #post-ID -->

<?php }