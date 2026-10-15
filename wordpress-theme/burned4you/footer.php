<?php
/**
 * Footer: 4-column grid (about, pages, categories, contact) + copyright bar.
 * Port of src/components/Footer.tsx.
 */
defined( 'ABSPATH' ) || exit;
?>
	</main><!-- .page-transition -->

	<footer class="site-footer">
		<div class="container footer-grid">
			<div>
				<div class="footer-logo">
					<span>🔥</span>
					<?php bloginfo( 'name' ); ?>
				</div>
				<p style="margin-top:0.75rem;max-width:20rem;font-size:0.875rem;line-height:1.6;">
					<?php echo esc_html( b4y_str( 'description', "We laser-cut and engrave ornaments, bookmarks, coasters, and keepsakes from wood, hand-finished and made to order." ) ); ?>
				</p>
			</div>

			<div class="footer-col">
				<h3><?php echo esc_html( b4y_str( 'footer.pages', 'Pages' ) ); ?></h3>
				<ul>
					<li><a href="<?php echo esc_url( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) ); ?>"><?php echo esc_html( b4y_str( 'nav.home', 'Home' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( b4y_page_url( 'catalog' ) ); ?>"><?php echo esc_html( b4y_str( 'nav.catalog', 'Catalog' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( b4y_page_url( 'about' ) ); ?>"><?php echo esc_html( b4y_str( 'nav.about', 'About' ) ); ?></a></li>
					<li><a href="<?php echo esc_url( b4y_page_url( 'contact' ) ); ?>"><?php echo esc_html( b4y_str( 'nav.contact', 'Contact' ) ); ?></a></li>
				</ul>
			</div>

			<div class="footer-col">
				<h3><?php echo esc_html( b4y_str( 'footer.categories', 'Categories' ) ); ?></h3>
				<ul>
					<?php
					$footer_cats = get_terms(
						array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => false,
							'number'     => 4,
							'exclude'    => array( get_option( 'default_product_cat', 0 ) ),
						)
					);
					if ( ! is_wp_error( $footer_cats ) ) {
						foreach ( $footer_cats as $cat ) {
							printf(
								'<li><a href="%s">%s</a></li>',
								esc_url( get_term_link( $cat ) ),
								esc_html( $cat->name )
							);
						}
					}
					?>
				</ul>
			</div>

			<div class="footer-col">
				<h3><?php echo esc_html( b4y_str( 'footer.contact', 'Contact' ) ); ?></h3>
				<ul>
					<li><?php echo esc_html( get_theme_mod( 'b4y_email', 'hello@burned4you.example' ) ); ?></li>
					<li><?php echo esc_html( get_theme_mod( 'b4y_phone', '+30 694 090 3595' ) ); ?></li>
					<li><?php echo esc_html( b4y_str( 'location', 'Athens, Greece' ) ); ?></li>
				</ul>
			</div>
		</div>

		<div class="footer-bottom">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php echo esc_html( b4y_str( 'footer.rights', 'All rights reserved.' ) ); ?>
		</div>
	</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
