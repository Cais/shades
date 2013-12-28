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
 * @link        http://wordpress.org/extend/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2013, Edward Caissie
 */
?>
<div id="nav-global" class="navigation">
    <div class="left">
        <?php next_posts_link(__('&laquo; Older posts', 'shades')); ?>
    </div>
    <div class="right">
        <?php previous_posts_link(__('Newer posts &raquo;', 'shades')); ?>
    </div>
</div>