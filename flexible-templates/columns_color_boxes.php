<?php
	$width       = esc_attr( get_sub_field( 'width' ) );
	$header      = esc_html( get_sub_field( 'color_box_header' ) );
	$color_boxes = get_sub_field( 'color_boxes' );
?>

<div class="flexible-content columns_color_boxes <?php echo $width; ?>">
	
	<?php if ( $header ) : ?>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="columns_color_boxes_header"><?php echo $header; ?></h2>
			</div>
		</div>
	<?php endif; ?>

	<?php

	if ( have_rows( 'color_boxes' ) ) :

		echo '<div class="row color_boxes_container">';
		while ( have_rows( 'color_boxes' ) ) :
			the_row();

			$box_width             = esc_html( get_sub_field( 'width' ) );
			$box_bg_color          = sanitize_hex_color( get_sub_field( 'bg_color' ) );
			$box_bg_image          = esc_url( get_sub_field( 'bg_image' ) );
			$box_bg_image_position = esc_html( get_sub_field( 'bg_image_position' ) );
			$box_header            = esc_html( get_sub_field( 'header' ) );
			$box_content           = wp_kses_post( get_sub_field( 'content' ) );

			$style = null;

			if ( $box_bg_color || $box_bg_image ) {
				$style  = ' style="background:';
				$style .= $box_bg_color ? ' ' . $box_bg_color : '';
				$style .= $box_bg_image ? ' url(\'' . $box_bg_image . '\')' : '';
				$style .= ';';
				$style .= ( $box_bg_image && $box_bg_image_position ) ? 'background-position: ' . $box_bg_image_position . ';background-repeat: no-repeat;' : '';
				$style .= '"';
			}

			?>
		
			<div class="color_box <?php echo $box_width ? $box_width : 'col-lg-12'; ?>">
				<div class="color_box_inner"<?php echo $style ? $style : ''; ?>>
				<?php if ( $box_header || $box_content ) : ?>
					<div class="row color_box_content">
						<?php if ( $box_header ) : ?>
							<div class="col-lg-12">
								<h2 class="color_box_content_header"><?php echo $box_header; ?></h2>
							</div>
						<?php endif; ?>
						<?php if ( $box_content ) : ?>
							<div class="col-lg-12">
								<?php echo $box_content; ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				</div>
			</div>

			<?php
		endwhile;
		echo '</div>';
	endif;
	?>

</div>
