<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$post_categories = get_the_category();

$data_groups = '';

foreach ( $post_categories as $key => $category ) {
	$data_groups .= '"' . $category->slug . '"';

	if ( count( $post_categories ) - 1 !== $key ) {
		$data_groups .= ',';
	}
}
$intro     = get_field( 'intro' );
$read_time = esc_html( get_field( 'read_time' ) );

?>

<article <?php post_class( 'col-lg-12' ); ?> id="post-<?php the_ID(); ?>" data-groups='[<?php echo $data_groups; ?>]'>

	<?php

		$image_sizes = array(
			'690px' => 'big',
			'540px' => 'medium',
			'300px' => 'thumbnail',
		);

		$category = get_the_category();

		if ( $category[0] ) {
			$category_link = '<a class="columns_hero_with_posts_post_top_category" title="' . $category[0]->cat_name . '" href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
		}

		?>

<div class="columns_hero_with_posts_post_container-wide">
	<div class="columns_hero_with_posts_post row">
		
		<div class="columns_hero_with_posts_post_image col-lg-6">
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
		<div class="columns_hero_with_posts_post_data col-lg-6">
			<div class="row">

				<div class="col-lg-12 columns_hero_with_posts_post_top">
					<?php echo $category_link; ?>
					<!-- <div class="columns_hero_with_posts_post_top_tags"><?php // echo echo_show_tags( 3 ); ?></div> -->
					<div class="columns_hero_with_posts_post_top_date">
						<?php echo understrap_posted_on(); ?>
					</div>
				</div>

				<div class="col-lg-12 columns_hero_with_posts_post_title">
					<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">
						<?php the_title(); ?>
					</a>
				</div>

				<div class="col-lg-12 columns_hero_with_posts_post_bottom">
					<div class="columns_hero_with_posts_post_top_author">
						<span><?php echo icon_person(); ?></span>
						<!-- <a title="<?php // echo esc_html_e( 'See all posts by', 'understrap' ) . ' ' . get_the_author_meta('display_name'); ?>" href="<?php // echo get_author_posts_url(get_the_author_meta('ID')); ?>">
							<?php // echo get_the_author_meta('display_name'); ?>
						</a> -->
						<?php
							// coauthors_posts_links(' | ', ' | ', null, null, true);
							display_coauthors_posts_links();
						?>
					</div>
					<?php if ( $read_time ) : ?>
					<div class="columns_hero_with_posts_post_top_read_time">
						<span><?php echo icon_time(); ?> </span>
						<?php
							echo $read_time . ' ';

						if ( 1 == $read_time ) {
							echo esc_html_e( 'minute', 'understrap' );
						} elseif ( 1 < $read_time && 5 > $read_time ) {
							echo esc_html_e( 'minutes(2-4)', 'understrap' );
						} else {
							echo esc_html_e( 'minutes(0-5+)', 'understrap' );
						}
						?>
					</div>
					<?php endif; ?>
				</div>
				
				<?php if ( $intro ) : ?>
					<div class="columns_hero_with_posts_post_intro col-lg-12">
						<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">
							<?php // echo $intro; ?>
							<?php echo echo_display_intro( $intro ); ?>

							
						</a>
					</div>
				<?php endif; ?>
				
				<div class="columns_hero_with_posts_post_link col-lg-12">
					<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>"> <?php esc_html_e( 'Read More...', 'understrap' ); ?> </a>
				</div>
			</div>
		</div>
	</div>
</div>

</article><!-- #post-## -->
