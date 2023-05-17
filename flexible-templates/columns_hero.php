<?php
	$full_width  = rest_sanitize_boolean( get_sub_field( 'hero_full_width' ) );
	$bg_enabled  = rest_sanitize_boolean( get_sub_field( 'hero_bg_enabled' ) );
	$bg_color    = sanitize_hex_color( get_sub_field( 'hero_bg_color' ) );
	$title       = esc_html( get_sub_field( 'hero_title' ) );
	$header      = wp_kses_post( get_sub_field( 'hero_header' ) );
	$description = wp_kses_post( get_sub_field( 'hero_description' ) );

	// hero_icons

	$button = get_sub_field( 'hero_button' );

	$style = null;

if ( $bg_enabled && $bg_color ) {
	$style = ' style="background-color:' . $bg_color . '"';
}

?>

<?php if ( $full_width ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	<div class="row p-0">
<?php endif; ?>


<div class="flexible-content columns_hero col-lg-12" <?php echo ( $style ) ?? ''; ?>>
	<div class="hero_content">
		<div class="col-md-12">
			<div class="hero-title"><?php echo $title; ?></div>
			<h2 class="hero-header"><?php echo $header; ?></h2>
			<div class="hero-descriptions"><?php echo $description; ?></div>
		</div>
		
		<?php
		$icons_count = count( get_sub_field( 'hero_icons' ) );

		if ( $icons_count ) :
			echo '<div class="row hero-icons">';
			while ( have_rows( 'hero_icons' ) ) :
				the_row();

				$icon_width         = esc_html( get_sub_field( 'icon_width' ) );
				$icon_position      = esc_attr( get_sub_field( 'icon_position' ) );
				$icon_code          = get_sub_field( 'icon_code' );
				$icon_image         = esc_html( get_sub_field( 'icon_image' ) );
				$icon_title         = esc_html( get_sub_field( 'icon_title' ) );
				$icon_content       = get_sub_field( 'icon_content' );
				$icon_link_url      =  get_sub_field( 'icon_link_url');
				$icon_link_url_text = esc_html( get_sub_field( 'icon_link_url_text' ) );

				?>

				<div class="hero-icon-container <?php echo ( $icon_width ) ? $icon_width : 'col-md-4'; ?>">
					
					<div class="hero-icon">
						<div class="row">
							<div class="col-sm-12<?php echo ( 'left' == $icon_position ) ? ' col-md-3' : ' text-center'; ?>">
							<?php if ( $icon_link_url ) : ?>
								<a title="<?php echo $icon_title; ?>" href="<?php echo $icon_link_url["url"]; ?>">
							<?php endif; ?>
								<?php
								if ( $icon_code ) {
									echo $icon_code;
								} elseif ( $icon_image ) {
									echo $icon_image;
								} else {
									echo icon_plus();
								}
								?>
							<?php if ( $icon_link_url ) : ?>
								</a>
							<?php endif; ?>
							</div>
							<div class="col-sm-12<?php echo ( 'left' == $icon_position ) ? ' col-md-9' : ' text-center'; ?>">
								
								<?php if ( $icon_title ) : ?>
									<p class="hero-icon-title">
										<?php if ( $icon_link_url ) : ?>
											<a title="<?php echo $icon_title; ?>" href="<?php echo $icon_link_url["url"]; ?>">
										<?php endif; ?>

										<?php echo $icon_title; ?>

										<?php if ( $icon_link_url ) : ?>
											</a>
										<?php endif; ?>
										</p>
								<?php endif; ?>

								<?php if ( $icon_content ) : ?>
									<div class="hero-icon-content">
										<?php if ( $icon_link_url ) : ?>
											<a title="<?php echo $icon_title; ?>" href="<?php echo $icon_link_url["url"]; ?>">
										<?php endif; ?>

										<?php echo $icon_content; ?>

										<?php if ( $icon_link_url ) : ?>
											</a>
										<?php endif; ?>
									</div>
								<?php endif; ?>

								<?php if ( $icon_link_url && $icon_link_url_text ) : ?>
									<div class="hero-icon-link">
										<a title="<?php echo $icon_title; ?>" href="<?php echo $icon_link_url["url"]; ?>"><?php echo $icon_link_url_text; ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

				<?php
			endwhile;
			echo '</div>';
		endif;
		?>
		<?php if ( $button ) : ?>
			<div class="col-lg-12 text-center">
				<?php
					$button_text      = $button['button_text'];
					$button_icon_code = $button['button_icon_code'];
					$button_url       = $button['button_url'];

					include locate_template( 'flexible-templates/button.php', false, false );
				?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
