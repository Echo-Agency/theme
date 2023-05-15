<?php
add_theme_support( 'person_thumb' );
add_image_size( 'person_thumb', 100, 100, true );

add_theme_support( 'gallery_thumb' );
add_image_size( 'gallery_thumb', 200, 200, true );

update_option( 'thumbnail_size_w', 380 );
update_option( 'thumbnail_size_h', 380 );
update_option( 'thumbnail_crop', 1 );

add_theme_support( 'thumbnail_no_crop' );
add_image_size( 'thumbnail_no_crop', 380, 380, false );

add_image_size( 'post_read_also_no_crop', 460, 460, false );

update_option( 'medium_size_w', 540 );
update_option( 'medium_size_h', 540 );
update_option( 'medium_crop', 0 );

add_theme_support( 'big' );
add_image_size( 'big', 690, 690, false );

update_option( 'large_size_w', 1110 );
update_option( 'large_size_h', 1110 );
update_option( 'large_crop', 0 );

add_theme_support( 'full_hd' );
add_image_size( 'full_hd', 1920, 0, false );


/**
 * Allow import svg files using media library
 *
 * @param $mimes
 *
 * @return mixed
 */
// add SVG to allowed file uploads
// function add_svg_to_upload_mimes( $upload_mimes ) {

// $upload_mimes['svg']  = 'image/svg';
// $upload_mimes['svgz'] = 'image/svg';

// return $upload_mimes;
// }

// add_filter( 'upload_mimes', 'add_svg_to_upload_mimes', 10, 1 );

function display_responsive_image( $image_id, $alt = '', $image_sizes = null, $max_width = null, $svg = false, $lazy = true, $additional_class = null ) {
	if ( ! $image_id ) {
		$image_id = get_field( 'default_image', 'options' );
	}
	if ( '' != $image_id ) {

		if ( ! $image_sizes ) {
			$image_sizes = array(
				'1920px' => 'full_hd',
				'1110px' => 'large',
				'690px'  => 'big',
				'540px'  => 'medium',
				'380px'  => 'thumbnail_no_crop',
				'200px'  => 'gallery_thumb',
				'100px'  => 'person_thumb',
			);
		}

		$image_sizes = is_array($image_sizes) ? $image_sizes : array($image_sizes);

		if ( ! $max_width ) {
			$max_width = '1110px';
		}

		$images_src = array();
		foreach ( $image_sizes as $key => $image_size ) {
			$images_src[ $key ] = wp_get_attachment_image_src( $image_id, $image_size );
		}

		if ( '' === $alt ) {
			$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		}

		// $title = get_the_title( $image_id );

		$srcset = '';
		$sizes  = '(max-width: ' . $max_width . ') 100vw, ' . $max_width;

		foreach ( $images_src as $key => $image ) {
			$srcset .= $image[0] . ' ' . $image[1] . 'w,';
		}
		$image_mini_src = wp_get_attachment_image_src( $image_id, 'gallery_thumb' );
		$srcset        .= $image_mini_src[0] . ' 16w';
		?>

		
		
			<img 
				<?php if ( ! $svg && isset($images_src[ $max_width ]) ) : ?>
					width="<?php echo $images_src[ $max_width ][1]; ?>"
					height="<?php echo $images_src[ $max_width ][2]; ?>"
					<?php echo isset($additional_class) ? 'class="' . $additional_class . ' " ' : ''; ?>
				<?php endif; ?>
				 sizes="<?php echo $sizes; ?>"
				 srcset="<?php echo $srcset; ?>"
				 alt="<?php echo $alt; ?>"
				 title="<?php echo $alt; ?>"
				 <?php echo isset($additional_class) ? 'class="' . $additional_class . ' " ' : ''; ?>
			 <?php echo ( $lazy ) ? ' loading="lazy" ' : ''; ?>
				 />
		<?php
	}
}

function get_svg( $filename, $height = 0, $alt = '', $additional_class = '' ) {
	?>
	<img class="svg 
	<?php
	echo esc_html( $filename . '-image' );
	echo ( $additional_class ) ? ' ' . $additional_class : '';
	?>
	"
		 src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/svg/' . $filename . '.svg' ); ?>"
		 <?php
			if ( $alt ) {
				?>
				alt="<?php echo esc_html( $alt ); ?>" title="<?php echo esc_html( $alt ); ?>"
				<?php
			}

			if ( $height ) {
				?>
			style="height: <?php echo esc_html( $height . 'px' ); ?>; width: auto;"
				<?php
			}
			?>
	>
	<?php
}

function get_svg_number( $number, $alt = '' ) {
	$numbers = str_split( $number );

	foreach ( $numbers as $number ) {
		if ( ',' == $number || '.' == $number ) {
			$number = 'coma';
		}
		?>
	<img class="svg <?php echo esc_html( 'number-' . $number . '-image' ); ?>"
		 src="<?php echo esc_url( get_stylesheet_directory_uri() . '/img/svg/numbers/' . $number . '.svg' ); ?>"
		 
		<?php
		if ( $alt ) {
			?>
				alt="<?php echo esc_html( $alt ); ?>" title="<?php echo esc_html( $alt ); ?>"
			<?php
		}

		?>
	>
		<?php
	}
}

/*
 Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ', $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucfirst( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'         => $post_ID,            // Specify the image (ID) to be updated
			'post_title' => $my_image_title,     // Set image Title to sanitized title
			// 'post_excerpt'    => $my_image_title,     // Set image Caption (Excerpt) to sanitized title
			// 'post_content'    => $my_image_title,     // Set image Description (Content) to sanitized title
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	}
}
