<?php
/**
 * Functions Template
 *
 * @package     Shades
 * @since       1.0
 *
 * @link        http://buynowshop.com/themes/shades/
 * @link        https://github.com/Cais/shades/
 * @link        http://wordpress.org/themes/shades/
 *
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2009-2015, Edward Caissie
 *
 * @version     2.1
 * @date        March 4, 2013
 * Refactored code formatting and code block termination comments
 *
 * @version     2.1.1
 * @date        April 22, 2013
 * Added 'SHADES_HOME_URL' constant
 *
 * @version     2.3
 * @date        December 8, 2014
 * Added function wrapper for widget area registration and hooked it into `widgets_init` action
 * Added BNS Login support for dashicons
 *
 * @version     2.4
 * @date        May 31, 2015
 * Added `shades_loop` function for DRY reasons
 */

/** Define constant for easier updating */
define( 'SHADES_HOME_URL', 'BuyNowShop.com' );

if ( ! function_exists( 'shades_widget_areas' ) ) {

	/**
	 * Widget Areas
	 *
	 * Registers widget areas by hooking into the `widget_init` action
	 *
	 * @package  Shades
	 * @since    2.3
	 *
	 * @uses     register_sidebars
	 */
	function shades_widget_areas() {

		/** Widget definition */
		register_sidebars(
			2, array(
				'description'   => __( 'This is a widget area in the Theme sidebar', 'shades' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div><!-- .widget -->',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

	}

}
add_action( 'widgets_init', 'shades_widget_areas' );


if ( ! function_exists( 'shades_dynamic_copyright' ) ) {

	/**
	 * Shades Dynamic Copyright
	 *
	 * Creates a dynamic Copyright by statement by reading the year of the first
	 * published post and appending the current year as well as minimal boiler-
	 * plate text. Output is then echoed via an apply_filters call.
	 *
	 * @package     Shades
	 * @since       1.3.3
	 *
	 * @param   string $args
	 *
	 * @internal    param string start - initial text
	 * @internal    param string copy_years - (constructed) date text
	 * @internal    param string url - url link
	 * @internal    param string end - closing text
	 * @internal    param int transient_refresh - refresh in seconds; default one (1) month
	 *
	 * @uses        __
	 * @uses        apply_filters
	 * @uses        esc_attr
	 * @uses        get_bloginfo
	 * @uses        get_posts
	 * @uses        get_transient
	 * @uses        home_url
	 * @uses        set_transient
	 * @uses        wp_parse_args
	 *
	 * @version     1.8
	 * @date        April 20, 2012
	 * Renamed to `shades_dynamic_copyright`
	 *
	 * @version     2.2.1
	 * @date        May 31, 2014
	 * Improve performance impact by adding transient with one month refresh
	 */
	function shades_dynamic_copyright( $args = '' ) {

		$defaults = array(
			'start'             => '',
			'copy_years'        => '',
			'url'               => '',
			'end'               => '',
			'transient_refresh' => 2592000
		);

		$args = wp_parse_args( $args, $defaults );

		/** Initialize the output variable to empty */
		$output = '';

		/** Start common copyright notice */
		empty( $args['start'] )
			? $output .= sprintf( __( 'Copyright', 'shades' ) )
			: $output .= $args['start'];

		/** Calculate Copyright Years; and, prefix with Copyright Symbol */
		if ( empty( $args['copy_years'] ) ) {

			/** Take some of the load off with a transient of the first post */
			if ( ! get_transient( 'shades_copyright_first_post' ) ) {

				/** @var $all_posts - retrieve all published posts in ascending order */
				$all_posts = get_posts( 'post_status=publish&order=ASC' );
				/** @var $first_post - get the first post */
				$first_post = $all_posts[0];

				/** Set the transient (default: one month) */
				set_transient( 'shades_copyright_first_post', $first_post, $args['transient_refresh'] );

			}

			/** @var $first_date - get the date in a standardized format */
			$first_date = get_transient( 'shades_copyright_first_post' )->post_date_gmt;

			/** First post year versus current year */
			$first_year = substr( $first_date, 0, 4 );
			if ( $first_year == '' ) {
				$first_year = date( 'Y' );
			}

			/** Add to output string */
			if ( $first_year == date( 'Y' ) ) {

				/** Only use current year if no posts in previous years */
				$output .= ' &copy; ' . date( 'Y' );

			} else {

				$output .= ' &copy; ' . $first_year . "-" . date( 'Y' );

			}

		} else {

			$output .= ' &copy; ' . $args['copy_years'];

		}

		/** Create URL to link back to home of website */
		empty( $args['url'] )
			? $output .= ' <a href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a>  '
			: $output .= ' ' . $args['url'];

		/** End common copyright notice */
		empty( $args['end'] )
			? $output .= ' ' . sprintf( __( 'All rights reserved.', 'shades' ) )
			: $output .= ' ' . $args['end'];

		/** Construct and sprintf the copyright notice */
		$output = '<span id="shades-dynamic-copyright"> ' . $output . ' </span><!-- #shades-dynamic-copyright -->';

		echo apply_filters( 'shades_dynamic_copyright', $output, $args );

	}

}


if ( ! function_exists( 'shades_theme_version' ) ) {

	/**
	 * BNS Theme Version
	 *
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
	 *
	 * @version 2.3
	 * @date    November 30, 2014
	 * Use consistent code constructs
	 */
	function shades_theme_version() {

		/** @var $active_theme_data - array object containing the current theme's data */
		$active_theme_data = wp_get_theme();

		if ( is_child_theme() ) {

			/** @var $parent_theme_data - array object containing the Parent Theme's data */
			$parent_theme_data = $active_theme_data->parent();

			printf(
				'<br /><span id="shades-theme-version">' . __( '%1$s, v%2$s, was grown from the %3$s theme, v%4$s, created by %5$s.', 'shades' ) . '</span>',
				$active_theme_data->get( 'Name' ),
				$active_theme_data->get( 'Version' ),
				$parent_theme_data->get( 'Name' ),
				$parent_theme_data->get( 'Version' ),
				'<a href="http://' . SHADES_HOME_URL . '" title="' . SHADES_HOME_URL . '">' . SHADES_HOME_URL . '</a>'
			);

		} else {

			printf(
				'<br /><span id="shades-theme-version">' . __( 'This site is using the %1$s theme, v%2$s, from %3$s', 'shades' ),
				$active_theme_data->get( 'Name' ),
				$active_theme_data->get( 'Version' ),
				' <a href="http://' . SHADES_HOME_URL . '" title="' . SHADES_HOME_URL . '">' . SHADES_HOME_URL . '</a>.</span>'
			);

		}

	}

}


/** Tell WordPress to run shades_setup() when the 'after_setup_theme' hook is run. */
if ( ! function_exists( 'shades_setup' ) ) {

	/**
	 * Shades Setup
	 *
	 * Defines for core functionality supported by theme
	 *
	 * @package Shades
	 * @since   1.0
	 *
	 * @uses    __
	 * @uses    add_action
	 * @uses    add_editor_style
	 * @uses    add_theme_support
	 * @uses    apply_filters
	 * @uses    get_template_directory_uri
	 * @uses    home_url
	 * @uses    is_front_page
	 * @uses    is_home
	 * @uses    load_theme_textdomain
	 * @uses    register_nav_menu
	 * @uses    wp_list_pages
	 * @uses    wp_nav_menu
	 *
	 * @version 1.8
	 * @date    April 18, 2012
	 * Addressed call to deprecated function `add_custom_background`
	 *
	 * @version 2.0
	 * @date    December 3, 2012
	 * Added classes to inline glyph span styles and moved to style.css
	 *
	 * @version 2.3
	 * @date    November 23, 2014
	 * Added filter to allow supported post-formats to be easily extended
	 *
	 * @version 2.4
	 * @date    May 31, 2015
	 * Moved `$content_width` setting into `shades_setup` function
	 */
	function shades_setup() {

		/** This theme uses post thumbnails */
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );

		/** Add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' );

		/** Add Custom Background Support */
		add_theme_support(
			'custom-background', array(
				'default-color' => 'fff',
				'default-image' => ''
			)
		);

		/** Add post-formats support */
		add_theme_support(
			'post-formats', apply_filters( 'shades-post-formats', array(
				'aside',
				'quote',
				'status'
			) )
		);

		/** Add support for the `<title />` tag */
		add_theme_support( 'title-tag' );

		/** Assign glyphs via unique functions so they can be over-written in Child-Theme */
		if ( ! function_exists( 'shades_glyph_aside' ) ) {

			/**
			 * Shades Glyph - Aside
			 */
			function shades_glyph_aside() {
				$aside_glyph = '<span class="aside-glyph">';
				/** default: exclamation mark */
				$aside_glyph .= '!';
				$aside_glyph .= '</span>';
				echo apply_filters( 'shades_glyph_aside', $aside_glyph );
			}

		}


		if ( ! function_exists( 'shades_glyph_quote' ) ) {

			/**
			 * Shades Glyph - Quote
			 */
			function shades_glyph_quote() {
				$quote_glyph = '<span class="quote-glyph">';
				/** default: double-quote */
				$quote_glyph .= '"';
				$quote_glyph .= '</span>';
				echo apply_filters( 'shades_glyph_quote', $quote_glyph );
			}

		}


		if ( ! function_exists( 'shades_glyph_status' ) ) {

			/**
			 * Shades Glyph - Status
			 */
			function shades_glyph_status() {
				$status_glyph = '<span class="status-glyph">';
				/** default: amphere (at sign) */
				$status_glyph .= '@';
				$status_glyph .= '</span>';
				echo $status_glyph;
			}

		}

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

					wp_nav_menu(
						array(
							'menu_class'     => 'nav-menu',
							'theme_location' => 'top-menu',
							'fallback_cb'    => 'shades_list_pages'
						)
					);

				} else {

					shades_list_pages();

				}

			}

		}


		if ( ! function_exists( 'shades_list_pages' ) ) {

			/**
			 * Shades List Pages
			 * Fallback for Shades Navigation Menu
			 *
			 * @uses    wp_list_pages
			 */
			function shades_list_pages() {

				if ( is_home() || is_front_page() ) { ?>

					<ul class="nav-menu">
						<?php wp_list_pages( 'title_li=' ); ?>
					</ul>

				<?php } else { ?>

					<ul class="nav-menu">

						<li>
							<a href="<?php echo home_url(); ?>"><?php _e( 'Home', 'shades' ); ?></a>
						</li>

						<?php wp_list_pages( 'title_li=' ); ?>

					</ul><!-- nav-menu -->

				<?php }

			}

		}

		if ( ! function_exists( 'register_shades_menu' ) ) {

			/**
			 * Register Shades Menu
			 *
			 * @uses    register_nav_menu
			 */
			function register_shades_menu() {
				register_nav_menu( 'top-menu', __( 'Top Menu', 'shades' ) );
			}

		}
		add_action( 'init', 'register_shades_menu' );


		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 */
		load_theme_textdomain( 'shades', get_template_directory() . '/languages' );
		$locale      = get_locale();
		$locale_file = get_template_directory_uri() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

		/** Set the content width based on the theme's design and stylesheet, see #the-loop element in style.css */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 630;
		}

	}

}
add_action( 'after_setup_theme', 'shades_setup' );


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
	 * @param   string $sep       - separator character
	 *
	 * @uses    (GLOBAL) $page
	 * @uses    (GLOBAL) $paged
	 * @uses    __
	 * @uses    get_bloginfo
	 * @uses    is_front_page
	 * @uses    is_home
	 *
	 * @return  string - new title text
	 *
	 * @version 2.3
	 * @date    November 23, 2014
	 * Removed unused parameter
	 */
	function shades_wp_title( $old_title, $sep ) {

		global $page, $paged;

		/** Set initial title text */
		$shades_title_text = $old_title . get_bloginfo( 'name' );

		/** Add wrapping spaces to separator character */
		$sep = ' ' . $sep . ' ';

		/** Add the blog description (tagline) for the home/front page */
		$site_tagline = get_bloginfo( 'description', 'display' );

		if ( $site_tagline && ( is_home() || is_front_page() ) ) {
			$shades_title_text .= "$sep$site_tagline";
		}

		/** Add a page number if necessary */
		if ( $paged >= 2 || $page >= 2 ) {
			$shades_title_text .= $sep . sprintf( __( 'Page %s', 'shades' ), max( $paged, $page ) );
		}

		return $shades_title_text;

	}

}
add_filter( 'wp_title', 'shades_wp_title', 10, 2 );


