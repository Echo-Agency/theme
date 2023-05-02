<?php
	$width       = esc_attr( get_sub_field( 'width' ) );
	$images_ids  = get_sub_field( 'gallery' );
	$image_sizes = array(
		'690px' => 'big',
		'540px' => 'medium',
		'380px' => 'thumbnail_no_crop',
	);
	$uuid        = uniqid();
	?>

<div class="flexible-content columns_images_mosaic my-5 <?php echo $width; ?>">
	<?php if ( $images_ids ) : ?>
	<div class="mosaic-wrapper row <?php echo 'mosaic-' . $uuid = uniqid(); ?>">
		<div class="col-lg-6">
			<div class="row">
				<div class="col-lg-12 main-mosaic-item">
					<a href="<?php echo wp_get_attachment_image_url( $images_ids[0], 'large' ); ?>" class="glightbox" data-gallery="gallery<?php echo $uuid; ?>">
						<?php display_responsive_image( $images_ids[0], '', $image_sizes, '800px' ); ?>
					</a>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="row">
				<?php foreach ( array_slice( $images_ids, 1 )  as $img_id ) : ?>
					<div class="mosaic-item col-12">
						<a href="<?php echo wp_get_attachment_image_url( $img_id, 'large' ); ?>" class="glightbox" data-gallery="gallery<?php echo $uuid; ?>">
							<?php display_responsive_image( $img_id, '', $image_sizes, '800px' ); ?>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>

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
