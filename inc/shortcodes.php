<?php

add_filter( 'widget_text', 'do_shortcode' );

function social_icons_shortcode() {
	 $networks = array(
		 'facebook'  => array(
			 'url'   => esc_url( get_field( 'website_facebook', 'option' ) ),
			 'title' => esc_html( get_field( 'website_facebook_title', 'option' ) ),
			 'icon'  => icon_facebook(),
		 ),
		 'youtube'   => array(
			 'url'   => esc_url( get_field( 'website_youtube', 'option' ) ),
			 'title' => esc_html( get_field( 'website_youtube_title', 'option' ) ),
			 'icon'  => icon_youtube(),
		 ),
		 'instagram' => array(
			 'url'   => esc_url( get_field( 'website_instagram', 'option' ) ),
			 'title' => esc_html( get_field( 'website_instagram_title', 'option' ) ),
			 'icon'  => icon_instagram(),
		 ),
		 'twitter'   => array(
			 'url'   => esc_url( get_field( 'website_twitter', 'option' ) ),
			 'title' => esc_html( get_field( 'website_twitter_title', 'option' ) ),
			 'icon'  => icon_twitter(),
		 ),
		 'linkedin'  => array(
			 'url'   => esc_url( get_field( 'website_linkedin', 'option' ) ),
			 'title' => esc_html( get_field( 'website_linkedin_title', 'option' ) ),
			 'icon'  => icon_linkedin(),
		 ),
	 );

	 ob_start();
		?> 

	<p class="footer-social-icons">

		<?php
		foreach ( $networks as $network ) {
			if ( $network['url'] ) {
				echo ' <a href="' . $network['url'] . '" title="' . $network['title'] . '" target="_blank">' . $network['icon'] . '</a>';
			}
		}
		?>
			
	</p>
	
	<?php
	return ob_get_clean();
}

add_shortcode( 'social-icons', 'social_icons_shortcode' );

function website_info_shortcode() {
	$website_name          = esc_html( get_field( 'website_name', 'option' ) );
	$website_street        = esc_html( get_field( 'website_street', 'option' ) );
	$website_code_and_city = esc_html( get_field( 'website_code_and_city', 'option' ) );
	$website_phone         = esc_html( get_field( 'website_phone', 'option' ) );
	$website_phone_mobile  = esc_html( get_field( 'website_phone_mobile', 'option' ) );
	$website_email         = esc_html( get_field( 'website_email', 'option' ) );

	ob_start();
	?>
	 

	<div class="website-info">

		<?php if ( $website_name ) : ?>
			<div class="website-name">
				<?php echo $website_name; ?>
			</div>
		<?php endif; ?>

		<?php if ( $website_street ) : ?>
			<div class="website-address">
				<?php echo icon_address() . $website_street; ?>
				<?php if ( $website_code_and_city ) : ?>
					<span><?php echo $website_code_and_city; ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $website_phone ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone ); ?>"><?php echo icon_phone() . $website_phone; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $website_phone_mobile ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone_mobile ); ?>"><?php echo icon_phone() . $website_phone_mobile; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $website_email ) : ?>
			<div class="website-email">
				<a title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>" href="mailto:<?php echo $website_email; ?>"><?php echo icon_email() . $website_email; ?></a>
			</div>
		<?php endif; ?>

	</div>
	
	<?php
	return ob_get_clean();
}

add_shortcode( 'website-info', 'website_info_shortcode' );

function contact_page_info_shortcode() {
	$website_name          = esc_html( get_field( 'website_name', 'option' ) );
	$website_street        = esc_html( get_field( 'website_street', 'option' ) );
	$website_code_and_city = esc_html( get_field( 'website_code_and_city', 'option' ) );
	$website_phone         = esc_html( get_field( 'website_phone', 'option' ) );
	$website_phone_mobile  = esc_html( get_field( 'website_phone_mobile', 'option' ) );
	$website_email         = esc_html( get_field( 'website_email', 'option' ) );

	ob_start();
	?>
	 

	<div class="website-info">

		<?php if ( $website_name ) : ?>
			<div class="website-name">
				<?php echo $website_name; ?>
			</div>
		<?php endif; ?>

		<?php if ( $website_street ) : ?>
			<div class="website-address">
				<?php echo icon_address() . $website_street; ?>
				<?php if ( $website_code_and_city ) : ?>
					<span><?php echo $website_code_and_city; ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $website_phone ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="<?php echo str_replace( ' ', '', $website_phone ); ?>"><?php echo icon_phone() . $website_phone; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $website_phone_mobile ) : ?>
			<div class="website-phone">
				<a title="<?php esc_html_e( 'Call to Echo', 'understrap' ); ?>" href="tel:<?php echo str_replace( ' ', '', $website_phone_mobile ); ?>"><?php echo icon_phone() . $website_phone_mobile; ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $website_email ) : ?>
			<div class="website-email">
				<a title="<?php esc_html_e( 'Mail to Echo', 'understrap' ); ?>" href=""><?php echo icon_email() . $website_email; ?></a>
			</div>
		<?php endif; ?>

	</div>
	
	<?php
	return ob_get_clean();
}

add_shortcode( 'contact-page-info', 'contact_page_info_shortcode' );

function google_badge_shortcode() {

	$google_premier_partner_title = esc_html( get_field( 'google_premier_partner_title', 'option' ) );
	$google_premier_partner_url   = esc_url( get_field( 'google_premier_partner_url', 'option' ) );

	ob_start();
	?>
		

   <div class="google-bagde">

	   <?php
		if ( $google_premier_partner_url ) {
			echo '<a title="' . $google_premier_partner_title . '" href="' . $google_premier_partner_url . '" target="_blank">';
			get_svg( 'google-premier-partner', 74, __( 'Google Premier Partner', 'understrap' ) );
			echo '</a>';
		}
		?>
		   
		</div>
   
	<?php
	return ob_get_clean();
}

add_shortcode( 'google-badge', 'google_badge_shortcode' );

function display_logo_shortcode( $ob = true ) {
	 $website_logo = esc_html( get_field( 'website_logo', 'option' ) );
	if ( $ob ) {
		ob_start();
	}
	?>
	 
		<a class="navbar-brand website-logo" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url">
			<?php
			if ( $website_logo ) :
				{
					$image_sizes = array(
						'1920px' => 'full_hd',
					);
					display_responsive_image( $website_logo, '', $image_sizes, '200px', true, false );
					}
					?>
			<?php else : ?>
				<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>
			<?php endif; ?>
		</a>
		
	<?php
	if ( $ob ) {
		return ob_get_clean();
	}
}
add_shortcode( 'display-logo', 'display_logo_shortcode' );

function lwp_4644_autoc( $atts, $ob = true ) {
	if ( empty( $atts ) ) {
		$atts = array();
	}
	if ( empty( $atts['stopat'] ) ) {
		$atts['stopat'] = 'h4';
	}
	if ( empty( $atts['offset'] ) ) {
		$atts['offset'] = '40';
	}

	if ( $ob ) {
		ob_start();
	}
	?>
	
	<div class="single_post_table_of_contents row" data-stopat="<?php echo $atts['stopat']; ?>" data-offset="<?php echo $atts['offset']; ?>"></div>

	<?php
	if ( $ob ) {
		return ob_get_clean();
	}
}
add_shortcode( 'autoc', 'lwp_4644_autoc' );
