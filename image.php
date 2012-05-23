<?php
/**
 * Image Template
 *
 * @package     Shades
 * @subpackage  Cais
 * @since       1.9
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 *
 * @todo Complete and clean-up for proper end-use
 */
get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
    <div id="content">
        <div id="the-loop">
            <?php
            global $post;
            echo '<h1><a href="' . get_permalink( $post->post_parent ) . '">&laquo; Go back to ' . get_the_title( $post->post_parent ) . ' gallery post.</a></h1><br />';

            echo previous_image_link( false, '<div class="left">' . __( 'Previous Photo', 'shades' ) . '</div>' );
            echo next_image_link( false, '<div class="right">' . __( 'Next Photo', 'shades' ) . '</div>' );

            echo '<div class="clear"></div>';

            echo '<div class="center"><a href="' . wp_get_attachment_url( $post->ID ) . '">' . wp_get_attachment_image( $post->ID, 'large' ) . '</a></div>';

            $imagemeta = wp_get_attachment_metadata();

            if ($imagemeta['image_meta']['camera']) {
                echo "Camera: " . $imagemeta['image_meta']['camera'];
            }

            if ($imagemeta['image_meta']['shutter_speed']) {
                echo ' ';
                echo '<br />Shutter: ';

                // shutter speed handler
                if ( ( 1 / $imagemeta['image_meta']['shutter_speed'] ) > 1 ) {
                    echo "1/";
                    if ( number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 1 ) ==  number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 0 ) ) {
                        echo number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 0, '.', '' ) . ' sec';
                    } else {
                        echo number_format( ( 1 / $imagemeta['image_meta']['shutter_speed'] ), 1, '.', '' ) . ' sec';
                    }
                } else {
                    echo $imagemeta['image_meta']['shutter_speed'] . ' sec';
                }
            }

            echo '<br /><h6>This image template page is a work in progress ... look for more information in this space.</h6>';

            ?>
        </div><!-- #the-loop -->
        <?php get_sidebar(); ?>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer();