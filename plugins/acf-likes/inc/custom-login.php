<?php

/**
 * Custom login logo
 */
function wpe_custom_login_logo() {
	$font_dir = wp_get_font_dir();
	?>

	<style type="text/css">
		@font-face{
			font-family:"Inter";
			font-style:normal;
			font-weight: 300 900;
			font-display:fallback;
			src: url('<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/fonts/inter/Inter-VariableFont_slnt,wght.woff2') format('woff2');
		}

		body.login::before {
			-webkit-backdrop-filter: blur(5px);
			backdrop-filter: blur(5px);
			background-color: rgba(48, 48, 48, 0.4);
			content: "";
			display: block;
			height: 100%;
			position: fixed;
			width: 100%;
			z-index: -1;
		}

		.login form {
			backdrop-filter: blur(15px);
			background-color: rgba(48, 48, 48, 0.5) !important;
			border-radius: 16px;
			color: #fff;
			font-family: 'Inter', sans-serif;
		}

		.login #backtoblog a,
		.login #nav a {
			color: #fff !important;
		}

		.wpe-bg-video {
			height: auto;
			left: 0;
			min-height: 100%;
			min-width: 100%;
			position: fixed;
			top: 0;
			width: auto;
			z-index: -100;
		}

		<?php
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( $custom_logo_id ) :
			$image = wp_get_attachment_image_src( $custom_logo_id, 'medium' );
			?>

			#login h1 a,
			.login h1 a {
				background-image: url(<?php echo esc_attr( $image[0] ); ?>);
				height: <?php echo esc_attr( $image[2] ); ?>px;
				width: <?php echo esc_attr( $image[1] ); ?>px;
				max-width: 100%;
				background-size: <?php echo esc_attr( $image[1] ); ?>px <?php echo esc_attr( $image[2] ); ?>px;
				background-repeat: no-repeat;
				padding-bottom: 30px;
			}

		<?php endif; ?>
	</style>

	<video autoplay muted loop class="wpe-bg-video">
		<source src="<?php echo esc_url( plugins_url( '../assets/video/', __FILE__ ) . '19811275-hd_1920_1080_30fps.mp4' ); ?>" type="video/mp4">
	</video>
	<?php
}
add_action( 'login_enqueue_scripts', 'wpe_custom_login_logo' );

/**
 * Replace login logo link to homepage
 */
function wpe_custom_login_link() {
	return home_url();
}
add_filter( 'login_headerurl', 'wpe_custom_login_link' );
