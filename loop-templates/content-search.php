<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'col-12' ); ?> id="post-<?php the_ID(); ?>">

	<div class="wrapper-search">
		<div class="row search-item">
			<div class="search-thumbnail col-md-12 col-lg-4">
				<?php
					$image_sizes = array(
						'510px' => 'medium',
					);
					display_responsive_image( get_post_thumbnail_id(), '', $image_sizes, '510px' );
					?>
			</div>
			<div class="search-content col-md-12 col-lg-8">

				<div class="search-list-date"><?php the_date( 'F j, Y' ); ?></div>
				<div class="search-list-category"><?php the_category( ' ' ); ?></div>
				
				<?php
					the_title(
						sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
						'</a></h2>'
					);
					?>

				<div class="entry-excerpt">

					<?php the_excerpt(); ?>

					<?php
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
							'after'  => '</div>',
						)
					);
					?>

				</div><!-- .entry-content -->
			</div>

			<footer class="entry-footer">

				<?php // understrap_entry_footer(); ?>

			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
