<?php
/**
 * Contact form endpoint. Mirrors src/app/api/contact/route.ts: validates the
 * required fields + email shape, and for now just records the submission
 * (a real inbox/CRM hookup is future work, same TODO the Next.js site had).
 */
defined( 'ABSPATH' ) || exit;

function b4y_handle_contact_submission() {
	check_ajax_referer( 'b4y_contact', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$category = isset( $_POST['category'] ) ? sanitize_text_field( wp_unslash( $_POST['category'] ) ) : '';
	$item     = isset( $_POST['item'] ) ? sanitize_text_field( wp_unslash( $_POST['item'] ) ) : '';
	$language = isset( $_POST['language'] ) ? sanitize_text_field( wp_unslash( $_POST['language'] ) ) : '';

	if ( '' === $name || '' === $message || ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => 'Invalid submission.' ), 400 );
	}

	// TODO: wire this up to a real inbox (wp_mail) or CRM before launch —
	// logged only, matching the Next.js site's current /api/contact TODO.
	error_log( // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		sprintf(
			'[Burned4You contact] name=%s email=%s category=%s item=%s language=%s message=%s',
			$name,
			$email,
			$category,
			$item,
			$language,
			$message
		)
	);

	wp_send_json_success( array( 'message' => 'Received.' ) );
}
add_action( 'wp_ajax_b4y_contact', 'b4y_handle_contact_submission' );
add_action( 'wp_ajax_nopriv_b4y_contact', 'b4y_handle_contact_submission' );
