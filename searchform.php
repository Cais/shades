<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<label class="hidden" for="s"><?php _e( 'Search for:', 'shades' ); ?></label>
	<div id="search-container">
		<input type="text" value="<?php _e( 'Looking for something?', 'shades' ); ?>" onblur="if(this.value == '') {this.value = '<?php _e( 'Looking for something?', 'shades' ); ?>';}" onfocus="if(this.value == '<?php _e( 'Looking for something?', 'shades' ); ?>') {this.value = '';}" name="s" id="s" />
		<input type="submit" class="hidden" id="search-submit" value="<?php _e('Search' , 'shades'); ?>" />
	</div> <!-- #search-container -->
</form>
<?php /* Last Revision: Sept 6, 2010, v1.6 */ ?>