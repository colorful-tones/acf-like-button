<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// If not logged in then stop.
if ( ! is_user_logged_in() ) {
	return;
}

$user_id            = get_current_user_id();
$user_liked_items   = get_field( 'liked_items', 'user_' . $user_id );
$user_avatar        = get_avatar( $user_id, 32 );
$icon               = file_get_contents( plugin_dir_path( __DIR__ ) . '../assets/svg/empty-heart.svg' );
$wrapper_attributes = get_block_wrapper_attributes(
	array( 'class' => 'wpe-like-count' )
);

wp_interactivity_state(
	'wpe/like-button',
	array(
		'isLikedItemsNotEmpty' => false,
		'likesCount'           => 0,
		'likedItems'           => $user_liked_items ? $user_liked_items : array(),
		'userId'               => $user_id,
	),
);

?>

<div
	<?php echo wp_kses_data( $wrapper_attributes ); ?>
	data-wp-interactive="wpe/like-button"
	data-wp-class--wpe-liked="state.isLikedItemsNotEmpty"
	data-wp-bind--hidden="!state.isLikedItemsNotEmpty"
>
	<a class="wpe-like-count__link" href="<?php echo esc_url( get_edit_profile_url( $user_id ) . '#wpe_profile_likes' ); ?>" title="<?php esc_html_e( 'Manage your likes', 'like-button' ); ?>">
		<?php echo $user_avatar; ?>
		<?php echo $icon; ?>

		<span class="wpe-like-count__number" data-wp-text="state.likesCount"></span>
	</a>
</div>
