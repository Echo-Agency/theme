<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$higher_header     = get_field( 'higher_header' );
$header_override = get_field( 'header_override' );
$header_lead     = get_field( 'header_lead' );
$header_text     = get_field( 'header_text' );
$read_time       = esc_html( get_field( 'read_time' ) );

// $case_study_client = get_field( 'case_study_client' );
?>

<div class="wrapper" id="single-wrapper">

	<header class="fullwidth-header default-header">
			
			<?php if ( get_field( 'header_background_image_enable' ) && get_field( 'header_background_image_darken' ) ) : ?>
				<div class="bg_image_darken"></div>
			<?php endif; ?>

		<div class="container">
			<div class="row">
				
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>
				<?php if ( $header_override || $header_lead ) : ?>
					<div class="col-lg-12 entry-header">
						
						<?php if ( $header_override ) : ?>
							<h1 class="entry-title"><?php echo $header_override; ?></h1>
						<?php else : ?>
						<h1><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
						<?php endif; ?>

						<?php if ( $header_lead ) : ?>
							<div class="header-lead"><?php echo $header_lead; ?></div>
						<?php endif; ?>

						<?php if ( $header_text ) : ?>
							<div class="header-text"><?php echo $header_text; ?></div>
						<?php endif; ?>
					
					</div>
				<?php endif; ?>
			</div>
		</div>

	</header>

	<div class="container-fluid" id="content" tabindex="-1">

		<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

		<main class="site-main" id="main">
			<div class="container">

			<div class="single_post_header row">

				<div class="col-lg-12 single_post_header_author_time">

					<?php if ( $read_time ) : ?>
					<div class="single_post_header_read_time">
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

				<!-- <div class="col-lg-12 single_post_header_category_date"> -->

					<!-- <div class="single_post_header_date">
						<?php // echo understrap_posted_on(); ?>
					</div> -->
					<!-- <div class="single_post_header_see_all"><a title="<?php // esc_html_e( 'See all case studies', 'understrap' ); ?>" href="<?php // echo get_post_type_archive_link( 'case_study' ); ?>"><?php // esc_html_e( 'See all case studies', 'understrap' ); ?></a></div> -->
				<!-- </div> -->
				
				<!-- <div class="col-lg-12"> -->
					
					<?php
						// if( $header_override ) {
						// the_title( '<h2 class="entry-title">', '</h2>' );
						// } else {
						// the_title( '<h1 class="entry-title">', '</h1>' );
						// }
					?>
				
				<!-- </div> -->

				

				<!-- <div class="col-lg-12 single_post_header_client">

					<div class="single_post_header_client_name">
						<?php // echo esc_html_e( 'Client', 'understrap' ); ?>:
					</div>
					<div class="single_post_header_client_logotype">
						<?php
							// $client_image_sizes = array(
							// '380px' => 'thumbnail_no_crop',
							// );
							// display_responsive_image( get_post_thumbnail_id( $case_study_client[0]->ID ), $case_study_client[0]->post_title, $client_image_sizes, '380px' );
						?>
					</div>
				</div> -->
			</div>

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php
						get_template_part( 'loop-templates/content', 'case_study_single' );
					?>

					<?php // understrap_post_nav(); ?>

					<?php // echo do_shortcode('[ratemypost]'); ?>

					<?php // echo do_shortcode( '[ratemypost-result]' ); ?>

					<?php if ( get_the_tags() ) : ?>
						<div class="single_post_footer_tags">
							<div class="single_post_footer_tags_title">
								<?php echo esc_html_e( 'Related tags', 'understrap' ); ?>:
							</div>
							<?php echo echo_show_tags( null, null, false ); ?>
						</div> 
					<?php endif; ?>

					

					<?php
					// If comments are open or we have at least one comment, load up the comment template.

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

				

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

	
			</div>
		</div><!-- #content -->
		<div class="container">
			<div class="col-lg-12">
				<?php get_template_part( 'loop-templates/content', 'related-cases' ); ?>
			</div>
		</div>
</div><!-- #single-wrapper -->

<script>
	document.addEventListener('DOMContentLoaded', function() {
		function myFunction() {

			var windowScroll = document.body.scrollTop || document.documentElement.scrollTop;
			var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
			var scrolled = (windowScroll / height) * 100;
			document.getElementById("ContentProgressBar").style.width = scrolled +"%";
			//document.getElementById("ContentProgressBar").innerHTML= Math.round(scrolled) +"%";
		}

		window.onscroll = function() {myFunction()}
	});
</script>

<?php get_footer(); ?>
