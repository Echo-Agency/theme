<?php
	$full_width      = rest_sanitize_boolean( get_sub_field( 'hero_full_width' ) );
	$bg_image        = esc_url( get_sub_field( 'hero_background_image' ) );
	$bg_image_darken = rest_sanitize_boolean( get_sub_field( 'hero_background_image_darken' ) );


	$title       = esc_html( get_sub_field( 'hero_opinion_title' ) );
	$title_color = esc_html( get_sub_field( 'hero_opinion_title_color' ) );
	$header      = get_sub_field( 'hero_opinion_header' );

	$button = get_sub_field( 'hero_cta_button' );

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


<div class="flexible-content columns_hero_opinion container"<?php echo ( $style ) ?? ''; ?>>
	<?php
	if ( $bg_image && $bg_image_darken ) {
		echo '<div class="bg_image_darken"></div>';
	}

	$args = array(
		'post_type'      => 'opinie',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
		// 'orderby'        => 'rand',
	);

	$opinions = new WP_Query( $args );
	// $opinions_count = count( $opinions->get_posts() );
	// $case_opinion_score_total = 0;

	// if ( $opinions->have_posts() ) {
	// while( $opinions->have_posts() ) : $opinions->the_post();
	// $case_opinion_score_total += absint( get_field( 'opinion_score' ) );
	// endwhile;

	// $case_opinion_score_avg = $case_opinion_score_total / $opinions_count;
	// }

	?>

	<div class="hero_opinion_content ">
		
		<div class="col-lg-12 hero-opinion-title text-<?php echo $title_color; ?>">
			<?php echo $title; ?>
		</div>
	
		<div class="col-lg-12 hero-opinion-header">
			<h2><?php echo $header; ?></h2>
		</div>

		<!-- <div class="col-lg-12">

			<div class="hero-opinion-total-rating-title">
				<?php // esc_html_e( 'Total rating', 'understrap' ); ?>
			</div>

			<div class="hero-opinion-total-rating">
				<div class="hero-opinion-total-rating-score">
					<?php // echo number_format( $case_opinion_score_avg, 1 ); ?>
				</div>
				<div class="stars">
					<?php // echo display_rating( $case_opinion_score_avg ); ?>
				</div>
				<div class="hero-opinion-total-opinions-count">
					<?php
						// echo $opinions_count . ' ';

						// if( 1 == $opinions_count ) {
						// echo esc_html_e( 'Opinion', 'understrap' );
						// } elseif( 1 < substr($opinions_count, -1) && 5 > substr($opinions_count, -1) ){
						// echo esc_html_e( 'Opinion(2-4)', 'understrap' );
						// } else {
						// echo esc_html_e( 'Opinion(0,5+)', 'understrap' );
						// }

					?>
				</div>
			</div>

		</div> -->
		
	</div>	
	<div class="container">
		<div id="slick-<?php echo $uuid; ?>">
			
			<?php
			if ( $opinions->have_posts() ) :
				?>
				
				<?php
				while ( $opinions->have_posts() ) :
					$opinions->the_post();
					?>

						<?php
							$case_opinion_signature = esc_html( get_field( 'opinion_signature' ) );
							$case_opinion_position  = esc_html( get_field( 'opinion_position' ) );
							$case_opinion_company   = esc_html( get_field( 'opinion_company' ) );
							$case_opinion_score     = absint( get_field( 'opinion_score' ) );
							$case_opinion_content   = get_field( 'opinion_content' );
							$exclude_from_slider   = get_field( 'exclude_from_slider' );
						?>
						<?php if ( !$exclude_from_slider ) : ?>
							<div class="hero_opinions_slider_item">
								<?php if ( $case_opinion_signature ) : ?>
									<div class="col-lg-12 opinion-signature">
										<?php echo $case_opinion_signature; ?>
									</div>
								<?php endif; ?>

								<?php if ( $case_opinion_position ) : ?>
									<div class="col-lg-12 opinion-position">
										<?php echo $case_opinion_position; ?>
									</div>
								<?php endif; ?>

								<?php if ( $case_opinion_company ) : ?>
									<div class="col-lg-12 opinion-company">
										<?php echo $case_opinion_company; ?>
									</div>
								<?php endif; ?>

								<div class="stars">
									<?php echo display_rating( $case_opinion_score ); ?>
								</div>

								<?php if ( $case_opinion_content ) : ?>
									<div class="opinion-content">
										<?php echo $case_opinion_content; ?>
									</div>
								<?php endif; ?>
								
								<!-- <a href="<?php // the_permalink( $post->ID ); ?>" title="<?php // the_title(); ?> " class="opinion-link"><?php // esc_html_e( 'Read More...', 'understrap' ); ?></a> -->
								
							</div>
						<?php endif; ?>
					
				<?php endwhile; ?>

			<?php else : ?>
				<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
			<?php endif ?>

		</div>
	</div>

	<?php wp_reset_postdata(); ?>
		
	<div class="row">			
		<?php if ( $button ) : ?>
			<div class="col-lg-12 text-center">
				<?php
					$button_text      = $button['button_text'];
					$button_icon_code = $button['button_icon_code'];
					$button_url       = $button['button_url'];

					include locate_template( 'flexible-templates/button.php', false, false );
				?>
			</div>
		<?php endif; ?>
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
				slidesToShow: 3,
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
