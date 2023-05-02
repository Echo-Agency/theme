<?php
	$width        = esc_attr( get_sub_field( 'width' ) );
	$video_iframe = get_sub_field( 'video_iframe' );
	$video_title  = wp_kses_post( get_sub_field( 'video_title' ) );

if ( false == strpos( $video_iframe, 'loading="lazy"' ) ) {
	$video_iframe = str_replace( 'iframe', 'iframe loading="lazy"', $video_iframe );
}
?>

<div class="flexible-content columns_video mobile-2 <?php echo $width; ?>">
	<?php if ( $video_iframe ) : ?>
		<div class="row">
			<div class="col-lg-12 column_video video-<?php echo $width; ?>">
				<?php echo $video_iframe; ?>
			</div>
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
