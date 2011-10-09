<?php get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
	<div id="content">
		<div id="the-loop">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
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
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div><!-- #the-loop -->
		<?php get_sidebar(); ?>
	</div><!--end content-->
</div><!--end wrapper-->
<?php get_footer(); ?>
<?php /* Last revised September 9, 2011 v1.7 */ ?>