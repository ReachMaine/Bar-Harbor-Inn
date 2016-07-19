<?php 
	// add the tagline next to the logo 
	add_action('avada_logo_append', 'bhi_site_tagline', 10);
	function bhi_site_tagline() {
		$html_out = '';
		$html_out .= '<div class="bhi_site_title_wrapper">';
		/* $html_out .= 	'<h1 class="bhi_site_title">'; */
		$html_out .= 		'<a href="'.site_url().'">';
		/* v1 -  $html_out .= 			get_bloginfo('name', 'raw'); */
		/* v2 - $html_out .= '<span class="firstletter">B</span>AR <span class="firstletter">H</span>ARBOR <span class="firstletter">I</span>NN'; */
		$html_out .= '<img src="'.get_stylesheet_directory_uri().'/images/bhi_text_logo.png">';
		$html_out .= 		'</a>';
		/* $html_out .= 	"</h1>"; */
		$html_out .= '</div>'; // title_wrapper
		echo $html_out;
	}

	// add widget area at bottom of footer (above copyright)

	register_sidebar( array(
        'name'          => 'Under Footer Widget' ,
		'id'            => 'footer-bottom',
		'before_widget' => '<div id="%1$s" class="fusion-footer-bottom widget %2$s">',
		'after_widget'  => '<div style="clear:both;"></div></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// add widget area under slideshow for checkavailability box.

	register_sidebar( array(
        'name'          => 'Under slidershow' ,
		'id'            => 'under-slider',
		'before_widget' => '<div id="%1$s" class="bhi_underslider widget %2$s">',
		'after_widget'  => '<div style="clear:both;"></div></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	// add widget area above footer - to be used for branding

	register_sidebar( array(
        'name'          => 'Bottom Branding',
		'id'            => 'bottom-branding',
		'before_widget' => '<div id="%1$s" class="bhi_bottom_branding widget %2$s">',
		'after_widget'  => '<div style="clear:both;"></div></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );




