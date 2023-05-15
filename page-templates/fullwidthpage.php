<?php
/**
 * Template Name: Full Width Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$header_img_enabled = rest_sanitize_boolean( get_field( 'header_background_image_enable' ) );
$header_background_image_darken = rest_sanitize_boolean( get_field( 'header_background_image_darken' ) );

if ( $header_img_enabled ) {
	$header_img = esc_attr(get_field( 'header_background_image' ));
}
$header_override = esc_html( get_field( 'header_override' ) );
$header_lead     = get_field( 'header_lead' );
$header_text     = get_field( 'header_text' );
$header_button     = get_field( 'header_button' );
?>
<?php if ( is_front_page() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="full-width-page-wrapper">

	<?php if ( ! is_front_page() ) : ?>
		<header class="fullwidth-header<?php echo ( $header_img_enabled ) ? ' background-header' : ' default-header'; echo ( $header_img_enabled && $header_background_image_darken) ? ' background-header-dark' : ''; ?>">
			
			<?php if ( $header_img_enabled && $header_background_image_darken && $header_img) : ?>
				<div class="bg_image_darken">
				</div>
			<?php endif; ?>
			<?php if ( $header_img_enabled && $header_img) : ?>					
				<?php display_responsive_image( $header_img, max_width: '1140px', additional_class: 'background-header-img'  ); ?>
			<?php endif; ?>

			<div class="container">
				<div class="row">
				<?php
				if ( function_exists( 'yoast_breadcrumb' ) && ! post_password_required( get_the_ID() ) ) {
					yoast_breadcrumb( '<div class="col-lg-12" id="breadcrumbs">', '</div>' );
				}
				?>
					<div class="col-lg-12 entry-header">

						<?php
						if ( $header_override ) {
							echo '<h1 class="entry-title">' . $header_override . '</h1>';
						} else {
							if ( ! post_password_required( get_the_ID() ) ) :
								the_title( '<h1 class="entry-title">', '</h1>' );
							else :
								echo '<h1 class="entry-title">Wprowadź hasło.</h1>';
							endif;
						}

						?>

						<?php if ( $header_lead ) : ?>
							<div class="header-lead"><?php echo $header_lead; ?></div>
						<?php endif; ?>

						<?php if ( $header_text ) : ?>
							<div class="header-text"><?php echo $header_text; ?></div>
						<?php endif; ?>

						<?php if ( $header_button ) : ?>
							<?php
								$button_text      = $header_button['button_text'];
								$button_icon_code = $header_button['button_icon_code'];
								$button_url       = $header_button['button_url'];
								$button_class       = $header_button['button_class'];

								include locate_template( 'flexible-templates/button.php', false, false );
							?>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
			<div class="decor decor-power"><?php echo icon_power(); ?></div>
			<div class="decor decor-multiply"><?php echo icon_multiply(); ?></div>
			<div class="decor decor-plus"><?php echo icon_plus(); ?></div>
		</header>

	<?php endif; ?>

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

<?php if ( is_front_page() ) : ?>
	<?php
		$website_name          = esc_html( get_field( 'website_name', 'option' ) );
		$website_street        = esc_html( get_field( 'website_street', 'option' ) );
		$website_code_and_city = esc_html( get_field( 'website_code_and_city', 'option' ) );
		$website_phone         = esc_html( get_field( 'website_phone', 'option' ) );
		$website_logo_id       = 1954;  // can't use svg
		$website_logo_url      = wp_get_attachment_image_url( $website_logo_id, 'full' );
		$website_title         = get_post_meta( get_the_ID(), '_yoast_wpseo_title', true );
		$website_description   = get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true );
	?>
	<script type='application/ld+json'> 
		{
		"@context": "https://www.schema.org",
		"@type": "LocalBusiness",
		"name": "<?php echo $website_name; ?>", 
		"url": "<?php echo get_site_url(); ?>",
		"logo": "<?php echo $website_logo_url; ?>",
		"image": "<?php echo $website_logo_url; ?>",
		"description": "<?php echo $website_title . ' - ' . $website_description; ?>",
		"telephone": "<?php echo $website_phone; ?>",
		"priceRange": "PLN", 
		"address": {
			"@type": "PostalAddress",
			"streetAddress": "<?php echo $website_street; ?>",
			"addressLocality": "Łódzkie",
			"addressRegion": "Łódzkie",
			"postalCode": "<?php echo substr( $website_code_and_city, 0, 5 ); ?>",
			"addressCountry": "PL"
			},
		"geo": {
		"@type": "GeoCoordinates",
			"latitude": 51.75755222231004, 
			"longitude": 19.45389061908439
			},
		"openingHours": "Mo, Tu, We, Th, Fr 08:00-16:30"
		}
	</script>
 <?php endif; ?>

 <?php get_footer(); ?>
