<?php
/**
 * Create pages in admin panel with additional settings fields
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page(
		array(
			'page_title' => __( 'Website settings', 'understrap' ),
			'menu_title' => __( 'Website settings', 'understrap' ),
			'menu_slug'  => 'website-settings',
			'capability' => 'edit_posts',
		)
	);

	acf_add_options_page(
		array(
			'page_title'  => __( 'Case study settings', 'understrap' ),
			'menu_title'  => __( 'Case study settings', 'understrap' ),
			'menu_slug'   => 'case-study-settings',
			'capability'  => 'edit_posts',
			'parent_slug' => 'edit.php?post_type=case_study',
			'icon_url'    => 'dashicons-admin-generic',
		)
	);

	// acf_add_options_page(
	// array(
	// 'page_title' => __( 'Team settings', 'understrap' ),
	// 'menu_title' => __( 'Team settings', 'understrap' ),
	// 'menu_slug'  => 'team-settings',
	// 'capability' => 'edit_posts',
	// 'parent_slug' => 'edit.php?post_type=team',
	// 'icon_url' => 'dashicons-admin-generic',
	// )
	// );
}
