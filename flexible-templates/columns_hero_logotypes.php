<?php
	$full_width      = rest_sanitize_boolean( get_sub_field( 'hero_full_width' ) );
	$bg_image        = esc_url( get_sub_field( 'hero_background_image' ) );
	$bg_image_darken = rest_sanitize_boolean( get_sub_field( 'hero_background_image_darken' ) );

	$header = esc_html( get_sub_field( 'hero_opinion_header' ) );

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
	<div class="container-fluid p-0">
<?php endif; ?>


<div class="flexible-content columns_hero_logotypes"<?php echo ( $style ) ?? ''; ?>>
	<?php
	if ( $bg_image && $bg_image_darken ) {
		echo '<div class="bg_image_darken"></div>';
	}
	?>

	<?php if ( $button ) : ?>
		<div class="col-md-12 text-center">
			<?php
				$button_text      = $button['button_text'];
				$button_icon_code = $button['button_icon_code'];
				$button_url       = $button['button_url'];

				include locate_template( 'flexible-templates/button.php', false, false );
			?>
		</div>
	<?php endif; ?>

	<div class="hero_logotypes_content">
		<div class="col-sm-12 logotypes-header">
			<?php echo $header; ?>
		</div>
		
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

<script>
	document.addEventListener('DOMContentLoaded', function() {
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

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
