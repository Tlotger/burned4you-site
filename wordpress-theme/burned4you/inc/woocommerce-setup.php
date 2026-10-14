<?php
/**
 * WooCommerce permalink structure: product category base "catalog" so URLs
 * read /catalog/<slug>/ instead of /product-category/<slug>/, matching the
 * Next.js site's /catalog/[slug] route.
 */
defined( 'ABSPATH' ) || exit;

function b4y_configure_woocommerce_permalinks() {
	$permalinks = get_option( 'woocommerce_permalinks', array() );
	if ( isset( $permalinks['category_base'] ) && 'catalog' === $permalinks['category_base'] ) {
		return;
	}
	$permalinks['category_base'] = 'catalog';
	update_option( 'woocommerce_permalinks', $permalinks );
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'b4y_configure_woocommerce_permalinks' );
