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

$intro                = get_field( 'intro' );
$toc_disabled         = rest_sanitize_boolean( get_field( 'toc_disabled' ) );
$cover_image_disabled = rest_sanitize_boolean( get_field( 'cover_image_disabled' ) );
$toc_stopat           = esc_html( get_field( 'toc_stopat' ) );


?>

<article <?php post_class( '' ); ?> id="post-<?php the_ID(); ?>">

	<div class="row">
		<div class="entry-content col-lg-12">

		<?php if ( $intro ) : ?>
			<div class="single_post_intro"><?php echo $intro; ?></div>
		<?php endif; ?>
		</div>
	</div>

	<?php if ( ! $cover_image_disabled ) : ?>
		<div class="row">
			<div class="entry-image col-lg-7 mx-auto">
			<?php display_responsive_image( get_post_thumbnail_id(), '', $image_sizes, '690px' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php
	if ( ! $toc_disabled ) {
		echo do_shortcode( '[autoc stopat=' . ( $toc_stopat ? $toc_stopat : 'h2' ) . ' offset=150]' );
	}
	?>
	<div class="row">
		<div class="col-lg-8">
			<?php get_template_part( 'inc/page-builder' ); ?>
		</div>
		<div class="col-lg-4 single-post-form">
			<div class="form">
				<div class="pipedriveWebForms" data-pd-webforms="https://webforms.pipedrive.com/f/310dHzWuvwWymmvT07YyuwFH2p9lDN3x2zdelLwYEbFEYEEt8DYpKrwtFRiN76tIT">
					<script async src="https://webforms.pipedrive.com/f/loader"></script>
				</div>
			</div>
		</div>
	</div>
	
	<?php // the_content(); ?>

	<?php
	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		)
	);
	?>

	<footer class="entry-footer">

		<?php // understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->


<?php if ( ! $toc_disabled ) : ?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {

			;(function($) {
		
			var $autoc = $(".single_post_table_of_contents");
			var $content = $('#content');
			var stopAt = $autoc.data("stopat");
			var hs = [];
			switch(stopAt){
				case "h6":
					hs.push("h6");
				case "h5":
					hs.push("h5");
				case "h4":
					hs.push("h4");
				case "h3":
					hs.push("h3");
				case "h2":
					hs.push("h2");
			}
			hs = hs.join();
			
			var $heads = $content.find(hs).not('.no-toc');
			
			if($heads.length === 0){
				return;
			}
			var toc = "";
			toc += '<div class="col-lg-12"><span><?php esc_html_e( 'Table of contents', 'understrap' ); ?>:</span></div>';
			toc += "<ol>";
			$heads.each(function(){
				var $this = $(this);
				var tag = $this[0].tagName;
				var txt = $this.text();
				var slug = slugify(txt);
				$this.attr("data-linked",slug);
				$this.attr("data-offset",$this.offset().top);
				// $this.css({
				// 	'scroll-margin-top':'150px','scroll-snap-margin-top':'150px'
				// });

				toc += '<li class="toc-level-'+tag+'">';
				toc += '<a href="#" data-linkto="'+slug+'">'+txt+"</a></li>";

				//console.log( txt + ' : ' + $this.offset().top );

			});
			toc += "</ol>";
			$autoc.append(toc);
			$(".single_post_table_of_contents ol").on("click", "a", function(e){
				e.preventDefault();

				//console.log($content.find('[data-linked="'+$(this).attr("data-linkto")+'"]').offset().top - parseInt($autoc.attr("data-offset"), 10));

				$('html, body').animate({
					scrollTop: $content.find('[data-linked="'+$(this)
						.attr("data-linkto")+'"]').attr("data-offset") 
				}, 2000);

				// $content.find('[data-linked="'+$(this).attr("data-linkto")+'"]')[0].scrollIntoView({
				//  	behavior: 'smooth'
				// });
			});
		
		function slugify(text){
			return text.toString().toLowerCase()
				.replace(/\s+/g, "-")           // Replace spaces with -
				.replace(/[^\w\-]+/g, "")       // Remove all non-word chars
				.replace(/\-\-+/g, "-")         // Replace multiple - with single -
				.replace(/^-+/, "")             // Trim - from start of text
				.replace(/-+$/, "");            // Trim - from end of text
		}
	})(jQuery);
		});
	</script>
<?php endif; ?>
