<?php
	$width        = esc_attr( get_sub_field( 'width' ) );
	$header        = wp_kses_post( get_sub_field( 'header' ) );
	$description        = wp_kses_post( get_sub_field( 'description' ) );
	$industries = get_sub_field( 'industries' );
	$video_iframe = get_sub_field( 'video_iframe' );
	$video_title  = wp_kses_post( get_sub_field( 'video_title' ) );
	$header2        = wp_kses_post( get_sub_field( 'header2' ) );
	$content        = wp_kses_post( get_sub_field( 'content' ) );
?>

<div class="flexible-content columns_industries <?php echo $width; ?>">

	<?php if ( $header || $description ) : ?>
		<div class="row">
			<?php if ( $header ) : ?>
				<div class="col-lg-12">
					<h2 class="additional-heading"><?php echo $header; ?></h2>
				</div>
			<?php endif; ?>
			<?php if ( $description ) : ?>
				<div class="col-lg-12">
					<?php echo $description; ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if ( $industries || $video_iframe ) : ?>
		<?php if ( $video_iframe ) : ?>
			<div class="row">
				<?php if ( false == strpos( $video_iframe, 'loading="lazy"' ) ) {
					$video_iframe = str_replace( 'iframe', 'iframe loading="lazy"', $video_iframe );
				}
				?>

				<?php if ( $video_iframe ) : ?>
					<div class="col-lg-12 column_video">
						<?php echo $video_iframe; ?>
					</div>
				<?php endif; ?>
				<?php if ( $video_title ) : ?>
					<div class="row">
						<div class="col-lg-12 video_title">
							<?php echo $video_title; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $header2 || $content ) : ?>
			<div class="row">
				<?php if ( $header2 ) : ?>
					<div class="col-lg-12">
						<h2 class="additional-heading"><?php echo $header2; ?></h2>
					</div>
				<?php endif; ?>
				<?php if ( $content ) : ?>
					<div class="col-lg-12 h1">
						<?php echo $content; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="row columns_industries_btns">
			<?php if ( $industries ) : $counter = 0 ; ?>
				<div class="col-lg-12">
					<div class="row">
						<?php while ( have_rows( 'industries' ) ) :
							the_row();
							$counter++;
							$name = esc_html( get_sub_field( 'name' ) );
							$link = esc_html( get_sub_field( 'link' ) );
						?>
							
							<?php if( $name && $link ): ?>
								<div class="columns_industries_btn <?php echo ( 7 == $counter ) ? 'col-lg-6' : 'col-lg-3 '; ?>">
									<a class="btn btn-bordered" title="<?php echo $name; ?>" href="<?php echo $link; ?>">
										<?php echo $name; ?>
									</a>
								</div>
							<?php endif; ?>
							
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
