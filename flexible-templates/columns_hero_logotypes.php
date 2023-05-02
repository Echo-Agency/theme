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

<?php if ( ! isset( $GLOBALS['slick_scripts_loaded'] ) or false === $GLOBALS['slick_scripts_loaded'] ) : ?>
	<script defer="defer" src="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick.min.js'; ?>"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick.css'; ?>">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/js/slick/slick-theme.css'; ?>">
	
	<?php $GLOBALS['slick_scripts_loaded'] = true; ?>
	</p>
<?php endif; ?>

<script>
	document.addEventListener('DOMContentLoaded', function() {

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