if ( ! function_exists( 'shades_modified_post' ) ) {

	/**
	 * Shades Modified Post
	 * If the post time and the last modified time are different display
	 * modified date and time
	 *
	 * @uses             (global) $post
	 * @uses             get_post_meta
	 * @uses             get_userdata
	 * @uses             get_the_time
	 * @uses             get_the_modified_time
	 * @uses             home_url
	 * @uses             get_the_modified_date
	 *
	 * Last revised April 20, 2012
	 * @version          1.8
	 * Added link to modified author's post archive.
	 */
	function shades_modified_post() {

		global $post;

		$last_user = '';
		if ( $last_id = get_post_meta( $post->ID, '_edit_last', true ) ) {
			$last_user = get_userdata( $last_id );
		}

		if ( get_the_time() <> get_the_modified_time() ) {

			/** CSS wrapper for modified date details */
			echo '<h6 class="shades-modified-post">';
			printf(
				__( 'Last modified by %1$s on %2$s @ %3$s.', 'shades' ),
				'<a href="' . home_url( '?author=' . $last_user->ID ) . '">' . $last_user->display_name . '</a>',
				get_the_modified_date( get_option( 'date_format' ) ),
				get_the_modified_time( get_option( 'time_format' ) )
			);
			echo '</h6><!-- .shades-modified-post -->';

		}

	}

}

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
			? $shades_no_title = '<a href="' . get_permalink() . '" title="' . the_title_attribute(
				array(
					'before' => 'Permalink to: ',
					'after'  => '',
					'echo'   => '1'
				)
			) . '"><span class="no-title">' . __( 'Posted', 'shades' ) . '</span></a>'
			: $shades_no_title = __( 'Posted', 'shades' );

		return $shades_no_title;

	}

}

if ( ! function_exists( 'shades_enqueue_comment_reply' ) ) {

	/**
	 * Enqueue Comment Reply Script
	 * If the page being viewed is a single post/page; and, comments are open; and,
	 * threaded comments are turned on then enqueue the built-in comment-reply
	 * script.
	 *
	 * @package Shades
	 * @since   1.9
	 *
	 * @uses    get_option
	 * @uses    is_singular
	 * @uses    wp_enqueue_script
	 *
	 * @version 2.0
	 * @date    December 7, 2012
	 * Change conditional to show "Threaded Comments" if they are open or closed.
	 */
	function shades_enqueue_comment_reply() {

		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}

}
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
	}

}

if ( ! function_exists( 'shades_loop' ) ) {

	/**
	 * Shades Loop
	 *
	 * @package Shades
	 * @since   2.4
	 *
	 * @uses    comments_template
	 * @uses    get_post_format
	 * @uses    get_template_part
	 * @uses    have_posts
	 * @uses    is_singular
	 * @uses    the_post
	 */
	function shades_loop() {

		if ( have_posts() ) {

			while ( have_posts() ) {

				the_post();
				get_template_part( 'content', get_post_format() );

				if ( is_singular() ) {
					comments_template();
				}

			}

		} else {

			get_template_part( 'shades-no-posts' );

		}

	}


	/**
	 * Get the Author Posts Link
	 *
	 * Borrowed from WordPress core `the_author_posts_link` to return the string
	 * instead of echoing it to the screen
	 *
	 * @package Shades
	 * @since   2.4
	 *
	 * @uses    __
	 * @uses    apply_filters
	 * @uses    esc_attr
	 * @uses    esc_url
	 * @uses    get_author_posts_url
	 * @uses    get_the_author
	 *
	 * @param bool $echo
	 *
	 * @return bool|mixed|void
	 */
	function shades_get_the_author_posts_link( $echo = false ) {

		global $authordata;

		if ( ! is_object( $authordata ) ) {
			return false;
		}

		$link = sprintf(
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
			esc_attr( sprintf( __( 'Posts by %s', 'shades' ), get_the_author() ) ),
			get_the_author()
		);

		/**
		 * Filter the link to the author page of the author of the current post.
		 *
		 * @param string $link HTML link.
		 */
		$link = apply_filters( 'the_author_posts_link', $link );

		/** To echo or not to echo, that is the question. */
		if ( false == $echo ) {
			return $link;
		} else {
			echo $link;
		}

		/** Should never see this line but it insures a clean ending */

		return false;

	}

}

/** Changes BNS Login to use Dashicons */
add_filter( 'bns_login_dashed_set', '__return_true' );