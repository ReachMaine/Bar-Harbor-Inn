<?php
	require_once(get_stylesheet_directory().'/custom/avada.php');
	require_once(get_stylesheet_directory().'/custom/woocommerce.php');
	require_once(get_stylesheet_directory().'/custom/checkavail.php');

	/* old way... function theme_enqueue_styles() {
	    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
	}
		add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );*/
/* new way in avada-child theme? */
	function theme_enqueue_styles() {
	    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


	function avada_lang_setup() {
		$lang = get_stylesheet_directory() . '/languages';
		load_child_theme_textdomain( 'Avada', $lang );
	}
	add_action( 'after_setup_theme', 'avada_lang_setup' );
	/* end of avada child */


	add_filter('widget_text', 'do_shortcode'); // make text widget do shortcodes....

	/* image size for facebook */
	add_image_size( 'facebook_share', 470, 246, true );
	add_image_size('facebook_share_vert', 246, 470, true);
	add_filter('wpseo_opengraph_image_size', 'mysite_opengraph_image_size');
	function mysite_opengraph_image_size($val) {
		return 'facebook_share';
	}

		// contact form 7 fallback for date field  - only needed if use datepicker
	add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
	add_filter( 'wpcf7_form_elements', 'mycustom_wpcf7_form_elements' );

	function mycustom_wpcf7_form_elements( $form ) {
		$form = do_shortcode( $form );

		return $form;
	}

	/*****  change the login screen logo ****/
	function my_login_logo() { ?>
		<style type="text/css">
			body.login div#login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/bhi-admin-img.png);
				padding-bottom: 30px;
				background-size: contain;
				margin-left: 0px;
				margin-bottom: 0px;
				margin-right: 0px;
				height: 60px;
				width: 100%;
			}
		</style>
	<?php }
	add_action( 'login_enqueue_scripts', 'my_login_logo' );

	/*****  after theme setup  ****/
	add_action('after_setup_theme', 'reach_setup');
	function reach_setup() {
		// switch ordering of copyright footer content by modifying the priority
		remove_action( 'avada_footer_copyright_content', 'avada_render_footer_copyright_notice', 10 );
		add_action( 'avada_footer_copyright_content', 'avada_render_footer_copyright_notice', 18 );
		add_action('login_head', 'add_favicon');
		add_action('admin_head', 'add_favicon');

	}
	function add_favicon() {
	  	$favicon_url = get_stylesheet_directory_uri() . '/images/admin-favicon.ico';
		echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
	}
	add_action( 'login_footer', 'reach_login_branding' );
	function reach_login_branding() {
		$outstring = "";
		$outstring .= '<p style="text-align:center;">';
		//$outstring .=	'Designed by';
		$outstring .= 	'<a class="reach-logo" href="https://www.reachmaine.com" target="_blank">';
		$outstring .= 	'<img src="'.get_stylesheet_directory_uri().'/images/reach-favicon.png'.'">';
		$outstring .= 		'R<i style="color: #f58220">EA</i>CH Maine';
		$outstring .= 	'</a>';
		$outstring .= '</p>';
		echo $outstring;
	}
// for migration to avada 5.0.x
 function add_custom_post_types( $post_types ) {
    $my_post_types = array(
        'text-blocks',
    );

    $my_post_types = array_merge( $post_types, $my_post_types );

    return $my_post_types;
}
add_filter( 'fusion_builder_shortcode_migration_post_types', 'add_custom_post_types' );
