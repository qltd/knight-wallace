<?php
/**
 * Displays the featured image
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
=======
 * @since 1.0.0
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */

if ( has_post_thumbnail() && ! post_password_required() ) {

	$featured_media_inner_classes = '';

	// Make the featured media thinner on archive pages.
	if ( ! is_singular() ) {
		$featured_media_inner_classes .= ' medium';
	}
	?>

	<figure class="featured-media">

<<<<<<< HEAD
		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
=======
		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394

			<?php
			the_post_thumbnail();

			$caption = get_the_post_thumbnail_caption();

			if ( $caption ) {
				?>

<<<<<<< HEAD
				<figcaption class="wp-caption-text"><?php echo wp_kses_post( $caption ); ?></figcaption>
=======
				<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394

				<?php
			}
			?>

		</div><!-- .featured-media-inner -->

	</figure><!-- .featured-media -->

	<?php
}
