<?php
	$vertical_decor          = rest_sanitize_boolean( get_sub_field( 'vertical_decor' ) );
	$aside_decor             = rest_sanitize_boolean( get_sub_field( 'aside_decor' ) );
	$aside_decor_type        = esc_html( get_sub_field( 'aside_decor_type' ) );
	$aside_decor_color       = esc_html( get_sub_field( 'aside_decor_color' ) );
	$section_name            = get_sub_field( 'section_name' );
	$section_name_text_color = esc_html( get_sub_field( 'section_name_text_color' ) );
	$title                   = get_sub_field( 'title' );
	$header                  = get_sub_field( 'header' );
	$header_level            = esc_html( get_sub_field( 'header_level' ) );
	$no_toc                  = rest_sanitize_boolean( get_sub_field( 'no_toc' ) );
	$content                 = wp_kses_post( get_sub_field( 'intro' ) );
	$header_anchor           = wp_kses_post( get_sub_field( 'header_anchor' ) );

	$aside_decor_icons = array(
		'power'    => icon_power(),
		'plus'     => icon_plus(),
		'multiply' => icon_multiply(),
	);
	?>

<div class="flexible-content columns_headers col-lg-12">
	<?php if ( $vertical_decor ) : ?>
		<div class="vertical_decor"></div>
	<?php endif; ?>

	<?php if ( $aside_decor ) : ?>
		<div class="aside_decor <?php echo ( $aside_decor_color ? 'aside_decor_color_' . $aside_decor_color : '' ); ?>">
			<?php echo $aside_decor_icons[ $aside_decor_type ]; ?>
		</div>
	<?php endif; ?>

	<?php if ( $header_anchor ) : ?>
		<?php echo '<a name="' . $header_anchor . '"></a>'; ?> 
	<?php endif; ?>

	<?php if ( $section_name ) : ?>
		<div class="section_name <?php echo 'text-' . $section_name_text_color; ?>"><?php echo $section_name; ?></div>
	<?php endif; ?>

	<?php if ( $header ) : ?>
		<div class="headers-header">
			<?php echo '<h' . $header_level . ' class="' . ( ( $no_toc ) ? ' no-toc' : '' ) . '">' . $header . '</h' . $header_level . '>'; ?>
		</div>
	<?php endif; ?>

	<?php if ( $title ) : ?>
		<div class="headers-title">
			<?php echo $title; ?>
		</div>
	<?php endif; ?>

	<?php if ( $content ) : ?>
		<div class="headers-content">
			<?php echo $content; ?>
		</div>
	<?php endif; ?>
</div>
