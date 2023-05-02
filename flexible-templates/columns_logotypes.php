<?php
	$width = esc_html( get_sub_field( 'width' ) );
?>

<div class="flexible-content columns_logotypes">
	<div class="column_logotypes row">
		
		<?php
		$args = array(
			'post_type'      => 'clients',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		);

		$image_sizes = array(
			'380px' => 'thumbnail_no_crop',
		);

		$clients = new WP_Query( $args );

		if ( $clients->have_posts() ) :
			?>
			
			<?php
			while ( $clients->have_posts() ) :
				$clients->the_post();
				?>

					<div class="column_logotypes_logotype <?php echo ( $width ) ? $width : 'col-md-6 col-lg-3'; ?>">		
						<?php display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '380px' ); ?>	
					</div>

			<?php endwhile; ?>

		<?php else : ?>
			<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
		<?php endif; ?>

		
	</div>
	<?php wp_reset_postdata(); ?>
</div>
