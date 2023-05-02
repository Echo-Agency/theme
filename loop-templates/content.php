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

?>

<article <?php post_class( 'col-12 col-md-6 col-lg-4 masonry-item' ); ?> id="post-<?php the_ID(); ?>" data-groups='[<?php echo $data_groups; ?>]'>

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

<div class="columns_hero_with_posts_post_container row">
	<div class="columns_hero_with_posts_post">
		
		<div class="columns_hero_with_posts_post_image col-lg-12">
			<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">

			<?php
				display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '690px' );

				// echo $images_decors[ $rowCount - 1 ];

			?>
			</a>
		</div>
		<div class="columns_hero_with_posts_post_footer col-lg-12">
			<?php echo $category_link; ?>
			<div class="columns_hero_with_posts_post_footer_date"><?php the_date(); ?></div>
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
