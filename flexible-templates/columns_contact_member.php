<?php
	$width                  = esc_attr( get_sub_field( 'width' ) );
	$hidedecor                  = rest_sanitize_boolean( get_sub_field( 'hidedecor' ) );
	$contact_column_header = wp_kses_post( get_sub_field( 'contact_column_header' ) );
	$contact_column_content = wp_kses_post( get_sub_field( 'contact_column_content' ) );
	$contact_column_member  = get_sub_field( 'contact_column_member' );
	$contact_column_header2 = wp_kses_post( get_sub_field( 'contact_column_header2' ) );
	$contact_column_content2 = wp_kses_post( get_sub_field( 'contact_column_content2' ) );
	$contact_column_member2  = get_sub_field( 'contact_column_member2' );
	$contact_column_header3 = wp_kses_post( get_sub_field( 'contact_column_header3' ) );
	$contact_column_email = wp_kses_post( get_sub_field( 'contact_column_email' ) );
	$contact_column_header3 = wp_kses_post( get_sub_field( 'contact_column_header3' ) );
	$display_company_phone   = rest_sanitize_boolean( get_sub_field( 'display_company_phone' ) );
	$display_company_email   = rest_sanitize_boolean( get_sub_field( 'display_company_email' ) );

	if ( $display_company_phone ) {
		$website_phone        = esc_html( get_field( 'website_phone', 'option' ) );
		$website_phone_mobile = esc_html( get_field( 'website_phone_mobile', 'option' ) );
	}
	
	if ( $display_company_email ) {
		$website_email = esc_html( get_field( 'website_email', 'option' ) );
	}
?>

<div class="flexible-content columns_contact_member <?php echo $width; echo $hidedecor ? ' hidedecor' : ''; ?>">

	<?php if( !$hidedecor ) : ?>
		<div class="columns_member_decor"><span></span></div>
	<?php endif; ?>

	<div class="col-lg-12 contact_column_member">

		<?php if ( $contact_column_header || $contact_column_content ) : ?>
			<div class="row">
				<?php if ( $contact_column_header  ) : ?>
					<div class="col-lg-12 contact_column_header">
						<h2><?php echo $contact_column_header; ?></h2>
					</div>
				<?php endif; ?>
				<?php if ( $contact_column_content ) : ?>
					<div class="col-lg-12 contact_column_content">
						<?php echo $contact_column_content; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $contact_column_member ) : ?>
			<div class="row">

				<?php
					$contact_column_member_id       = esc_attr( $contact_column_member['0']->ID );
					$contact_column_member_name     = esc_html( $contact_column_member['0']->post_title );
					$contact_column_member_position = esc_html( get_field( 'team_position', $contact_column_member_id ) );
					$contact_column_member_phone    = esc_html( get_field( 'team_phone', $contact_column_member_id ) );
					$contact_column_member_email    = esc_html( get_field( 'team_email', $contact_column_member_id ) );
				?>
				<div class="contact_column_member_card">
					<div class="contact_column_member_image_container">
						<div class="contact_column_member_image">
						<?php if ( has_post_thumbnail( $contact_column_member_id ) ) : ?>
							<?php
								display_responsive_image( get_post_thumbnail_id( $contact_column_member_id ), $contact_column_member_name, array( '50px' => 'person_thumb' ), '50px' );
							?>
						<?php else : ?> 
							<?php echo icon_person(); ?>
						<?php endif; ?> 
						</div>
					</div>
					
					<div class="contact_column_member_name_and_position">
						<div class="row">
							<div class="col-lg-12 contact_column_member_name">
								<?php echo $contact_column_member_name; ?>
							</div>
							<?php if ( $contact_column_member_position ) : ?>
								<div class="col-lg-12 contact_column_member_position">
									<?php echo $contact_column_member_position; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			
				<?php if ( $contact_column_member_phone ) : ?>
					<div class="col-lg-12">
						<div class="contact_column_member_phone">
							<a href="tel:<?php echo str_replace( ' ', '', $contact_column_member_phone ); ?>" title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>"><?php echo icon_phone() . $contact_column_member_phone; ?></a>			
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $contact_column_member_email ) : ?>
					<div class="col-lg-12">
						<div class="contact_column_member_email">
						<a href="mailto:<?php echo $contact_column_member_email; ?>" title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>"><?php echo icon_email() . $contact_column_member_email; ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $contact_column_header2 || $contact_column_content2 ) : ?>
			<div class="row contact_column_member2">
				<?php if ( $contact_column_header2  ) : ?>
					<div class="col-lg-12 contact_column_header">
						<h2><?php echo $contact_column_header2; ?></h2>
					</div>
				<?php endif; ?>
				<?php if ( $contact_column_content2 ) : ?>
					<div class="col-lg-12 contact_column_content">
						<?php echo $contact_column_content2; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $contact_column_member2 ) : ?>
			<div class="row">

				<?php
					$contact_column_member_id       = esc_attr( $contact_column_member2['0']->ID );
					$contact_column_member_name     = esc_html( $contact_column_member2['0']->post_title );
					$contact_column_member_position = esc_html( get_field( 'team_position', $contact_column_member_id ) );
					$contact_column_member_phone    = esc_html( get_field( 'team_phone', $contact_column_member_id ) );
					$contact_column_member_email    = esc_html( get_field( 'team_email', $contact_column_member_id ) );
				?>
				<div class="contact_column_member_card">
					<div class="contact_column_member_image_container">
						<div class="contact_column_member_image">
						<?php if ( has_post_thumbnail( $contact_column_member_id ) ) : ?>
							<?php
								display_responsive_image( get_post_thumbnail_id( $contact_column_member_id ), $contact_column_member_name, array( '50px' => 'person_thumb' ), '50px' );
							?>
						<?php else : ?> 
							<?php echo icon_person(); ?>
						<?php endif; ?> 
						</div>
					</div>
					
					<div class="contact_column_member_name_and_position">
						<div class="row">
							<div class="col-lg-12 contact_column_member_name">
								<?php echo $contact_column_member_name; ?>
							</div>
							<?php if ( $contact_column_member_position ) : ?>
								<div class="col-lg-12 contact_column_member_position">
									<?php echo $contact_column_member_position; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			
				<?php if ( $contact_column_member_phone ) : ?>
					<div class="col-lg-12">
						<div class="contact_column_member_phone">
							<a href="tel:<?php echo str_replace( ' ', '', $contact_column_member_phone ); ?>" title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>"><?php echo icon_phone() . $contact_column_member_phone; ?></a>			
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $contact_column_member_email ) : ?>
					<div class="col-lg-12">
						<div class="contact_column_member_email">
						<a href="mailto:<?php echo $contact_column_member_email; ?>" title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>"><?php echo icon_email() . $contact_column_member_email; ?></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $contact_column_header3 || $website_phone || $website_phone_mobile || $website_email ) : ?>
			<div class="row contact_column_email">
				<?php if ( $contact_column_header3  ) : ?>
					<div class="col-lg-12 contact_column_header">
						<h2><?php echo $contact_column_header3; ?></h2>
					</div>
				<?php endif; ?>
				<?php if ( $display_company_phone && $website_phone_mobile ) : ?>
					<div class="col-lg-12 contact_column_member_phone">
						<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone_mobile ); ?>"><?php echo icon_phone() . $website_phone_mobile; ?></a>
					</div>
				<?php endif; ?>

				<?php if ( $display_company_email && $website_email ) : ?>
					<div class="col-lg-12 contact_column_member_email">
						<a title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>" href="mailto:<?php echo $website_email; ?>"><?php echo icon_email() . $website_email; ?></a>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</div>
