<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );

	// Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	// Get the theme data
	$the_theme = wp_get_theme();
	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.purged.css', array(), $the_theme->get( 'Version' ) );
	wp_enqueue_style( 'child-webo-custom-styles', get_stylesheet_directory_uri() . '/css/custom.css', array('child-understrap-styles'), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );

	if ( is_post_type_archive( 'case_study' ) ) {
		wp_enqueue_script( 'jquery.youtube-background', get_stylesheet_directory_uri() . '/js/jquery.youtube-background.min.js', array(), $the_theme->get( 'Version' ), true );
	}

	// wp_enqueue_script('child-understrap-shuffle', get_stylesheet_directory_uri() . '/js/shuffle.min.js', array(), $the_theme->get('Version'), true);
}

function add_child_theme_textdomain() {
	 load_child_theme_textdomain( 'understrap', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

require_once 'inc/clear-header.php';
require_once 'inc/acf-option-pages.php';
require_once 'inc/posttypes.php';
require_once 'inc/shortcodes.php';
require_once 'inc/images.php';
require_once 'inc/icons.php';
require_once 'inc/widgets.php'; // override understrap inc/widgets.php for wigets sizes
require_once 'inc/contact-form-7.php';
require_once 'inc/rate-my-post.php';
require_once 'inc/custom-comments.php';          // Custom Comments file.
// require_once 'inc/print-all-scripts-and-styles.php';

// require_once 'inc/yoast-structured-data/localbusiness.php';

add_filter( 'yoast_seo_development_mode', '__return_true' );


add_theme_support( 'yoast-seo-breadcrumbs' );

// disable xmlrpc
function remove_xmlrpc_methods( $methods ) {
	return array();
}
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_methods' );

if ( ! is_admin() ) {

	function add_defer_attribute( $tag, $handle ) {
		// add script handles to the array below
		$scripts_to_defer = array(
			'child-understrap-scripts',
			'cookie-notice-front',
			'jquery-core',
			'jquery-migrate',
			'rate-my-post',
			'jquery.youtube-background',
		);

		foreach ( $scripts_to_defer as $defer_script ) {
			if ( $defer_script === $handle ) {
				return str_replace( ' src', ' defer="defer" src', $tag );
			}
		}

		return $tag;
	}


	add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );

	function add_asyncdefer_attribute( $tag, $handle ) {
		// if the unique handle/name of the registered script has 'async' in it
		if ( strpos( $handle, 'async' ) !== false ) {
			// return the tag with the async attribute
			return str_replace( '<script ', '<script async ', $tag );
		} elseif ( strpos( $handle, 'defer' ) !== false ) {
			// return the tag with the defer attribute
			return str_replace( '<script ', '<script defer ', $tag );
		} else {
			return $tag;
		}
	}
	add_filter( 'script_loader_tag', 'add_asyncdefer_attribute', 10, 2 );
}

add_filter( 'use_block_editor_for_post', '__return_false' );


function hide_editor() {
	remove_post_type_support( 'page', 'editor' );
	remove_post_type_support( 'post', 'editor' );
}
add_action( 'admin_init', 'hide_editor' );


function disable_autosave() {
	wp_deregister_script( 'autosave' );
}
// add_action( 'admin_init', 'disable_autosave' ); //moveed to wp-config


add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );

function remove_core_updates() {
	global $wp_version;

	return (object) array(
		'last_checked'    => time(),
		'version_checked' => $wp_version,
	);
}

// add_filter( 'pre_site_transient_update_core', 'remove_core_updates' );
// add_filter( 'pre_site_transient_update_plugins', 'remove_core_updates' );
add_filter( 'pre_site_transient_update_themes', 'remove_core_updates' );

add_filter(
	'wp_resource_hints',
	function ( array $urls, string $relation ) : array {
		// If the relation is different than dns-prefetch, leave the URLs intact
		if ( 'dns-prefetch' !== $relation ) {
			return $urls;
		}

		// return array();

		// Remove s.w.org entry
		$urls = array_filter(
			$urls,
			function ( string $url ) : bool {
				return strpos( $url, 's.w.org' ) === false;
			}
		);
		// List of domains to prefetch:
		$dns_prefetch_urls = array(
			'www.googletagmanager.com',
			'www.google-analytics.com',
		);
		return array_merge( $urls, $dns_prefetch_urls );
	},
	0,
	2
);

