<?php
	$width               = esc_attr( get_sub_field( 'width' ) );
	$title               = esc_html( get_sub_field( 'title' ) );
	$header              = esc_html( get_sub_field( 'header' ) );
	$header_billing_data = esc_html( get_sub_field( 'header_billing_data' ) );

	$header_pricing_data = esc_html( get_sub_field( 'header_pricing_data' ) );
	$pricing_phone       = esc_html( get_sub_field( 'pricing_phone' ) );
	$pricing_email       = esc_html( get_sub_field( 'pricing_email' ) );

	$display_company_name    = rest_sanitize_boolean( get_sub_field( 'display_company_name' ) );
	$display_company_phone   = rest_sanitize_boolean( get_sub_field( 'display_company_phone' ) );
	$display_company_email   = rest_sanitize_boolean( get_sub_field( 'display_company_email' ) );
	$display_company_address = rest_sanitize_boolean( get_sub_field( 'display_company_address' ) );

if ( $display_company_name ) {
	$website_name = esc_html( get_field( 'website_name', 'option' ) );
}

if ( $display_company_phone ) {
	$website_phone        = esc_html( get_field( 'website_phone', 'option' ) );
	$website_phone_mobile = esc_html( get_field( 'website_phone_mobile', 'option' ) );
}

if ( $display_company_email ) {
	$website_email = esc_html( get_field( 'website_email', 'option' ) );
}

if ( $display_company_address ) {
	$website_street        = esc_html( get_field( 'website_street', 'option' ) );
	$website_code_and_city = esc_html( get_field( 'website_code_and_city', 'option' ) );
}

	$website_nip   = esc_html( get_field( 'website_nip', 'option' ) );
	$website_regon = esc_html( get_field( 'website_regon', 'option' ) );
?>

<div class="flexible-content columns_contact_infos my-5 <?php echo $width; ?>">
	<div class="website-info">

		<?php if ( $title ) : ?>
			<h2 class="website-info-title">
				<?php echo $title; ?>
			</h2>
		<?php endif; ?>

		<?php if ( $header_pricing_data ) : ?>
			<div class="website-info-header">
				<?php echo $header_pricing_data; ?>
			</div>
		<?php endif; ?>

		<?php if ( $pricing_phone ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $pricing_phone ); ?>"><?php echo icon_phone() . $pricing_phone; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $pricing_email ) : ?>
			<div class="website-email pricing-email">
				<a title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>" href="mailto:<?php echo $pricing_email; ?>"><?php echo icon_email() . $pricing_email; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $header ) : ?>
			<div class="website-info-header">
				<?php echo $header; ?>
			</div>
		<?php endif; ?>

		<?php if ( $display_company_phone && $website_phone ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone ); ?>"><?php echo icon_phone() . $website_phone; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $display_company_phone && $website_phone_mobile ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone_mobile ); ?>"><?php echo icon_phone() . $website_phone_mobile; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $display_company_email && $website_email ) : ?>
			<div class="website-email">
				<a title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>" href="mailto:<?php echo $website_email; ?>"><?php echo icon_email() . $website_email; ?></a>
			</div>
		<?php endif; ?>

		<div class="billing-data">
		
			<?php if ( $header_billing_data ) : ?>
				<div class="website-billing-data">
					<?php echo $header_billing_data; ?>
				</div>
			<?php endif; ?>

			<?php if ( $display_company_name && $website_name ) : ?>
				<div class="website-name">
					<?php echo $website_name; ?>
				</div>
			<?php endif; ?>

			<?php if ( $display_company_address && $website_street ) : ?>
				<div class="website-address">
					<?php echo icon_address() . $website_street; ?>
					<?php if ( $website_code_and_city ) : ?>
						<span><?php echo $website_code_and_city; ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $website_nip ) : ?>
				<div class="website-nip">
					<?php echo $website_nip; ?>
				</div>
			<?php endif; ?>

			<?php if ( $website_regon ) : ?>
				<div class="website-regon">
					<?php echo $website_regon; ?>
				</div>
			<?php endif; ?>
		</div>
			
	</div>
</div>
