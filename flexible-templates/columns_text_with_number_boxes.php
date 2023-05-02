<?php
	$width   = esc_attr( get_sub_field( 'width' ) );
	$heading = esc_html( get_sub_field( 'heading' ) );
?>

<div class="flexible-content columns_text_with_number_boxes <?php echo $width; ?>">

	<?php if ( $heading ) : ?>
		<div class="row">
			<div class="col-lg-12">
				<p class="h4 columns_text_with_number_boxes_heading"><?php echo $heading; ?></p>
			</div>
		</div>
	<?php endif; ?>

	<?php

	$boxes_count = count( get_sub_field( 'number_boxes' ) );

	if ( have_rows( 'number_boxes' ) ) :
		$rowCount = 0;
		echo '<div class="row">';
		while ( have_rows( 'number_boxes' ) ) :
			$rowCount++;
			the_row();

			$box_width   = get_sub_field( 'number_box_width' );
			$box_content = get_sub_field( 'number_box_content' );


			if ( 'col-lg-4' == $box_width && 0 == $rowCount % 4 ) {
				echo '</div>';
				echo '<div class="row">';
			} elseif ( 'col-lg-3' == $box_width && 0 == $rowCount % 5 ) {
				echo '</div>';
				echo '<div class="row">';
			} elseif ( 'col-lg-6' == $box_width && 0 == $rowCount % 3 ) {
				echo '</div>';
				echo '<div class="row">';
			}
			?>

		<div class="col-sm-12 <?php echo ( $box_width ) ? $box_width : 'col-lg-4'; ?>">
			<div class="columns_text_with_number_boxes-box">
				<div class="box-number">
				<?php
					printf( '%02d', $rowCount );
				?>
				</div>
				<div class="box-content">
				<?php
					echo $box_content;
				?>
				</div>
				<div class="box-border"><div></div></div>
			</div>
		</div>

			<?php

	endwhile;
		echo '</div>';
	endif;
	?>
</div>
