<?php

/**
 * 1. Create CPT in ACF
 * 2. Go to ACF > Tools > Export Post Type > Generate PHP
 * 3. Copy and paste below...
 */

add_action('init', function () {
	register_post_type('song', array(
		'labels' => array(
			'name' => 'Songs',
			'singular_name' => 'Song',
			'menu_name' => 'Songs',
			'all_items' => 'All Songs',
			'edit_item' => 'Edit Song',
			'view_item' => 'View Song',
			'view_items' => 'View Songs',
			'add_new_item' => 'Add New Song',
			'add_new' => 'Add New Song',
			'new_item' => 'New Song',
			'parent_item_colon' => 'Parent Song:',
			'search_items' => 'Search Songs',
			'not_found' => 'No movies found',
			'not_found_in_trash' => 'No movies found in Trash',
			'archives' => 'Song Archives',
			'attributes' => 'Song Attributes',
			'insert_into_item' => 'Insert into song',
			'uploaded_to_this_item' => 'Uploaded to this song',
			'filter_items_list' => 'Filter movies list',
			'filter_by_date' => 'Filter movies by date',
			'items_list_navigation' => 'Songs list navigation',
			'items_list' => 'Songs list',
			'item_published' => 'Song published.',
			'item_published_privately' => 'Song published privately.',
			'item_reverted_to_draft' => 'Song reverted to draft.',
			'item_scheduled' => 'Song scheduled.',
			'item_updated' => 'Song updated.',
			'item_link' => 'Song Link',
			'item_link_description' => 'A link to a song.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-format-audio',
		'supports' => array(
			0 => 'title',
			1 => 'editor',
			2 => 'thumbnail',
		),
		'has_archive' => 'songs',
		'rewrite' => array(
			'feeds' => false,
		),
		'delete_with_user' => false,
	));
});

add_action('init', function () {
	register_post_type('movie', array(
		'labels' => array(
			'name' => 'Movies',
			'singular_name' => 'Movie',
			'menu_name' => 'Movies',
			'all_items' => 'All Movies',
			'edit_item' => 'Edit Movie',
			'view_item' => 'View Movie',
			'view_items' => 'View Movies',
			'add_new_item' => 'Add New Movie',
			'add_new' => 'Add New Movie',
			'new_item' => 'New Movie',
			'parent_item_colon' => 'Parent Movie:',
			'search_items' => 'Search Movies',
			'not_found' => 'No movies found',
			'not_found_in_trash' => 'No movies found in Trash',
			'archives' => 'Movie Archives',
			'attributes' => 'Movie Attributes',
			'insert_into_item' => 'Insert into movie',
			'uploaded_to_this_item' => 'Uploaded to this movie',
			'filter_items_list' => 'Filter movies list',
			'filter_by_date' => 'Filter movies by date',
			'items_list_navigation' => 'Movies list navigation',
			'items_list' => 'Movies list',
			'item_published' => 'Movie published.',
			'item_published_privately' => 'Movie published privately.',
			'item_reverted_to_draft' => 'Movie reverted to draft.',
			'item_scheduled' => 'Movie scheduled.',
			'item_updated' => 'Movie updated.',
			'item_link' => 'Movie Link',
			'item_link_description' => 'A link to a movie.',
		),
		'public' => true,
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-format-video',
		'supports' => array(
			0 => 'title',
			1 => 'editor',
			2 => 'thumbnail',
		),
		'has_archive' => 'movies',
		'rewrite' => array(
			'feeds' => false,
		),
		'delete_with_user' => false,
	));
});
