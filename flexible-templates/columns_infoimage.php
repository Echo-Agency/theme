<?php
	$width                       = esc_attr( get_sub_field( 'width' ) );
	$image_lightbox              = rest_sanitize_boolean( get_sub_field( 'image_lightbox' ) );
	$img_id                      = esc_html( get_sub_field( 'image' ) );
	$image_description           = wp_kses_post( get_sub_field( 'image_description' ) );
	$hide_btn              = rest_sanitize_boolean( get_sub_field( 'hide_btn' ) );
	$btn_anchor           = wp_kses_post( get_sub_field( 'btn_anchor' ) );

	$image_sizes = array(
		'1110px' => 'full',
		'690px'  => 'big',
		'540px'  => 'medium',
		'300px'  => 'thumbnail',
	);

	$img_max_width = '1110px';

	$uuid = uniqid();

	$file_url = wp_get_attachment_url( $img_id );
	$filetype = wp_check_filetype( $file_url );

	$is_svg = false;

if ( 'svg' == $filetype['ext'] ) {
	$is_svg = true;
}
?>

<div id="columns_infoimage_<?php echo $uuid; ?>" class="flexible-content columns_infoimage mobile-2 <?php echo $width ? $width : 'col-lg-12'; ?>">
	<div class="vertical-middle text-center">
		<div class="columns_infoimage_image">
			<?php if ( $image_lightbox ) : ?>
				<a href="<?php echo wp_get_attachment_image_url( $img_id, 'full' ); ?>" class="glightbox" data-gallery="gallery<?php echo $uuid; ?>">
			<?php endif; ?>
				<?php
					display_responsive_image( $img_id, '', $image_sizes, $img_max_width, $is_svg );
				?>
			<?php if ( $image_lightbox ) : ?>
				</a>
			<?php endif; ?>

			<?php if ( $image_description ) : ?>
				<div class="image-description">
					<?php echo $image_description; ?>
				</div>
			<?php endif; ?>

			<?php if ( !$hide_btn && $btn_anchor ) : ?>
				<div class="full-image-btn">
					<a class="btn btn-primary" href="<?php echo wp_get_attachment_image_url( $img_id, 'full' ); ?>" target="_blank">
						<?php echo $btn_anchor; ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php if ( $image_lightbox ) : ?>
	<?php if ( ! isset( $GLOBALS['lightbox_scripts_loaded'] ) or false === $GLOBALS['lightbox_scripts_loaded'] ) : ?>
		<script defer="defer" src="<?php echo get_stylesheet_directory_uri() . '/js/glightbox.min.js'; ?>"></script>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/glightbox.min.css'; ?>">
		
		<?php $GLOBALS['lightbox_scripts_loaded'] = true; ?>
		</p>
	<?php endif; ?>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const lightbox = GLightbox({
				touchNavigation: true,
				loop: true,
				autoplayVideos: true
			});
		});
	</script>
<?php endif; ?>
