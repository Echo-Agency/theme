<?php
	$width        = esc_attr( get_sub_field( 'width' ) );
	$header        = wp_kses_post( get_sub_field( 'header' ) );
	$description        = wp_kses_post( get_sub_field( 'description' ) );
	$industries = get_sub_field( 'industries' );
	$video_iframe = get_sub_field( 'video_iframe' );
	$video_cover_img = get_sub_field( 'video_cover_img' );
	$video_title  = wp_kses_post( get_sub_field( 'video_title' ) );
	$header2        = wp_kses_post( get_sub_field( 'header2' ) );
	$content        = wp_kses_post( get_sub_field( 'content' ) );
?>

<div class="flexible-content columns_industries <?php echo $width; ?>">

	<?php if ( $header || $description ) : ?>
		<div class="row">
			<?php if ( $header ) : ?>
				<div class="col-lg-12">
					<div class="additional-heading"><?php echo $header; ?></div>
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
				<?php
					$video_iframe = str_replace( '<iframe', '<iframe data-skip-lazy ', $video_iframe );
				?>

				<?php if ( $video_iframe ) : ?>
					<div class="col-lg-12 column_video">
						<?php echo $video_iframe; ?>
						<?php if ( $video_cover_img ) : ?>
							<div class="video_cover">
								<button onclick="playVideo()" id="placeholder">
									<svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%"><path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg>
								</button>
								<?php display_responsive_image( $video_cover_img, '' ); ?>
								<script>
									function playVideo(){
										const video_cover = document.querySelector('.video_cover')
										video_cover?.classList.add('hidden')
										loadYT()
									};
									// 2. This code loads the IFrame Player API code asynchronously.
									function loadYT() {
										var tag = document.createElement('script');
										tag.src = "https://www.youtube.com/iframe_api";
										var firstScriptTag = document.getElementsByTagName('script')[0];
										firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
									}

									let player

									function onYouTubeIframeAPIReady() {
										player = new YT.Player('yt-player', {
											events: {
												'onReady': onPlayerReady,
												'onStateChange': onPlayerStateChange
											}
										})
									}

									  // 4. The API will call this function when the video player is ready.
									function onPlayerReady(event) {
										event.target.playVideo();
									}

									// 5. The API calls this function when the player's state changes.
									//    The function indicates that when playing a video (state=1),
									//    the player should play for six seconds and then stop.
									var done = false;

									function onPlayerStateChange(event) {
										if (event.data == YT.PlayerState.PLAYING && !done) {
										setTimeout(stopVideo, 6000);
										done = true;
										}
									}

									function stopVideo() {
										player.stopVideo();
									}

								</script>
							</div>
						<?php endif; ?>
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
