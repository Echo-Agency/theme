<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="error-404-wrapper">
	<div class="error-404-bg">
		404
	</div>

	<div class="decor decor-power"><?php echo icon_power(); ?></div>
	<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
	<div class="decor decor-plus"><?php echo icon_plus(); ?></div>

	<div class="container-fluid fullwidth-header default-header">
		<div class="container">
			<div class="row">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</div>
	</div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="content-area col-lg-12" id="primary">

				<main class="site-main" id="main">

					<section class="error-404 not-found">

						<div class="page-content">

							<div class="col-lg-12 text-center">

								<h1>
									<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'understrap' ); ?>
								</h1>

								<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
							</div>

							<div class="col-lg-12">
								<p class="not-found-header"><?php esc_html_e( 'We do not know...', 'understrap' ); ?></p>
							</div>
							<div class="col-lg-12 text-center my-5">
								
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="btn btn-primary">
										<?php esc_html_e( 'Go back to homepage', 'understrap' ); ?>
									</a>
							</div>
							<!-- <div class="col-lg-12 my-5">
								<div class="row">
									<div class="col-lg-4 text-center">
									<a href="<?php //echo esc_url( home_url( '/' ) ); ?>" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="btn btn-primary">
										<?php //esc_html_e( 'Go back to homepage', 'understrap' ); ?>
									</a>
									</div>
									<div class="col-lg-4 text-center">
									<a href="<?php //echo get_page_link( 11 ); ?>" title="<?php //echo get_the_title( 11 ); ?>" class="btn btn-primary">
									<?php //esc_html_e( 'Contact us', 'understrap' ); ?>
									</a>
									</div>
									<div class="col-lg-4 text-center">
									<a href="<?php //echo get_page_link( 763 ); ?>" title="<?php //echo get_the_title( 763 ); ?>" class="btn btn-primary">
									<?php //esc_html_e( 'Increasing sales', 'understrap' ); ?>
									</a>
									</div>
								</div>
							</div> -->

							<!-- <div class="col-lg-12 search-form-404">
								<?php //get_search_form(); ?>
							</div> -->
							<!-- <div class="col-lg-12">
								<div class="row">
									<div class="col-lg-6 text-center">
										<?php //the_widget( 'WP_Widget_Recent_Posts' ); ?>
									</div>

									<div class="col-lg-6 text-center">
									<?php //if ( understrap_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>

										<div class="widget widget_categories">

											<h2 class="widgettitle"><?php //esc_html_e( 'Most Used Categories', 'understrap' ); ?></h2>

											<ul>
												<?php
												// wp_list_categories(
												// 	array(
												// 		'orderby'    => 'count',
												// 		'order'      => 'DESC',
												// 		'show_count' => 1,
												// 		'title_li'   => '',
												// 		'number'     => 10,
												// 	)
												// );
												?>
											</ul>

										</div>

									<?php //endif; ?>

									</div>
								</div>
							</div> -->

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php get_footer(); ?>
