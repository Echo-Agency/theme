<?php
	$width       = esc_attr( get_sub_field( 'width' ) );
	$decor       = rest_sanitize_boolean( get_sub_field( 'text_column_decor' ) );
	$decor_color = esc_html( get_sub_field( 'text_column_decor_color' ) );

	$title        = esc_html( get_sub_field( 'text_column_title' ) );
	$header       = esc_html( get_sub_field( 'text_column_header' ) );
	$header_level = esc_html( get_sub_field( 'text_column_header_level' ) );
	$no_toc       = rest_sanitize_boolean( get_sub_field( 'no_toc' ) );
	$content      = wp_kses_post( get_sub_field( 'text_column_content' ) );

	$button_text = esc_html( get_sub_field( 'text_column_button_text' ) );
?>
<?php if ( $button_text ) : ?>

	<div class="flexible-content columns_text_hidden <?php echo $width; ?>">

		
		<a class="btn btn-primary show_hidden_content" href="#">
			<?php echo $button_text; ?>
		</a>
		

		<div class="<?php echo ( ! is_single() ) ? ' vertical-middle' : ''; ?><?php echo ( $decor && $header ) ? ' with-decor' : ''; ?> columns_text_hidden_wrapper">
			<?php if ( $decor && $header ) : ?>
				<div class="decor background-<?php echo $decor_color; ?>"></div>
			<?php endif; ?>

			<?php
			if ( $title ) :
				echo '<div class="additional-title' . ( ( $decor && $decor_color ) ? ' text-' . $decor_color : '' ) . '">' . $title . '</div>';
				endif;

			if ( $header ) :
				echo '<h' . $header_level . ' class="additional-heading' . ( ( $no_toc ) ? ' no-toc' : '' ) . '">' . $header . '</h' . $header_level . '>';
				endif;

			if ( $content ) {
				echo '<div class="columns_text_content">' . $content . '</div>';
			}
			?>
		</div>
	</div>

	<?php if ( ! isset( $GLOBALS['columns_text_hidden_scripts_loaded'] ) or false === $GLOBALS['columns_text_hidden_scripts_loaded'] ) : ?>
	
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				jQuery('.show_hidden_content').click(function( event ) {
					event.preventDefault();
					jQuery(this).parent().find('.columns_text_hidden_wrapper').fadeIn(300);
				});
			});
		</script>

		<?php $GLOBALS['columns_text_hidden_scripts_loaded'] = true; ?>

	<?php endif; ?>
<?php endif; ?>
