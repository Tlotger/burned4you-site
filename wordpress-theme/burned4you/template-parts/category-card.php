<?php
/**
 * Category card. Port of src/components/CategoryCard.tsx.
 * Expects $args = [ 'category' => WP_Term, 'index' => int ].
 */
defined( 'ABSPATH' ) || exit;

$category = $args['category'];
$index    = isset( $args['index'] ) ? (int) $args['index'] : 0;

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_url    = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'medium_large' ) : wc_placeholder_img_src( 'medium_large' );
$tagline      = get_term_meta( $category->term_id, 'b4y_tagline', true );
$count        = (int) $category->count;

if ( 1 === $count ) {
	$view_label = b4y_str( 'catalog.view_one', 'View 1 item →' );
} else {
	$view_label = sprintf( b4y_str( 'catalog.view_many', 'View %d items →' ), $count );
}
$has_arrow = ( '→' === mb_substr( rtrim( $view_label ), -1 ) );
if ( $has_arrow ) {
	$view_label = rtrim( mb_substr( $view_label, 0, mb_strlen( $view_label ) - 1 ) );
}
?>
<a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="card category-card drop-in" style="--drop-in-delay: <?php echo esc_attr( min( $index, 6 ) * 45 ); ?>ms;">
	<div class="card__media">
		<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>" />
	</div>
	<div class="card__body">
		<?php if ( $tagline ) : ?>
			<p class="eyebrow"><?php echo esc_html( $tagline ); ?></p>
		<?php endif; ?>
		<h3><?php echo esc_html( $category->name ); ?></h3>
		<p class="desc"><?php echo esc_html( $category->description ); ?></p>
		<span class="category-card__view">
			<?php echo esc_html( $view_label ); ?>
			<?php if ( $has_arrow ) : ?><span class="arrow">→</span><?php endif; ?>
		</span>
	</div>
</a>
