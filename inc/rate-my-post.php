<?php


function load_rate_my_post_scripts() {
	if ( is_single() ) {
		wp_enqueue_style( 'rate-my-post' );
		wp_enqueue_script( 'rate-my-post' );
	}
}

add_action( 'wp_enqueue_scripts', 'load_rate_my_post_scripts', 21 );  // dequeue has priority 20
