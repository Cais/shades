<?php
/**
 * Shades Aside loop
 *
 * @package     Shades
 * @since       1.7
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * Last revised April 20, 2012
 * @version     1.8
 * Added 'no-title' class to post classes if `get_the_title` is empty
 */ ?>
<div <?php
        $shades_post_title = get_the_title();
        if ( empty( $shades_post_title ) ) post_class( 'no-title' );
        post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="transparent glyph"><?php shades_glyph_aside(); ?></div>
    <h1>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>"><?php the_title(); ?></a>
    </h1>
    <div class="postdata">
        <?php printf( __( '%1$s by %2$s on %3$s in', 'shades' ), shades_use_posted(), get_the_author(), get_the_time( get_option( 'date_format' ) ) );
        _e( ' ', 'shades' ); the_category( ', ' );
        if ( is_home() || is_front_page() ) { ?>
            <br /><?php comments_popup_link( __( ' with No Comments', 'shades' ), __( ' with 1 Comment', 'shades' ), __( ' with % Comments', 'shades' ), '', __( ' with Comments closed', 'shades' ) );
        }
        the_shortlink( __( 'Short Link', 'shades' ), '', ' &#124; ', '' );
        edit_post_link( __( 'Edit', 'shades' ), __( ' &#124; ', 'shades' ), __( '', 'shades' ) ); ?>
    </div>
    <?php
    if ( is_home() || is_front_page() && has_post_thumbnail() ) {
        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
    }
    the_content( __( 'Read more... ', 'shades' ) ); ?>
    <div class="clear"></div><!-- For inserted media at the end of the post -->
    <?php
    wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );
    if ( is_single() ) { ?>
        <div id="author_link"><?php _e( '... other posts by ', 'shades' ); ?><?php the_author_posts_link(); ?></div>
    <?php } ?>
    <p class="tags"><?php the_tags(); ?></p>
</div><!-- .post #post-ID -->