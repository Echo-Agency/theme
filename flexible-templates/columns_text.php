<?php
	$width       = esc_attr( get_sub_field( 'width' ) );
	$decor       = rest_sanitize_boolean( get_sub_field( 'text_column_decor' ) );
	$text_column_vertical_center_disabled       = rest_sanitize_boolean( get_sub_field( 'text_column_vertical_center_disabled' ) );
	$decor_color = esc_html( get_sub_field( 'text_column_decor_color' ) );
	$title              = esc_html( get_sub_field( 'text_column_title' ) );
	$text_column_number = esc_html( get_sub_field( 'text_column_number' ) );
	$header             = get_sub_field( 'text_column_header' );
	$header_level       = esc_html( get_sub_field( 'text_column_header_level' ) );
	$no_toc             = rest_sanitize_boolean( get_sub_field( 'no_toc' ) );
	$content            = get_sub_field( 'text_column_content' );
	$button_text      = esc_html( get_sub_field( 'button_text' ) );
	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );
	$button_class       = get_sub_field( 'button_class' );
	$button_centered             = rest_sanitize_boolean( get_sub_field( 'button_centered' ) );
?>

<div class="flexible-content columns_text mobile-1 <?php echo $width; ?>">
	<div class="<?php echo ( ! is_single() && ! $text_column_vertical_center_disabled ) ? ' vertical-middle' : ''; echo ( $decor && $header ) ? ' with-decor' : ''; echo $text_column_vertical_center_disabled ? ' smaller-top-margin' : ''; ?>">
		<?php if ( $decor && $header ) : ?>
			<div class="decor background-<?php echo $decor_color; ?>"></div>
		<?php endif; ?>

		<?php
		if ( $title ) :
			echo '<div class="additional-title' . ( ( $decor && $decor_color ) ? ' text-' . $decor_color : '' ) . '">' . $title . '</div>';
		endif;

		if ( $text_column_number ) :
			?>
			<div class="column-number">
				<div class="column-number-content">
					<?php echo $text_column_number; ?>
				</div>
			</div>
			<?php
		endif;

		if ( $header ){
			if(is_single()){
				echo '<h' . $header_level . ' class="additional-heading' . ( ( $no_toc ) ? ' no-toc' : '' ) . '">' . $header . '</h' . $header_level . '>';
			}
			else echo '<div class="additional-heading' . ( ( $no_toc ) ? ' no-toc' : '' ) . '">' . $header . '</div>';
		}

		if ( $content ) {
			echo '<div class="columns_text_content">' . $content . '</div>';
		}

			if ( $button_text && $button_url && $button_centered) {
				echo '<div class="text-center">';
			}

			require locate_template( 'flexible-templates/button.php', false, false );

			if ( $button_text && $button_url && $button_centered) {
				echo '</div>';
			}
		?>
	</div>
</div>
