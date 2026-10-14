<?php
// One-off setup script, run via `wp eval-file`.
// Creates the 4 pages (Home/Catalog/About/Contact) in EL + EN, links them as
// Polylang translations, sets the static front page, and builds per-language
// primary nav menus.
//
// Includes two follow-up fixes folded in so a single run reproduces the
// full working state (discovered the hard way building this the first time):
// 1. wp_insert_post()'s slug-uniqueness check isn't Polylang-aware, so the
//    English pages would otherwise get "-2" slugs — fixed with a direct
//    $wpdb->update() after language assignment (Polylang disambiguates
//    identical page slugs at the query level via the language taxonomy,
//    not by the slug string itself, so this is safe).
// 2. Polylang's `redirect_lang` option must be enabled or the front page
//    URL keeps the page's slug (e.g. /en/home/ instead of /en/) — see
//    WP_Syntex\Polylang\Options\Business\Redirect_Lang.

if ( ! function_exists( 'PLL' ) ) {
	WP_CLI::error( 'Polylang not active.' );
}

$model = PLL()->model;

$pages_el = array(
	'home'    => 'Αρχική',
	'catalog' => 'Κατάλογος',
	'about'   => 'Σχετικά',
	'contact' => 'Επικοινωνία',
);
$pages_en = array(
	'home'    => 'Home',
	'catalog' => 'Catalog',
	'about'   => 'About',
	'contact' => 'Contact',
);

function b4y_setup_get_or_create_page( $slug, $title, $lang ) {
	$existing = get_page_by_path( $slug );
	if ( $existing && function_exists( 'pll_get_post_language' ) && pll_get_post_language( $existing->ID ) === $lang ) {
		return $existing->ID;
	}

	// Look among all pages with this slug (Polylang allows the same slug per language).
	$candidates = get_posts(
		array(
			'name'        => $slug,
			'post_type'   => 'page',
			'post_status' => 'any',
			'numberposts' => -1,
			'lang'        => '', // bypass Polylang's automatic language filter
		)
	);
	foreach ( $candidates as $candidate ) {
		if ( function_exists( 'pll_get_post_language' ) && pll_get_post_language( $candidate->ID ) === $lang ) {
			return $candidate->ID;
		}
	}

	$id = wp_insert_post(
		array(
			'post_title'  => $title,
			'post_name'   => $slug,
			'post_type'   => 'page',
			'post_status' => 'publish',
		),
		true
	);
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( "Could not create page {$slug}/{$lang}: " . $id->get_error_message() );
	}
	pll_set_post_language( $id, $lang );
	return $id;
}

$el_ids = array();
$en_ids = array();
foreach ( $pages_el as $slug => $title ) {
	$el_ids[ $slug ] = b4y_setup_get_or_create_page( $slug, $title, 'el' );
}
foreach ( $pages_en as $slug => $title ) {
	$en_ids[ $slug ] = b4y_setup_get_or_create_page( $slug, $title, 'en' );
}

foreach ( array_keys( $pages_el ) as $slug ) {
	pll_save_post_translations(
		array(
			'el' => $el_ids[ $slug ],
			'en' => $en_ids[ $slug ],
		)
	);
}

WP_CLI::log( 'Pages created/linked: ' . wp_json_encode( array( 'el' => $el_ids, 'en' => $en_ids ) ) );

// Fix #1: force the English pages back to their clean (non "-2") slugs.
global $wpdb;
foreach ( $pages_el as $slug => $title ) {
	$wpdb->update( $wpdb->posts, array( 'post_name' => $slug ), array( 'ID' => $en_ids[ $slug ] ) );
	clean_post_cache( $en_ids[ $slug ] );
}

// Fix #2: front page URL should be the bare language root, not /en/home/.
$model->options['redirect_lang'] = true;
$model->clean_languages_cache();

// Static front page = the Greek "home" page (Polylang serves the EN
// translation automatically at /en/).
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $el_ids['home'] );
update_option( 'page_for_posts', 0 );

// Primary nav menus, one per language, each with the 4 links in order.
function b4y_build_menu( $lang, $ids, $labels ) {
	$menu_name = 'Primary (' . strtoupper( $lang ) . ')';
	$menu      = wp_get_nav_menu_object( $menu_name );
	$menu_id   = $menu ? $menu->term_id : wp_create_nav_menu( $menu_name );

	// Clear existing items so re-running this script is idempotent.
	$existing_items = wp_get_nav_menu_items( $menu_id );
	if ( $existing_items ) {
		foreach ( $existing_items as $item ) {
			wp_delete_post( $item->ID, true );
		}
	}

	$order = array( 'home', 'catalog', 'about', 'contact' );
	$position = 1;
	foreach ( $order as $slug ) {
		wp_update_nav_menu_item(
			$menu_id,
			0,
			array(
				'menu-item-title'     => $labels[ $slug ],
				'menu-item-object-id' => $ids[ $slug ],
				'menu-item-object'    => 'page',
				'menu-item-type'      => 'post_type',
				'menu-item-status'    => 'publish',
				'menu-item-position'  => $position,
			)
		);
		$position++;
	}

	if ( function_exists( 'pll_set_term_language' ) ) {
		pll_set_term_language( $menu_id, $lang );
	}

	return $menu_id;
}

$menu_el = b4y_build_menu( 'el', $el_ids, $pages_el );
$menu_en = b4y_build_menu( 'en', $en_ids, $pages_en );

$theme = get_stylesheet();
$model->options['nav_menus'] = array(
	$theme => array(
		'primary' => array(
			'el' => $menu_el,
			'en' => $menu_en,
		),
	),
);

flush_rewrite_rules();

WP_CLI::success( 'Pages, front page, and per-language primary menus configured.' );
