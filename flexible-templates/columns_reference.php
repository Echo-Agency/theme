<?php
	$width                            = esc_attr( get_sub_field( 'width' ) );
	$reference_column_content         = wp_kses_post( get_sub_field( 'reference_column_content' ) );
	$reference_column_quotation       = wp_kses_post( get_sub_field( 'reference_column_quotation' ) );
	$reference_column_person_image    = get_sub_field( 'reference_column_person_image' );
	$reference_column_person_name     = esc_html( get_sub_field( 'reference_column_person_name' ) );
	$reference_column_person_position = esc_html( get_sub_field( 'reference_column_person_position' ) );
	$reference_column_logotype        = esc_html( get_sub_field( 'reference_column_logotype' ) );

	// var_dump($reference_column_person_image);

	$image_sizes = array(
		'100px' => 'person_thumb',
	);
	?>

<div class="flexible-content columns_reference <?php echo $width; ?>">

	<?php if ( $reference_column_content ) : ?>
		<div class="row">
			<div class="col-lg-12 columns_reference_content">
				<?php echo $reference_column_content; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $reference_column_quotation ) : ?>
		<div class="row">
			<div class="col-lg-12 columns_reference_quotation">
				<span class="columns_reference_quotation_decor"></span>
				<div class="columns_reference_quotation_text">
					<?php echo $reference_column_quotation; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="columns_reference_decor"><span></span></div>

	<?php if ( $reference_column_person_name ) : ?>
		<div class="row">
			<div class="col-lg-12 columns_reference_person">
				<?php if ( $reference_column_person_image ) : ?>
					<div class="columns_reference_person_image">
						<?php
							display_responsive_image( $reference_column_person_image, $reference_column_person_name, $image_sizes, '100px' );
						?>
					</div>
				<?php endif; ?>
				<div class="columns_reference_person_name_and_position">
					<div class="row">
						<div class="col-lg-12 columns_reference_person_name">
							<?php echo $reference_column_person_name; ?>
						</div>
						<?php if ( $reference_column_person_position ) : ?>
							<div class="col-lg-12">
								<?php echo $reference_column_person_position; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			
				<?php if ( $reference_column_logotype ) : ?>
					<div class="columns_reference_logotype">
						<?php echo display_responsive_image( $reference_column_logotype, '', $image_sizes, '140px', true ); ?>			
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

</div>
