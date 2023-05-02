<?php
	$full_width            = rest_sanitize_boolean( get_sub_field( 'cta_full_width' ) );
	$cta_background        = esc_html( get_sub_field( 'cta_background' ) );
	$content        = wp_kses_post( get_sub_field( 'content' ) );
	$button      = get_sub_field( 'cta_button' );
	$cta_image      = intval( get_sub_field( 'cta_image' ) );
	$cta_image_description        = wp_kses_post( get_sub_field( 'cta_image_description' ) );
	$cta_extra_decors      = rest_sanitize_boolean( get_sub_field( 'cta_extra_decors' ) );
	$cta_extra_decors_type = esc_html( get_sub_field( 'cta_extra_decors_type' ) );
	$content2        = wp_kses_post( get_sub_field( 'content2' ) );
?>

<?php if ( $full_width ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	
	<div class="row p-0">
<?php endif; ?>

<div class="flexible-content columns_cta_image">
	<div class="cta_content container">

		<?php if ( $content || $cta_image ) : ?>
			<div class="row no-gutters">
				<?php if ( $content ) : ?>
					<div class="col-lg-6 columns_cta_image_content background-<?php echo $cta_background; ?>">
						<?php echo $content; ?>

						<?php if ( $button ) : ?>
							<?php
								$button_text      = $button['button_text'];
								$button_icon_code = $button['button_icon_code'];
								$button_url       = $button['button_url'];

								include locate_template( 'flexible-templates/button.php', false, false );
							?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php 
					if ( $cta_image ) : 
						$image_sizes = array(
							'690px' => 'big',
							'540px' => 'medium',
							'300px' => 'thumbnail',
						);
					
						$img_max_width = '690px';
				?>
					<div class="col-lg-6 columns_cta_image_img">
						<?php display_responsive_image( $cta_image, '', $image_sizes, $max_width ); ?>
						<?php if ( $cta_image_description ) : ?>
								<?php echo $cta_image_description; ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $cta_extra_decors || $content2 ) : ?>
			<div class="row columns_cta_image_row_second">
				<?php if ( $cta_extra_decors ) : ?>
					<div class="col-lg-6 decors <?php echo $cta_extra_decors_type; ?>">
						<?php if( 'decor1' == $cta_extra_decors_type ) : ?>
							<div class="decor-plus">
								<?php echo icon_plus(); ?>
							</div>
						<?php endif; ?>
						<?php if( 'decor2' == $cta_extra_decors_type ) : ?>
							<div class="decor-multiply">
								<?php echo icon_multiply(); ?>
							</div>
						<?php endif; ?>
						<?php if( 'decor3' == $cta_extra_decors_type ) : ?>
							<div class="decor-power">
								<?php echo icon_power(); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if ( $content2 ) : ?>
					<div class="col-lg-6 columns_cta_image_content2">
						<?php echo $content2; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

	</div>
</div>

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
