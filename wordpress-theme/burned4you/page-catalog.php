<?php
/**
 * Catalog listing page (all categories). Port of
 * src/components/views/CatalogView.tsx. Auto-selected by WordPress for the
 * page with slug "catalog" (per-language, same slug, different /en/ prefix).
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

<section class="section-tight">
	<div class="container">
		<div class="section-heading">
			<p class="eyebrow"><?php echo esc_html( b4y_str( 'catalog.eyebrow', 'Full catalog' ) ); ?></p>
			<h1><?php echo esc_html( b4y_str( 'catalog.title', 'Choose a category' ) ); ?></h1>
			<p><?php echo esc_html( b4y_str( 'catalog.text', 'Every item is made to order. Pick a category to see examples and materials.' ) ); ?></p>
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

<?php get_footer(); ?>
