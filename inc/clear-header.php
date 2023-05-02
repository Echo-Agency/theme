<?php

function echo_dequeue_scripts() {

	wp_dequeue_script( 'google-recaptcha' );
	wp_dequeue_script( 'wpcf7-recaptcha' );

	wp_dequeue_script( 'rate-my-post' );
	wp_dequeue_style( 'rate-my-post' );
	wp_dequeue_style( 'post-views-counter-frontend' );

	if ( is_user_logged_in() ) {
		return;
	}
	wp_dequeue_style( 'dashicons' );
	wp_dequeue_style( 'wp-block-library' );// gutenberg editor
	wp_deregister_script( 'wp-embed' );

	// echo '<pre>';
	// print_r(wp_styles());
	// exit;
}
add_action( 'wp_enqueue_scripts', 'echo_dequeue_scripts', 20 );


function disable_emojis() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

add_action( 'init', 'disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


function disable_feeds() {
	wp_redirect( home_url() );
	die;
}

// Disable global RSS, RDF & Atom feeds.
// add_action( 'do_feed', 'disable_feeds', -1 );
add_action( 'do_feed_rdf', 'disable_feeds', -1 );
add_action( 'do_feed_rss', 'disable_feeds', -1 );
add_action( 'do_feed_rss2', 'disable_feeds', -1 );
add_action( 'do_feed_atom', 'disable_feeds', -1 );

// Disable comment feeds.
add_action( 'do_feed_rss2_comments', 'disable_feeds', -1 );
add_action( 'do_feed_atom_comments', 'disable_feeds', -1 );

// Prevent feed links from being inserted in the <head> of the page.
add_action( 'feed_links_show_posts_feed', '__return_false', -1 );
add_action( 'feed_links_show_comments_feed', '__return_false', -1 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

// remove type="text/javascript"
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'html5', array( 'script', 'style' ) );
	}
);
