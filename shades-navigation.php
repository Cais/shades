<?php
/**
 * Shades Navigation
 *
 * Navigation between posts
 *
 * @package     Shades
 * @since       1.8
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        https://wordpress.org/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 *
 * @version     2.4
 * @date        May 31, 2015
 * Adjusted output to move arrow symbols outside of i18n implementation
 */ ?>

<div id="nav-global" class="navigation">

	<div class="left">
		<?php next_posts_link( '&laquo; ' . __( 'Older posts', 'shades' ) ); ?>
	</div>

	<div class="right">
		<?php previous_posts_link( __( 'Newer posts', 'shades' ) . ' &raquo;' ); ?>
	</div>

</div>