<?php
	$width                       = esc_attr( get_sub_field( 'width' ) );
	$image_lightbox              = rest_sanitize_boolean( get_sub_field( 'image_lightbox' ) );
	$image_decors                = rest_sanitize_boolean( get_sub_field( 'image_decors' ) );
	$image_position_relative     = rest_sanitize_boolean( get_sub_field( 'image_position_relative' ) );
	$image_position_relative_top = get_sub_field( 'image_position_relative_top' );
	$image_100                   = rest_sanitize_boolean( get_sub_field( 'image_100' ) );
	$image_50                    = rest_sanitize_boolean( get_sub_field( 'image_50' ) );
	$img_id                      = esc_html( get_sub_field( 'image' ) );
	$image_description           = wp_kses_post( get_sub_field( 'image_description' ) );


if ( is_single() ) {
	$image_sizes = array(
		'690px' => 'big',
		'540px' => 'medium',
		'300px' => 'thumbnail',
	);

	$img_max_width = '690px';
} else {
	$image_sizes = array(
		'1110px' => 'full',
		'690px'  => 'big',
		'540px'  => 'medium',
		'300px'  => 'thumbnail',
	);

	$img_max_width = '1110px';
}

	$uuid = uniqid();

	$file_url = wp_get_attachment_url( $img_id );
	$filetype = wp_check_filetype( $file_url );

	$is_svg = false;

if ( 'svg' == $filetype['ext'] ) {
	$is_svg = true;
}

$style = null;

if ( $image_decors || $image_position_relative ) {
	$style = ' style="position: relative;"';
}

?>

<div id="columns_images_<?php echo $uuid; ?>" class="flexible-content columns_images mobile-2 <?php echo ( is_single() ) ? 'col-lg-7 mx-auto' : $width; ?> <?php echo ( $image_100 && ! $image_50 ) ? ' image-100' : ''; ?> <?php echo ( $image_50 && ! $image_100 ) ? ' image-50' : ''; ?>"<?php echo $style ? $style : ''; ?>>
	<?php if ( $image_decors ) : ?>
		<div class="decor decor-power"><?php echo icon_power(); ?></div>
		<div class="decor decor-power decor-power-second"><?php echo icon_power(); ?></div>
		<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
		<div class="decor decor-plus"><?php echo icon_plus(); ?></div>
	<?php endif; ?>

	<div class="vertical-middle text-center">
		<div class="columns_images_image">

			<?php if ( $image_lightbox ) : ?>
				<a href="<?php echo wp_get_attachment_image_url( $img_id, 'large' ); ?>" class="glightbox" data-gallery="gallery<?php echo $uuid; ?>">
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
		</div>
	</div>
</div>

<?php if ( $image_position_relative ) : ?>
	<style>
		@media (min-width: 1200px) { 
			#columns_images_<?php echo $uuid; ?> img {
				<?php
					echo 'position: relative; top: ' . $image_position_relative_top . '; margin-bottom: ' . $image_position_relative_top . ';';
				?>
			}
		}

		@media (max-width: 1199px) { 
			#columns_images_<?php echo $uuid; ?> img {
				margin-top: 30px;
			}
		}
	</style>
<?php endif; ?>

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
