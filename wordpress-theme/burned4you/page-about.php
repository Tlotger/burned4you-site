<?php
/**
 * About page. Port of src/components/views/AboutView.tsx.
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<section class="section-tight section-ink page-hero">
	<div class="container">
		<p class="eyebrow"><?php echo esc_html( b4y_str( 'about.eyebrow', 'Our story' ) ); ?></p>
		<h1><?php echo esc_html( b4y_str( 'about.title', 'A small studio, obsessed with the details' ) ); ?></h1>
		<p><?php echo esc_html( b4y_str( 'about.text', "Burned4You started with a single laser cutter and a lot of curiosity. Today we design and engrave ornaments, bookmarks, and keepsakes for people who want something that couldn't have come from a big-box store." ) ); ?></p>
	</div>
</section>

<section class="section-tight">
	<div class="container">
		<div class="values-grid">
			<div class="value-card">
				<h3><?php echo esc_html( b4y_str( 'about.value1_title', 'Made to order' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'about.value1_text', 'Nothing sits on a shelf. Every piece is cut and engraved after you place your order.' ) ); ?></p>
			</div>
			<div class="value-card">
				<h3><?php echo esc_html( b4y_str( 'about.value2_title', 'Hand-finished' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'about.value2_text', 'Every edge is sanded, sealed, and checked by hand before it ships.' ) ); ?></p>
			</div>
			<div class="value-card">
				<h3><?php echo esc_html( b4y_str( 'about.value3_title', 'Real materials' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'about.value3_text', 'Solid wood and acrylic accents, no flimsy shortcuts.' ) ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section-tight section-cream-soft">
	<div class="container" style="display:flex;flex-direction:column;align-items:center;gap:1.5rem;text-align:center;">
		<h2><?php echo esc_html( b4y_str( 'about.cta_title', 'Ready to bring your idea to life?' ) ); ?></h2>
		<a class="btn btn-primary" href="<?php echo esc_url( b4y_page_url( 'contact' ) ); ?>"><?php echo esc_html( b4y_str( 'about.cta_button', 'Lets craft it together →' ) ); ?></a>
	</div>
</section>

<?php get_footer(); ?>
