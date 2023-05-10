<?php

if ( is_category() || is_tag() ) {
	$category_cta = get_field( 'category_cta', $args );
	// $category_cta['category_cta_full_width']

	$full_width            = rest_sanitize_boolean( $category_cta['category_cta_full_width'] );
	$cta_extra_decors      = rest_sanitize_boolean( $category_cta['category_cta_extra_decors'] );
	$cta_extra_decors_type = esc_html( $category_cta['category_cta_extra_decors_type'] );

	$cta_background = esc_html( $category_cta['category_cta_background'] );

	$cta_title       = $category_cta['category_cta_title'];
	$cta_title_color = esc_html( $category_cta['category_cta_title_color'] );
	// $cta_header_level    = esc_html( $category_cta[ 'cta_header_level'] );
	$cta_header  = $category_cta['category_cta_header'];
	$cta_content = $category_cta['category_cta_content'];

	$button = $category_cta['category_cta_button'];

	$button_second = $category_cta['category_cta_button_second'];

	$cta_content_second = $category_cta['category_cta_content_second'];
} elseif ( is_archive( 'case-study' ) ) { // only for /efekty/case-study/

	$category_cta = $args;

	$full_width            = rest_sanitize_boolean( $category_cta['category_cta_full_width'] );
	$cta_extra_decors      = rest_sanitize_boolean( $category_cta['category_cta_extra_decors'] );
	$cta_extra_decors_type = esc_html( $category_cta['category_cta_extra_decors_type'] );

	$cta_background = esc_html( $category_cta['category_cta_background'] );

	$cta_title        = $category_cta['category_cta_title'];
	$cta_title_color  = esc_html( $category_cta['category_cta_title_color'] );
	// $cta_header_level = esc_html( $category_cta['cta_header_level'] );
	$cta_header       = $category_cta['category_cta_header'];
	$cta_content      = $category_cta['category_cta_content'];

	$button = $category_cta['category_cta_button'];

	$button_second = $category_cta['category_cta_button_second'];

	$cta_content_second = $category_cta['category_cta_content_second'];
} else {
	$full_width            = rest_sanitize_boolean( get_sub_field( 'cta_full_width' ) );
	$cta_extra_decors      = rest_sanitize_boolean( get_sub_field( 'cta_extra_decors' ) );
	$cta_extra_decors_type = esc_html( get_sub_field( 'cta_extra_decors_type' ) );

	$cta_background = esc_html( get_sub_field( 'cta_background' ) );

	$cta_title        = get_sub_field( 'cta_title' );
	$cta_title_color  = esc_html( get_sub_field( 'cta_title_color' ) );
	$cta_header_level = esc_html( get_sub_field( 'cta_header_level' ) );
	$cta_header       = get_sub_field( 'cta_header' );

	$no_toc      = rest_sanitize_boolean( get_sub_field( 'no_toc' ) );
	$cta_content = get_sub_field( 'cta_content' );

	$button = get_sub_field( 'cta_button' );

	$button_second = get_sub_field( 'cta_button_second' );

	$cta_content_second = get_sub_field( 'cta_content_second' );
}

$cta_image      = intval( get_sub_field( 'cta_image' ) );
$cta_image_round      = rest_sanitize_boolean( get_sub_field( 'cta_image_round' ) );

?>

<?php if ( $full_width && !is_single() ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	<div class="row p-0">
<?php endif; ?>

<div class="flexible-content columns_cta mt-5 background-<?php echo $cta_background; echo $cta_extra_decors_type ? ' ' . $cta_extra_decors_type : ''; echo $cta_image ? ' cta-with_image' : ''; ?>">
	<div class="cta_content container">
		<?php if( $cta_image ) : 
			$image_sizes = array(
				'540px' => 'medium',
				'300px' => 'thumbnail',
			);
		
			$img_max_width = '540px';	
		?>
			<div class="row">
				<div class="col-sm-12 cta-image<?php echo $cta_image_round ? ' col-md-2 cta-image__round' : ' col-md-3'; ?>">
					<?php display_responsive_image( $cta_image, '', $image_sizes, $img_max_width ); ?>
				</div>
				<div class="col-sm-12 <?php echo $cta_image_round ? ' col-md-10' : ' col-md-9'; ?>">
					<div class="row">
				
		<?php endif; ?>
						<div class="col-lg-12<?php echo ( 'decor5' != $cta_extra_decors_type && !$cta_image ) ? ' text-center' : ''; ?>">
						<?php if ( $cta_title ) : ?>
							<div class="cta-title text-<?php echo $cta_title_color; ?>">
								<?php echo $cta_title; ?>
							</div>
						<?php endif; ?>

						<?php if ( $cta_header ) : ?>
							<div class="cta-header">
								<?php echo '<h' . ( !empty( $cta_header_level ) ? $cta_header_level : '2' ) . ' class="no-toc">' . $cta_header . '</h' . ( ( $cta_header_level ) ? $cta_header_level : '2' ) . '>'; ?>
							</div>
						<?php endif; ?>

						<?php if ( $cta_content ) : ?>
							<div class="cta-content">
								<?php echo $cta_content; ?>
							</div>
						<?php endif; ?>

						<?php if ( $button ) : ?>
							<div class="<?php echo ( 'decor5' != $cta_extra_decors_type && !$cta_image ) ? 'text-center' : ''; ?>">
								<?php
									$button_text      = $button['button_text'];
									$button_icon_code = $button['button_icon_code'];
									$button_url       = $button['button_url'];

									include locate_template( 'flexible-templates/button.php', false, false );
								?>
							</div>
						<?php endif; ?>

						<?php if ( $cta_content_second ) : ?>
							<div class="cta-content-second">
								<?php echo $cta_content_second; ?>
							</div>
						<?php endif; ?>

						<?php if ( $button_second ) : ?>
							<div class="<?php echo ( 'decor5' != $cta_extra_decors_type && !$cta_image ) ? 'text-center' : ''; ?>">
								<?php
								$button_text      = $button_second['button_text'];
								$button_icon_code = $button_second['button_icon_code'];
								$button_url       = $button_second['button_url'];
								$button_class     = 'btn-bordered';

								include locate_template( 'flexible-templates/button.php', false, false );
								?>
							</div>
						<?php endif; ?>
						</div>

						<?php if ( $cta_extra_decors ) : ?>
							<div class="decors <?php echo $cta_extra_decors_type; ?>">
								<div class="decor-plus">
									<?php echo icon_plus(); ?>
								</div>
								<div class="decor-multiply">
									<?php echo icon_multiply(); ?>
								</div>
								<div class="decor-power">
									<?php echo icon_power(); ?>
								</div>

								<?php if ( 'decor4' == $cta_extra_decors_type ): ?>
									<div class="decor-power-second">
										<?php echo icon_power(); ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
		<?php if( $cta_image ) : ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php if ( $full_width && !is_single() ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
