<?php
	$line1 = wp_kses_post( get_sub_field( 'line1' ) );
	$line2 = wp_kses_post( get_sub_field( 'line2' ) );
	$buttons = get_sub_field( 'buttons' );
	$percentages = get_sub_field( 'percentages' );
?>

</div>
</div>
<div class="row home_heroe-row">
	<div class="container-fluid home_heroe <?php echo $percentages ? '' : 'has-decor' ?>">
		<div class="container">
			<div class="row">
				<div class="flexible-content <?php echo $percentages ? ' col-lg-12 ' : ' col-lg-8' ?> ">
					<div class="row">
						<?php if ($percentages) : ?>
							<div class="col-md-12 col-lg-5 counter">
								<div class="numbers"></div>
								<div class="percent">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/svg/percent.svg';?>">
								</div>
							</div>
							<?php endif; ?>						
						<div class="col-md-12 <?php echo $percentages ? ' col-lg-7 ' : ' ' ?>  counter_header">
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
				</div>
				<?php if (!$percentages) : ?>
					<div class="col-md-12 col-lg-4 ">
						<svg class="bg-decor" width="379" height="280" viewBox="0 0 379 280" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M379 50H228V101H379V50Z" fill="#FFD000"/>
							<path d="M329 151L329 0L278 -2.22928e-06L278 151L329 151Z" fill="#FFD000"/>
							<path d="M142.809 151.747L72.0625 81L36.0001 117.062L106.747 187.809L142.809 151.747Z" fill="#D71D24"/>
							<path d="M36.0624 187.809L106.809 117.062L70.7469 81.0001L-5.83417e-06 151.747L36.0624 187.809Z" fill="#D71D24"/>
							<path d="M195.889 252.781L277.39 151.498L224.389 151.502L142.889 252.781L195.889 252.781Z" fill="#F37920"/>
							<path d="M224.392 252.781L142.891 151.498L195.892 151.502L277.392 252.781L224.392 252.781Z" fill="#F37920"/>
						</svg>
					</div>
				<?php endif; ?>
			</div>
			<div class="circle-white">
				<div class="circle-blue">
					<?php get_svg( 'arrow-down-white', 9, __( 'How can we help you.', 'understrap' ) ); ?>
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
