<?php

/**
 * Register ACF post meta for likes.
 *
 * @link https://www.advancedcustomfields.com/resources/register-fields-via-php/
 */
add_action(
	'acf/include_fields',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'                   => 'group_663d21ba6c51e',
				'title'                 => 'User\'s Likes',
				'fields'                => array(
					array(
						'key'                  => 'field_663d21bace40e',
						'label'                => 'Liked Items',
						'name'                 => 'liked_items',
						'aria-label'           => '',
						'type'                 => 'relationship',
						'instructions'         => '',
						'required'             => 0,
						'conditional_logic'    => 0,
						'wrapper'              => array(
							'width' => '',
							'class' => '',
							'id'    => 'wpe_profile_likes',
						),
						'post_type'            => array(
							0 => 'song',
							1 => 'movie',
							2 => 'post',
						),
						'post_status'          => array(
							0 => 'publish',
						),
						'taxonomy'             => '',
						'filters'              => array(
							0 => 'search',
							1 => 'post_type',
						),
						'return_format'        => 'id',
						'min'                  => '',
						'max'                  => '',
						'elements'             => '',
						'bidirectional'        => 1,
						'bidirectional_target' => array(
							0 => 'field_663d24dbf7b02',
						),
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'current_user',
							'operator' => '==',
							'value'    => 'logged_in',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 1,
			),
		);
	}
);