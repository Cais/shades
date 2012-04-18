<?php
/**
 * Search Form
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
 */ ?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
    <label class="hidden" for="s"><?php _e( 'Search for:', 'shades' ); ?></label>
    <div id="search-container">
        <input type="text" value="<?php _e( 'Looking for something?', 'shades' ); ?>" onblur="if(this.value == '') {this.value = '<?php _e( 'Looking for something?', 'shades' ); ?>';}" onfocus="if(this.value == '<?php _e( 'Looking for something?', 'shades' ); ?>') {this.value = '';}" name="s" id="s" />
        <input type="submit" class="hidden" id="search-submit" value="<?php _e('Search' , 'shades'); ?>" />
    </div><!-- #search-container -->
</form>