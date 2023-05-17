<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container            = get_theme_mod( 'understrap_container_type' );
$gtm_head             = get_field( 'gtm_code_head', 'option' );
$gtm_body             = get_field( 'gtm_code_body', 'option' );
$header_contact_info = get_field( 'header_contact_info', 'option' );

if ( $header_contact_info ) {
	$website_phone_mobile = esc_html( get_field( 'website_phone_mobile', 'option' ) );
	$website_email        = esc_html( get_field( 'website_email', 'option' ) );
}

if ( is_post_type_archive( 'case_study' ) ) {
	$higher_header = get_field( 'higher_header', 'options' ) ? 'higher-header' : '';
} else {
	$higher_header = get_field( 'higher_header' ) ? 'higher-header' : '';
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

	<!-- <link rel="preload" href="<?php // echo get_stylesheet_directory_uri() . '/css/child-theme.min.purged.css'; ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript><link rel="stylesheet" href="<?php // echo get_stylesheet_directory_uri() . '/css/child-theme.min.purged.css'; ?>"></noscript> -->

	<?php echo ( $gtm_head ) ? $gtm_head : ''; ?>

</head>

<body <?php body_class( $higher_header ); ?>>
<?php echo ( $gtm_body ) ? $gtm_body : ''; ?>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">


<!-- ******************* The Navbar Area ******************* -->
<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
	<div class="container p-0">
		<?php if ( $header_contact_info ) : ?>
			<div class="free-valuation-top">
				<?php if ( $website_phone_mobile ) : ?>
					<a class="quick-contact" title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone_mobile ); ?>"><?php echo icon_phone() . $website_phone_mobile; ?></a>
				<?php endif; ?>
				<?php if ( $website_email ) : ?>
					<a class="quick-contact" title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>" href="mailto:<?php echo $website_email; ?>"><?php echo icon_email() . $website_email; ?></a>
				<?php endif; ?>
				<!-- <a href="<?php // echo esc_url( get_field( 'website_valuation_page', 'option' ) ); ?>" title="<?php // esc_html_e( 'Free valuation', 'understrap' ); ?>" class="btn btn-primary"><?php // esc_html_e( 'Free valuation', 'understrap' ); ?></a> -->
			</div>
		<?php endif; ?>
		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-lg">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

				<?php do_shortcode( '[display-logo]' ); ?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon">
						<?php echo icon_menu(); ?>
					</span>
				</button>

				<!-- The WordPress Menu goes here -->
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav justify-content-end w-100',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>
				<div class="free-valuation">
					<a href="<?php echo esc_url( get_field( 'website_valuation_page', 'option' ) ); ?>" title="<?php esc_html_e( 'Free valuation', 'understrap' ); ?>" class="btn btn-primary"><?php esc_html_e( 'Free valuation', 'understrap' ); ?></a>
				</div>
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- .site-navigation -->

	</div>
	<?php if ( is_single() ) : ?>
		<div class="progress-bar-container">
			<div class="progress-bar" id="ContentProgressBar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
		</div>
	<?php endif; ?>
</div><!-- #wrapper-navbar end -->

