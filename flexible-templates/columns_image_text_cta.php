<?php
	$width       = esc_attr( get_sub_field( 'width' ) );
	$anchor       = esc_html( get_sub_field( 'anchor' ) );
	$image       = intval( get_sub_field( 'image' ) );
	// $header_level       = esc_html( get_sub_field( 'header_level' ) );
	$header             = get_sub_field( 'header' );
	$content            = get_sub_field( 'content' );
	$cta_title            = get_sub_field( 'cta_title' );
	$cta_header            = get_sub_field( 'cta_header' );
	$button_text      = esc_html( get_sub_field( 'button_text' ) );
	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );
?>

<?php echo $anchor ? '<a name="' . $anchor . '"></a>' : ''; ?>
<div class="flexible-content columns_image_text_cta <?php echo $width; ?>">
	<div class="row">

		<?php if( $image ): ?>
			<div class="col-lg-6 columns_image_text_cta_image">
				<?php $image_sizes = array(
					'1110px' => 'full',
					'690px'  => 'big',
					'540px'  => 'medium',
					'300px'  => 'thumbnail',
				);

				display_responsive_image( $image, '', $image_sizes, '1110px', false, false );

				?>
			</div>
		<?php endif; ?>

		<?php if ( $header || $content ) : ?>
			<div class="col-lg-6">
				<?php if ( $header ) {
					// echo '<h' . $header_level . ' class="additional-heading' . '">' . $header . '</h' . $header_level . '>';
					echo '<div class="additional-heading" >' . $header . '</div>';
				}

				if ( $content ) {
					echo  $content;
				} ?>
			</div>
		<?php endif; ?>

	</div>
	<div class="columns_image_text_cta_second_row">
		<div class="row">
			<?php if ( $cta_title || $cta_header ) : ?>
				<div class="col-lg-6 columns_image_text_cta_left">
					<div class="columns_image_text_cta_text">
						<?php if ( $cta_title ) : ?>
							<div class="additional-title">
								<?php echo $cta_title; ?>
							</div>
						<?php endif; ?>
						<?php if ( $cta_header ) : ?>
							<div class="additional-heading">
								<?php echo $cta_header; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( $button_text && $button_url ) : ?>

				<div class="col-lg-6 columns_image_text_cta_right">
					<?php
						$button_class = 'btn-primary btn-big';

						require locate_template( 'flexible-templates/button.php', false, false );
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
