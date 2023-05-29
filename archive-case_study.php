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

$style = null;
$container            = get_theme_mod( 'understrap_container_type' );
$case_studies_header  = esc_html( get_field( 'case_studies_header', 'option' ) );
$case_studies_lead    = get_field( 'case_studies_lead', 'option' );
$case_studies_heading_logos = get_field( 'case_studies_heading_logos', 'option' );
$case_studies_heading = get_field( 'case_studies_heading', 'option' );
$header_img           = get_field( 'header_img', 'option');
$uuid = uniqid();

if ( !empty($header_img) ) {
	$style = ' style="background-image:url(\'' . esc_url( $header_img ) . '\');"';
}
?>

<div class="wrapper" id="wrapper-case_study">

	<header class="fullwidth-header<?php echo ( !empty($header_img) ) ? '' : ' default-header'; ?>"<?php echo ( $style ) ?? ''; ?>>

			<?php if ( !empty($header_img) ) : ?>
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

						<?php if ( $case_studies_header ) : ?>
							<h1 class="entry-title"><?php echo $case_studies_header; ?></h1>
						<?php endif; ?>

						<?php if ( $case_studies_lead ) : ?>
							<div class="header-lead"><?php echo $case_studies_lead; ?></div>
						<?php endif; ?>
					</div>

				</div>
			</div>
			<div class="decor decor-power"><?php echo icon_power(); ?></div>
			<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
			<div class="decor decor-plus"><?php echo icon_plus(); ?></div>
	</header>
	<div class="container-fluid">
		<div class="container archive-case-study" id="content">

			<!-- Do the left sidebar check -->
			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( $case_studies_heading_logos ) : ?>
					<div class="row">
						<div class="col-lg-12">
							<h2 class="archive-case-study-heading">
								<?php echo $case_studies_heading_logos; ?>
							</h2>
						</div>
					</div>
				<?php endif; ?>
				<div class="flexible-content columns_hero_logotypes">
					<div class="hero_logotypes_content">
						<div class="hero_logotypes_slider">
							<div class="swiper-button-prev hidden-important"></div>
							<div class="swiper-button-next hidden-important"></div>
							<div id="swiper-<?php echo $uuid; ?>" class="swiper swiper-css-mode">
								<div class="swiper-wrapper">

								<?php

								$args = array(
									'post_type'      => 'clients',
									'posts_per_page' => -1,
									'post_status'    => 'publish',
									// 'orderby'        => 'rand',
								);

								$image_sizes = array(
									'380px' => 'thumbnail_no_crop',
								);

								$clients       = new WP_Query( $args );
								$clients_count = count( $clients->get_posts() );

								if ( $clients->have_posts() ) :
									?>

									<?php
									while ( $clients->have_posts() ) :
										$clients->the_post();
										?>

										<div class="swiper-slide hero_logotypes_slider_logotype">

											<?php display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '380px' ); ?>


										</div>
									<?php endwhile; ?>

								<?php else : ?>
									<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
								<?php endif; ?>
								</div>
							</div>
						</div>

						<?php wp_reset_postdata(); ?>
					</div>
				</div>

				<?php if ( $case_studies_heading ) : ?>
				<div class="row">
					<div class="col-lg-12">
						<h2 class="archive-case-study-heading">
							<?php echo $case_studies_heading; ?>
						</h2>
					</div>
				</div>
				<?php endif; ?>

				<?php
				if ( have_posts() ) :
					$rowCount = 0;
					?>

					<?php /* Start the Loop */ ?>
					<?php
					echo '<div class="row">';
					while ( have_posts() ) :
						$rowCount++;
						the_post();
						?>

						<?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */

						if ( 'case_study' === get_post_type() ) :

							get_template_part( 'loop-templates/content', get_post_type() );

							if ( 0 != $rowCount && $rowCount % 2 == 0 ) :
								echo '</div>';
								echo '<div class="row">';
							endif;


						else :
							get_template_part( 'loop-templates/content', get_post_format() );
						endif;
						?>

						<?php
						endwhile;
						echo '</div>';
					?>


				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>



			</main><!-- #main -->


			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>



	</div><!-- #content -->


	</div><!-- #archive-wrapper -->
	<?php
	if ( get_field( 'case_studies_cta', 'option' ) ) {
		get_template_part( 'flexible-templates/columns_cta', '', get_field( 'category_cta', 'option' ) );
	}
	?>
	</div>

<?php get_footer(); ?>


<script>
	document.addEventListener('DOMContentLoaded', function() {
		// jQuery('[data-vbg]').youtube_background({
		// 	'mobile': true,
		// 	'fit-box': true,
		// 	'load-background': true
		// });

		const swiper = new Swiper('#swiper-<?php echo $uuid; ?>', {
			slidesPerView: 1,
			speed: 300,
			loop: true,
			autoplay: true,
			breakpoints: {
				480: {
					slidesPerView: 1,
				},
				768: {
					slidesPerView: 3,
				},
				1024:{
					slidesPerView: 6
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			on:{
				beforeInit: function(){
					const swiperContainer = document.querySelector('#swiper-<?php echo $uuid; ?>')
					swiperContainer.classList.remove('swiper-css-mode')

					const hiddenElements = document.querySelectorAll('.hero_logotypes_slider .hidden-important')
					hiddenElements.forEach(el=> el.classList.remove('hidden-important'))
				}
			}
		})

	});
</script>

<?php if ( isset($full_width) && $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>