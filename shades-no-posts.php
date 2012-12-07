<?php
/**
 * Shades No Posts
 *
 * Used if no posts are returned by "the_Loop" query
 *
 * @package     Shades
 * @since       1.8
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 */
?>
<h2><?php printf( __( 'Search Results for: %s', 'shades' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
<p class="center"><?php _e( 'Sorry, but you are looking for something that is not here.', 'shades' ); ?></p>
<?php get_search_form();