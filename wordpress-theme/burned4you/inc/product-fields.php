<?php
/**
 * Admin UI for the custom product fields the import script sets directly
 * (_b4y_material, _b4y_personalizable) so they can be edited by hand for
 * products added or changed through wp-admin, not just via
 * setup-scripts/03-import-catalog.php. Read by inc/personalization.php
 * and template-parts/product-card.php.
 */
defined( 'ABSPATH' ) || exit;

function b4y_add_custom_product_fields() {
	echo '<div class="options_group">';

	woocommerce_wp_text_input(
		array(
			'id'          => '_b4y_material',
			'label'       => __( 'Material', 'burned4you' ),
			'placeholder' => __( 'e.g. Engraved birch wood', 'burned4you' ),
			'desc_tip'    => true,
			'description' => __( 'Shown on the product page as the material.', 'burned4you' ),
		)
	);

	woocommerce_wp_checkbox(
		array(
			'id'          => '_b4y_personalizable',
			'label'       => __( 'Personalizable', 'burned4you' ),
			'description' => __( "Shows a \"Pet's name\" text field before Add to Cart.", 'burned4you' ),
		)
	);

	echo '</div>';
}
add_action( 'woocommerce_product_options_general_product_data', 'b4y_add_custom_product_fields' );

function b4y_save_custom_product_fields( $post_id ) {
	$material = isset( $_POST['_b4y_material'] ) ? sanitize_text_field( wp_unslash( $_POST['_b4y_material'] ) ) : '';
	update_post_meta( $post_id, '_b4y_material', $material );

	$personalizable = isset( $_POST['_b4y_personalizable'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_b4y_personalizable', $personalizable );
}
add_action( 'woocommerce_process_product_meta', 'b4y_save_custom_product_fields' );
