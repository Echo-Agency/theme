<?php
	$header         = wp_kses_post( get_sub_field( 'case_header' ) );
	$case_subheader = wp_kses_post( get_sub_field( 'case_subheader' ) );

	$case_percent         = esc_html( get_sub_field( 'case_percent' ) );
	$case_percent_display = rest_sanitize_boolean( get_sub_field( 'case_percent_display' ) );

	$header2         = wp_kses_post( get_sub_field( 'case_header2' ) );
	$case_subheader2 = wp_kses_post( get_sub_field( 'case_subheader2' ) );

	$header3         = wp_kses_post( get_sub_field( 'case_header3' ) );
	$case_subheader3 = wp_kses_post( get_sub_field( 'case_subheader3' ) );
?>

<div class="flexible-content columns_case_main_profit col-lg-12">

	<?php if ( $header || $case_subheader ) : ?>
		<div class="columns_case_main_profit_block_1">
			<?php if ( $header ) : ?>
				<div class="columns_case_main_profit_header1">
					<?php echo $header; ?>
				</div>
			<?php endif; ?>
			<?php if ( $case_subheader ) : ?>
				<div class="columns_case_main_profit_subheader1">
					<?php echo $case_subheader; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $case_percent ) : ?>
		<div class="columns_case_main_profit_number">
			<?php
				$case_image_title = strip_tags( $header ) . ' ' . strip_tags( $case_subheader ) . ' ' . $case_percent . ' ' . strip_tags( $header2 ) . ' ' . strip_tags( $case_subheader2 ) . ' ' . strip_tags( $header3 ) . ' ' . strip_tags( $case_subheader3 );

				echo get_svg_number( $case_percent, $case_image_title );
			?>
			<?php if ( $case_percent_display ) : ?>
				<div class="columns_case_main_profit_percent">
					<?php echo icon_percent(); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $header2 || $case_subheader2 || $header3 || $case_subheader3 ) : ?>
		<div class="columns_case_main_profit_block_2">
			<?php if ( $header2 ) : ?>
				<div class="columns_case_main_profit_header2">
					<?php echo $header2; ?>
				</div>
			<?php endif; ?>

			<?php if ( $header2 ) : ?>
				<div class="columns_case_main_profit_subheader2">
					<?php echo $case_subheader2; ?>
				</div>
			<?php endif; ?>

			<?php if ( $header3 ) : ?>
				<div class="columns_case_main_profit_header3">
					<?php echo $header3; ?>
				</div>
			<?php endif; ?>

			<?php if ( $case_subheader3 ) : ?>
				<div class="columns_case_main_profit_subheader3">
					<?php echo $case_subheader3; ?>
				</div>
			<?php endif; ?>
		
		</div>
	<?php endif; ?>

</div>
