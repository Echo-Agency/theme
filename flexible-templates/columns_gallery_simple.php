<?php
	$width       = esc_attr( get_sub_field( 'width' ) );
	$image_width = esc_attr( get_sub_field( 'image_width' ) );
	$images_ids  = get_sub_field( 'gallery' );
	$image_sizes = array(
		'540px' => 'medium',
		'380px' => 'thumbnail',
		'200px' => 'gallery_thumb',
	);
	$uuid        = uniqid();
	?>

<div class="flexible-content columns_gallery_simple my-5 <?php echo $width; ?>">
	<?php if ( $images_ids ) : ?>
	<div class="gallery-wrapper row <?php echo 'simple-gallery-' . $uuid = uniqid(); ?>">
		<div class="row mb-3 ">
			<div class="col-lg-12 main-gallery-item ">
				<?php display_responsive_image( $images_ids[0], '', $image_sizes, '768px' ); ?>
			</div>
		</div>
		<div class="thumbs row">
		<?php foreach ( $images_ids as $img_id ) : ?>
			<div class="gallery-item col-4 <?php echo ( $image_width ) ? $image_width : ''; ?>" data-img-srcset="<?php echo wp_get_attachment_image_srcset( $img_id, $size = 'medium' ); ?>">
				<?php display_responsive_image( $img_id, '', 'gallery_thumb', '768px' ); ?>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
	<?php endif; ?>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		jQuery('.<?php echo 'simple-gallery-' . $uuid; ?> .gallery-item').click(function() {
			jQuery('.<?php echo 'simple-gallery-' . $uuid; ?> .main-gallery-item img').attr('srcset', jQuery(this).attr('data-img-srcset'));
		});
	});
</script>
