<?php
/**
 * Static UI strings, registered with Polylang's string translation so every
 * label on the site (nav, buttons, section copy) is editable per-language
 * from Languages > Strings translation, the same "dictionary" shape the
 * Next.js site used (src/i18n/dictionaries/*.ts) but stored in Polylang
 * instead of a TS file. English text below is the default value; translate
 * it to Greek once in wp-admin.
 */
function b4y_register_strings() {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$group = 'Burned4You';

	$strings = array(
		// Nav
		'nav.home'    => 'Home',
		'nav.catalog' => 'Catalog',
		'nav.about'   => 'About',
		'nav.contact' => 'Contact',
		'nav.cta'     => 'Craft Yours',

		// Site-wide
		'description' => "We laser-cut and engrave ornaments, bookmarks, coasters, and keepsakes from wood, hand-finished and made to order.",
		'location'    => 'Athens, Greece',

		// Home
		'home.pill'            => 'Custom laser engraving studio',
		'home.h1_before'       => 'We turn your ideas into',
		'home.h1_em'           => 'engraved keepsakes',
		'home.lead2'           => 'Every piece is cut, engraved, and finished by hand. Made to order, just for you.',
		'home.browse'          => 'Browse the Catalog →',
		'home.secondary'       => 'Bring your Idea to life',
		'home.stat1_value'     => '500+',
		'home.stat1_label'     => 'Custom orders',
		'home.stat2_value'     => '6',
		'home.stat2_label'     => 'Materials',
		'home.stat3_value'     => '24h',
		'home.stat3_label'     => 'Avg. response',
		'home.cats_eyebrow'    => 'What we make',
		'home.cats_title'      => 'Explore our categories',
		'home.cats_text'       => 'From tree ornaments to wooden games, every design can be personalized.',
		'home.process_eyebrow' => 'Simple process',
		'home.process_title'   => 'How ordering works',
		'home.step1_title'     => 'Tell us your idea',
		'home.step1_text'      => 'Pick a category and send us your idea, photo, or design through our form.',
		'home.step2_title'     => 'We craft a proof',
		'home.step2_text'      => 'We confirm material and size, then get your piece ready to engrave.',
		'home.step3_title'     => 'Delivered to your door',
		'home.step3_text'      => 'Your finished, hand-checked piece ships out or is ready for local pickup.',
		'home.cta_title'       => 'Have something in mind?',
		'home.cta_text'        => "Send us your idea and we'll get back to you within 24h.",
		'home.cta_button'      => 'Start Your Order',

		// Catalog
		'catalog.eyebrow'        => 'Full catalog',
		'catalog.title'          => 'Choose a category',
		'catalog.text'           => 'Every item is made to order. Pick a category to see examples and materials.',
		'catalog.back'           => '← All categories',
		'catalog.view_one'       => 'View 1 item →',
		'catalog.view_many'      => 'View %d items →',
		'catalog.material'       => 'Material:',
		'catalog.made_to_order'  => 'Made to order',
		'catalog.personalizable' => 'Can be personalized',
		'catalog.ask'            => 'Ask About This',

		// About
		'about.eyebrow'     => 'Our story',
		'about.title'       => 'A small studio, obsessed with the details',
		'about.text'        => 'Burned4You started with a single laser cutter and a lot of curiosity. Today we design and engrave ornaments, bookmarks, and keepsakes for people who want something that couldn\'t have come from a big-box store.',
		'about.value1_title' => 'Made to order',
		'about.value1_text'  => 'Nothing sits on a shelf. Every piece is cut and engraved after you place your order.',
		'about.value2_title' => 'Hand-finished',
		'about.value2_text'  => 'Every edge is sanded, sealed, and checked by hand before it ships.',
		'about.value3_title' => 'Real materials',
		'about.value3_text'  => 'Solid wood and acrylic accents, no flimsy shortcuts.',
		'about.cta_title'    => 'Ready to bring your idea to life?',
		'about.cta_button'   => 'Lets craft it together →',

		// Contact
		'contact.eyebrow'      => 'Get in touch',
		'contact.title'        => "Lets craft together",
		'contact.text'         => "Tell us what you have in mind and we'll reply with materials and a timeline.",
		'contact.email'        => 'Email',
		'contact.phone'        => 'Phone',
		'contact.studio'       => 'Studio',
		'contact.name'         => 'Name',
		'contact.category'     => 'Category',
		'contact.general'      => 'General inquiry',
		'contact.item'         => 'Item (optional)',
		'contact.message'      => 'Tell us about your idea',
		'contact.placeholder'  => 'Sizes, colors, quantity, deadline: anything that helps us understand your idea accurately.',
		'contact.send'         => 'Send Message',
		'contact.sending'      => 'Sending…',
		'contact.success_title' => 'Thanks, message sent!',
		'contact.success_text'  => "We usually reply within a day. We'll follow up at the email you provided.",
		'contact.send_another'  => 'Send another message',
		'contact.generic_error' => 'Something went wrong. Please try again.',

		// Footer
		'footer.pages'      => 'Pages',
		'footer.categories' => 'Categories',
		'footer.contact'    => 'Contact',
		'footer.rights'     => 'All rights reserved.',
	);

	foreach ( $strings as $name => $default ) {
		pll_register_string( $name, $default, $group );
	}
}
add_action( 'init', 'b4y_register_strings', 5 );

