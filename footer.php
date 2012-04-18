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
 * @internal    REQUIRES WordPress version 3.1.0
 * @internal    Tested up to WordPress version 3.4
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2012, Edward Caissie
 */
?>
    <div id="bottom">
        <div id="bottom-container">
            <p>
                <?php
                bns_dynamic_copyright();
                bns_theme_version(); ?>
            </p>
            <div id="footer"></div>
        </div><!-- #bottom-container -->
    </div><!-- #bottom -->
</div><!-- #mainwrap -->
<?php wp_footer(); ?>
</body>
</html>