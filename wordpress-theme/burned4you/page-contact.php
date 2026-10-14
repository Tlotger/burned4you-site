<?php
/**
 * Contact page. Port of src/components/views/ContactView.tsx +
 * src/components/ContactForm.tsx (submission handled by
 * inc/contact-handler.php + assets/js/contact-form.js instead of a
 * Next.js API route).
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
	<div class="container contact-grid">
		<div>
			<p class="eyebrow"><?php echo esc_html( b4y_str( 'contact.eyebrow', 'Get in touch' ) ); ?></p>
			<h1><?php echo esc_html( b4y_str( 'contact.title', 'Lets craft together' ) ); ?></h1>
			<p><?php echo esc_html( b4y_str( 'contact.text', "Tell us what you have in mind and we'll reply with pricing, materials, and a timeline." ) ); ?></p>

			<dl class="contact-details">
				<div>
					<dt><?php echo esc_html( b4y_str( 'contact.email', 'Email' ) ); ?></dt>
					<dd><?php echo esc_html( get_theme_mod( 'b4y_email', 'hello@burned4you.example' ) ); ?></dd>
				</div>
				<div>
					<dt><?php echo esc_html( b4y_str( 'contact.phone', 'Phone' ) ); ?></dt>
					<dd><?php echo esc_html( get_theme_mod( 'b4y_phone', '+30 694 090 3595' ) ); ?></dd>
				</div>
				<div>
					<dt><?php echo esc_html( b4y_str( 'contact.studio', 'Studio' ) ); ?></dt>
					<dd><?php echo esc_html( b4y_str( 'location', 'Athens, Greece' ) ); ?></dd>
				</div>
			</dl>
		</div>

		<div class="contact-form-card">
			<form id="b4y-contact-form" class="form-grid">
				<div class="form-row">
					<div class="form-field">
						<label for="b4y-name"><?php echo esc_html( b4y_str( 'contact.name', 'Name' ) ); ?></label>
						<input type="text" id="b4y-name" name="name" required />
					</div>
					<div class="form-field">
						<label for="b4y-email"><?php echo esc_html( b4y_str( 'contact.email', 'Email' ) ); ?></label>
						<input type="email" id="b4y-email" name="email" required />
					</div>
				</div>

				<div class="form-row">
					<div class="form-field">
						<label for="b4y-category"><?php echo esc_html( b4y_str( 'contact.category', 'Category' ) ); ?></label>
						<select id="b4y-category" name="category">
							<option value=""><?php echo esc_html( b4y_str( 'contact.general', 'General inquiry' ) ); ?></option>
							<?php foreach ( $categories as $category ) : ?>
								<option value="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-field">
						<label for="b4y-item"><?php echo esc_html( b4y_str( 'contact.item', 'Item (optional)' ) ); ?></label>
						<input type="text" id="b4y-item" name="item" />
					</div>
				</div>

				<div class="form-field">
					<label for="b4y-message"><?php echo esc_html( b4y_str( 'contact.message', 'Tell us about your idea' ) ); ?></label>
					<textarea id="b4y-message" name="message" rows="5" required placeholder="<?php echo esc_attr( b4y_str( 'contact.placeholder', 'Sizes, colors, quantity, deadline: anything that helps us understand your idea accurately.' ) ); ?>"></textarea>
				</div>

				<p class="form-error" hidden></p>

				<button type="submit" class="btn btn-primary form-submit"><?php echo esc_html( b4y_str( 'contact.send', 'Send Message' ) ); ?></button>
			</form>

			<div class="form-success" hidden>
				<h3><?php echo esc_html( b4y_str( 'contact.success_title', 'Thanks, message sent!' ) ); ?></h3>
				<p><?php echo esc_html( b4y_str( 'contact.success_text', "We usually reply within a day. We'll follow up at the email you provided." ) ); ?></p>
				<button type="button" class="form-success__reset"><?php echo esc_html( b4y_str( 'contact.send_another', 'Send another message' ) ); ?></button>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
