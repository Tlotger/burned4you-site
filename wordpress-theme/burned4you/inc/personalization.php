<?php
/**
 * Personalization field for products flagged `_b4y_personalizable` (only
 * the pet-name ornament today). Inquiry happens through the contact form in
 * this pass (see the plan's scope boundary — no cart/checkout yet), but the
 * add-to-cart hook is wired up now so turning on checkout later doesn't
 * require re-visiting this: the field will already carry through to cart
 * and order line items.
 */
defined( 'ABSPATH' ) || exit;

function b4y_is_personalizable( $product_id ) {
	return 'yes' === get_post_meta( $product_id, '_b4y_personalizable', true );
}

function b4y_personalization_field() {
	global $product;
	if ( ! $product || ! b4y_is_personalizable( $product->get_id() ) ) {
		return;
	}
	?>
	<div class="b4y-personalization-field">
		<label for="b4y_personalization"><?php esc_html_e( "Pet's name", 'burned4you' ); ?></label>
		<input type="text" id="b4y_personalization" name="b4y_personalization" />
	</div>
	<?php
}
add_action( 'woocommerce_before_add_to_cart_button', 'b4y_personalization_field' );

function b4y_add_personalization_to_cart_item( $cart_item_data, $product_id ) {
	if ( b4y_is_personalizable( $product_id ) && ! empty( $_POST['b4y_personalization'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		$cart_item_data['b4y_personalization'] = sanitize_text_field( wp_unslash( $_POST['b4y_personalization'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	}
	return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'b4y_add_personalization_to_cart_item', 10, 2 );

function b4y_display_personalization_in_cart( $item_data, $cart_item ) {
	if ( ! empty( $cart_item['b4y_personalization'] ) ) {
		$item_data[] = array(
			'name'  => __( "Pet's name", 'burned4you' ),
			'value' => $cart_item['b4y_personalization'],
		);
	}
	return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'b4y_display_personalization_in_cart', 10, 2 );

function b4y_add_personalization_to_order_item( $item, $cart_item_key, $values ) {
	if ( ! empty( $values['b4y_personalization'] ) ) {
		$item->add_meta_data( __( "Pet's name", 'burned4you' ), $values['b4y_personalization'] );
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'b4y_add_personalization_to_order_item', 10, 3 );
