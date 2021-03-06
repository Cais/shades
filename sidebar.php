<?php
/**
 * Sidebar Template
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
 * @date           March 6, 2013
 * Refactored code, formatting, and code block termination comments
 *
 * @version        2.1.2
 * @date           December 28, 2013
 * Removed default `Search` from sidebar
 *
 * @version        2.4
 * @date           May 31, 2015
 * Removed Bookmarks from default sidebar content
 */ ?>

<div id="sidebar">

	<div id="sidebar-top"></div>

	<div id="sidebar-content">

		<div id="subcolumn">

			<ul>

				<li>

					<?php if ( dynamic_sidebar( 1 ) ) : else : ?>

						<div class="widget calendar">
							<h2 class="widget-title"><?php _e( 'Calendar', 'shades' ); ?></h2>

							<div align="center">
								<?php get_calendar( 0 ); ?>
							</div>
						</div><!-- widget calendar -->

						<div class="widget categories">
							<h2 class="widget-title"><?php _e( 'Categories', 'shades' ); ?></h2>
							<ul>
								<?php wp_list_categories( 'title_li=&show_count=1' ); ?>
							</ul>
						</div><!-- widget categories -->

						<div class="widget archives">
							<h2 class="widget-title"><?php _e( 'Archives', 'shades' ); ?></h2>
							<ul>
								<?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?>
							</ul>
						</div><!-- widget archives -->

						<div class="widget meta">
							<h2 class="widget-title"><?php _e( 'Meta', 'shades' ); ?></h2>
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<li>
									<a href="http://wordpress.org/" title="Powered by WordPress.">WordPress</a>
								</li>
								<?php wp_meta(); ?>
							</ul>
						</div><!-- widget meta -->

					<?php endif;

					if ( dynamic_sidebar( 2 ) ) : else : endif; ?>

				</li>

			</ul>

		</div>
		<!-- #subcolumn -->

	</div>
	<!--#sidebar-content -->

	<div id="sidebar-bottom"></div>

</div><!-- #sidebar -->