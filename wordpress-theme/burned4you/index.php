<?php
/**
 * Fallback template (WordPress requires index.php to exist). The site has
 * no blog; every real page has its own template (front-page.php,
 * page-catalog.php, page-about.php, page-contact.php,
 * woocommerce/taxonomy-product_cat.php).
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="section-tight">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div><?php the_content(); ?></div>
				</article>
				<?php
			endwhile;
			?>
		<?php else : ?>
			<h1><?php esc_html_e( 'Nothing found', 'burned4you' ); ?></h1>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
