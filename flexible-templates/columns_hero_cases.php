<?php
	$full_width = rest_sanitize_boolean( get_sub_field( 'hero_full_width' ) );
	$bg_image   = esc_url( get_sub_field( 'hero_background_image' ) );
	$bg_color   = esc_html( get_sub_field( 'hero_case_bg_color' ) );

	$bg_image_darken = rest_sanitize_boolean( get_sub_field( 'hero_background_image_darken' ) );

	$title       = esc_html( get_sub_field( 'hero_case_title' ) );
	$title_color = esc_html( get_sub_field( 'hero_case_title_color' ) );
	$header      = get_sub_field( 'hero_case_header' );

	$button_text      = esc_html( get_sub_field( 'button_text' ) );
	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );
	$button_class     = 'btn-bordered';

	$style = null;

if ( $bg_image ) {
	$style = ' style="background-image:url(\'' . $bg_image . '\')"';
}

	$uuid = uniqid();
?>

<?php if ( $full_width ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	<div class="row p-0">
<?php endif; ?>

<div class="flexible-content columns_hero_cases <?php echo ( ( $bg_color ) ? ' background-' . $bg_color : '' ) . '"' . ( $style ) ?? ''; ?>>
	<?php
	if ( $bg_image && $bg_image_darken ) {
		echo '<div class="bg_image_darken"></div>';
	}
	?>
	<div class="container">
		<div class="hero_cases_content">

			<div class="col-lg-12 text-center hero-cases-title<?php echo ' text-' . $title_color; ?>">
				<?php echo $title; ?>
			</div>
		
			<div class="col-lg-12 text-center hero-cases-header">
				<h2><?php echo $header; ?></h2>
			</div>
			
			
			<div class="hero_cases_slider">
				<div id="slick-<?php echo $uuid; ?>">

					<?php

					$args               = array(
						'post_type'      => 'case_study',
						'posts_per_page' => -1,
						'post_status'    => 'publish',
						'orderby'        => 'menu_order',
					);
					$case_studies       = new WP_Query( $args );
					$case_studies_count = count( $case_studies->get_posts() );

					$image_sizes = array(
						'690px' => 'big',
						'540px' => 'medium',
						'300px' => 'thumbnail',
					);

					if ( $case_studies->have_posts() ) :
						?>
						
						<?php
						while ( $case_studies->have_posts() ) :
							$case_studies->the_post();
							?>
							<?php
								$case_study_client = get_field( 'case_study_client' );
							?>
							<div class="hero_cases_slider_case">	
								<div class="hero_cases_slider_case_title">
									<div class="decor"></div>
									<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php the_title(); ?>">
										<?php echo the_title(); ?> 
									</a>
								</div>

								<div class="hero_cases_slider_case_image">
									<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php the_title(); ?>">
										<?php
											display_responsive_image( get_post_thumbnail_id( get_the_ID() ), $case_study_title, $image_sizes, '690px' );

											echo icon_power();
										?>
									</a>
								</div>

								<div class="hero_cases_slider_case_footer">
									<div class="hero_cases_slider_case_client">
										<span class="hero_cases_slider_case_client_title">
											<?php esc_html_e( 'Client', 'understrap' ); ?>:
										</span>
										<span class="hero_cases_slider_case_client_name">
										<?php echo esc_html( $case_study_client[0]->post_title ); ?>
										</span>
									</div>
									<div class="hero_cases_slider_case_btn">
										<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php the_title(); ?>" class="btn btn-primary"><?php esc_html_e( 'Check it out', 'understrap' ); ?></a>
									</div>
								</div>
								
							</div>
						<?php endwhile; ?>

					<?php else : ?>
							<p>
								<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
							</p>
					<?php endif; ?>

				</div>
			</div>

			<?php wp_reset_postdata(); ?>

			<?php
			if ( $button_text && $button_url ) :
				?>
				<div class="col-md-12 text-center">
					<?php include locate_template( 'flexible-templates/button.php', false, false ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php if ( ! isset( $GLOBALS['slick_scripts_loaded'] ) or false === $GLOBALS['slick_scripts_loaded'] ) : ?>
	<script defer="defer" src="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick.min.js'; ?>"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick.css'; ?>">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick-theme.css'; ?>">
	
	<?php $GLOBALS['slick_scripts_loaded'] = true; ?>
	</p>
<?php endif; ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		setTimeout(function(){ 
			jQuery('#slick-<?php echo $uuid; ?>').slick({
				infinite: true,
				slidesToShow: 2,
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
						slidesToShow: 1,
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
		}, 3500);
	});
</script>

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
