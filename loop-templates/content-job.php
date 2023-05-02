<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$image_sizes = array(
	'690px' => 'big',
	'540px' => 'medium',
	'380px' => 'thumbnail',
);

$job_start_date    = esc_html( get_field( 'job_start_date' ) );
$job_end_date      = esc_html( get_field( 'job_end_date' ) );
$job_location      = esc_html( get_field( 'job_location' ) );
$job_contract      = esc_html( get_field( 'job_contract' ) );
$job_about_company = get_field( 'job_about_company' );
$job_description   = get_field( 'job_description' );
$job_requirements  = get_field( 'job_requirements' );
$job_offer         = get_field( 'job_offer' );
$job_we_expect     = get_field( 'job_we_expect' );
$job_tools         = get_field( 'job_tools' );
$job_email         = esc_html( get_field( 'job_email' ) );

?>

<article <?php post_class( '' ); ?> id="post-<?php the_ID(); ?>">

	<div class="row job-content">

			<?php if ( is_archive() ) : ?>
				<div class="col-lg-12">
					<h2 class="archive_entry_title">
						<?php echo get_the_title(); ?>
					</h2>
				</div>
			<?php endif; ?>
		
			<div class="col-lg-12">
				<div class="row">
					
						<div class="col-md-4 job_date">
							<?php if ( $job_start_date && $job_end_date ) : ?>
								<?php echo icon_calendar() . $job_start_date . ' - ' . $job_end_date; ?>
							<?php else : ?>
								<?php echo icon_calendar() . icon_infinity(); ?>
							<?php endif; ?>
						</div>
					 
					<?php if ( $job_location ) : ?> 
						<div class="col-md-4 job_location">
							<?php echo icon_address() . $job_location; ?> 
						</div>
					<?php endif; ?> 
					<?php if ( $job_contract ) : ?> 
							<div class="col-md-4 job_contract">
								<?php echo icon_deal() . $job_contract; ?> 
							</div>
					<?php endif; ?> 
				</div>
			</div>

			<?php if ( $job_about_company ) : ?> 
				<div class="col-lg-12 job_about_company">
					<h2 class="job_content_title">
						<?php
						echo icon_about_company();
						esc_html_e( 'Job about company', 'understrap' );
						?>
						:
					</h2>
					<?php echo $job_about_company; ?> 
				</div>
			<?php endif; ?> 
			
			<?php if ( $job_description ) : ?> 
				<div class="col-lg-12 job_description">
					<h2 class="job_content_title">
						<?php
						echo icon_job_description();
						esc_html_e( 'Job description', 'understrap' );
						?>
						:
					</h2>
					<?php echo $job_description; ?> 
				</div>
			<?php endif; ?> 

			<?php if ( $job_requirements ) : ?> 
				<div class="col-lg-12 job_requirements">
					<h2 class="job_content_title">
						<?php
						echo icon_requirements();
						esc_html_e( 'Job requirements', 'understrap' );
						?>
					</h2>
					<?php echo $job_requirements; ?> 
				</div>
			<?php endif; ?> 

			<?php if ( $job_offer ) : ?> 
				<div class="col-lg-12 job_offer">
					<h2 class="job_content_title">
						<?php
						echo icon_offer();
						esc_html_e( 'Job offer', 'understrap' );
						?>
						:
					</h2>
					<?php echo $job_offer; ?> 
				</div>
			<?php endif; ?> 

			<?php if ( $job_we_expect ) : ?> 
				<div class="col-lg-12 job_we_expect">
					<h2 class="job_content_title">
						<?php
						echo icon_job_we_expect();
						esc_html_e( 'Job we expect', 'understrap' );
						?>
					</h2>
					<?php echo $job_we_expect; ?> 
				</div>
			<?php endif; ?> 

			<?php if ( $job_tools ) : ?> 
				<div class="col-lg-12 job_tools">
					<h2 class="job_content_title">
						<?php
						echo icon_job_tools();
						esc_html_e( 'Job tools', 'understrap' );
						?>
					</h2>
					<?php echo $job_tools; ?> 
				</div>
			<?php endif; ?> 

			<div class="col-lg-12 job_clause">
				<p>
					<?php esc_html_e( 'Job clause', 'understrap' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'Job rodo', 'understrap' ); ?>
				</p>
			</div>

			<?php if ( $job_email ) : ?> 
				<div class="col-lg-12 job_email">
					<h2 class="job_content_title">
						<?php
						echo icon_apply();
						esc_html_e( 'Job apply at', 'understrap' );
						?>
						:
					</h2>
					<a title="
					<?php
					esc_html_e( 'Job apply at', 'understrap' );
					echo ' ';
					the_title();
					?>
					" href="mailto:<?php echo $job_email; ?>"><?php echo $job_email; ?></a>  
				</div>
			<?php endif; ?> 

			<?php if ( is_archive() ) : ?>
				<div class="col-lg-12 archive_job_divider"></div>
			<?php endif; ?>
		
	</div>
</article><!-- #post-## -->
