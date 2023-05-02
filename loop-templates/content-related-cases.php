<?php

	$args = array(
		'post_type'      => 'case_study',
		'posts_per_page' => 4,
		'post_status'    => 'publish',
		'post__not_in'   => array( get_the_ID() ),
		// 'orderby'        => 'rand',
	);
	$related_posts = new WP_Query( $args );

	$image_sizes = array(
		'690px' => 'big',
		'540px' => 'medium',
		'300px' => 'thumbnail',
	);

	if ( $related_posts->have_posts() ) :
		$rowCount = 0; ?>

	<div class="related_cases">
		<div class="row">
			<div class="flexible-content columns_headers mb-5 col-lg-12">
				<div class="section_name text-red">
					<?php esc_html_e( 'Case study', 'understrap' ); ?>
				</div>

				<div class="headers-header">
					<h2>
						<?php esc_html_e( 'See other cases', 'understrap' ); ?>
					</h2>		
				</div>
			</div>
		</div>
		<div class="row">
		<?php
		while ( $related_posts->have_posts() ) :
			$related_posts->the_post();
			$rowCount++;
			?>

			<?php get_template_part( 'loop-templates/content', 'case_study' ); ?>

	<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>

	</div>
	<?php endif; ?>
