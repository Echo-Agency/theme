<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$image_sizes = array(
	'540px' => 'medium',
	'380px' => 'thumbnail',
);
?>

<article <?php post_class( 'row' ); ?> id="post-<?php the_ID(); ?>">

	<!-- <div class="col-md-12 col-lg-6"> -->
		<?php // display_responsive_image( get_post_thumbnail_id(), '', $image_sizes, '540px' ); ?>
	<!-- </div> -->

	<div class="entry-content col-lg-12">
	
		<!-- <div class="entry-meta mt-4"> -->

			<?php // understrap_posted_on(); ?>

		<!-- </div> -->
		
		<?php get_template_part( 'inc/page-builder' ); ?>

		<?php // the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php // understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
