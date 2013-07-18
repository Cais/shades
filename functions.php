<?php
/**
 * Functions Template
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
 * @version     2.0
 * @date        December 3, 2012
 *
 * @version     2.1
 * @date        March 4, 2013
 * Refactored code formatting and code block termination comments
 *
 * @version     2.1.1
 * @date        April 22, 2013
 * Added 'SHADES_HOME_URL' constant
 */

/** Define constant for easier updating */
define( 'SHADES_HOME_URL', 'BuyNowShop.com' );

/** Widget definition */
register_sidebars( 2, array(
    'description'   => __( 'This is a widget area in the Theme sidebar', 'shades' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div><!-- .widget -->',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );

if ( ! function_exists( 'shades_dynamic_copyright' ) ) {
    /**
     * Shades Dynamic Copyright
     * Creates a dynamic Copyright by statement by reading the year of the first
     * published post and appending the current year as well as minimal boiler-
     * plate text. Output is then echoed via an apply_filters call.
     *
     * @param   string $args
     * @internal    param string start - initial text
     * @internal    param string copy_years - (constructed) date text
     * @internal    param string url - url link
     * @internal    param string end - closing text
     *
     * @uses    apply_filters
     * @uses    get_posts
     * @uses    wp_parse_args
     *
     * Last revised April 20, 2012
     * @version 1.8
     * Renamed to `shades_dynamic_copyright`
     */
    function shades_dynamic_copyright( $args = '' ) {
        $initialize_values = array( 'start' => '', 'copy_years' => '', 'url' => '', 'end' => '' );
        $args = wp_parse_args( $args, $initialize_values );

        /** Initialize the output variable to empty */
        $output = '';

        /** Start common copyright notice */
        empty( $args['start'] ) ? $output .= sprintf( __('Copyright', 'shades') ) : $output .= $args['start'];

        /** Calculate Copyright Years; and, prefix with Copyright Symbol */
        if ( empty( $args['copy_years'] ) ) {
            /** Get all posts */
            $all_posts = get_posts( 'post_status=publish&order=ASC' );
            /** Get first post */
            $first_post = $all_posts[0];
            /** Get date of first post */
            $first_date = $first_post->post_date_gmt;
            /** First post year versus current year */
            $first_year = substr( $first_date, 0, 4 );
            if ( $first_year == '' ) {
                $first_year = date( 'Y' );
            } /** End if - first year */
            /** Add to output string */
            if ( $first_year == date( 'Y' ) ) {
                /** Only use current year if no posts in previous years */
                $output .= ' &copy; ' . date( 'Y' );
            } else {
                $output .= ' &copy; ' . $first_year . "-" . date( 'Y' );
            } /** End if - first year */
        } else {
            $output .= ' &copy; ' . $args['copy_years'];
        } /** End if - empty copy years */

        /** Create URL to link back to home of website */
        empty( $args['url'] )
            ? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) .'</a>  '
            : $output .= ' ' . $args['url'];

        /** End common copyright notice */
        empty( $args['end'] )
            ? $output .= ' ' . sprintf( __( 'All rights reserved.', 'shades' ) )
            : $output .= ' ' . $args['end'];

        /** Construct and sprintf the copyright notice */
        $output = sprintf( __( '<span id="shades-dynamic-copyright"> %1$s </span><!-- #shades-dynamic-copyright -->', 'shades' ), $output );

        echo apply_filters( 'shades_dynamic_copyright', $output, $args );

    } /** End function - dynamic copyright */
} /** End if - function exists */


if ( ! function_exists( 'shades_theme_version' ) ) {
    /**
     * BNS Theme Version
     * Displays the theme name and version; also accounts for a Child-Theme if present
     *
     * @uses    is_child_theme
     * @uses    wp_get_theme
     * @uses    parent
     *
     * @version 1.9.1
     * Removed deprecated function call
     *
     * @version 2.1.1
     * @date    April 22, 2013
     * Added 'SHADES_HOME_URL' constant in place of the hardcoded domain URL
     * Re-Added Theme Version output for Parent-Theme usage
     */
    function shades_theme_version () {
        /** @var $active_theme_data - array object containing the current theme's data */
        $active_theme_data = wp_get_theme();

        if ( is_child_theme() ) {

            /** @var $parent_theme_data - array object containing the Parent Theme's data */
            $parent_theme_data = $active_theme_data->parent();
            /** @noinspection PhpUndefinedMethodInspection - IDE commentary */
            printf( __( '<br /><span id="shades-theme-version">%1$s, v%2$s, was grown from the %3$s theme, v%4$s, created by %5$s.</span>', 'shades' ),
                $active_theme_data['Name'],
                $active_theme_data['Version'],
                $parent_theme_data['Name'],
                $parent_theme_data['Version'],
                '<a href="http://' . SHADES_HOME_URL . '" title="' . SHADES_HOME_URL . '">' . SHADES_HOME_URL . '</a>'
            );

        } else {

            printf( __( '<br /><span id="shades-theme-version">This site is using the %1$s theme, v%2$s, from <a href="http://' . SHADES_HOME_URL . '" title="' . SHADES_HOME_URL . '">' . SHADES_HOME_URL . '</a>.</span>', 'shades' ),
                $active_theme_data->get( 'Name' ),
                $active_theme_data->get( 'Version' ) );

        } /** End if - is child theme */


    } /** End function - theme version */

} /** End if - function exists */


/** Tell WordPress to run shades_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'shades_setup' );
if ( ! function_exists( 'shades_setup' ) ) {
    /**
     * Shades Setup
     * Defines for core functionality supported by theme
     *
     * @version 1.8
     * @date    April 18, 2012
     * Addressed call to deprecated function `add_custom_background`
     *
     * @version 2.0
     * @date    December 3, 2012
     * Added classes to inline glyph span styles and moved to style.css
     */
    function shades_setup() {
        /** This theme uses post thumbnails */
        add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
        /** Add default posts and comments RSS feed links to head */
        add_theme_support( 'automatic-feed-links' );
        /** Add Custom Background Support */
        add_theme_support( 'custom-background' , array(
            'default-color' => 'fff',
            'default-image' => ''
        ) );


        /** Add post-formats support */
        add_theme_support( 'post-formats', array( 'aside', 'quote', 'status' ) );


        /** Assign glyphs via unique functions so they can be over-written in Child-Theme */
        if ( ! function_exists( 'shades_glyph_aside' ) ) {
            /**
             * Shades Glyph - Aside
             */
            function shades_glyph_aside() {
                $aside_glyph = '<span class="aside-glyph">';
                /** default: exclamation mark */
                $aside_glyph .= __( '!', 'shades' );
                $aside_glyph .= '</span>';
                echo apply_filters( 'shades_glyph_aside', $aside_glyph );
            } /** End function - glyph aside */
        } /** End if - function exists */


        if ( ! function_exists( 'shades_glyph_quote' ) ) {
            /**
             * Shades Glyph - Quote
             */
            function shades_glyph_quote() {
                $quote_glyph = '<span class="quote-glyph">';
                /** default: double-quote */
                $quote_glyph .= __( '"', 'shades' );
                $quote_glyph .= '</span>';
                echo apply_filters( 'shades_glyph_quote', $quote_glyph );
            } /** End function - glyph quote */
        } /** End if - function exists */


        if ( ! function_exists( 'shades_glyph_status' ) ) {
            /**
             * Shades Glyph - Status
             */
            function shades_glyph_status() {
                $status_glyph = '<span class="status-glyph">';
                /** default: amphere (at sign) */
                $status_glyph .= __( '@', 'shades' );
                $status_glyph .= '</span>';
                echo $status_glyph;
            } /** End function - glyph status */
        } /** End if - function exists */


        /** Add theme support for editor-style */
        add_editor_style();


        if ( ! function_exists( 'shades_nav_menu' ) ) {
            /**
             * Shades Navigation Menu
             * Adds custom menu support
             *
             * @uses    shades_list_pages
             * @uses    wp_nav_menu
             */
            function shades_nav_menu() {
                if ( function_exists( 'wp_nav_menu' ) ) {
                    wp_nav_menu( array(
                        'menu_class'        => 'nav-menu',
                        'theme_location'    => 'top-menu',
                        'fallback_cb'       => 'shades_list_pages'
                    ) );
                } else {
                    shades_list_pages();
                } /** End if function exists */
            } /** End function - nav menu */
        } /** End if - function exists */


        if ( ! function_exists( 'shades_list_pages' ) ) {
            /**
             * Shades List Pages
             * Fallback for Shades Navigation Menu
             *
             * @uses    wp_list_pages
             */
            function shades_list_pages() {
                if ( is_home() || is_front_page() ) { ?>
                    <ul class="nav-menu"><?php wp_list_pages( 'title_li=' ); ?></ul>
                <?php
                } else { ?>
                    <ul class="nav-menu">
                        <li>
                            <a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'shades' ); ?></a>
                        </li>
                        <?php wp_list_pages( 'title_li=' ); ?>
                    </ul><!-- nav-menu -->
                <?php
                } /** End if - is home */
            } /** End function - list pages */
        } /** End if - function exists */


        if ( ! function_exists( 'register_shades_menu' ) ) {
            /**
             * Register Shades Menu
             *
             * @uses    register_nav_menu
             */
            function register_shades_menu() {
                register_nav_menu( 'top-menu', __( 'Top Menu', 'shades' ) );
            } /** End function - register menu */
        } /** End if - function exists */
        add_action( 'init', 'register_shades_menu' );


    	/**
         * Make theme available for translation
         * Translations can be filed in the /languages/ directory
         */
        load_theme_textdomain( 'shades', get_template_directory_uri() . '/languages' );
        $locale = get_locale();
        $locale_file = get_template_directory_uri() . "/languages/$locale.php";
        if ( is_readable( $locale_file ) ) {
            require_once( $locale_file );
        } /** End if - is readable */

    } /** End function - setup */

} /** End if - function exists */


