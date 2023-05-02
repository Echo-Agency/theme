<?php
	$width        = esc_html( get_sub_field( 'width' ) );
	$image_width  = esc_html( get_sub_field( 'image_width' ) );
	$image_decors = rest_sanitize_boolean( get_sub_field( 'decors' ) );
	$image_header = esc_html( get_sub_field( 'header' ) );
	$images_ids   = get_sub_field( 'gallery' );

if ( is_page_template( 'page-templates/ebook.php' ) ) {
	$image_sizes = array(
		'380px' => 'thumbnail_no_crop',
	);

	$max_width = '380px';
} else {
	$image_sizes = array(
		'200px' => 'gallery_thumb',
	);

	$max_width = '200px';
}

	$uuid = uniqid();

	$style = null;

if ( $image_decors ) {
	$style = ' style="position: relative;"';
}
?>

<div class="flexible-content columns_gallery_lightbox my-5 <?php echo $width; ?>"<?php echo $style ? $style : ''; ?>>
	<?php if ( $image_decors ) : ?>
		<div class="decor decor-power"><?php echo icon_power(); ?></div>
		<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
	<?php endif; ?>

	<?php if ( $image_header ) : ?>
		<div class="row">
			<div class="col-lg-12">
				<h2 class="columns_gallery_lightbox_header"><?php echo $image_header; ?></h2>
			</div>
		</div>
	<?php endif; ?>

	<?php if ( $images_ids ) : ?>
	<div class="gallery-wrapper row">
		<?php foreach ( $images_ids as $img_id ) : ?>
			<div class="gallery-item <?php echo ( $image_width ) ? $image_width : 'col-4'; ?>">
				<a href="<?php echo wp_get_attachment_image_url( $img_id, 'large' ); ?>" class="glightbox" data-gallery="gallery<?php echo $uuid; ?>">
					<?php display_responsive_image( $img_id, '', $image_sizes, $max_width ); ?>
					<?php echo icon_zoom(); ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
</div>

<?php if ( ! isset( $GLOBALS['lightbox_scripts_loaded'] ) or false === $GLOBALS['lightbox_scripts_loaded'] ) : ?>
	<script defer="defer" src="<?php echo get_stylesheet_directory_uri() . '/js/glightbox.min.js'; ?>"></script>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() . '/css/glightbox.min.css'; ?>">
	
	<?php $GLOBALS['lightbox_scripts_loaded'] = true; ?>

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
