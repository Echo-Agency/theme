<?php
	$width = esc_html( get_sub_field( 'width' ) );
?>

<div class="flexible-content columns_team">
	<div class="team_members row">
		
		<?php
		$args = array(
			'post_type'      => 'team',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		);

		$image_sizes = array(
			'100px' => 'person_thumb',
		);

		$team = new WP_Query( $args );

		if ( $team->have_posts() ) :
			?>
			
			<?php
			while ( $team->have_posts() ) :
				$team->the_post();
				?>

				<?php $team_position = esc_html( get_field( 'team_position' ) ); ?>

				<div class="team_member col-md-6 col-lg-4">	
					<div class="team_member_header">
						<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>

							<div class="team_member_image_container">

								<div class="team_member_image_decor">
									<?php echo icon_arrow_right(); ?>
								</div>

								<div class="team_member_image">
									<?php
										display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '100px' );
									?>
								</div>
							</div>
						<?php endif; ?> 

						<div class="team_member_name_and_position">
							<div class="team_member_name">
								<h2 class="team_member_name_header"><?php the_title(); ?></h2>
							</div>

							<?php if ( $team_position ) : ?> 
								<div class="team_member_position">
									<?php echo $team_position; ?> 
								</div>
							<?php endif; ?> 
						</div>
					</div>

					<div class="team_member_decor"><span></span></div>

					<?php if ( '' !== get_the_content() ) : ?> 
						<div class="team_member_description">
							<?php the_content(); ?> 
						</div>
					<?php endif; ?> 
				</div>

			<?php endwhile; ?>

		<?php else : ?>
			<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
		<?php endif; ?>

	</div>
	<?php wp_reset_postdata(); ?>
</div>
