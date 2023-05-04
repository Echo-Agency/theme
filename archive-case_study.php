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
$container            = get_theme_mod( 'understrap_container_type' );
$case_studies_header  = esc_html( get_field( 'case_studies_header', 'option' ) );
$case_studies_lead    = get_field( 'case_studies_lead', 'option' );
$case_studies_heading_logos = get_field( 'case_studies_heading_logos', 'option' );
$case_studies_heading = get_field( 'case_studies_heading', 'option' );
$uuid = uniqid();
?>

<div class="wrapper" id="wrapper-case_study">

	<header class="fullwidth-header<?php echo ( !empty($header_img_enabled) ) ? '' : ' default-header'; ?>"<?php echo ( $style ) ?? ''; ?>>

			<div class="video-bg">
				<div class="video-cover"></div>
				<div class="video" data-vbg="https://www.youtube.com/watch?v=sf7ILODhCBI"></div>
			</div>
			
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
				<div class="flexible-content columns_hero_logotypes"<?php echo ( $style ) ?? ''; ?>>
					<div class="hero_logotypes_content">
						<div class="hero_logotypes_slider">
							<div id="slick-<?php echo $uuid; ?>">

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

										<div class="hero_logotypes_slider_logotype">	
											
											<?php display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '380px' ); ?>
											
											
										</div>
									<?php endwhile; ?>

								<?php else : ?>
									<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
								<?php endif; ?>

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

<?php if ( ! isset( $GLOBALS['slick_scripts_loaded'] ) or false === $GLOBALS['slick_scripts_loaded'] ) : ?>
	<script defer="defer" src="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick.min.js'; ?>"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick.css'; ?>">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick-theme.css'; ?>">
	
	<?php $GLOBALS['slick_scripts_loaded'] = true; ?>
	</p>
<?php endif; ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {

		jQuery('[data-vbg]').youtube_background({
			'mobile': true,
			'fit-box': true,
			'load-background': true
		});

		jQuery('#slick-<?php echo $uuid; ?>').slick({
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 1,
			dots: false,
			arrows: true,
			speed: 300,
			lazyLoad: 'ondemand',
			autoplay: true,
			variableWidth: false,
			responsive: [
				{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1,
				}
				},
				{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
				},
				{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
		
	});
</script>

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>