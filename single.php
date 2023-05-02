<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container          = get_theme_mod( 'understrap_container_type' );
$style              = null;
$header_img_enabled = rest_sanitize_boolean( get_field( 'header_background_image_enable' ) );
$header_override    = wp_kses_post( get_field( 'header_override' ) );
$header_lead        = wp_kses_post( get_field( 'header_lead' ) );
$header_text        = wp_kses_post( get_field( 'header_text' ) );

$read_time = esc_html( get_field( 'read_time' ) );

if ( $header_img_enabled ) {
	$style = ' style="background-image:url(\'' . esc_url( get_field( 'header_background_image' ) ) . '\');"';
}
?>

<div class="wrapper" id="single-wrapper">

	<header class="fullwidth-header<?php echo ( $header_img_enabled ) ? '' : ' default-header'; ?>"<?php echo ( $style ) ?? ''; ?>>
			
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
						<h1><?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
						<?php endif; ?>

						<?php if ( $header_lead ) : ?>
							<div class="header-lead"><?php echo $header_lead; ?></div>
						<?php endif; ?>

						<?php if ( $header_text ) : ?>
							<div class="header-text"><?php echo $header_text; ?></div>
						<?php endif; ?>
					
					</div>
				<?php else : ?>
					<?php if ( is_archive() ) : ?>
						<div class="col-lg-12 entry-header">
							<h1><?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>

	</header><!-- .entry-header -->

	<div class="container-fluid" id="content" tabindex="-1">
		<div class="container">

			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

		<main class="site-main single-main" id="main">

			<?php
				$category = get_the_category();
			if ( $category[0] ) {
				$category_link = '<a title="' . $category[0]->cat_name . '" href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
			}
			?>

			<div class="single_post_header row">

				<div class="col-lg-12 single_post_header_category_date">
					<div class="single_post_header_category"><?php echo $category_link; ?></div>

					<?php if ( get_the_tags() ) : ?>
						<div class="single_post_header_tags"><?php echo echo_show_tags( 3 ); ?></div> 
					<?php endif; ?>

					<div class="single_post_header_date">
						<?php echo understrap_posted_on(); ?>
					</div>

					<!-- <div class="single_post_header_see_all"><a title="<?php // esc_html_e( 'See all posts', 'understrap' ); ?>" href="<?php // echo get_category_link(1); ?>"><?php // esc_html_e( 'See all posts', 'understrap' ); ?></a></div> -->
				</div>
				
				<div class="col-lg-12">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>

				<div class="col-lg-12 single_post_header_author_time">

					<div class="single_post_header_author">
						<span><?php echo icon_person(); ?></span>
						<!-- <a title="<?php // echo esc_html_e( 'See all posts by', 'understrap' ) . ' ' . coauthors(); ?>" href="<?php // echo get_author_posts_url(get_the_author_meta('ID')); ?>"> </a>-->

						<?php
							// coauthors_posts_links(' | ', ' | ', null, null, true);

							display_coauthors_posts_links();
						?>
					</div>
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

			</div>

					<?php
					while ( have_posts() ) :
						the_post();
						?>

						<?php

						if ( has_post_format( 'video' ) ) {
							get_template_part( 'loop-templates/content', 'single-video' );
						} else {
							get_template_part( 'loop-templates/content', 'single' );
						}

						?>

						<?php // understrap_post_nav(); ?>

						<?php echo do_shortcode( '[ratemypost]' ); ?>
						<?php echo do_shortcode( '[ratemypost-result]' ); ?>

						<?php if ( get_the_tags() ) : ?>
							<div class="single_post_footer_tags">
								<div class="single_post_footer_tags_title">
									<?php echo esc_html_e( 'Related tags', 'understrap' ); ?>:
								</div>
								<?php echo echo_show_tags( null, null, false ); ?>
							</div> 
						<?php endif; ?>

						<?php get_template_part( 'loop-templates/content', 'related-posts' ); ?>

					<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- #content -->
	</div>
	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php
					// If comments are open or we have at least one comment, load up the comment template.

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</div><!-- #single-wrapper -->

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var sticker_closed = false;

		function myFunction() {

			var windowScroll = document.body.scrollTop || document.documentElement.scrollTop;
			var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
			var scrolled = (windowScroll / height) * 100;
			document.getElementById("ContentProgressBar").style.width = scrolled +"%";

			if(scrolled >= 50 && !sticker_closed) {
				document.getElementById("mc4wp-container").classList.add("active");
			} else {
				document.getElementById("mc4wp-container").classList.remove("active");
			}
			
			document.getElementById("sticker_close").onclick = function() {
				document.getElementById("mc4wp-container").classList.remove("active");
				sticker_closed = true;
			}
		}

		window.onscroll = function() {myFunction()}
	});
</script>

<?php get_footer(); ?>

<div id="mc4wp-container">
	<div id="sticker_close"><?php echo icon_close(); ?></div>
	<?php echo do_shortcode( '[mc4wp_form id=3376]' ); ?>
</div>