// add_filter( 'comments_open', '__return_false', 20, 2 );

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'understrap_posted_on' ) ) {
	function understrap_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_date() < get_the_modified_date() ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> ' . icon_update() . '%4$s </time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = apply_filters(
			'understrap_posted_on',
			sprintf(
				'<span class="posted-on">' . icon_calendar() . '%1$s</span>',
				apply_filters( 'understrap_posted_on_time', $time_string )
			)
		);
		// $byline      = apply_filters(
		// 'understrap_posted_by',
		// sprintf(
		// '<span class="byline">' . icon_person() . ' %1$s<span class="author vcard"><a class="url fn n" href="%2$s"> %3$s</a></span></span>',
		// $posted_on ? esc_html_x( 'by', 'post author', 'understrap' ) : esc_html_x( 'Posted by', 'post author', 'understrap' ),
		// esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		// esc_html( get_the_author() )
		// )
		// );
		// echo $posted_on . ' / ' . $byline; // WPCS: XSS OK.
		echo $posted_on;  // WPCS: XSS OK.
		// echo '<div class="col-sm-12 entry-meta-decor"><div class="row"><div class="col-6 col-lg-2 entry-meta-decor-left"></div><div class="col-6 col-lg-10 entry-meta-decor-right"></div></div></div>';
	}
}

add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );

if ( ! function_exists( 'understrap_all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function understrap_all_excerpts_get_more_link( $post_excerpt ) {
		if ( ! is_admin() ) {
			$post_excerpt = $post_excerpt . ' <p><a class="btn btn-accent" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . __( 'Read More...', 'understrap' ) . '</a></p>';
		}
		return $post_excerpt;
	}
}

function echo_display_intro( $text ) {
	return wp_trim_words( $text, 30 );
}

function set_libs_scripts_loaded_global() {

	global $lightbox_scripts_loaded;
	$lightbox_scripts_loaded = false;

	global $slick_scripts_loaded;
	$slick_scripts_loaded = false;

}

add_action( 'after_setup_theme', 'set_libs_scripts_loaded_global' );

// remove wp version number from scripts and styles
function remove_css_js_version( $src ) {
	if ( strpos( $src, '?ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_version', 9999 );
add_filter( 'script_loader_src', 'remove_css_js_version', 9999 );

function acf_orphans( $value, $post_id, $field ) {
	if ( class_exists( 'iworks_orphan' ) ) {
		$orphan = new \iworks_orphan();
		$value  = $orphan->replace( $value );
	}
	return $value;
}
  add_filter( 'acf/format_value/type=textarea', 'acf_orphans', 10, 3 );
  add_filter( 'acf/format_value/type=wysiwyg', 'acf_orphans', 10, 3 );

function display_rating( $rating = 0 ) {
	return str_repeat( '<span class="star"></span>', round( $rating ) );
}

// add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );
// function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
// global $post;

// $breadcrumb[] = array(
// 'url' => get_permalink( 2 ),
// 'text' => ' ',
// );

// array_splice( $links, 0, -1, $breadcrumb );

// return $links;
// }

add_filter( 'wpseo_breadcrumb_single_link', 'wpseo_remove_breadcrumb_link', 10, 2 );

function wpseo_remove_breadcrumb_link( $link_output, $link ) {
	$text_to_remove = 'Home';

	if ( $link['text'] == $text_to_remove ) {
		$link_output = str_replace( 'Home', '', $link_output );
	}

	return $link_output;
}

add_filter( 'wpseo_breadcrumb_single_link', 'wpseo_remove_breadcrumb_link2', 10, 2 );

function wpseo_remove_breadcrumb_link2( $link_output, $link ) {

	if ( 0 == strpos( $link['text'], 'Page' ) ) {
		$link_output = str_replace( 'Page', 'Strona', $link_output );
	}

	return $link_output;
}

function doublee_filter_yoast_breadcrumb_output( $output ) {

	$from   = '<span>';
	$to     = '</span>';
	$output = str_replace( $from, $to, $output );

	return $output;
}
add_filter( 'wpseo_breadcrumb_output', 'doublee_filter_yoast_breadcrumb_output' );

function remove_taxonomy_term_from_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}

add_filter( 'wpseo_canonical', 'echo_wpseo_canonical' );

function echo_wpseo_canonical( $canonical ) {
	if ( is_paged() ) {

		if ( is_archive() ) {
			$url = get_category_link( get_queried_object_id() );
			return $url;
		}
	}

	return $canonical;
}

add_filter( 'wpseo_robots', 'echo_pagination_noindex' );
function echo_pagination_noindex( $robotsstr ) {
	if ( is_page() && is_paged() ) {
			return 'noindex,follow';
	}
	return $robotsstr;
}

add_filter( 'get_the_archive_title', 'remove_taxonomy_term_from_title' );

add_action( 'pre_get_posts', 'echo_change_sort_order' );

function echo_change_sort_order( $query ) {
	if ( is_post_type_archive( 'team' ) || is_post_type_archive( 'case_study' ) ) :

		$query->set( 'order', 'ASC' );
		// Set the orderby
		$query->set( 'orderby', 'menu_order' );
	endif;

	if ( is_post_type_archive( 'case_study' ) ) :
		$query->set( 'posts_per_page', -1 );
	endif;
};

function echo_show_tags( $limit = null, $separator = ', ', $icon = true ) {
	$post_tags = get_the_tags();
	$output    = '';

	if ( ! empty( $post_tags ) ) {

		if ( $limit && $limit < count( $post_tags ) ) {
			$post_tags = array_slice( $post_tags, 0, $limit );
		}

		if ( $icon ) {
			$output .= icon_tag();
		}

		foreach ( $post_tags as $tag ) {
			$output .= '<a title="' . __( $tag->name ) . '" href="' . esc_attr( get_tag_link( $tag->term_id ) ) . '">' . __( $tag->name ) . '</a>' . $separator;
		}
	}

	return trim( $output, $separator );
}

function my_acf_change_tables( $value, $post_id, $field ) {
	if ( is_string( $value ) ) {
		$value = str_replace( '<table class="wp-block-table', '<table class="table table-responsive table-striped', $value );
	}
	return $value;
}

// Apply to all textarea fields.
add_filter( 'acf/load_value/type=wysiwyg', 'my_acf_change_tables', 10, 3 );

add_action(
	'init',
	function() {
		$GLOBALS['wp_rewrite']->pagination_base = 'strona';
	}
);


// remove profile url for Zespół Echo user id 24, Artur B. user id 18
function display_coauthors_posts_links() {
	global $post;

	$authors          = get_coauthors( $post->ID );
	$disabled_authors = array( 8, 11, 14, 18, 19, 24, 25 );

	$authors_data = '';

	// var_dump($authors);

	$count_authors = count( $authors );
	$i             = 0;

	foreach ( $authors as $author ) {
		$i++;

		if ( in_array( $author->ID, $disabled_authors ) ) {
			echo $author->display_name;

			if ( $i < $count_authors ) {
				echo ', ';
			}
		} else {
			echo '<a href="' . get_author_posts_url( $author->ID ) . '">' . get_the_author_meta( 'display_name', $author->ID ) . '</a>';
			if ( $i < $count_authors ) {
				echo ', ';
			}
		}
	}

}

function echo_custom_author_base() {
	global $wp_rewrite;
	$wp_rewrite->author_base = 'autor';
}
add_action( 'init', 'echo_custom_author_base' );


function get_youtube_video_cover( $post_id ) {
	$page_builder = get_field_object( 'page_builder' );

	// var_dump($page_builder);

	$video_decors = $page_builder['value'][0]['flexible_content'][0]['column_video_video_decors'];

	$video_decors_type = null;

	if ( $video_decors ) {
		$video_decors_type = $page_builder['value'][0]['flexible_content'][0]['column_video_video_decors_type'];
	}

	$video_iframe = $page_builder['value'][0]['flexible_content'][0]['column_video_video_iframe'];

	preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_iframe, $match );

	$youtube_id = $match[1];

	$video_cover = 'https://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';

	?>
		<div class="youtube_video_cover" style="background-image:url('<?php echo $video_cover; ?>')">
			<?php if ( $video_decors && $video_decors_type ) : ?>
				<div class="youtube_video_cover_decor youtube_video_cover_decor_<?php echo $video_decors_type; ?>">
					<div class="youtube_video_cover_decor_plus">
						<?php echo icon_plus(); ?>
					</div>
					<div class="youtube_video_cover_decor_multiply">
						<?php echo icon_multiply(); ?>
					</div>
					<div class="youtube_video_cover_decor_power">
						<?php echo icon_power(); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php
}

