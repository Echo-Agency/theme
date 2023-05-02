<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<?php
	$exit_popups_enabled = get_field( 'exit_popups_enabled', 'option' );

	if ( $exit_popups_enabled ) :

		$exit_popups       = get_field( 'exit_popups', 'option' );
		$exit_popups_count = count( $exit_popups );
		$exit_popups_rand  = rand( 0, $exit_popups_count - 1 );

		if ( $exit_popups ) :
			?>
		<div class="exit_popup">
			<div class="exit_popup_content">
				<span class="exit_popup_close"><?php echo icon_close(); ?></span>
				
				<div class="exit_popup_header">
					<?php echo wp_kses_post( $exit_popups[ $exit_popups_rand ]['exit_popup']['exit_popup_header'] ); ?>
				</div>

				<?php echo wp_kses_post( $exit_popups[ $exit_popups_rand ]['exit_popup']['exit_popup_content'] ); ?>

				<a title="<?php echo wp_kses_post( $exit_popups[ $exit_popups_rand ]['exit_popup']['button_url']['title'] ); ?>" href="<?php echo esc_url( $exit_popups[ $exit_popups_rand ]['exit_popup']['button_url']['url'] ); ?>" class="btn btn-primary"><?php echo wp_kses_post( $exit_popups[ $exit_popups_rand ]['exit_popup']['button_text'] ); ?></a>

				<div class="exit_popup_decor">
					<?php get_svg( 'plus', 100, __( 'Add new clients', 'understrap' ) ); ?>
					<?php get_svg( 'multiply', 100, __( 'Multiply leads', 'understrap' ) ); ?>
					<?php // get_svg( 'power', 50, __( 'Power the traffic', 'understrap' ) ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>

<?php

$contact_widget     = get_field( 'contact_widget' );

if ( $contact_widget  ) :
	$sticker_widget_text = get_field( 'sticker_widget_text', 'option' );
	$sticker_widget_btn_text  = wp_kses_post( get_field( 'sticker_widget_btn_text', 'option' ) );
	$sticker_widget_btn_link  = esc_url( get_field( 'sticker_widget_btn_link', 'option' ) );
	
?>
	<div id="sticker">
		<div id="sticker_close"><?php echo icon_close(); ?></div>
	<?php if ( $sticker_widget_btn_link ): ?>
		<a title="<?php $sticker_widget_btn_text; ?>" href="<?php echo $sticker_widget_btn_link ; ?>">
		<?php endif; ?>

			<div class="icon-svg">
				<?php echo icon_email(); ?>
			</div>

			<?php 
				if ( $sticker_widget_text ) {
					echo $sticker_widget_text; 
				}
			?>
			<?php if ( $sticker_widget_btn_text ): ?>
				<div class="btn btn-primary">
					<?php echo $sticker_widget_btn_text; ?>
				</div>
			<?php endif; ?>

		<?php if ( $sticker_widget_btn_link ): ?>
		</a>
		<?php endif; ?>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var sticker_closed = false;

			function myFunction() {

				var windowScroll = document.body.scrollTop || document.documentElement.scrollTop;
				var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
				var scrolled = (windowScroll / height) * 100;
				
				if(scrolled >= 15 && !sticker_closed) {
					document.getElementById("sticker").classList.add("active");
				} else {
					document.getElementById("sticker").classList.remove("active");
				}

				document.getElementById("sticker_close").onclick = function() {
					document.getElementById("sticker").classList.remove("active");
					sticker_closed = true;
				}
			}

			window.onscroll = function() {myFunction()}
		});
	</script>
<?php endif; ?>

<?php wp_footer(); ?>

<!-- <script type="text/javascript">
	WebFontConfig = {
		google: { families: [ 'Roboto:400,500,900:latin-ext&display=swap' ] } //Poppins:400,600|Roboto+Slab:400,700
	};
	(function() {
		var wf = document.createElement('script');
		wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(wf, s);
	})(); 
</script> -->

<!-- Hotjar Tracking Code for agencjaecho.pl -->
<script>
setTimeout(function(){ 
	(function(h,o,t,j,a,r){
		h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		h._hjSettings={hjid:1567910,hjsv:6};
		a=o.getElementsByTagName('head')[0];
		r=o.createElement('script');r.async=1;
		r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
		a.appendChild(r);
	})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
}, 3500);
</script>

 <!-- Facebook Pixel Code -->
 <script>
setTimeout(function(){ 
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');

	fbq('init', '746518415450077');
	fbq('track', "PageView");
}, 3500);
</script>

<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=746518415450077&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<script>
	setTimeout(function(){ 
	_linkedin_partner_id = "2658778"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); 

	(function(l) { if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])}; window.lintrk.q=[]} var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(window.lintrk);
}, 3500);
</script>

<noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=2658778&fmt=gif" /> </noscript>

</body>

</html>

