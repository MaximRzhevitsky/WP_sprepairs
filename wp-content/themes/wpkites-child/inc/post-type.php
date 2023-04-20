<?php


function max_custom_post_type_repairs() {
	$labels = array(
		'name'                  => 'ремонти',
		'singular_name'         => 'ремонт',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'repairs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail' ),
	);

	register_post_type( 'repairs', $args );
}

add_action( 'init', 'max_custom_post_type_repairs' );







