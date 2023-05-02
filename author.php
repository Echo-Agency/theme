<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

if ( isset( $_GET['author_name'] ) ) {
	$curauth = get_user_by( 'slug', $author_name );
} else {
	$curauth = get_userdata( intval( $author ) );
}

$author_id = get_the_author_meta( 'ID' );

$author_position = esc_html( get_field( 'user_position', 'user_' . $author_id ) );
$author_photo_id = esc_html( get_field( 'user_photo', 'user_' . $author_id ) );

$image_sizes = array(
	'380px' => 'thumbnail_no_crop',
);

?>

<div class="wrapper" id="author-wrapper">

	<header class="container-fluid fullwidth-header">
		<div class="container">
			<div class="row">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>

				<div class="col-lg-12 author-wrapper-header">
					<div class="row">
						<div class="author-wrapper-header-photo col-lg-2">
							<?php display_responsive_image( $author_photo_id, esc_html( $curauth->nickname ), $image_sizes, '380px', false, true ); ?>
						</div>

						<div class="author-wrapper-header col-lg-9">
							<div class="author-wrapper-header_name">
								<h1><?php echo esc_html( $curauth->display_name ); ?></h1>
							</div>

							<div class="author-wrapper-header_position">
								<?php echo $author_position; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<?php if ( get_the_archive_description() ) : ?>
						<div class="row">
							<div class="col-lg-12 author-wrapper-description">
								<?php echo get_the_archive_description(); ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="decor decor-power"><?php echo icon_power(); ?></div>
		<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
		<div class="decor decor-plus"><?php echo icon_plus(); ?></div>
	</header>

	<div class="container-fluid">
	<div class="container" id="content">

			<!-- Do the left sidebar check -->
			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

		<main class="site-main" id="main">

				<div class="row author-posts">

					<div class="author-wrapper-title col-lg-12">
						<h2><?php echo esc_html__( 'See posts by', 'understrap' ); ?>:</h2>
					</div>

					<!-- The Loop -->
					<?php if ( have_posts() ) : ?>
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'loop-templates/content', 'wide' );
							?>
							<!-- <div class="col-lg-12 author-post">
								<div class="row">
									<div class="author-post-thumbnail col-lg-4">
									
										<?php
										// $image_sizes = array(
										// '640px' => 'medium',
										// '400px' => 'thumbnail',
										// );
										// display_responsive_image( get_post_thumbnail_id(), '', $image_sizes, '640px' );
										?>
										
									
									</div>
									<div class="col-lg-8">
										<h3 class="author-post-title">
											<a href="<?php // echo esc_url( apply_filters( 'the_permalink', get_permalink( $post ), $post ) ); ?>"><?php the_title(); ?></a>
										</h3>
										<?php // understrap_posted_on(); ?>
										<?php // esc_html_e( 'in', 'understrap' ); ?>
										<?php // the_category( ' & ' ); ?>

										<?php // the_excerpt(); ?>
									</div>
								</div>
							</div> -->
						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

					<!-- End Loop -->

				</div>
			

		</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

</div><!-- #author-wrapper -->

<?php get_footer(); ?>
