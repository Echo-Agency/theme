<?php
	$width           = esc_attr( get_sub_field( 'width' ) );
	$form_type       = esc_html( get_sub_field( 'form_type' ) );
	$form_title      = esc_html( get_sub_field( 'form_title' ) );
	$form_id         = get_sub_field( 'form_id' );
	$pipedrive_form  = get_sub_field( 'pipedrive_form' );
	$additional_rodo = get_sub_field( 'additional_rodo' );

?>

<div class="flexible-content columns_forms my-5 <?php echo $width; ?>">
	<div class="forms-wrapper shadow-xl">
		<?php if ( $form_title ) : ?>
			<div class="form-title">
				<?php echo icon_form() . $form_title; ?>
			</div>
		<?php endif; ?>

		<?php if ( 'cf7' == $form_type && $form_id ) : ?>
			<?php
				echo do_shortcode( '[contact-form-7 id="' . $form_id[0] . '" title="' . $form_title . '"]' );
			?>
		<?php endif; ?>

		<?php if ( 'pipedrive' == $form_type && $pipedrive_form ) : ?>
		
			<div class="pipedriveWebForms" data-pd-webforms="<?php echo $pipedrive_form; ?>">
				<script async src="https://webforms.pipedrive.com/f/loader"></script>
			</div>

			<?php if ( $additional_rodo ) : ?>
				<div class="rodo">
					<?php echo $additional_rodo; ?>
			</div>
			<?php endif; ?>

		<?php endif; ?>

		
	</div>
</div>
