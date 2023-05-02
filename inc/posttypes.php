<?php

add_action( 'init', 'case_init_posttype' );

function case_init_posttype() {

		$case_args = array(
			'labels'               => array(
				'name'               => 'Case Study',
				'singular_name'      => 'Case Study',
				'all_items'          => 'Case Study',
				'add_new'            => 'Dodaj Case Study',
				'add_new_item'       => 'Dodaj Case Study',
				'edit_item'          => 'Edytuj Case Study',
				'new_item'           => 'Nowe Case Study',
				'view_item'          => 'Zobacz Case Study',
				'search_items'       => 'Szukaj',
				'not_found'          => 'Nie znaleziono żadnych Case Study',
				'not_found_in_trash' => 'Nie znaleziono żadnych Case Study w koszu',
				'parent_item_colon'  => '',
			),
			'public'               => true,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'query_var'            => true,
			'category_description' => true,
			'rewrite'              => true,
			'capability_type'      => 'post',
			'hierarchical'         => true,
			'menu_position'        => 5,
			'menu_icon'            => 'dashicons-chart-line',
			'supports'             => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'post-formats',
				'page-attributes',
			),
			'rewrite'              => array(
				'slug' => 'case-study',
			),
			'has_archive'          => true,
		);

		register_post_type( 'case_study', $case_args );
}

add_action( 'init', 'opinions_init_posttype' );

function opinions_init_posttype() {

		$opinie_args = array(
			'labels'               => array(
				'name'               => 'Opinie',
				'singular_name'      => 'Opinia',
				'all_items'          => 'Opinie',
				'add_new'            => 'Dodaj nową opinię',
				'add_new_item'       => 'Dodaj nową opinię',
				'edit_item'          => 'Edytuj opinię',
				'new_item'           => 'Nowa opinia',
				'view_item'          => 'Zobacz opinię',
				'search_items'       => 'Szukaj',
				'not_found'          => 'Nie znaleziono żadnych opinii',
				'not_found_in_trash' => 'Nie znaleziono żadnych opinii w koszu',
				'parent_item_colon'  => '',
			),
			'public'               => true,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'query_var'            => true,
			'category_description' => true,
			'rewrite'              => true,
			'capability_type'      => 'post',
			'hierarchical'         => true,
			'exclude_from_search'  => true,
			'menu_position'        => 5,
			'menu_icon'            => 'dashicons-megaphone',
			'supports'             => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'post-formats',
				'page-attributes',
			),
			'rewrite'              => array(
				'slug' => 'opinie',
			),
			'has_archive'          => false,
		);

		register_post_type( 'opinie', $opinie_args );
}

add_action( 'init', 'clients_init_posttype' );

function clients_init_posttype() {

	$clients_args = array(
		'labels'               => array(
			'name'               => 'Klienci',
			'singular_name'      => 'Klient',
			'all_items'          => 'Klienci',
			'add_new'            => 'Dodaj klienta',
			'add_new_item'       => 'Dodaj klienta',
			'edit_item'          => 'Edytuj klienta',
			'new_item'           => 'Nowa klient',
			'view_item'          => 'Zobacz klienta',
			'search_items'       => 'Szukaj',
			'not_found'          => 'Nie znaleziono żadnych klientów',
			'not_found_in_trash' => 'Nie znaleziono żadnych klientów w koszu',
			'parent_item_colon'  => '',
		),
		'public'               => true,
		'publicly_queryable'   => false,
		'show_ui'              => true,
		'query_var'            => true,
		'category_description' => true,
		'rewrite'              => true,
		'capability_type'      => 'post',
		'hierarchical'         => true,
		'exclude_from_search'  => true,
		'menu_position'        => 6,
		'menu_icon'            => 'dashicons-buddicons-buddypress-logo',
		'supports'             => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'post-formats',
			'page-attributes',
		),
		'rewrite'              => array(
			'slug' => 'klienci',
		),
		'has_archive'          => false,
	);

	register_post_type( 'clients', $clients_args );
}

add_action( 'init', 'team_init_posttype' );

function team_init_posttype() {

	$team_args = array(
		'labels'               => array(
			'name'               => 'Zespół',
			'singular_name'      => 'Pracownik',
			'all_items'          => 'Zespół',
			'add_new'            => 'Dodaj pracownika',
			'add_new_item'       => 'Dodaj pracownika',
			'edit_item'          => 'Edytuj pracownika',
			'new_item'           => 'Nowa pracownika',
			'view_item'          => 'Zobacz pracownika',
			'search_items'       => 'Szukaj',
			'not_found'          => 'Nie znaleziono żadnych pracowników',
			'not_found_in_trash' => 'Nie znaleziono żadnych pracowników w koszu',
			'parent_item_colon'  => '',
		),
		'public'               => true,
		'publicly_queryable'   => false,
		'show_ui'              => true,
		'query_var'            => true,
		'category_description' => true,
		'rewrite'              => true,
		'capability_type'      => 'post',
		'hierarchical'         => false,
		'exclude_from_search'  => true,
		'menu_position'        => 7,
		'menu_icon'            => 'dashicons-id',
		'supports'             => array(
			'title',
			'editor',
			'author',
			'thumbnail',
			'excerpt',
			'post-formats',
			'page-attributes',
		),
		'rewrite'              => array(
			'slug' => 'o-nas/zespol/archiwum',
		),
		'has_archive'          => false,
	);

	register_post_type( 'team', $team_args );
}

add_action( 'init', 'job_init_posttype' );

function job_init_posttype() {

	$team_args = array(
		'labels'               => array(
			'name'               => 'Oferty pracy',
			'singular_name'      => 'Oferta',
			'all_items'          => 'Oferty',
			'add_new'            => 'Dodaj ofertę',
			'add_new_item'       => 'Dodaj ofertę',
			'edit_item'          => 'Edytuj ofertę',
			'new_item'           => 'Nowa oferta',
			'view_item'          => 'Zobacz ofertę',
			'search_items'       => 'Szukaj',
			'not_found'          => 'Nie znaleziono żadnych ofert',
			'not_found_in_trash' => 'Nie znaleziono żadnych ofert w koszu',
			'parent_item_colon'  => '',
		),
		'public'               => true,
		'publicly_queryable'   => true,
		'show_ui'              => true,
		'query_var'            => true,
		'category_description' => true,
		'rewrite'              => true,
		'capability_type'      => 'post',
		'hierarchical'         => false,
		'menu_position'        => 7,
		'menu_icon'            => 'dashicons-open-folder',
		'supports'             => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'post-formats',
			'page-attributes',
		),
		'rewrite'              => array(
			'slug' => 'o-nas/dolacz-do-nas/oferty',
		),
		'has_archive'          => false,
	);

	register_post_type( 'job', $team_args );
}

function echo_create_jobs_taxonomy() {

	register_taxonomy(
		'job-category',
		'job',
		array(
			'label'               => __( 'Categories' ),
			'rewrite'             => array( 'slug' => 'o-nas/dolacz-do-nas/oferty-pracy' ),
			'hierarchical'        => true,
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
		)
	);
}

add_action( 'init', 'echo_create_jobs_taxonomy' );

