<?php
/**
 * Field Structure:
 *
 * - page_builder_rows (Repeater)
 *   - flexible_content (Repeater)
 *     - columns
 *       - sub_fields
 */


if ( have_rows( 'page_builder' ) ) :
	while ( have_rows( 'page_builder' ) ) :
		the_row();

		// Get parent value.
		// $parent_title = get_sub_field('parent_title');
		echo '<div class="row">';
		// Loop over sub repeater rows.
		if ( have_rows( 'flexible_content' ) ) :
			while ( have_rows( 'flexible_content' ) ) :
				the_row();

				// Get sub value.
				$row_layout = get_row_layout();

				// echo $row_layout;

				get_template_part( "flexible-templates/$row_layout" );

			endwhile;
		endif;
		echo '</div>';
	endwhile;
endif;

