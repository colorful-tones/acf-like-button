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

$post               = get_post();
$icon               = file_get_contents( plugin_dir_path( __DIR__ ) . '../assets/svg/empty-heart.svg' );
$wrapper_attributes = get_block_wrapper_attributes(
	array( 'class' => 'wpe-like-button' )
);

wp_interactivity_state(
	'wpe/like-button',
	array(
		'isItemIncluded' => false,
		'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
		'nonce'          => wp_create_nonce( 'itemLike_nonce' ),
	),
);

?>

<div
	<?php echo wp_kses_data( $wrapper_attributes ); ?>
	data-wp-interactive="wpe/like-button"
	data-wp-context='{ "post": { "id": <?php echo $post->ID; ?> } }'
>
	<button
		class="wpe-like-button__button"
		data-wp-on--click="actions.toggleLike"
		data-wp-class--wpe-liked="state.isItemIncluded"
	>
		<span class="screen-reader-text"><?php esc_html_e( 'Like', 'like-button' ); ?></span>

		<?php echo $icon; ?>
	</button>
</div>
