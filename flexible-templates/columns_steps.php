<?php
	$stepper_width   = esc_html( get_sub_field( 'stepper_width' ) );
	$stepper_color   = esc_html( get_sub_field( 'stepper_color' ) );
	$stepper_title   = esc_html( get_sub_field( 'stepper_title' ) );
	$stepper_header  = wp_kses_post( get_sub_field( 'stepper_header' ) );
	$no_toc          = rest_sanitize_boolean( get_sub_field( 'no_toc' ) );
	$stepper_numbers_hidden          = rest_sanitize_boolean( get_sub_field( 'stepper_numbers_hidden' ) );
	$stepper_icons_view          = rest_sanitize_boolean( get_sub_field( 'stepper_icons_view' ) );
	$stepper_content = wp_kses_post( get_sub_field( 'stepper_content' ) );
	$bg_enabled = rest_sanitize_boolean( get_sub_field( 'hero_bg_enabled' ) );
	$title = esc_html( get_sub_field( 'hero_title' ) );
	$button_text      = esc_html( get_sub_field( 'button_text' ) );
	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );
	$button_class       = get_sub_field( 'button_class' );
?>

<div class="flexible-content columns_steps <?php echo ( $stepper_width ) ? $stepper_width : 'col-lg-12'; echo ( $stepper_numbers_hidden ) ? ' stepper_numbers_hidden' : ''; echo ( $stepper_icons_view ) ? ' stepper_icons_view' : '';?>">
	<div class="stepper_container">
		<div class="stepper_header_container col-md-12">

			<span class="stepper_title <?php echo 'text-' . $stepper_color; ?>"><?php echo $stepper_title; ?></span>
			<h2 class="stepper_header<?php echo ( ( $no_toc ) ? ' no-toc' : '' ); ?>"><?php echo $stepper_header; ?></h2>
			<div class="stepper_content"><?php echo $stepper_content; ?></div>

		</div>
		
		<?php

		$stepper_steps = get_sub_field( 'stepper_steps' ) ? count( get_sub_field( 'stepper_steps' ) ) : 0;

		if ( have_rows( 'stepper_steps' ) ) :
			$rowCount = 0;
			echo '<div class="row stepper_steps">';
			while ( have_rows( 'stepper_steps' ) ) :
				$rowCount++;
				the_row();

				$step_icon  = $stepper_icons_view ? get_sub_field( 'step_icon' ) : null;
				$step_title = esc_html( get_sub_field( 'step_title' ) );
				$step_text  = get_sub_field( 'step_text' );

				?>
			
				<div class="stepper_step col-lg-12">
					<?php if ( !$stepper_numbers_hidden ): ?>
					<div class="row">
						<div class="col-lg-12 stepper_step_number_and_decor">
							<div class="stepper_step_number h1 h1-small <?php echo 'text-' . $stepper_color; ?>">
								<div class="stepper_number_decor <?php echo 'background-' . $stepper_color; ?>"></div>
								<?php printf( '%02d', $rowCount ); ?>
							</div>
							<div class="stepper_step_decor"></div>
						</div>
					</div>
					<?php endif; ?>
				
					<?php if ( $step_title && $step_text ) : ?>

						<div class="row">
							<?php if ( $step_icon ): ?>
								<div class="setp_icon col-md-12 col-lg-1">
									<?php echo $step_icon; ?>
								</div>
							<?php endif; ?>

							<div class="stepper_step_title <?php echo $step_icon ? 'col-md-12 col-lg-6' : 'col-md-3 col-lg-5' ;?>">
								<h2 class="stepper_step_title_heading"><?php echo $step_title; ?></h2>
							</div>
						
							<div class="stepper_step_text <?php echo $step_icon ? 'col-md-12 col-lg-5' : 'col-md-9 col-lg-7' ;?>">
								<?php echo $step_text; ?>
							</div>
						</div>

					<?php endif; ?>
						
				</div>

				<?php
			endwhile;
			echo '</div>';
		endif;
		?>
		<?php if ( $button_text && $button_url ) : ?>
			<div class="col-lg-12 text-center">
				<?php
					include locate_template( 'flexible-templates/button.php', false, false );
				?>
			</div>
		<?php endif; ?>
	</div>
</div>

