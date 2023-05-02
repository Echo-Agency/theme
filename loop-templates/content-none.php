<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<section class="col-lg-12 no-results not-found mb-5 text-center">

	<header class="page-header">

		<p class="page-title"><?php esc_html_e( 'Nothing Found', 'understrap' ); ?></p>

	</header><!-- .page-header -->

	<div class="page-content row">

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>

			<p>
			<?php
			printf(
				wp_kses(
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'understrap' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				),
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>
				</p>

		<?php elseif ( is_search() ) : ?>

			<!-- <div class="col-lg-12">
				<p><?php // esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'understrap' ); ?></p>
			</div> -->
			<!-- <div class="col-lg-12">
				<?php // get_search_form(); ?>
			</div> -->

			<div class="col-lg-12 text-center my-5">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'Go back to homepage', 'understrap' ); ?>
				</a>
			</div>
			<?php
		else :
			?>
			<div class="col-lg-12">
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'understrap' ); ?></p>
			</div>
			<div class="col-lg-12">
				<?php get_search_form(); ?>
			</div>
			<?php
		endif;
		?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
