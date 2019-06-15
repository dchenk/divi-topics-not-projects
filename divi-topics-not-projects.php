<?php
/*
Plugin Name: Divi Topics instead of Projects
Plugin URI: https://widerwebs.com
Description: Rename Divi's "projects" custom post type to "topics".
Version: 1.0
Author: Wider Webs
Author URI: https://widerwebs.com
License: Private
*/

function custom_divi_register_topic_type() {
	$postTypeArgs = [
		'has_archive'        => true,
		'hierarchical'       => false,
		'labels'             => [
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Topic',
			'all_items'          => 'All Topics',
			'edit_item'          => 'Edit Topic',
			'menu_name'          => 'Speaking Topics',
			'name'               => 'Speaking Topics',
			'new_item'           => 'New Topic',
			'not_found_in_trash' => 'Nothing found in Trash',
			'search_items'       => 'Search Topics',
			'singular_name'      => 'Topic',
			'view_item'          => 'View Topic',
		],
		'menu_icon'          => 'dashicons-megaphone',
		'public'             => true,
		'publicly_queryable' => true,
		'query_var'          => true,
		'show_in_nav_menus'  => true,
		'show_ui'            => true,
		'rewrite'            => apply_filters('et_project_posttype_rewrite_args', [
			'feeds'          => true,
			'slug'           => 'topic',
			'with_front'     => false
		]),
		'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields']
	];

	register_post_type('project', apply_filters('et_project_posttype_args', $postTypeArgs));

	register_taxonomy('project_category', ['project'], [
		'hierarchical' => true,
		'labels'       => [
			'name'              => 'Categories',
			'singular_name'     => 'Category',
			'search_items'      => 'Search Categories',
			'all_items'         => 'All Categories',
			'parent_item'       => 'Parent Category',
			'parent_item_colon' => 'Parent Category:',
			'edit_item'         => 'Edit Category',
			'update_item'       => 'Update Category',
			'add_new_item'      => 'Add New Category',
			'new_item_name'     => 'New Category Name',
			'menu_name'         => 'Categories',
		],
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	]);

	register_taxonomy('project_tag', ['project'], [
		'hierarchical'      => false,
		'labels'            => [
			'name'              => 'Tags',
			'singular_name'     => 'Tag',
			'search_items'      => 'Search Tags',
			'all_items'         => 'All Tags',
			'parent_item'       => 'Parent Tag',
			'parent_item_colon' => 'Parent Tag:',
			'edit_item'         => 'Edit Tag',
			'update_item'       => 'Update Tag',
			'add_new_item'      => 'Add New Tag',
			'new_item_name'     => 'New Tag Name',
			'menu_name'         => 'Tags'
		],
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true
	]);
}

add_action('init', 'custom_divi_register_topic_type', 20);

// Create a shortcode for displaying the previous/next links on testimonial posts.
function topic_nav_links() {
	return '<div class="topic-nav"><span class="nav-next">' .
		get_next_post_link('%link', 'Next Topic <span style="font-family: ETmodules;">&#x3d;</span>', true, [], 'project_category') .
		'</span><span class="nav-previous">' .
		get_previous_post_link('%link', '<span style="font-family: ETmodules;">&#x3c;</span> Previous Topic', true, [], 'project_category') .
		'</span></div>';
}
add_shortcode('topic_nav_links', 'topic_nav_links');
