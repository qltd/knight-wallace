<?php
/**
 * Javascript Loader Class
 *
 * Allow `async` and `defer` while enqueuing Javascript.
 *
 * Based on a solution in WP Rig.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
=======
 * @since 1.0.0
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */

if ( ! class_exists( 'TwentyTwenty_Script_Loader' ) ) {
	/**
	 * A class that provides a way to add `async` or `defer` attributes to scripts.
<<<<<<< HEAD
	 *
	 * @since Twenty Twenty 1.0
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	 */
	class TwentyTwenty_Script_Loader {

		/**
		 * Adds async/defer attributes to enqueued / registered scripts.
		 *
		 * If #12009 lands in WordPress, this function can no-op since it would be handled in core.
		 *
<<<<<<< HEAD
		 * @since Twenty Twenty 1.0
		 *
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		 * @link https://core.trac.wordpress.org/ticket/12009
		 *
		 * @param string $tag    The script tag.
		 * @param string $handle The script handle.
		 * @return string Script HTML string.
		 */
		public function filter_script_loader_tag( $tag, $handle ) {
<<<<<<< HEAD
			foreach ( array( 'async', 'defer' ) as $attr ) {
=======
			foreach ( [ 'async', 'defer' ] as $attr ) {
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
				if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
					continue;
				}
				// Prevent adding attribute when already added in #12009.
				if ( ! preg_match( ":\s$attr(=|>|\s):", $tag ) ) {
					$tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
				}
				// Only allow async or defer, not both.
				break;
			}
			return $tag;
		}

	}
}
