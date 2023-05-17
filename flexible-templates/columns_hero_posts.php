<?php
	$full_width  = rest_sanitize_boolean( get_sub_field( 'hero_full_width' ) );
	$bg_enabled  = rest_sanitize_boolean( get_sub_field( 'hero_bg_enabled' ) );
	$bg_color    = sanitize_hex_color( get_sub_field( 'hero_bg_color' ) );
	$title       = esc_html( get_sub_field( 'hero_title' ) );
	$title_color = esc_html( get_sub_field( 'hero_title_color' ) );
	$header      = wp_kses_post( get_sub_field( 'hero_header' ) );
	$description = esc_html( get_sub_field( 'hero_description' ) );
	$hero_images_with_text = get_sub_field( 'hero_images_with_text' );
	$button = get_sub_field( 'hero_button' );
	$button_class = 'btn-bordered';
	$style = null;

if ( $bg_enabled && $bg_color ) {
	$style = ' style="background-color:' . $bg_color . '"';
}

?>

<?php if ( $full_width ) : ?>
	</div> <!-- end row for full width-->
	</div> <!-- end container for full width -->
	<div class="row p-0">
<?php endif; ?>


<div class="flexible-content columns_hero_with_posts" <?php echo ( $style ) ?? ''; ?> >

	<div class="container">
		<div class="hero_with_text_content row">
			<div class="col-lg-12 hero_with_text_heading">
				<span class="hero-title <?php echo 'text-' . $title_color; ?>"><?php echo $title; ?></span>
				<div class="hero-header"><?php echo $header; ?></div>
				<p class="hero-descriptions"><?php echo $description; ?></p>
			</div>
			
			<?php
				if ( !$hero_images_with_text ):
					$args = array(
						'post_type'      => 'post',
						'posts_per_page' => 3,
						'post_status'    => 'publish',
						// 'orderby'        => 'rand',
					);
					$hero_posts       = new WP_Query( $args );
					$hero_posts_count = count( $hero_posts->get_posts() );

					$image_sizes = array(
						'690px' => 'big',
						'540px' => 'medium',
						'300px' => 'thumbnail',
					);

					// $images_decors = array(
					// 0 => icon_power(),
					// 1 => icon_plus(),
					// 2 => icon_multiply(),
					// );

					// shuffle( $images_decors );
				
			
				if ( $hero_posts->have_posts() ) :
					$rowCount = 0;
					?>
					
					<?php
					while ( $hero_posts->have_posts() ) :
						$hero_posts->the_post();
						$rowCount++;
						?>

						<?php

							$category = get_the_category();

						if ( $category[0] ) {
							$category_link = '<a class="columns_hero_with_posts_post_footer_category" title="' . $category[0]->cat_name . '" href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
						}

						?>
					
						<div class="columns_hero_with_posts_post_container col-md-12 col-lg-4">
							<div class="row columns_hero_with_posts_post">
								
								<div class="columns_hero_with_posts_post_image col-lg-12">
									<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">

									<?php
									if ( has_post_format( 'video' ) ) {

										get_youtube_video_cover( get_the_ID() );

										echo '<div class="video-decor">' . icon_youtube() . '</div>';
									} else {
										display_responsive_image( get_post_thumbnail_id( get_the_ID() ), get_the_title(), $image_sizes, '690px' );
									}
									?>
									</a>
								</div>
								<div class="columns_hero_with_posts_post_footer col-lg-12">
									<?php echo $category_link; ?>
									<div class="columns_hero_with_posts_post_footer_date"><?php the_date(); ?></div>
								</div>
								<div class="columns_hero_with_posts_post_title col-lg-12">
									<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>">
										<?php the_title(); ?>
									</a>
								</div>
								<div class="columns_hero_with_posts_post_link col-lg-12">
									<a title="<?php the_title(); ?>" href="<?php the_permalink( get_the_ID() ); ?>"> <?php esc_html_e( 'Read More...', 'understrap' ); ?> </a>
								</div>
							</div>
						</div>
						
					<?php endwhile; ?>

				<?php else : ?>
					<p>
						<?php esc_html_e( 'It looks like nothing was found', 'understrap' ); ?>
					</p>
				<?php endif; ?>
			
				<?php wp_reset_postdata(); ?>
			<?php else: ?>
				<?php
					$image_sizes = array(
						'690px' => 'big',
						'540px' => 'medium',
						'300px' => 'thumbnail',
					);
				?>
				<div class="row">
					<?php 
					foreach( $hero_images_with_text as $hero_image_with_text ): ?>
						<div class="<?php echo $hero_image_with_text['column_image_with_text_width'] ? $hero_image_with_text['column_image_with_text_width'] : 'col-lg-6'; ?>">

							<?php 
								if ( $hero_image_with_text['column_image_with_text_image'] ) {
									display_responsive_image( $hero_image_with_text['column_image_with_text_image'], $hero_image_with_text['column_image_with_text_image_text_header'], $image_sizes, '690px' );
								}
							?>
							<?php if ( $hero_image_with_text['column_image_with_text_image_text_header'] ): ?>
								<h2>
									<?php echo $hero_image_with_text['column_image_with_text_image_text_header']; ?>
								</h2>
							<?php endif; ?>
							<?php 
								if ( $hero_image_with_text['column_image_with_text_image'] ) {
									echo $hero_image_with_text['column_image_with_text_image_text_content']; 
								}
							?>
							<?php
							if ( $hero_image_with_text['column_image_with_text_button_text'] && $hero_image_with_text['column_image_with_text_button_url']["url"] ): ?>
								<a class="btn btn-primary" title="<?php echo $hero_image_with_text['column_image_with_text_button_url']["title"]; ?>" href="<?php echo $hero_image_with_text['column_image_with_text_button_url']["url"]; ?>" target="<?php echo $hero_image_with_text['column_image_with_text_button_url']["target"] ?$hero_image_with_text['column_image_with_text_button_url']["target"] : '_self'; ?>">
									<?php echo $hero_image_with_text['column_image_with_text_button_icon_code'] . $hero_image_with_text['column_image_with_text_button_text']; ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>

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
		</div>
	</div>
</div>

<?php if ( $full_width ) : ?>
	</div>
	<div class="container"> <!-- start container -->
	<div class="row"> <!-- start row -->
<?php endif; ?>
