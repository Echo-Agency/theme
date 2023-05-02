<?php
	$width      = rest_sanitize_boolean( get_sub_field( 'width' ) );
	$job_header = wp_kses_post( get_sub_field( 'job_header' ) );
?>
<a name="jobs"></a>
<div class="flexible-content columns_jobs col-lg-12">

	<?php if ( $job_header ) : ?> 
		<div class="row">
			<div class="col-lg-12">
				<div class="job_header">
					<?php echo $job_header; ?> 
				</div>
			</div>
		</div>
	<?php endif; ?> 

	<?php

	$job_categories         = get_terms( 'job-category', 'orderby=name' );
	$job_categories_counter = count( $job_categories );
	$job_offers_counter     = 0;

	foreach ( $job_categories as $job_category ) :
		?>
		<?php if ( $job_category ) : ?>
			<div class="jobs_category">
				<div class="row">
					<?php echo '<h2 class="job_category_header">' . $job_category->name . '</h2>'; ?>
				</div>

				<?php
					$args = array(
						'posts_per_page' => -1,
						'job-category'   => $job_category->slug,
						'post_type'      => 'job',
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
					);

					$job_category_posts = get_posts( $args );

					foreach ( $job_category_posts as $job_offer ) :
						?>
						<?php
							$job_offers_counter++;
							$job_start_date = esc_html( get_field( 'job_start_date', $job_offer->ID ) );
							$job_end_date   = esc_html( get_field( 'job_end_date', $job_offer->ID ) );
							$job_location   = esc_html( get_field( 'job_location', $job_offer->ID ) );
						?>

						<div class="job row">	
							<?php if ( get_the_title() ) : ?> 
								<div class="col-lg-4 job_title">
									<a href="<?php the_permalink( $job_offer->ID ); ?>" title="<?php echo get_the_title( $job_offer->ID ); ?> ">
										<?php echo get_the_title( $job_offer->ID ); ?> 
									</a>
								</div>
							<?php endif; ?> 
							
							<div class="col-lg-8">
								<div class="row">
									<?php if ( $job_location ) : ?> 
										<div class="col-lg-4 job_location">
											<?php echo icon_address() . $job_location; ?> 
										</div>
									<?php endif; ?> 
								
									<div class="col-lg-6 job_date">
										<?php
										if ( $job_start_date && $job_end_date ) {
											echo icon_calendar() .
											$job_start_date . ' - ' . $job_end_date;
										} else {
											echo icon_calendar() . icon_infinity();
										}

										?>
											
									</div>
									
									<div class="col-lg-2">
										<a href="<?php the_permalink( $job_offer->ID ); ?>" title="<?php echo get_the_title( $job_offer->ID ); ?> " class="btn btn-bordered"><?php esc_html_e( 'Apply', 'understrap' ); ?></a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					
			</div>
		<?php endif; ?>
	<?php endforeach; ?>

	<?php if ( !$job_categories_counter || !$job_offers_counter ) : ?>
		<div class="no_jobs_for_you">
			<?php echo icon_cry(); ?>
			<p>
				Aktualnie nie szukamy nikogo do naszego zespołu.<br />
				Wróć za jakiś czas, być może znajdziesz ogłoszenie dla siebie.
			</p>
		</div>
	<?php elseif ( ! $job_categories_counter || ! $job_offers_counter ) : ?>
		<p class="text-center">
			<?php echo esc_html_e( 'It looks like no job offers was found', 'understrap' ); ?>
		</p>
	<?php endif; ?>

</div>

<?php wp_reset_postdata(); ?>
