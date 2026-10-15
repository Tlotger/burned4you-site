<?php
/**
 * Home page. Port of src/components/views/HomeView.tsx.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$categories = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'exclude'    => array( get_option( 'default_product_cat', 0 ) ),
	)
);
if ( is_wp_error( $categories ) ) {
	$categories = array();
}
?>

<section class="hero section-ink">
	<span class="hero__glow hero__glow--top"></span>
	<span class="hero__glow hero__glow--bottom"></span>
	<div class="container hero__inner">
		<p class="eyebrow-pill"><?php echo esc_html( b4y_str( 'home.pill', 'Custom laser engraving studio' ) ); ?></p>
		<h1>
			<?php echo esc_html( b4y_str( 'home.h1_before', 'We turn your ideas into' ) ); ?>
			<em> <?php echo esc_html( b4y_str( 'home.h1_em', 'engraved keepsakes' ) ); ?></em>
		</h1>
		<p class="hero__lead">
			<?php echo esc_html( b4y_str( 'description', "We laser-cut and engrave ornaments, bookmarks, coasters, and keepsakes from wood, hand-finished and made to order." ) ); ?>
			<?php echo esc_html( b4y_str( 'home.lead2', 'Every piece is cut, engraved, and finished by hand. Made to order, just for you.' ) ); ?>
		</p>
		<div class="hero__actions">
			<a class="btn btn-primary" href="<?php echo esc_url( b4y_page_url( 'catalog' ) ); ?>"><?php echo esc_html( b4y_str( 'home.browse', 'Browse the Catalog →' ) ); ?></a>
			<a class="btn btn-outline" href="<?php echo esc_url( b4y_page_url( 'contact' ) ); ?>"><?php echo esc_html( b4y_str( 'home.secondary', 'Bring your Idea to life' ) ); ?></a>
		</div>
		<div class="hero__stats">
			<div>
				<div class="stat-value"><?php echo esc_html( b4y_str( 'home.stat1_value', '500+' ) ); ?></div>
				<div class="stat-label"><?php echo esc_html( b4y_str( 'home.stat1_label', 'Custom orders' ) ); ?></div>
			</div>
			<div>
				<div class="stat-value"><?php echo esc_html( b4y_str( 'home.stat2_value', '6' ) ); ?></div>
				<div class="stat-label"><?php echo esc_html( b4y_str( 'home.stat2_label', 'Materials' ) ); ?></div>
			</div>
			<div>
				<div class="stat-value"><?php echo esc_html( b4y_str( 'home.stat3_value', '24h' ) ); ?></div>
				<div class="stat-label"><?php echo esc_html( b4y_str( 'home.stat3_label', 'Avg. response' ) ); ?></div>
			</div>
		</div>
	</div>
</section>

<section class="section section-cream">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php echo esc_html( b4y_str( 'home.cats_eyebrow', 'What we make' ) ); ?></p>
			<h2><?php echo esc_html( b4y_str( 'home.cats_title', 'Explore our categories' ) ); ?></h2>
			<p><?php echo esc_html( b4y_str( 'home.cats_text', 'From tree ornaments to wooden games, every design can be personalized.' ) ); ?></p>
		</div>
		<div class="grid-cards">
			<?php
			$index = 0;
			foreach ( $categories as $category ) {
				get_template_part( 'template-parts/category-card', null, array( 'category' => $category, 'index' => $index ) );
				$index++;
			}
			?>
		</div>
	</div>
</section>

<section class="section section-ink-soft">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php echo esc_html( b4y_str( 'home.process_eyebrow', 'Simple process' ) ); ?></p>
			<h2><?php echo esc_html( b4y_str( 'home.process_title', 'How ordering works' ) ); ?></h2>
		</div>
		<div class="steps-grid">
			<div class="step-card">
				<span class="step-n">01</span>
				<h3><?php echo esc_html( b4y_str( 'home.step1_title', 'Tell us your idea' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'home.step1_text', 'Pick a category and send us your idea, photo, or design through our form.' ) ); ?></p>
			</div>
			<div class="step-card">
				<span class="step-n">02</span>
				<h3><?php echo esc_html( b4y_str( 'home.step2_title', 'We craft a proof' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'home.step2_text', 'We confirm material and size, then get your piece ready to engrave.' ) ); ?></p>
			</div>
			<div class="step-card">
				<span class="step-n">03</span>
				<h3><?php echo esc_html( b4y_str( 'home.step3_title', 'Delivered to your door' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'home.step3_text', 'Your finished, hand-checked piece ships out or is ready for local pickup.' ) ); ?></p>
			</div>
		</div>
	</div>
</section>

<section class="section section-cream">
	<div class="container">
		<div class="cta-band">
			<h2><?php echo esc_html( b4y_str( 'home.cta_title', 'Have something in mind?' ) ); ?></h2>
			<p><?php echo esc_html( b4y_str( 'home.cta_text', "Send us your idea and we'll get back to you within 24h." ) ); ?></p>
			<a class="btn btn-outline on-light" href="<?php echo esc_url( b4y_page_url( 'contact' ) ); ?>"><?php echo esc_html( b4y_str( 'home.cta_button', 'Start Your Order' ) ); ?></a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
