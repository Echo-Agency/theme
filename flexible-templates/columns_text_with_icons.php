<?php

	$full_width       = esc_html( get_sub_field( 'text_column_with_icons_full_width' ) );
	$bg_color         = sanitize_hex_color( get_sub_field( 'text_column_with_icons_bg_color' ) );
	$width            = esc_attr( get_sub_field( 'width' ) );
	$title            = esc_html( get_sub_field( 'text_column_with_icons_title' ) );
	$header           = get_sub_field( 'text_column_with_icons_header' );
	$content          = get_sub_field( 'text_column_with_icons_content' );
	$button_text      = esc_html( get_sub_field( 'button_text' ) );

	$style = null;

if ( $bg_color ) {
	$style = ' style="background-color:' . $bg_color . '"';
}
?>

<?php if ( $full_width ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	<div class="row p-0 mt-30"<?php echo $style ? $style : ''; ?>>
	<div class="container">
<?php endif; ?>

<div class="flexible-content columns_text_with_icons <?php echo $width; ?>">

	<?php

	if ( $title ) :
		echo '<p class="additional-title">' . $title . '</p>';
	endif;

	if ( $header ) :
		echo '<h2 class="additional-heading">' . $header . '</h2>';
	endif;

	echo $content;

	$icons_count = count( get_sub_field( 'icon_with_text' ) );

	if ( $icons_count ) :
		echo '<div class="row p-0">';
		while ( have_rows( 'icon_with_text' ) ) :
			the_row();

			$icon_width                  = esc_html( get_sub_field( 'icon_width' ) );
			$hide_borders                  = rest_sanitize_boolean( get_sub_field( 'hide_borders' ) );
			$icon_position               = esc_attr( get_sub_field( 'icon_position' ) );
			$icon_left_position_vertical = esc_attr( get_sub_field( 'icon_left_position_vertical' ) );
			$icon_code                   = get_sub_field( 'icon_icon_code' );
			$icon_image                  = get_sub_field( 'icon_icon_image' );
			$icon_title                  = esc_html( get_sub_field( 'icon_title' ) );
			$icon_content                = get_sub_field( 'icon_content' );
			$icon_link_url                = get_sub_field( 'icon_link_url' );
			$icon_link_url_text                 = esc_html( get_sub_field( 'icon_link_url_text' ) );
			$decor_icon                  = get_sub_field( 'decor_icon' );
			?>

			<div class="columns_text_with_icons-icon <?php echo ( $icon_width ) ? $icon_width : 'col-md-6'; ?> ">
			<?php if ( $icon_link_url["url"] ) : ?>
				<a title="<?php echo $icon_title; ?>" href="<?php echo $icon_link_url["url"]; ?>">
			<?php endif; ?>
				<div class="<?php echo $hide_borders ? '' : 'columns_text_with_icons-icon-border'; ?>">
					<div class="row mt-3">
						<div class="col-sm-12 columns_text_with_icon_img <?php echo ( 'left' == $icon_position && !$icon_image ) ? ' col-md-2 icon-size-small' : ' text-center icon-size-large'; echo ( 'left' == $icon_position && $icon_image ) ? ' col-md-3 icon-size-small' : ''; echo ( 'left' == $icon_position && 'top' == $icon_left_position_vertical ) ? ' icon-vertical-top' : ' icon-vertical-center'; echo $icon_image ? ' icon-image' : '';?>">
							<?php
							if ( $icon_code ) {
								echo $icon_code;
							} elseif ( $icon_image ) {
								echo wp_get_attachment_image( $icon_image['ID'], 'thumbnail_no_crop' );
							} else {
								//echo icon_plus();
							}

							?>
						</div>
						<div class="col-sm-12 <?php echo ( 'left' == $icon_position && !$icon_image ) ? ' col-md-10 columns_text_with_icon_border' : ' text-center'; echo ( 'left' == $icon_position && $icon_image ) ? ' col-md-9 columns_text_with_icon_border' : ' text-center'; ?>">
							<?php if ( $icon_title ) : ?>
								<div class="icon-title">
									<?php echo $icon_title; ?>
								</div>
							<?php endif; ?>

							<?php if ( $icon_content ) : ?>
								<div class="icon-content">
									<?php echo $icon_content; ?>
								</div>
							<?php endif; ?>

							<?php if ( $icon_link_url && $icon_link_url_text ) : ?>
								<div class="hero-icon-link">
									<?php echo $icon_link_url_text; ?>
								</div>
							<?php endif; ?>

							<?php if ( $decor_icon ) : ?>
								<div class="decor_icon">
									<?php echo $decor_icon; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php if ( $icon_link_url ) : ?>
					</a>
				<?php endif; ?>
			</div>

			<?php
		endwhile;
		echo '</div>';
	endif;

	if ( 'col-lg-12' == $width ) {
		echo '<div class="text-center">';
	}

	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );
	$button_class       = get_sub_field( 'button_class' );
	require locate_template( 'flexible-templates/button.php', false, false );

	if ( 'col-lg-12' == $width ) {
		echo '</div>';
	}
	?>

</div>

<?php if ( $full_width ) : ?>
	</div>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