/**
 * Looks up a registered UI string in the current language, falling back to
 * the English default (or the key itself) if Polylang isn't active.
 */
function b4y_str( $name, $default = '' ) {
	if ( function_exists( 'pll__' ) ) {
		return pll__( $default );
	}
	return $default;
}

/**
 * Permalink for the page with the given (language-independent) slug, in the
 * current language. Pages share the same slug across EL/EN (Polylang
 * differentiates them by URL prefix, not slug), so we resolve one match and
 * ask Polylang for its translation in the active language.
 */
function b4y_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( ! $page ) {
		return home_url( '/' . $slug . '/' );
	}

	$id = $page->ID;
	if ( function_exists( 'pll_get_post' ) ) {
		$translated = pll_get_post( $id, pll_current_language() );
		if ( $translated ) {
			$id = $translated;
		}
	}

	return get_permalink( $id );
}

/**
 * The "EN" / "ΕΛ" pill link to the other language, preserving the current
 * path — same UX as src/components/LanguageSwitch.tsx (only the target
 * language's own label is ever shown, regardless of which language you're
 * currently on).
 */
function b4y_language_switch_link() {
	if ( ! function_exists( 'pll_the_languages' ) ) {
		return '';
	}

	$languages = pll_the_languages( array( 'raw' => 1, 'hide_if_empty' => 0 ) );
	if ( empty( $languages ) ) {
		return '';
	}

	foreach ( $languages as $lang ) {
		if ( ! empty( $lang['current_lang'] ) ) {
			continue;
		}

		$is_greek = 'el' === $lang['slug'];
		$label    = $is_greek ? 'ΕΛ' : 'EN';
		$title    = $is_greek ? 'Ελληνικά' : 'English';

		return sprintf(
			'<a href="%s" hreflang="%s" lang="%s" title="%s" class="lang-switch">%s</a>',
			esc_url( $lang['url'] ),
			esc_attr( $lang['slug'] ),
			esc_attr( $lang['slug'] ),
			esc_attr( $title ),
			esc_html( $label )
		);
	}

	return '';
}

/**
 * Renders the 4 primary links directly (Home/Catalog/About/Contact) when no
 * "Primary" menu has been assigned yet in Appearance > Menus.
 */
function b4y_fallback_menu() {
	$items = array(
		'home'    => b4y_str( 'nav.home', 'Home' ),
		'catalog' => b4y_str( 'nav.catalog', 'Catalog' ),
		'about'   => b4y_str( 'nav.about', 'About' ),
		'contact' => b4y_str( 'nav.contact', 'Contact' ),
	);

	echo '<ul>';
	foreach ( $items as $slug => $label ) {
		$url = 'home' === $slug
			? ( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) )
			: b4y_page_url( $slug );
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
