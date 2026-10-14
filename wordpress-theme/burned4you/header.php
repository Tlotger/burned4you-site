<?php
/**
 * Header: sticky bar with logo, primary nav, language switch, CTA, mobile nav.
 * Structural port of src/components/Header.tsx + MobileNav.tsx.
 */
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page">

	<header class="site-header">
		<div class="container site-header__inner">
			<a href="<?php echo esc_url( function_exists( 'pll_home_url' ) ? pll_home_url() : home_url( '/' ) ); ?>" class="site-logo">
				<span class="site-logo__mark">🔥</span>
				<?php bloginfo( 'name' ); ?>
			</a>

			<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'burned4you' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'fallback_cb'    => 'b4y_fallback_menu',
						'items_wrap'     => '<ul>%3$s</ul>',
					)
				);
				?>
			</nav>

			<div class="header-actions">
				<?php echo b4y_language_switch_link(); // phpcs:ignore ?>
				<a href="<?php echo esc_url( b4y_page_url( 'contact' ) ); ?>" class="btn btn-primary header-cta">
					<?php echo esc_html( b4y_str( 'nav.cta', 'Craft Yours' ) ); ?>
				</a>
				<button type="button" class="mobile-nav-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'burned4you' ); ?>" aria-expanded="false" aria-controls="mobile-nav-panel">
					<svg class="icon-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" /></svg>
					<svg class="icon-close" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18" stroke-linecap="round" /></svg>
				</button>
			</div>

			<div id="mobile-nav-panel" class="mobile-nav-panel">
				<div>
					<nav aria-label="<?php esc_attr_e( 'Mobile', 'burned4you' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'fallback_cb'    => 'b4y_fallback_menu',
								'items_wrap'     => '%3$s',
							)
						);
						?>
					</nav>
					<div class="mobile-nav-panel__bottom">
						<?php echo b4y_language_switch_link(); // phpcs:ignore ?>
						<a href="<?php echo esc_url( b4y_page_url( 'contact' ) ); ?>" class="btn btn-primary">
							<?php echo esc_html( b4y_str( 'nav.cta', 'Craft Yours' ) ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main class="page-transition">
