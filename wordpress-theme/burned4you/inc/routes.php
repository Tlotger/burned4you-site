<?php
/**
 * /catalog/, /about/, /contact/ (and their /en/ counterparts) as clean,
 * identical paths in both languages.
 *
 * Why this exists: WordPress's `pagename` query resolution doesn't consult
 * Polylang's language when two pages share a slug — it was picking whatever
 * page it found first regardless of the requested language (Polylang's
 * same-slug support only covers taxonomy terms, e.g. product categories,
 * not the 'page' post type). Custom rewrite rules here sidestep pagename
 * resolution entirely and translate the page ID ourselves, the same way
 * Polylang's own front-page handling does (see PLL_Frontend_Static_Pages).
 */
defined( 'ABSPATH' ) || exit;

const B4Y_ROUTED_SLUGS = array( 'catalog', 'about', 'contact' );

function b4y_add_rewrite_rules() {
	foreach ( B4Y_ROUTED_SLUGS as $slug ) {
		add_rewrite_rule( '^' . $slug . '/?$', 'index.php?b4y_route=' . $slug, 'top' );
		add_rewrite_rule( '^en/' . $slug . '/?$', 'index.php?b4y_route=' . $slug . '&lang=en', 'top' );
	}
}
add_action( 'init', 'b4y_add_rewrite_rules' );

function b4y_register_route_query_var( $vars ) {
	$vars[] = 'b4y_route';
	return $vars;
}
add_filter( 'query_vars', 'b4y_register_route_query_var' );

function b4y_resolve_route( $query ) {
	if ( ! $query->is_main_query() || is_admin() ) {
		return;
	}

	$slug = $query->get( 'b4y_route' );
	if ( ! $slug || ! in_array( $slug, B4Y_ROUTED_SLUGS, true ) ) {
		return;
	}

	// Resolve the canonical (default-language) page, then ask Polylang for
	// its translation in the requested language.
	$anchor = get_page_by_path( $slug );
	$id     = $anchor ? $anchor->ID : 0;

	if ( $id && function_exists( 'pll_get_post' ) ) {
		$lang       = $query->get( 'lang' ) ?: pll_default_language();
		$translated = pll_get_post( $id, $lang );
		if ( $translated ) {
			$id = $translated;
		}
	}

	if ( ! $id ) {
		return;
	}

	$query->set( 'page_id', $id );
	$query->set( 'post_type', 'page' );
	$query->set( 'b4y_route', null );
	$query->set( 'product_cat', '' );
	$query->set( 'tax_query', array() );
	$query->is_page     = true;
	$query->is_singular = true;
	$query->is_home     = false;
	$query->is_tax      = false;
	$query->is_archive  = false;
	unset( $query->query_vars['pagename'] );

	// Polylang's `language` taxonomy uses `lang` as its own public query
	// var, so WordPress core independently resolves any `lang=en` query as
	// a taxonomy archive for that term — it already cached `queried_object`
	// as that term before this hook ran. Clearing `lang` + the cached
	// queried object forces WP to recompute against our page_id instead
	// (the same fix Polylang's own PLL_Frontend_Static_Pages::page_on_front_query()
	// applies for the same reason).
	unset( $query->query_vars['lang'], $query->queried_object, $query->queried_object_id );
}
// Priority 9999: WooCommerce's WC_Query and Polylang's own query filters
// (PLL_Translated_Post at 10, PLL_CRUD_Terms::set_tax_query_lang at 999)
// also hook pre_get_posts and were winning the race, re-resolving these
// requests as taxonomy archives after this ran at the default priority.
add_action( 'pre_get_posts', 'b4y_resolve_route', 9999 );

/**
 * Flushes rewrite rules once after these routes are registered (theme
 * activation covers the first deploy; bumping B4Y_VERSION after editing
 * this file covers later changes without a manual flush).
 */
function b4y_maybe_flush_rewrites() {
	if ( get_option( 'b4y_routes_version' ) !== B4Y_VERSION ) {
		b4y_add_rewrite_rules();
		flush_rewrite_rules();
		update_option( 'b4y_routes_version', B4Y_VERSION );
	}
}
add_action( 'init', 'b4y_maybe_flush_rewrites', 20 );
