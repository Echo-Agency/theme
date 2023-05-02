<?php
	$width = esc_attr( get_sub_field( 'width' ) );
?>

<div class="flexible-content columns_text_with_icons_echo my-5 <?php echo $width; ?>">

	<?php
	$icons_count = count( get_sub_field( 'icons_echo' ) );

	$icon_alts = array(
		'plus'     => array(
			'icon' => icon_plus(),
		),
		'multiply' => array(
			'icon' => icon_multiply(),
		),
		'power'    => array(
			'icon' => icon_power(),
		),
	);

	if ( $icons_count ) :
		echo '<div class="row">';
		while ( have_rows( 'icons_echo' ) ) :
			the_row();

			$echo_icon       = esc_html( get_sub_field( 'echo_icon' ) );
			$echo_icon_color = esc_html( get_sub_field( 'echo_icon_color' ) );
			$echo_icon_text1 = esc_html( get_sub_field( 'echo_icon_text1' ) );
			$echo_icon_text2 = esc_html( get_sub_field( 'echo_icon_text2' ) );

			?>

			<div class="col-md-12 col-lg-4">
				<div class="columns_text_with_icons_echo-icon">
					<div class="echo-icon-border"></div>
					<div class="echo-icon fill-<?php echo $echo_icon_color; ?>">
						<?php echo $icon_alts[ $echo_icon ]['icon']; ?>
					</div>

					<div class="icon-texts">
						<span class="icon-text1 text-<?php echo $echo_icon_color; ?>">
							<?php echo $echo_icon_text1; ?>
						</span>
						<span class="icon-text2">
							<?php echo $echo_icon_text2; ?>
						</span>
					</div>
				</div>
			</div>

			<?php
		endwhile;
		echo '</div>';
	endif;
	?>
</div>
