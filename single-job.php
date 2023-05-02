<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

<div class="wrapper" id="single-wrapper">

	<header class="fullwidth-header">

		<div class="container">
			<div class="row">
				
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>
			</div>
		</div>

	</header><!-- .entry-header -->

	<div class="container-fluid" id="content" tabindex="-1">

		
			<!-- Do the left sidebar check -->
			<?php // get_template_part( 'global-templates/left-sidebar-check' ); ?>

		<main class="site-main" id="main">
			<div class="container">

			<div class="single_post_header row">

				<!-- <div class="col-lg-12 single_post_header_category_date">
					
					<div class="single_post_header_date">
						<?php // echo understrap_posted_on(); ?>
					</div>

				</div> -->
				
				<div class="col-lg-12">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				
				</div>

			</div>

				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<?php
						get_template_part( 'loop-templates/content', 'job' );
					?>

					<?php // understrap_post_nav(); ?>

					<?php // echo do_shortcode('[ratemypost]'); ?>

					<?php // echo do_shortcode( '[ratemypost-result]' ); ?>

					<?php // get_template_part( 'loop-templates/content', 'related-posts' ); ?>

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
