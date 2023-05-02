<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'col-12 col-md-6 col-lg-4' ); ?> id="post-<?php the_ID(); ?>">

	<div class="wrapper-blog">
		<div class="row">
			<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php esc_html( the_title() ); ?>">
				<div class="blog-thumbnail col-lg-12">
					<?php
					$image_sizes = array(
						'510px' => 'thumbnail',
						// '400px' => 'thumbnail',
					);
					display_responsive_image( get_post_thumbnail_id(), '', $image_sizes, '510px' );
					?>
					
				</div>
				<div class="blog-content col-lg-12">

					<div class="blog-list-date"><?php echo get_the_date( 'F j, Y' ); ?></div>
					<?php
						$categories = get_the_category();
					?>
					<div class="blog-list-category"><?php echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>'; ?></div>
					
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

					</div>
				</div>

				<footer class="entry-footer">

					<?php // understrap_entry_footer(); ?>

				</footer><!-- .entry-footer -->
			</a> 
		</div>
	</div>
</article><!-- #post-## -->
