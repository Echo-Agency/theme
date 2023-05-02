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

	<div class="wrapper-portfolio">
		<div class="row">
			<a href="<?php echo get_permalink( $post->ID ); ?>" title="<?php esc_html( the_title() ); ?>">
				<div class="portfolio-thumbnail col-lg-12">
					<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
				</div>
				<div class="portfolio-content col-lg-12">
					
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
			</a>
		</div>
	</div>
</article><!-- #post-## -->
