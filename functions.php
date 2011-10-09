<?php
// Widget definitions
if ( function_exists( 'register_sidebar' ) )
    register_sidebars( 2, array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div><!-- .widget -->',
				'before_title' => '<h2 class="widget-title">',
				'after_title' => '</h2>',
				) );

// Start BNS Dynamic Copyright
if ( ! function_exists( 'bns_dynamic_copyright' ) ) {
  function bns_dynamic_copyright( $args = '' ) {
      $initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
      $args = wp_parse_args( $args, $initialize_values );

      /* Initialize the output variable to empty */
      $output = '';

      /* Start common copyright notice */
      empty( $args['start'] ) ? $output .= sprintf( __('Copyright', 'shades') ) : $output .= $args['start'];

      /* Calculate Copyright Years; and, prefix with Copyright Symbol */
      if ( empty( $args['copy_years'] ) ) {
        /* Get all posts */
        $all_posts = get_posts( 'post_status=publish&order=ASC' );
        /* Get first post */
        $first_post = $all_posts[0];
        /* Get date of first post */
        $first_date = $first_post->post_date_gmt;

        /* First post year versus current year */
        $first_year = substr( $first_date, 0, 4 );
        if ( $first_year == '' ) {
          $first_year = date( 'Y' );
        }

      /* Add to output string */
        if ( $first_year == date( 'Y' ) ) {
        /* Only use current year if no posts in previous years */
          $output .= ' &copy; ' . date( 'Y' );
        } else {
          $output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
        }
      } else {
        $output .= ' &copy; ' . $args['copy_years'];
      }

      /* Create URL to link back to home of website */
      empty( $args['url'] ) ? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) .'</a>  ' : $output .= ' ' . $args['url'];

      /* End common copyright notice */
      empty( $args['end'] ) ? $output .= ' ' . sprintf( __( 'All rights reserved.', 'shades' ) ) : $output .= ' ' . $args['end'];

      /* Construct and sprintf the copyright notice */
      $output = sprintf( __( '<span id="bns-dynamic-copyright"> %1$s </span><!-- #bns-dynamic-copyright -->', 'shades' ), $output );
      $output = apply_filters( 'bns_dynamic_copyright', $output, $args );

      echo $output;
  }
}
// End BNS Dynamic Copyright

// Start BNS Theme Version
if ( ! function_exists( 'bns_theme_version' ) ) {
  function bns_theme_version () {
      $theme_version = ''; /* Clear variable */
      /* Get details of the theme / child theme */
      $blog_css_url = get_stylesheet_directory() . '/style.css';
      $my_theme_data = get_theme_data( $blog_css_url );
      $parent_blog_css_url = get_template_directory() . '/style.css';
      $parent_theme_data = get_theme_data( $parent_blog_css_url );

      if ( is_child_theme() ) {
        printf( __( '<br /><span id="bns-theme-version">%1$s, v%2$s, was grown from the %3$s theme, v%4$s, created by <a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>.</span>', 'shades' ), $my_theme_data['Name'], $my_theme_data['Version'], $parent_theme_data['Name'], $parent_theme_data['Version'] );
      } else {
        printf( __( '<br /><span id="bns-theme-version">The %1$s theme, version %2$s, is a %3$s creation.</span>', 'shades' ), $my_theme_data['Name'], $my_theme_data['Version'], '<a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>' );
      }
  }
}
// End BNS Theme Version

// Tell WordPress to run shades_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'shades_setup' );

