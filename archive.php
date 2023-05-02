<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$current_term = get_queried_object();

$masonry_grid         = rest_sanitize_boolean( get_field( 'masonry_grid_enabled', $current_term ) );
$header_override      = get_field( 'header_override', $current_term );
$header_lead          = get_field( 'header_lead', $current_term );
$header_text          = get_field( 'header_text', $current_term );
$category_pre_header  = esc_html( get_field( 'category_pre_header', $current_term ) );
$category_title_color = esc_html( get_field( 'category_title_color', $current_term ) );
$category_header      = esc_html( get_field( 'category_header', $current_term ) );
$category_description = get_the_archive_description();

?>

<div class="wrapper" id="wrapper-category">

<header class="fullwidth-header<?php echo ( $header_img_enabled ) ? '' : ' default-header'; ?>"<?php echo ( $style ) ?? ''; ?>>
			
			<?php if ( get_field( 'header_background_image_enable' ) && get_field( 'header_background_image_darken' ) ) : ?>
				<div class="bg_image_darken"></div>
			<?php endif; ?>

			<div class="container">
				<div class="row">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>
					<div class="col-lg-12 entry-header">
						
						<?php if ( $header_override ) : ?>
							<h1 class="entry-title"><?php echo $header_override; ?></h1>
						<?php else : ?>
						<?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<?php endif; ?>

						<?php if ( $header_lead ) : ?>
							<div class="header-lead"><?php echo $header_lead; ?></div>
						<?php endif; ?>

						<?php if ( $header_text ) : ?>
							<div class="header-text"><?php echo $header_text; ?></div>
						<?php endif; ?>
					
					</div>
			</div>
			<div class="decor decor-power"><?php echo icon_power(); ?></div>
			<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
			<div class="decor decor-plus"><?php echo icon_plus(); ?></div>
	</header>

	<div class="container-fluid">
	<div class="container" id="content">

			<!-- Do the left sidebar check -->
			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main row" id="main">

				<?php if ( $category_pre_header || $category_header || $category_description ) : ?>
					<div class="additional-category-header col-lg-12">
						<?php if ( $category_pre_header ) : ?>
							<p class="additional-category-title text-<?php echo $category_title_color; ?>">
								<?php echo $category_pre_header; ?>
							</p>
						<?php endif; ?>
						<?php if ( $category_header ) : ?>
							<h2 class="additional-category-heading">
								<?php echo $category_header; ?>
							</h2>
						<?php endif; ?>

						<?php if ( $category_description ) : ?>
							<p class="category-description">
								<?php echo $category_description; ?>
							</p>
						<?php endif; ?>
						
					</div>
				<?php endif; ?>

				<div class="mb-5 articles-loop row">

					<?php
					if ( have_posts() ) :
						$rowCount = 0;
						while ( have_posts() ) :
							$rowCount++;
							the_post();

							if ( 1 == $rowCount || 4 == $rowCount ) {
								get_template_part( 'loop-templates/content', 'wide' );
							} else {
								get_template_part( 'loop-templates/content', 'small' );
							}
							?>
							
							<?php // get_template_part( 'loop-templates/content', $template, $args ); ?>

							<?php
							if ( 3 == $rowCount ) {
								if ( get_field( 'category_cta', $current_term ) ) {
									get_template_part( 'flexible-templates/columns_cta', '', $current_term );
								}
							}
							?>

							<?php
						endwhile;

						if ( 3 > $rowCount ) :
							if ( get_field( 'category_cta', $current_term ) ) {
								get_template_part( 'flexible-templates/columns_cta', '', $current_term );
							}
							endif;
						?>

					<?php else : ?>
						<?php get_template_part( 'loop-templates/content', 'none' ); ?>
					<?php endif; ?>

					<?php if ( $masonry_grid ) : ?>
						<div class="col-1 masonry-sizer"></div>
					<?php endif; ?>

				</div>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer(); ?>

<?php if ( $masonry_grid ) : ?>
	<script defer src="<?php echo get_stylesheet_directory_uri() . '/js/shuffle.min.js'; ?>"></script>

	<script>
		document.addEventListener('DOMContentLoaded', function() {

			var Shuffle = window.Shuffle;
			var element = document.querySelector('.articles-loop');
			var sizer = element.querySelector('.masonry-sizer');

			var shuffleInstance = new Shuffle(element, {
			itemSelector: '.masonry-item',
			sizer: sizer // could also be a selector: '.my-sizer-element'
			});

			jQuery('.masonry-filters').on( 'click', 'a', function(event) {
				event.preventDefault();
				jQuery('.active').removeClass('active');
				jQuery(this).addClass('active');
				var filterValue = jQuery(this).attr('data-group');
				shuffleInstance.filter(filterValue);
				//$grid.isotope({ filter: filterValue });
			});
			

		});
		
	</script>
<?php endif; ?>
