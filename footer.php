<?php
/**
 * Footer Template
 *
 * @package     Shades
 * @since       1.0
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
 * Changed namespace of *_dynamic_copyright and *_theme_version
 */ ?>

    <div id="bottom">
        <div id="bottom-container">
            <p>
                <?php
                shades_dynamic_copyright();
                shades_theme_version(); ?>
            </p>
            <div id="footer"></div>
        </div><!-- #bottom-container -->
    </div><!-- #bottom -->
</div><!-- #mainwrap -->
<?php wp_footer(); ?>
</body>
</html>