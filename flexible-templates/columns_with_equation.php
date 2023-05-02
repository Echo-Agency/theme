<?php
	$width = esc_attr( get_sub_field( 'width' ) );
	$title = esc_html( get_sub_field( 'title' ) );

?>

<div class="flexible-content columns_with_equation my-5 <?php echo $width; ?>">

	<?php if ( $title ) : ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="columns_with_equation_title">
					<?php echo $title; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php
	$icons_count = count( get_sub_field( 'icons_with_text' ) );

	$icon_images = array(
		'plus'     => array(
			'icon' => icon_plus(),
		),
		'multiply' => array(
			'icon' => icon_multiply(),
		),
		'power'    => array(
			'icon' => icon_power(),
		),
		'equal'    => array(
			'icon' => icon_equal(),
		),
	);

	if ( $icons_count ) :
		echo '<div class="row columns_with_equation_icons">';
		while ( have_rows( 'icons_with_text' ) ) :
			the_row();

			$echo_icon_text  = esc_html( get_sub_field( 'echo_icon_text' ) );
			$echo_icon       = esc_html( get_sub_field( 'echo_icon' ) );
			$echo_icon_color = esc_html( get_sub_field( 'echo_icon_color' ) );

			?>

			<?php if ( $echo_icon_text ) : ?>
				<div class="icon_text">
					<?php echo $echo_icon_text; ?>
				</div>
			<?php endif; ?>

			<?php if ( $echo_icon && $echo_icon_color ) : ?>
				<div class="echo_icon fill-<?php echo $echo_icon_color; ?>">
					<?php echo $icon_images[ $echo_icon ]['icon']; ?>
				</div>
			<?php endif; ?>

			<?php
		endwhile;
		echo '</div>';
	endif;
	?>

</div>
