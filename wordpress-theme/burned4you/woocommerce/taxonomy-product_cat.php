<?php
/**
 * Category detail page (WooCommerce product_cat archive). Port of
 * src/components/views/CategoryView.tsx. WooCommerce's product category
 * base is set to "catalog" (see inc/woocommerce-setup.php) so this renders
 * at /catalog/<slug>/, matching the Next.js route exactly.
 */
defined( 'ABSPATH' ) || exit;
get_header();

$category = get_queried_object();

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'large' ) : wc_placeholder_img_src( 'large' );
$tagline      = get_term_meta( $category->term_id, 'b4y_tagline', true );

$products = wc_get_products(
	array(
		'category' => array( $category->slug ),
		'limit'    => -1,
		'orderby'  => 'menu_order',
		'order'    => 'ASC',
		'status'   => 'publish',
	)
);
?>

<section class="section-tight">
	<div class="container">
		<a href="<?php echo esc_url( b4y_page_url( 'catalog' ) ); ?>" class="back-link"><?php echo esc_html( b4y_str( 'catalog.back', '← All categories' ) ); ?></a>

		<div class="category-hero">
			<div class="category-hero__media">
				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" />
			</div>
			<div>
				<?php if ( $tagline ) : ?>
					<p class="eyebrow"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
				<h1><?php echo esc_html( $category->name ); ?></h1>
				<p><?php echo esc_html( $category->description ); ?></p>
			</div>
		</div>

		<div class="grid-cards">
			<?php
			$index = 0;
			foreach ( $products as $product ) {
				get_template_part(
					'template-parts/product-card',
					null,
					array(
						'product'       => $product,
						'category_slug' => $category->slug,
						'index'         => $index,
					)
				);
				$index++;
			}
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
