<?php 
/* woocommerce */
/*	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

	function woo_remove_product_tabs( $tabs ) {

		// unset( $tabs['description'] );      	// Remove the description tab
		// unset( $tabs['reviews'] ); 			// Remove the reviews tab
		unset( $tabs['additional_information'] );  	// Remove the additional information tab

		return $tabs;

	}
	// remove sku from product details.
	add_filter( 'wc_product_sku_enabled', '__return_false' );
	
// if want to remove ordering from product archive page.
// flatsome uses it's own actions for ordering & filtering, so need to do after_theme setup. 
	function reach_woo_setup() {
		// remove "showing all 10 results" & default sorting
		remove_action( 'ux_woocommerce_navigate_products', 'woocommerce_result_count', 20 );
 		remove_action( 'ux_woocommerce_navigate_products', 'woocommerce_catalog_ordering', 30 );	
	} */

	// remove count from category
	add_filter( 'woocommerce_subcategory_count_html', 'reach_hide_category_count' );
	function reach_hide_category_count() {
			// No count
	}

	 // trying to add a message about "use ship to address for gift certificates"
	add_action('woocommerce_before_order_notes', 'zig_shipping_gift_msg', 30, 1);
 	function zig_shipping_gift_msg($checkout) {
	 	echo do_shortcode('[text-blocks id="checkout-gift-cert" ]'); // print out message in block.
 	}