function echo_comment_moderation_recipients( $emails, $comment_id ) {
	$comment = get_comment( $comment_id );
	$post    = get_post( $comment->comment_post_ID );
	$user    = get_user_by( 'id', '16' ); // 16 = Anna

	// Return only the post author if the author can modify.
	if ( user_can( $user->ID, 'edit_published_posts' ) && ! empty( $user->user_email ) ) {
		$emails = array( $user->user_email );
	}

	return $emails;
}
add_filter( 'comment_moderation_recipients', 'echo_comment_moderation_recipients', 11, 2 );
add_filter( 'comment_notification_recipients', 'echo_comment_moderation_recipients', 11, 2 );

/**
 * This function modifies the main WordPress query to remove
 * pages from search results.
 *
 * @param object $query The main WordPress query.
 */
function echo_exclude_pages_from_search_results( $query ) {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}
add_action( 'pre_get_posts', 'echo_exclude_pages_from_search_results' );

// Filter to hide protected posts
function exclude_protected( $where ) {
	global $wpdb;
	return $where .= " AND {$wpdb->posts}.post_password = '' ";
}

// Decide where to display them
function exclude_protected_action( $query ) {
	if ( ! is_single() && ! is_page() && ! is_admin() ) {
		add_filter( 'posts_where', 'exclude_protected' );
	}
}

// Action to queue the filter at the right time
add_action( 'pre_get_posts', 'exclude_protected_action' );


/**
 * Add iFrame to allowed wp_kses_post tags
 *
 * @param array  $tags Allowed tags, attributes, and/or entities.
 * @param string $context Context to judge allowed tags by. Allowed values are 'post'.
 *
 * @return array
 */
function custom_wpkses_post_tags( $tags, $context ) {

	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}

	return $tags;
}

add_filter( 'wp_kses_allowed_html', 'custom_wpkses_post_tags', 10, 2 );