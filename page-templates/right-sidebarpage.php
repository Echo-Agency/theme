<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$style              = null;
$header_img_enabled = rest_sanitize_boolean( get_field( 'header_background_image_enable' ) );

if ( $header_img_enabled ) {
	$style = ' style="background-image:url(\'' . esc_url( get_field( 'header_background_image' ) ) . '\');"';
}
?>

<div class="wrapper" id="sidebar-page-wrapper">

	<header class="sidebar-header<?php echo ( $header_img_enabled ) ? '' : ' default-header'; ?>"<?php echo ( $style ) ?? ''; ?>>
			
			<?php if ( get_field( 'header_background_image_enable' ) && get_field( 'header_background_image_darken' ) ) : ?>
				<div class="bg_image_darken"></div>
			<?php endif; ?>

		<div class="container">
			<div class="row">
				<div class="col-lg-12 entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</div>

		<!-- <div class="entry-meta"> -->

			<?php // understrap_posted_on(); ?>

		<!--</div> .entry-meta -->

	</header><!-- .entry-header -->

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div
				class="
				<?php
				if ( is_active_sidebar( 'right-sidebar' ) ) :
					?>
					col-md-8
					<?php
else :
	?>
					col-md-12<?php endif; ?> content-area"
				id="primary">

				<main class="site-main" id="main" role="main">

					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<?php get_template_part( 'loop-templates/content', 'page' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->
</div>
<?php get_footer(); ?>
