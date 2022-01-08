<?php
/**
 * Displays the search icon and modal
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
=======
 * @since 1.0.0
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */

?>
<div class="search-modal cover-modal header-footer-group" data-modal-target-string=".search-modal">

	<div class="search-modal-inner modal-inner">

		<div class="section-inner">

			<?php
			get_search_form(
				array(
<<<<<<< HEAD
					'aria_label' => __( 'Search for:', 'twentytwenty' ),
=======
					'label' => __( 'Search for:', 'twentytwenty' ),
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
				)
			);
			?>

<<<<<<< HEAD
			<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field">
=======
			<button class="toggle search-untoggle close-search-toggle fill-children-current-color" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
				<span class="screen-reader-text"><?php _e( 'Close search', 'twentytwenty' ); ?></span>
				<?php twentytwenty_the_theme_svg( 'cross' ); ?>
			</button><!-- .search-toggle -->

		</div><!-- .section-inner -->

	</div><!-- .search-modal-inner -->

</div><!-- .menu-modal -->
