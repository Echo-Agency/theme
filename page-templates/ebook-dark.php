<?php
/**
 * Template Name: Ebook Dark
 *
 * Template for displaying a ebook.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$ebook_header = get_field( 'ebbok_header' );

$style = null;

if ( $ebook_header['header_bg_color'] ) {
	$style = ' style="background-color:' . sanitize_hex_color( $ebook_header['header_bg_color'] ) . '"';
}
?>

<div class="wrapper" id="full-width-page-wrapper">

	<header class="ebook-header"<?php echo $style ? $style : ''; ?>>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 entry-header">
					<!-- <div class="row">
						<div class="col-lg-4">
							<?php //do_shortcode( '[display-logo]' ); ?>
						</div>
					</div> -->
					<?php if ( $ebook_header['header'] ) : ?>
							<div class="row">
							<div class="col-lg-12 header-lead">
								<h1><?php echo esc_html( $ebook_header['header'] ); ?></h1>
							</div>
							</div>
						<?php endif; ?>
					<div class="row">
						<div class="col-lg-12 header-description">
							<?php if ( $ebook_header['description'] ) : ?>
								<?php echo wp_kses_post( $ebook_header['description'] ); ?>
							<?php endif; ?>
						</div>
						<div class="col-lg-12 form-wrapper-container">
							<?php if ( $ebook_header['form'] ) : ?>
								<div class="row forms-wrapper">
							
									<?php if ( $ebook_header['header'] ) : ?>
										<div class="col-lg-12">
											<p class="h3 form_header"><?php echo esc_html( $ebook_header['form_header'] ); ?></p>
										</div>
									<?php endif; ?>
									<div class="col-lg-12">
									<?php
										echo do_shortcode( '[contact-form-7 id="' . intval( $ebook_header['form'][0]->ID ) . '" title="' . esc_html( $ebook_header['form'][0]->post_title ) . '"]' );
									?>
									
								</div>
								
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 header-img">
					<?php
					if ( $ebook_header['img'] ) {
						$image_sizes = array(
							'690px' => 'big',
							'540px' => 'medium',
							'300px' => 'thumbnail',
						);

						$img_max_width = '690px';

						display_responsive_image( intval( $ebook_header['img'] ), '', $image_sizes, $img_max_width, false );
					}
					?>
				</div>
			</div>
		</div>
		<div class="decor decor-power"><?php echo icon_power(); ?></div>
		<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
		<div class="decor decor-triangle"><div class="triangle"></div></div>
	</header>

	<div class="container-fluid" id="content">

			<div class="content-area" id="primary">

				<main class="site-main" id="main" role="main">
					
					<?php if ( ! post_password_required( get_the_ID() ) ) : ?>
						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<?php get_template_part( 'loop-templates/content', 'page' ); ?>

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>

						<?php endwhile; // end of the loop. ?>

					<?php else : ?>
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
								<?php echo get_the_password_form( get_the_ID() ); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>

				</main><!-- #main -->

			</div><!-- #primary -->



	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->
 <?php get_footer(); ?>
