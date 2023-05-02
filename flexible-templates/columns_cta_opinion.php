<?php
	$full_width            = rest_sanitize_boolean( get_sub_field( 'cta_full_width' ) );
	$cta_extra_decors      = rest_sanitize_boolean( get_sub_field( 'cta_extra_decors' ) );
	$cta_extra_decors_type = esc_html( get_sub_field( 'cta_extra_decors_type' ) );
	$cta_background        = esc_html( get_sub_field( 'cta_background' ) );

	$cta_opinion = get_sub_field( 'cta_opinion' );
	$button      = get_sub_field( 'cta_button' );
?>

<?php if ( $full_width ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	
	<div class="row p-0">
<?php endif; ?>

<div class="flexible-content columns_cta_opinion background-<?php echo $cta_background; ?>">
	<div class="cta_content container">

		<?php if ( $cta_opinion ) : ?>
			<div class="col-lg-12 cta_opinion">
				<div class="row">
					<div class="col-lg-4 cta_opinion_company">
						<p class="cta_opinion_company_name">
							<?php
								echo esc_html( $cta_opinion['opinion_company'] );
							?>
						</p>
						<p>
							<?php esc_html_e( 'About us', 'understrap' ); ?>
						</p>
					</div>
					<div class="col-lg-8 cta_opinion_content">
						<div class="cta_opinion_quote_decor">
							<?php echo icon_quote(); ?>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<?php
									echo $cta_opinion['opinion_content'];
								?>
							</div>

							<div class="col-lg-12 stars">
								<?php echo display_rating( $cta_opinion['opinion_score'] ); ?>
							</div>

							<div class="col-lg-12">
								<div class="cta_opinion_signature">
									<?php
										echo esc_html( $cta_opinion['opinion_signature'] );
									?>
								</div>
								
								<div class="cta_opinion_position">
									<?php
										echo esc_html( $cta_opinion['opinion_position'] );
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $button ) : ?>
			<div class="col-lg-12 text-center">
				<?php
					$button_text      = $button['button_text'];
					$button_icon_code = $button['button_icon_code'];
					$button_url       = $button['button_url'];

					include locate_template( 'flexible-templates/button.php', false, false );
				?>
			</div>
		<?php endif; ?>

		<?php if ( $cta_extra_decors ) : ?>
			<div class="decors <?php echo $cta_extra_decors_type; ?>">
				<div class="decor-plus">
					<?php echo icon_plus(); ?>
				</div>
				<div class="decor-multiply">
					<?php echo icon_multiply(); ?>
				</div>
				<div class="decor-power">
					<?php echo icon_power(); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
