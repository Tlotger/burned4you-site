<?php
/**
 * One-off catalog import, run via `wp eval-file`. Ports
 * src/data/catalog/{shared,el,en}.ts into WooCommerce: 7 product
 * categories + 26 products, each created once per language and linked as
 * Polylang translations. Images come from the Next.js repo's public/products/
 * folder (the authoritative image set per the migration plan).
 */

if ( ! function_exists( 'PLL' ) || ! class_exists( 'WC_Product_Simple' ) ) {
	WP_CLI::error( 'Polylang and/or WooCommerce not active.' );
}

define( 'B4Y_SRC_IMAGES', 'D:/Desktop/__/Site/public/products' );

// ---------------------------------------------------------------------
// Data (ported from src/data/catalog/shared.ts, el.ts, en.ts)
// ---------------------------------------------------------------------

$catalog = array(
	'ornaments' => array(
		'heroImage' => 'ornaments/nutcracker-hero.jpeg',
		'el'        => array( 'name' => 'Χριστουγεννιάτικα Στολίδια', 'tagline' => 'Στολίδια δέντρου με στρώσεις λεπτομέρειας', 'description' => 'Ξύλινα στολίδια κομμένα με λέιζερ, από φίνα διάτρητα μενταγιόν μέχρι πολυεπίπεδες ζωγραφισμένες σκηνές.' ),
		'en'        => array( 'name' => 'Christmas Ornaments', 'tagline' => 'Tree decorations with layers of detail', 'description' => 'Laser-cut wooden ornaments, from fine filigree medallions to multi-layer painted scenes.' ),
		'products'  => array(
			'nutcracker-ornament'        => array( 'image' => 'ornaments/nutcracker-ornament.jpeg', 'el' => array( 'name' => 'Στολίδι Καρυοθραύστης', 'description' => 'Ένας λεπτομερής καρυοθραύστης, χαραγμένος με λέιζερ με λεπτές γραμμές και κρεμασμένος με κορδόνι.', 'material' => 'Χαραγμένο ξύλο σημύδας' ), 'en' => array( 'name' => 'Nutcracker Ornament', 'description' => 'A detailed nutcracker figure, laser-engraved with fine linework and hung on cord.', 'material' => 'Engraved birch wood' ) ),
			'deer-medallion-ornament'     => array( 'image' => 'ornaments/deer-medallion-ornament.jpeg', 'el' => array( 'name' => 'Στολίδι Μενταγιόν με Ελάφι', 'description' => 'Μια περίτεχνη σιλουέτα ελαφιού κομμένη σε στρογγυλό ξύλινο μενταγιόν.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Deer Medallion Ornament', 'description' => 'An intricate filigree stag silhouette cut into a round wooden medallion.', 'material' => 'Laser-cut wood' ) ),
			'layered-christmas-ornament'  => array( 'image' => 'ornaments/layered-christmas-ornament.png', 'el' => array( 'name' => 'Πολυεπίπεδο Στολίδι «Merry Christmas»', 'description' => 'Μια πολυεπίπεδη μπάλα με ζωγραφισμένη σκηνή ελαφιού και δάσους και κορδέλα για κρέμασμα.', 'material' => 'Πολυεπίπεδο ζωγραφισμένο ξύλο' ), 'en' => array( 'name' => 'Layered "Merry Christmas" Ornament', 'description' => 'A multi-layer bauble with a painted deer-and-forest scene and ribbon hanger.', 'material' => 'Layered painted wood' ) ),
			'leaping-reindeer-ornament'   => array( 'image' => 'ornaments/leaping-reindeer-ornament.jpeg', 'el' => array( 'name' => 'Στολίδι Τάρανδος σε Άλμα', 'description' => 'Μια δίχρωμη σιλουέτα τάρανδου με χαραγμένο σχέδιο νιφάδων χιονιού.', 'material' => 'Πολυεπίπεδο ξύλο' ), 'en' => array( 'name' => 'Leaping Reindeer Ornament', 'description' => 'A two-tone reindeer silhouette with a laser-etched snowflake pattern.', 'material' => 'Layered wood' ) ),
			'north-pole-signpost'         => array( 'image' => 'ornaments/north-pole-signpost.jpeg', 'el' => array( 'name' => 'Στολίδι-Πινακίδα Βόρειου Πόλου', 'description' => 'Μια μικροσκοπική πινακίδα που δείχνει προς τον Βόρειο Πόλο, το Στάβλο των Ταράνδων και το Εργαστήρι του Άγιου Βασίλη.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => 'North Pole Signpost Charm', 'description' => 'A tiny signpost ornament pointing to the North Pole, Reindeer Stable, and Santa\'s Workshop.', 'material' => 'Engraved wood' ) ),
		),
	),
	'bookmarks' => array(
		'heroImage' => 'bookmarks/deer-forest-bookmark.jpeg',
		'el'        => array( 'name' => 'Ξύλινοι Σελιδοδείκτες', 'tagline' => 'Για τον αναγνώστη που τα έχει όλα', 'description' => 'Χαραγμένοι ξύλινοι σελιδοδείκτες με κορδέλα: περίτεχνες σκηνές, εποχιακά σχέδια και σύντομα μηνύματα.' ),
		'en'        => array( 'name' => 'Wooden Bookmarks', 'tagline' => 'For the reader who has everything', 'description' => 'Engraved wooden bookmarks with ribbon ties: intricate scenes, seasonal designs, and short messages.' ),
		'products'  => array(
			'deer-forest-bookmark'    => array( 'image' => 'bookmarks/deer-forest-bookmark.jpeg', 'el' => array( 'name' => 'Σελιδοδείκτης Ελάφι στο Δάσος', 'description' => 'Ένας λεπτοκομμένος σελιδοδείκτης με ελάφι και δάσος, με κορδέλα.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Deer in the Forest Bookmark', 'description' => 'A finely cut deer-and-forest scene bookmark with a ribbon tie.', 'material' => 'Laser-cut wood' ) ),
			'be-merry-bright-bookmark' => array( 'image' => 'bookmarks/be-merry-bright-bookmark.jpeg', 'el' => array( 'name' => 'Σελιδοδείκτης «Be Merry & Bright»', 'description' => 'Ένας ψηλός χαραγμένος σελιδοδείκτης με το μήνυμα «Be Merry & Bright With a Great Story» και νιφάδα χιονιού.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => '"Be Merry & Bright" Bookmark', 'description' => 'A tall engraved bookmark reading "Be Merry & Bright With a Great Story", with a snowflake cut-out.', 'material' => 'Engraved wood' ) ),
			'merry-xmas-bookmark'      => array( 'image' => 'bookmarks/merry-xmas-bookmark.jpeg', 'el' => array( 'name' => 'Σελιδοδείκτης «Merry Xmas» με Δώρο', 'description' => 'Ένας χαραγμένος σελιδοδείκτης με μπάλες, ένα τυλιγμένο δώρο και κορδέλα.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => '"Merry Xmas" Gift Bookmark', 'description' => 'An engraved bookmark with ornaments, a wrapped gift, and a ribbon strap.', 'material' => 'Engraved wood' ) ),
			'gnome-ornament-bookmark'  => array( 'image' => 'bookmarks/gnome-ornament-bookmark.jpeg', 'el' => array( 'name' => 'Σετ Σελιδοδεικτών Νάνος & Μπάλες', 'description' => 'Ζευγάρι χαραγμένων σελιδοδεικτών με σατέν κορδέλες: ένας χριστουγεννιάτικος νάνος και ένα σχέδιο με κρεμαστές μπάλες.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => 'Gnome & Ornament Bookmark Set', 'description' => 'A pair of engraved bookmarks with satin ribbons: a Christmas gnome and a hanging-ornament design.', 'material' => 'Engraved wood' ) ),
		),
	),
	'coasters' => array(
		'heroImage' => 'coasters/winter-village-coasters.jpeg',
		'el'        => array( 'name' => 'Σουβέρ', 'tagline' => 'Στρογγυλά ξύλινα σουβέρ, χαραγμένα κατά παραγγελία', 'description' => 'Χαραγμένα ξύλινα σουβέρ, μεμονωμένα ή σε σετ που ταιριάζουν.' ),
		'en'        => array( 'name' => 'Coasters', 'tagline' => 'Round wooden coasters, engraved to order', 'description' => 'Engraved wood coasters, sold individually or as matching sets.' ),
		'products'  => array(
			'winter-village-coasters'        => array( 'image' => 'coasters/winter-village-coasters.jpeg', 'el' => array( 'name' => 'Σετ Σουβέρ Χειμωνιάτικο Χωριό', 'description' => 'Στρογγυλά σουβέρ χαραγμένα με χιονισμένες σκηνές χωριού και γέφυρας.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => 'Winter Village Coaster Set', 'description' => 'Round coasters engraved with snowy village and bridge scenes.', 'material' => 'Engraved wood' ) ),
			'fireside-coasters'               => array( 'image' => 'coasters/fireside-coasters.jpeg', 'el' => array( 'name' => 'Σετ Σουβέρ Δίπλα στο Τζάκι', 'description' => 'Σουβέρ χαραγμένα με κεριά και μια χιονισμένη καλύβα.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => 'Fireside Coaster Set', 'description' => 'Coasters engraved with candles and a snowy cabin scene.', 'material' => 'Engraved wood' ) ),
			'let-it-snow-coaster'             => array( 'image' => 'coasters/let-it-snow-coaster.jpeg', 'el' => array( 'name' => 'Σουβέρ «Let It Snow»', 'description' => 'Ένα στρογγυλό σουβέρ χαραγμένο με χαριτωμένη γραφή «Let It Snow» και νιφάδες.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => '"Let It Snow" Coaster', 'description' => 'A round coaster engraved with playful "Let It Snow" script and snowflakes.', 'material' => 'Engraved wood' ) ),
			'merry-christmas-lights-coaster'  => array( 'image' => 'coasters/merry-christmas-lights-coaster.jpeg', 'el' => array( 'name' => 'Σουβέρ «Merry Christmas» με Λαμπάκια', 'description' => 'Ένα σουβέρ χαραγμένο με μπερδεμένα λαμπάκια και ένα σκανδαλιάρικο ξωτικό.', 'material' => 'Χαραγμένο ξύλο' ), 'en' => array( 'name' => '"Merry Christmas" Lights Coaster', 'description' => 'A coaster engraved with a tangle of fairy lights and a mischievous elf.', 'material' => 'Engraved wood' ) ),
		),
	),
	'tealight-holders' => array(
		'heroImage' => 'tealights/deer-forest-tealight.jpeg',
		'el'        => array( 'name' => 'Κηροπήγια για Ρεσώ', 'tagline' => 'Ξύλινες σκηνές με βάση για κερί', 'description' => 'Σιλουέτες σκηνών κομμένες σε ξύλο, καθεμία με βάση για ρεσώ.' ),
		'en'        => array( 'name' => 'Tealight Holders', 'tagline' => 'Standing wood scenes with a candle base', 'description' => 'Silhouette scenes cut from wood, each with a base for a standard tealight candle.' ),
		'products'  => array(
			'deer-forest-tealight'       => array( 'image' => 'tealights/deer-forest-tealight.jpeg', 'el' => array( 'name' => 'Κηροπήγιο Ελάφι & Δάσος', 'description' => 'Μια όρθια αψίδα με ελάφι ανάμεσα σε πεύκα, με βάση για ρεσώ.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Deer & Forest Tealight Holder', 'description' => 'A standing arch scene of a stag among pine trees, with a tealight base.', 'material' => 'Laser-cut wood' ) ),
			'gingerbread-house-tealight' => array( 'image' => 'tealights/gingerbread-house-tealight.jpeg', 'el' => array( 'name' => 'Κηροπήγιο Μπισκοτόσπιτο', 'description' => 'Η σιλουέτα ενός μπισκοτόσπιτου με μπαστούνι καραμέλα, σε βάση για ρεσώ.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Gingerbread House Tealight Holder', 'description' => 'A gingerbread-house silhouette with a candy cane, on a tealight base.', 'material' => 'Laser-cut wood' ) ),
			'snowflake-star-tealight'    => array( 'image' => 'tealights/snowflake-star-tealight.jpeg', 'el' => array( 'name' => 'Κηροπήγιο Αστέρι-Νιφάδα', 'description' => 'Μια γεωμετρική βάση αστεριού και νιφάδας για ρεσώ.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Snowflake Star Tealight Holder', 'description' => 'A geometric star-and-snowflake cut-out base for a tealight candle.', 'material' => 'Laser-cut wood' ) ),
			'pine-trees-tealight'        => array( 'image' => 'tealights/pine-trees-tealight.jpeg', 'el' => array( 'name' => 'Κηροπήγιο Πεύκα', 'description' => 'Τρία πεύκα κάτω από μια αστερόεσσα αψίδα, με βάση για ρεσώ.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Pine Trees Tealight Holder', 'description' => 'A trio of pine trees under a starry arch, with a tealight base.', 'material' => 'Laser-cut wood' ) ),
		),
	),
	'earrings' => array(
		'heroImage' => 'earrings/witch-cat-earrings.jpeg',
		'el'        => array( 'name' => 'Ξύλινα Σκουλαρίκια', 'tagline' => 'Ελαφριά, κομμένα με λέιζερ, φινιρισμένα στο χέρι', 'description' => 'Κρεμαστά σκουλαρίκια κομμένα με λέιζερ από ξύλο, σε εποχιακά και καθημερινά σχέδια.' ),
		'en'        => array( 'name' => 'Wooden Earrings', 'tagline' => 'Lightweight, laser-cut, hand-finished', 'description' => 'Dangle earrings laser-cut from wood, in seasonal and everyday designs.' ),
		'products'  => array(
			'witch-cat-earrings'       => array( 'image' => 'earrings/witch-cat-earrings.jpeg', 'el' => array( 'name' => 'Σκουλαρίκια Γάτα Μάγισσα', 'description' => 'Μια μαύρη γάτα με καπέλο μάγισσας, κομμένη σε ξύλινο κρεμαστό σκουλαρίκι.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Witch Cat Earrings', 'description' => 'A black cat in a witch hat, cut into a wooden dangle earring.', 'material' => 'Laser-cut wood' ) ),
			'ghost-earrings'           => array( 'image' => 'earrings/ghost-earrings.jpeg', 'el' => array( 'name' => 'Σκουλαρίκια Φαντασματάκι', 'description' => 'Ένα φιλικό φαντασματάκι κινουμένων σχεδίων, κομμένο με λέιζερ και φινιρισμένο στο χέρι.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Ghost Earrings', 'description' => 'A friendly cartoon ghost, laser-cut and hand-finished.', 'material' => 'Laser-cut wood' ) ),
			'heart-cat-earrings'       => array( 'image' => 'earrings/heart-cat-earrings.jpeg', 'el' => array( 'name' => 'Σκουλαρίκια Καρδιά με Γάτα', 'description' => 'Ένα πρόσωπο γάτας χαραγμένο μέσα σε ξύλινη καρδιά.', 'material' => 'Ξύλο κομμένο με λέιζερ' ), 'en' => array( 'name' => 'Heart Cat Earrings', 'description' => 'A cat face engraved inside a heart-shaped wooden charm.', 'material' => 'Laser-cut wood' ) ),
			'snowflake-heart-earrings' => array( 'image' => 'earrings/snowflake-heart-earrings.jpeg', 'el' => array( 'name' => 'Σκουλαρίκια Καρδιά με Νιφάδα', 'description' => 'Μια κόκκινη και λευκή καρδιά με νιφάδα χιονιού στο κέντρο.', 'material' => 'Βαμμένο ξύλο' ), 'en' => array( 'name' => 'Snowflake Heart Earrings', 'description' => 'A red-and-white heart charm with a cut-out snowflake center.', 'material' => 'Painted wood' ) ),
		),
	),
	'wooden-games' => array(
		'heroImage' => 'games/camping-tic-tac-toe.jpeg',
		'el'        => array( 'name' => 'Ξύλινα Παιχνίδια Τρίλιζα', 'tagline' => 'Ένα χειροποίητο ταμπλό στο θέμα που αγαπάτε', 'description' => 'Ταμπλό τρίλιζας κομμένα με λέιζερ, με θεματικά πιόνια και βαμμένο φόντο.' ),
		'en'        => array( 'name' => 'Wooden Tic-Tac-Toe Games', 'tagline' => 'A handmade game board in your favorite theme', 'description' => 'Laser-cut tic-tac-toe boards with themed, stained playing pieces.' ),
		'products'  => array(
			'camping-tic-tac-toe' => array( 'image' => 'games/camping-tic-tac-toe.jpeg', 'el' => array( 'name' => 'Τρίλιζα Κάμπινγκ', 'description' => 'Ένα πράσινο ταμπλό με πιόνια φωτιάς κατασκήνωσης και σκηνής.', 'material' => 'Βαμμένο κόντρα πλακέ' ), 'en' => array( 'name' => 'Camping Tic-Tac-Toe', 'description' => 'A green-stained board with campfire and tent playing pieces.', 'material' => 'Stained plywood' ) ),
			'pets-tic-tac-toe'    => array( 'image' => 'games/pets-tic-tac-toe.jpeg', 'el' => array( 'name' => 'Τρίλιζα Γάτες & Σκύλοι', 'description' => 'Ένα μαύρο ταμπλό με χαραγμένα πιόνια γάτας και σκύλου.', 'material' => 'Βαμμένο κόντρα πλακέ' ), 'en' => array( 'name' => 'Cats & Dogs Tic-Tac-Toe', 'description' => 'A black-stained board with engraved cat and dog playing pieces.', 'material' => 'Stained plywood' ) ),
			'spring-tic-tac-toe'  => array( 'image' => 'games/spring-tic-tac-toe.jpeg', 'el' => array( 'name' => 'Τρίλιζα Λαγουδάκι & Κοτοπουλάκι', 'description' => 'Ένα ταμπλό σε χρώμα καρυδιάς με ανοιξιάτικα πιόνια λαγουδακιού και κοτοπουλακιού.', 'material' => 'Βαμμένο κόντρα πλακέ' ), 'en' => array( 'name' => 'Bunny & Chick Tic-Tac-Toe', 'description' => 'A walnut-toned board with spring bunny and chick playing pieces.', 'material' => 'Stained plywood' ) ),
			'summer-tic-tac-toe'  => array( 'image' => 'games/summer-tic-tac-toe.jpeg', 'el' => array( 'name' => 'Τρίλιζα Καλοκαιρινά Φρούτα', 'description' => 'Ένα ροζ ταμπλό με πιόνια καρπουζιού και ανανά.', 'material' => 'Βαμμένο κόντρα πλακέ' ), 'en' => array( 'name' => 'Summer Fruit Tic-Tac-Toe', 'description' => 'A pink-stained board with watermelon and pineapple playing pieces.', 'material' => 'Stained plywood' ) ),
		),
	),
	'pet-keepsakes' => array(
		'heroImage' => 'pets/personalized-pet-ornament.jpeg',
		'el'        => array( 'name' => 'Αναμνηστικά για Κατοικίδια', 'tagline' => 'Για τα τετράποδα μέλη της οικογένειας', 'description' => 'Εξατομικευμένα στολίδια και ταυτότητες με το όνομα του κατοικιδίου σας.' ),
		'en'        => array( 'name' => 'Pet Keepsakes', 'tagline' => 'For the four-legged family members', 'description' => 'Personalized ornaments and tags featuring your pet\'s name.' ),
		'products'  => array(
			'personalized-pet-ornament' => array( 'image' => 'pets/personalized-pet-ornament.jpeg', 'personalizable' => true, 'el' => array( 'name' => 'Εξατομικευμένο Στολίδι με Όνομα Κατοικιδίου', 'description' => 'Ένα στολίδι με πατούσες σε κορνίζα και το όνομα του κατοικιδίου σας σε ταυτότητα σχήματος κόκαλου. Εδώ φτιαγμένο για τη «Freya».', 'material' => 'Ξύλο και ακρυλικό' ), 'en' => array( 'name' => 'Personalized Pet Name Ornament', 'description' => 'A paw-print-framed ornament with your pet\'s name on a bone-shaped tag. Shown here made for "Freya".', 'material' => 'Wood and acrylic' ) ),
		),
	),
);

// ---------------------------------------------------------------------
// Helpers
// ---------------------------------------------------------------------

$image_cache = array();

function b4y_import_image( $relative_path, $title ) {
	global $image_cache;
	if ( isset( $image_cache[ $relative_path ] ) ) {
		return $image_cache[ $relative_path ];
	}

	$abs_path = B4Y_SRC_IMAGES . '/' . $relative_path;
	if ( ! file_exists( $abs_path ) ) {
		WP_CLI::warning( "Missing image: $abs_path" );
		return 0;
	}

	$filename = wp_basename( $abs_path );
	$contents = file_get_contents( $abs_path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$upload   = wp_upload_bits( $filename, null, $contents );

	if ( ! empty( $upload['error'] ) ) {
		WP_CLI::warning( "Upload failed for $relative_path: " . $upload['error'] );
		return 0;
	}

	$filetype   = wp_check_filetype( $upload['file'], null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => $title,
		'post_status'    => 'inherit',
	);
	$att_id = wp_insert_attachment( $attachment, $upload['file'] );
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$att_data = wp_generate_attachment_metadata( $att_id, $upload['file'] );
	wp_update_attachment_metadata( $att_id, $att_data );

	$image_cache[ $relative_path ] = $att_id;
	return $att_id;
}

function b4y_get_or_create_term( $slug, $lang, $name, $description ) {
	$existing = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'slug'       => $slug,
			'hide_empty' => false,
			'lang'       => '',
		)
	);
	foreach ( $existing as $term ) {
		if ( pll_get_term_language( $term->term_id ) === $lang ) {
			wp_update_term( $term->term_id, 'product_cat', array( 'name' => $name, 'description' => $description ) );
			return $term->term_id;
		}
	}

	$result = wp_insert_term( $name, 'product_cat', array( 'slug' => $slug . ( 'el' === $lang ? '' : '-' . $lang . '-tmp' ), 'description' => $description ) );
	if ( is_wp_error( $result ) ) {
		WP_CLI::error( "Term creation failed for $slug/$lang: " . $result->get_error_message() );
	}
	$term_id = $result['term_id'];
	pll_set_term_language( $term_id, $lang );

	// Force the clean slug now that the language taxonomy relationship
	// exists (same duplicate-slug trick as the pages, but term-slug.php
	// actually supports this one nativelyso a plain update is enough).
	global $wpdb;
	$wpdb->update( $wpdb->terms, array( 'slug' => $slug ), array( 'term_id' => $term_id ) );
	clean_term_cache( $term_id, 'product_cat' );

	return $term_id;
}

function b4y_get_or_create_product( $sku, $lang, $name, $description, $material, $personalizable, $cat_term_id, $image_id ) {
	// Lookup: any product with this SKU root already tagged with this language.
	$candidates = get_posts(
		array(
			'post_type'      => 'product',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'meta_key'       => '_b4y_sku_root',
			'meta_value'     => $sku,
			'lang'           => '',
		)
	);
	foreach ( $candidates as $candidate ) {
		if ( pll_get_post_language( $candidate->ID ) === $lang ) {
			$product = wc_get_product( $candidate->ID );
			$product->set_name( $name );
			$product->set_description( $description );
			$product->save();
			update_post_meta( $candidate->ID, '_b4y_material', $material );
			update_post_meta( $candidate->ID, '_b4y_personalizable', $personalizable ? 'yes' : 'no' );
			wp_set_object_terms( $candidate->ID, array( (int) $cat_term_id ), 'product_cat' );
			if ( $image_id ) {
				set_post_thumbnail( $candidate->ID, $image_id );
			}
			return $candidate->ID;
		}
	}

	// Create with a minimal save first so Polylang knows this post's
	// language BEFORE we assign its category term — otherwise Polylang's
	// term-language sync (PLL_CRUD_Terms) "corrects" the assignment back
	// to the default language's term for every post, since a brand new
	// post has no language yet at the moment `set_category_ids()` runs.
	$product = new WC_Product_Simple();
	$product->set_name( $name );
	$product->set_status( 'publish' );
	$id = $product->save();

	pll_set_post_language( $id, $lang );

	$product->set_description( $description );
	$product->set_catalog_visibility( 'visible' );
	$product->set_category_ids( array( (int) $cat_term_id ) );
	if ( $image_id ) {
		$product->set_image_id( $image_id );
	}
	if ( 'el' === $lang ) {
		$product->set_sku( $sku );
	}
	$product->save();

	update_post_meta( $id, '_b4y_sku_root', $sku );
	update_post_meta( $id, '_b4y_material', $material );
	update_post_meta( $id, '_b4y_personalizable', $personalizable ? 'yes' : 'no' );

	return $id;
}

// ---------------------------------------------------------------------
// Import
// ---------------------------------------------------------------------

$category_count = 0;
$product_count   = 0;

foreach ( $catalog as $slug => $cat ) {
	$hero_id = b4y_import_image( $cat['heroImage'], $cat['en']['name'] . ' hero' );

	$el_term = b4y_get_or_create_term( $slug, 'el', $cat['el']['name'], $cat['el']['description'] );
	$en_term = b4y_get_or_create_term( $slug, 'en', $cat['en']['name'], $cat['en']['description'] );

	update_term_meta( $el_term, 'b4y_tagline', $cat['el']['tagline'] );
	update_term_meta( $en_term, 'b4y_tagline', $cat['en']['tagline'] );
	if ( $hero_id ) {
		update_term_meta( $el_term, 'thumbnail_id', $hero_id );
		update_term_meta( $en_term, 'thumbnail_id', $hero_id );
	}

	pll_save_term_translations( array( 'el' => $el_term, 'en' => $en_term ) );
	$category_count++;

	foreach ( $cat['products'] as $product_slug => $p ) {
		$image_id = b4y_import_image( $p['image'], $p['en']['name'] );
		$personalizable = ! empty( $p['personalizable'] );

		$el_id = b4y_get_or_create_product( $product_slug, 'el', $p['el']['name'], $p['el']['description'], $p['el']['material'], $personalizable, $el_term, $image_id );
		$en_id = b4y_get_or_create_product( $product_slug, 'en', $p['en']['name'], $p['en']['description'], $p['en']['material'], $personalizable, $en_term, $image_id );

		pll_save_post_translations( array( 'el' => $el_id, 'en' => $en_id ) );
		$product_count++;
	}

	WP_CLI::log( "Category done: $slug (el={$el_term}, en={$en_term})" );
}

WP_CLI::success( "Imported $category_count categories, $product_count products." );
