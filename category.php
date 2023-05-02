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

$container = get_theme_mod( 'understrap_container_type' );

$current_term  = get_queried_object();
$base_category = $current_term->slug;

$category = get_the_category();

if ( 1 == $current_term->term_id ) { // children only for blog
	$args = array(
		'child_of' => $current_term->term_id,
	);
} else {
	$args = array(
		'exclude' => $current_term->term_id,
	);
}

$categories = get_categories( $args );

$style = null;

if ( get_field( 'header_background_image_enable', $current_term ) ) {
	$style = ' style="background-image:url(\'' . esc_url( get_field( 'header_background_image', $current_term ) ) . '\');"';
}

$masonry_grid         = rest_sanitize_boolean( get_field( 'masonry_grid_enabled', $current_term ) );
$header_override      = esc_html( get_field( 'header_override', $current_term ) );
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

			<main class="site-main" id="main">

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

				<div class="row">
					<div class="col-lg-4 search-form-category">
						<?php get_search_form(); ?>
					</div>
					<?php // if ( 1 == $current_term->term_id ): //1 for baza wiedzy ?>
					<?php if ( 1 == $current_term->term_id ) : ?>
						<div class="col-lg-8 only-video-category">
							<?php if ( ! isset( $_GET['post_format'] ) ) : ?>
								<a class="btn btn-bordered" title="<?php esc_html_e( 'Show video only', 'understrap' ); ?>" href="<?php echo get_category_link( $current_term ) . '?post_format=video'; ?>"><?php esc_html_e( 'Show video only', 'understrap' ); ?></a>
							<?php else : ?>
								<a class="btn btn-primary" title="<?php esc_html_e( 'Show all posts', 'understrap' ); ?>" href="<?php echo get_category_link( $current_term ); ?>"><?php esc_html_e( 'Show all posts', 'understrap' ); ?></a>
							<?php endif; ?>
							<a class="btn btn-bordered" title="<?php esc_html_e( 'Premium content', 'understrap' ); ?>" href="<?php echo get_permalink( 3032 ); ?>"><?php esc_html_e( 'Premium content', 'understrap' ); ?></a>
						</div>
					<?php endif; ?>
				</div>

				<div class=" blog-categories-container">
					<?php
					if ( $categories ) :
						$counter           = 0;
						$split             = 5;
						$categories_count  = count( $categories );
						$categories_hidden = $categories_count - $split;
						?>
						<div class="blog-categories">

							<?php
							foreach ( $categories as $blog_category ) :
								?>
									<div class="blog-category-link<?php echo $counter >= $split ? ' blog-category-hidden' : ''; ?>">
										<a
										title="<?php echo $blog_category->cat_name; ?>"
										href="<?php echo get_category_link( $blog_category->cat_ID ); ?>">
										<?php echo $blog_category->cat_name; ?>
										</a>
									</div>
								<?php
								$counter++;
									endforeach;
							?>

							<?php if ( $categories_hidden > 0 ) : ?>
								<div class="blog-categories-hidden-count">
									<span class="blog-categories-hidden-counter"> +<?php echo $categories_hidden; ?></span>
									<span class="show-more-categories"><?php esc_html_e( 'Show more categories', 'understrap' ); ?></span>
									<span class="show-less-categories"><?php esc_html_e( 'Show less categories', 'understrap' ); ?></span>
								</div>
							<?php endif; ?>

						</div>
					<?php endif; ?>
				</div>

				<?php if ( have_posts() ) : ?>
					<?php
					if ( ! $masonry_grid ) {
						$template = $category[0]->slug;
					} else {
						$template = 'masonry';
						?>
						<div class="masonry-filters col-lg-12">
							<span><a href="#" data-group="<?php echo $base_category; ?>"><?php esc_html_e( 'All', 'understrap' ); ?></a></span>

							<?php foreach ( $categories as $key => $category ) : ?>
								<span><a href="#" data-group="<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></span>
							<?php endforeach; ?>
						</div>
						<?php
					}
					?>

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
								// if ( 3 == $rowCount ) {
								// 	if ( get_field( 'category_cta', $current_term ) ) {
								// 		get_template_part( 'flexible-templates/columns_cta', '', $current_term );
								// 	}
								// }
								?>

								<?php
							endwhile;

							// if ( 3 > $rowCount ) :
							// 	if ( get_field( 'category_cta', $current_term ) ) {
							// 		get_template_part( 'flexible-templates/columns_cta', '', $current_term );
							// 	}
							// 	endif;
							?>

						<?php endif; ?>

						<?php if ( $masonry_grid ) : ?>
							<div class="col-1 masonry-sizer"></div>
						<?php endif; ?>

					</div>
				<?php else : ?>
					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>


	</div><!-- #content -->
	</div>
	</div><!-- #archive-wrapper -->

<?php get_footer(); ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		jQuery('.show-more-categories').click(function() {
			jQuery('.blog-category-hidden').css("display", "flex").addClass('blog-category-visible').fadeIn(100);
			jQuery('.blog-categories-hidden-counter').fadeOut(100);
			jQuery(this).fadeOut(100);
			jQuery('.show-less-categories').css("display", "flex").fadeIn(100);
		});

		jQuery('.show-less-categories').click(function() {
			jQuery('.blog-category-visible').removeClass('blog-category-visible').fadeOut(100);
			jQuery('.blog-categories-hidden-counter').css("display", "flex").fadeIn(100);
			jQuery(this).fadeOut(100);
			jQuery('.show-more-categories').css("display", "flex").fadeIn(100);
		});
	});
</script>

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
