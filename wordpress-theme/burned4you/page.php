<?php
/**
 * Generic page fallback (for any WP page without its own page-{slug}.php).
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>
<section class="section-tight">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h1><?php the_title(); ?></h1>
			<div><?php the_content(); ?></div>
			<?php
		endwhile;
		?>
	</div>
</section>
<?php get_footer(); ?>
