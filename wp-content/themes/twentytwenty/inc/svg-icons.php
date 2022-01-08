<?php
/**
 * Twenty Twenty SVG Icon helper functions
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
=======
 * @since 1.0.0
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */

if ( ! function_exists( 'twentytwenty_the_theme_svg' ) ) {
	/**
	 * Output and Get Theme SVG.
	 * Output and get the SVG markup for an icon in the TwentyTwenty_SVG_Icons class.
	 *
<<<<<<< HEAD
	 * @since Twenty Twenty 1.0
	 *
	 * @param string $svg_name The name of the icon.
	 * @param string $group    The group the icon belongs to.
	 * @param string $color    Color code.
	 */
	function twentytwenty_the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
		echo twentytwenty_get_theme_svg( $svg_name, $group, $color ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in twentytwenty_get_theme_svg().
=======
	 * @param string $svg_name The name of the icon.
	 * @param string $group The group the icon belongs to.
	 * @param string $color Color code.
	 */
	function twentytwenty_the_theme_svg( $svg_name, $group = 'ui', $color = '' ) {
		echo twentytwenty_get_theme_svg( $svg_name, $group, $color ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in twentytwenty_get_theme_svg();.
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	}
}

if ( ! function_exists( 'twentytwenty_get_theme_svg' ) ) {

	/**
	 * Get information about the SVG icon.
	 *
<<<<<<< HEAD
	 * @since Twenty Twenty 1.0
	 *
	 * @param string $svg_name The name of the icon.
	 * @param string $group    The group the icon belongs to.
	 * @param string $color    Color code.
=======
	 * @param string $svg_name The name of the icon.
	 * @param string $group The group the icon belongs to.
	 * @param string $color Color code.
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	 */
	function twentytwenty_get_theme_svg( $svg_name, $group = 'ui', $color = '' ) {

		// Make sure that only our allowed tags and attributes are included.
		$svg = wp_kses(
			TwentyTwenty_SVG_Icons::get_svg( $svg_name, $group, $color ),
			array(
				'svg'     => array(
					'class'       => true,
					'xmlns'       => true,
					'width'       => true,
					'height'      => true,
					'viewbox'     => true,
					'aria-hidden' => true,
					'role'        => true,
					'focusable'   => true,
				),
				'path'    => array(
					'fill'      => true,
					'fill-rule' => true,
					'd'         => true,
					'transform' => true,
				),
				'polygon' => array(
					'fill'      => true,
					'fill-rule' => true,
					'points'    => true,
					'transform' => true,
					'focusable' => true,
				),
			)
		);

		if ( ! $svg ) {
			return false;
		}
		return $svg;
	}
}
