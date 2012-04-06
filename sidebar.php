<div id="sidebar">
	<div id="sidebar-top"></div>
	<div id="sidebar-content">
		<div id="subcolumn">
			<div class="widget">
				<div id="search">
					<?php get_search_form(); ?>
				</div> <!-- #search -->
			</div>
			<ul><li>
				<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 1 ) ) : else : ?>
					<div class="widget">			
						<h2 class="widget-title"><?php _e( 'Calendar', 'shades' ); ?></h2>
						<div align="center">
							<?php get_calendar( 0 ); ?> 
						</div>
					</div>
					<div class="widget">
						<?php wp_list_bookmarks( 'title_li=&title_before=<h2 class="widget-title">&title_after=</h2>&category_before=&category_after=' ); ?>
					</div>
					<div class="widget">			
						<h2 class="widget-title"><?php _e( 'Categories', 'shades' ); ?></h2>
						<ul>
							<?php wp_list_categories( 'title_li=&show_count=1' ); ?>
						</ul>
					</div>
					<div class="widget">			
						<h2 class="widget-title"><?php _e( 'Archives', 'shades' ); ?></h2>
						<ul>
							<?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?>
						</ul>
					</div>
					<div class="widget">
						<h2 class="widget-title"><?php _e( 'Meta', 'shades' ); ?></h2>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<li><a href="http://wordpress.org/" title="Powered by WordPress.">WordPress</a></li>
							<?php wp_meta(); ?>
						</ul>
					</div>
				<?php endif; ?>
				<?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 2 ) ) : else : ?><?php endif; ?>
			</li></ul>
		</div> <!-- #subcolumn --> 
	</div> <!--#sidebar-content -->
  <div id="sidebar-bottom"></div>
</div> <!-- #sidebar -->
<?php /* Last Revision: June 13, 2010, v1.5 */ ?>