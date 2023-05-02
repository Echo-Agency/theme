<?php
	$category = get_the_category();

	$exclude_posts_from_related = get_field( 'exclude_posts_from_related' );

	$excluded_posts[] = get_the_ID();

if ( $exclude_posts_from_related ) {
	foreach ( $exclude_posts_from_related as $post_to_exclude ) {
		$excluded_posts[] = $post_to_exclude['exclude_post_from_related'];
	}
}

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'category__in'   => $category[0]->term_id,
		'post__not_in'   => $excluded_posts,
		// 'orderby'        => 'date',
	);
	$related_posts = new WP_Query( $args );

	$image_sizes = array(
		'690px' => 'big',
		'540px' => 'medium',
		'300px' => 'thumbnail',
	);

	if ( $related_posts->have_posts() ) :
		$rowCount = 0; ?>

	<div class="related_articles">

		<div class="row">
			<div class="col-lg-12 related_articles_title">
				<?php esc_html_e( 'Related posts', 'understrap' ); ?>
			</div>
		</div>
		<div class="row">
		<?php
		while ( $related_posts->have_posts() ) :
			$related_posts->the_post();
			$rowCount++;
			?>

			<?php

			$post_category = get_the_category();

			if ( $post_category[0] ) {
				$category_link = '<a class="columns_hero_with_posts_post_footer_category" title="' . $post_category[0]->cat_name . '" href="' . get_category_link( $post_category[0]->term_id ) . '">' . $post_category[0]->cat_name . '</a>';
			}

			?>

	<div class="columns_hero_with_posts_post_container col-md-12 col-lg-4">
		<div class="columns_hero_with_posts_post">
			
			<div class="columns_hero_with_posts_post_image col-lg-12">
				<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">

				<?php
				if ( has_post_format( 'video' ) ) {

					get_youtube_video_cover( get_the_ID() );

					echo '<div class="video-decor">' . icon_youtube() . '</div>';
				} else {
					display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '690px' );
				}
				?>
				</a>
			</div>
			<div class="columns_hero_with_posts_post_footer col-lg-12">
				<?php echo $category_link; ?>
				<div class="columns_hero_with_posts_post_footer_date"><?php echo get_the_date( '', get_the_ID() ); ?></div>
			</div>
			<div class="columns_hero_with_posts_post_title col-lg-12">
				<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">
					<?php the_title(); ?>
				</a>
			</div>
			<div class="columns_hero_with_posts_post_link col-lg-12">
				<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>"> <?php esc_html_e( 'Read More...', 'understrap' ); ?> </a>
			</div>
		</div>
	</div>

	<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	</div>

	</div>
	<?php endif; ?>
