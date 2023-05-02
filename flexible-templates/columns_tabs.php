<?php
	$width   = esc_attr( get_sub_field( 'width' ) );
	$title   = esc_html( get_sub_field( 'tab_column_title' ) );
	$header  = esc_html( get_sub_field( 'tab_column_header' ) );
	$content = wp_kses_post( get_sub_field( 'tab_column_content' ) );

	$button_text      = esc_html( get_sub_field( 'button_text' ) );
	$button_icon_code = get_sub_field( 'button_icon_code' );
	$button_url       = get_sub_field( 'button_url' );

	$tab_menu_position = esc_attr( get_sub_field( 'tab_menu_position' ) );
?>

<div class="flexible-content columns_tabs p-0 <?php echo $width; ?>">
	<div class="row">

		<div class="<?php echo ( ( 'left' == $tab_menu_position ) ? 'col-lg-3' : 'col-lg-12' ); ?>">
			<div class="row">
				<?php if ( $title ) : ?>
					<div class="col-lg-12 additional-title"><?php echo $title; ?></div>
				<?php endif; ?>

				<?php if ( $header ) : ?>
					<div class="col-lg-12 "><h2 class="additional-heading"><?php echo $header; ?></h2></div>
				<?php endif; ?>
			</div>
		</div>

		<div class="<?php echo ( ( 'left' == $tab_menu_position ) ? 'col-lg-9' : 'col-lg-12' ); ?>">
			<div class="row">
				<?php if ( $content ) : ?>
					<div class="col-lg-12 additional-content"><?php echo $content; ?></div>
				<?php endif; ?>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<?php require locate_template( 'flexible-templates/button.php', false, false ); ?>
			</div>
		</div>

	</div>
	<?php

	$tabs_count = count( get_sub_field( 'tabs' ) );

	if ( $tabs_count ) :
		$uuid = uniqid();

		echo '<div class="row tabs">';
		echo '<div class="' . ( ( 'left' == $tab_menu_position ) ? 'col-lg-4' : 'col-lg-12' ) . '">';
		echo '<ul class="nav ' . ( ( 'left' == $tab_menu_position ) ? 'nav-pills flex-column' : 'nav-tabs nav-justified' ) . '" id="myTab-' . $uuid . '" role="tablist">';

		if ( have_rows( 'tabs' ) ) :
			$rowCount = 0;
			while ( have_rows( 'tabs' ) ) :
				$rowCount++;
				the_row();

				$tab_title = esc_attr( get_sub_field( 'tab_title' ) );

				?>
					
				<li class="nav-item" role="presentation">
					<a class="nav-link<?php echo ( 1 == get_row_index() ) ? ' active' : ''; ?>" id="tab<?php echo get_row_index(); ?>" data-toggle="tab" href="#tab<?php echo $uuid . '-' . get_row_index(); ?>" role="tab" aria-controls="home" aria-selected="true"> <h4 class="tab-title"><?php echo $tab_title; ?></h4> </a>
				</li>

				<?php
			endwhile;

			echo '</ul>';
			echo '</div>';

			// tabs content
			echo '<div class="' . ( ( 'left' == $tab_menu_position ) ? 'col-lg-8 ' : 'col-lg-12 ' ) . 'tab-content" id="myTabContent-' . $uuid . '">';

			while ( have_rows( 'tabs' ) ) :
				the_row();

				$tab_content  = get_sub_field( 'tab_content' );
				$tab_image_id = esc_html( get_sub_field( 'tab_image' ) );

				?>

				<div class="tab-pane fade<?php echo ( 1 == get_row_index() ) ? ' active show' : ''; ?>" id="tab<?php echo $uuid . '-' . get_row_index(); ?>" role="tabpanel" aria-labelledby="home-tab">

					<?php

					if ( $tab_content ) {
						echo '<div class="tab_content">' . $tab_content . '</div>';
					}

					if ( $tab_image_id ) {
						$image_sizes = array(
							// '690px' => 'big',
							'540px' => 'medium',
							'300px' => 'thumbnail',
						);

						display_responsive_image( $tab_image_id, '', $image_sizes, '540px' );
					}

					?>

				</div>

				<?php
			endwhile;
		endif;

		echo '</div>';
		echo '</div>';
	endif;
	?>
</div>
