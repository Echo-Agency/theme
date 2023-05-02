<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<div class="<?php echo esc_attr( get_theme_mod( 'understrap_container_type' ) ); ?>">

		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

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

			<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

		</footer><!-- .entry-footer -->


</div>
