<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$team_position = esc_html( get_field( 'team_position' ) );

$image_sizes = array(
	'200px' => 'gallery_thumb',
);
?>

<article <?php post_class( 'col-md-6 col-lg-4' ); ?> id="team-<?php the_ID(); ?>">

	<div class="team_member">	
		<div class="team_member_header">
			<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>

				<div class="team_member_image_container">

					<div class="team_member_image_decor">
						<?php echo icon_arrow_right(); ?>
					</div>

					<div class="team_member_image">
						<?php
							display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '200px' );
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
	
</article><!-- #post-## -->
