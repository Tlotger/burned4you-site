<?php
/**
 * Burned4You theme bootstrap.
 */

defined( 'ABSPATH' ) || exit;

define( 'B4Y_VERSION', '1.0.0' );

function b4y_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary', 'burned4you' ),
		)
	);
}
add_action( 'after_setup_theme', 'b4y_setup' );

function b4y_assets() {
	// Comfortaa (display/headings) + Inter (body). latin,latin-ext,greek so
	// Greek copy renders in the brand font instead of falling back silently.
	wp_enqueue_style(
		'b4y-fonts',
		'https://fonts.googleapis.com/css2?family=Comfortaa:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap&subset=latin,latin-ext,greek',
		array(),
		null
	);
	wp_enqueue_style( 'burned4you-style', get_stylesheet_uri(), array(), B4Y_VERSION );
	wp_enqueue_script( 'burned4you-nav', get_template_directory_uri() . '/assets/js/nav.js', array(), B4Y_VERSION, true );
	wp_enqueue_script( 'burned4you-contact-form', get_template_directory_uri() . '/assets/js/contact-form.js', array(), B4Y_VERSION, true );
	wp_localize_script(
		'burned4you-contact-form',
		'b4yContact',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'b4y_contact' ),
			'lang'    => function_exists( 'pll_current_language' ) ? pll_current_language() : 'el',
			'i18n'    => array(
				'sending' => b4y_str( 'contact.sending', 'Sending…' ),
				'send'    => b4y_str( 'contact.send', 'Send Message' ),
				'error'   => b4y_str( 'contact.generic_error', 'Something went wrong. Please try again.' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'b4y_assets' );

// WooCommerce: this pass has no prices/checkout (see the migration plan) —
// product cards use the same "Ask About This" -> contact-form flow as the
// Next.js site instead of Add to Cart. Strip the storefront markup we don't
// use so overriding a couple of template files is enough.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

require get_template_directory() . '/inc/contact-handler.php';
require get_template_directory() . '/inc/personalization.php';
require get_template_directory() . '/inc/template-helpers.php';
require get_template_directory() . '/inc/woocommerce-setup.php';
require get_template_directory() . '/inc/routes.php';
