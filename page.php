<?php get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
	<div id="content">
		<div id="the-loop">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'shades', get_post_format() ); ?>
          <?php comments_template(); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<h2><?php printf( __( 'Search Results for: %s', 'shades' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
				<p class="center"><?php _e( 'Sorry, but you are looking for something that is not here.', 'shades' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div><!-- #the-loop -->
		<?php get_sidebar(); ?>
	</div><!-- #content -->
</div><!-- #wrapper -->
<?php get_footer();?>
<?php /* Last revised September 10, 2011 v1.7 */ ?>