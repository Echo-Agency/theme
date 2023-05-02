<?php
	$width   = esc_attr( get_sub_field( 'width' ) );
	$content = wp_kses_post( get_sub_field( 'column_accordion_content' ) );
?>
<div class="flexible-content columns_with_accordion <?php echo $width; ?>">
	<div class="row">
		<?php if ( $content ) : ?>
		<div class="col-lg-12">
			<?php echo $content; ?>
		</div>
		<?php endif; ?>

		<?php
		if ( have_rows( 'column_accordion' ) ) :
			$uuid = uniqid();

			echo '<div class="col-lg-12">';
			echo '<div class="accordion" id="accordion' . $uuid . '">';

			while ( have_rows( 'column_accordion' ) ) :
				the_row();

				if ( have_rows( 'accordion_elements' ) ) :
					$rowCount = 0;
					while ( have_rows( 'accordion_elements' ) ) :
						$rowCount++;
						the_row();

						$accordion_icon_code = get_sub_field( 'icon_code' );
						$accordion_image     = esc_html( get_sub_field( 'icon_image' ) );
						$accordion_title     = esc_html( get_sub_field( 'accordion_title' ) );
						$accordion_content   = get_sub_field( 'accordion_content' );
						?>

							<div class="card">
								<span class="card-header" id="heading<?php echo $uuid . '-' . get_row_index(); ?>">

								<?php
								if ( $accordion_icon_code ) {
									echo $accordion_icon_code;
								} elseif ( $accordion_image ) {
									echo $accordion_image;
								} else {
									echo icon_chat();
								}

								?>

									<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $uuid . '-' . get_row_index(); ?>" <?php echo ( 1 == get_row_index() ) ? 'aria-expanded="true"' : ''; ?>  aria-controls="collapse<?php echo $uuid . '-' . get_row_index(); ?>">
									<?php
										echo $rowCount . '. ' . $accordion_title;
									?>
									</button>
								</span>
								<div id="collapse<?php echo $uuid . '-' . get_row_index(); ?>" class="collapse<?php echo ( 1 == get_row_index() ) ? ' show"' : ''; ?>" aria-labelledby="heading<?php echo $uuid . '-' . get_row_index(); ?>" data-parent="#accordion<?php echo $uuid; ?>">
									  <div class="card-body">
										<?php echo $accordion_content; ?>
									</div>
								</div>
							</div>

							<?php
					endwhile;
				endif;
			endwhile;

			echo '</div>';
			echo '</div>';
		endif;
		?>
	</div>
</div>

<script type='application/ld+json'> 
{
	  "@context": "https://schema.org",
	  "@type": "FAQPage",
	  "mainEntity":[

		<?php
		while ( have_rows( 'column_accordion' ) ) :
			the_row();

			$total_rows = count( get_sub_field( 'accordion_elements' ) );

			if ( have_rows( 'accordion_elements' ) ) :
				$rowCount = 0;
				while ( have_rows( 'accordion_elements' ) ) :
					$rowCount++;
					the_row();

					$accordion_title   = esc_html( get_sub_field( 'accordion_title' ) );
					$accordion_content = get_sub_field( 'accordion_content' );

					?>

					<?php if ( $total_rows !== $rowCount ) : ?>

						{
						"@type": "Question",
						"name": "<?php echo $accordion_title; ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?php echo $accordion_content; ?>"
							}
						}, 

						<?php else : ?>
{
						"@type": "Question",
						"name": "<?php echo $accordion_title; ?>",
						"acceptedAnswer": {
							"@type": "Answer",
							"text": "<?php echo $accordion_content; ?>"
							}
						}

						<?php endif; ?>

						<?php
					endwhile;
				endif;
			endwhile;

		?>
		]
	}
</script>
