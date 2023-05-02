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
$read_time = esc_html( get_field( 'read_time' ) );

?>

<article <?php post_class( 'col-lg-6' ); ?> id="post-<?php the_ID(); ?>" data-groups='[<?php echo $data_groups; ?>]'>

	<?php

		$image_sizes = array(
			'690px' => 'big',
			'540px' => 'medium',
			'300px' => 'thumbnail',
		);

		$category = get_the_category();
		if ( $category[0] ) {
			$category_link = '<a class="columns_hero_with_posts_post_footer_category" title="' . $category[0]->cat_name . '" href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
		}

		?>

<div class="columns_hero_with_posts_post_container post-small">
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
			<div class="columns_hero_with_posts_post_footer_date">
				<?php echo understrap_posted_on(); ?>
			</div>

			<?php if ( $read_time ) : ?>
			<div class="columns_hero_with_posts_post_footer_read_time">
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

</article><!-- #post-## -->
