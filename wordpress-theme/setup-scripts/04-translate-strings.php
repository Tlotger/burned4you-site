<?php
/**
 * One-off, run via `wp eval-file`. Populates the Greek translation of every
 * UI string registered in inc/template-helpers.php (pll_register_string),
 * ported from src/i18n/dictionaries/el.ts. Without this, Greek pages fall
 * back to the English default text for all static chrome (nav, buttons,
 * section headings) even though product/category content is correctly
 * translated via real post/term translations.
 */

if ( ! function_exists( 'PLL' ) ) {
	WP_CLI::error( 'Polylang not active.' );
}

$translations = array(
	'Home' => 'Αρχική',
	'Catalog' => 'Κατάλογος',
	'About' => 'Σχετικά',
	'Contact' => 'Επικοινωνία',
	'Craft Yours' => 'Φτιάξτε το δικό σας',

	"We laser-cut and engrave ornaments, bookmarks, coasters, and keepsakes from wood, hand-finished and made to order." =>
		'Κόβουμε και χαράζουμε με λέιζερ στολίδια, σελιδοδείκτες, σουβέρ και αναμνηστικά από ξύλο, φινιρισμένα στο χέρι και φτιαγμένα κατά παραγγελία.',
	'Athens, Greece' => 'Αθήνα, Ελλάδα',

	'Custom laser engraving studio' => 'Εργαστήριο χάραξης με λέιζερ',
	'We turn your ideas into' => 'Μετατρέπουμε τις ιδέες σας σε',
	'engraved keepsakes' => 'χαραγμένα αναμνηστικά',
	'Every piece is cut, engraved, and finished by hand. Made to order, just for you.' =>
		'Κάθε κομμάτι κόβεται, χαράζεται και φινιρίζεται στο χέρι. Κατά παραγγελία, ειδικά για εσάς.',
	'Browse the Catalog →' => 'Δείτε τον κατάλογο →',
	'Bring your Idea to life' => 'Ζωντανέψτε την ιδέα σας',
	'Custom orders' => 'Εξατομικευμένες παραγγελίες',
	'Materials' => 'Υλικά',
	'24h' => '24ω',
	'Avg. response' => 'Μέσος χρόνος απάντησης',
	'What we make' => 'Τι φτιάχνουμε',
	'Explore our categories' => 'Ανακαλύψτε τις κατηγορίες μας',
	'From tree ornaments to wooden games, every design can be personalized.' =>
		'Από χριστουγεννιάτικα στολίδια μέχρι ξύλινα παιχνίδια, κάθε σχέδιο μπορεί να εξατομικευτεί.',
	'Simple process' => 'Απλή διαδικασία',
	'How ordering works' => 'Πώς γίνεται η παραγγελία',
	'Tell us your idea' => 'Πείτε μας την ιδέα σας',
	'Pick a category and send us your idea, photo, or design through our form.' =>
		'Διαλέξτε κατηγορία και στείλτε μας την ιδέα, μια φωτογραφία ή ένα σχέδιο μέσω της φόρμας μας.',
	'We craft a proof' => 'Ετοιμάζουμε την πρόταση',
	'We confirm material and size, then get your piece ready to engrave.' =>
		'Επιβεβαιώνουμε υλικό και μέγεθος, και ετοιμάζουμε το κομμάτι σας για χάραξη.',
	'Delivered to your door' => 'Στην πόρτα σας',
	'Your finished, hand-checked piece ships out or is ready for local pickup.' =>
		'Το έτοιμο, ελεγμένο στο χέρι κομμάτι αποστέλλεται ή είναι έτοιμο για παραλαβή.',
	'Have something in mind?' => 'Έχετε κάτι στο μυαλό σας;',
	"Send us your idea and we'll get back to you within 24h." =>
		'Στείλτε μας την ιδέα σας και θα σας απαντήσουμε εντός 24 ωρών.',
	'Start Your Order' => 'Ξεκινήστε την παραγγελία σας',

	'Full catalog' => 'Πλήρης κατάλογος',
	'Choose a category' => 'Διαλέξτε κατηγορία',
	'Every item is made to order. Pick a category to see examples and materials.' =>
		'Κάθε προϊόν φτιάχνεται κατά παραγγελία. Επιλέξτε κατηγορία για να δείτε παραδείγματα και υλικά.',
	'← All categories' => '← Όλες οι κατηγορίες',
	'View 1 item →' => 'Δείτε 1 προϊόν →',
	'View %d items →' => 'Δείτε %d προϊόντα →',
	'Material:' => 'Υλικό:',
	'Made to order' => 'Κατά παραγγελία',
	'Can be personalized' => 'Μπορεί να εξατομικευτεί',
	'Ask About This' => 'Ρωτήστε μας',

	'Our story' => 'Η ιστορία μας',
	'A small studio, obsessed with the details' => 'Ένα μικρό εργαστήριο, με εμμονή στη λεπτομέρεια',
	"We started with a single laser cutter and a lot of curiosity. Today we design and engrave ornaments, bookmarks, and keepsakes for people who want something that couldn't have come from a big-box store." =>
		'Ξεκινήσαμε με ένα λέιζερ και πολλή περιέργεια. Σήμερα σχεδιάζουμε και χαράζουμε στολίδια, σελιδοδείκτες και αναμνηστικά για όσους θέλουν κάτι που δεν θα έβρισκαν σε μια μεγάλη αλυσίδα.',
	'Nothing sits on a shelf. Every piece is cut and engraved after you place your order.' =>
		'Τίποτα δεν περιμένει σε ράφι. Κάθε κομμάτι κόβεται και χαράζεται αφού κάνετε την παραγγελία σας.',
	'Hand-finished' => 'Φινιρισμένο στο χέρι',
	'Every edge is sanded, sealed, and checked by hand before it ships.' =>
		'Κάθε άκρη λειαίνεται, σφραγίζεται και ελέγχεται στο χέρι πριν την αποστολή.',
	'Real materials' => 'Αληθινά υλικά',
	'Solid wood and acrylic accents, no flimsy shortcuts.' => 'Μασίφ ξύλο και ακρυλικές λεπτομέρειες, χωρίς εκπτώσεις στην ποιότητα.',
	'Ready to bring your idea to life?' => 'Έτοιμοι να δώσετε ζωή στην ιδέα σας;',
	'Lets craft it together →' => 'Φτιάξτε το μαζί μας →',

	'Get in touch' => 'Επικοινωνία',
	'Lets craft together' => 'Ας φτιάξουμε κάτι μαζί',
	"Tell us what you have in mind and we'll reply with materials and a timeline." =>
		'Πείτε μας τι έχετε στο μυαλό σας και θα σας απαντήσουμε με υλικά και χρονοδιάγραμμα.',
	'Email' => 'Email',
	'Phone' => 'Τηλέφωνο',
	'Studio' => 'Εργαστήριο',
	'Name' => 'Όνομα',
	'Category' => 'Κατηγορία',
	'General inquiry' => 'Γενική ερώτηση',
	'Item (optional)' => 'Προϊόν (προαιρετικό)',
	'Tell us about your idea' => 'Πείτε μας την ιδέα σας',
	'Sizes, colors, quantity, deadline: anything that helps us understand your idea accurately.' =>
		'Μέγεθος, χρώματα, ποσότητα, προθεσμία: ό,τι μας βοηθά να καταλάβουμε σωστά την ιδέα σας.',
	'Send Message' => 'Αποστολή μηνύματος',
	'Sending…' => 'Αποστολή…',
	'Thanks, message sent!' => 'Ευχαριστούμε, το μήνυμα στάλθηκε!',
	"We usually reply within a day. We'll follow up at the email you provided." =>
		'Συνήθως απαντάμε εντός μίας ημέρας. Θα επικοινωνήσουμε στο email που δώσατε.',
	'Send another message' => 'Στείλτε άλλο μήνυμα',
	'Something went wrong. Please try again.' => 'Κάτι πήγε στραβά. Δοκιμάστε ξανά.',

	'Pages' => 'Σελίδες',
	'Categories' => 'Κατηγορίες',
	'All rights reserved.' => 'Με επιφύλαξη παντός δικαιώματος.',
);

$el = PLL()->model->languages->get( 'el' );
if ( ! $el ) {
	WP_CLI::error( 'Greek language not found.' );
}

$mo = new PLL_MO();
$mo->import_from_db( $el );

$count = 0;
foreach ( $translations as $source => $target ) {
	$mo->add_entry( $mo->make_entry( $source, $target ) );
	$count++;
}

$mo->export_to_db( $el );

WP_CLI::success( "Set $count Greek string translations." );
