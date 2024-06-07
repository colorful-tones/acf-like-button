<?php
/**
 * Plugin Name: ACF Like plugin
 * Description: Register ACF post meta for likes.
 * Text Domain: wpe
 * Version: 1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Register custom post types.
require plugin_dir_path( __FILE__ ) . 'inc/custom-post-types.php';
// Register ACF fields.
require plugin_dir_path( __FILE__ ) . 'inc/meta-fields.php';
// Custom login page.
require plugin_dir_path( __FILE__ ) . 'inc/custom-login.php';

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function wpe_register_acf_blocks() {
	/**
	 * We register our block's with WordPress's handy
	 * register_block_type();
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	register_block_type( __DIR__ . '/build/like-button' );
	register_block_type( __DIR__ . '/build/like-count' );
}
add_action( 'init', 'wpe_register_acf_blocks' );

/**
 * Handles the submission of like button block.
 *
 * This function is responsible for processing the submission from the user.
 * It verifies the nonce, and updates the user's liked items.
 *
 * @return void
 */
function wpe_block_submission_handler() {
	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'itemLike_nonce' ) ) {
		die( 'Security check failed' );
	}

	$user_id     = isset( $_POST['userId'] ) ? intval( $_POST['userId'] ) : 0;
	$liked_items = json_decode( $_POST['likedItems'] );

	update_field( 'field_663d21bace40e', $liked_items, 'user_' . $user_id );

	wp_die();
}
add_action( 'wp_ajax_submit_like', 'wpe_block_submission_handler' );
add_action( 'wp_ajax_nopriv_submit_like', 'wpe_block_submission_handler' );

/**
 * Adds an icon to the post title based on the post type.
 *
 * @param string $title The original post title.
 * @param int|null $id The post ID. Default is null.
 * @return string The modified post title with an icon.
 */
function wpe_add_icon_to_post_title( $title, $id = null ) {
	if ( is_admin() ) {
		return $title;
	}

	if ( in_the_loop() && is_main_query() ) {
		$post_type = get_post_type( $id );

		switch ( $post_type ) {
			case 'post':
				$icon = '📖 ';
				break;
			case 'movie':
				$icon = '🎞️ ';
				break;
			case 'song':
				$icon = '🎧 ';
				break;
			default:
				$icon = '';
				break;
		}

		return $icon . $title;
	}

	return $title;
}
add_filter( 'the_title', 'wpe_add_icon_to_post_title', 10, 2 );

/**
 * Function to remove the admin bar for non-admin users.
 *
 * This function checks if the current user has the capability to activate plugins
 * and if the current page is not an admin page. If both conditions are met, it
 * hides the admin bar.
 *
 * @return void
 */
function wpe_remove_admin_bar() {
	if ( ! current_user_can( 'activate_plugins' ) && ! is_admin() ) {
		show_admin_bar( false );
	}
}
add_action( 'after_setup_theme', 'wpe_remove_admin_bar' );
