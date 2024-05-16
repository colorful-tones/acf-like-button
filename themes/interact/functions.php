<?php
/**
 * interact functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package interact
 * @since interact 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'interact_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since interact 1.0
	 * @return void
	 */
	function interact_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'interact' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'interact' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'interact' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'interact' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'interact' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'interact_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'interact_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since interact 1.0
	 * @return void
	 */
	function interact_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'interact-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'interact_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'interact_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since interact 1.0
	 * @return void
	 */
	function interact_pattern_categories() {

		register_block_pattern_category(
			'interact_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'interact' ),
				'description' => __( 'A collection of full page layouts.', 'interact' ),
			)
		);
	}
endif;

add_action( 'init', 'interact_pattern_categories' );

/**
 * Get an array of the names of all registered block patterns
 *
 * @return array $pattern_names
 */
function get_block_pattern_names_list() {
	$get_patterns  = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
	$pattern_names = array_map(
		function ( array $pattern ) {
			return $pattern['name'];
		},
		$get_patterns
	);
	return $pattern_names;
}

/**
 * Block Pattern removal
 *
 * @return void
 */
function remove_all_core_block_patterns() {
	// Remove all Core Patterns
	$registered_patterns = get_block_pattern_names_list();

	foreach ( $registered_patterns as $pattern_name ) {
		// if the name starts with 'core' remove it
		if ( substr( $pattern_name, 0, strlen( 'core' ) ) === 'core' ) {
			unregister_block_pattern( $pattern_name );
		}

		if ( substr( $pattern_name, 0, strlen( 'interact' ) ) === 'interact' ) {
			devrel_enqueue_pattern_styles( $pattern_name );
		}
	}
}
//add_action( 'init', 'remove_all_core_block_patterns' );

/**
 * Enqueues custom block styles for the theme.
 *
 * This function scans the styles folder in the theme to locate block styles.
 * It then enqueues each block style using the `wp_enqueue_block_style` function.
 *
 * @url https://developer.wordpress.org/reference/functions/wp_enqueue_block_style/
 */
function devrel_enqueue_pattern_styles( $pattern_name ) {
	if ( ! $pattern_name ) {
		return;
	}
	//var_dump( $pattern_name);

	// Scan our styles folder to locate block styles.
	$files = glob( get_template_directory() . '/patterns/*.css' );

	foreach ( $files as $file ) {

		// Get the filename and core block name.
		$filename   = basename( $file, '.css' );
		$pattern_name = str_replace( 'interact/', '', $pattern_name );

		if ( $filename !== $pattern_name ) {
			return;
		}

		wp_enqueue_block_style(
			'core/group',
			array(
				'handle' => "devrel-block-{$pattern_name}",
				'src'    => get_theme_file_uri( "patterns/{$pattern_name}.css" ),
				'path'   => get_theme_file_path( "patterns/{$pattern_name}.css" ),
			)
		);
	}
}