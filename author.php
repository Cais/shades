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
 * @version        2.1
 * @date           March 8, 2013
 * Refactored code formatting and code block termination comments
 * Refactored post meta to be more i18n compatible
 *
 * @version        2.1.1
 * @date           July 18, 2013
 * Changed Featured Image code to use `shades_show_featured_image( 'full' )`
 *
 * @version        2.1.2
 * @date           December 28, 2013
 * i18n update for `Permalink to: ` phrase
 *
 * @version 2.4
 * @date    May 30, 2015
 * Improved i18n implementations
 */

get_header();

/** This sets the $curauth variable */
$curauth = ( get_query_var( 'author_name ' ) ) ? get_user_by( 'id', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) ); ?>

	<div id="maintop"></div><!--end maintop-->

	<div id="wrapper">
		<div id="content">
			<div id="the-loop">

				<div id="author" class="<?php
				/** Add class as related to the user role (see 'Role:' drop-down in User options) */
				if ( user_can( $curauth->ID, 'administrator' ) ) {
					echo 'administrator';
				} elseif ( user_can( $curauth->ID, 'editor' ) ) {
					echo 'editor';
				} elseif ( user_can( $curauth->ID, 'contributor' ) ) {
					echo 'contributor';
				} elseif ( user_can( $curauth->ID, 'subscriber' ) ) {
					echo 'subscriber';
				} else {
					echo 'guest';
				}
				if ( ( $curauth->ID ) == '1' ) {
					echo ' administrator-prime';
				} ?>">

					<h2>
						<?php _e( 'About ', 'shades' ); ?><?php echo $curauth->display_name; ?>
					</h2>

					<ul>

						<?php if ( ! empty( $curauth->user_url ) ) { ?>

							<li>
								<?php printf( '%1$s: %2$s or %3$s',
									__( 'Website', 'shades' ),
									'<a href="' . $curauth->user_url . '">' . $curauth->user_url . '</a>',
									'<a href="mailto:' . $curauth->user_email . '">' . __( 'email', 'shades' ) . '</a>' ); ?>
							</li>

						<?php }

						if ( ! empty( $curauth->user_description ) ) { ?>
							<li>
								<?php printf( '%1$s: %2$s',
									__( 'Biography', 'shades' ),
									$curauth->user_description ) ?>
							</li>
						<?php } ?>

					</ul>

				</div>
				<!-- #author -->

				<h2>
					<?php printf( __( 'Posts by %1$s', 'shades' ), $curauth->display_name ); ?>
				</h2>

				<!-- start the_Loop -->
				<?php if ( have_posts() ) {

					$count = 0;

					while ( have_posts() ) {

						the_post();
						$count ++;

						if ( $count == 1 ) {

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

								<div class="postdata">

									<?php
									printf(
										__( '%1$s on %2$s in %3$s', 'shades' ),
										shades_use_posted(),
										get_the_time( get_option( 'date_format' ) ),
										get_the_category_list( ', ' )
									);
									the_shortlink( __( 'Short Link', 'shades' ), '', ' &#124; ', '' ); ?>
									<br />
									<?php
									comments_popup_link();
									edit_post_link( __( 'Edit', 'shades' ), ' &#124; ', '' ); ?>

								</div>
								<!-- .postdata -->

								<?php
								shades_show_featured_image( 'full' );
								the_excerpt(); ?>

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

			<div class="clear"></div>

		</div>
		<!--end content-->

	</div><!--end wrapper-->

<?php get_footer();