if ( ! function_exists( 'shades_wp_title' ) ) {
    /**
     * Shades WP Title
     * Utilizes the `wp_title` filter to add text to the default output
     *
     * @package Shades
     * @since   1.9
     *
     * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
     * @link    https://gist.github.com/1410493
     *
     * @param   string $old_title - default title text
     * @param   string $sep - separator character
     * @param   string $sep_location - left|right - separator placement in relationship to title
     *
     * @uses    (global) $page
     * @uses    (global) $paged
     * @uses    get_bloginfo
     * @uses    is_front_page
     * @uses    is_home
     *
     * @return  string - new title text
     */
    function shades_wp_title( $old_title, $sep, $sep_location ) {
        global $page, $paged;
        /** Set initial title text */
        $shades_title_text = $old_title . get_bloginfo( 'name' );
        /** Add wrapping spaces to separator character */
        $sep = ' ' . $sep . ' ';

        /** Add the blog description (tagline) for the home/front page */
        $site_tagline = get_bloginfo( 'description', 'display' );
        if ( $site_tagline && ( is_home() || is_front_page() ) ) {
            $shades_title_text .= "$sep$site_tagline";
        } /** End if - site tagline */

        /** Add a page number if necessary */
        if ( $paged >= 2 || $page >= 2 ) {
            $shades_title_text .= $sep . sprintf( __( 'Page %s', 'shades' ), max( $paged, $page ) );
        } /** End if - paged */

        return $shades_title_text;

    } /** End function - wp title */
} /** End if - function exists */
add_filter( 'wp_title', 'shades_wp_title', 10, 3 );


