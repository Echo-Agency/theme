<?php if ( is_page() ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
<?php endif; ?>
<?php
	$uuid = uniqid();
?>

<div class="row p-0">
	<div class="flexible-content columns_slider">
		<div id="carouselExampleControls<?php echo $uuid; ?>" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">

				<?php

				$slides_count = count( get_sub_field( 'slide' ) );

				?>
				
				<ol class="carousel-indicators">
					<?php
					for ( $i = 0;$i < $slides_count;$i++ ) {
						echo '<li data-target="#carouselExampleControls' . $uuid . '" data-slide-to="' . $i . '"></li>';
					}
					?>
				</ol>
				<?php

				if ( $slides_count ) :
					while ( have_rows( 'slide' ) ) :
						the_row();

						$img_id   = esc_html( get_sub_field( 'image' ) );
						$title    = esc_html( get_sub_field( 'title' ) );
						$subtitle = esc_html( get_sub_field( 'subtitle' ) );

						$button_text      = esc_html( get_sub_field( 'button_text' ) );
						$button_icon_code = get_sub_field( 'button_icon_code' );
						$button_url       = get_sub_field( 'button_url' );

						$image_sizes = array(
							'1920px' => 'full_hd',
							'1110px' => 'large',
							'690px'  => 'big',
							'540px'  => 'medium',
							'380px'  => 'thumbnail_no_crop',
						);

						?>

						<div class="carousel-item">
							<?php display_responsive_image( $img_id, '', $image_sizes, '1920px' ); ?>

							<div class="carousel-caption">
								<h1 class="slide-title"><?php echo $title; ?></h1>
								<span class="slide-subtitle"><?php echo $subtitle; ?></span>

								<?php include locate_template( 'flexible-templates/button.php', false, false ); ?>
								
							</div>

							<!-- <span class="slide_number"><?php // echo get_row_index(); ?></span> -->
						</div>
						
						<?php
					endwhile;
				endif;
				?>

			</div>
				<?php if ( $slides_count > 1 ) : ?>
					<a class="carousel-control-prev" href="#carouselExampleControls<?php echo $uuid; ?>" role="button" data-slide="prev">

						<span class="carousel-control-prev-icon" aria-hidden="true"></span>

						<span class="sr-only"><?php esc_html_e( 'Previous', 'understrap' ); ?></span>

					</a>

					<a class="carousel-control-next" href="#carouselExampleControls<?php echo $uuid; ?>" role="button" data-slide="next">

						<span class="carousel-control-next-icon" aria-hidden="true"></span>

						<span class="sr-only"><?php esc_html_e( 'Next', 'understrap' ); ?></span>

					</a>
				<?php endif; ?>
		</div><!-- .carousel -->
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		jQuery( '#carouselExampleControls<?php echo $uuid; ?> .carousel-item' ).first().addClass( 'active' );
		jQuery( '#carouselExampleControls<?php echo $uuid; ?> .carousel-indicators li' ).first().addClass( 'active' );

		jQuery('#carouselExampleControls<?php echo $uuid; ?>').carousel({
			interval: 6000
		})

		jQuery('#carouselExampleControls<?php echo $uuid; ?>').on('slide.bs.carousel', function () {
			jQuery('.carousel-item.active').find('img').removeAttr('loading'); 
		})
	});
</script>
<?php if ( is_page() ) : ?>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
