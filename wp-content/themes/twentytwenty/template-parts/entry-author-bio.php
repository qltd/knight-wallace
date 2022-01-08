<?php
/**
 * The template for displaying Author info
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
=======
 * @since 1.0.0
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */

if ( (bool) get_the_author_meta( 'description' ) && (bool) get_theme_mod( 'show_author_bio', true ) ) : ?>
<div class="author-bio">
	<div class="author-title-wrapper">
		<div class="author-avatar vcard">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 160 ); ?>
		</div>
		<h2 class="author-title heading-size-4">
			<?php
			printf(
<<<<<<< HEAD
				/* translators: %s: Author name. */
=======
				/* translators: %s: Author name */
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
				__( 'By %s', 'twentytwenty' ),
				esc_html( get_the_author() )
			);
			?>
		</h2>
	</div><!-- .author-name -->
	<div class="author-description">
		<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php _e( 'View Archive <span aria-hidden="true">&rarr;</span>', 'twentytwenty' ); ?>
		</a>
	</div><!-- .author-description -->
</div><!-- .author-bio -->
<?php endif; ?>
