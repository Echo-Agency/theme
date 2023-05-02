<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$image_sizes = array(
	'690px' => 'big',
	'540px' => 'medium',
	'300px' => 'thumbnail',
);

$case_study_client = get_field( 'case_study_client' );
$case_study_title  = strip_tags( get_the_title() );
?>

<article <?php post_class( 'col-md-12 col-lg-6' ); ?> id="case-<?php the_ID(); ?>">

	<div class="hero_cases_slider_case">	
		<div class="hero_cases_slider_case_title">
			<div class="decor"></div>
				<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php echo trim( preg_replace( '/\s+/', ' ', $case_study_title ) ); ?> ">
					<?php the_title(); ?> 
				</a>
		</div>

		<div class="hero_cases_slider_case_image">
			<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php echo trim( preg_replace( '/\s+/', ' ', $case_study_title ) ); ?> ">
				<?php
					display_responsive_image( get_post_thumbnail_id( get_the_ID() ), $case_study_title, $image_sizes, '690px' );

					echo icon_power();
				?>
			</a>
		</div>

		<div class="hero_cases_slider_case_footer">
			<div class="hero_cases_slider_case_client">
				<span class="hero_cases_slider_case_client_title">
					<?php esc_html_e( 'Client', 'understrap' ); ?>:
				</span>
				<span class="hero_cases_slider_case_client_name">
					<?php echo esc_html( $case_study_client[0]->post_title ); ?> 
				</span>
			</div>
			<div class="hero_cases_slider_case_btn">
				<a href="<?php the_permalink( get_the_ID() ); ?>" title="<?php echo trim( preg_replace( '/\s+/', ' ', $case_study_title ) ); ?> " class="btn btn-primary"><?php esc_html_e( 'Check it out', 'understrap' ); ?></a>
			</div>
		</div>
		
	</div>
	
</article><!-- #post-## -->
