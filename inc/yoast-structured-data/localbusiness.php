<?php

namespace Yoast\WP\SEO\Generators\Schema;

use Yoast\WP\SEO\Config\Schema_IDs;

add_filter( 'wpseo_schema_graph_pieces', 'yoast_add_graph_pieces', 11, 2 );

/**
 * Adds Schema pieces to our output.
 *
 * @param array                 $pieces  Graph pieces to output.
 * @param \WPSEO_Schema_Context $context Object with context variables.
 *
 * @return array Graph pieces to output.
 */



function yoast_add_graph_pieces( $pieces, $context ) {
	$pieces[] = new Localbusiness( $context );

	return $pieces;
}

/**
 * Class Localbusiness
 */
class Localbusiness extends Abstract_Schema_Piece {
	/**
	 * A value object with context variables.
	 *
	 * @var WPSEO_Schema_Context
	 */
	public $context;

	/**
	 * Localbusiness constructor.
	 *
	 * @param WPSEO_Schema_Context $context Value object with context variables.
	 */
	public function __construct( WPSEO_Schema_Context $context ) {
		$this->context = $context;
	}

	/**
	 * Determines whether or not a piece should be added to the graph.
	 *
	 * @return bool Whether or not a piece should be added.
	 */
	public function is_needed() {
		if ( is_home() ) {
			return true;
		}

		return false;
	}

	/**
	 * Adds our Team Member's Person piece of the graph.
	 *
	 * @return array Person Schema markup.
	 */
	public function generate() {
		$data = parent::generate();

		$data['worksFor']         = array( '@id' => $this->context->site_url . \Schema_IDs::ORGANIZATION_HASH );
		$data['mainEntityOfPage'] = array( '@id' => $this->context->canonical . \Schema_IDs::WEBPAGE_HASH );

		$job_title = get_post_meta( $this->context->id, 'employees_function_title', true );
		if ( ! empty( $job_title ) ) {
			$data['jobTitle'] = $job_title;
		}

		$suffix = get_post_meta( $this->context->id, 'employees_honoric_suffix', true );
		if ( ! empty( $suffix ) ) {
			$data['honorificSuffix'] = $suffix;
		}

		return $data;
	}
}

