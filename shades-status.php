<?php
/**
 * Shades Status loop
 *
 * @package     Shades
 * @since       1.7
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 *
 * Last revised April 20, 2012
 * @version     1.8
 * Added 'no-title' class to post classes if `get_the_title` is empty
 *
 * @version     2.1
 * @date        March 6, 2013
 * Refactored code, formatting, and code block termination comments
 */ ?>

<div <?php
    $shades_post_title = get_the_title();
    if ( empty( $shades_post_title ) ) {
        post_class( 'no-title' );
    } /** End if - empty shades title */
    post_class(); ?> id="post-<?php the_ID(); ?>">

    <div class="transparent glyph"><?php shades_glyph_status(); ?></div>

    <h1>
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>"><?php the_title(); ?></a>
    </h1>

    <div class="postdata">

        <?php
        if ( is_home() || is_front_page() ) {

            printf( __( '%1$s by %2$s on %3$s in %4$s', 'shades' ),
                shades_use_posted(),
                get_the_author(),
                get_the_time( get_option( 'date_format' ) ),
                get_the_category_list( ', ' )
            ); ?>

            <br /><?php comments_popup_link( __( ' with No Comments', 'shades' ), __( ' with 1 Comment', 'shades' ), __( ' with % Comments', 'shades' ), '', __( ' with Comments closed', 'shades' ) );

        } else {

            printf( __( 'Posted by %1$s on %2$s @ %3$s in %4$s', 'shades' ),
                get_the_author(),
                get_the_time( get_option( 'date_format' ) ),
                get_the_time ( get_option( 'time_format' ) ),
                get_the_category_list( ', ' )
            );

        } /** End if - is home */

        the_shortlink( __( 'Short Link', 'shades' ), '', ' &#124; ', '' );
        edit_post_link( __( 'Edit', 'shades' ), __( ' &#124; ', 'shades' ), __( '', 'shades' ) ); ?>

    </div><!-- postdata -->

    <?php
    if ( is_home() || is_front_page() && has_post_thumbnail() ) {
        the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
    } /** End if - is home */
    the_content( __( 'Read more... ', 'shades' ) ); ?>

    <div class="clear"></div><!-- For inserted media at the end of the post -->

    <?php wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );

    if ( is_single() ) { ?>
        <div id="author_link"><?php _e( '... other posts by ', 'shades' ); ?><?php the_author_posts_link(); ?></div>
        <?php
        shades_modified_post();
    } /** End if - is single */ ?>

    <p class="tags"><?php the_tags(); ?></p>

</div><!-- .post #post-ID -->