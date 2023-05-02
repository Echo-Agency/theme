<?php
	$read_also_post = get_sub_field( 'read_also_post' );

	$image_sizes = array(
		'460px' => 'post_read_also_no_crop',
		'380px' => 'thumbnail_no_crop',
	);
	?>

<?php if ( $read_also_post->post_title && $read_also_post->ID ) : ?>
<div class="flexible-content columns_read_also_posts col-lg-12">
	<div class="decor"><div></div></div>
	<div class="read_also"><?php esc_html_e( 'Read also', 'understrap' ); ?>:</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 columns_read_also_post">	
				<div class="row">
					<div class="col-md-6 col-lg-3 columns_read_also_post_image">
						<a title="<?php echo $read_also_post->post_title; ?>" href="<?php the_permalink( $read_also_post->ID ); ?>">
						<?php
							display_responsive_image( get_post_thumbnail_id( $read_also_post->ID ), $read_also_post->post_title, $image_sizes, '540px' );
						?>
						</a>
					</div>
					<div class="col-md-6 col-lg-9 columns_read_also_post_title">
						<a title="<?php echo $read_also_post->post_title; ?>" href="<?php the_permalink( $read_also_post->ID ); ?>">
							<?php echo $read_also_post->post_title; ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
