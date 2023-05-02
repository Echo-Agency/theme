<?php
add_filter( 'wpcf7_autop_or_not', '__return_false' );

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

function load_cf7_scripts() {
	if ( is_page( array( 'kontakt', 'bezplatna-konsultacja', 'zapytaj' ) ) || is_page_template( 'page-templates/ebook.php' ) ) {

		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}

		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}

		wp_enqueue_script( 'google-recaptcha' );
		wp_enqueue_script( 'wpcf7-recaptcha' );

		function redirect_cf7() {
			?>
			<script>
			document.addEventListener( 'wpcf7mailsent', function( event ) {
				if ( '443' == event.detail.contactFormId ) {
				   location = '<?php echo get_site_url(); ?>/dziekujemy/';
				} else if ( '1315' == event.detail.contactFormId ) {
				   location = '<?php echo get_site_url(); ?>/dziekujemy-konsultacja/';
				} else if ( '2744' == event.detail.contactFormId ) {
					//2744 - first ebbok
				   location = '<?php echo get_site_url(); ?>/dziekujemy-ebook/';
				} else if ( '2845' == event.detail.contactFormId ) {
					//2845 ebook budowlana
				   location = '<?php echo get_site_url(); ?>/dziekujemy-ebook-marketing-w-branzy-budowlanej/';
				} else if ( '2854' == event.detail.contactFormId ) {
					//2854 ebook deweloperzy
				   location = '<?php echo get_site_url(); ?>/dziekujemy-ebook-marketing-dla-deweloperow/';
				} else if ( '3520' == event.detail.contactFormId ) {
					//3520 ebook pozycjonowanie
					location = '<?php echo get_site_url(); ?>/dziekujemy-ebook-pozycjonowanie-strony-firmowej//';
				} else {
					location = '<?php echo get_site_url(); ?>';
				}
			}, false );
			</script>
			<?php
		}

		add_action( 'wp_footer', 'redirect_cf7' );
	}
}

add_action( 'wp_enqueue_scripts', 'load_cf7_scripts', 21 );  // dequeue has priority 20
// changed to Pipedrive

/**
 * This adds the "My tag" tag to all new subscribers added by the plugin.
 *
 * Use "mc4wp_subscriber_form_data" filter only runs for form requests.
 * The "mc4wp_subscriber_data" to hook into both form & integration requests.
 */
add_filter( 'mc4wp_subscriber_data', function(MC4WP_MailChimp_Subscriber $subscriber) {
	$subscriber->tags[] = 'newsletter';
	return $subscriber;
 }); 

add_filter( 'wpcf7_acceptance', function( $yes ) {
	if (isset($_POST['_mc4wp_subscribe_contact-form-7'])) {
		if( ! $yes ) { 
			return false; 
		} else { 
			return ! empty( $_POST['_mc4wp_subscribe_contact-form-7'] ); 
		}
	} else {
		return true;
	}
});