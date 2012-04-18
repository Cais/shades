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
 * @todo Address deprecated function call to `get_userdatabylogin`
 */

get_header();

/** This sets the $curauth variable */
if( isset( $_GET['author_name'] ) ) :
    $curauth = get_userdatabylogin( $author_name );
else :
    $curauth = get_userdata( intval( $author ) );
endif;
?>
<div id="maintop"></div><!--end maintop-->
<div id="wrapper">
    <div id="content">
        <div id="the-loop">
            <div id="author" class="<?php if ( ( get_userdata( intval( $author ) )->ID ) == '1' ) echo 'administrator';
                /** elseif ( ( get_userdata( intval( $author ) )->ID ) == '2' ) echo 'jellybeen'; */ /** sample */
                /** add additional user_id following above example, echo the 'CSS element' you want to use for styling */
                ?>">
                <h2><?php _e( 'About ', 'shades' ); ?><?php echo $curauth->display_name; ?></h2>
                <ul>
                    <li><?php _e( 'Website', 'shades' ); ?>: <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a> <?php _e( 'or', 'shades' ); ?> <a href="mailto:<?php echo $curauth->user_email; ?>"><?php _e( 'email', 'shades' ); ?></a></li>
                    <li><?php _e( 'Biography', 'shades' ); ?>: <?php echo $curauth->user_description; ?></li>
                </ul>
            </div><!-- #author -->
            <h2><?php _e( 'Posts by ', 'shades' ); ?><?php echo $curauth->display_name; ?>:</h2>
            <!-- start the_Loop -->
            <?php
            if ( have_posts() ) :
                $count = 0;
                while ( have_posts() ) : the_post();
                    $count++;
                    if ( $count == 1 ) {
                        get_template_part( 'shades', get_post_format() );
                    } else { ?>
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                            <h1>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>"><?php the_title(); ?></a>
                            </h1>
                            <div class="postdata">
                                <?php
                                printf( __( '%1$s on %2$s', 'shades' ), shades_use_posted(), get_the_time( get_option( 'date_format' ) ) );
                                _e( ' in ', 'shades' ); the_category( ', ' ); the_shortlink( __( 'Short Link', 'shades' ), '', ' &#124; ', '' ); ?>
                                <br /><?php comments_popup_link( __( ' with No Comments', 'shades' ), __( ' with 1 Comment', 'shades' ), __( ' with % Comments', 'shades' ), '', __( ' with Comments closed', 'shades' ) );
                                edit_post_link( __( 'Edit', 'shades' ), __( ' &#124; ', 'shades' ), __( '', 'shades' ) ); ?>
                            </div><!-- .postdata -->
                            <?php
                            if ( is_home() || is_front_page() && has_post_thumbnail() ) {
                                the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) );
                            }
                            the_excerpt(); ?>
                            <div class="clear"></div><!-- For inserted media at the end of the post -->
                            <p class="tags"><?php the_tags(); ?></p>
                        </div><!-- .post #post-ID -->
                    <?php
                    }
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
        <div class="clear"></div>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer(); ?>