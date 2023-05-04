<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container    = get_theme_mod( 'understrap_container_type' );
$team_header  = esc_html( get_field( 'team_header', 'option' ) );
$team_lead    = get_field( 'team_lead', 'option' );
$team_heading = get_field( 'team_heading', 'option' );

?>

<div class="wrapper" id="full-width-page-wrapper">

	<header class="fullwidth-header<?php echo ( !empty($header_img_enabled) ) ? '' : ' default-header'; ?>"<?php echo ( $style ) ?? ''; ?>>
			
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
					<div class="col-lg-12 entry-header">
						
						<?php if ( $team_header ) : ?>
							<h1 class="entry-title"><?php echo $team_header; ?></h1>
						<?php endif; ?>

						<?php if ( $team_lead ) : ?>
							<div class="header-lead"><?php echo $team_lead; ?></div>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
			<div class="decor decor-power"><?php echo icon_power(); ?></div>
			<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
			<div class="decor decor-plus"><?php echo icon_plus(); ?></div>
	</header>

		<div class="container" id="content">

		<div class="archive-team">

			<!-- Do the left sidebar check -->
			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( $team_heading ) : ?>
				<div class="row">
					<div class="col-lg-12">
						<h2 class="archive-team-heading">
							<?php echo $team_heading; ?>
						</h2>
					</div>
				</div>
				<?php endif; ?>

				<?php
				if ( have_posts() ) :
					$rowCount = 0;
					?>

					<?php /* Start the Loop */ ?>
					<?php
					echo '<div class="row">';
					while ( have_posts() ) :
						$rowCount++;
						the_post();
						?>

						<?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */

							get_template_part( 'loop-templates/content', get_post_type() );

						?>

						<?php
						endwhile;
						echo '</div>';
					?>
					

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php // get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer(); ?>
