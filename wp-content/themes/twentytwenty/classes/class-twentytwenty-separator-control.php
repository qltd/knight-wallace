<?php
/**
 * Customizer Separator Control settings for this theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
=======
 * @since 1.0.0
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	if ( ! class_exists( 'TwentyTwenty_Separator_Control' ) ) {
		/**
		 * Separator Control.
<<<<<<< HEAD
		 *
		 * @since Twenty Twenty 1.0
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		 */
		class TwentyTwenty_Separator_Control extends WP_Customize_Control {
			/**
			 * Render the hr.
<<<<<<< HEAD
			 *
			 * @since Twenty Twenty 1.0
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			 */
			public function render_content() {
				echo '<hr/>';
			}

		}
	}
}