if ( ! function_exists( 'shades_modified_post' ) ) {
    /**
     * Shades Modified Post
     * If the post time and the last modified time are different display
     * modified date and time
     *
     * @uses    (global) $post
     * @uses    get_post_meta
     * @uses    get_userdata
     * @uses    get_the_time
     * @uses    get_the_modified_time
     * @uses    home_url
     * @uses    get_the_modified_date
     *
     * Last revised April 20, 2012
     * @version 1.8
     * Added link to modified author's post archive.
     */
    function shades_modified_post(){

        global $post;
        $last_user = '';
        if ( $last_id = get_post_meta($post->ID, '_edit_last', true) ) {
            $last_user = get_userdata($last_id);
        } /** End if - last id */

        if ( get_the_time() <> get_the_modified_time() ) {
            /** CSS wrapper for modified date details */
            echo '<h6 class="shades-modified-post">';
            printf( __( 'Last modified by %1$s on %2$s @ %3$s.', 'shades' ),
                '<a href="' . home_url( '?author=' . $last_user->ID ) . '">' . $last_user->display_name . '</a>',
                get_the_modified_date( get_option( 'date_format' ) ),
                get_the_modified_time( get_option( 'time_format' ) ) );
            echo '</h6><!-- .shades-modified-post -->';
        } /** End if - get the time */

    } /** End function - modified post */
} /** End if - function exists */


if ( ! function_exists( 'shades_use_posted' ) ) {
    /**
     * Shades Use Posted
     * For posts without titles
     *
     * @uses    get_the_title
     * @uses    get_permalink
     *
     * @return  string text only|URL to post
     */
    function shades_use_posted() {
        $shades_no_title = get_the_title();
        empty( $shades_no_title )
            ? $shades_no_title = '<a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '', 'echo' => '1' ) ) . '"><span class="no-title">' . __( 'Posted', 'shades' ) . '</span></a>'
            : $shades_no_title = __( 'Posted', 'shades' );
        return $shades_no_title;
    } /** End function - use posted */
} /** End if - function exists */


/**
 * Enqueue Comment Reply Script
 * If the page being viewed is a single post/page; and, comments are open; and,
 * threaded comments are turned on then enqueue the built-in comment-reply
 * script.
 *
 * @package Shades
 * @since   1.9
 *
 * @uses    comments_open
 * @uses    get_option
 * @uses    is_singular
 * @uses    wp_enqueue_script
 *
 * @version 2.0
 * @date    December 7, 2012
 * Change conditional to show "Threaded Comments" if they are open or closed.
 */
if ( ! function_exists( 'shades_enqueue_comment_reply' ) ) {
    function shades_enqueue_comment_reply() {
        if ( is_singular() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        } /** End if - is singular */
    } /** End function - enqueue comment reply */
} /** End if - function exists */
add_action( 'comment_form_before', 'shades_enqueue_comment_reply' );


/**
 * Show Featured Image
 * Displays the Featured Image allowing the size to be set
 *
 * @package Shades
 * @since   2.1.1
 *
 * @param   $size
 *
 * @uses    has_post_thumbnail
 * @uses    the_post_thumbnail
 */
function shades_show_featured_image( $size ) {
    if ( is_home() || is_front_page() && has_post_thumbnail() ) {
        the_post_thumbnail( $size, array( 'class' => 'aligncenter' ) );
    } /** End if - is home */
} /** End function - show featured image */


/** Set the content width based on the theme's design and stylesheet, see #the-loop element in style.css */
if ( ! isset( $content_width ) ) {
    $content_width = 630;
} /** End if - content width */