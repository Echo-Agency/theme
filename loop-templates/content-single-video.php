<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$intro = get_field( 'intro' );

?>

<article <?php post_class( '' ); ?> id="post-<?php the_ID(); ?>">

	<div class="row">
		<div class="entry-content col-lg-12">

		<?php if ( $intro ) : ?>
			<div class="single_post_intro"><?php echo $intro; ?></div>
		<?php endif; ?>
		</div>
	</div>

	<?php get_template_part( 'inc/page-builder' ); ?>

	<?php
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		)
	);
	?>

	<footer class="entry-footer">

		<?php // understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
