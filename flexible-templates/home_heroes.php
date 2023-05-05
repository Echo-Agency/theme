<?php
	$line1 = wp_kses_post( get_sub_field( 'line1' ) );
	$line2 = wp_kses_post( get_sub_field( 'line2' ) );
	$buttons = get_sub_field( 'buttons' );
?>

</div>
</div>
<div class="row p-0">
	<div class="container-fluid home_heroe">
		<div class="container">
			<div class="row vertical-middle">
				<div class="flexible-content col-lg-12">
					<div class="row">
						<div class="col-md-12 col-lg-5 counter">
							<div class="numbers"></div>
							<div class="percent">
								<img src="<?php echo get_stylesheet_directory_uri() . '/img/svg/percent.svg';?>">
							</div>
						</div>
						<div class="col-md-12 col-lg-7 counter_header">
							<?php if ( $line1 ) : ?>
								<div class="line1">
									<?php echo $line1; ?>
								</div>
							<?php endif; ?>
						</div>
						<?php if ( $line2 ) : ?>
							<div class="col-lg-12 line2">
								<?php echo $line2; ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( $buttons ) : ?>
						<div class="buttons">
							<?php foreach( $buttons as $button ): ?>
								<?php if( isset( $button['button_url']['url'] ) && $button['button_url']['url'] && isset( $button['button_text'] ) && $button['button_text'] ): ?>
									<a href="<?php echo $button['button_url']['url']; ?>" title="<?php echo $button['button_url']['title']; ?>" class="btn btn-primary">
										<?php echo $button['button_icon_code'] ? $button['button_icon_code'] : ''; echo $button['button_text']; ?>
									</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<div class="circle-white">
						<div class="circle-blue">
							<?php get_svg( 'arrow-down-white', 9, __( 'How can we help you.', 'understrap' ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="decor">
			<?php //get_svg( 'plus', 140, __( 'Add new clients', 'understrap' ) ); ?>
			<?php //get_svg( 'multiply', 111, __( 'Multiply leads', 'understrap' ) ); ?>
			<?php //get_svg( 'power', 115, __( 'Power the traffic', 'understrap' ) ); ?>
		</div> -->
	</div>
</div>
<div class="container"> <!-- start container -->
<div class="row"> <!-- start row -->