if ( ! function_exists( 'shades_setup' ) ):
  function shades_setup(){
    	// This theme uses post thumbnails
    	add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
    	
    	// Add default posts and comments RSS feed links to head
    	add_theme_support( 'automatic-feed-links' );
    	
    	// Add post-formats support
    	add_theme_support( 'post-formats', array( 'aside', 'quote', 'status' ) );
      /* Assign glyphs via unique functions so they can be over-written in Child-Theme */
      if ( !function_exists( 'shades_glyph_aside' ) ) {	
        function shades_glyph_aside() { 
            $aside_glyph = "<span style='font-family: \"Times New Roman\", Arial, sans-serif; font-size: 1000%'>";
            $aside_glyph .= __( '!', 'shades' ); /* default: exclamation mark */
            $aside_glyph .= '</span>';
            echo $aside_glyph;
        }
      }
    
      if ( !function_exists( 'shades_glyph_quote' ) ) {	
        function shades_glyph_quote() { 
            $quote_glyph = "<span style='font-family: \"Times New Roman\", Arial, sans-serif; font-size: 1000%'>";
            $quote_glyph .= __( '"', 'shades' ); /* default: double-quote */
            $quote_glyph .= '</span>';
            echo $quote_glyph;
        }
      }
    
      if ( !function_exists( 'shades_glyph_status' ) ) {	
        function shades_glyph_status() { 
            $status_glyph = "<span style='font-family: \"Times New Roman\", Arial, sans-serif; font-size: 500%'>";
            $status_glyph .= __( '@', 'shades' ); /* default: amphere (at sign) */
            $status_glyph .= '</span>';
            echo $status_glyph;
        }
      }
    
    	// Add theme support for editor-style
    	add_editor_style();
    	
    	// This theme allows users to set a custom background
    	add_custom_background();
    	
    	// Add wp_nav_menu() custom menu support
    	if ( ! function_exists( 'shades_nav_menu' ) ) {
        function shades_nav_menu() {
      	    if ( function_exists( 'wp_nav_menu' ) )
              wp_nav_menu( array(
                  'menu_class' => 'nav-menu',
      				   'theme_location' => 'top-menu',
      				   'fallback_cb' => 'shades_list_pages'
      				   ) );
      	    else
              shades_list_pages();
      	}
    	}
    	
    	if ( ! function_exists( 'shades_list_pages' ) ) {
        function shades_list_pages() {
            if ( is_home() || is_front_page() ) { ?>
              <ul class="nav-menu"><?php wp_list_pages( 'title_li=' ); ?></ul>
            <?php } else { ?>
              <ul class="nav-menu">
                <li><a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'shades' ); ?></a></li>
                <?php wp_list_pages( 'title_li=' ); ?>
              </ul>
            <?php }
        }
      }
    	
    	add_action( 'init', 'register_shades_menu' );
    	if (! function_exists( 'register_shades_menu' ) ) {
      	function register_shades_menu() {
      	    register_nav_menu( 'top-menu', __( 'Top Menu', 'shades' ) );
      	}
      }
    	// wp_nav_menu() end
    	
    	// Make theme available for translation
    	// Translations can be filed in the /languages/ directory
    	load_theme_textdomain( 'shades', get_template_directory_uri() . '/languages' );
    	$locale = get_locale();
    	$locale_file = get_template_directory_uri() . "/languages/$locale.php";
    	if ( is_readable( $locale_file ) )
    	    require_once( $locale_file );
  }
endif;

// Start Shades Modified Post
if ( ! function_exists( 'shades_modified_post' ) ) {
  function shades_modified_post(){
      /* If the post time and the last modified time are different display modified date and time */
      if ( get_the_time() <> get_the_modified_time() ) {
        echo '<h6 class="shades-modified-post">'; /* CSS wrapper for modified date details */
        printf( __( 'Last modified by %1$s on %2$s @ %3$s.', 'shades' ), get_the_modified_author(), get_the_modified_date( get_option( 'date_format' ) ), get_the_modified_time ( get_option( 'time_format' ) ) );
        echo '</h6><!-- .shades-modified-post -->';
      }
  }
}
// End: Shades Modified Post

// Start Shades Use Posted (for posts without titles)
if ( ! function_exists( 'shades_use_posted' ) ) {
  function shades_use_posted() {
      $shades_no_title = '';
      $shades_no_title = get_the_title();
      empty( $shades_no_title )
        ? $shades_no_title = '<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '', 'echo' => '1' ) ) . '"><span class="no-title">' . __( 'Posted', 'shades' ) . '</span></a>'
        : $shades_no_title = __( 'Posted', 'shades' );
      return $shades_no_title;
  }
}
// End: Shades Use Posted

// Set the content width based on the theme's design and stylesheet, see #the-loop element in style.css
if ( ! isset( $content_width ) ) $content_width = 630;

// include the BNS Theme Add-Ins for addtional functionality
if ( file_exists( get_stylesheet_directory() . '/bns-theme-add-ins.php' ) )
  include( get_stylesheet_directory() . '/bns-theme-add-ins.php' );
?>
<?php /* Last revised September 29, 2011 v1.7.1 */ ?>