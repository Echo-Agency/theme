<?php
function get_all_stylesheets() {
	global $wp_styles;

	echo '<pre>Style:<br><br>';
	print_r( $wp_styles->queue );
	echo '</pre>';
}
	add_action( 'wp_print_styles', 'get_all_stylesheets' );

function get_all_scripts() {
	global $wp_scripts;

	echo '<pre>Skrypty:<br><br>';
	print_r( $wp_scripts->queue );
	echo '</pre>';
}
	add_action( 'wp_print_scripts', 'get_all_scripts' );

