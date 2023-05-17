<?php

	$full_width  = esc_html( get_sub_field( 'text_column_with_icons_full_width' ) );
	$bg_color    = sanitize_hex_color( get_sub_field( 'text_column_with_icons_bg_color' ) );
	$width       = esc_attr( get_sub_field( 'width' ) );
	$title       = esc_html( get_sub_field( 'text_column_with_icons_title' ) );
	$header      = get_sub_field( 'text_column_with_icons_header' );
	$content     = get_sub_field( 'text_column_with_icons_content' );
	$button_text = esc_html( get_sub_field( 'button_text' ) );

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

<div class="flexible-content columns_text_with_opinions <?php echo $width; ?>">
	<?php

	if ( $title ) :
		echo '<p class="additional-title">' . $title . '</p>';
	endif;

	if ( $header ) :
		echo '<div class="additional-heading">' . $header . '</div>';
	endif;

	if ( $content ) :
		echo $content;
	endif;
	
	$icons_count = count( get_sub_field( 'icon_with_text' ) );

	if ( $icons_count ) :
		echo '<div class="row p-0 tt">';
		while ( have_rows( 'icon_with_text' ) ) :
			the_row();

			$icon_image         = get_sub_field( 'icon_icon_image' );
			$icon_title         = esc_html( get_sub_field( 'icon_title' ) );
			$icon_content       = get_sub_field( 'icon_content' );
			$icon_link_url      = get_sub_field( 'icon_link_url' );
			$icon_link_url_text = esc_html( get_sub_field( 'icon_link_url_text' ) );
			$opinion            = get_sub_field( 'opinion' );
			$baner_desktop        = get_sub_field( 'baner_desktop' );
			$baner_mobile        = get_sub_field( 'baner_mobile' );
			$baner_url        = esc_html( get_sub_field( 'baner_url' ) );

			?>

			<div class="columns_text_with_opinions-icon <?php echo ( $opinion || $baner_desktop || $baner_mobile ) ? 'col-lg-12' : 'col-lg-6'; ?> ">

				<div class="columns_text_with_opinions-icon-border">
					<div class="row mt-3">
						<?php if ( $opinion ) : ?>
							<div class="col-lg-6">
								<div class="row">
						<?php endif; ?>
									<div class="col-md-12 columns_text_with_icon_img col-lg-4">
										<?php
										if ( $icon_image ) {
											display_responsive_image( $icon_image['ID'], '',max_width: '380px' );
										} else {
											echo icon_plus();
										}
										?>
									</div>
									<div class="col-md-12 col-lg-8">
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
												<a class="btn btn-primary" title="<?php echo $icon_title; ?>" href="<?php echo $icon_link_url['url']; ?>"><?php echo $icon_link_url_text; ?></a>
											</div>
										<?php endif; ?>
									</div>
							<?php if ( $opinion ) : ?>
								</div>
							</div>
							<div class="col-lg-6 opinion">
								<?php
									$opinion_score     = esc_html( get_field( 'opinion_score', $opinion ) );
									$opinion_content   = wp_kses_post( get_field( 'opinion_content', $opinion ) );
									$opinion_position  = esc_html( get_field( 'opinion_position', $opinion ) );
									$opinion_signature = esc_html( get_field( 'opinion_signature', $opinion ) );

								if ( $opinion_content ) :
									?>
									<div class="row">
									<?php if ( $opinion_score ) : ?>
											<div class="col-lg-12 stars">
												<?php echo display_rating( $opinion_score ); ?>
											</div>
										<?php endif; ?>
										<div class="col-lg-12 opinion-content">
										<?php echo $opinion_content; ?>
										</div>
									<?php if ( $opinion_signature ) : ?>
											<div class="col-lg-12 opinion-signature">
												<?php echo $opinion_signature; ?>
											</div>
										<?php endif; ?>
									<?php if ( $opinion_position ) : ?>
											<div class="col-lg-12 opinion-position">
												<?php echo $opinion_position; ?>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( $baner_desktop || $baner_mobile ) : ?>
				
				<div class="col-lg-12 opinion-banner my-30">
					<?php if ( $baner_url ) : ?>
						<a href="<?php echo $baner_url; ?>" title="<?php echo get_the_title($baner_desktop); ?>" target="_blank">
					<?php endif; ?>
						<?php if ( $baner_desktop ) : ?>
							<div class="opinion-banner-desktop">
								<?php echo wp_get_attachment_image( $baner_desktop, 'full' ); ?>
							</div>
						<?php endif; ?>
						<?php if ( $baner_mobile ) : ?>
							<div class="opinion-banner-mobile">
								<?php echo wp_get_attachment_image( $baner_mobile, 'full' ); ?>
							</div>
						<?php endif; ?>
					<?php if ( $baner_url ) : ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php
		endwhile;
		echo '</div>';
	endif;

	if ( 'col-lg-12' == $width ) {
		echo '<div class="text-center">';
	}

	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );
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
