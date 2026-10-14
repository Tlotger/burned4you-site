<?php
// One-off setup script, run via `wp eval-file`.
// Configures Polylang languages (Greek default/unprefixed, English under /en)
// and makes WooCommerce products/categories translatable.

if ( ! function_exists( 'PLL' ) ) {
	WP_CLI::error( 'Polylang not active.' );
}

$model = PLL()->model;

// 1. Languages.
if ( ! $model->languages->get( 'el' ) ) {
	$result = $model->languages->add( array( 'locale' => 'el', 'slug' => 'el', 'name' => 'Ελληνικά', 'flag' => 'gr' ) );
	if ( is_wp_error( $result ) ) {
		WP_CLI::error( 'Greek: ' . $result->get_error_message() );
	}
	WP_CLI::log( 'Added Greek.' );
} else {
	WP_CLI::log( 'Greek already exists.' );
}

if ( ! $model->languages->get( 'en' ) ) {
	$result = $model->languages->add( array( 'locale' => 'en_US', 'slug' => 'en', 'name' => 'English', 'flag' => 'us' ) );
	if ( is_wp_error( $result ) ) {
		WP_CLI::error( 'English: ' . $result->get_error_message() );
	}
	WP_CLI::log( 'Added English.' );
} else {
	WP_CLI::log( 'English already exists.' );
}

// 2. Greek as default, hidden from the URL; English under /en (directory mode).
$model->languages->update_default( 'el' );
$model->options['hide_default'] = true;
$model->options['force_lang']   = 1; // 1 = language in URL directory (e.g. /en/...).

// 3. Make WooCommerce products/categories translatable.
$post_types = $model->options['post_types'];
if ( ! in_array( 'product', $post_types, true ) ) {
	$post_types[] = 'product';
	$model->options['post_types'] = $post_types;
}

$taxonomies = $model->options['taxonomies'];
if ( ! in_array( 'product_cat', $taxonomies, true ) ) {
	$taxonomies[] = 'product_cat';
	$model->options['taxonomies'] = $taxonomies;
}

// 4. WooCommerce basics for local dev: EUR/Greece, no onboarding wizard,
// and "Coming Soon" mode off (it intercepts every frontend request behind
// a placeholder page, meant for a real pre-launch site, not local building).
update_option( 'woocommerce_default_country', 'GR' );
update_option( 'woocommerce_currency', 'EUR' );
update_option( 'woocommerce_coming_soon', 'no' );

WP_CLI::success( 'Polylang configured: el (default, hidden) / en (/en/), WooCommerce products+categories translatable.' );
