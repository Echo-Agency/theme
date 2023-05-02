<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="search-wrapper">

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

			<!-- Do the left sidebar check and opens the primary div -->
			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
					<div class="col-lg-12 search-form-category">
						<?php get_search_form(); ?>
					</div>
			
					<div class="col-lg-12">
						<h1 class="entry-title">
						<?php
							printf(
								/* translators: %s: query term */
								esc_html__( 'Search Results for: %s', 'understrap' ),
								'<span>' . get_search_query() . '</span>'
							);
							?>
						</h1>

						<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
					</div>
				

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', 'wide' );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php get_footer(); ?>
