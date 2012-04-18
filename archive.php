<?php
/**
 * Archive Template
 *
 * @package     Shades
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @internal    REQUIRES WordPress version 3.1.0
 * @internal    Tested up to WordPress version 3.4
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * Last revised April 18, 2012
 * @version     1.8
 * Replace navigation with call to `get_template_part( 'shades-navigation' )`
 */

get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
    <div id="content">
        <div id="the-loop">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                if ( get_post_format() !== ( 'aside' || 'quote' || 'status' ) ) {
                    get_template_part( 'shades', get_post_format() );
                } else { ?>
                    <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                        <h1>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>"><?php the_title(); ?></a>
                        </h1>
                        <div class="post-comments">
                            <?php comments_popup_link( __( 'No Comments', 'shades' ), __( '1 Comment', 'shades' ), __( '% Comments', 'shades' ), '', __( 'Comments closed', 'shades' ) ); ?>
                        </div>
                        <div class="postdata">
                            <?php printf( __( '%1$s by %2$s on %3$s in ', 'shades' ), shades_use_posted(), get_the_author(), get_the_time( get_option( 'date_format' ) ) ); the_category( ', ' );
                            edit_post_link( __( 'Edit', 'shades' ), __( ' &#124; ', 'shades' ), __( '', 'shades' ) ); ?>
                        </div><!-- .postdata -->
                        <?php the_excerpt( __( 'Read more... ', 'shades' ) ); ?>
                        <div class="clear"></div> <!-- For inserted media at the end of the post -->
                        <p class="tags"><?php the_tags(); ?></p>
                    </div><!-- .post #post-ID -->
                <?php }
            endwhile;
                get_template_part( 'shades-navigation' );
            else : ?>
                <h2><?php printf( __( 'Search Results for: %s', 'shades' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
                <p class="center"><?php _e( 'Sorry, but you are looking for something that is not here.', 'shades' ); ?></p>
                <?php get_search_form();
            endif; ?>
        </div><!-- #the-loop -->
        <?php get_sidebar(); ?>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer(); ?>