<?php
/**
 * Sidebar setup for footer full.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full">

		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar( 'footerfull' ); ?>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

	<div class="container-fluid copy">
		<div class="row">
			<div class="col-lg-12 copy-logo">
				<?php do_shortcode( '[display-logo]' ); ?>
			</div>
			<div class="col-sm-12">
				<p class="small">
					<?php esc_html_e( 'Copyrights', 'understrap' ); ?>
				</p>
				<p class="small">
				Copyrights © 
					<?php
					echo esc_attr( get_bloginfo( 'name', 'display' ) );
					echo ' ' . date( 'Y' );
					?>
				</p>
			</div>
			<div class="col-lg-12 regulations">
				<a href="<?php echo esc_url( get_field( 'website_regulations_page', 'option' ) ); ?>"><?php esc_html_e( 'Regulations', 'understrap' ); ?></a>

				<a href="<?php echo esc_url( get_field( 'website_policy_page', 'option' ) ); ?>"><?php esc_html_e( 'Privacy policy', 'understrap' ); ?></a>
			</div>

			<!-- <div class="col-lg-12 project">
				<span><?php // esc_html_e( 'Project', 'understrap' ); ?>:</span>
				<?php // get_svg('jacob', 15, 'JAAQOB'); ?>
			</div> -->
			
		</div>
	</div>

<?php endif; ?>