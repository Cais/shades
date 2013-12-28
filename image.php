<?php
/**
 * Image Template
 * Displays single image from gallery with EXIF image meta if available
 *
 * @package     Shades
 * @since       1.9
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 *
 * @version     2.0
 * @date        December 7, 2012
 * Refactored conditional checks for "author credits with copyright details"
 *
 * @version     2.1
 * @date        March 6, 2013
 * Refactored code formatting and code block termination comments
 */

get_header(); ?>
	<div id="maintop"></div>
	<div id="wrapper">
		<div id="content">
			<div id="the-loop">
				<?php
				global $post;

				/** Provide a link back to the gallery post with text and gallery post title */
				echo '<a href="' . get_permalink( $post->post_parent ) . '">' . '&laquo; ' . __( 'Go back to the gallery post:', 'shades' ) . '</a>';
				echo '<h1>' . get_the_title( $post->post_parent ) . '</h1>';

				/** Add navigation links between pictures in the gallery */
				echo previous_image_link( false, '<span class="left">' . __( 'Previous Photo', 'shades' ) . '</span>' );
				echo next_image_link( false, '<span class="right">' . __( 'Next Photo', 'shades' ) . '</span>' );
				/** clearing hack */
				echo '<div class="clear"></div>';

				/** Show the image with link to original */
				echo '<div class="attached-image"><a href="' . wp_get_attachment_url( $post->ID ) . '">' . wp_get_attachment_image( $post->ID, 'large' ) . '</a></div>';

				/** @var $shades_image_meta - EXIF information from image */
				$shades_image_meta = wp_get_attachment_metadata();

				/** Link to original image with size displayed */
				if ( $shades_image_meta['width'] && $shades_image_meta['height'] ) {
					echo '<div class="right">'
						. sprintf( __( '%1$s (Size: %2$s by %3$s)', 'shades' ),
							'<a href="' . wp_get_attachment_url( $post->ID ) . '">' . sprintf( __( 'Original image', 'shades' ) ) . '</a>',
							$shades_image_meta['width'] . 'px',
							$shades_image_meta['height'] . 'px' )
						. '</div>';
				}
				/** End if - image meta - width / height */

				/** Author Credit with Copyright details */
				if ( $shades_image_meta['image_meta']['credit'] ) {
					echo '<br />' . sprintf( __( 'Credit: %1$s', 'shades' ), $shades_image_meta['image_meta']['credit'] );
					if ( $shades_image_meta['image_meta']['copyright'] ) {
						echo ' ';
					}
					/** End if - image meta - copyright */
				}
				/** End if - image meta - credit */
				if ( $shades_image_meta['image_meta']['copyright'] ) {
					printf( '&copy; %1$s %2$s', get_the_time( 'Y' ), $shades_image_meta['image_meta']['copyright'] );
				}
				/** End if - image meta - copyright */

				/** Creation timestamp in end-user settings format */
				if ( $shades_image_meta['image_meta']['created_timestamp'] ) {
					echo '<br />'
						. sprintf( __( 'Created (timestamp): %1$s', 'shades' ),
							get_the_time( get_option( 'date_format' ), $shades_image_meta['image_meta']['created_timestamp'] )
						);
				}
				/** End if - image meta - timestamp */

				/** Camera details */
				if ( $shades_image_meta['image_meta']['camera'] ) {
					echo '<br />' . sprintf( __( 'Camera: %1$s', 'shades' ), $shades_image_meta['image_meta']['camera'] );
				}
				/** End if - image meta - camera */

				/** Shutter speed */
				if ( $shades_image_meta['image_meta']['shutter_speed'] ) {
					echo ' ';
					echo '<br />'
						. __( 'Shutter speed:', 'shades' )
						. ' ';
					/** Shutter Speed Handler - "sec" is used as the short-form for time measured in seconds */
					if ( ( 1 / $shades_image_meta['image_meta']['shutter_speed'] ) > 1 ) {
						echo "1/";
						if ( number_format( ( 1 / $shades_image_meta['image_meta']['shutter_speed'] ), 1 ) == number_format( ( 1 / $shades_image_meta['image_meta']['shutter_speed'] ), 0 ) ) {
							echo number_format( ( 1 / $shades_image_meta['image_meta']['shutter_speed'] ), 0, '.', '' ) . ' ' . __( 'sec', 'shades' );
						} else {
							echo number_format( ( 1 / $shades_image_meta['image_meta']['shutter_speed'] ), 1, '.', '' ) . ' ' . __( 'sec', 'shades' );
						}
					} else {
						echo $shades_image_meta['image_meta']['shutter_speed'] . ' ' . __( 'sec', 'shades' );
					}
					/** End if image meta - shutter speed */
				}
				/** End if - image meta - shutter speed */

				/** Aperture Setting */
				if ( $shades_image_meta['image_meta']['aperture'] ) {
					echo '<br />' . sprintf( __( 'Aperture (F-stop): %1$s', 'shades' ), $shades_image_meta['image_meta']['aperture'] );
				}
				/** End if - image meta - aperture */

				/** Image caption from EXIF details */
				if ( $shades_image_meta['image_meta']['caption'] ) {
					echo '<br />' . sprintf( __( 'Caption: %1$s', 'shades' ), $shades_image_meta['image_meta']['caption'] );
				}
				/** End if - image meta - caption */

				/** Focal Length - "mm" is used as the short-form for millimeters */
				if ( $shades_image_meta['image_meta']['focal_length'] ) {
					echo '<br />' . sprintf( __( 'Focal Length: %1$s', 'shades' ), $shades_image_meta['image_meta']['focal_length'] ) . 'mm';
				}
				/** End if - image meta - focal length */

				/** ISO Speed */
				if ( $shades_image_meta['image_meta']['iso'] ) {
					echo '<br />' . sprintf( __( 'Speed: ISO %1$s', 'shades' ), $shades_image_meta['image_meta']['iso'] );
				}
				/** End if - image meta - ISO */

				/** Title from EXIF details */
				if ( $shades_image_meta['image_meta']['title'] ) {
					echo '<br />' . sprintf( __( 'Title: %1$s', 'shades' ), $shades_image_meta['image_meta']['title'] );
				} /** End if - image meta - title */
				?>

			</div>
			<!-- #the-loop -->
			<?php get_sidebar(); ?>
		</div>
		<!--end content-->
	</div><!--end wrapper-->
<?php get_footer();