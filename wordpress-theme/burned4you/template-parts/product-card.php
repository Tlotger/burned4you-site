<?php
/**
 * Product card. Port of src/components/ProductCard.tsx.
 * Expects $args = [ 'product' => WC_Product, 'category_slug' => string, 'index' => int ].
 */
defined( 'ABSPATH' ) || exit;

$product       = $args['product'];
$category_slug = $args['category_slug'];
$index         = isset( $args['index'] ) ? (int) $args['index'] : 0;

$material       = get_post_meta( $product->get_id(), '_b4y_material', true );
$personalizable = 'yes' === get_post_meta( $product->get_id(), '_b4y_personalizable', true );
$image_url      = wp_get_attachment_image_url( $product->get_image_id(), 'medium_large' );
if ( ! $image_url ) {
	$image_url = wc_placeholder_img_src( 'medium_large' );
}
$price = $product->get_price();

$ask_url = add_query_arg(
	array(
		'item'     => rawurlencode( $product->get_name() ),
		'category' => rawurlencode( $category_slug ),
	),
	b4y_page_url( 'contact' )
);
?>
<div class="card drop-in" style="--drop-in-delay: <?php echo esc_attr( min( $index, 6 ) * 45 ); ?>ms;">
	<div class="card__media">
		<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>" />
	</div>
	<div class="card__body">
		<h3><?php echo esc_html( $product->get_name() ); ?></h3>
		<p class="desc"><?php echo wp_kses_post( $product->get_short_description() ? $product->get_short_description() : $product->get_description() ); ?></p>
		<?php if ( $material ) : ?>
			<p class="meta"><?php echo esc_html( b4y_str( 'catalog.material', 'Material:' ) ); ?> <span class="value"><?php echo esc_html( $material ); ?></span></p>
		<?php endif; ?>
		<?php if ( $personalizable ) : ?>
			<p class="personalizable"><?php echo esc_html( b4y_str( 'catalog.personalizable', 'Can be personalized' ) ); ?></p>
		<?php endif; ?>
		<div class="card__footer">
			<span class="card__price">
				<?php echo '' !== $price ? wp_kses_post( wc_price( $price ) ) : esc_html( b4y_str( 'catalog.made_to_order', 'Made to order' ) ); ?>
			</span>
			<a href="<?php echo esc_url( $ask_url ); ?>" class="card__ask"><?php echo esc_html( b4y_str( 'catalog.ask', 'Ask About This' ) ); ?></a>
		</div>
	</div>
</div>
