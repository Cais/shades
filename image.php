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
 * @todo Review $content_width hack
 */
get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
    <div id="content">
        <div id="the-loop">
            <?php
            global $post;
            echo '<h1><a href="' . get_permalink( $post->post_parent ) . '">&laquo; Go back to ' . get_the_title( $post->post_parent ) . ' gallery post.</a></h1><br />';

            echo previous_image_link( false, '<span class="left">' . __( 'Previous Photo', 'shades' ) . '</span>' );
            echo next_image_link( false, '<span class="right">' . __( 'Next Photo', 'shades' ) . '</span>' );

            echo '<div class="clear"></div>';

            echo '<div class="center"><a href="' . wp_get_attachment_url( $post->ID ) . '">' . wp_get_attachment_image( $post->ID, 'large' ) . '</a></div>';

            $imagemeta = wp_get_attachment_metadata();

            if ( $imagemeta['width'] && $imagemeta['height']  ) {
                echo '<div class="right"><a href="' . wp_get_attachment_url( $post->ID ) . '">' . __( 'Original image', 'shades' ) . '</a>' . ' ' . __( '(Size:', 'shades' ) . ' ' . $imagemeta['width'] . __( 'px by', 'shades' ) . ' ' . $imagemeta['height'] . _( 'px)', 'shades' ) . '</div>';
            }

            if ( $imagemeta['image_meta']['credit'] ) {
                echo '<br />Credit: ' . $imagemeta['image_meta']['credit'];
            }

            if ( $imagemeta['image_meta']['copyright'] ) {
                echo ' &copy; ' . get_the_time( 'Y' ) . ' ' . $imagemeta['image_meta']['copyright'];
            }

            if ( $imagemeta['image_meta']['created_timestamp'] ) {
                echo '<br />Created (timestamp): ' . get_the_time( get_option( 'date_format' ), $imagemeta['image_meta']['created_timestamp'] ) . ' @ ' . get_the_time ( get_option( 'time_format' ), $imagemeta['image_meta']['created_timestamp'] );
            }

            if ( $imagemeta['image_meta']['camera'] ) {
                echo '<br />Camera: ' . $imagemeta['image_meta']['camera'];
            }

            if ( $imagemeta['image_meta']['shutter_speed'] ) {
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

            if ( $imagemeta['image_meta']['aperture'] ) {
                echo '<br />Aperture (F-stop): ' . $imagemeta['image_meta']['aperture'];
            }

            if ( $imagemeta['image_meta']['caption'] ) {
                echo '<br />Caption: ' . $imagemeta['image_meta']['caption'];
            }

            if ( $imagemeta['image_meta']['focal_length'] ) {
                echo '<br />Focal Length: ' . $imagemeta['image_meta']['focal_length'] . 'mm';
            }

            if ( $imagemeta['image_meta']['iso'] ) {
                echo '<br />Speed: ISO ' . $imagemeta['image_meta']['iso'];
            }

            if ( $imagemeta['image_meta']['title'] ) {
                echo '<br />Title: ' . $imagemeta['image_meta']['title'];
            }

            echo '<br /><h6>This image template page is a work in progress ... look for more information in this space.</h6>';

            /** Testing for available data points */
            /**
            if (version_compare( phpversion(), '5.3', '<' ) ) {
                echo '<pre>';
                    var_dump($imagemeta);
                echo '</pre>';
            } else {
                var_dump($imagemeta);
            }
            */

            ?>
        </div><!-- #the-loop -->
        <?php get_sidebar(); ?>
    </div><!--end content-->
</div><!--end wrapper-->
<?php get_footer();